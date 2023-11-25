<?php

namespace App\Http\Controllers;

use App\Helpers\DataTableHelper;
use App\Http\Requests\CreateContractRequest;
use App\Http\Requests\UpdateContractRequest;
use App\Models\Contract;
use App\Models\ContractSubtype;
use App\Models\InternalProcedure;
use App\Models\Role;
use App\Services\AttachmentService;
use App\Services\ContractNoticeService;
use App\Services\ContractOperationAreaService;
use App\Services\ContractPartyService;
use App\Services\SectorService;
use App\Services\ContractService;
use App\Services\InternalProcedureService;
use App\Services\LocationService;
//use Exception;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Throwable;

class ContractController extends AppBaseController {
    public function __construct(protected ContractService              $contractService, protected ContractNoticeService $contractNoticeService,
                                protected ContractOperationAreaService $operationArea, protected LocationService $locationService,
                                protected SectorService                $sectorService, protected ContractPartyService $contractPartyService,
                                protected InternalProcedureService     $internalProcedureService, protected AttachmentService $attachmentService) {

    }

    /**
     * Display a listing of the Contract.
     *
     * @param Request $request
     *
     * @return View|JsonResponse
     */
    public function index(Request $request) : View | JsonResponse {
        $title = 'Delete Contract!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        $contracts = $this->contractService->findAll();
        if($request->ajax()) {
            return DataTableHelper::renderContractsDatatable($contracts);
        }
        return view('contracts.index')->with('contracts', $contracts);
    }

    /**
     * Show the form for creating a new Contract.
     *
     * @return View
     */
    public function create() : View {
        return view('contractss.create');
    }

    /**
     * Store a newly created Contract in storage.
     *
     * @param CreateContractRequest $request
     *
     * @return RedirectResponse
     * @throws Throwable
     */
    public function store(CreateContractRequest $request) : RedirectResponse {
        $input = $request->all();
        DB::transaction(function () use($input){
            if (isset($input['prefix']) && isset($input['reference_no'])) {
                $input['reference_no'] = $input['prefix'] . '-' . $input['reference_no'];
            }
            $contract = $this->contractService->createContract($input);

            $procedure['from_institution_id'] = auth()->user()->institution_id;
            $procedure['to_institution_id'] = null;
            $procedure['status'] = 1;
            $contract->internalProcedure()->save(new InternalProcedure($procedure));

            if(isset($input['signed_at'])){
                $this->contractService->setSigneLocation($contract, $input, $this->locationService);
            }
            $input['contract_id'] = $contract->id;
            if(!empty($input['category_id']))  {
                $data = [
                    ['institution_id' => $input['home_institution_id'],'contract_id' => $contract->id],
                    ['institution_id' => $input['foreign_institution_id'],'contract_id' => $contract->id]
                ];
                $this->contractPartyService->createMultipleParties($data);
            }
            Session::put('contractId', $contract->id);
        });

        toast('Contract saved successfully.', 'success');
        return redirect(route('contractObjectives.create'));
    }

    /**
     * Display the specified Contract.
     *
     * @param string|int $id
     *
     *
     *
     * @return View|RedirectResponse
     */
    public function show(string|int $id) : View|RedirectResponse {
        $id = decode($id);
        $contract = $this->contractService->getContract($id);
        $procedures = InternalProcedure::with('toInstitution', 'fromInstitution')
          ->where(['procedurable_id' => $contract->id, 'procedurable_type' => Contract::class])
          ->orderBy('created_at', 'desc')
          ->get();

        Session::put('contractId',$contract->id);

        $contract_id = $contract->id;

        if (empty($contract)) {
            alert()->error('ErrorAlert','Error','Contract not found');
            return redirect(route('contractss.index'));
        }

        return view(
            'contractss.show',
            compact('contract', 'procedures','contract_id'));
    }

    /**
     * Show the form for editing the specified Contract.
     *
     * @param string|int $id
     *
     * @return View|RedirectResponse
     */
    public function edit(string|int $id) : View|RedirectResponse {
        $id=decode($id);
        $contract = $this->contractService->getContract($id);
        if (empty($contract)) {
            alert()->error('ErrorAlert','Error','Contract not found');
            return redirect(route('contractss.index'));
        }

        return view('contractss.edit')->with('contract', $contract);
    }

    /**
     * Update the specified Contract in storage.
     *
     * @param int $id
     * @param UpdateContractRequest $request
     *
     * @return RedirectResponse
     * @throws Throwable
    */
    public function update(int $id,UpdateContractRequest  $request): RedirectResponse
    {

        return DB::transaction(function () use ($id, $request) {
            $contract = $this->contractService->getContract($id);
            if (empty($contract)) {
                alert()->error('ErrorAlert','Error','Contract not found');
                return redirect(route('contractss.index'));
            }
            $this->contractService->updateContract($request->all(), $id);
            $this->contractPartyService->updateMultipleParties($id,$request->all());

            if(isset($request->signed_at)){
                $this->contractService->updateSignedContractLocation($contract, $request->all(), $this->locationService);
            }
            else{
                $location = $contract->signedLocation;
                if ($location) {
                    $location->delete();
                }
            }

            toast('Contract updated successfully.','success');
            return redirect(route('contractss.index'));
        });
    }

    /**
     * Remove the specified Contract from storage.
     *
     * @param int|String $id
     *
     * @return RedirectResponse
     * @throws Throwable
     */
    public function destroy(int|String $id) : RedirectResponse {
        $id=decode($id);
        $contract = $this->contractService->getContract($id);

        if (empty($contract)) {
            alert()->error('ErrorAlert','Error','Contract not found');

            return redirect(route('contractss.index'));
        }

        $this->contractService->deleteContract($id);

        toast('Contract deleted successfully.','success');

        return redirect(route('contractss.index'));
    }

    public function contractSendTo(int $id) : View|RedirectResponse {
        $contracts = Contract::find($id);
        $roles = Role::all();
        return view('contractss.contractSendTo',compact('contracts','roles'));
    }

    public function draftContracts(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application {
        $contracts=Contract::whereNull('signed_at')->get();
        return view('contractss.draft.index',compact('contracts'));
    }

    public function draftContractShow($contractId): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application {
        $contractId=decode($contractId);
        $contract=Contract::find($contractId);
        return view('contractss.draft.show',compact('contract'));
    }

    public function getContractSubTypes($name) {
        $responseData = ContractSubtype::where('type', $name)->get();
        return response()->json($responseData);
    }

}

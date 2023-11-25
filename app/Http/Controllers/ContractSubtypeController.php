<?php

namespace App\Http\Controllers;

use App\Helpers\DataTableHelper;
use App\Http\Requests\CreateContractSectorRequest;
use App\Http\Requests\CreateContractSubTypeRequest;
use App\Http\Requests\UpdateContractSectorRequest;
use App\Models\Contract;
use App\Services\ContractSubtypeService;
use App\Services\SectorService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use RealRashid\SweetAlert;
use RealRashid\SweetAlert\Facades\Alert;
use Session;
use Throwable;

class ContractSubtypeController extends AppBaseController
{
    public function __construct(protected ContractSubtypeService $subTypeService) {}

    /**
     * Display a listing of the ContractSubtype.
     *
     * @param Request $request
     *
     * @return View|JsonResponse
     */
    public function index(Request $request) : View | JsonResponse
    {
        $subtype = $this->subTypeService->findAll();

        if($request->ajax()){
            return DataTableHelper::renderSubTypeDataTable($subtype);
        }
        return view('contract_subtypes.index');
    }

    /**
     * Show the form for creating a new ContractSector.
     *
     * @return View|RedirectResponse
     */
    public function create() : View|RedirectResponse
    {
        $id = Session::has('contractId')?Session::get('contractId'):18;
        $contract = Contract::find($id);
//        if($contract->signed_at)
//        {
//            alert()->error('Failed','Please the contract is already completed');
//            return back();
//        }
        return view('contract_subtypes.create', compact('contract'));
    }

    /**
     * Store a newly created ContractSector in storage.
     *
     * @param CreateContractSectorRequest $request
     *
     * @return RedirectResponse
     * @throws Throwable
     */
    public function store(CreateContractSubTypeRequest $request)    : RedirectResponse
    {
        $input = $request->all();

        try {
             $this->subTypeService->createContractSubType($input);
            Alert::toast('Contract SubType added successfully.','success');
            return redirect(route('contract_subtypes.index'));
        } catch (Exception $e) {
            Alert::error('Failed', 'Failed to add sector');
            return back();
        }
    }

    /**
     * Display the specified ContractSector.
     *
     * @param int $id
     *
     * @return View|RedirectResponse
     */
    public function show(int $id) : View|RedirectResponse
    {
        $contractSector = $this->subTypeService->getContractSubType($id);
        if (empty($contractSector)) {
            alert()->error('Model not found','Responsible sector not found');
            return redirect(route('contract_subtypes.index'));
        }
        return view('contract_subtypes.show')->with('contractSector', $contractSector);
    }
    /**
     * Show the form for editing the specified ContractSector.
     *
     * @param int $id
     *
     * @return View|RedirectResponse
     */
    public function edit(int $id) : View|RedirectResponse
    {
        $contractSector = $this->subTypeService->getContractSubType($id);
        if (empty($contractSector)) {
            alert()->error('Model not found','Responsible sector not found');
            return redirect(route('contract_subtypes.index'));
        }
        return view('contract_subtypes.edit')->with('contractSector', $contractSector);
    }
    /**
     * Update the specified ContractSector in storage.
     *
     * @param int $id
     * @param UpdateContractSectorRequest $request
     *
     * @return RedirectResponse
     * @throws Throwable
     */
    public function update(int $id, Request $request) : RedirectResponse
    {
        $contractSector = $this->subTypeService->getContractSubType($id);
        if (empty($contractSector)) {
            alert()->error('Model not found','Responsible sector not found');
            return back();
        }
        $this->subTypeService->updateContractSubType($request->all(), $id);
        toast('Sector updated successfully.','success');
        return back();
    }

    /**
     * Remove the specified ContractSector from storage.
     *
     * @param int|string $id
     *
     * @return RedirectResponse
     * @throws Throwable
     */
    public function destroy(int|string $id) : RedirectResponse
    {

        $subtype = $this->subTypeService->getContractSubType($id);
        if (empty($subtype)) {
            alert()->error('Model not found','Contract Sub Type not found');
            return redirect(route('contract_subtypes.index'));
        }
        $this->subTypeService->deleteContractSubType($id);
        Alert::toast('Contract Subtype removed successfully.','success');
        return redirect(route('contract_subtypes.index'));
    }


    public function checkSubTypeName(Request $request): JsonResponse {
        $name = $request->input("name");
        $id = $request->input("id");
        return checkSubTypeName($name, $id);
    }
    public function checkSubType(Request $request): JsonResponse {
        $name = $request->input("type");
        $id = $request->input("id");
        return checkSubType($name, $id);
    }
}

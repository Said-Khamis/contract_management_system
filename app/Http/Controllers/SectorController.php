<?php

namespace App\Http\Controllers;

use App\Helpers\DataTableHelper;
use App\Http\Requests\CreateContractSectorRequest;
use App\Http\Requests\UpdateContractSectorRequest;
use App\Models\Contract;
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

class SectorController extends AppBaseController
{
    public function __construct(protected SectorService $sectorService) {}

    /**
     * Display a listing of the ContractSector.
     *
     * @param Request $request
     *
     * @return View|JsonResponse
     */
    public function index(Request $request) : View | JsonResponse
    {
        $sector = $this->sectorService->findAll();

        if($request->ajax()){
            return DataTableHelper::renderSectorDataTable($sector);
        }
        return view('sectors.index');
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
        return view('sectors.create', compact('contract'));
    }

    /**
     * Store a newly created ContractSector in storage.
     *
     * @param CreateContractSectorRequest $request
     *
     * @return RedirectResponse
     * @throws Throwable
     */
    public function store(CreateContractSectorRequest $request) : RedirectResponse
    {
        $input = $request->all();
        try {
            $sector = $this->sectorService->createContractSector($input);
            Alert::toast('Sector added successfully.','success');
            return redirect(route('sectors.index'));
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
        $contractSector = $this->sectorService->getContractSector($id);

        if (empty($contractSector)) {
            alert()->error('Model not found','Responsible sector not found');

            return redirect(route('contractSectors.index'));
        }

        return view('sectors.show')->with('contractSector', $contractSector);
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
        $contractSector = $this->sectorService->getContractSector($id);

        if (empty($contractSector)) {
            alert()->error('Model not found','Responsible sector not found');

            return redirect(route('sectors.index'));
        }

        return view('sectors.edit')->with('contractSector', $contractSector);
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
    public function update(int $id, UpdateContractSectorRequest $request) : RedirectResponse
    {


        $contractSector = $this->sectorService->getContractSector($id);

        if (empty($contractSector)) {
            alert()->error('Model not found','Responsible sector not found');

            return back();
        }
        $this->sectorService->updateContractSector($request->all(), $id);

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
        $id=decode($id);
        $sector = $this->sectorService->getContractSector($id);

        if (empty($sector)) {
            alert()->error('Model not found','Sector not found');

            return redirect(route('sectors.index'));
        }

        $this->sectorService->deleteContractSector($id);

        Alert::toast('Responsible sector removed successfully.','success');
        return redirect(route('sectors.index'));
    }

    /**
     * Display a listing of the Institution.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function checkSector(Request $request): JsonResponse {
        $name = $request->input("name");
        $id = $request->input("id");
        return checkSectorName($name, $id);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateContractOperationAreaRequest;
use App\Http\Requests\UpdateContractOperationAreaRequest;
use App\Models\Contract;
use App\Services\ContractOperationAreaService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;
use Session;
use Throwable;

class ContractOperationAreaController extends AppBaseController
{
    public function __construct(protected ContractOperationAreaService $operationAreaService) {}

    /**
     * Display a listing of the ContractOperationArea.
     *
     * @param Request $request
     *
     * @return View
     */
    public function index(Request $request) : View
    {
        $contractOperationAreas = $this->operationAreaService->findAll();

        return view('contract_operation_areas.index')
            ->with('contractOperationAreas', $contractOperationAreas);
    }

    /**
     * Show the form for creating a new ContractOperationArea.
     *
     * @return View|RedirectResponse
     */
    public function create() : View|RedirectResponse
    {
        $id = Session::has('contractId')?Session::get('contractId'):1;
        $contract = Contract::find($id);
//        if($contract->signed_at)
//        {
//            alert()->error('Failed','Please the contract is already completed');
//            return back();
//        }
        return view('contract_operation_areas.create', compact('contract'));
    }

    /**
     * Store a newly created ContractOperationArea in storage.
     *
     * @param CreateContractOperationAreaRequest $request
     *
     * @return RedirectResponse
     * @throws Throwable
     */
    public function store(CreateContractOperationAreaRequest $request) : RedirectResponse
    {
        $input = $request->all();

        $this->operationAreaService->createMultiple($input);

        toast('Area of Cooperation saved successfully.','success');

        return back();
    }

    /**
     * Display the specified ContractOperationArea.
     *
     * @param int $id
     *
     * @return View|RedirectResponse
     */
    public function show(int $id) : View|RedirectResponse
    {
        $contractOperationArea = $this->operationAreaService->getContractCooperationArea($id);

        if (empty($contractOperationArea)) {
            alert()->error('Model not found','Area of Cooperation not found');

            return redirect(route('contractOperationAreas.index'));
        }
        return view('contract_operation_areas.show')->with('contractOperationArea', $contractOperationArea);
    }

    /**
     * Show the form for editing the specified ContractOperationArea.
     *
     * @param int $id
     *
     * @return View|RedirectResponse
     */
    public function edit(int $id) : View|RedirectResponse
    {
        $contractOperationArea = $this->operationAreaService->getContractCooperationArea($id);

        if (empty($contractOperationArea)) {
            alert()->error('Model not found','Area of Cooperation not found');

            return redirect(route('contractOperationAreas.index'));
        }

        return view('contract_operation_areas.edit')->with('contractOperationArea', $contractOperationArea);
    }

    /**
     * Update the specified ContractOperationArea in storage.
     *
     * @param int $id
     * @param UpdateContractOperationAreaRequest $request
     *
     * @return RedirectResponse
     * @throws Throwable
     */
    public function update(int $id, UpdateContractOperationAreaRequest $request)
//    : RedirectResponse
    {

        $contractOperationArea = $this->operationAreaService->getContractCooperationArea($id);

        if (empty($contractOperationArea)) {
            alert()->error('Model not found','Area of Cooperation not found');

            return back();
        }

        $this->operationAreaService->updateContractOperationArea($request->all(), $id);

        toast('Area of Cooperation updated successfully.','success');

        return back();
    }

    /**
     * Remove the specified ContractOperationArea from storage.
     *
     * @param int $id
     *
     * @throws Exception
     *
     * @return RedirectResponse
     */
    public function destroy(int $id) : RedirectResponse
    {
        $contractOperationArea = $this->operationAreaService->getContractCooperationArea($id);

        if (empty($contractOperationArea)) {
            alert()->error('Model not found', 'Area of Cooperation not found');

            return redirect(route('contractss.show',[$contractOperationArea->contract_id]));
        }

        $this->operationAreaService->deleteContractOperationArea($id);

        toast('Area of Cooperation removed successfully.', 'success');

        return redirect(route('contractss.show', [$contractOperationArea->contract_id]));
    }
}

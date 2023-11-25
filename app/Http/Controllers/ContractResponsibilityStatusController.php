<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateContractResponsibilityStatusRequest;
use App\Http\Requests\UpdateContractResponsibilityStatusRequest;
use App\Services\ContractResponsibilityStatusService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class ContractResponsibilityStatusController extends AppBaseController
{
    public function __construct(protected ContractResponsibilityStatusService $responsibilityStatusService) {}

    /**
     * Display a listing of the ContractResponsibilityStatus.
     *
     * @param Request $request
     *
     * @return View
     */
    public function index(Request $request) : View
    {
        $contractResponsibilityStatuses = $this->responsibilityStatusService->findAll();

        return view('contract_responsibility_statuses.index')
            ->with('contractResponsibilityStatuses', $contractResponsibilityStatuses);
    }

    /**
     * Show the form for creating a new ContractResponsibilityStatus.
     *
     * @return View
     */
    public function create() : View
    {
        return view('contract_responsibility_statuses.create');
    }

    /**
     * Store a newly created ContractResponsibilityStatus in storage.
     *
     * @param CreateContractResponsibilityStatusRequest $request
     *
     * @return View|RedirectResponse
     * @throws Throwable
     */
    public function store(CreateContractResponsibilityStatusRequest $request) : View|RedirectResponse
    {
        $input = $request->all();

        $this->responsibilityStatusService->createContractResponsibilityStatus($input);

        toast('Contract Responsibility Status saved successfully.', 'success');

        return redirect(route('contractResponsibilityStatuses.index'));
    }

    /**
     * Display the specified ContractResponsibilityStatus.
     *
     * @param int $id
     *
     * @return View|RedirectResponse
     */
    public function show(int $id) : View|RedirectResponse
    {
        $contractResponsibilityStatus = $this->responsibilityStatusService->getContractResponsibilityStatus($id);

        if (empty($contractResponsibilityStatus)) {
            alert()->error('Model not found','Contract Responsibility Status not found');

            return redirect(route('contractResponsibilityStatuses.index'));
        }

        return view('contract_responsibility_statuses.show')->with('contractResponsibilityStatus', $contractResponsibilityStatus);
    }

    /**
     * Show the form for editing the specified ContractResponsibilityStatus.
     *
     * @param int $id
     *
     * @return View|RedirectResponse
     */
    public function edit(int $id) : View|RedirectResponse
    {
        $contractResponsibilityStatus = $this->responsibilityStatusService->getContractResponsibilityStatus($id);

        if (empty($contractResponsibilityStatus)) {
            alert()->error('Model not found','Contract Responsibility Status not found');

            return redirect(route('contractResponsibilityStatuses.index'));
        }

        return view('contract_responsibility_statuses.edit')->with('contractResponsibilityStatus', $contractResponsibilityStatus);
    }

    /**
     * Update the specified ContractResponsibilityStatus in storage.
     *
     * @param int $id
     * @param UpdateContractResponsibilityStatusRequest $request
     *
     * @return RedirectResponse
     * @throws Throwable
     */
    public function update(int $id, UpdateContractResponsibilityStatusRequest $request) : RedirectResponse
    {
        $contractResponsibilityStatus = $this->responsibilityStatusService->getContractResponsibilityStatus($id);

        if (empty($contractResponsibilityStatus)) {
            alert()->error('Contract Responsibility Status not found');

            return redirect(route('contractResponsibilityStatuses.index'));
        }

        $this->responsibilityStatusService->updateContractResponsibilityStatus($request->all(), $id);

        toast('Contract Responsibility Status updated successfully.','success');

        return redirect(route('contractResponsibilityStatuses.index'));
    }

    /**
     * Remove the specified ContractResponsibilityStatus from storage.
     *
     * @param int $id
     * @return RedirectResponse
     * @throws Exception
     * @throws Throwable
     *
     */
    public function destroy(int $id) : RedirectResponse
    {
        $contractResponsibilityStatus = $this->responsibilityStatusService->getContractResponsibilityStatus($id);

        if (empty($contractResponsibilityStatus)) {
            alert()->error('Model not found','Contract Responsibility Status not found');

            return redirect(route('contractResponsibilityStatuses.index'));
        }

        $this->responsibilityStatusService->deleteContractResponsibility($id);

        toast('Contract Responsibility Status deleted successfully.','success');

        return redirect(route('contractResponsibilityStatuses.index'));
    }
}

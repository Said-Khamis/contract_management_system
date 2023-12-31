<?php

namespace App\Http\Controllers\Approval;

use App\DataTables\Approval\ApprovalHistoryDataTable;
use App\Http\Requests\Requisition;
use App\Http\Requests\Approval\CreateApprovalHistoryRequest;
use App\Http\Requests\Approval\UpdateApprovalHistoryRequest;
use App\Repositories\Approval\ApprovalHistoryRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ApprovalHistoryController extends AppBaseController
{
    /** @var  ApprovalHistoryRepository */
    private $approvalHistoryRepository;

    public function __construct(ApprovalHistoryRepository $approvalHistoryRepo)
    {
        $this->middleware('auth');
        $this->approvalHistoryRepository = $approvalHistoryRepo;
    }

    /**
     * Display a listing of the ApprovalHistory.
     *
     * @param ApprovalHistoryDataTable $approvalHistoryDataTable
     * @return Response
     */
    public function index(ApprovalHistoryDataTable $approvalHistoryDataTable)
    {
        return $approvalHistoryDataTable->render('approval_histories.index');
    }

    /**
     * Show the form for creating a new ApprovalHistory.
     *
     * @return Response
     */
    public function create()
    {
        return view('approval_histories.create');
    }

    /**
     * Store a newly created ApprovalHistory in storage.
     *
     * @param CreateApprovalHistoryRequest $request
     *
     * @return Response
     */
    public function store(CreateApprovalHistoryRequest $request)
    {
        $input = $request->all();

        $approvalHistory = $this->approvalHistoryRepository->create($input);

        Flash::success('Approval History saved successfully.');

        return redirect(route('approvalHistories.index'));
    }

    /**
     * Display the specified ApprovalHistory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $approvalHistory = $this->approvalHistoryRepository->findWithoutFail($id);

        if (empty($approvalHistory)) {
            Flash::error('Approval History not found');

            return redirect(route('approvalHistories.index'));
        }

        return view('approval_histories.show')->with('approvalHistory', $approvalHistory);
    }

    /**
     * Show the form for editing the specified ApprovalHistory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $approvalHistory = $this->approvalHistoryRepository->findWithoutFail($id);

        if (empty($approvalHistory)) {
            Flash::error('Approval History not found');

            return redirect(route('approvalHistories.index'));
        }

        return view('approval_histories.edit')->with('approvalHistory', $approvalHistory);
    }

    /**
     * Update the specified ApprovalHistory in storage.
     *
     * @param  int              $id
     * @param UpdateApprovalHistoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateApprovalHistoryRequest $request)
    {
        $approvalHistory = $this->approvalHistoryRepository->findWithoutFail($id);

        if (empty($approvalHistory)) {
            Flash::error('Approval History not found');

            return redirect(route('approvalHistories.index'));
        }

        $approvalHistory = $this->approvalHistoryRepository->update($request->all(), $id);

        Flash::success('Approval History updated successfully.');

        return redirect(route('approvalHistories.index'));
    }

    /**
     * Remove the specified ApprovalHistory from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $approvalHistory = $this->approvalHistoryRepository->findWithoutFail($id);

        if (empty($approvalHistory)) {
            Flash::error('Approval History not found');

            return redirect(route('approvalHistories.index'));
        }

        $this->approvalHistoryRepository->delete($id);

        Flash::success('Approval History deleted successfully.');

        return redirect(route('approvalHistories.index'));
    }
}

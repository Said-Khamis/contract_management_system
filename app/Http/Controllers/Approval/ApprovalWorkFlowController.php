<?php

namespace App\Http\Controllers\Approval;

use App\DataTables\Approval\ApprovalWorkFlowDataTable;
use App\Http\Requests\Requisition;
use App\Http\Requests\Approval\CreateApprovalWorkFlowRequest;
use App\Http\Requests\Approval\UpdateApprovalWorkFlowRequest;
use App\Models\Approval\ApprovalGroup;
use App\Models\Approval\ApprovalWorkFlow;
use App\Repositories\Approval\ApprovalWorkFlowRepository;
use Exception;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;
use Response;

class ApprovalWorkFlowController extends AppBaseController
{
    public function __construct(
        protected ApprovalWorkFlowRepository $approvalWorkFlowRepository
    )
    {$this->middleware('auth');}

    /**
     * Display a listing of the ApprovalFlow.
     *
     */
    public function index():View
    {
        $workFlows = ApprovalWorkFlow::all();
        return view('approval_work_flows.index', compact('workFlows'));
    }

    /**
     * Show the form for creating a new ApprovalFlow.
     *
     * @return View
     */
    public function create(): View
    {
        return view('approval_work_flows.create');
    }

    /**
     * Store a newly created ApprovalFlow in storage.
     *
     * @param CreateApprovalWorkFlowRequest $request
     *
     * @return RedirectResponse
     */
    public function store(CreateApprovalWorkFlowRequest $request): RedirectResponse
    {
        /*{
            "_token": "wWjZrGhTruqtmQodkeImtskmumxE1PHFLzCAEKsU",
            "name": "flow",
            "rank": "4",
            "type": "checklist",
            "approval_group_id": [
                "1"
             ],
            "description": "flow check"
        }*/

        $input = $request->all();

        //begin transaction
        DB::beginTransaction();
        try {
            // $approvalWorkFlow = $this->approvalWorkFlowRepository->create($input);
            $approvalWorkFlow = ApprovalWorkFlow::create([
                'name' => $input['name'],
                'rank' => $input['rank'],
                'type' => $input['type'],
                'description' => $input['description'],
            ]);

            foreach ($input['approval_group_id'] as $approvalGroupId) {
                $approvalGroup = ApprovalGroup::findOrFail($approvalGroupId);
                $approvalWorkFlow->approvalGroups()->attach($approvalGroup);
            }

        } catch (ModelNotFoundException $e) {
            DB::rollback();
            throw $e;
        }
        DB::commit();

        Alert::toast('Approval work Flow saved successfully.');

        return redirect(route('approvalWorkFlows.index'));
    }

    /**
     * Display the specified ApprovalFlow.
     *
     * @param int $id
     *
     * @return RedirectResponse | View
     */
    public function show(int $id): View|RedirectResponse
    {
        $approvalWorkFlow = $this->approvalWorkFlowRepository->findWithoutFail($id);

        if (empty($approvalWorkFlow)) {
            Alert::error('Approval Work Flow not found');
            return redirect(route('approvalWorkFlows.index'));
        }

        return view('approval_work_flows.show')->with('approvalWorkFlow', $approvalWorkFlow);
    }

    /**
     * Show the form for editing the specified ApprovalFlow.
     *
     * @param int $id
     *
     * @return RedirectResponse | view
     */
    public function edit(int $id): View|RedirectResponse
    {
        $approvalWorkFlow = $this->approvalWorkFlowRepository->find($id);

        if (empty($approvalWorkFlow)) {
            Alert::error('Approval Work Flow not found');

            return redirect(route('approvalWorkFlows.index'));
        }

        return view('approval_work_flows.edit', compact('approvalWorkFlow'));
    }

    /**
     * Update the specified ApprovalFlow in storage.
     *
     * @param int $id
     * @param UpdateApprovalWorkFlowRequest $request
     *
     * @return RedirectResponse
     */
    public function update(int $id, UpdateApprovalWorkFlowRequest $request): RedirectResponse
    {
        $approvalWorkFlow = $this->approvalWorkFlowRepository->find($id);

        if (empty($approvalWorkFlow)) {
            Alert::error('Approval Work Flow not found');

            return redirect(route('approvalWorkFlows.index'));
        }

        $approvalWorkFlow = $this->approvalWorkFlowRepository->update($request->all(), $id);

        Alert::toast('Approval Work Flow updated successfully.','success');

        return redirect(route('approvalWorkFlows.index'));
    }

    /**
     * Remove the specified ApprovalFlow from storage.
     *
     * @param int $id
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(int $id): RedirectResponse
    {
        $approvalWorkFlow = $this->approvalWorkFlowRepository->find($id);

        if (empty($approvalWorkFlow)) {
            Alert::error('Approval Work Flow not found');

            return redirect(route('approvalWorkFlows.index'));
        }

        $this->approvalWorkFlowRepository->delete($id);

        Alert::success('Approval Work Flow deleted successfully.');

        return redirect(route('approvalWorkFlows.index'));
    }
}

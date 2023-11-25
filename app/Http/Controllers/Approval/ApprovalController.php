<?php

namespace App\Http\Controllers\Approval;


use App\Events\ApprovalActionCreated;
use App\Http\Requests\Approval\CreateApprovalRequest;
use App\Http\Requests\Approval\UpdateApprovalRequest;
use App\Models\Approval\Approval;
use App\Models\Approval\ApprovalHistory;
use App\Repositories\Approval\ApprovalRepository;
use App\Services\ApprovalService;
use App\Http\Controllers\AppBaseController;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\Relation as EloquentRelation;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class ApprovalController extends AppBaseController
{
    public function __construct(
        protected ApprovalService $approvalService)
    {
        $this->middleware('auth');
    }

    /**
     * Apply query scopes.
     */
    protected function applyScopes(
        EloquentBuilder|QueryBuilder|EloquentRelation|Collection|AnonymousResourceCollection $query
    ): EloquentBuilder|QueryBuilder|EloquentRelation|Collection|AnonymousResourceCollection {
        foreach ($this->scopes as $scope) {
            $scope->apply($query);
        }

        return $query;
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $approvals = Approval::query();

        return $approvals;
    }
    /**
     * Display a listing of the Approval.
     *
     * @return View
     */

    public function index(): View
    {
        $approvals = Approval::select('approvals.*')->get();
        //need approval by me
//        if ($this->getApprovalFilter() == 1) {
//            $approvals->where('approvals.is_approved', '=', false)
//                ->whereIn('approvals.current_approval_role_id', Auth::user()->roles->pluck('id'));
//        }
        //al ready approved by me
//        if ($this->getApprovalFilter() == 2) {
//            $approvals->join('approval_histories', 'approval_histories.approval_id', '=', 'approvals.id')
//                ->where('approvals.is_approved', '=', true)
//                ->whereIn('approval_histories.role_id', Auth::user()->roles->pluck('id'));
//        }
        return view('approvals.index', compact('approvals'));
    }

    /**
     * Filter a listing of the Approval.
     *filterId ->1, needs approve by me,
     * filterId ->2, already approved by me
     * filterId ->0, all approvals
     * @param int $filterId
     * @return View
     */
    public function filter(int $filterId = null)
    {
        $this->approvalService->setApprovalFilter($filterId);
        $this->approvalService->limit = 20;

        if($filterId == 2) {
            $this->approvalService->joins = ['approval_histories' => ['approval_histories.approval_id','=','approvals.id']];
        }


        $approvals = $this->approvalService->findAll();

        return view('approvals.index', compact('approvals'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return RedirectResponse
     * @internal param FormRequest $request
     * @internal param ApprovalDataTable $approvalDataTable
     */

    public function approve($id, Request $request)
    {
        /*
         * Expected inputs from user
         {
            "_token": "EYNR1jeBnmGudEzDOKsXeDBvyLRheT1udcoTiKvs",
            "action": "approve",
            "comment": "er"
         }
        */
        $input = $request->all();
        $this->approvalService->setApprovalId($id);
        $this->approvalService->setInputs($input);
        $this->approvalService->approve();

        Alert::toast('Approval saved successfully.','success');
        return redirect()->back();

    }

    /**
     * Show the form for creating a new Approval.
     *
     * @return Response
     */
    public function create()
    {
        return view('approvals.create');
    }

    /**
     * Store a newly created Approval in storage.
     *
     * @param CreateApprovalRequest $request
     *
     * @return Response
     */
    public function store(CreateApprovalRequest $request)
    {
        $input = $request->all();

        $approval = $this->approvalRepository->create($input);

        Flash::success('Approval saved successfully.');

        return redirect(route('approvals.index'));
    }

    /**
     * Display the specified Approval.
     *
     * @param int $id
     *
     * @return RedirectResponse | View
     */
    public function show(int $id): RedirectResponse | View
    {
        $approval = $this->approvalRepository->find($id);

        if (empty($approval)) {
            Alert::error('Not Found','Approval not found');
            //redirect to approvals which need my approval
            return redirect(route('approvals.filter', 1));
        }

        $approvable = $approval->approvable;
        $approvalHistories = $approval->approvalHistories;

        return view('approvals.show', compact('approvable', 'approval', 'approvalHistories'));
    }

    /**
     * Show the form for editing the specified Approval.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $approval = $this->approvalRepository->findWithoutFail($id);

        if (empty($approval)) {
            Flash::error('Approval not found');

            return redirect(route('approvals.index'));
        }

        return view('approvals.edit')->with('approval', $approval);
    }

    /**
     * Update the specified Approval in storage.
     *
     * @param  int $id
     * @param UpdateApprovalRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateApprovalRequest $request)
    {
        $approval = $this->approvalRepository->findWithoutFail($id);

        if (empty($approval)) {
            Flash::error('Approval not found');

            return redirect(route('approvals.index'));
        }

        $approval = $this->approvalRepository->update($request->all(), $id);

        Flash::success('Approval updated successfully.');

        return redirect(route('approvals.index'));
    }

    /**
     * Remove the specified Approval from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $approval = $this->approvalRepository->findWithoutFail($id);

        if (empty($approval)) {
            Flash::error('Approval not found');

            return redirect(route('approvals.index'));
        }

        $this->approvalRepository->delete($id);

        Flash::success('Approval deleted successfully.');

        return redirect(route('approvals.index'));
    }
}

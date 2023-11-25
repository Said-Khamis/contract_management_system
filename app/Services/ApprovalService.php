<?php

namespace App\Services;

use App\Enums\ApprovalStatus;
use App\Events\ApprovalActionCreated;
use App\Models\Approval\ApprovalHistory;
use App\Models\Requisition\GoodRequisition;
use App\Repositories\Approval\ApprovalRepository;
use App\Traits\FilterPropertiesTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class ApprovalService
{
    use FilterPropertiesTrait;

    private int $filterId, $approvalId;
    private array $input=[];

    /**
     * @param int $filterId
     */
    public function __construct(protected ApprovalRepository $approvalRepository){}

    public function findAll(){
        $approvals = $this->approvalRepository->all($this->getSearchFilter(),null, $this->limit,['*'],$this->joins);
        //$approvals = Approval::select('approvals.*');

        if ($this->getApprovalFilter() == 1) {
            $approvals->where('is_approved', '=', 0)
                ->whereIn('current_approval_role_id', Auth::user()->roles->pluck('id'))
                ->where('status', '!=', ApprovalStatus::STATUS_REJECTED->value);
            //dd(ApprovalStatus::STATUS_REJECTED->value);
        }
//        //already approved by me
        if ($this->getApprovalFilter() == 2) {
            $approvals
                ->where('approvals.is_approved', '=', true)
                ->whereIn('approval_histories.role_id', Auth::user()->roles->pluck('id'));
        }
       // dd($approvals);
        return $approvals;
    }

    public function approve(){
        //begin transaction
        DB::beginTransaction();
        try {
            $approval = $this->approvalRepository->find($this->approvalId);

            if (empty($approval)) {
                Alert::error('Not Found','Approval not found');

                //redirect to approvals which need my approval
                return redirect(route('approvals.filter', 1));
            }

            ApprovalHistory::create([
                'is_approved' => $this->input['action'] == 'approve' ? true : false,
                'comment' => $this->input['comment'],
                'approved_by' => Auth::user()->id,
                'approval_id' => $approval->id,
                'role_id' => $approval->current_approval_role_id,
            ]);

            //refresh approval
            $approval = $this->approvalRepository->find($approval->id);
            if (!$approval->isApproved() && !$approval->isRejected()) {
                $approval->updateCurrentApprovers();
            }

            elseif ($approval->isApproved() && !$approval->isRejected()) {
                $approval->update(['is_approved' => true, 'status' => ApprovalStatus::STATUS_APPROVED->value]);
                $approval->approvable->update(['is_approved' =>true, 'status' => GoodRequisition::$STATUS_FULFILLED]);

            }

            elseif ($approval->isRejected()) {
                $approval->update(['status' => ApprovalStatus::STATUS_REJECTED->value]);
                $approval->approvable->update(['status' => GoodRequisition::$STATUS_REJECTED]);
            }


        } catch (ModelNotFoundException $e) {
            DB::rollback();
            //dd(get_class_methods($e)); // lists all available methods for exception object
            Log::info("fail to approval history: " . print_r(get_class_methods($e), true));

        }
        DB::commit();

        if ($approval->isApproved()) {
            event(new ApprovalActionCreated($approval));
        } elseif ($approval->isRejected()) {
            //if it is disapproved any time
            event(new ApprovalActionCreated($approval));
        }
    }

    public function setApprovalFilter($filterId): void
    {
        $this->filterId = $filterId;
    }
    public function getApprovalFilter(): int
    {
        return $this->filterId;
    }
    public function setApprovalId($approvalId): void
    {
        $this->approvalId = $approvalId;
    }
    public function getApprovalId(): int
    {
        return $this->approvalId;
    }
    public function setInputs($inputs): void
    {
        $this->input = $inputs;
    }
    public function getInputs(): array
    {
        return $this->input;
    }
}

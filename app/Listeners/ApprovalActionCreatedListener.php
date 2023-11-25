<?php

namespace App\Listeners;

use App\Events\ApprovalActionCreated;
use App\Models\Procurement\PurchaseOrder;
use App\Models\Requisition\CheckList;
use App\Models\Requisition\GoodRequisition;
use App\Models\Requisition\JobCard;
use App\Repositories\Procurement\PurchaseOrderRepository;
use App\Repositories\Requisition\JobCardRepository;

class ApprovalActionCreatedListener
{
    protected $jobCardRepository;

    /**
     * Create the event listener.
     * @param JobCardRepository $jobCardRepository
     */
    public function __construct(JobCardRepository $jobCardRepository)
    {
        $this->jobCardRepository = $jobCardRepository;
    }

    /**
     * Handle the event.
     *
     * @param  ApprovalActionCreated $event
     */
    public function handle(ApprovalActionCreated $event){
        $approval = $event->approval;

        if ($approval->approvable instanceof PurchaseOrder)
            $approval->approvable->onPurchaseOrderApproval($approval);

        elseif ($approval->approvable instanceof GoodRequisition)
            $approval->approvable->onGoodRequisitionApproval($approval);

        elseif ($approval->approvable instanceof CheckList)
            $approval->approvable->onCheckListApproval($approval);

        elseif ($approval->approvable instanceof JobCard)
            $approval->approvable->onJobCardApproval($approval);
    }
}

<?php

namespace App\Models\Approval;

use App\Models\Approval\Approval;
use App\Models\Approval\ApprovalGroup;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="ApprovalFlow",
 *      required={"name"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="rank",
 *          description="rank",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="created_by",
 *          description="created_by",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="updated_by",
 *          description="updated_by",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="approval_id",
 *          description="approval_id",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class ApprovalWorkFlow extends BaseModel
{
    use SoftDeletes;

    public $table = 'approval_work_flows';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'type',
        'rank',
        'is_enabled',
        'is_auto_approve',
        'description',
        'created_by',
        'updated_by',
        'approval_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'type' => 'string',
        'rank' => 'integer',
        'is_enabled' => 'boolean',
        'is_auto_approve' => 'boolean',
        'description' => 'string',
        'created_by' => 'integer',
        'updated_by' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|max:100|min:3',
        'type' => 'required|max:100|min:3'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function approvals()
    {
        return $this->belongsToMany(Approval::class, 'approval_approval_work_flow', 'approval_id',
            'approval_work_flow_id')->withTimeStamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function approvalGroups()
    {
        return $this->belongsToMany(ApprovalGroup::class, 'approval_work_flow_approval_group', 'approval_work_flow_id',
            'approval_group_id')->withTimeStamps();
    }

    /**
     * all roles required to approve in this current workflow
     */
    public function getRolesRequiredToApprove()
    {
        $roles = $this->approvalGroups->flatMap(function ($approvalGroup) {
            return $approvalGroup->roles;
        });

        return $roles;
    }

    public static function getCheckListApprovalWorkFlows()
    {
        return self::where('type', '=', approvalWorkFlowTypeCheckList())
            ->where('is_enabled', '=', true)->get();
    }

    public static function getJobCardApprovalWorkFlows()
    {
        return self::where('type', '=', approvalWorkFlowTypeJobCard())
            ->where('is_enabled', '=', true)->get();
    }
    public static function getRequisitionApprovalWorkFlows()
    {
        return self::where('type', '=', approvalWorkFlowTypeRequisition())
            ->where('is_enabled', '=', true)->get();
    }

    public static function getPurchaseOrderApprovalWorkFlows()
    {
        return self::where('type', '=', approvalWorkFlowTypePurchaseOrder())
            ->where('is_enabled', '=', true)->get();
    }

    public function getFirstGroup()
    {
        $sortedGroups = $this->approvalGroups->sortBy("rank");
        if ($sortedGroups->isNotEmpty()) {
            return $sortedGroups->first();
        } else {
            abort(404, "Approval groups not found, contact administrator for assistance");
        }
    }

    public function getNextApprovalGroup($currentApprovalGroup)
    {
        //remove current approving group from flow groups
        $nextApprovalGroups = $this->approvalGroups->filter(function ($approvalGroup) use ($currentApprovalGroup) {
            return $approvalGroup->id != $currentApprovalGroup->id;
        });
        //get next group within the flow
        if ($nextApprovalGroups->isNotEmpty()) {
            return $nextApprovalGroups->sortBy("rank")->first();
        } else {
            return null;
        }
    }
}

<?php

namespace App\Models\Approval;

use App\Models\Approval\ApprovalHistory;
use App\Models\Approval\ApprovalWorkFlow;
use App\Models\BaseModel;
use App\Models\Common\Role;
use App\Models\Employee;
use App\Models\User;
use Eloquent as Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * @SWG\Definition(
 *      definition="Approval",
 *      required={"status"},
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
 *          property="is_approved",
 *          description="is_approved",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="status",
 *          description="status",
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
 *      )
 * )
 *
 *
 * |-------------------------|
 * |        Approval         |
 * |  |------|   |------|    |
 * |  |Flow1 |   |Flow2 |    |
 * |  |G1G2  |   |G3G4  |    |
 * |  |------|   |------|    |
 * |-------------------------|
 *
 */
class Approval extends BaseModel
{
    use SoftDeletes;

    public $table = 'approvals';


    protected $dates = ['deleted_at'];


    public static string $STATUS_APPROVED = "approved";
    public static string $STATUS_REJECTED = "rejected";
    public static string $STATUS_WAITING_FOR_APPROVAL = "waiting for approval";


    public $fillable = [
        'is_approved',
        'status',
        'created_by',
        'updated_by',
        'current_approval_work_flow_id',
        'current_approval_group_id',
        'current_approval_role_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_approved' => 'boolean',
        'status' => 'string',
        'created_by' => 'integer',
        'updated_by' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'status' => 'required|max:100|min:3'
    ];


    /**
     * @return HasMany
     **/
    public function approvalHistories(): HasMany
    {
        return $this->hasMany(ApprovalHistory::class);
    }

    /**
     * @return MorphTo
     **/

    public function approvable()
    {
        return $this->morphTo();
    }

    /**
     * @return BelongsToMany
     **/
    public function approvalWorkFlows()
    {
        return $this->belongsToMany(ApprovalWorkFlow::class, 'approval_approval_work_flow', 'approval_id',
            'approval_work_flow_id')->withTimestamps();
    }


    public function addApprovalWorkFlow($approvalWorkFlows)
    {
        foreach ($approvalWorkFlows as $approvalWorkFlow) {
            $this->approvalWorkFlows()->attach($approvalWorkFlow);
        }

        //update current role,group and flow required to approve now
        $this->updateCurrentApprovers();
    }

    /**
     * @return BelongsTo
     **/
    public function currentApprovalWorkFlow(): BelongsTo
    {
        return $this->belongsTo(ApprovalWorkFlow::class, 'current_approval_work_flow_id');
    }

    /**
     * @return BelongsTo
     **/
    public function currentApprovalGroup(): BelongsTo
    {
        return $this->belongsTo(ApprovalGroup::class, 'current_approval_group_id');
    }

    /**
     * @return BelongsTo
     **/
    public function currentApprovalRole(): BelongsTo
    {
        return $this->belongsTo(\Spatie\Permission\Models\Role::class, 'current_approval_role_id');
    }

    /**
     * detect if approval process complete
     */
    public function isApproved(): bool
    {
        return $this->is_approved || $this->allRolesHaveApproved();
    }

    /**
     * detect if approval  rejected
     */
    public function isRejected()
    {
        $approvalHistories = $this->approvalHistories->filter(function ($approvalHistory) {
            return $approvalHistory->is_approved == false;
        });

        return $approvalHistories->isNotEmpty();
    }

    public function allRolesHaveApproved()
    {
        $remainingRoles = $this->getRolesRequiredToApprove()->pluck('id')->diff($this->approvedRoles()->pluck('id'));
        return $remainingRoles->isEmpty();
    }

    /**
     * all roles required to approve in this current workflow
     */
    public function getRolesRequiredToApprove()
    {
        $roles = $this->approvalWorkFlows->flatMap(function ($approvalWorkFlow) {
            return $approvalWorkFlow->getRolesRequiredToApprove();
        });

        return $roles;
    }

    /**
     * get all roles that have been approved so far
     */
    public function approvedRoles()
    {
        $roles = $this->approvalHistories->map(function ($approvalHistory) {
            return $approvalHistory->role;
        });

        return $roles;
    }

    public function updateCurrentApprovers()
    {
        //begin transaction
        DB::beginTransaction();
        try {

            $approvedRoles = $this->approvedRoles();
            if ($approvedRoles->isEmpty()) {

                $firstApprovalWorkFlow = $this->getFirstWorkFlow();

                if (is_null($this->currentApprovalWorkFlow))
                    $this->setCurrentApprovalWorkFlow($firstApprovalWorkFlow);

                if (is_null($this->currentApprovalGroup))
                    $this->setCurrentApprovalGroup($firstApprovalWorkFlow->getFirstGroup());

                if (is_null($this->currentApprovalRole)) {
                    $firstApprovalRole = $firstApprovalWorkFlow->getFirstGroup()->getFirstRole();
                    $this->setCurrentApprovalRole($firstApprovalRole);
                }
            }
            else {
                $nextApprovalRole = $this->currentApprovalGroup->getNextApprovalRole($approvedRoles);
                if (!is_null($nextApprovalRole))
                    $this->setCurrentApprovalRole($nextApprovalRole);

                else {
                    $nextApprovalGroup = $this->currentApprovalWorkFlow->getNextApprovalGroup($this->currentApprovalGroup);

                    if (!is_null($nextApprovalGroup))
                        $this->setCurrentApprovalGroup($nextApprovalGroup);

                    else {
                        $nextApprovalWorkFlow = $this->getNextApprovalWorkFlow();
                        if (!is_null($nextApprovalWorkFlow))
                            $this->setCurrentApprovalWorkFlow($nextApprovalWorkFlow);

                        else
                            //todo all approval flow have been finished, u may fire event to notify
                            notefy();
                    }
                }
            }
        }
        catch (ModelNotFoundException $e) {
            DB::rollback();
            //dd(get_class_methods($e)); // lists all available methods for exception object
            Log::info("fail to approval history: " . print_r(get_class_methods($e), true));
        }

        DB::commit();
    }

    public function getFirstWorkFlow()
    {
        $sortedWorkFlows = $this->approvalWorkFlows->sortBy("rank");
        if ($sortedWorkFlows->isNotEmpty()) {
            return $sortedWorkFlows->first();
        } else {
            abort(404, "Approval work flows not found, contact administrator for assistance");
        }
    }

    public function setCurrentApprovals($approvalFlow, $approvalGroup, $approvalRole)
    {
        $this->setCurrentApprovalWorkFlow($approvalFlow);
        $this->setCurrentApprovalGroup($approvalGroup);
        $this->setCurrentApprovalRole($approvalRole);
    }

    public function setCurrentApprovalWorkFlow($approvalWorkFlow)
    {
        $this->currentApprovalWorkFlow()->associate($approvalWorkFlow);
        $this->save();
    }

    public function setCurrentApprovalGroup($approvalGroup)
    {
        $this->currentApprovalGroup()->associate($approvalGroup);
        $this->save();
    }

    public function setCurrentApprovalRole($approvalRole)
    {
        $this->currentApprovalRole()->associate($approvalRole);
        $this->save();
    }

    private function getNextApprovalWorkFlow()
    {
        //remove current approving flow
        $nextApprovalWorkFlows = $this->approvalWorkFlows->filter(function ($approvalWorkFlow) {
            return $approvalWorkFlow->id != $this->currentApprovalWorkFlow->id;
        });
        //get next work flow
        if ($nextApprovalWorkFlows->isNotEmpty()) {
            return $nextApprovalWorkFlows->sortBy("rank")->first();
        } else {
            return null;
        }
    }

    public function getCurrentApproverAttribute(){
        if($this->isApproved())
            return "All Approved";
        else
            return \Spatie\Permission\Models\Role::find($this->current_approval_role_id)->name;
    }
    public function getCreatorAttribute(){
        return User::find($this->created_by)->name;
    }


}

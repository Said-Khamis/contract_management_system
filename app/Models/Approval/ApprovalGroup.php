<?php

namespace App\Models\Approval;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Role;

/**
 * @SWG\Definition(
 *      definition="ApprovalGroup",
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
 *      )
 * )
 */
class ApprovalGroup extends BaseModel
{
    use SoftDeletes;

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|max:100|min:3'
    ];
    public $table = 'approval_groups';
    public $fillable = [
        'name',
        'rank',
        'description',
        'created_by',
        'updated_by'
    ];
    protected $dates = ['deleted_at'];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'rank' => 'integer',
        'description' => 'string',
        'created_by' => 'integer',
        'updated_by' => 'integer'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'approval_group_role', 'approval_group_id',
            'role_id')->withTimeStamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function approvalFlows()
    {
        return $this->belongsToMany(ApprovalWorkFlow::class, 'approval_work_flow_approval_group', 'approval_work_flow_id',
            'approval_group_id')->withTimeStamps();
    }

    public function getFirstRole()
    {
        $sortedRoles = $this->roles->sortBy("rank");
        if ($sortedRoles->isNotEmpty()) {
            return $sortedRoles->first();
        } else {
            abort(404, "Group roles not found, contact administrator for assistance");
        }
    }

    public function getNextApprovalRole($approvedRoles)
    {
        $remainRoles = $this->roles->diff($approvedRoles);
        if ($remainRoles->isNotEmpty()) {
            return $remainRoles->sortBy("rank")->first();
        } else {
            return null;
        }
    }
}

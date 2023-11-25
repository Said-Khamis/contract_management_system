<?php

namespace App\Repositories\Approval;

use App\Models\Approval\Approval;
use App\Repositories\BaseRepository;

//use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ApprovalRepository
 * @package App\Repositories\Inventory
 * @version August 16, 2017, 8:51 pm UTC
 *
 * @method Approval findWithoutFail($id, $columns = ['*'])
 * @method Approval find($id, $columns = ['*'])
 * @method Approval first($columns = ['*'])
 */
class ApprovalRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected array $fieldSearchable = [
        'status',
        'is_approved',
    ];

    protected array $tableJoinable = [
        'approval_histories'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Approval::class;
    }

    /**
     * @param $model
     * @param $modelApprovalWorkFlow
     */
    public function attachApprovalProcess($model, $modelApprovalWorkFlow)
    {

        $approval = new Approval([
            'status' => Approval::$STATUS_WAITING_FOR_APPROVAL,
        ]);
        $model->approval()->save($approval);
        $approval->addApprovalWorkFlow($modelApprovalWorkFlow);

    }

    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    public function getTablesJoinable(): array
    {
        return $this->tableJoinable;
    }
}

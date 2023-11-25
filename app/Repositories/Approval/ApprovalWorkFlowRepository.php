<?php

namespace App\Repositories\Approval;

use App\Models\Approval\ApprovalWorkFlow;
use App\Repositories\BaseRepository;

/**
 * Class ApprovalFlowRepository
 * @package App\Repositories\Inventory
 * @version August 16, 2017, 8:53 pm UTC
 *
 * @method ApprovalWorkFlow findWithoutFail($id, $columns = ['*'])
 * @method ApprovalWorkFlow find($id, $columns = ['*'])
 * @method ApprovalWorkFlow first($columns = ['*'])
*/
class ApprovalWorkFlowRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'type',
        'description'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ApprovalWorkFlow::class;
    }

    public function getFieldsSearchable()
    {
        // TODO: Implement getFieldsSearchable() method.
    }

    public function getTablesJoinable()
    {
        // TODO: Implement getTablesJoinable() method.
    }
}

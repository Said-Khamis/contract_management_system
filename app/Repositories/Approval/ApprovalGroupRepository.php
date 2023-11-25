<?php

namespace App\Repositories\Approval;

use App\Models\Approval\ApprovalGroup;
use App\Repositories\BaseRepository;

/**
 * Class ApprovalGroupRepository
 * @package App\Repositories\Inventory
 * @version August 16, 2017, 8:54 pm UTC
 *
 * @method ApprovalGroup findWithoutFail($id, $columns = ['*'])
 * @method ApprovalGroup find($id, $columns = ['*'])
 * @method ApprovalGroup first($columns = ['*'])
*/
class ApprovalGroupRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ApprovalGroup::class;
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

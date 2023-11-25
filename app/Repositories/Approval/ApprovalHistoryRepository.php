<?php

namespace App\Repositories\Approval;

use App\Models\Approval\ApprovalHistory;
use App\Repositories\BaseRepository;

/**
 * Class ApprovalHistoryRepository
 * @package App\Repositories\Inventory
 * @version August 16, 2017, 8:55 pm UTC
 *
 * @method ApprovalHistory findWithoutFail($id, $columns = ['*'])
 * @method ApprovalHistory find($id, $columns = ['*'])
 * @method ApprovalHistory first($columns = ['*'])
*/
class ApprovalHistoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'comment'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ApprovalHistory::class;
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

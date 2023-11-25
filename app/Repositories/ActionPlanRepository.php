<?php

namespace App\Repositories;

use App\Models\ActionPlan;
use App\Repositories\BaseRepository;

/**
 * Class ActionPlanRepository
 * @package App\Repositories
 * @version June 9, 2023, 1:51 pm UTC
*/

class ActionPlanRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'file',
        'contract_id',
        'created_by',
        'updated_by'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ActionPlan::class;
    }
}

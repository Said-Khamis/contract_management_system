<?php

namespace App\Repositories;

use App\Models\ContractObjective;
use App\Repositories\BaseRepository;

/**
 * Class ContractObjectiveRepository
 * @package App\Repositories
 * @version June 3, 2023, 1:24 pm UTC
*/

class ContractObjectiveRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'details',
        'contract_id',
        'created_by',
        'updated_by',
        'contract_objective_id'
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
        return ContractObjective::class;
    }



}

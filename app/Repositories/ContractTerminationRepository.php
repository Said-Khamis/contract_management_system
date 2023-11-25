<?php

namespace App\Repositories;

use App\Models\ContractTermination;
use App\Repositories\BaseRepository;

/**
 * Class ContractTerminationRepository
 * @package App\Repositories
 * @version June 12, 2023, 6:19 pm UTC
*/

class ContractTerminationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'date_of_termination',
        'reasons',
        'attachement_id',
        'created_by',
        'updated_by',
        'contract_id'
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
        return ContractTermination::class;
    }
}

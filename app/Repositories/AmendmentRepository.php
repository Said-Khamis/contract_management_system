<?php

namespace App\Repositories;

use App\Models\Amendment;
use App\Repositories\BaseRepository;

/**
 * Class AmendmendRepository
 * @package App\Repositories
 * @version June 12, 2023, 6:26 pm UTC
*/

class AmendmentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'date_of_amendment',
        'reasons',
        'attachement_id',
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
        return Amendment::class;
    }
}

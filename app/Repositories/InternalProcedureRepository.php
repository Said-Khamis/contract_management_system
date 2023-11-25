<?php

namespace App\Repositories;

use App\Models\InternalProcedure;
use App\Repositories\BaseRepository;

/**
 * Class InternalProcedureRepository
 * @package App\Repositories
 * @version September 23, 2023, 10:40 am UTC
*/

class InternalProcedureRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'procedurable_type',
        'procedurable_id',
        'from_institution_id',
        'to_institution_id',
        'status',
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
        return InternalProcedure::class;
    }
}

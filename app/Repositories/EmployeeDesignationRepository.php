<?php

namespace App\Repositories;

use App\Models\EmployeeDesignation;
use App\Repositories\BaseRepository;

/**
 * Class EmployeeDesignationRepository
 * @package App\Repositories
 * @version June 13, 2023, 5:24 pm UTC
*/

class EmployeeDesignationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'employee_id',
        'designation_id',
        'active',
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
        return EmployeeDesignation::class;
    }
}

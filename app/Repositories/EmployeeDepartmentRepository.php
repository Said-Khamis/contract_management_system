<?php

namespace App\Repositories;

use App\Models\EmployeeDepartment;
use App\Repositories\BaseRepository;

/**
 * Class EmployeeDepartmentRepository
 * @package App\Repositories
 * @version June 3, 2023, 12:49 pm UTC
*/

class EmployeeDepartmentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'department_id',
        'employee_id',
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
        return EmployeeDepartment::class;
    }
}

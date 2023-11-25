<?php

namespace App\Repositories;

use App\Models\Designation;
use App\Repositories\BaseRepository;

/**
 * Class DesignationRepository
 * @package App\Repositories
 * @version June 3, 2023, 12:36 pm UTC
*/

class DesignationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'institution_id',
        'description',
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
        return Designation::class;
    }

    public function getDesignationsByInstitutionId($institutionId)
    {
        return $this->model->where('institution_id', $institutionId)->get();
    }
}

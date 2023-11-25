<?php

namespace App\Repositories;

use App\Models\ContractOperationArea;
use App\Repositories\BaseRepository;

/**
 * Class ContractOperationAreaRepository
 * @package App\Repositories
 * @version June 3, 2023, 1:31 pm UTC
*/

class ContractOperationAreaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'details',
        'contract_id',
        'contract_operation_area_id',
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
        return ContractOperationArea::class;
    }
}

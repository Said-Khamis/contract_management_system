<?php

namespace App\Repositories;

use App\Models\GeneralStatus;
use App\Repositories\BaseRepository;

/**
 * Class GeneralStatusRepository
 * @package App\Repositories
 * @version October 17, 2023, 4:07 pm UTC
*/

class GeneralStatusRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected array $fieldSearchable = [
        'contract_id',
        'created_by',
        'updated_by',
        'area',
        'comment',
        'percent'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model(): string
    {
        return GeneralStatus::class;
    }
}

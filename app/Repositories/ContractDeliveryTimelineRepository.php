<?php

namespace App\Repositories;

use App\Models\ContractDeliveryTimeline;
use App\Repositories\BaseRepository;

/**
 * @package App\Repositories
 * @version June 3, 2023, 1:31 pm UTC
*/

class ContractDeliveryTimelineRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'details',
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
        return ContractDeliveryTimeline::class;
    }
}

<?php

namespace App\Repositories;

use App\Models\ContractNotice;
use App\Repositories\BaseRepository;

/**
 * Class ContractNoticeRepository
 * @package App\Repositories
 * @version June 3, 2023, 1:55 pm UTC
*/

class ContractNoticeRepository extends BaseRepository
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
        return ContractNotice::class;
    }
}

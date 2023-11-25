<?php

namespace App\Repositories;

use App\Models\Attachment;
use App\Repositories\BaseRepository;

/**
 * Class AttachmentRepository
 * @package App\Repositories
 * @version June 3, 2023, 1:50 pm UTC
*/

class AttachmentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'description',
        'url',
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
        return Attachment::class;
    }
}

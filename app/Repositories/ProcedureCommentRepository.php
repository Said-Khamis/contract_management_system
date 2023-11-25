<?php

namespace App\Repositories;

use App\Models\ProcedureComment;
use App\Repositories\BaseRepository;

/**
 * Class ProcedureCommentRepository
 * @package App\Repositories
 * @version September 23, 2023, 10:53 am UTC
*/

class ProcedureCommentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'internal_procedure_id',
        'from_user_id',
        'to_user_id',
        'comment',
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
        return ProcedureComment::class;
    }
}

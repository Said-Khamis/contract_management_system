<?php

namespace App\Repositories;

use App\Models\Ward;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class WardRepository
 * @package App\Repositories
 * @version June 3, 2023, 12:16 pm UTC
*/

class WardRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'district_id',
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
    public function model(): string
    {
        return Ward::class;
    }

    public function getWards(): Collection
    {
        return Ward::all();
    }
}

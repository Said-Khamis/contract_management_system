<?php

namespace App\Repositories;

use App\Models\State;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class StateRepository
 * @package App\Repositories
 * @version June 3, 2023, 12:05 pm UTC
*/

class StateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'country_id'
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
        return State::class;
    }

    public function getStates(): Collection
    {
        return State::all();
    }
}

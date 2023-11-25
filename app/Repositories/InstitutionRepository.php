<?php

namespace App\Repositories;

use App\Models\Institution;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class InstitutionRepository
 * @package App\Repositories
 * @version June 7, 2023, 12:59 pm UTC
*/

class InstitutionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'abbreviation',
        'institution_id',
        'is_local',
        'is_sector',
        'created_by',
        'updated_by'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable(){
        return $this->fieldSearchable;
    }

    public function getLocal(){
        return Institution::where('is_local', true)->get()->pluck('name', 'id');
    }

    public function getSectors(){
        return Institution::where('is_sector', true)->get();
    }

    /**
     * Configure the Model
     **/
    public function model() {
        return Institution::class;
    }

    public function getLocalInstitutions(){
        return Institution::orderByDesc("created_at")
            ->get();
    }

    public function getInstituteWithParent($childId) {
        return Institution::with('parent')
            ->with("createdByUser")
            ->with("updatedByUser")
            ->find($childId);
    }
}

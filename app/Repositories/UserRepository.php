<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Class CityRepository
 * @package App\Repositories
 * @version June 3, 2023, 12:07 pm UTC
*/

class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected array $fieldSearchable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'institution_id',
        'is_active',
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
        return User::class;
    }

    public function findAllUsers(int $id = null): Collection|array
    {
        $query = User::with(['roles', 'permissions', 'designation.department', 'institution']);

        if (!is_null($id))
            $query->where('institution_id', $id);

        return $query->get();
    }

    public function findInstitutionRoles(int $id)
    {
        return \App\Models\Role::where('institution_id', $id)
            ->orWhereNull('institution_id')
            ->whereNot('name', 'super-admin')
            ->orderBy('name')
            ->get();
    }

    public function findInstitutionDepartments(int $id)
    {
        return \App\Models\Department::where('institution_id', $id)
            ->orWhereNull('institution_id')
            ->orderBy('name')
            ->get();
    }

    public function findInstitutionDesignations(int $id)
    {
        return \App\Models\Designation::where('institution_id', $id)
            ->orWhereNull('institution_id')
            ->orderBy('title')
            ->get();
    }
}

<?php

namespace App\Services;

use App\Models\Department;
use App\Models\Designation;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Permission;
use App\Models\Role;
use Throwable;

class UserManagementService
{
    public function __construct(protected UserRepository $userRepository){}

    /**
     * Find all users collection
     *
     * @return Collection|array
     */
    public function findAll(): Collection|array
    {
        if (auth()->user()->can('oversee all')) {
            return $this->userRepository->findAllUsers();
        } else {
            return $this->userRepository->findAllUsers(auth()->user()->institution->id);
        }
    }

    /**
     * Find all Departments
     *
     * @return Collection
     */
    public function findAllDepartments(): Collection
    {
        if (auth()->user()->can('oversee all')) {
            return Department::all();
        } else {
            return $this->userRepository->findInstitutionDepartments(auth()->user()->institution->id);
        }
    }

    /**
     * Find all Designations
     *
     * @return Collection
     */
    public function findAllDesignations(): Collection
    {
        if (auth()->user()->can('oversee all')) {
            return Designation::all();
        } else {
            return $this->userRepository->findInstitutionDesignations(auth()->user()->institution->id);
        }
    }

    /**
     * Find all roles
     *
     * @return Collection
     */
    public function findAllRoles(): Collection
    {
        if (auth()->user()->can('oversee all')) {
            return Role::all();
        } else {
            return $this->userRepository->findInstitutionRoles(auth()->user()->institution->id);
        }
    }

    /**
     * Find Grouped permissions
     * @return Collection
     */
    public function findAllGroupedPermissions(): Collection
    {
        return Permission::all()->groupBy('group');
    }

    /**
     * Find Ungrouped permissions
     * @return Collection
     */
    public function findAllPermissions(): Collection
    {
        return Permission::all();
    }

    /**
     * Find permissions by group name
     *
     * @param string $groupName
     * @return Collection
     */
    public function findPermissionsByGroup(string $groupName): Collection
    {
        return Permission::findByGroup($groupName);
    }

    /**
     * find single user
     * @param int|string $userId
     * @return Model|null
     */
    public function getUser(int|string $userId): Model|null
    {
        return $this->userRepository->find($userId);
    }

    public function getUserByEmail(string $email): Collection
    {
        return $this->userRepository->all(['email' => $email]);
    }

    /**
     * find one role
     * @param int $roleId id of role
     * @return Model
     */
    public function getRole(int $roleId): Model
    {
        return Role::find($roleId);
    }

    /**
     * find one permission
     * @param int $permissionId
     * @return Model
     */
    public function getPermission(int $permissionId): Model
    {
        return Permission::find($permissionId);
    }

    /**
     * @throws Exception
     * @throws Throwable
     */
    public function createUser(array $input): void
    {
        DB::beginTransaction();
        try {
            $input['password'] = Hash::make('password');
            $input['created_by'] = Auth::user()->id;
            $input['institution_id'] = decode($input['institution_id']);

            $user = $this->userRepository->create($input);
            $user->assignRole(Role::findById(decode($input['role'])));
            event(new Registered($user));

        } catch (Exception $e){
            DB::rollBack();
            throw $e;
        }

        DB::commit();
    }

    /**
     * create new role
     * @throws Exception|Throwable
     */
    public function createRole(array $input): void
    {
        DB::beginTransaction();
        try {
            $role = new Role(['name' => $input['name'], 'institution_id' => decode($input['institution_id'])]);
            $role->save();
            if( array_key_exists('permissions',$input)){
                $role->givePermissionTo($input['permissions']);
            }

        }
        catch (Exception $e){
            DB::rollBack();
            throw $e;
        }
        DB::commit();
    }

    /**
     * Create permission
     *
     * @param array $input user input array
     * @throws Exception|Throwable
     */
    public function createPermission(array $input): void
    {
        DB::beginTransaction();
        try {
            $permission = new Permission(['name' => $input['name'], 'group' => $input['group']]);
            $permission->save();
        }
        catch (Exception $e){
            DB::rollBack();
            throw $e;
        }

        DB::commit();
    }

    /**
     * Update User details
     *
     * @param Model $user
     * @param $input
     * @return Model
     * @throws Throwable
     */
    public function updateUser(Model $user, $input): Model
    {
        DB::beginTransaction();
        try {
            $input['updated_by'] = Auth::user()->id;
            $input['institution_id'] = decode($input['institution_id']);
            $user = $this->userRepository->update($input, $user->id);
            $user->syncRoles(Role::findById(decode($input['role'])));
        } catch (Exception $e){
            DB::rollBack();
            throw $e;
        }
        DB::commit();
        return $user;
    }

    /**
     * Block User
     *
     * @param Model $user
     * @return void
     * @throws Throwable
     */
    public function blockUser(Model $user): void
    {
        DB::beginTransaction();
        try {
            $input = [
                'updated_by' => Auth::user()->id,
                'is_active' => false
            ];
            $this->userRepository->update($input, $user->id);
        } catch (Exception $e){
            DB::rollBack();
            throw $e;
        }
        DB::commit();
    }

    /**
     * Unblock User
     *
     * @param Model $user
     * @return void
     * @throws Throwable
     */
    public function unBlockUser(Model $user): void
    {
        DB::beginTransaction();
        try {
            $input = [
                'updated_by' => Auth::user()->id,
                'is_active' => true
            ];
            $this->userRepository->update($input, $user->id);
        } catch (Exception $e){
            DB::rollBack();
            throw $e;
        }
        DB::commit();
    }

    /**
     * @param Model $role
     * @param array $input
     * @return void
     * @throws Throwable
     */
    public function updateRole(Model $role, array $input): void
    {
        DB::beginTransaction();
        try {
            $role->fill($input);
            $role->save();
            $role->syncPermissions($input['permissions']);
        } catch (Exception $e)
        {
            DB::rollBack();
            throw $e;
        }
        DB::commit();
    }
}

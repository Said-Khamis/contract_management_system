<?php

namespace App\Http\Controllers;

use App\Helpers\DataTableHelper;
use App\Models\User;
use App\Services\UserManagementService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\PermissionRegistrar;
use Throwable;

class UserManagementController extends Controller
{
    public function __construct(protected UserManagementService $userManagementService){
        $this->middleware('auth');
    }

    /**
     * @param Request $request
     * @return View|JsonResponse
     * @throws Exception
     */
    public function index(Request $request):View | JsonResponse
    {
        $roles = $this->userManagementService->findAllRoles();
        $users = $this->userManagementService->findAll();
        $permissions = $this->userManagementService->findAllGroupedPermissions();

        if ($request->ajax()) {
            return DataTableHelper::renderUserDataTable($users);
        }

        return view('user.index',compact('users','roles','permissions'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return View
     */
    public function create(): View
    {
        $roles = $this->userManagementService->findAllRoles();
        return view('user.create')->with('roles', $roles);
    }

    public function createRole(): View
    {
        $permissions = $this->userManagementService->findAllGroupedPermissions();
        return view('role_and_permissions.role_create', compact('permissions'));
    }

    public function editRole(string|int $id): View|RedirectResponse
    {
        $id=decode($id);
        $permissions = $this->userManagementService->findAllGroupedPermissions();
        $role = $this->userManagementService->getRole($id);

        if (empty($role)) {
            Alert::error('Role not found');

            return redirect(route('user.role','roles'));
        }
        return view('role_and_permissions.role_edit', compact('role','permissions'));
    }

    /**
     * @param Request $request
     * @param $name
     * @return View|JsonResponse
     * @throws Exception
     */
    public function rolePermission(Request $request, $name): View|JsonResponse
    {
        $roles = $this->userManagementService->findAllRoles();
        $permissions = $this->userManagementService->findAllGroupedPermissions();
        if($name == 'roles') {
                if ($request->ajax()) {
                    return DataTableHelper::renderRoleDataTable($roles);
                }
            return view('role_and_permissions.index',compact('name','roles','permissions'));
        }
        else{
            if ($request->ajax()) {
                return DataTableHelper::renderPermissionDataTable($this->userManagementService->findAllPermissions());
            }
            return view('role_and_permissions.permission',compact('name','permissions','roles'));
        }
    }

    /**
     * @param int $id id primary key id
     * @return RedirectResponse
     */
    public function grantAllPermissionToUser(int $id): RedirectResponse
    {
        $permission = $this->userManagementService->findAllGroupedPermissions()->pluck('name');
        $user = $this->userManagementService->getUser($id);
        $user->givePermissionTo($permission);
        Alert::toast('All Permissions granted to User '.$user->name,'success');
        return redirect()->back();
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function revokeAllPermissionToUser(int $id): RedirectResponse
    {
        $permission = $this->userManagementService->findAllGroupedPermissions()->pluck('name')->all();
        $user = $this->userManagementService->getUser($id);
        $user->revokePermissionTo($permission);

        Alert::toast('All Permissions Revoked to User '.$user->name,'success');
        return redirect()->back();
    }

    /**
     * assign roles to user
     * @param Request $request user request inputs
     * @return RedirectResponse
     */
    public function assignRolesToUser(Request $request): RedirectResponse
    {

        $user = $this->userManagementService->getUser($request->userId);

        $user->syncRoles($request->role);

        Alert::toast('All Selected Roles Assigned to User '.$user->name,'success');
        return redirect()->back();
    }

    /**
     * Assigning permissions to user
     *
     * @param Request $request user request inputs
     * @return RedirectResponse
     */
    public function assignPermissionToUser(Request $request): RedirectResponse
    {

        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $user = $this->userManagementService->getUser($request->userId);
        $user->revokePermissionTo($this->userManagementService->findAllGroupedPermissions()->pluck('name')->all());

        $user->givePermissionTo($request->permissions);
        Alert::toast('All Selected Permissions Granted to User '.$user->name,'success');
        return redirect()->back();
    }

    /**
     * Assign permission to role
     *
     * @param Request $request user input request
     * @return RedirectResponse
     */
    public function assignPermissionToRole(Request $request): RedirectResponse
    {

        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $role = $this->userManagementService->getRole($request->role);
        $role->syncPermissions($request->permissions);

        Alert::toast('All Selected Permissions Granted to Role '.$role->name,'success');

        return redirect()->back();
    }

    /**
     * @throws Exception|Throwable
     */
    public function store(Request $request): RedirectResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, User::$rules, attributes: [
            'designation_id' => 'designation',
            'institution_id' => 'institution',
        ]);

        if ($validator->fails())
        {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $this->userManagementService->createUser($input);
        Alert::toast('User created successful','success');

        return redirect(route('user.index'));
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param string|int $id
     *
     * @return RedirectResponse|View
     */
    public function edit(string|int $id): RedirectResponse|View
    {
        $id=decode($id);
        $user = $this->userManagementService->getUser($id);
        $roles = $this->userManagementService->findAllRoles();

        if (empty($user)) {
            Alert::error('User not found');

            return redirect(route('user.index'));
        }

        return view('user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified User in database.
     *
     * @param string|int $id
     * @param Request $request
     *
     * @return RedirectResponse
     * @throws Throwable
     */
    public function update(string|int $id, Request $request): RedirectResponse
    {
        $id = decode($id);
        $user = $this->userManagementService->getUser($id);

        if (empty($user)) {
            Alert::error('User not found');

            return redirect(route('user.index'));
        }

        $user = $this->userManagementService->updateUser($user, $request->all());

        Alert::toast('User updated successfully.');

        return redirect(route('user.index'));
    }

    /**
     * Display the specified User.
     *
     * @param string|int $id
     *
     * @return RedirectResponse | View
     */
    public function show(string|int $id): View|RedirectResponse
    {
        $id=decode($id);
        $user = $this->userManagementService->getUser($id);

        if (empty($user)) {
            Alert::error('User not found');

            return redirect(route('user.index'));
        }

        return view('user.show', compact('user'));
    }

    /**
     * Display the specified Role.
     *
     * @param string|int $id
     *
     * @return RedirectResponse | View
     */
    public function showRole(string|int $id): View|RedirectResponse
    {
        $id=decode($id);
        $role = $this->userManagementService->getRole($id);

        if (empty($role)) {
            Alert::error('Role not found');

            return redirect(route('user.role', 'roles'));
        }

        return view('role_and_permissions.role_show', compact('role'));
    }

    /**
     * Create role and attach chosen permissions
     *
     * @param Request $request form request data
     * @return RedirectResponse page redirect response
     * @throws Exception|Throwable throwable exception from db transaction
     */
    public function roleCreate(Request $request): RedirectResponse
    {
        $input = $request->all();
        try {
            $this->userManagementService->createRole($input);
            Alert::toast('Role added','success');
        } catch (\Illuminate\Database\QueryException $e)
        {
            Alert::error('Duplicate', 'This role already existing for this particular institute');
            return redirect()->back();
        }
        catch (Exception $e)
        {
            Alert::error('Failed', 'Could not create new role. Please contact System Administrator');
            return redirect()->back();
        }
        return redirect(route('user.role','roles'));
    }

    /**
     * Update role
     *
     * @param Request $request form request data
     * @return RedirectResponse page redirect response
     * @throws Exception|Throwable throwable exception from db transaction
     */
    public function roleUpdate(string|int $id, Request $request): RedirectResponse
    {
        $id=decode($id);
        $input = $request->all();
        $role = $this->userManagementService->getRole($id);

        if (empty($role)) {
            Alert::error('Role not found');

            return redirect(route('user.role','roles'));
        }

        try {
            $this->userManagementService->updateRole($role, $input);
            Alert::toast('Role updated','success');
        } catch (Exception $e)
        {
            Alert::error('Failed', $e->getMessage());
            return redirect()->back();
        }
        return redirect(route('user.role','roles'));
    }

    /**
     * Create permissions from user form request
     *
     * @param Request $request user form request data
     * @return RedirectResponse page redirect response
     * @throws Exception throwable exception from db transaction
     */
    public function permissionCreate(Request $request): RedirectResponse
    {
        $this->userManagementService->createPermission($request->all());
        Alert::toast('Permission Created successful','success');
        return redirect()->back();
    }

    /**
     * Specific user profile account find by id
     * @param string|int $id user id of primary key
     * @return View | RedirectResponse Return type of user profile view or redirect to the previous page on fail
     */
    public function userProfile(string|int $id): View | RedirectResponse
    {
        $id=decode($id);
         $user = $this->userManagementService->getUser($id);
         if(!$user){
             Alert::error('Not found',"User with id $id is not found");
             return back();
         }
         return view('user.profile',compact('user'));
    }

    public function userChangePassword(Request $request){
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|string|min:8|confirmed'
        ]);
        $user = $this->userManagementService->getUser($request->id);
        if(!$user){
            Alert::error('User Not Found');
            return redirect()->back();
        }
        else{
            if(Hash::check($request->old_password, $user->password)){
                $user->password = Hash::make($request->password);
                $user->passwordIsDefault = false;
                $user->save();
                Alert::success('Password Changed successively');
                return redirect()->back();
            }
            else{
                Alert::toast('Ooops! Wrong password try again','error');
                return redirect()->back();
            }
        }
    }

    /**
     * Block or Unblock user depending on their current status.
     *
     * @param string|int $id
     * @return RedirectResponse
     * @throws Throwable
     */
    public function changeUserStatus(string|int $id): RedirectResponse
    {
        $id=decode($id);
        $user = $this->userManagementService->getUser($id);

        if (empty($user)) {
            Alert::error('User not found');
            return redirect(route('user.index'));
        }

        if($user->is_active) {
            $this->userManagementService->blockUser($user);
            Alert::toast('User Blocked successfully.');
        } else {
            $this->userManagementService->unBlockUser($user);
            Alert::toast('User Unblocked successfully.');
        }
        return redirect(route('user.index'));
    }

    public function profile()
    {
        $user = \Auth::user();
        return view('user.user_profile',compact('user'));
    }

    public function profileStore(Request $request)
    {
        $validate = $request->validate([
           'firstName'=>'required',
           'middleName'=>'nullable',
           'lastName'=>'required',
           'email' => [
                'required',
                Rule::unique('users')->ignore(\Auth::id()),
                'email',
           ],
        ]);

        $user = \Auth::user();
        $user->first_name = $request->get('firstName');
        $user->middle_name = $request->get('middleName');
        $user->last_name = $request->get('lastName');
        $user->email = $request->get('email');
        $user->save();

        alert()->success('Success','Profile details updated successfully');
        return redirect()->back();
    }

    public function userProfilePasswordUpdate(Request $request)
    {
        $validate = $request->validate([
           'oldPassword'=>'required',
           'newPassword'=>'required',
           'confirmPassword'=>'required|same:newPassword'
        ]);
        $user = \Auth::user();
        $oldPassword = $request->get('oldPassword');
        if(Hash::check($oldPassword,$user->password))
        {
            $user->password = Hash::make($request->get('newPassword'));
            $user->save();
            alert()->success('Success','Password updated successfully');
            return redirect()->back();
        }else{
            alert()->error('Failed','Current password does not match');
            return redirect()->back();
        }
    }

}

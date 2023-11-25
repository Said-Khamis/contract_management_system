<?php

namespace App\Http\Controllers\Approval;

use App\DataTables\Approval\ApprovalGroupDataTable;
use App\Http\Requests\Approval\CreateApprovalGroupRequest;
use App\Http\Requests\Approval\UpdateApprovalGroupRequest;
use App\Models\Approval\ApprovalGroup;
use App\Repositories\Approval\ApprovalGroupRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;

class ApprovalGroupController extends AppBaseController
{
    /** @var  ApprovalGroupRepository */
    private $approvalGroupRepository;

    public function __construct(ApprovalGroupRepository $approvalGroupRepo)
    {
        $this->middleware('auth');
        $this->approvalGroupRepository = $approvalGroupRepo;
    }

    /**
     * Display a listing of the ApprovalGroup.
     *
     * @param ApprovalGroupDataTable $approvalGroupDataTable
     * @return View
     */
    public function index(): View
    {
        $approvalGroups = ApprovalGroup::all();
        return view('approval_groups.index',compact('approvalGroups'));
    }

    /**
     * Show the form for creating a new ApprovalGroup.
     *
     * @return Response
     */
    public function create()
    {

        return view('approval_groups.create');
    }

    /**
     * Store a newly created ApprovalGroup in storage.
     *
     * @param CreateApprovalGroupRequest $request
     *
     * @return Response
     */
    public function store(CreateApprovalGroupRequest $request)
    {
        /*        {

                    "_token": "u8A2osUUZKl4AxO24xq2aaeUQU5MDYKpTLLge60J",
            "name": "groupe",
            "rank": "1",
            "role_id": [
                    "4",
                    "5"
                ],
            "description": "description for group"

        }*/


        $input = $request->all();

        //begin transaction
        DB::beginTransaction();
        try {

            //$approvalGroup = $this->approvalGroupRepository->create($input);
            $approvalGroup = ApprovalGroup::create([
                'name' => $input['name'],
                'rank' => $input['rank'],
                'description' => $input['description'],
            ]);

            foreach ($input['role_id'] as $roleID) {
                $role = Role::findOrFail($roleID);
                $approvalGroup->roles()->attach($role);

            }

        } catch (ModelNotFoundException $e) {
            DB::rollback();
            //dd(get_class_methods($e)); // lists all available methods for exception object

        }
        DB::commit();

        Alert::toast('Approval Group saved successfully.','success');

        return redirect(route('approvalGroups.index'));
    }

    /**
     * Display the specified ApprovalGroup.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $approvalGroup = $this->approvalGroupRepository->findWithoutFail($id);

        if (empty($approvalGroup)) {
            Flash::error('Approval Group not found');

            return redirect(route('approvalGroups.index'));
        }

        return view('approval_groups.show')->with('approvalGroup', $approvalGroup);
    }

    /**
     * Show the form for editing the specified ApprovalGroup.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $approvalGroup = $this->approvalGroupRepository->findWithoutFail($id);

        if (empty($approvalGroup)) {
            Flash::error('Approval Group not found');

            return redirect(route('approvalGroups.index'));
        }

        return view('approval_groups.edit')->with('approvalGroup', $approvalGroup);
    }

    /**
     * Update the specified ApprovalGroup in storage.
     *
     * @param  int $id
     * @param UpdateApprovalGroupRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateApprovalGroupRequest $request)
    {
        $approvalGroup = $this->approvalGroupRepository->findWithoutFail($id);

        if (empty($approvalGroup)) {
            Flash::error('Approval Group not found');

            return redirect(route('approvalGroups.index'));
        }
        //begin transaction
        DB::beginTransaction();
        try {

            $approvalGroup = $this->approvalGroupRepository->update($request->all(), $id);

        } catch (ModelNotFoundException $e) {
            DB::rollback();
            //dd(get_class_methods($e)); // lists all available methods for exception object

        }
        DB::commit();


        Flash::success('Approval Group updated successfully.');

        return redirect(route('approvalGroups.index'));
    }

    /**
     * Remove the specified ApprovalGroup from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $approvalGroup = $this->approvalGroupRepository->findWithoutFail($id);

        if (empty($approvalGroup)) {
            Flash::error('Approval Group not found');

            return redirect(route('approvalGroups.index'));
        }

        $this->approvalGroupRepository->delete($id);

        Flash::success('Approval Group deleted successfully.');

        return redirect(route('approvalGroups.index'));
    }

    /**
     * show  approval groups in selector2  .
     *
     * @return Response
     */
    public function selector()
    {
        $approvalGroups = ApprovalGroup::pluck('name', 'id');
        foreach ($approvalGroups as $key => $value) {

            $approvalGroupSelector[] = ['id' => $key, 'text' => $value];
        }
        return response()->json(['results' => $approvalGroupSelector], 200);
    }
}

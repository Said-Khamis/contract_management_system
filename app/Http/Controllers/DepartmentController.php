<?php

namespace App\Http\Controllers;

use App\Helpers\DataTableHelper;
use App\Http\Requests\CreateDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Department;
use App\Models\User;
use App\Services\DepartmentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;
use Response;

class DepartmentController extends AppBaseController
{

    public function __construct(protected DepartmentService $departmentService){}

    /**
     * Display a listing of the Department.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request) : View | JsonResponse
    {
        $departments = $this->departmentService->findAll();

        if($request->ajax()){
            return DataTableHelper::renderDepartmentDataTable($departments);
        }
        return view('departments.index')->with('departments', $departments);
    }

    /**
     * Show the form for creating a new Department.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * Store a newly created Department in storage.
     *
     * @param CreateDepartmentRequest $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|RedirectResponse
     */
    public function store(CreateDepartmentRequest $request)
    {
        $input = $request->all();

        $department = $this->departmentService->createDepartment($input);

        Alert::toast('Department saved successfully.');

        return redirect(route('departments.index'));
    }

    /**
     * Display the specified Department.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $department = $this->departmentService->getDepartment($id);
        /*$dataDept = [
            $department,
            $department->institution
        ];*/

          if (empty($department)) {
            Alert::error('Department not found');
            return redirect(route('departments.index'));
        }

        //return view('departments.show')->with('department', $department);

        return response()->json(
            [ "id" => $department->id,
            "code" => $department->code,
            "name" => $department->name,
            "description" => $department->description,
                "institution" => $department->institution,
            "created_at" => date('M d, Y H:i', strtotime($department->created_at)),
            "updated_at" => date('M d, Y H:i', strtotime($department->updated_at)),
            "created_by" => User::find($department->created_by)->email,
            "updated_by" => User::find($department->updated_by)->email,]
        );
    }

    /**
     * Show the form for editing the specified Department.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id) : JsonResponse
    {
        $department = $this->departmentService->getDepartment($id);
        $dataDept = [
            $department,
            $department->institution
        ];
        return response()->json($department);

        /* if (empty($department)) {
             Alert::error('Department not found');

             return redirect(route('departments.index'));
         }*/
        //return view('departments.edit')->with('department', $department);
    }

    /**
     * Update the specified Department in storage.
     *
     * @param int $id
     * @param UpdateDepartmentRequest $request
     *
     * @return Response
     */
    public function update(UpdateDepartmentRequest $request)
    {
        $department = $this->departmentService->getDepartment(
            $request->get("departId")
        );

        if (empty($department)) {
            Alert::error('Department not found');
            return redirect(route('departments.index'));
        }

       $this->departmentService->updateDepartment(
           $request->all(),
           $request->get("departId")
       );

        Alert::toast('Department updated successfully.');

        return redirect(route('departments.index'));
    }

    /**
     * Remove the specified Department from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $department = $this->departmentService->getDepartment($id);

        if (empty($department)) {
            Alert::error('Department not found');

            return redirect(route('departments.index'));
        }

        $this->departmentService->deleteDepartment($id);

        Alert::toast('Department deleted successfully.');

        return redirect(route('departments.index'));
    }
}

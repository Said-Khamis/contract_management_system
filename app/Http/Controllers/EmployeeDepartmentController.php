<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmployeeDepartmentRequest;
use App\Http\Requests\UpdateEmployeeDepartmentRequest;
use App\Repositories\EmployeeDepartmentRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class EmployeeDepartmentController extends AppBaseController
{
    /** @var EmployeeDepartmentRepository $employeeDepartmentRepository*/
    private $employeeDepartmentRepository;

    public function __construct(EmployeeDepartmentRepository $employeeDepartmentRepo)
    {
        $this->employeeDepartmentRepository = $employeeDepartmentRepo;
    }

    /**
     * Display a listing of the EmployeeDepartment.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $employeeDepartments = $this->employeeDepartmentRepository->paginate(10);

        return view('employee_departments.index')
            ->with('employeeDepartments', $employeeDepartments);
    }

    /**
     * Show the form for creating a new EmployeeDepartment.
     *
     * @return Response
     */
    public function create()
    {
        return view('employee_departments.create');
    }

    /**
     * Store a newly created EmployeeDepartment in storage.
     *
     * @param CreateEmployeeDepartmentRequest $request
     *
     * @return Response
     */
    public function store(CreateEmployeeDepartmentRequest $request)
    {
        $input = $request->all();

        $employeeDepartment = $this->employeeDepartmentRepository->create($input);

        Flash::success('Employee Department saved successfully.');

        return redirect(route('employeeDepartments.index'));
    }

    /**
     * Display the specified EmployeeDepartment.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $employeeDepartment = $this->employeeDepartmentRepository->find($id);

        if (empty($employeeDepartment)) {
            Flash::error('Employee Department not found');

            return redirect(route('employeeDepartments.index'));
        }

        return view('employee_departments.show')->with('employeeDepartment', $employeeDepartment);
    }

    /**
     * Show the form for editing the specified EmployeeDepartment.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $employeeDepartment = $this->employeeDepartmentRepository->find($id);

        if (empty($employeeDepartment)) {
            Flash::error('Employee Department not found');

            return redirect(route('employeeDepartments.index'));
        }

        return view('employee_departments.edit')->with('employeeDepartment', $employeeDepartment);
    }

    /**
     * Update the specified EmployeeDepartment in storage.
     *
     * @param int $id
     * @param UpdateEmployeeDepartmentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEmployeeDepartmentRequest $request)
    {
        $employeeDepartment = $this->employeeDepartmentRepository->find($id);

        if (empty($employeeDepartment)) {
            Flash::error('Employee Department not found');

            return redirect(route('employeeDepartments.index'));
        }

        $employeeDepartment = $this->employeeDepartmentRepository->update($request->all(), $id);

        Flash::success('Employee Department updated successfully.');

        return redirect(route('employeeDepartments.index'));
    }

    /**
     * Remove the specified EmployeeDepartment from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $employeeDepartment = $this->employeeDepartmentRepository->find($id);

        if (empty($employeeDepartment)) {
            Flash::error('Employee Department not found');

            return redirect(route('employeeDepartments.index'));
        }

        $this->employeeDepartmentRepository->delete($id);

        Flash::success('Employee Department deleted successfully.');

        return redirect(route('employeeDepartments.index'));
    }
}

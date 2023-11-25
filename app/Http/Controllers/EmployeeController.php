<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Controllers\AppBaseController;
use App\Services\EmployeeService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;
use Response;

class EmployeeController extends AppBaseController
{

    public function __construct(protected EmployeeService $employeeService){}

    /**
     * Display a listing of the Employee.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $employees = $this->employeeService->findAll();

        return view('employees.index')
            ->with('employees', $employees);
    }

    /**
     * Show the form for creating a new Employee.
     *
     * @return Response
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created Employee in storage.
     *
     * @param CreateEmployeeRequest $request
     *
     * @return Response
     */
    public function store(CreateEmployeeRequest $request)
    {
        $input = $request->all();

        $employee = $this->employeeService->createEmployee($input);

        Alert::toast('Employee saved successfully.');

        return redirect(route('employees.index'));
    }

    /**
     * Display the specified Employee.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show(int $id): View|RedirectResponse
    {
        $employee = $this->employeeService->getEmployee($id);

        if (empty($employee)) {
            Alert::error('Employee not found');

            return redirect(route('employees.index'));
        }

        return view('employees.show')->with('employee', $employee);
    }

    /**
     * Show the form for editing the specified Employee.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $employee = $this->employeeService->getEmployee($id);

        if (empty($employee)) {
            Alert::error('Employee not found');

            return redirect(route('employees.index'));
        }

        return view('employees.edit')->with('employee', $employee);
    }

    /**
     * Update the specified Employee in storage.
     *
     * @param int $id
     * @param UpdateEmployeeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEmployeeRequest $request)
    {
        $employee = $this->employeeService->getEmployee($id);

        if (empty($employee)) {
            Alert::error('Employee not found');

            return redirect(route('employees.index'));
        }

        $employee = $this->employeeService->updateEmployee($request->all(), $id);

        Alert::toast('Employee updated successfully.');

        return redirect(route('employees.index'));
    }

    /**
     * Remove the specified Employee from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $employee = $this->employeeService->getEmployee($id);

        if (empty($employee)) {
            Alert::error('Employee not found');

            return redirect(route('employees.index'));
        }

        $this->employeeService->deleteEmployee($id);

        Alert::toast('Employee deleted successfully.');

        return redirect(route('employees.index'));
    }
}

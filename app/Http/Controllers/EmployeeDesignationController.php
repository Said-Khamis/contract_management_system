<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmployeeDesignationRequest;
use App\Http\Requests\UpdateEmployeeDesignationRequest;
use App\Repositories\EmployeeDesignationRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class EmployeeDesignationController extends AppBaseController
{
    /** @var EmployeeDesignationRepository $employeeDesignationRepository*/
    private $employeeDesignationRepository;

    public function __construct(EmployeeDesignationRepository $employeeDesignationRepo)
    {
        $this->employeeDesignationRepository = $employeeDesignationRepo;
    }

    /**
     * Display a listing of the EmployeeDesignation.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $employeeDesignations = $this->employeeDesignationRepository->all();

        return view('employee_designations.index')
            ->with('employeeDesignations', $employeeDesignations);
    }

    /**
     * Show the form for creating a new EmployeeDesignation.
     *
     * @return Response
     */
    public function create()
    {
        return view('employee_designations.create');
    }

    /**
     * Store a newly created EmployeeDesignation in storage.
     *
     * @param CreateEmployeeDesignationRequest $request
     *
     * @return Response
     */
    public function store(CreateEmployeeDesignationRequest $request)
    {
        $input = $request->all();

        $employeeDesignation = $this->employeeDesignationRepository->create($input);

        Flash::success('Employee Designation saved successfully.');

        return redirect(route('employeeDesignations.index'));
    }

    /**
     * Display the specified EmployeeDesignation.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $employeeDesignation = $this->employeeDesignationRepository->find($id);

        if (empty($employeeDesignation)) {
            Flash::error('Employee Designation not found');

            return redirect(route('employeeDesignations.index'));
        }

        return view('employee_designations.show')->with('employeeDesignation', $employeeDesignation);
    }

    /**
     * Show the form for editing the specified EmployeeDesignation.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $employeeDesignation = $this->employeeDesignationRepository->find($id);

        if (empty($employeeDesignation)) {
            Flash::error('Employee Designation not found');

            return redirect(route('employeeDesignations.index'));
        }

        return view('employee_designations.edit')->with('employeeDesignation', $employeeDesignation);
    }

    /**
     * Update the specified EmployeeDesignation in storage.
     *
     * @param int $id
     * @param UpdateEmployeeDesignationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEmployeeDesignationRequest $request)
    {
        $employeeDesignation = $this->employeeDesignationRepository->find($id);

        if (empty($employeeDesignation)) {
            Flash::error('Employee Designation not found');

            return redirect(route('employeeDesignations.index'));
        }

        $employeeDesignation = $this->employeeDesignationRepository->update($request->all(), $id);

        Flash::success('Employee Designation updated successfully.');

        return redirect(route('employeeDesignations.index'));
    }

    /**
     * Remove the specified EmployeeDesignation from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $employeeDesignation = $this->employeeDesignationRepository->find($id);

        if (empty($employeeDesignation)) {
            Flash::error('Employee Designation not found');

            return redirect(route('employeeDesignations.index'));
        }

        $this->employeeDesignationRepository->delete($id);

        Flash::success('Employee Designation deleted successfully.');

        return redirect(route('employeeDesignations.index'));
    }
}

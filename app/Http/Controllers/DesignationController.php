<?php

namespace App\Http\Controllers;

use App\Helpers\DataTableHelper;
use App\Http\Requests\CreateDesignationRequest;
use App\Http\Requests\UpdateDesignationRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\User;
use App\Services\DesignationService;
use Flash;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;
use App\Services\DepartmentService;
use function Symfony\Component\Mime\Header\all;


class DesignationController extends AppBaseController
{

    public function __construct(private DesignationService $designationService){

    }

    /**
     * Display a listing of the Designation.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request) : View | JsonResponse {
        $designations = $this->designationService->findAll();
        //$departments = $this->departmentService->findAll();
        if($request->ajax()){
            return DataTableHelper::renderDesignationDataTable($designations);
        }
        return view('designations.index')
            ->with('designations', $designations);
    }

    /**
     * Show the form for creating a new Designation.
     *
     * @return Response
     */
    public function create(): View{
        return view('designations.create');
    }

    /**
     * Store a newly created Designation in storage.
     *
     * @param CreateDesignationRequest $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateDesignationRequest $request)
    {
        $input = $request->all();

        //dd($input);

        $designation = $this->designationService->createDesignation($input);

        Alert::toast('Designation saved successfully.','success');

        //return response()->json(['success' => true]);

        return redirect(route('designations.index'));
    }

    /**
     * Display the specified Designation.
     *
     * @param int $id
     *
     * @return RedirectResponse|View
     */
    public function show(int $id): View | JsonResponse {
        $designation = $this->designationService->getDesignation($id);

        $dataDept = [
           $designation,
           $designation->institution
        ];

       if (empty($designation)) {
         Alert::error('Designation not found');
         return redirect(route('designations.index'));
       }

        return response()->json(
            [  "id" => $designation->id,
                "code" => $designation->code,
                "title" => $designation->title,
                "description" => $designation->description,
                "institution" => $designation->institution,
                "created_at" => date('M d, Y H:i', strtotime($designation->created_at)),
                "updated_at" => date('M d, Y H:i', strtotime($designation->updated_at)),
                "created_by" => User::find($designation->created_by)->email,
                "updated_by" => User::find($designation->updated_by)->email,]
        );

       //return response()->json($designation);
        /*return view('designations.show')->with('designations', $designation);*/
    }

    /**
     * Show the form for editing the specified Designation.
     *
     * @param int $id
     *
     * @return RedirectResponse|View
     */
    public function edit($id): JsonResponse {
        $designation = $this->designationService->getDesignation($id);

        $dataDept = [
            $designation,
            $designation->institution
        ];
        return response()->json($designation);
       /* if (empty($designation)) {
            Alert::error('Model not found','Designation not found');

            return redirect(route('designations.index'));
        }

        return view('designations.edit')->with('designations', $designation);*/
    }

    /**
     * Update the specified Designation in storage.
     *
     * @param int $id
     * @param UpdateDesignationRequest $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateDesignationRequest $request)
    {
        $designation = $this->designationService->getDesignation(
            $request->get("designId")
        );

        if (empty($designation)) {
            Alert::error('Model not found','Designation not found');
            return redirect(route('designations.index'));
        }

        $this->designationService->updateDesignation(
             $request->all(),
             $request->get("designId")
        );

        Alert::toast('Designation updated successfully.','success');

        return redirect(route('designations.index'));
    }

    /**
     * Remove the specified Designation from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     *
     */
    public function destroy($id): RedirectResponse
    {
        $designation = $this->designationService->getDesignation($id);

        if (empty($designation)) {
            Alert::error('Designation not found');

            return redirect(route('designations.index'));
        }

        $this->designationService->deleteDesignation($id);

        Alert::toast('Designation deleted successfully.','success');

        return redirect(route('designations.index'));
    }
}

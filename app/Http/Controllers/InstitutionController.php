<?php

namespace App\Http\Controllers;

use App\Helpers\DataTableHelper;
use App\Http\Requests\CreateInstitutionRequest;
use App\Http\Requests\UpdateInstitutionRequest;
use App\Http\Controllers\AppBaseController;
use App\Services\InstitutionService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Throwable;
use function Monolog\error;
use Psy\Exception\Exception;
use RealRashid\SweetAlert\Facades\Alert;
use Response;

class InstitutionController extends AppBaseController
{
    public function __construct(protected InstitutionService $institutionService){}

    /**
     * Display a listing of the Institution.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function checkInstitution(Request $request): JsonResponse {
        $name = $request->input("name");
        $id = $request->input("id");
        return checkInstitutionName($name,$id);
    }

    public function checkAbbreviation(Request $request): JsonResponse {
        $abbr = $request->input("abbreviation");
        $id = $request->input("id");

        return checkAbbreviation($abbr,$id);
    }

    public function index(Request $request): View | JsonResponse
    {
        $institutions = $this->institutionService->findAll();

       // confirmDelete('Are you sure?','You wan\'t to delete this institution!');
        if($request->ajax()){
            return DataTableHelper::renderInstitutionDataTable($institutions);
        }
        return view('institutions.index')
            ->with('institutions', $institutions);
    }

    /**
     * Show the form for creating a new Institution.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function create() {
        return view('institutions.create');
    }

    /**
     * Store a newly created Institution in storage.
     *
     * @param CreateInstitutionRequest $request
     *
     * @return RedirectResponse
     * @throws Throwable
     */
    public function store(CreateInstitutionRequest $request):RedirectResponse
    {
        $input = $request->all();
        try
        {
            //dd($request);
            $institution = $this->institutionService->createInstitution($input);
            Alert::toast('Institution added successfully.', 'success');
            //return response()->json(['success' => true]);
            return redirect(route('institutions.index'));
        } catch (Exception $e) {
               $errorMessage = $e->getMessage();
               alert()->error('Failed','Failed to create institution');
             return redirect()->back();
        }
    }

    /**
     * Display the specified Institution.
     *
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function show(int $id): \Illuminate\Database\Eloquent\Model {
        return $this->institutionService->getInstitution($id);
    }

    /**
     * Show the form for editing the specified Institution.
     *
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function edit($id): \Illuminate\Database\Eloquent\Model {
        return $this->institutionService->getInstitution($id);
        //return view('institutions.edit')->with('institution', $institution);
    }

    /**
     * Update the specified Institution in storage.
     *
     * @param Request $request
     *
     * @return Application|\Illuminate\Foundation\Application|Redirector|RedirectResponse
     * @throws Throwable
     */
    public function update( Request $request): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $institution = $this->institutionService->getInstitution(
            $request->get("institutionId")
        );

        if ( empty($institution) ) {
            Alert::error('Institution not found');
            return redirect(route('institutions.index'));
        }
        $institution = $this->institutionService->updateInstitution($request->all(), $institution->id);
        Alert::toast('Institution updated successfully.');
        return redirect(route('institutions.index'));
    }

    /**
     * Remove the specified Institution from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $institution = $this->institutionService->getInstitution($id);

        if (empty($institution)) {
            Alert::error('Institution not found');

            return redirect(route('institutions.index'));
        }

        $this->institutionService->deleteInstitution($id);

        Alert::toast('Institution deleted successfully.');

        return redirect(route('institutions.index'));
    }

}

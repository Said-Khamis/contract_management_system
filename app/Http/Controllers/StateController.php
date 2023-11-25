<?php

namespace App\Http\Controllers;

use App\Helpers\DataTableHelper;
use App\Http\Requests\CreateStateRequest;
use App\Http\Requests\UpdateStateRequest;
use App\Models\Country;
use App\Http\Controllers\AppBaseController;
use App\Services\StateService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Redirector;
use RealRashid\SweetAlert\Facades\Alert;
use Response;

class StateController extends AppBaseController
{
    public function __construct(protected StateService $stateService){

    }

    /**
     * Display a listing of the State.
     *
     * @param Request $request
     *
     * @return View|JsonResponse
     */
    public function index(Request $request): View | JsonResponse {
        $states = $this->stateService->findAll();
        if($request->ajax()){
            return DataTableHelper::renderStateDataTable($states);
        }
        return view('states.index')->with('states',$states);
    }

    /**
     * Show the form for creating a new State.
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function create(): \Illuminate\Foundation\Application|View|Factory|Application{
        return view('states.create');
    }

    /**
     * Store a newly created State in storage.
     *
     * @param CreateStateRequest $request
     *
     * @return JsonResponse
     */
    public function store(CreateStateRequest $request): JsonResponse
    {
        $input = $request->all();

        try {
            $state = $this->stateService->createState($input);
            // Handle successful creation within the transaction
        } catch (\Exception $e) {
            // Handle exception or rollback specific to your requirements
        }

        Alert::toast('State saved successfully.','success');

        return response()->json(['success' => true]);

        return redirect(route('states.index'));
    }

    /**
     * Display the specified State.
     *
     * @param int $id
     *
     * @return \Illuminate\Foundation\Application|Application|Factory|View
     */
    public function show(int $id): Application|Factory|View|\Illuminate\Foundation\Application
    {
        $state = $this->stateService->getState($id);

        if (empty($state)) {
            Alert::error('Model not found','State not found');

            return redirect(route('states.index'));
        }

        return view('states.show')->with('state', $state);
    }

    /**
     * Show the form for editing the specified State.
     *
     * @param int $id
     *
     * @return \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application|View
     */
    public function edit(int $id): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application|View
    {
        $state = $this->stateService->getState($id);

        if (empty($state)) {
            Alert::error('Model not found','State not found');

            return redirect(route('states.index'));
        }
        return view('states.edit')->with('states', $state);
    }

    /**
     * Update the specified State in storage.
     *
     * @param int $id
     * @param UpdateStateRequest $request
     *
     * @return \Illuminate\Foundation\Application|Redirector|Application|RedirectResponse
     */
    public function update(int $id, UpdateStateRequest $request): Application|\Illuminate\Foundation\Application|RedirectResponse|Redirector
    {
        $state = $this->stateService->getState($id);

        if (empty($state)) {
            Alert::error('Model not found','State not found');
            return redirect(route('states.index'));
        }

        $state = $this->stateService->updateState($request->all(), $id);

        Alert::toast('State updated successfully.','success');
        //return response()->json(['success' => true]);
        return redirect(route('states.index'));
    }

    /**
     * Remove the specified State from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Foundation\Application|Redirector|Application|RedirectResponse
     * @throws \Exception
     *
     */
    public function destroy($id): Application|\Illuminate\Foundation\Application|RedirectResponse|Redirector
    {
        $state = $this->stateService->getState($id);

        if (empty($state)) {
            Alert::error('Model not found','State not found');
            return redirect(route('states.index'));
        }

        $this->stateService->deleteState($id);

        Alert::toast('State deleted successfully.','success');

        return redirect(route('states.index'));
    }
}

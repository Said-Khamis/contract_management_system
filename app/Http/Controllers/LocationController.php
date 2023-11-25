<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Region;
use App\Models\State;
use App\Repositories\LocationRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Flash;
use RealRashid\SweetAlert\Facades\Alert;
use Response;

class LocationController extends AppBaseController
{
    /** @var LocationRepository $locationRepository*/
    private $locationRepository;

    public function __construct(LocationRepository $locationRepo)
    {
        $this->locationRepository = $locationRepo;
    }

    /**
     * Display a listing of the Location.
     *
     * @param Request $request
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index(Request $request): \Illuminate\Foundation\Application|View|Factory|Application
    {
        $locations = $this->locationRepository->paginate(10);
        return view('locations.index')->with('locations', $locations);
    }

    /**
     * Show the form for creating a new Location.
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function create(): \Illuminate\Foundation\Application|View|Factory|Application
    {
        return view('locations.create');
    }

    /**
     * Store a newly created Location in storage.
     *
     * @param CreateLocationRequest $request
     *
     * @return Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateLocationRequest $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|Application
    {
        $input = $request->all();

        $location = $this->locationRepository->create($input);

        Alert::success('Location saved successfully.');

        return redirect(route('locations.index'));
    }

    /**
     * Display the specified Location.
     *
     * @param int $id
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function show($id): \Illuminate\Foundation\Application|View|Factory|Application
    {
        $location = $this->locationRepository->find($id);
        if (empty($location)) {
            Flash::error('Location not found');
            return redirect(route('locations.index'));
        }
        return view('locations.show')->with('location', $location);
    }

    /**
     * Show the form for editing the specified Location.
     *
     * @param int $id
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit($id): \Illuminate\Foundation\Application|View|Factory|Application
    {
        $location = $this->locationRepository->find($id);
        if (empty($location)) {
            Flash::error('Location not found');
            return redirect(route('locations.index'));
        }
        return view('locations.edit')->with('location', $location);
    }

    /**
     * Update the specified Location in storage.
     *
     * @param int $id
     * @param UpdateLocationRequest $request
     *
     * @return Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, UpdateLocationRequest $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|Application
    {
        $location = $this->locationRepository->find($id);
        if (empty($location)) {
            Flash::error('Location not found');
            return redirect(route('locations.index'));
        }
        $location = $this->locationRepository->update($request->all(), $id);
        Flash::success('Location updated successfully.');
        return redirect(route('locations.index'));
    }

    /**
     * Remove the specified Location from storage.
     *
     * @param int $id
     *
     * @return Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     *
     */
    public function destroy($id): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|Application
    {
        $location = $this->locationRepository->find($id);
        if (empty($location)) {
            Flash::error('Location not found');
            return redirect(route('locations.index'));
        }
        $this->locationRepository->delete($id);
        Flash::success('Location deleted successfully.');
        return redirect(route('locations.index'));
    }

    public function getLocations($id) {

        $locations = Country::find($id);
        $responseData = [];
        if ($locations->hasCity == 1) {
            $responseData['cityData'] = City::where('country_id', $id)->get();
        }
        if ($locations->hasState == 1) {
            $responseData['stateData'] = State::where('country_id', $id)->get();
        }
        if ($locations->hasRegion == 1) {
            $responseData['regionData'] = Region::where('country_id', $id)->get();
        }
        return response()->json($responseData);
    }
}

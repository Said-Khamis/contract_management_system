<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Http\Controllers\AppBaseController;
use Doctrine\DBAL\Query\QueryException;
use App\Services\CityService;
use Exception;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;
use Response;

class CityController extends AppBaseController
{

    public function __construct(protected CityService $cityService)
    {
    }

    /**
     * Display a listing of the City.
     *
     * @param Request $request
     * @return View|JsonResponse
     */
    public function index(Request $request): View|JsonResponse
    {
        $cities = $this->cityService->findAll();
        confirmDelete('Deleting City!', 'Are you sure you want to delete this city?');
        if ($request->ajax()) {
            return $this->cityService->getCitiesDataTable($cities);
        }
        return view('cities.index')
            ->with('cities', $cities);
    }

    /**
     * Show the form for creating a new City.
     *
     * @return View
     */
    public function create(): View
    {
        return view('cities.create');
    }

    /**
     * Store a newly created City in storage.
     *
     * @param CreateCityRequest $request
     *
     * @return RedirectResponse|JsonResponse
     */
    public function store(CreateCityRequest $request): RedirectResponse|JsonResponse
    {
        $input = $request->all();
        try {
            $this->cityService->createCity($input);

            Alert::toast('City saved successfully.', 'success');
            return response()->json(['success' => true]);
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            return response()->json(['error' => $errorMessage], 500);
        }
        return redirect(route('cities.index'));
    }

    /**
     * Display the specified City.
     *
     * @param int $id
     *
     * @return Redirect|View
     */
    public function show($id): View|Redirect
    {
        $city = $this->cityService->getCity($id);

        if (empty($city)) {
            Alert::error('Model not found', 'City not found');

            return redirect(route('cities.index'));
        }

        return view('cities.show')->with('city', $city);
    }

    /**
     * Show the form for editing the specified City.
     *
     * @param int $id
     *
     * @return RedirectResponse|View
     */
    public function edit($id): View|Redirect
    {

        $city = $this->cityService->getCity($id);

        if (empty($city)) {
            Alert::error('Model not found', 'City not found');

            return redirect(route('cities.index'));
        }

        return view('cities.edit')->with('city', $city);
    }

    /**
     * Update the specified City in storage.
     *
     * @param int $id
     * @param UpdateCityRequest $request
     *
     * @return RedirectResponse
     */
    public function update(int $id, UpdateCityRequest $request): RedirectResponse
    {

        try {
            $city = $this->cityService->getCity($id);

            if (empty($city)) {
                Alert::error('Model not found', 'City not found');

                return redirect(route('cities.index'));
            }

            $city = $this->cityService->updateCity($request->all(), $id);

            Alert::toast('City updated successfully.', 'success');
            return response()->json(['success' => true]);
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            return response()->json(['error' => $errorMessage], 500);
        }

        return redirect(route('cities.index'));
    }

    /**
     * Remove the specified City from storage.
     *
     * @param int $id
     *
     * @return RedirectResponse
     * @throws \Exception
     *
     */
    public function destroy(int $id): RedirectResponse
    {
        $city = $this->cityService->getCity($id);

        if (empty($city)) {
            Alert::error('Model not found', 'City not found');

            return redirect(route('cities.index'));
        }

        $this->cityService->deleteCity($id);

        Alert::toast('City deleted successfully.', 'success');

        return redirect(route('cities.index'));
    }
}

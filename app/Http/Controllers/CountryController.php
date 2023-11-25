<?php

namespace App\Http\Controllers;

use App\Helpers\DataTableHelper;
use App\Http\Requests\CreateCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Services\CountryService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;
use Exception;

class CountryController extends AppBaseController
{
    public function __construct(protected CountryService $countryService)
    {
    }

    /**
     * Display a listing of the Country.
     *
     * @param Request $request
     *
     * @return View | JsonResponse
     */
    public function index(Request $request): View|JsonResponse
    {
        $countries = $this->countryService->findAll();
        // confirmDelete('Deleting Country!','Are you sure you want to delete this country?');
        if ($request->ajax()) {
            return DataTableHelper::renderCountryDataTable($countries);
        }
        return view('countries.index')->with('countries', $countries);
    }

    /**
     * Show the form for creating a new Country.
     *
     * @return View
     */
    public function create(): View
    {
        return view('countries.create');
    }

    /**
     * Store a newly created Country in storage.
     *
     * @param CreateCountryRequest $request
     *
     * @return JsonResponse|RedirectResponse
     * @throws Throwable
     */
    public function store(CreateCountryRequest $request): JsonResponse|RedirectResponse
    {
        try {
            $input = $request->all();
            $country = $this->countryService->createCountry($input);

            Alert::toast('Country saved successfully.', 'success');

            return response()->json(['success' => true]);

        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            return response()->json(['error' => $errorMessage], 500);
        }
    }

    /**
     * Display the specified Country.
     *
     * @param int $id
     *
     * @return \Illuminate\Foundation\Application|Application|Redirector|RedirectResponse
     */
    public function show(int $id): Application|Factory|View|\Illuminate\Foundation\Application
    {
        $country = $this->countryService->getCountry($id);

        if (empty($country)) {
            Alert::error('Country not found');

            return redirect(route('countries.index'));
        }

        return view('countries.show')->with('country', $country);
    }

    /**
     * Show the form for editing the specified Country.
     *
     * @param int $id
     *
     * @return View|RedirectResponse
     */
    public function edit(int $id): View|RedirectResponse
    {
        $country = $this->countryService->getCountry($id);

        if (empty($country)) {
            Alert::error('Country not found');

            return redirect(route('countries.index'));
        }

        return view('countries.edit')->with('country', $country);
    }

    /**
     * Update the specified Country in storage.
     *
     * @param int $id
     * @param UpdateCountryRequest $request
     *
     * @return JsonResponse|RedirectResponse
     * @throws Throwable
     */
    public function update(int $id, UpdateCountryRequest $request): JsonResponse|RedirectResponse
    {
        try {
            $country = $this->countryService->getCountry($id);
            if (empty($country)) {
                Alert::error('Model not found', 'Country not found');

                return redirect(route('countries.index'));
            }
            $country = $this->countryService->updateCountry($request->all(), $id);

            Alert::toast('Country updated successfully.', 'success');
            return response()->json(['success' => true]);
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            return response()->json(['error' => $errorMessage], 500);
        }
    }

    /**
     * Remove the specified Country from storage.
     *
     * @param int $id
     *
     * @return RedirectResponse
     * @throws Throwable
     */
    public function destroy(int $id): RedirectResponse
    {
        $country = $this->countryService->getCountry($id);

        if (empty($country)) {
            Alert::error('Country not found');

            return redirect(route('countries.index'));
        }

        $country = $this->countryService->deleteCountry($id);

        Alert::toast('Country deleted successfully.');

        return redirect(route('countries.index'));
    }
}

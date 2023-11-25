<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRegionRequest;
use App\Http\Requests\UpdateRegionRequest;
use App\Repositories\RegionRepository;
use App\Http\Controllers\AppBaseController;
use App\Services\RegionService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Redirector;
use RealRashid\SweetAlert\Facades\Alert;
use Response;
use Throwable;

class RegionController extends AppBaseController
{

    public function __construct(protected RegionService $regionService){}

    /**
     * Display a listing of the Region.
     *
     * @param Request $request
     *
     * @return View|JsonResponse
     */
    public function index(Request $request): View | JsonResponse
    {
        $regions = $this->regionService->findAll();
        confirmDelete('Deleting Region!','Are you sure you want to delete this region?');
        if ($request->ajax()) {
            return $this->regionService->getRegionsDataTable($regions);
        }
        return view('regions.index')
            ->with('regions', $regions);
    }

    /**
     * Show the form for creating a new Region.
     *
     * @return View
     */
    public function create(): View
    {
        return view('regions.create');
    }

    /**
     * Store a newly created Region in storage.
     *
     * @param CreateRegionRequest $request
     *
     * @return Application|\Illuminate\Foundation\Application|RedirectResponse|Redirector
     */
    public function store(CreateRegionRequest $request): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $input = $request->all();

        $region = $this->regionService->createRegion($input);

        Alert::toast('Region saved successfully.','success');

        return response()->json(['success' => true]);

        return redirect(route('regions.index'));
    }

    /**
     * Display the specified Region.
     *
     * @param int $id
     *
     * @return Application|View|\Illuminate\Foundation\Application|RedirectResponse|Redirector
     */
    public function show(int $id): \Illuminate\Foundation\Application|View|Redirector|RedirectResponse|Application
    {
        $region = $this->regionService->getRegion($id);

        if (empty($region)) {
            Alert::error('Region not found');

            return redirect(route('regions.index'));
        }

        return view('regions.show')->with('region', $region);
    }

    /**
     * Show the form for editing the specified Region.
     *
     * @param int $id
     *
     * @return Application|View|\Illuminate\Foundation\Application|RedirectResponse|Redirector
     */
    public function edit(int $id): Application|View|\Illuminate\Foundation\Application|RedirectResponse|Redirector
    {
        $region = $this->regionService->getRegion($id);

        if (empty($region)) {
            Alert::error('Region not found');

            return redirect(route('regions.index'));
        }

        return view('regions.edit')->with('region', $region);
    }

    /**
     * Update the specified Region in storage.
     *
     * @param int $id
     * @param UpdateRegionRequest $request
     *
     * @return RedirectResponse|JsonResponse
     * @throws Throwable
     */
    public function update(int $id, UpdateRegionRequest $request): RedirectResponse|JsonResponse
    {
        $region = $this->regionService->getRegion($id);

        if (empty($region)) {
            Alert::error('Region not found');

            return redirect(route('regions.index'));
        }

        $region = $this->regionService->updateRegion($request->all(), $id);

        Alert::toast('Region updated successfully.','success');

        return response()->json(['success' => true]);

        return redirect(route('regions.index'));
    }

    /**
     * Remove the specified Region from storage.
     *
     * @param int $id
     *
     * @return RedirectResponse
     * @throws Throwable
     */
    public function destroy(int $id): RedirectResponse
    {
        $region = $this->regionService->getRegion($id);

        if (empty($region)) {
            Alert::error('Region not found');

            return redirect(route('regions.index'));
        }

        $this->regionService->deleteRegion($id);

        Alert::toast('Region deleted successfully.','success');

        return redirect(route('regions.index'));
    }
}

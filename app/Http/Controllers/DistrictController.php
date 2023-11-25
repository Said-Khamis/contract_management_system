<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDistrictRequest;
use App\Http\Requests\UpdateDistrictRequest;
use App\Repositories\DistrictRepository;
use App\Http\Controllers\AppBaseController;
use App\Services\DistrictService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;


class DistrictController extends AppBaseController
{
    public function __construct(protected DistrictService $districtService){}

    /**
     * Display a listing of the District.
     *
     * @param Request $request
     *
     * @return View|JsonResponse
     */
    public function index(Request $request): View | JsonResponse
    {
        $districts = $this->districtService->findAll();
        if ($request->ajax()) {
            return $this->districtService->getDistrictsDataTable($districts);
        }
        return view('districts.index')
            ->with('districts', $districts);
    }

    /**
     * Show the form for creating a new District.
     *
     * @return View
     */
    public function create(): View
    {
        return view('districts.create');
    }

    /**
     * Store a newly created District in storage.
     *
     * @param CreateDistrictRequest $request
     *
     * @return Application|\Illuminate\Foundation\Application|Redirector|RedirectResponse
     * @throws Throwable
     */
    public function store(CreateDistrictRequest $request): Application|\Illuminate\Foundation\Application|RedirectResponse|Redirector
    {
        $input = $request->all();
        $this->districtService->createDistrict($input);
        Alert::toast('District saved successfully.','success');
        return response()->json(['success' => true]);
        return redirect(route('districts.index'));
    }

    /**
     * Display the specified District.
     *
     * @param int $id
     *
     * @return Application|View|\Illuminate\Foundation\Application|RedirectResponse|Redirector
     */
    public function show(int $id): Application|View|\Illuminate\Foundation\Application|RedirectResponse|Redirector
    {
        $district = $this->districtService->getDistrict($id);
        if (empty($district)) {
            Alert::error('District not found');
            return redirect(route('districts.index'));
        }
        return view('districts.show')->with('district', $district);
    }

    /**
     * Show the form for editing the specified District.
     *
     * @param int $id
     *
     * @return Application|View|\Illuminate\Foundation\Application|RedirectResponse|Redirector
     */
    public function edit(int $id): Application|View|\Illuminate\Foundation\Application|RedirectResponse|Redirector
    {
        $district = $this->districtService->getDistrict($id);
        if (empty($district)) {
            Alert::error('District not found');
            return redirect(route('districts.index'));
        }
        return view('districts.edit')->with('district', $district);
    }

    /**
     * Update the specified District in storage.
     *
     * @param int $id
     * @param UpdateDistrictRequest $request
     *
     * @return \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application|JsonResponse
     * @throws Throwable
     */
    public function update(int $id, UpdateDistrictRequest $request): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application|JsonResponse
    {
        $district = $this->districtService->getDistrict($id);
        if (empty($district)) {
            Alert::error('District not found');
            return redirect(route('districts.index'));
        }
        $district = $this->districtService->updateDistrict($request->all(), $id);
        Alert::toast('District updated successfully.','success');
        return response()->json(['success' => true]);
        return redirect(route('districts.index'));
    }

    /**
     * Remove the specified District from storage.
     *
     * @param int $id
     *
     * @return Application|\Illuminate\Foundation\Application|Redirector|RedirectResponse
     * @throws Exception|Throwable
     *
     */
    public function destroy($id): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $district = $this->districtService->getDistrict($id);
        if (empty($district)) {
            Alert::error('District not found');
            return redirect(route('districts.index'));
        }
        $this->districtService->deleteDistrict($id);
        Alert::toast('District deleted successfully.','success');
        return redirect(route('districts.index'));
    }

}

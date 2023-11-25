<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateWardRequest;
use App\Http\Requests\UpdateWardRequest;
use App\Models\Region;
use App\Models\Ward;
use App\Repositories\WardRepository;
use App\Http\Controllers\AppBaseController;
use App\Services\WardService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;
use Response;
use Throwable;

class WardController extends AppBaseController
{
    public function __construct(protected WardService $wardService){}

    /**
     * Display a listing of the Ward.
     *
     * @param Request $request
     *
     * @return View
     */
    public function index(Request $request): View | JsonResponse
    {
        $wards = $this->wardService->findAll();
        if ($request->ajax()) {
            return $this->wardService->getWardsDataTable($wards);
        }
        return view('wards.index')
            ->with('wards', $wards);
    }

    /**
     * Show the form for creating a new Ward.
     *
     * @return View
     */
    public function create(): View
    {
        return view('wards.create');
    }

    /**
     * Store a newly created Ward in storage.
     *
     * @param CreateWardRequest $request
     *
     * @return Application|\Illuminate\Foundation\Application|Redirector|RedirectResponse
     * @throws Throwable
     */
    public function store(CreateWardRequest $request): Application|\Illuminate\Foundation\Application|Redirector|RedirectResponse|JsonResponse
    {
        $input = $request->all();

        $ward = $this->wardService->createWard($input);

        Alert::toast('Ward saved successfully.','success');

        return response()->json(['success' => true]);

        return redirect(route('wards.index'));
    }

    /**
     * Display the specified Ward.
     *
     * @param int $id
     *
     * @return Application|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|RedirectResponse|Redirector
     */
    public function show(int $id): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|Redirector|RedirectResponse|Application
    {
        $ward = $this->wardService->getWard($id);

        if (empty($ward)) {
            Alert::error('Ward not found');

            return redirect(route('wards.index'));
        }

        return view('wards.show')->with('ward', $ward);
    }

    /**
     * Show the form for editing the specified Ward.
     *
     * @param int $id
     *
     * @return Application|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|RedirectResponse|Redirector
     */
    public function edit(int $id): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|Redirector|RedirectResponse|Application
    {
        $ward = $this->wardService->getWard($id);

        if (empty($ward)) {
            Alert::error('Ward not found');

            return redirect(route('wards.index'));
        }

        return view('wards.edit')->with('ward', $ward);
    }

    /**
     * Update the specified Ward in storage.
     *
     * @param int $id
     * @param UpdateWardRequest $request
     *
     * @return Application|\Illuminate\Foundation\Application|Redirector|RedirectResponse
     * @throws Throwable
     */
    public function update(int $id, UpdateWardRequest $request): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application|JsonResponse
    {
        $ward = $this->wardService->getWard($id);

        if (empty($ward)) {
            Alert::error('Ward not found');

            return redirect(route('wards.index'));
        }

        $ward = $this->wardService->updateWard($request->all(), $id);

        Alert::toast('Ward updated successfully.','success');

        return response()->json(['success' => true]);

        return redirect(route('wards.index'));
    }

    /**
     * Remove the specified Ward from storage.
     *
     * @param int $id
     *
     * @return Application|\Illuminate\Foundation\Application|Redirector|RedirectResponse
     *@throws Exception|Throwable
     *
     */
    public function destroy(int $id): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $ward = $this->wardService->getWard($id);

        if (empty($ward)) {
            Alert::error('Ward not found');

            return redirect(route('wards.index'));
        }

        $this->wardService->deleteWard($id);

        Alert::toast('Ward deleted successfully.','success');

        return redirect(route('wards.index'));
    }


}

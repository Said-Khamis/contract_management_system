<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGeneralStatusRequest;
use App\Http\Requests\UpdateGeneralStatusRequest;
use App\Services\GeneralStatusService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class GeneralStatusController extends AppBaseController
{
    public function __construct(protected GeneralStatusService $generalStatusService){}

    /**
     * Display a listing of the GeneralStatus.
     *
     * @param Request $request
     *
     */
    public function index(Request $request) {
    }

    /**
     * Show the form for creating a new GeneralStatus.
     *
     */
    public function create() {
    }

    /**
     * Store a newly created GeneralStatus in storage.
     *
     * @param CreateGeneralStatusRequest $request
     *
     * @return JsonResponse
     * @throws Throwable
     */
    public function store(CreateGeneralStatusRequest $request): JsonResponse
    {
        $input = $request->all();
        $data = [
            "area" => $input["area"],
            "contract_id" => decode($input["contract_id"])
        ];
        $gStatus = [];
        try {
            $gStatus = $this->generalStatusService->createGeneralStatus($data);
            return response()->json([
                "status" => true,
                "gStatus" => $gStatus
            ]);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "error" => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified GeneralStatus.
     *
     * @param int $id
     *
     */
    public function show($id){

    }

    /**
     * Show the form for editing the specified GeneralStatus.
     *
     * @param int $id
     * @return RedirectResponse|View
     */
    public function edit(int $id): RedirectResponse|View
    {
        $generalStatus = $this->generalStatusService->getGeneralStatus($id);

        if (empty($generalStatus)) {
            Alert::error('Model not Found', 'Cooperation area not found');

            return back();
        }

        return view('general_statuses.edit')->with('generalStatus', $generalStatus);
    }

    /**
     * Update the specified GeneralStatus in storage.
     *
     * @param int $id
     * @param UpdateGeneralStatusRequest $request
     *
     * @return RedirectResponse
     * @throws Throwable|Exception
     */
    public function update(int $id, UpdateGeneralStatusRequest $request): RedirectResponse
    {
        $generalStatus = $this->generalStatusService->getGeneralStatus($id);

        if (empty($generalStatus)) {
            Alert::error('Model not Found', 'Cooperation area not found');

            return back();
        }

        try {
            $generalStatus = $this->generalStatusService->updateGeneralStatus($generalStatus, $request->all());
        } catch (Exception $e)
        {
            Alert::error('Update Failed', 'There is an error updating area of cooperation.');

            return back();
        }

        Alert::toast('Area of cooperation updated successfully', 'success');

        return redirect(route('contractss.show', $generalStatus->contract_id));
    }

    /**
     * Remove the specified GeneralStatus from storage.
     *
     * @param int $id
     *
     * @return RedirectResponse
     * @throws Throwable|Exception
     */
    public function destroy(int $id): RedirectResponse
    {
        $generalStatus = $this->generalStatusService->getGeneralStatus($id);

        if (empty($generalStatus)) {
            Alert::error('Model not Found', 'Cooperation area not found');

            return back();
        }

        try {
            $this->generalStatusService->deleteGeneralStatus($generalStatus);
        } catch (Exception $e)
        {
            Alert::error('Delete Failed', 'There is an error deleting area of cooperation.');

            return back();
        }

        Alert::toast('Cooperation area deleted successfully', 'success');

        return redirect(route('contractss.show', $generalStatus->contract_id));
    }
}

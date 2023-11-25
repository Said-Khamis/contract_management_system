<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateImplementationStatusRequest;
use App\Http\Requests\UpdateImplementationStatusRequest;
use App\Models\ContractObjective;
use App\Models\ContractOperationArea;
use App\Models\GeneralStatus;
use App\Models\ImplementationStatus;
use App\Services\ImplementationStatusService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class ImplementationStatusController extends AppBaseController
{
    public function __construct(protected ImplementationStatusService $implementationStatusService){}

    /**
     * Display a listing of the ImplementationStatus.
     *
     * @param Request $request
     *
     */
    public function index(Request $request) {
        //return view('implementation_statuses.index');
    }

    /**
     * Show the form for creating a new ImplementationStatus.
     *
     * @return View
     */
    public function create(): View{
        return view('implementation_statuses.create');
    }

    /**
     * Store a newly created ImplementationStatus in storage.
     *
     * @param CreateImplementationStatusRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws Throwable
     */
    public function store(CreateImplementationStatusRequest $request): \Illuminate\Http\JsonResponse
    {
        $input =  $request->all();
        try {
            $data = $this->implementationStatusService->createImplementationStatus($input);
            return response()->json([
                "status" => true,
                "newStatus" => $data
            ]);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "error" => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified ImplementationStatus.
     *
     * @param int $id
     *
     * @return RedirectResponse|View
     */
    public function show(int|string $id): RedirectResponse|View
    {
        $id = decode($id);

        $dataArrayImplementations =  [];
        $type = "";
        $getAreaOfCooperation = ContractOperationArea::where("contract_id", $id)
            ->orderByDesc("id")
            ->with(["statuses" => function($query){
                $query->orderBy("id","DESC");
            }])
            ->get();
        if(count($getAreaOfCooperation) > 0){
            $dataArrayImplementations = $getAreaOfCooperation;
            $type = "contract_operation_area";
        }else{
            $getObjectives = ContractObjective::where("contract_id", $id)
                ->orderByDesc("id")
                ->with(["statuses" => function($query){
                    $query->orderBy("id","DESC");
                }])
                ->get();

            if(count($getObjectives) > 0){
                $dataArrayImplementations = $getObjectives;
                $type = "contract_objectives";

            }else{
                $getGeneralStatus = GeneralStatus::where("contract_id", $id)
                    ->orderByDesc("id")
                    ->with(["statuses" => function($query){
                        $query->orderBy("id","DESC");
                    }])
                    ->get();

                $dataArrayImplementations = $getGeneralStatus;
                $type = "contract_general_status";
            }
        }

        $data = [
            "type" => $type,
            "contract_id" => encode($id),
            "data" => $dataArrayImplementations
        ];

        return view('implementation_statuses.show')->with('dataArrayImplementations', $data);
    }

    /**
     * Show the form for editing the specified ImplementationStatus.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(int|string $id): \Illuminate\Http\JsonResponse {
        $implementationStatus = $this->implementationStatusService->getImplementationStatus($id);
        return response()->json([
            "result" => $implementationStatus
        ]);
    }

    /**
     * Update the specified ImplementationStatus in storage.
     *
     * @param int $id
     * @param UpdateImplementationStatusRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws Throwable
     */
    public function update(int|string $id, UpdateImplementationStatusRequest $request): \Illuminate\Http\JsonResponse
    {
        $implementationStatus = $this->implementationStatusService->getImplementationStatus($id);

     try {

         $implementationStatus = $this->implementationStatusService->updateImplementationStatus($implementationStatus, $request->all());

            return response()->json([
                "status" => true,
                "result" => $implementationStatus
            ]);

        } catch (Exception $e) {
           return response()->json([
               "status" => false,
               "error" => $e->getMessage()
           ]);
        }
    }

    /**
     * Remove the specified ImplementationStatus from storage.
     *
     * @param int $id
     *
     * @return JsonResponse
     * @throws Throwable
     *
     * @throws Exception
     */
    public function destroy(Request $request): JsonResponse
    {
        try {
            $inputs = $request->all();
            if(count($inputs) > 0){
                foreach ($inputs as $id){
                    $implementationStatus = $this->implementationStatusService->getImplementationStatus($id["id"]);
                    $this->implementationStatusService->deleteImplementationStatus($implementationStatus);
                }
            }
            return response()->json([
                "status" => true
            ]);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "error" => $e->getMessage()
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contract;
use App\Models\ContractParty;
use App\Models\Sector;
use App\Services\ContractService;
use App\Services\ImplementationStatusService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(protected ContractService $contractService, protected ImplementationStatusService $implementationStatusService)
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): \Illuminate\Contracts\Support\Renderable
    {
        $recentSigned = $this->contractService->getRecentSigned();
        $internallySigned = $this->contractService->getCount(2, true);
        $internallyUnSigned = $this->contractService->getCount(2);
        $externallySigned = $this->contractService->getCount(3, true);
        $externallyUnSigned = $this->contractService->getCount(3 );
        //$top5 = $this->implementationStatusService->getTopFivePerformance();

        return view('home')->with([
            'recent' => $recentSigned,
            'internallySigned' => $internallySigned,
            'internallyUnSigned' => $internallyUnSigned,
            'externallySigned' => $externallySigned,
            'externallyUnSigned' => $externallyUnSigned,
            //'top5' => $top5
        ]);
    }

    public function contractCounting(): \Illuminate\Http\JsonResponse
    {
         /*------ TPYES ---------*/
         $mouType = "Memorandum Of Understanding";
         $bilateralType = "Bilateral Agreement";
         $regionalType = "Regional Agreement";
         $multilateralType = "Multilateral Agreement";

         $mou = $this->contractService->countByType($mouType);
         $bilateral = $this->contractService->countByType($bilateralType);
         $regional = $this->contractService->countByType($regionalType);
         $multilateral = $this->contractService->countByType($multilateralType);
         $total =  $mou + $bilateral + $regional + $multilateral;

         $labels = [$mouType,$bilateralType,$regionalType,$multilateralType];
         /*---- GRAPH DATA --------*/
         $series = [ $mou, $bilateral,$regional,$multilateral];

         return response()->json([
            "results" => [
                "total" => $total,
                "series" => $series,
                "labels" => $labels,
            ]
         ]);
    }

    public function contractPerformances(): \Illuminate\Http\JsonResponse{

        Carbon::setLocale('en');

        /*-- 5 BEST PERFORMERS ---*/
        $contactImpl = Contract::with("status")
            ->whereNotNull("signed_at")
            ->get();
        $contractsWithAvgPercent = [];
        foreach ($contactImpl as $contract){
            $count = count($contract->status);
            $sum = 0;
            if($count > 0){
                foreach ($contract->status as $item){
                    $sum += $item['percent'];
                }
            }

            $averagePercent = $count > 0
                ? $sum / $count
                : 0;

            if($averagePercent !== 0){
                $contractsWithAvgPercent[] = [
                    "regNo" => $contract->reference_no,
                    "name" => $contract->title,
                    "signedDate" => date("d M Y", strtotime($contract->signed_at)),
                    "duration" => $contract->signed_at !== null
                        ? Carbon::createFromTimestamp(strtotime($contract->signed_at))->diffForHumans()
                        : "N/A" ,
                    "percent" => round($averagePercent,2)
                ];
            }
        }
        $sorted = collect($contractsWithAvgPercent)->sortByDesc("percent")->take(5);
        $fiveBest = $sorted->values()->all();

        /*--- NO IMPLEMENTATIONS ----*/
        $contactNoImpl = Contract::with("status")
            ->doesntHave("status")
            ->whereNotNull("signed_at")
            ->get();

        $noImplementations = $contactNoImpl->take(5)->map(function ($contract){
             return [
                 "regNo" => $contract->reference_no,
                 "name" => $contract->title,
                 "signedDate" => date("d M Y", strtotime($contract->signed_at)),
                 "duration" => $contract->signed_at !== null
                     ? Carbon::createFromTimestamp(strtotime($contract->signed_at))->diffForHumans()
                     : "N/A" ,
                 "percent" => "0.00"
             ];
        });

        return response()->json([
           "result" => [
               "five_best" => $fiveBest,
               "no_implementation" => [
                   "total" => count($contactNoImpl),
                   "data" => $noImplementations
               ]
           ]
        ]);
    }

    public function signedAndNotSigned(): \Illuminate\Http\JsonResponse {
        $arrayReport = [];
        $categories = $this->getCategoriesContract();
        foreach ($categories as $category){
             $id = $category->id;
             $name = $category->name;
             $signed = Contract::whereNotNull("signed_at")
                ->where("category_id", $id)
                ->count();

             $draft = Contract::whereNull("signed_at")
                ->where("category_id", $id)
                ->count();

            $arrayReport[] = [
               "name" => $name,
               "data" => [ $signed , $draft]
            ];
        }
        return response()->json([
            "results" => $arrayReport
        ]);
    }

    public function internalAndExternal(): \Illuminate\Http\JsonResponse {
        $arrayReport2 = [];
        $categories = $this->getCategoriesContract();
        $total = 0;
        foreach ($categories as $category){
            $id = $category->id;
            $counting = Contract::where("category_id", $id)
                ->count();
            $total +=  (int) $counting;
            $arrayReport2[] = $counting;
        }
        $arrayReport2[] = $total;
        return response()->json([
                "results" => collect($arrayReport2)->reverse()->values()->all()
            ]);
    }

    public function getCategoriesContract(){
        return Category::whereNotNull("category_id")->get();
    }

    public function contractPerformancesGraph(): \Illuminate\Http\JsonResponse{

        Carbon::setLocale('en');

        /*-- 5 BEST PERFORMERS ---*/
        $contactImpl = Contract::with("status")
            ->whereNotNull("signed_at")
            ->get();
        $contractsWithAvgPercent = [];
        $categories = [];
        foreach ($contactImpl as $contract){
            $count = count($contract->status);
            $sum = 0;
            if($count > 0){
                foreach ($contract->status as $item){
                    $sum += $item['percent'];
                }
            }

            $averagePercent = $count > 0
                ? $sum / $count
                : 0;

            if($averagePercent !== 0){
                $categories[] =  substr($contract->title, 10);
                $contractsWithAvgPercent = round($averagePercent,2);
            }
        }
        $sorted1 = collect($categories)->take(5);
        $sorted = collect($contractsWithAvgPercent)->take(5);
        $percent = $sorted->values()->all();
        $categories = $sorted1->values()->all();

        return response()->json([
            "results" => [
                "categories" => $categories,
                "series" => $percent
            ]
        ]);
    }

    public function sectorsContracts(): \Illuminate\Http\JsonResponse{

        $sectors = Sector::orderBy("name","ASC")->get();
        $categories = [];
        $counting = [];

        foreach ($sectors as $sector){
            $categories[] = $sector["name"];
            $id = $sector["id"];
            $count = ContractParty::whereHas("institution", function ($query) use ($id) {
                $query->where("sector_id",$id);
            }) ->where("is_local",1)
                ->count();
            $counting[] = (int) $count;
        }

        return response()->json([
            "results" => [
                "categories" => $categories,
                "series" => $counting
            ]
        ]);
    }

    public function implementedAndNot(): \Illuminate\Http\JsonResponse{

        $contactNoImpl = Contract::with("status")
            ->doesntHave("status")
            ->whereNotNull("signed_at")
            ->count();

        $contactImpl = Contract::with("status")
            ->whereHas("status")
            ->whereNotNull("signed_at")
            ->count();

        $counting = [$contactImpl , $contactNoImpl];

        return response()->json([
            "results" => [
                "series" => $counting
            ]
        ]);
    }
}

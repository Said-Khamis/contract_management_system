<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateContractDeliveryTimelineRequest;
use App\Http\Requests\CreateContractOperationAreaRequest;
use App\Http\Requests\UpdateContractOperationAreaRequest;
use App\Models\Contract;
use App\Models\ContractDeliveryTimeline;
use App\Services\ContractDeliveryTimelineService;
use App\Services\ContractOperationAreaService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;
use Session;
use Throwable;

class ContractDeliveryController extends AppBaseController
{
    public function __construct(protected ContractDeliveryTimelineService $deliveryService) {}

    /**
     * Display a listing of the ContractDelivery
     *
     * @param Request $request
     *
     * @return View
     */
    /**
     * Show the form for creating a new ContractDelivery.
     *
     * @return View
     */
    public function create() : View
    {
        $id = Session::has('contractId')?Session::get('contractId'):1;
        $contract = Contract::find($id);
        return view('contract_delivery.create', compact('contract'));
    }

    /**
     * Store a newly created ContractDeliveryTimeline in storage.
     *
     * @param CreateContractDeliveryTimelineRequest $request
     *
     * @return RedirectResponse
     * @throws Throwable
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $input['contract_id'] = \Illuminate\Support\Facades\Session::has('contractId') ? Session::get('contractId') : 1;
        $this->deliveryService->createContractDeliveryTimeline($input);
        Alert::toast('Delivery Timeline saved successfully.');
        return back();
    }

    public function show(int $id) : View|RedirectResponse
    {
        $contractDelivery = $this->deliveryService->getContractDelivery($id);
        if (empty($contractDelivery)) {
            alert()->error('Model not found','Area of Contract Delivery not found');
            return redirect(route('contractDeliveries.index'));
        }
        return view('contract_delivery.show')->with('contractDelivery', $contractDelivery);
    }


    public function edit(int $id) : View|RedirectResponse
    {
        $contractDelivery = $this->deliveryService->getContractDelivery($id);
        if (empty($contractDelivery)) {
            alert()->error('Model not found','Delivery Timeline not found');
            return redirect(route('contractDeliveries.index'));
        }
        return view('contract_delivery.edit')->with('contractDelivery', $contractDelivery);
    }


    public function update(int $id,Request $request) : RedirectResponse
    {
        $contractDelivery = $this->deliveryService->getContractDelivery($id);
        if (empty($contractDelivery)) {
            alert()->error('Model not found','Delivery Timeline not found');
            return back();
        }
        $this->deliveryService->updatedContractDelivery($request->all(), $id);
        toast('Contract Timeline Delivery updated successfully.','success');
        return back();
    }

    public function destroy(int $id)
    {
        $contractDelivery = $this->deliveryService->getContractDelivery($id);
        if (empty($contractDelivery)) {
            alert()->error('Model not found','Contract Delivery Timeline not found');
            return redirect(route('contractss.show', [$contractDelivery->contract_id]));
        }
        $this->deliveryService->deleteContractDelivery($id);
        toast('Contract Delivery Timeline deleted successfully.','success');
        return redirect()->back();    }

}

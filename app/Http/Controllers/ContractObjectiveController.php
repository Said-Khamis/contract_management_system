<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateContractObjectiveRequest;
use App\Http\Requests\UpdateContractObjectiveRequest;
use App\Models\Contract;
use App\Services\ContractObjectiveService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Throwable;

class ContractObjectiveController extends AppBaseController
{
    public function __construct(protected ContractObjectiveService $objectiveService) {}

    /**
     * Display a listing of the ContractObjective.
     *
     * @param Request $request
     *
     * @return View
     */
    public function index(Request $request) : View
    {
        $contractObjectives = $this->objectiveService->findAll();

        return view('contract_objectives.index')
            ->with('contractObjectives', $contractObjectives);
    }

    /**
     * Show the form for creating a new ContractObjective.
     *
     * @return View|RedirectResponse
     */
    public function create(): View|RedirectResponse
    {
        $id = Session::has('contractId')?Session::get('contractId'):1;
        $contract = Contract::find($id);
//        if($contract->signed_at)
//        {
//            alert()->error('Failed','Please the contract is already completed');
//            return back();
//        }
        return view('contract_objectives.create', compact('contract'));
    }

    /**
     * Store a newly created ContractObjective in storage.
     *
     * @param CreateContractObjectiveRequest $request
     *
     * @return RedirectResponse
     * @throws Throwable
     */
    public function store(CreateContractObjectiveRequest $request): RedirectResponse
    {
        $input = $request->all();
        $this->objectiveService->createMultiple($input);
        toast('Contract Objective saved successfully.', 'success');

        return back();
    }

    /**
     * Display the specified ContractObjective.
     *
     * @param int $id
     *
     * @return View|RedirectResponse
     */
    public function show(int $id) : View|RedirectResponse
    {
        $contractObjective = $this->objectiveService->getContractObjective($id);

        if (empty($contractObjective)) {
            alert()->error('Model not found','Contract Objective not found');

            return redirect(route('contractObjectives.index'));
        }

        return view('contract_objectives.show')->with('contractObjective', $contractObjective);
    }

    /**
     * Show the form for editing the specified ContractObjective.
     *
     * @param int $id
     *
     * @return View|RedirectResponse
     */
    public function edit(int $id) : View|RedirectResponse
    {
        $contractObjective = $this->objectiveService->getContractObjective($id);

        if (empty($contractObjective)) {
            alert()->error('Model not found','Contract Objective not found');

            return redirect(route('contractObjectives.index'));
        }
        return view('contract_objectives.edit', compact('contractObjective'));
    }

    /**
     * Update the specified ContractObjective in storage.
     *
     * @param int $id
     * @param UpdateContractObjectiveRequest $request
     *
     * @return RedirectResponse
     * @throws Throwable
     */
    public function update(int $id, UpdateContractObjectiveRequest $request) : RedirectResponse
    {
        $contractObjective = $this->objectiveService->getContractObjective($id);
        if (empty($contractObjective)) {
            alert()->error('Model not found','Contract Objective not found');

            return redirect(route('contractObjectives.index'));
        }

        $this->objectiveService->updateContractObjective($request->all(), $id);

        toast('Contract Objective updated successfully.', 'success');

        return redirect()->back();
    }

    /**
     * Remove the specified ContractObjective from storage.
     *
     * @param int $id
     *
     * @return RedirectResponse
     * @throws Exception|Throwable
     *
     */
    public function destroy(int $id) : RedirectResponse
    {
        $contractObjective = $this->objectiveService->getContractObjective($id);

        if (empty($contractObjective)) {
            alert()->error('Model not found','Contract Objective not found');

            return redirect(route('contractObjectives.index'));
        }

        $this->objectiveService->deleteContractObjective($id);

        toast('Contract Objective deleted successfully.','success');

        return redirect()->back();
    }

}

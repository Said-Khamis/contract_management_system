<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateContractResponsibilityRequest;
use App\Http\Requests\UpdateContractResponsibilityRequest;
use App\Models\Contract;
use App\Models\Role;
use App\Models\User;
use App\Services\ContractResponsibilityService;
use App\Services\UserManagementService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\View\View;
use Throwable;

class ContractResponsibilityController extends AppBaseController
{
    public function __construct(protected ContractResponsibilityService $contractResponsibilityService,UserManagementService $userManagementService) {}

    /**
     * Display a listing of the ContractResponsibility.
     *
     * @param Request $request
     *
     * @return View
     */
    public function index(Request $request) : View
    {
        $contractResponsibilities = $this->contractResponsibilityService->findAll();

        return view('contract_responsibilities.index')
            ->with('contractResponsibilities', $contractResponsibilities);
    }

    /**
     * Show the form for creating a new ContractResponsibility.
     *
     * @return View|RedirectResponse
     */
    public function create() : View|RedirectResponse
    {
        $id = Session::has('contractId')?Session::get('contractId'):1;
        $contract = Contract::find($id);
//        if($contract->signed_at)
//        {
//            alert()->error('Failed','Please the contract is already completed');
//            return back();
//        }
        return view('contract_responsibilities.create',compact('contract'));
    }

    /**
     * Store a newly created ContractResponsibility in storage.
     *
     * @param CreateContractResponsibilityRequest $request
     *
     * @return RedirectResponse
     * @throws Throwable
     */
    public function store(CreateContractResponsibilityRequest $request) : RedirectResponse
    {
        $input = $request->all();

        $this->contractResponsibilityService->createContractResponsibility($input);

        toast('Party responsibility assigned successfully.');

        return back();
    }

    /**
     * Display the specified ContractResponsibility.
     *
     * @param int $id
     *
     * @return View|RedirectResponse
     */
    public function show(int $id) : View|RedirectResponse
    {
        $contractResponsibility = $this->contractResponsibilityService->getContractResponsibility($id);

        if (empty($contractResponsibility)) {
            alert()->error('Model not found','Party responsibility not found');

            return redirect(route('contractss.index'));
        }

        return view('contract_responsibilities.show')->with('contractResponsibility', $contractResponsibility);
    }


    /**
     * Show the form for editing the specified ContractResponsibility.
     *
     * @param int $id
     *
     * @return View|RedirectResponse
     */
    public function edit(int $id) : View|RedirectResponse
    {
        $contractResponsibility = $this->contractResponsibilityService->getContractResponsibility($id);

        if (empty($contractResponsibility)) {
            alert()->error('Party responsibility not found');

            return redirect(route('contractss.index'));
        }
        $contract = Contract::find($contractResponsibility->contract_id);

        return view('contract_responsibilities.edit', compact('contract','contractResponsibility'));
    }

    /**
     * Update the specified ContractResponsibility in storage.
     *
     * @param int $id
     * @param UpdateContractResponsibilityRequest $request
     *
     * @return RedirectResponse
     * @throws Throwable
     */
    public function update(int $id, UpdateContractResponsibilityRequest $request) : RedirectResponse
    {
        $contractResponsibility = $this->contractResponsibilityService->getContractResponsibility($id);

        if (empty($contractResponsibility)) {
            alert()->error('Model not found','Party responsibility not found');

            return back();
        }

        $this->contractResponsibilityService->updateContractResponsibility($request->all(), $id);

        toast('Party responsibility updated successfully.','success');

        return back();
    }

    /**
     * Remove the specified ContractResponsibility from storage.
     *
     * @param int $id
     *
     * @return RedirectResponse
     * @throws Throwable
     *
     * @throws Exception
     */
    public function destroy(int $id) : RedirectResponse
    {
        $contractResponsibility = $this->contractResponsibilityService->getContractResponsibility($id);

        if (empty($contractResponsibility)) {
            alert()->error('Model not found','Party responsibility not found');

            return redirect(route('contractss.index'));
        }

        $this->contractResponsibilityService->deleteContractResponsibility($id);

        toast('Party responsibility removed successfully.','success');

        return redirect(route('contractss.show', $contractResponsibility->contract_id));
    }
}

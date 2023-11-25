<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateActionPlanRequest;
use App\Http\Requests\UpdateActionPlanRequest;
use App\Models\Attachment;
use App\Models\Contract;
use App\Repositories\ActionPlanRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\ActionPlan;
use App\Services\ActionPlanService;
use App\Services\AttachmentService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Redirect as FacadesRedirect;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Response;
use Illuminate\View\View;
use Redirect;
use Throwable;

class ActionPlanController extends AppBaseController
{

    public function __construct(
        protected ActionPlanService $actionPlanService,
        protected AttachmentService $attachmentService
    ){}

    /**
     * Display a listing of the ActionPlan.
     *
     * @return View
     */
    public function index(): View
    {
        $contractActionPlans = $this->actionPlanService->findAll();
        return view('contract_action_plans.index')->with('contractActionPlans', $contractActionPlans);

    }

    /**
     * Show the form for creating a new ActionPlan.
     *
     * @return View|RedirectResponse
     */


    public function create(): View|RedirectResponse
    {
        $id = Session::has('contractId')?Session::get('contractId'):1;
        $contract = Contract::find($id);
        $contractActionPlan=null;
//        if($contract->signed_at)
//        {
//            alert()->error('Failed','Please the contract is already completed');
//            return back();
//        }
        return view('contract_action_plans.create', compact('contract','contractActionPlan'));
    }


    /**
     * Store a newly created ActionPlan in storage.
     *
     * @param CreateActionPlanRequest $request
     *
     * @return RedirectResponse
     * @throws Throwable
     */
    public function store(CreateActionPlanRequest $request): RedirectResponse
    {
        $input = $request->all();
        $actionPlan=  $this->actionPlanService->createActionPlan($input);
        $actionPlanId = $actionPlan->id;
        $input['attachable_id'] = $actionPlanId;
        $input['attachable_type'] = 'App\Models\ActionPlan';
        $this->attachmentService->createSingleAttachment($input);
        toast('Action Plan saved successfully.', 'success');
        return back();
    }

    /**
     * Display the specified ActionPlan.
     *
     * @param int|string $id
     *
     * @return Application|\Illuminate\Foundation\Application|Redirector|RedirectResponse
     */
    public function show(int|string $id): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $actionPlan = $this->actionPlanService->getActionPlan($id);
        if (empty($actionPlan)) {
            return redirect(route('cotractActionPlans.index'));
        }
        return view('contract_action_plans.show')->with('actionPlan', $actionPlan);
    }

    /**
     * Show the form for editing the specified ActionPlan.
     *
     * @param int|string $id
     *
     * @return Application|\Illuminate\Foundation\Application|Redirector|RedirectResponse
     */
    public function edit(int|string $id): Application|\Illuminate\Foundation\Application|RedirectResponse|Redirector
    {
        $actionPlan = $this->actionPlanService->getActionPlan($id);
        if (empty($actionPlan)) {
            Alert::error('Action Plan not found');
            return redirect(route('actionPlans.index'));
        }
        return view('action_plans.edit')->with('actionPlan', $actionPlan);
    }

    /**
     * Update the specified ActionPlan in storage.
     *
     * @param int $id
     * @param UpdateActionPlanRequest $request
     *
     * @return RedirectResponse
     */
    public function update(int $id, UpdateActionPlanRequest $request): RedirectResponse
    {
        $actionPlan = $this->actionPlanService->getActionPlan($id);

        if (empty($actionPlan)) {
            Alert::error('Action Plan not found');

            return redirect(route('actionPlans.index'));
        }

        $actionPlan = $this->actionPlanService->updatePlanService($request->all(), $id);

        toast('Action Plan saved successfully.', 'success');

        return redirect(route('actionPlans.index'));
    }

    /**
     * Remove the specified ActionPlan from storage.
     *
     * @param int $id
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(int $id): RedirectResponse
    {
        $actionPlan = $this->actionPlanService->getActionPlan($id);

        if (empty($actionPlan)) {
            Alert::error('Action Plan not found');

            return redirect(route('actionPlans.index'));
        }

        $this->actionPlanService->deleteActionPlan($id);

        toast('Contract notice deleted successfully.', 'success');
        return back();
    }



}

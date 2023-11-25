<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateContractNoticeRequest;
use App\Http\Requests\UpdateContractNoticeRequest;
use App\Models\Contract;
use App\Services\ContractNoticeService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Exception;
use Illuminate\View\View;
use Session;
use Throwable;

class ContractNoticeController extends AppBaseController
{
    public function __construct(protected ContractNoticeService $contractNoticeService) {}

    /**
     * Display a listing of the ContractNotice.
     *
     * @param Request $request
     *
     * @return View
     */
    public function index(Request $request) : View
    {
        $contractNotices = $this->contractNoticeService->findAll();

        $title = 'Remove Notice!';
        $message = 'Are you sure you want to remove notice?';
        confirmDelete($title, $message);

        return view('contract_notices.index')
            ->with('contractNotices', $contractNotices);
    }

    /**
     * Show the form for creating a new ContractNotice.
     *
     * @return View
     */
    public function create() : View
    {
        $id = Session::has('contractId')?Session::get('contractId'):18;
        $contract = Contract::find($id);
        $contractNotice=null;
        return view('contract_notices.create', compact('contract','contractNotice'));

    }

    /**
     * Store a newly created ContractNotice in storage.
     *
     * @param CreateContractNoticeRequest $request
     *
     * @return RedirectResponse
     * @throws Throwable
     */
    public function store(CreateContractNoticeRequest $request) : RedirectResponse
    {
        $input = $request->all();
        $this->contractNoticeService->createContractNotice($input);

        toast('Contract notice saved successfully.', 'success');

        return back();
    }

    /**
     * Display the specified ContractNotice.
     *
     * @param int $id
     *
     * @return View|RedirectResponse
     */
    public function show(int $id) : View|RedirectResponse
    {
        $contractNotice = $this->contractNoticeService->getContractNotice($id);

        if (empty($contractNotice)) {
            alert()->error('Model not found','Contract Notice not found');

            return redirect(route('contractNotices.index'));
        }

        return view('contract_notices.show')->with('contractNotice', $contractNotice);
    }

    /**
     * Show the form for editing the specified ContractNotice.
     *
     * @param int $id
     *
     * @return View|RedirectResponse
     */
    public function edit(int $id) : View|RedirectResponse
    {
        $contractNotice = $this->contractNoticeService->getContractNotice($id);

        if (empty($contractNotice)) {
            alert()->error('Model not found','Notice not found');

            return redirect(route('contractNotices.index'));
        }

        return view('contract_notices.edit')->with('contractNotice', $contractNotice);
    }

    /**
     * Update the specified ContractNotice in storage.
     *
     * @param int $id
     * @param UpdateContractNoticeRequest $request
     *
     * @return RedirectResponse
     * @throws Throwable
     */
    public function update(int $id, UpdateContractNoticeRequest $request) : RedirectResponse
    {
        $contractNotice = $this->contractNoticeService->getContractNotice($id);

        if (empty($contractNotice)) {
            alert()->error('Model not found','Notice not found');

            return back();
        }

        $this->contractNoticeService->updatedContractNotice($request->all(), $id);

        toast('Contract Notice updated successfully.','success');

        return back();
    }

    /**
     * Remove the specified ContractNotice from storage.
     *
     * @param int $id
     *
     * @return RedirectResponse
     * @throws Throwable|Exception
     */
    public function destroy(int $id) : RedirectResponse
    {
        $contractNotice = $this->contractNoticeService->getContractNotice($id);

        if (empty($contractNotice)) {
            alert()->error('Model not found','Notice not found');

            return redirect(route('contractss.show', [$contractNotice->contract_id]));
        }
        foreach ($contractNotice->attachments as $attachment)
        {
            if($attachment->url)
            {
                unlink($attachment->url);
            }
            $attachment->delete();
        }
        $this->contractNoticeService->deleteContractNotice($id);

        toast('Notice deleted successfully.','success');

        return redirect(route('contractss.show', [$contractNotice->contract_id]));
    }
}

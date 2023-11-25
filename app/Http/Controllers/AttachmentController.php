<?php

namespace App\Http\Controllers;

use App\Exceptions\FileException;
use App\Http\Requests\CreateAttachmentRequest;
use App\Http\Requests\UpdateAttachmentRequest;
use Illuminate\View\View;
use App\Http\Controllers\AppBaseController;
use App\Services\AttachmentService;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;
use Response;
use Throwable;

class AttachmentController extends AppBaseController
{

    public function __construct(protected AttachmentService $attachmentService){}

    /**
     * Display a listing of the Attachment.
     *
     * @return View
     */
    public function index(): View
    {
        $attachments = $this->attachmentService->findAll();

        return view('attachments.index')
            ->with('attachments', $attachments);
    }

    /**
     * Show the form for creating a new Attachment.
     *
     * @return View
     */
    public function create(): View
    {
        return view('attachments.create');
    }

    /**
     * Store a newly created Attachment in storage.
     *
     * @param CreateAttachmentRequest $request
     *
     * @return RedirectResponse
     * @throws FileException
     * @throws Throwable
     */
    public function store(CreateAttachmentRequest $request): RedirectResponse
    {
        $input = $request->all();

        $attachment = $this->attachmentService->createAttachment($input);

        Alert::success('Attachment saved successfully.');

        return redirect(route('attachments.index'));
    }

    /**
     * Display the specified Attachment.
     *
     * @param int $id
     *
     * @return View
     */
    public function show($id): View|Redirect
    {
        $attachment = $this->attachmentService->getAttachment($id);

        if (empty($attachment)) {
            Flash::error('Attachment not found');

            return redirect(route('attachments.index'));
        }

        return view('attachments.show')->with('attachment', $attachment);
    }

    /**
     * Show the form for editing the specified Attachment.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id): Redirect|View
    {
        $attachment = $this->attachmentService->getAttachment($id);

        if (empty($attachment)) {
            Flash::error('Attachment not found');

            return redirect(route('attachments.index'));
        }

        return view('attachments.edit')->with('attachment', $attachment);
    }

    /**
     * Update the specified Attachment in storage.
     *
     * @param int $id
     * @param UpdateAttachmentRequest $request
     *
     * @return Redirect
     */
    public function update($id, UpdateAttachmentRequest $request): RedirectResponse
    {
        $attachment = $this->attachmentService->getAttachment($id);

        if (empty($attachment)) {
            Flash::error('Attachment not found');

            return redirect(route('attachments.index'));
        }

        $attachment = $this->attachmentService->updateAttachment($request->all(), $id);

        Flash::success('Attachment updated successfully.');

        return redirect(route('attachments.index'));
    }

    /**
     * Remove the specified Attachment from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $attachment = $this->attachmentService->getAttachment($id);

        if (empty($attachment)) {
            Flash::error('Attachment not found');

            return redirect(route('attachments.index'));
        }

        $this->attachmentService->deleteAttachment($id);

        Alert::toast('Attachment deleted successfully.','success');

        return redirect()->back();
    }
}

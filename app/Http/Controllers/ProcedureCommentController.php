<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProcedureCommentRequest;
use App\Http\Requests\UpdateProcedureCommentRequest;
use App\Http\Controllers\AppBaseController;
use App\Services\ProcedureCommentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;
use Response;

class ProcedureCommentController extends AppBaseController
{

    public function __construct(protected ProcedureCommentService $procedureCommentService){}

    /**
     * Display a listing of the ProcedureComment.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $procedureComments = $this->procedureCommentService->findAll();

        return view('procedure_comments.index')
            ->with('procedureComments', $procedureComments);
    }

    /**
     * Show the form for creating a new ProcedureComment.
     *
     * @return Response
     */
    public function create()
    {
        return view('procedure_comments.create');
    }

    /**
     * Store a newly created ProcedureComment in storage.
     *
     * @param CreateProcedureCommentRequest $request
     *
     * @return Response
     */
    public function store(CreateProcedureCommentRequest $request)
    {
        $input = $request->all();

        $procedureComment = $this->procedureCommentService->createProcedureComment($input);

        Alert::toast('Procedure Comment saved successfully.');

        return redirect(route('procedureComments.index'));
    }

    /**
     * Display the specified ProcedureComment.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show(int $id): View|RedirectResponse
    {
        $procedureComment = $this->procedureCommentService->getProcedureComment($id);

        if (empty($procedureComment)) {
            Alert::error('Procedure Comment not found');

            return redirect(route('procedureComments.index'));
        }

        return view('procedure_comments.show')->with('procedureComment', $procedureComment);
    }

    /**
     * Show the form for editing the specified ProcedureComment.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $procedureComment = $this->procedureCommentService->getProcedureComment($id);

        if (empty($procedureComment)) {
            Alert::error('Procedure Comment not found');

            return redirect(route('procedureComments.index'));
        }

        return view('procedure_comments.edit')->with('procedureComment', $procedureComment);
    }

    /**
     * Update the specified ProcedureComment in storage.
     *
     * @param int $id
     * @param UpdateProcedureCommentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProcedureCommentRequest $request)
    {
        $procedureComment = $this->procedureCommentService->getProcedureComment($id);

        if (empty($procedureComment)) {
            Alert::error('Procedure Comment not found');

            return redirect(route('procedureComments.index'));
        }

        $procedureComment = $this->procedureCommentService->updateProcedureComment($request->all(), $id);

        Alert::toast('Procedure Comment updated successfully.');

        return redirect(route('procedureComments.index'));
    }

    /**
     * Remove the specified ProcedureComment from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $procedureComment = $this->procedureCommentService->getProcedureComment($id);

        if (empty($procedureComment)) {
            Alert::error('Procedure Comment not found');

            return redirect(route('procedureComments.index'));
        }

        $this->procedureCommentService->deleteProcedureComment($id);

        Alert::toast('Procedure Comment deleted successfully.');

        return redirect(route('procedureComments.index'));
    }
}

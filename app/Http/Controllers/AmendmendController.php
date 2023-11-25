<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAmendmendRequest;
use App\Http\Requests\UpdateAmendmendRequest;
use App\Repositories\AmendmentRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class AmendmendController extends AppBaseController
{
    /** @var AmendmentRepository $amendmendRepository*/
    private $amendmendRepository;

    public function __construct(AmendmentRepository $amendmendRepo)
    {
        $this->amendmendRepository = $amendmendRepo;
    }

    /**
     * Display a listing of the Amendmend.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $amendmends = $this->amendmendRepository->all();

        return view('amendmends.index')
            ->with('amendmends', $amendmends);
    }

    /**
     * Show the form for creating a new Amendmend.
     *
     * @return Response
     */
    public function create()
    {
        return view('amendmends.create');
    }

    /**
     * Store a newly created Amendmend in storage.
     *
     * @param CreateAmendmendRequest $request
     *
     * @return Response
     */
    public function store(CreateAmendmendRequest $request)
    {
        $input = $request->all();

        $amendmend = $this->amendmendRepository->create($input);

        Flash::success('Amendmend saved successfully.');

        return redirect(route('amendmends.index'));
    }

    /**
     * Display the specified Amendmend.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $amendmend = $this->amendmendRepository->find($id);

        if (empty($amendmend)) {
            Flash::error('Amendmend not found');

            return redirect(route('amendmends.index'));
        }

        return view('amendmends.show')->with('amendmend', $amendmend);
    }

    /**
     * Show the form for editing the specified Amendmend.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $amendmend = $this->amendmendRepository->find($id);

        if (empty($amendmend)) {
            Flash::error('Amendmend not found');

            return redirect(route('amendmends.index'));
        }

        return view('amendmends.edit')->with('amendmend', $amendmend);
    }

    /**
     * Update the specified Amendmend in storage.
     *
     * @param int $id
     * @param UpdateAmendmendRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAmendmendRequest $request)
    {
        $amendmend = $this->amendmendRepository->find($id);

        if (empty($amendmend)) {
            Flash::error('Amendmend not found');

            return redirect(route('amendmends.index'));
        }

        $amendmend = $this->amendmendRepository->update($request->all(), $id);

        Flash::success('Amendmend updated successfully.');

        return redirect(route('amendmends.index'));
    }

    /**
     * Remove the specified Amendmend from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $amendmend = $this->amendmendRepository->find($id);

        if (empty($amendmend)) {
            Flash::error('Amendmend not found');

            return redirect(route('amendmends.index'));
        }

        $this->amendmendRepository->delete($id);

        Flash::success('Amendmend deleted successfully.');

        return redirect(route('amendmends.index'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateContractPartyRequest;
use App\Http\Requests\UpdateContractPartyRequest;
use App\Repositories\ContractPartyRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ContractPartyController extends AppBaseController
{
    /** @var ContractPartyRepository $contractPartyRepository*/
    private $contractPartyRepository;

    public function __construct(ContractPartyRepository $contractPartyRepo)
    {
        $this->contractPartyRepository = $contractPartyRepo;
    }

    /**
     * Display a listing of the ContractParty.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $contractParties = $this->contractPartyRepository->paginate(10);

        return view('contract_parties.index')
            ->with('contractParties', $contractParties);
    }

    /**
     * Show the form for creating a new ContractParty.
     *
     * @return Response
     */
    public function create()
    {
        return view('contract_parties.create');
    }

    /**
     * Store a newly created ContractParty in storage.
     *
     * @param CreateContractPartyRequest $request
     *
     * @return Response
     */
    public function store(CreateContractPartyRequest $request)
    {
        $input = $request->all();

        $contractParty = $this->contractPartyRepository->create($input);

        Flash::success('Contract Party saved successfully.');

        return redirect(route('contractParties.index'));
    }

    /**
     * Display the specified ContractParty.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $contractParty = $this->contractPartyRepository->find($id);

        if (empty($contractParty)) {
            Flash::error('Contract Party not found');

            return redirect(route('contractParties.index'));
        }

        return view('contract_parties.show')->with('contractParty', $contractParty);
    }

    /**
     * Show the form for editing the specified ContractParty.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $contractParty = $this->contractPartyRepository->find($id);

        if (empty($contractParty)) {
            Flash::error('Contract Party not found');

            return redirect(route('contractParties.index'));
        }

        return view('contract_parties.edit')->with('contractParty', $contractParty);
    }

    /**
     * Update the specified ContractParty in storage.
     *
     * @param int $id
     * @param UpdateContractPartyRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateContractPartyRequest $request)
    {
        $contractParty = $this->contractPartyRepository->find($id);

        if (empty($contractParty)) {
            Flash::error('Contract Party not found');

            return redirect(route('contractParties.index'));
        }

        $contractParty = $this->contractPartyRepository->update($request->all(), $id);

        Flash::success('Contract Party updated successfully.');

        return redirect(route('contractParties.index'));
    }

    /**
     * Remove the specified ContractParty from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $contractParty = $this->contractPartyRepository->find($id);

        if (empty($contractParty)) {
            Flash::error('Contract Party not found');

            return redirect(route('contractParties.index'));
        }

        $this->contractPartyRepository->delete($id);

        Flash::success('Contract Party deleted successfully.');

        return redirect(route('contractParties.index'));
    }
}

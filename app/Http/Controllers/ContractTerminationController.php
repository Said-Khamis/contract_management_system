<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateContractTerminationRequest;
use App\Http\Requests\UpdateContractTerminationRequest;
use App\Repositories\ContractTerminationRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ContractTerminationController extends AppBaseController
{
    /** @var ContractTerminationRepository $contractTerminationRepository*/
    private $contractTerminationRepository;

    public function __construct(ContractTerminationRepository $contractTerminationRepo)
    {
        $this->contractTerminationRepository = $contractTerminationRepo;
    }

    /**
     * Display a listing of the ContractTermination.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $contractTerminations = $this->contractTerminationRepository->all();

        return view('contract_terminations.index')
            ->with('contractTerminations', $contractTerminations);
    }

    /**
     * Show the form for creating a new ContractTermination.
     *
     * @return Response
     */
    public function create()
    {
        return view('contract_terminations.create');
    }

    /**
     * Store a newly created ContractTermination in storage.
     *
     * @param CreateContractTerminationRequest $request
     *
     * @return Response
     */
    public function store(CreateContractTerminationRequest $request)
    {
        $input = $request->all();

        $contractTermination = $this->contractTerminationRepository->create($input);

        Flash::success('Contract Termination saved successfully.');

        return redirect(route('contractTerminations.index'));
    }

    /**
     * Display the specified ContractTermination.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $contractTermination = $this->contractTerminationRepository->find($id);

        if (empty($contractTermination)) {
            Flash::error('Contract Termination not found');

            return redirect(route('contractTerminations.index'));
        }

        return view('contract_terminations.show')->with('contractTermination', $contractTermination);
    }

    /**
     * Show the form for editing the specified ContractTermination.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $contractTermination = $this->contractTerminationRepository->find($id);

        if (empty($contractTermination)) {
            Flash::error('Contract Termination not found');

            return redirect(route('contractTerminations.index'));
        }

        return view('contract_terminations.edit')->with('contractTermination', $contractTermination);
    }

    /**
     * Update the specified ContractTermination in storage.
     *
     * @param int $id
     * @param UpdateContractTerminationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateContractTerminationRequest $request)
    {
        $contractTermination = $this->contractTerminationRepository->find($id);

        if (empty($contractTermination)) {
            Flash::error('Contract Termination not found');

            return redirect(route('contractTerminations.index'));
        }

        $contractTermination = $this->contractTerminationRepository->update($request->all(), $id);

        Flash::success('Contract Termination updated successfully.');

        return redirect(route('contractTerminations.index'));
    }

    /**
     * Remove the specified ContractTermination from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $contractTermination = $this->contractTerminationRepository->find($id);

        if (empty($contractTermination)) {
            Flash::error('Contract Termination not found');

            return redirect(route('contractTerminations.index'));
        }

        $this->contractTerminationRepository->delete($id);

        Flash::success('Contract Termination deleted successfully.');

        return redirect(route('contractTerminations.index'));
    }
}

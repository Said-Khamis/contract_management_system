<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateContractAPIRequest;
use App\Http\Requests\API\UpdateContractAPIRequest;
use App\Models\Contract;
use App\Repositories\ContractRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\ContractResource;
use Response;

/**
 * Class ContractController
 * @package App\Http\Controllers\API
 */

class ContractAPIController extends AppBaseController
{
    /** @var  ContractRepository */
    private $contractRepository;

    public function __construct(ContractRepository $contractRepo)
    {
        $this->contractRepository = $contractRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/contractss",
     *      summary="getContractList",
     *      tags={"Contract"},
     *      description="Get all Contracts",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(ref="#/definitions/Contract")
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $contracts = $this->contractRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(ContractResource::collection($contracts), 'Contracts retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/contractss",
     *      summary="createContract",
     *      tags={"Contract"},
     *      description="Create Contract",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\MediaType(
     *            mediaType="application/x-www-form-urlencoded",
     *            @OA\Schema(
     *                type="object",
     *                required={""},
     *                @OA\Property(
     *                    property="name",
     *                    description="desc",
     *                    type="string"
     *                )
     *            )
     *        )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/definitions/Contract"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateContractAPIRequest $request)
    {
        $input = $request->all();

        $contract = $this->contractRepository->create($input);

        return $this->sendResponse(new ContractResource($contract), 'Contract saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/contractss/{id}",
     *      summary="getContractItem",
     *      tags={"Contract"},
     *      description="Get Contract",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Contract",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/definitions/Contract"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Contract $contract */
        $contract = $this->contractRepository->find($id);

        if (empty($contract)) {
            return $this->sendError('Contract not found');
        }

        return $this->sendResponse(new ContractResource($contract), 'Contract retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/contractss/{id}",
     *      summary="updateContract",
     *      tags={"Contract"},
     *      description="Update Contract",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Contract",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\MediaType(
     *            mediaType="application/x-www-form-urlencoded",
     *            @OA\Schema(
     *                type="object",
     *                required={""},
     *                @OA\Property(
     *                    property="name",
     *                    description="desc",
     *                    type="string"
     *                )
     *            )
     *        )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/definitions/Contract"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateContractAPIRequest $request)
    {
        $input = $request->all();

        /** @var Contract $contract */
        $contract = $this->contractRepository->find($id);

        if (empty($contract)) {
            return $this->sendError('Contract not found');
        }

        $contract = $this->contractRepository->update($input, $id);

        return $this->sendResponse(new ContractResource($contract), 'Contract updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/contractss/{id}",
     *      summary="deleteContract",
     *      tags={"Contract"},
     *      description="Delete Contract",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Contract",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Contract $contract */
        $contract = $this->contractRepository->find($id);

        if (empty($contract)) {
            return $this->sendError('Contract not found');
        }

        $contract->delete();

        return $this->sendSuccess('Contract deleted successfully');
    }
}

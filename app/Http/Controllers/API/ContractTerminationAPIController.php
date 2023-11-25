<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateContractTerminationAPIRequest;
use App\Http\Requests\API\UpdateContractTerminationAPIRequest;
use App\Models\ContractTermination;
use App\Repositories\ContractTerminationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\ContractTerminationResource;
use Response;

/**
 * Class ContractTerminationController
 * @package App\Http\Controllers\API
 */

class ContractTerminationAPIController extends AppBaseController
{
    /** @var  ContractTerminationRepository */
    private $contractTerminationRepository;

    public function __construct(ContractTerminationRepository $contractTerminationRepo)
    {
        $this->contractTerminationRepository = $contractTerminationRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/contractTerminations",
     *      summary="getContractTerminationList",
     *      tags={"ContractTermination"},
     *      description="Get all ContractTerminations",
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
     *                  @OA\Items(ref="#/definitions/ContractTermination")
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
        $contractTerminations = $this->contractTerminationRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(ContractTerminationResource::collection($contractTerminations), 'Contract Terminations retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/contractTerminations",
     *      summary="createContractTermination",
     *      tags={"ContractTermination"},
     *      description="Create ContractTermination",
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
     *                  ref="#/definitions/ContractTermination"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateContractTerminationAPIRequest $request)
    {
        $input = $request->all();

        $contractTermination = $this->contractTerminationRepository->create($input);

        return $this->sendResponse(new ContractTerminationResource($contractTermination), 'Contract Termination saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/contractTerminations/{id}",
     *      summary="getContractTerminationItem",
     *      tags={"ContractTermination"},
     *      description="Get ContractTermination",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ContractTermination",
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
     *                  ref="#/definitions/ContractTermination"
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
        /** @var ContractTermination $contractTermination */
        $contractTermination = $this->contractTerminationRepository->find($id);

        if (empty($contractTermination)) {
            return $this->sendError('Contract Termination not found');
        }

        return $this->sendResponse(new ContractTerminationResource($contractTermination), 'Contract Termination retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/contractTerminations/{id}",
     *      summary="updateContractTermination",
     *      tags={"ContractTermination"},
     *      description="Update ContractTermination",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ContractTermination",
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
     *                  ref="#/definitions/ContractTermination"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateContractTerminationAPIRequest $request)
    {
        $input = $request->all();

        /** @var ContractTermination $contractTermination */
        $contractTermination = $this->contractTerminationRepository->find($id);

        if (empty($contractTermination)) {
            return $this->sendError('Contract Termination not found');
        }

        $contractTermination = $this->contractTerminationRepository->update($input, $id);

        return $this->sendResponse(new ContractTerminationResource($contractTermination), 'ContractTermination updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/contractTerminations/{id}",
     *      summary="deleteContractTermination",
     *      tags={"ContractTermination"},
     *      description="Delete ContractTermination",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ContractTermination",
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
        /** @var ContractTermination $contractTermination */
        $contractTermination = $this->contractTerminationRepository->find($id);

        if (empty($contractTermination)) {
            return $this->sendError('Contract Termination not found');
        }

        $contractTermination->delete();

        return $this->sendSuccess('Contract Termination deleted successfully');
    }
}

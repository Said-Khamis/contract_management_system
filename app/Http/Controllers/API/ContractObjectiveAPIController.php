<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateContractObjectiveAPIRequest;
use App\Http\Requests\API\UpdateContractObjectiveAPIRequest;
use App\Models\ContractObjective;
use App\Repositories\ContractObjectiveRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\ContractObjectiveResource;
use Response;

/**
 * Class ContractObjectiveController
 * @package App\Http\Controllers\API
 */

class ContractObjectiveAPIController extends AppBaseController
{
    /** @var  ContractObjectiveRepository */
    private $contractObjectiveRepository;

    public function __construct(ContractObjectiveRepository $contractObjectiveRepo)
    {
        $this->contractObjectiveRepository = $contractObjectiveRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/contractObjectives",
     *      summary="getContractObjectiveList",
     *      tags={"ContractObjective"},
     *      description="Get all ContractObjectives",
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
     *                  @OA\Items(ref="#/definitions/ContractObjective")
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
        $contractObjectives = $this->contractObjectiveRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(ContractObjectiveResource::collection($contractObjectives), 'Contract Objectives retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/contractObjectives",
     *      summary="createContractObjective",
     *      tags={"ContractObjective"},
     *      description="Create ContractObjective",
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
     *                  ref="#/definitions/ContractObjective"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateContractObjectiveAPIRequest $request)
    {
        $input = $request->all();

        $contractObjective = $this->contractObjectiveRepository->create($input);

        return $this->sendResponse(new ContractObjectiveResource($contractObjective), 'Contract Objective saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/contractObjectives/{id}",
     *      summary="getContractObjectiveItem",
     *      tags={"ContractObjective"},
     *      description="Get ContractObjective",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ContractObjective",
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
     *                  ref="#/definitions/ContractObjective"
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
        /** @var ContractObjective $contractObjective */
        $contractObjective = $this->contractObjectiveRepository->find($id);

        if (empty($contractObjective)) {
            return $this->sendError('Contract Objective not found');
        }

        return $this->sendResponse(new ContractObjectiveResource($contractObjective), 'Contract Objective retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/contractObjectives/{id}",
     *      summary="updateContractObjective",
     *      tags={"ContractObjective"},
     *      description="Update ContractObjective",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ContractObjective",
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
     *                  ref="#/definitions/ContractObjective"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateContractObjectiveAPIRequest $request)
    {
        $input = $request->all();

        /** @var ContractObjective $contractObjective */
        $contractObjective = $this->contractObjectiveRepository->find($id);

        if (empty($contractObjective)) {
            return $this->sendError('Contract Objective not found');
        }

        $contractObjective = $this->contractObjectiveRepository->update($input, $id);

        return $this->sendResponse(new ContractObjectiveResource($contractObjective), 'ContractObjective updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/contractObjectives/{id}",
     *      summary="deleteContractObjective",
     *      tags={"ContractObjective"},
     *      description="Delete ContractObjective",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ContractObjective",
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
        /** @var ContractObjective $contractObjective */
        $contractObjective = $this->contractObjectiveRepository->find($id);

        if (empty($contractObjective)) {
            return $this->sendError('Contract Objective not found');
        }

        $contractObjective->delete();

        return $this->sendSuccess('Contract Objective deleted successfully');
    }
}

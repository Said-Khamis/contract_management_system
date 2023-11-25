<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateContractOperationAreaAPIRequest;
use App\Http\Requests\API\UpdateContractOperationAreaAPIRequest;
use App\Models\ContractOperationArea;
use App\Repositories\ContractOperationAreaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\ContractOperationAreaResource;
use Response;

/**
 * Class ContractOperationAreaController
 * @package App\Http\Controllers\API
 */

class ContractOperationAreaAPIController extends AppBaseController
{
    /** @var  ContractOperationAreaRepository */
    private $contractOperationAreaRepository;

    public function __construct(ContractOperationAreaRepository $contractOperationAreaRepo)
    {
        $this->contractOperationAreaRepository = $contractOperationAreaRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/contractOperationAreas",
     *      summary="getContractOperationAreaList",
     *      tags={"ContractOperationArea"},
     *      description="Get all ContractOperationAreas",
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
     *                  @OA\Items(ref="#/definitions/ContractOperationArea")
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
        $contractOperationAreas = $this->contractOperationAreaRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(ContractOperationAreaResource::collection($contractOperationAreas), 'Contract Operation Areas retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/contractOperationAreas",
     *      summary="createContractOperationArea",
     *      tags={"ContractOperationArea"},
     *      description="Create ContractOperationArea",
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
     *                  ref="#/definitions/ContractOperationArea"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateContractOperationAreaAPIRequest $request)
    {
        $input = $request->all();

        $contractOperationArea = $this->contractOperationAreaRepository->create($input);

        return $this->sendResponse(new ContractOperationAreaResource($contractOperationArea), 'Contract Operation Area saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/contractOperationAreas/{id}",
     *      summary="getContractOperationAreaItem",
     *      tags={"ContractOperationArea"},
     *      description="Get ContractOperationArea",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ContractOperationArea",
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
     *                  ref="#/definitions/ContractOperationArea"
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
        /** @var ContractOperationArea $contractOperationArea */
        $contractOperationArea = $this->contractOperationAreaRepository->find($id);

        if (empty($contractOperationArea)) {
            return $this->sendError('Contract Operation Area not found');
        }

        return $this->sendResponse(new ContractOperationAreaResource($contractOperationArea), 'Contract Operation Area retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/contractOperationAreas/{id}",
     *      summary="updateContractOperationArea",
     *      tags={"ContractOperationArea"},
     *      description="Update ContractOperationArea",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ContractOperationArea",
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
     *                  ref="#/definitions/ContractOperationArea"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateContractOperationAreaAPIRequest $request)
    {
        $input = $request->all();

        /** @var ContractOperationArea $contractOperationArea */
        $contractOperationArea = $this->contractOperationAreaRepository->find($id);

        if (empty($contractOperationArea)) {
            return $this->sendError('Contract Operation Area not found');
        }

        $contractOperationArea = $this->contractOperationAreaRepository->update($input, $id);

        return $this->sendResponse(new ContractOperationAreaResource($contractOperationArea), 'ContractOperationArea updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/contractOperationAreas/{id}",
     *      summary="deleteContractOperationArea",
     *      tags={"ContractOperationArea"},
     *      description="Delete ContractOperationArea",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ContractOperationArea",
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
        /** @var ContractOperationArea $contractOperationArea */
        $contractOperationArea = $this->contractOperationAreaRepository->find($id);

        if (empty($contractOperationArea)) {
            return $this->sendError('Contract Operation Area not found');
        }

        $contractOperationArea->delete();

        return $this->sendSuccess('Contract Operation Area deleted successfully');
    }
}

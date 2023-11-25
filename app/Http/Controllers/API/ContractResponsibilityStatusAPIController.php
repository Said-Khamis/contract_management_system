<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateContractResponsibilityStatusAPIRequest;
use App\Http\Requests\API\UpdateContractResponsibilityStatusAPIRequest;
use App\Models\ContractResponsibilityStatus;
use App\Repositories\ContractResponsibilityStatusRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\ContractResponsibilityStatusResource;
use Response;

/**
 * Class ContractResponsibilityStatusController
 * @package App\Http\Controllers\API
 */

class ContractResponsibilityStatusAPIController extends AppBaseController
{
    /** @var  ContractResponsibilityStatusRepository */
    private $contractResponsibilityStatusRepository;

    public function __construct(ContractResponsibilityStatusRepository $contractResponsibilityStatusRepo)
    {
        $this->contractResponsibilityStatusRepository = $contractResponsibilityStatusRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/contractResponsibilityStatuses",
     *      summary="getContractResponsibilityStatusList",
     *      tags={"ContractResponsibilityStatus"},
     *      description="Get all ContractResponsibilityStatuses",
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
     *                  @OA\Items(ref="#/definitions/ContractResponsibilityStatus")
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
        $contractResponsibilityStatuses = $this->contractResponsibilityStatusRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(ContractResponsibilityStatusResource::collection($contractResponsibilityStatuses), 'Contract Responsibility Statuses retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/contractResponsibilityStatuses",
     *      summary="createContractResponsibilityStatus",
     *      tags={"ContractResponsibilityStatus"},
     *      description="Create ContractResponsibilityStatus",
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
     *                  ref="#/definitions/ContractResponsibilityStatus"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateContractResponsibilityStatusAPIRequest $request)
    {
        $input = $request->all();

        $contractResponsibilityStatus = $this->contractResponsibilityStatusRepository->create($input);

        return $this->sendResponse(new ContractResponsibilityStatusResource($contractResponsibilityStatus), 'Contract Responsibility Status saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/contractResponsibilityStatuses/{id}",
     *      summary="getContractResponsibilityStatusItem",
     *      tags={"ContractResponsibilityStatus"},
     *      description="Get ContractResponsibilityStatus",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ContractResponsibilityStatus",
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
     *                  ref="#/definitions/ContractResponsibilityStatus"
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
        /** @var ContractResponsibilityStatus $contractResponsibilityStatus */
        $contractResponsibilityStatus = $this->contractResponsibilityStatusRepository->find($id);

        if (empty($contractResponsibilityStatus)) {
            return $this->sendError('Contract Responsibility Status not found');
        }

        return $this->sendResponse(new ContractResponsibilityStatusResource($contractResponsibilityStatus), 'Contract Responsibility Status retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/contractResponsibilityStatuses/{id}",
     *      summary="updateContractResponsibilityStatus",
     *      tags={"ContractResponsibilityStatus"},
     *      description="Update ContractResponsibilityStatus",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ContractResponsibilityStatus",
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
     *                  ref="#/definitions/ContractResponsibilityStatus"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateContractResponsibilityStatusAPIRequest $request)
    {
        $input = $request->all();

        /** @var ContractResponsibilityStatus $contractResponsibilityStatus */
        $contractResponsibilityStatus = $this->contractResponsibilityStatusRepository->find($id);

        if (empty($contractResponsibilityStatus)) {
            return $this->sendError('Contract Responsibility Status not found');
        }

        $contractResponsibilityStatus = $this->contractResponsibilityStatusRepository->update($input, $id);

        return $this->sendResponse(new ContractResponsibilityStatusResource($contractResponsibilityStatus), 'ContractResponsibilityStatus updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/contractResponsibilityStatuses/{id}",
     *      summary="deleteContractResponsibilityStatus",
     *      tags={"ContractResponsibilityStatus"},
     *      description="Delete ContractResponsibilityStatus",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ContractResponsibilityStatus",
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
        /** @var ContractResponsibilityStatus $contractResponsibilityStatus */
        $contractResponsibilityStatus = $this->contractResponsibilityStatusRepository->find($id);

        if (empty($contractResponsibilityStatus)) {
            return $this->sendError('Contract Responsibility Status not found');
        }

        $contractResponsibilityStatus->delete();

        return $this->sendSuccess('Contract Responsibility Status deleted successfully');
    }
}

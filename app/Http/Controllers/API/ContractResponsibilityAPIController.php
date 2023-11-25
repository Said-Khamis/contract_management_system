<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateContractResponsibilityAPIRequest;
use App\Http\Requests\API\UpdateContractResponsibilityAPIRequest;
use App\Models\ContractResponsibility;
use App\Repositories\ContractResponsibilityRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\ContractResponsibilityResource;
use Response;

/**
 * Class ContractResponsibilityController
 * @package App\Http\Controllers\API
 */

class ContractResponsibilityAPIController extends AppBaseController
{
    /** @var  ContractResponsibilityRepository */
    private $contractResponsibilityRepository;

    public function __construct(ContractResponsibilityRepository $contractResponsibilityRepo)
    {
        $this->contractResponsibilityRepository = $contractResponsibilityRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/contractResponsibilities",
     *      summary="getContractResponsibilityList",
     *      tags={"ContractResponsibility"},
     *      description="Get all ContractResponsibilities",
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
     *                  @OA\Items(ref="#/definitions/ContractResponsibility")
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
        $contractResponsibilities = $this->contractResponsibilityRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(ContractResponsibilityResource::collection($contractResponsibilities), 'Contract Responsibilities retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/contractResponsibilities",
     *      summary="createContractResponsibility",
     *      tags={"ContractResponsibility"},
     *      description="Create ContractResponsibility",
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
     *                  ref="#/definitions/ContractResponsibility"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateContractResponsibilityAPIRequest $request)
    {
        $input = $request->all();

        $contractResponsibility = $this->contractResponsibilityRepository->create($input);

        return $this->sendResponse(new ContractResponsibilityResource($contractResponsibility), 'Contract Responsibility saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/contractResponsibilities/{id}",
     *      summary="getContractResponsibilityItem",
     *      tags={"ContractResponsibility"},
     *      description="Get ContractResponsibility",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ContractResponsibility",
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
     *                  ref="#/definitions/ContractResponsibility"
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
        /** @var ContractResponsibility $contractResponsibility */
        $contractResponsibility = $this->contractResponsibilityRepository->find($id);

        if (empty($contractResponsibility)) {
            return $this->sendError('Contract Responsibility not found');
        }

        return $this->sendResponse(new ContractResponsibilityResource($contractResponsibility), 'Contract Responsibility retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/contractResponsibilities/{id}",
     *      summary="updateContractResponsibility",
     *      tags={"ContractResponsibility"},
     *      description="Update ContractResponsibility",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ContractResponsibility",
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
     *                  ref="#/definitions/ContractResponsibility"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateContractResponsibilityAPIRequest $request)
    {
        $input = $request->all();

        /** @var ContractResponsibility $contractResponsibility */
        $contractResponsibility = $this->contractResponsibilityRepository->find($id);

        if (empty($contractResponsibility)) {
            return $this->sendError('Contract Responsibility not found');
        }

        $contractResponsibility = $this->contractResponsibilityRepository->update($input, $id);

        return $this->sendResponse(new ContractResponsibilityResource($contractResponsibility), 'ContractResponsibility updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/contractResponsibilities/{id}",
     *      summary="deleteContractResponsibility",
     *      tags={"ContractResponsibility"},
     *      description="Delete ContractResponsibility",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ContractResponsibility",
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
        /** @var ContractResponsibility $contractResponsibility */
        $contractResponsibility = $this->contractResponsibilityRepository->find($id);

        if (empty($contractResponsibility)) {
            return $this->sendError('Contract Responsibility not found');
        }

        $contractResponsibility->delete();

        return $this->sendSuccess('Contract Responsibility deleted successfully');
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateImplementationStatusAPIRequest;
use App\Http\Requests\API\UpdateImplementationStatusAPIRequest;
use App\Models\ImplementationStatus;
use App\Repositories\ImplementationStatusRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ImplementationStatusController
 * @package App\Http\Controllers\API
 */

class ImplementationStatusAPIController extends AppBaseController
{
    /** @var  ImplementationStatusRepository */
    private $implementationStatusRepository;

    public function __construct(ImplementationStatusRepository $implementationStatusRepo)
    {
        $this->implementationStatusRepository = $implementationStatusRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/implementationStatuses",
     *      summary="getImplementationStatusList",
     *      tags={"ImplementationStatus"},
     *      description="Get all ImplementationStatuses",
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
     *                  @OA\Items(ref="#/definitions/ImplementationStatus")
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
        $implementationStatuses = $this->implementationStatusRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($implementationStatuses->toArray(), 'Implementation Statuses retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/implementationStatuses",
     *      summary="createImplementationStatus",
     *      tags={"ImplementationStatus"},
     *      description="Create ImplementationStatus",
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
     *                  ref="#/definitions/ImplementationStatus"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateImplementationStatusAPIRequest $request)
    {
        $input = $request->all();

        $implementationStatus = $this->implementationStatusRepository->create($input);

        return $this->sendResponse($implementationStatus->toArray(), 'Implementation Status saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/implementationStatuses/{id}",
     *      summary="getImplementationStatusItem",
     *      tags={"ImplementationStatus"},
     *      description="Get ImplementationStatus",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ImplementationStatus",
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
     *                  ref="#/definitions/ImplementationStatus"
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
        /** @var ImplementationStatus $implementationStatus */
        $implementationStatus = $this->implementationStatusRepository->find($id);

        if (empty($implementationStatus)) {
            return $this->sendError('Implementation Status not found');
        }

        return $this->sendResponse($implementationStatus->toArray(), 'Implementation Status retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/implementationStatuses/{id}",
     *      summary="updateImplementationStatus",
     *      tags={"ImplementationStatus"},
     *      description="Update ImplementationStatus",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ImplementationStatus",
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
     *                  ref="#/definitions/ImplementationStatus"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateImplementationStatusAPIRequest $request)
    {
        $input = $request->all();

        /** @var ImplementationStatus $implementationStatus */
        $implementationStatus = $this->implementationStatusRepository->find($id);

        if (empty($implementationStatus)) {
            return $this->sendError('Implementation Status not found');
        }

        $implementationStatus = $this->implementationStatusRepository->update($input, $id);

        return $this->sendResponse($implementationStatus->toArray(), 'ImplementationStatus updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/implementationStatuses/{id}",
     *      summary="deleteImplementationStatus",
     *      tags={"ImplementationStatus"},
     *      description="Delete ImplementationStatus",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ImplementationStatus",
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
        /** @var ImplementationStatus $implementationStatus */
        $implementationStatus = $this->implementationStatusRepository->find($id);

        if (empty($implementationStatus)) {
            return $this->sendError('Implementation Status not found');
        }

        $implementationStatus->delete();

        return $this->sendSuccess('Implementation Status deleted successfully');
    }
}

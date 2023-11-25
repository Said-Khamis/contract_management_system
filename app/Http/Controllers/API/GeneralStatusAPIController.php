<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateGeneralStatusAPIRequest;
use App\Http\Requests\API\UpdateGeneralStatusAPIRequest;
use App\Models\GeneralStatus;
use App\Repositories\GeneralStatusRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class GeneralStatusController
 * @package App\Http\Controllers\API
 */

class GeneralStatusAPIController extends AppBaseController
{
    /** @var  GeneralStatusRepository */
    private $generalStatusRepository;

    public function __construct(GeneralStatusRepository $generalStatusRepo)
    {
        $this->generalStatusRepository = $generalStatusRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/generalStatuses",
     *      summary="getGeneralStatusList",
     *      tags={"GeneralStatus"},
     *      description="Get all GeneralStatuses",
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
     *                  @OA\Items(ref="#/definitions/GeneralStatus")
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
        $generalStatuses = $this->generalStatusRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($generalStatuses->toArray(), 'General Statuses retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/generalStatuses",
     *      summary="createGeneralStatus",
     *      tags={"GeneralStatus"},
     *      description="Create GeneralStatus",
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
     *                  ref="#/definitions/GeneralStatus"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateGeneralStatusAPIRequest $request)
    {
        $input = $request->all();

        $generalStatus = $this->generalStatusRepository->create($input);

        return $this->sendResponse($generalStatus->toArray(), 'General Status saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/generalStatuses/{id}",
     *      summary="getGeneralStatusItem",
     *      tags={"GeneralStatus"},
     *      description="Get GeneralStatus",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of GeneralStatus",
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
     *                  ref="#/definitions/GeneralStatus"
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
        /** @var GeneralStatus $generalStatus */
        $generalStatus = $this->generalStatusRepository->find($id);

        if (empty($generalStatus)) {
            return $this->sendError('General Status not found');
        }

        return $this->sendResponse($generalStatus->toArray(), 'General Status retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/generalStatuses/{id}",
     *      summary="updateGeneralStatus",
     *      tags={"GeneralStatus"},
     *      description="Update GeneralStatus",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of GeneralStatus",
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
     *                  ref="#/definitions/GeneralStatus"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateGeneralStatusAPIRequest $request)
    {
        $input = $request->all();

        /** @var GeneralStatus $generalStatus */
        $generalStatus = $this->generalStatusRepository->find($id);

        if (empty($generalStatus)) {
            return $this->sendError('General Status not found');
        }

        $generalStatus = $this->generalStatusRepository->update($input, $id);

        return $this->sendResponse($generalStatus->toArray(), 'GeneralStatus updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/generalStatuses/{id}",
     *      summary="deleteGeneralStatus",
     *      tags={"GeneralStatus"},
     *      description="Delete GeneralStatus",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of GeneralStatus",
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
        /** @var GeneralStatus $generalStatus */
        $generalStatus = $this->generalStatusRepository->find($id);

        if (empty($generalStatus)) {
            return $this->sendError('General Status not found');
        }

        $generalStatus->delete();

        return $this->sendSuccess('General Status deleted successfully');
    }
}

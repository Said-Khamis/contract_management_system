<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateActionPlanAPIRequest;
use App\Http\Requests\API\UpdateActionPlanAPIRequest;
use App\Models\ActionPlan;
use App\Repositories\ActionPlanRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\ActionPlanResource;
use Response;

/**
 * Class ActionPlanController
 * @package App\Http\Controllers\API
 */

class ActionPlanAPIController extends AppBaseController
{
    /** @var  ActionPlanRepository */
    private $actionPlanRepository;

    public function __construct(ActionPlanRepository $actionPlanRepo)
    {
        $this->actionPlanRepository = $actionPlanRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/actionPlans",
     *      summary="getActionPlanList",
     *      tags={"ActionPlan"},
     *      description="Get all ActionPlans",
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
     *                  @OA\Items(ref="#/definitions/ActionPlan")
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
        $actionPlans = $this->actionPlanRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(ActionPlanResource::collection($actionPlans), 'Action Plans retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/actionPlans",
     *      summary="createActionPlan",
     *      tags={"ActionPlan"},
     *      description="Create ActionPlan",
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
     *                  ref="#/definitions/ActionPlan"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateActionPlanAPIRequest $request)
    {
        $input = $request->all();

        $actionPlan = $this->actionPlanRepository->create($input);

        return $this->sendResponse(new ActionPlanResource($actionPlan), 'Action Plan saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/actionPlans/{id}",
     *      summary="getActionPlanItem",
     *      tags={"ActionPlan"},
     *      description="Get ActionPlan",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ActionPlan",
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
     *                  ref="#/definitions/ActionPlan"
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
        /** @var ActionPlan $actionPlan */
        $actionPlan = $this->actionPlanRepository->find($id);

        if (empty($actionPlan)) {
            return $this->sendError('Action Plan not found');
        }

        return $this->sendResponse(new ActionPlanResource($actionPlan), 'Action Plan retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/actionPlans/{id}",
     *      summary="updateActionPlan",
     *      tags={"ActionPlan"},
     *      description="Update ActionPlan",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ActionPlan",
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
     *                  ref="#/definitions/ActionPlan"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateActionPlanAPIRequest $request)
    {
        $input = $request->all();

        /** @var ActionPlan $actionPlan */
        $actionPlan = $this->actionPlanRepository->find($id);

        if (empty($actionPlan)) {
            return $this->sendError('Action Plan not found');
        }

        $actionPlan = $this->actionPlanRepository->update($input, $id);

        return $this->sendResponse(new ActionPlanResource($actionPlan), 'ActionPlan updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/actionPlans/{id}",
     *      summary="deleteActionPlan",
     *      tags={"ActionPlan"},
     *      description="Delete ActionPlan",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ActionPlan",
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
        /** @var ActionPlan $actionPlan */
        $actionPlan = $this->actionPlanRepository->find($id);

        if (empty($actionPlan)) {
            return $this->sendError('Action Plan not found');
        }

        $actionPlan->delete();

        return $this->sendSuccess('Action Plan deleted successfully');
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProcedureCommentAPIRequest;
use App\Http\Requests\API\UpdateProcedureCommentAPIRequest;
use App\Models\ProcedureComment;
use App\Repositories\ProcedureCommentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\ProcedureCommentResource;
use Response;

/**
 * Class ProcedureCommentController
 * @package App\Http\Controllers\API
 */

class ProcedureCommentAPIController extends AppBaseController
{
    /** @var  ProcedureCommentRepository */
    private $procedureCommentRepository;

    public function __construct(ProcedureCommentRepository $procedureCommentRepo)
    {
        $this->procedureCommentRepository = $procedureCommentRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/procedureComments",
     *      summary="getProcedureCommentList",
     *      tags={"ProcedureComment"},
     *      description="Get all ProcedureComments",
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
     *                  @OA\Items(ref="#/definitions/ProcedureComment")
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
        $procedureComments = $this->procedureCommentRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(ProcedureCommentResource::collection($procedureComments), 'Procedure Comments retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/procedureComments",
     *      summary="createProcedureComment",
     *      tags={"ProcedureComment"},
     *      description="Create ProcedureComment",
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
     *                  ref="#/definitions/ProcedureComment"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateProcedureCommentAPIRequest $request)
    {
        $input = $request->all();

        $procedureComment = $this->procedureCommentRepository->create($input);

        return $this->sendResponse(new ProcedureCommentResource($procedureComment), 'Procedure Comment saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/procedureComments/{id}",
     *      summary="getProcedureCommentItem",
     *      tags={"ProcedureComment"},
     *      description="Get ProcedureComment",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ProcedureComment",
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
     *                  ref="#/definitions/ProcedureComment"
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
        /** @var ProcedureComment $procedureComment */
        $procedureComment = $this->procedureCommentRepository->find($id);

        if (empty($procedureComment)) {
            return $this->sendError('Procedure Comment not found');
        }

        return $this->sendResponse(new ProcedureCommentResource($procedureComment), 'Procedure Comment retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/procedureComments/{id}",
     *      summary="updateProcedureComment",
     *      tags={"ProcedureComment"},
     *      description="Update ProcedureComment",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ProcedureComment",
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
     *                  ref="#/definitions/ProcedureComment"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateProcedureCommentAPIRequest $request)
    {
        $input = $request->all();

        /** @var ProcedureComment $procedureComment */
        $procedureComment = $this->procedureCommentRepository->find($id);

        if (empty($procedureComment)) {
            return $this->sendError('Procedure Comment not found');
        }

        $procedureComment = $this->procedureCommentRepository->update($input, $id);

        return $this->sendResponse(new ProcedureCommentResource($procedureComment), 'ProcedureComment updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/procedureComments/{id}",
     *      summary="deleteProcedureComment",
     *      tags={"ProcedureComment"},
     *      description="Delete ProcedureComment",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ProcedureComment",
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
        /** @var ProcedureComment $procedureComment */
        $procedureComment = $this->procedureCommentRepository->find($id);

        if (empty($procedureComment)) {
            return $this->sendError('Procedure Comment not found');
        }

        $procedureComment->delete();

        return $this->sendSuccess('Procedure Comment deleted successfully');
    }
}

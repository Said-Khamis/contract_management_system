<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateInternalProcedureAPIRequest;
use App\Http\Requests\API\UpdateInternalProcedureAPIRequest;
use App\Models\InternalProcedure;
use App\Repositories\InternalProcedureRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\InternalProcedureResource;
use Response;

/**
 * Class InternalProcedureController
 * @package App\Http\Controllers\API
 */

class InternalProcedureAPIController extends AppBaseController
{
    /** @var  InternalProcedureRepository */
    private $internalProcedureRepository;

    public function __construct(InternalProcedureRepository $internalProcedureRepo)
    {
        $this->internalProcedureRepository = $internalProcedureRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/internalProcedures",
     *      summary="getInternalProcedureList",
     *      tags={"InternalProcedure"},
     *      description="Get all InternalProcedures",
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
     *                  @OA\Items(ref="#/definitions/InternalProcedure")
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
        $internalProcedures = $this->internalProcedureRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(InternalProcedureResource::collection($internalProcedures), 'Internal Procedures retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/internalProcedures",
     *      summary="createInternalProcedure",
     *      tags={"InternalProcedure"},
     *      description="Create InternalProcedure",
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
     *                  ref="#/definitions/InternalProcedure"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateInternalProcedureAPIRequest $request)
    {
        $input = $request->all();

        $internalProcedure = $this->internalProcedureRepository->create($input);

        return $this->sendResponse(new InternalProcedureResource($internalProcedure), 'Internal Procedure saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/internalProcedures/{id}",
     *      summary="getInternalProcedureItem",
     *      tags={"InternalProcedure"},
     *      description="Get InternalProcedure",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of InternalProcedure",
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
     *                  ref="#/definitions/InternalProcedure"
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
        /** @var InternalProcedure $internalProcedure */
        $internalProcedure = $this->internalProcedureRepository->find($id);

        if (empty($internalProcedure)) {
            return $this->sendError('Internal Procedure not found');
        }

        return $this->sendResponse(new InternalProcedureResource($internalProcedure), 'Internal Procedure retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/internalProcedures/{id}",
     *      summary="updateInternalProcedure",
     *      tags={"InternalProcedure"},
     *      description="Update InternalProcedure",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of InternalProcedure",
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
     *                  ref="#/definitions/InternalProcedure"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateInternalProcedureAPIRequest $request)
    {
        $input = $request->all();

        /** @var InternalProcedure $internalProcedure */
        $internalProcedure = $this->internalProcedureRepository->find($id);

        if (empty($internalProcedure)) {
            return $this->sendError('Internal Procedure not found');
        }

        $internalProcedure = $this->internalProcedureRepository->update($input, $id);

        return $this->sendResponse(new InternalProcedureResource($internalProcedure), 'InternalProcedure updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/internalProcedures/{id}",
     *      summary="deleteInternalProcedure",
     *      tags={"InternalProcedure"},
     *      description="Delete InternalProcedure",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of InternalProcedure",
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
        /** @var InternalProcedure $internalProcedure */
        $internalProcedure = $this->internalProcedureRepository->find($id);

        if (empty($internalProcedure)) {
            return $this->sendError('Internal Procedure not found');
        }

        $internalProcedure->delete();

        return $this->sendSuccess('Internal Procedure deleted successfully');
    }
}

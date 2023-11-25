<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateWardAPIRequest;
use App\Http\Requests\API\UpdateWardAPIRequest;
use App\Models\Ward;
use App\Repositories\WardRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\WardResource;
use Response;

/**
 * Class WardController
 * @package App\Http\Controllers\API
 */

class WardAPIController extends AppBaseController
{
    /** @var  WardRepository */
    private $wardRepository;

    public function __construct(WardRepository $wardRepo)
    {
        $this->wardRepository = $wardRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/wards",
     *      summary="getWardList",
     *      tags={"Ward"},
     *      description="Get all Wards",
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
     *                  @OA\Items(ref="#/definitions/Ward")
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
        $wards = $this->wardRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(WardResource::collection($wards), 'Wards retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/wards",
     *      summary="createWard",
     *      tags={"Ward"},
     *      description="Create Ward",
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
     *                  ref="#/definitions/Ward"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateWardAPIRequest $request)
    {
        $input = $request->all();

        $ward = $this->wardRepository->create($input);

        return $this->sendResponse(new WardResource($ward), 'Ward saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/wards/{id}",
     *      summary="getWardItem",
     *      tags={"Ward"},
     *      description="Get Ward",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Ward",
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
     *                  ref="#/definitions/Ward"
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
        /** @var Ward $ward */
        $ward = $this->wardRepository->find($id);

        if (empty($ward)) {
            return $this->sendError('Ward not found');
        }

        return $this->sendResponse(new WardResource($ward), 'Ward retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/wards/{id}",
     *      summary="updateWard",
     *      tags={"Ward"},
     *      description="Update Ward",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Ward",
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
     *                  ref="#/definitions/Ward"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateWardAPIRequest $request)
    {
        $input = $request->all();

        /** @var Ward $ward */
        $ward = $this->wardRepository->find($id);

        if (empty($ward)) {
            return $this->sendError('Ward not found');
        }

        $ward = $this->wardRepository->update($input, $id);

        return $this->sendResponse(new WardResource($ward), 'Ward updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/wards/{id}",
     *      summary="deleteWard",
     *      tags={"Ward"},
     *      description="Delete Ward",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Ward",
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
        /** @var Ward $ward */
        $ward = $this->wardRepository->find($id);

        if (empty($ward)) {
            return $this->sendError('Ward not found');
        }

        $ward->delete();

        return $this->sendSuccess('Ward deleted successfully');
    }
}

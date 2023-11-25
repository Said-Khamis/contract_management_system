<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDesignationAPIRequest;
use App\Http\Requests\API\UpdateDesignationAPIRequest;
use App\Models\Designation;
use App\Repositories\DesignationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\DesignationResource;
use Response;

/**
 * Class DesignationController
 * @package App\Http\Controllers\API
 */

class DesignationAPIController extends AppBaseController
{
    /** @var  DesignationRepository */
    private $designationRepository;

    public function __construct(DesignationRepository $designationRepo)
    {
        $this->designationRepository = $designationRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/designations",
     *      summary="getDesignationList",
     *      tags={"Designation"},
     *      description="Get all Designations",
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
     *                  @OA\Items(ref="#/definitions/Designation")
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
        $designations = $this->designationRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(DesignationResource::collection($designations), 'Designations retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/designations",
     *      summary="createDesignation",
     *      tags={"Designation"},
     *      description="Create Designation",
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
     *                  ref="#/definitions/Designation"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateDesignationAPIRequest $request)
    {
        $input = $request->all();

        $designation = $this->designationRepository->create($input);

        return $this->sendResponse(new DesignationResource($designation), 'Designation saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/designations/{id}",
     *      summary="getDesignationItem",
     *      tags={"Designation"},
     *      description="Get Designation",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Designation",
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
     *                  ref="#/definitions/Designation"
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
        /** @var Designation $designation */
        $designation = $this->designationRepository->find($id);

        if (empty($designation)) {
            return $this->sendError('Designation not found');
        }

        return $this->sendResponse(new DesignationResource($designation), 'Designation retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/designations/{id}",
     *      summary="updateDesignation",
     *      tags={"Designation"},
     *      description="Update Designation",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Designation",
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
     *                  ref="#/definitions/Designation"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateDesignationAPIRequest $request)
    {
        $input = $request->all();

        /** @var Designation $designation */
        $designation = $this->designationRepository->find($id);

        if (empty($designation)) {
            return $this->sendError('Designation not found');
        }

        $designation = $this->designationRepository->update($input, $id);

        return $this->sendResponse(new DesignationResource($designation), 'Designation updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/designations/{id}",
     *      summary="deleteDesignation",
     *      tags={"Designation"},
     *      description="Delete Designation",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Designation",
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
        /** @var Designation $designation */
        $designation = $this->designationRepository->find($id);

        if (empty($designation)) {
            return $this->sendError('Designation not found');
        }

        $designation->delete();

        return $this->sendSuccess('Designation deleted successfully');
    }
}

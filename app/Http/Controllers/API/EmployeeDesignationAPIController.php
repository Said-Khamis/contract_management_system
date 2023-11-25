<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateEmployeeDesignationAPIRequest;
use App\Http\Requests\API\UpdateEmployeeDesignationAPIRequest;
use App\Models\EmployeeDesignation;
use App\Repositories\EmployeeDesignationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\EmployeeDesignationResource;
use Response;

/**
 * Class EmployeeDesignationController
 * @package App\Http\Controllers\API
 */

class EmployeeDesignationAPIController extends AppBaseController
{
    /** @var  EmployeeDesignationRepository */
    private $employeeDesignationRepository;

    public function __construct(EmployeeDesignationRepository $employeeDesignationRepo)
    {
        $this->employeeDesignationRepository = $employeeDesignationRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/employeeDesignations",
     *      summary="getEmployeeDesignationList",
     *      tags={"EmployeeDesignation"},
     *      description="Get all EmployeeDesignations",
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
     *                  @OA\Items(ref="#/definitions/EmployeeDesignation")
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
        $employeeDesignations = $this->employeeDesignationRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(EmployeeDesignationResource::collection($employeeDesignations), 'Employee Designations retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/employeeDesignations",
     *      summary="createEmployeeDesignation",
     *      tags={"EmployeeDesignation"},
     *      description="Create EmployeeDesignation",
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
     *                  ref="#/definitions/EmployeeDesignation"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateEmployeeDesignationAPIRequest $request)
    {
        $input = $request->all();

        $employeeDesignation = $this->employeeDesignationRepository->create($input);

        return $this->sendResponse(new EmployeeDesignationResource($employeeDesignation), 'Employee Designation saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/employeeDesignations/{id}",
     *      summary="getEmployeeDesignationItem",
     *      tags={"EmployeeDesignation"},
     *      description="Get EmployeeDesignation",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of EmployeeDesignation",
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
     *                  ref="#/definitions/EmployeeDesignation"
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
        /** @var EmployeeDesignation $employeeDesignation */
        $employeeDesignation = $this->employeeDesignationRepository->find($id);

        if (empty($employeeDesignation)) {
            return $this->sendError('Employee Designation not found');
        }

        return $this->sendResponse(new EmployeeDesignationResource($employeeDesignation), 'Employee Designation retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/employeeDesignations/{id}",
     *      summary="updateEmployeeDesignation",
     *      tags={"EmployeeDesignation"},
     *      description="Update EmployeeDesignation",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of EmployeeDesignation",
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
     *                  ref="#/definitions/EmployeeDesignation"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateEmployeeDesignationAPIRequest $request)
    {
        $input = $request->all();

        /** @var EmployeeDesignation $employeeDesignation */
        $employeeDesignation = $this->employeeDesignationRepository->find($id);

        if (empty($employeeDesignation)) {
            return $this->sendError('Employee Designation not found');
        }

        $employeeDesignation = $this->employeeDesignationRepository->update($input, $id);

        return $this->sendResponse(new EmployeeDesignationResource($employeeDesignation), 'EmployeeDesignation updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/employeeDesignations/{id}",
     *      summary="deleteEmployeeDesignation",
     *      tags={"EmployeeDesignation"},
     *      description="Delete EmployeeDesignation",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of EmployeeDesignation",
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
        /** @var EmployeeDesignation $employeeDesignation */
        $employeeDesignation = $this->employeeDesignationRepository->find($id);

        if (empty($employeeDesignation)) {
            return $this->sendError('Employee Designation not found');
        }

        $employeeDesignation->delete();

        return $this->sendSuccess('Employee Designation deleted successfully');
    }
}

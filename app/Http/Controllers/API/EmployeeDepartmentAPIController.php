<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateEmployeeDepartmentAPIRequest;
use App\Http\Requests\API\UpdateEmployeeDepartmentAPIRequest;
use App\Models\EmployeeDepartment;
use App\Repositories\EmployeeDepartmentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\EmployeeDepartmentResource;
use Response;

/**
 * Class EmployeeDepartmentController
 * @package App\Http\Controllers\API
 */

class EmployeeDepartmentAPIController extends AppBaseController
{
    /** @var  EmployeeDepartmentRepository */
    private $employeeDepartmentRepository;

    public function __construct(EmployeeDepartmentRepository $employeeDepartmentRepo)
    {
        $this->employeeDepartmentRepository = $employeeDepartmentRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/employeeDepartments",
     *      summary="getEmployeeDepartmentList",
     *      tags={"EmployeeDepartment"},
     *      description="Get all EmployeeDepartments",
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
     *                  @OA\Items(ref="#/definitions/EmployeeDepartment")
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
        $employeeDepartments = $this->employeeDepartmentRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(EmployeeDepartmentResource::collection($employeeDepartments), 'Employee Departments retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/employeeDepartments",
     *      summary="createEmployeeDepartment",
     *      tags={"EmployeeDepartment"},
     *      description="Create EmployeeDepartment",
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
     *                  ref="#/definitions/EmployeeDepartment"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateEmployeeDepartmentAPIRequest $request)
    {
        $input = $request->all();

        $employeeDepartment = $this->employeeDepartmentRepository->create($input);

        return $this->sendResponse(new EmployeeDepartmentResource($employeeDepartment), 'Employee Department saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/employeeDepartments/{id}",
     *      summary="getEmployeeDepartmentItem",
     *      tags={"EmployeeDepartment"},
     *      description="Get EmployeeDepartment",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of EmployeeDepartment",
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
     *                  ref="#/definitions/EmployeeDepartment"
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
        /** @var EmployeeDepartment $employeeDepartment */
        $employeeDepartment = $this->employeeDepartmentRepository->find($id);

        if (empty($employeeDepartment)) {
            return $this->sendError('Employee Department not found');
        }

        return $this->sendResponse(new EmployeeDepartmentResource($employeeDepartment), 'Employee Department retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/employeeDepartments/{id}",
     *      summary="updateEmployeeDepartment",
     *      tags={"EmployeeDepartment"},
     *      description="Update EmployeeDepartment",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of EmployeeDepartment",
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
     *                  ref="#/definitions/EmployeeDepartment"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateEmployeeDepartmentAPIRequest $request)
    {
        $input = $request->all();

        /** @var EmployeeDepartment $employeeDepartment */
        $employeeDepartment = $this->employeeDepartmentRepository->find($id);

        if (empty($employeeDepartment)) {
            return $this->sendError('Employee Department not found');
        }

        $employeeDepartment = $this->employeeDepartmentRepository->update($input, $id);

        return $this->sendResponse(new EmployeeDepartmentResource($employeeDepartment), 'EmployeeDepartment updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/employeeDepartments/{id}",
     *      summary="deleteEmployeeDepartment",
     *      tags={"EmployeeDepartment"},
     *      description="Delete EmployeeDepartment",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of EmployeeDepartment",
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
        /** @var EmployeeDepartment $employeeDepartment */
        $employeeDepartment = $this->employeeDepartmentRepository->find($id);

        if (empty($employeeDepartment)) {
            return $this->sendError('Employee Department not found');
        }

        $employeeDepartment->delete();

        return $this->sendSuccess('Employee Department deleted successfully');
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateContractSectorAPIRequest;
use App\Http\Requests\API\UpdateContractSectorAPIRequest;
use App\Models\Sector;
use App\Repositories\SectorRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\ContractSectorResource;
use Response;

/**
 * Class ContractSectorController
 * @package App\Http\Controllers\API
 */

class ContractSectorAPIController extends AppBaseController
{
    /** @var  SectorRepository */
    private $contractSectorRepository;

    public function __construct(SectorRepository $contractSectorRepo)
    {
        $this->contractSectorRepository = $contractSectorRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/contractSectors",
     *      summary="getContractSectorList",
     *      tags={"ContractSector"},
     *      description="Get all ContractSectors",
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
     *                  @OA\Items(ref="#/definitions/ContractSector")
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
        $contractSectors = $this->contractSectorRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(ContractSectorResource::collection($contractSectors), 'Contract Sectors retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/contractSectors",
     *      summary="createContractSector",
     *      tags={"ContractSector"},
     *      description="Create ContractSector",
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
     *                  ref="#/definitions/ContractSector"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateContractSectorAPIRequest $request)
    {
        $input = $request->all();

        $contractSector = $this->contractSectorRepository->create($input);

        return $this->sendResponse(new ContractSectorResource($contractSector), 'Contract Sector saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/contractSectors/{id}",
     *      summary="getContractSectorItem",
     *      tags={"ContractSector"},
     *      description="Get ContractSector",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ContractSector",
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
     *                  ref="#/definitions/ContractSector"
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
        /** @var Sector $contractSector */
        $contractSector = $this->contractSectorRepository->find($id);

        if (empty($contractSector)) {
            return $this->sendError('Contract Sector not found');
        }

        return $this->sendResponse(new ContractSectorResource($contractSector), 'Contract Sector retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/contractSectors/{id}",
     *      summary="updateContractSector",
     *      tags={"ContractSector"},
     *      description="Update ContractSector",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ContractSector",
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
     *                  ref="#/definitions/ContractSector"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateContractSectorAPIRequest $request)
    {
        $input = $request->all();

        /** @var Sector $contractSector */
        $contractSector = $this->contractSectorRepository->find($id);

        if (empty($contractSector)) {
            return $this->sendError('Contract Sector not found');
        }

        $contractSector = $this->contractSectorRepository->update($input, $id);

        return $this->sendResponse(new ContractSectorResource($contractSector), 'ContractSector updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/contractSectors/{id}",
     *      summary="deleteContractSector",
     *      tags={"ContractSector"},
     *      description="Delete ContractSector",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ContractSector",
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
        /** @var Sector $contractSector */
        $contractSector = $this->contractSectorRepository->find($id);

        if (empty($contractSector)) {
            return $this->sendError('Contract Sector not found');
        }

        $contractSector->delete();

        return $this->sendSuccess('Contract Sector deleted successfully');
    }
}

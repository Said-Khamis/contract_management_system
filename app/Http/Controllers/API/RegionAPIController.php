<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRegionAPIRequest;
use App\Http\Requests\API\UpdateRegionAPIRequest;
use App\Models\Region;
use App\Repositories\RegionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\RegionResource;
use Response;

/**
 * Class RegionController
 * @package App\Http\Controllers\API
 */

class RegionAPIController extends AppBaseController
{
    /** @var  RegionRepository */
    private $regionRepository;

    public function __construct(RegionRepository $regionRepo)
    {
        $this->regionRepository = $regionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/regions",
     *      summary="getRegionList",
     *      tags={"Region"},
     *      description="Get all Regions",
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
     *                  @OA\Items(ref="#/definitions/Region")
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
        $regions = $this->regionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(RegionResource::collection($regions), 'Regions retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/regions",
     *      summary="createRegion",
     *      tags={"Region"},
     *      description="Create Region",
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
     *                  ref="#/definitions/Region"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateRegionAPIRequest $request)
    {
        $input = $request->all();

        $region = $this->regionRepository->create($input);

        return $this->sendResponse(new RegionResource($region), 'Region saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/regions/{id}",
     *      summary="getRegionItem",
     *      tags={"Region"},
     *      description="Get Region",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Region",
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
     *                  ref="#/definitions/Region"
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
        /** @var Region $region */
        $region = $this->regionRepository->find($id);

        if (empty($region)) {
            return $this->sendError('Region not found');
        }

        return $this->sendResponse(new RegionResource($region), 'Region retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/regions/{id}",
     *      summary="updateRegion",
     *      tags={"Region"},
     *      description="Update Region",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Region",
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
     *                  ref="#/definitions/Region"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateRegionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Region $region */
        $region = $this->regionRepository->find($id);

        if (empty($region)) {
            return $this->sendError('Region not found');
        }

        $region = $this->regionRepository->update($input, $id);

        return $this->sendResponse(new RegionResource($region), 'Region updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/regions/{id}",
     *      summary="deleteRegion",
     *      tags={"Region"},
     *      description="Delete Region",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Region",
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
        /** @var Region $region */
        $region = $this->regionRepository->find($id);

        if (empty($region)) {
            return $this->sendError('Region not found');
        }

        $region->delete();

        return $this->sendSuccess('Region deleted successfully');
    }
}

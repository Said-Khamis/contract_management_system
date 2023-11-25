<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAmendmendAPIRequest;
use App\Http\Requests\API\UpdateAmendmendAPIRequest;
use App\Models\Amendment;
use App\Repositories\AmendmentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\AmendmendResource;
use Response;

/**
 * Class AmendmendController
 * @package App\Http\Controllers\API
 */

class AmendmendAPIController extends AppBaseController
{
    /** @var  AmendmentRepository */
    private $amendmendRepository;

    public function __construct(AmendmentRepository $amendmendRepo)
    {
        $this->amendmendRepository = $amendmendRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/amendmends",
     *      summary="getAmendmendList",
     *      tags={"Amendmend"},
     *      description="Get all Amendmends",
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
     *                  @OA\Items(ref="#/definitions/Amendmend")
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
        $amendmends = $this->amendmendRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(AmendmendResource::collection($amendmends), 'Amendmends retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/amendmends",
     *      summary="createAmendmend",
     *      tags={"Amendmend"},
     *      description="Create Amendmend",
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
     *                  ref="#/definitions/Amendmend"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateAmendmendAPIRequest $request)
    {
        $input = $request->all();

        $amendmend = $this->amendmendRepository->create($input);

        return $this->sendResponse(new AmendmendResource($amendmend), 'Amendmend saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/amendmends/{id}",
     *      summary="getAmendmendItem",
     *      tags={"Amendmend"},
     *      description="Get Amendmend",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Amendmend",
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
     *                  ref="#/definitions/Amendmend"
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
        /** @var Amendment $amendmend */
        $amendmend = $this->amendmendRepository->find($id);

        if (empty($amendmend)) {
            return $this->sendError('Amendmend not found');
        }

        return $this->sendResponse(new AmendmendResource($amendmend), 'Amendmend retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/amendmends/{id}",
     *      summary="updateAmendmend",
     *      tags={"Amendmend"},
     *      description="Update Amendmend",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Amendmend",
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
     *                  ref="#/definitions/Amendmend"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateAmendmendAPIRequest $request)
    {
        $input = $request->all();

        /** @var Amendment $amendmend */
        $amendmend = $this->amendmendRepository->find($id);

        if (empty($amendmend)) {
            return $this->sendError('Amendmend not found');
        }

        $amendmend = $this->amendmendRepository->update($input, $id);

        return $this->sendResponse(new AmendmendResource($amendmend), 'Amendmend updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/amendmends/{id}",
     *      summary="deleteAmendmend",
     *      tags={"Amendmend"},
     *      description="Delete Amendmend",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Amendmend",
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
        /** @var Amendment $amendmend */
        $amendmend = $this->amendmendRepository->find($id);

        if (empty($amendmend)) {
            return $this->sendError('Amendmend not found');
        }

        $amendmend->delete();

        return $this->sendSuccess('Amendmend deleted successfully');
    }
}

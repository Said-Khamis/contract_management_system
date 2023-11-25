<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateContractNoticeAPIRequest;
use App\Http\Requests\API\UpdateContractNoticeAPIRequest;
use App\Models\ContractNotice;
use App\Repositories\ContractNoticeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\ContractNoticeResource;
use Response;

/**
 * Class ContractNoticeController
 * @package App\Http\Controllers\API
 */

class ContractNoticeAPIController extends AppBaseController
{
    /** @var  ContractNoticeRepository */
    private $contractNoticeRepository;

    public function __construct(ContractNoticeRepository $contractNoticeRepo)
    {
        $this->contractNoticeRepository = $contractNoticeRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/contractNotices",
     *      summary="getContractNoticeList",
     *      tags={"ContractNotice"},
     *      description="Get all ContractNotices",
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
     *                  @OA\Items(ref="#/definitions/ContractNotice")
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
        $contractNotices = $this->contractNoticeRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(ContractNoticeResource::collection($contractNotices), 'Contract Notices retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/contractNotices",
     *      summary="createContractNotice",
     *      tags={"ContractNotice"},
     *      description="Create ContractNotice",
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
     *                  ref="#/definitions/ContractNotice"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateContractNoticeAPIRequest $request)
    {
        $input = $request->all();

        $contractNotice = $this->contractNoticeRepository->create($input);

        return $this->sendResponse(new ContractNoticeResource($contractNotice), 'Contract Notice saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/contractNotices/{id}",
     *      summary="getContractNoticeItem",
     *      tags={"ContractNotice"},
     *      description="Get ContractNotice",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ContractNotice",
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
     *                  ref="#/definitions/ContractNotice"
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
        /** @var ContractNotice $contractNotice */
        $contractNotice = $this->contractNoticeRepository->find($id);

        if (empty($contractNotice)) {
            return $this->sendError('Contract Notice not found');
        }

        return $this->sendResponse(new ContractNoticeResource($contractNotice), 'Contract Notice retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/contractNotices/{id}",
     *      summary="updateContractNotice",
     *      tags={"ContractNotice"},
     *      description="Update ContractNotice",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ContractNotice",
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
     *                  ref="#/definitions/ContractNotice"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateContractNoticeAPIRequest $request)
    {
        $input = $request->all();

        /** @var ContractNotice $contractNotice */
        $contractNotice = $this->contractNoticeRepository->find($id);

        if (empty($contractNotice)) {
            return $this->sendError('Contract Notice not found');
        }

        $contractNotice = $this->contractNoticeRepository->update($input, $id);

        return $this->sendResponse(new ContractNoticeResource($contractNotice), 'ContractNotice updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/contractNotices/{id}",
     *      summary="deleteContractNotice",
     *      tags={"ContractNotice"},
     *      description="Delete ContractNotice",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ContractNotice",
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
        /** @var ContractNotice $contractNotice */
        $contractNotice = $this->contractNoticeRepository->find($id);

        if (empty($contractNotice)) {
            return $this->sendError('Contract Notice not found');
        }

        $contractNotice->delete();

        return $this->sendSuccess('Contract Notice deleted successfully');
    }
}

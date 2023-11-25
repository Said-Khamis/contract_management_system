<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateContractPartyAPIRequest;
use App\Http\Requests\API\UpdateContractPartyAPIRequest;
use App\Models\ContractParty;
use App\Repositories\ContractPartyRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\ContractPartyResource;
use Response;

/**
 * Class ContractPartyController
 * @package App\Http\Controllers\API
 */

class ContractPartyAPIController extends AppBaseController
{
    /** @var  ContractPartyRepository */
    private $contractPartyRepository;

    public function __construct(ContractPartyRepository $contractPartyRepo)
    {
        $this->contractPartyRepository = $contractPartyRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/contractParties",
     *      summary="getContractPartyList",
     *      tags={"ContractParty"},
     *      description="Get all ContractParties",
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
     *                  @OA\Items(ref="#/definitions/ContractParty")
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
        $contractParties = $this->contractPartyRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(ContractPartyResource::collection($contractParties), 'Contract Parties retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/contractParties",
     *      summary="createContractParty",
     *      tags={"ContractParty"},
     *      description="Create ContractParty",
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
     *                  ref="#/definitions/ContractParty"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateContractPartyAPIRequest $request)
    {
        $input = $request->all();

        $contractParty = $this->contractPartyRepository->create($input);

        return $this->sendResponse(new ContractPartyResource($contractParty), 'Contract Party saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/contractParties/{id}",
     *      summary="getContractPartyItem",
     *      tags={"ContractParty"},
     *      description="Get ContractParty",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ContractParty",
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
     *                  ref="#/definitions/ContractParty"
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
        /** @var ContractParty $contractParty */
        $contractParty = $this->contractPartyRepository->find($id);

        if (empty($contractParty)) {
            return $this->sendError('Contract Party not found');
        }

        return $this->sendResponse(new ContractPartyResource($contractParty), 'Contract Party retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/contractParties/{id}",
     *      summary="updateContractParty",
     *      tags={"ContractParty"},
     *      description="Update ContractParty",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ContractParty",
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
     *                  ref="#/definitions/ContractParty"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateContractPartyAPIRequest $request)
    {
        $input = $request->all();

        /** @var ContractParty $contractParty */
        $contractParty = $this->contractPartyRepository->find($id);

        if (empty($contractParty)) {
            return $this->sendError('Contract Party not found');
        }

        $contractParty = $this->contractPartyRepository->update($input, $id);

        return $this->sendResponse(new ContractPartyResource($contractParty), 'ContractParty updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/contractParties/{id}",
     *      summary="deleteContractParty",
     *      tags={"ContractParty"},
     *      description="Delete ContractParty",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ContractParty",
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
        /** @var ContractParty $contractParty */
        $contractParty = $this->contractPartyRepository->find($id);

        if (empty($contractParty)) {
            return $this->sendError('Contract Party not found');
        }

        $contractParty->delete();

        return $this->sendSuccess('Contract Party deleted successfully');
    }
}

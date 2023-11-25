<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAttachmentAPIRequest;
use App\Http\Requests\API\UpdateAttachmentAPIRequest;
use App\Models\Attachment;
use App\Repositories\AttachmentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\AttachmentResource;
use Response;

/**
 * Class AttachmentController
 * @package App\Http\Controllers\API
 */

class AttachmentAPIController extends AppBaseController
{
    /** @var  AttachmentRepository */
    private $attachmentRepository;

    public function __construct(AttachmentRepository $attachmentRepo)
    {
        $this->attachmentRepository = $attachmentRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/attachments",
     *      summary="getAttachmentList",
     *      tags={"Attachment"},
     *      description="Get all Attachments",
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
     *                  @OA\Items(ref="#/definitions/Attachment")
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
        $attachments = $this->attachmentRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(AttachmentResource::collection($attachments), 'Attachments retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/attachments",
     *      summary="createAttachment",
     *      tags={"Attachment"},
     *      description="Create Attachment",
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
     *                  ref="#/definitions/Attachment"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateAttachmentAPIRequest $request)
    {
        $input = $request->all();

        $attachment = $this->attachmentRepository->create($input);

        return $this->sendResponse(new AttachmentResource($attachment), 'Attachment saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/attachments/{id}",
     *      summary="getAttachmentItem",
     *      tags={"Attachment"},
     *      description="Get Attachment",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Attachment",
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
     *                  ref="#/definitions/Attachment"
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
        /** @var Attachment $attachment */
        $attachment = $this->attachmentRepository->find($id);

        if (empty($attachment)) {
            return $this->sendError('Attachment not found');
        }

        return $this->sendResponse(new AttachmentResource($attachment), 'Attachment retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/attachments/{id}",
     *      summary="updateAttachment",
     *      tags={"Attachment"},
     *      description="Update Attachment",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Attachment",
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
     *                  ref="#/definitions/Attachment"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateAttachmentAPIRequest $request)
    {
        $input = $request->all();

        /** @var Attachment $attachment */
        $attachment = $this->attachmentRepository->find($id);

        if (empty($attachment)) {
            return $this->sendError('Attachment not found');
        }

        $attachment = $this->attachmentRepository->update($input, $id);

        return $this->sendResponse(new AttachmentResource($attachment), 'Attachment updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/attachments/{id}",
     *      summary="deleteAttachment",
     *      tags={"Attachment"},
     *      description="Delete Attachment",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Attachment",
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
        /** @var Attachment $attachment */
        $attachment = $this->attachmentRepository->find($id);

        if (empty($attachment)) {
            return $this->sendError('Attachment not found');
        }

        $attachment->delete();

        return $this->sendSuccess('Attachment deleted successfully');
    }
}

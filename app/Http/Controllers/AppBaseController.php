<?php

namespace App\Http\Controllers;

use App\Http\Response\ResponseUtil;
//use OpenApi\Annotations as OA;
use Response;


/**
 * @OA\Info(title="My First API", version="0.1")
 */
class AppBaseController extends Controller
{
    public function sendResponse($result, $message)
    {
        return Response::json(ResponseUtil::makeResponse($message, $result));
    }

    public function sendError($error, $code = 404)
    {
        return Response::json(ResponseUtil::makeError($error), $code);
    }

    public function sendSuccess($message)
    {
        return Response::json([
            'success' => true,
            'message' => $message
        ], 200);
    }
}

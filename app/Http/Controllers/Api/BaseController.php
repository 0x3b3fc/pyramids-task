<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class BaseController extends Controller
{
    /**
     * success response method.
     *
     * @return JsonResponse
     */
    public function sendResponse($result, $message)
    {
        $response = ['success' => true, 'data' => $result, 'message' => $message,];
        return response()->json($response);

    }

    /**
     * return error response.
     *
     * @return JsonResponse
     */

    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = ['success' => false, 'message' => $error,];
        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);

    }

}

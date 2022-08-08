<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class BaseController extends Controller
{
    /**
     * success response method.
     *
     * @param $result
     * @param $message
     * @return JsonResponse
     */
    public function sendResponse($result, $message): JsonResponse
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    /**
     * return error response.
     *
     * @param $error
     * @param $errorMessages
     * @param int $code
     * @return JsonResponse
     */
    public function sendError($error, $errorMessages, int $code = 422): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if(!empty((array)$errorMessages)){
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

    public function validate(Request $request, array $rules, array $messages = [], array $customAttributes = [])
    {
        return Validator::make($request->all(),$rules);
    }
}

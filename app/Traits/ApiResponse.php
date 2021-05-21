<?php


namespace App\Traits;


use Illuminate\Http\JsonResponse;

trait ApiResponse
{

    public function apiSuccessResponse(array $data, $code = 200): JsonResponse
    {
        return response()->json(['success' => true] + $data, $code);
    }

    public function apiErrorResponse($message, $code = 500, $errors = null): JsonResponse
    {
        if ($code == 422){
            return response()->json(['success' => false, 'code' => $code, 'message' => $message, 'errors' => $errors], $code);
        }
        return response()->json(['success' => false, 'code' => $code, 'message' => $message], $code);
    }
}

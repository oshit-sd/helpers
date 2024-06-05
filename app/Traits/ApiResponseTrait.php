<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait ApiResponseTrait
{
    /**
     * @param $data
     * @param int $code
     * @param string $message
     * @return JsonResponse
     */
    public function sendResponse($data, int $code = Response::HTTP_OK, string $message = 'Fetched successfully'): JsonResponse
    {
        $array = ['success' => true, 'message' => $message, 'data' => $data];

        return response()->json($array, $code);
    }

    /**
     * Send http error response
     *
     * @var string $message
     * @var int $code
     * @var array $data
     * @return JsonResponse
     */
    public function sendError(string $message, int $code = Response::HTTP_INTERNAL_SERVER_ERROR, $data = [])
    {
        $array = ['success' => false, 'message' => $message, 'data' => $data];

        return response()->json($array, $code);
    }
}

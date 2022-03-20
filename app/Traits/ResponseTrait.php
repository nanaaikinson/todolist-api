<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait ResponseTrait
{
    public function successResponse(string $message, mixed $data = null): JsonResponse
    {
        $response = ["message" => $message];
        if ($data) $response["data"] = $data;

        return $this->apiResponse($response);
    }

    private function apiResponse(mixed $data, int $code = Response::HTTP_OK): JsonResponse
    {
        return response()->json($data, $code);
    }

    public function dataResponse(mixed $data): JsonResponse
    {
        $response = ["data" => $data];

        return $this->apiResponse($response);
    }

    public function errorResponse(string $message): JsonResponse
    {
        $response = ["message" => $message];
        return $this->apiResponse($response, Response::HTTP_BAD_REQUEST);
    }
}

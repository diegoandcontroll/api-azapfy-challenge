<?php
namespace App\Trait;

use Illuminate\Http\JsonResponse;

trait HttpResponses
{
    public function successResponse($data, $code = 200)
    {
        return response()->json($this->parseDataobj($data));
    }

    public function errorResponse($message, $code)
    {
        return response()->json(['error' => $message], $code);
    }

    public function createResponse($data)
    {
        return response()->json($this->parseDataobj($data),201);
    }
    public function responseSuccessNoMessage()
    {
        return response()->json(null,200);
    }
    public function unauthorizedReseponse()
    {
        return response()->json(["message" => 'Não Autorizado'],401);
    }
    public function notFound()
    {
        return response()->json(["message" => 'Não Encontrado'],403);
    }
    function parseDataObj($data){
        return ['data' => $data];
    }
    public function paginatedResponse($data, $currentPage, $perPage, $total, $code = JsonResponse::HTTP_OK)
    {
        return response()->json([
            'data' => $data,
            'meta' => [
                'current_page' => $currentPage,
                'per_page' => $perPage,
                'total' => $total,
                'total_pages' => ceil($total / $perPage),
            ],
        ], $code);
    }
}

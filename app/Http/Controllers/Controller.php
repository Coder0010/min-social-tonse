<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Handeling apiJsonResponse.
     * @param  mixed   $data
     * @param  integer $statusCode
     * @return JsonResponse
     */
    public function apiJsonResponse($data, int $statusCode = 200) : JsonResponse
    {
        return response()->json([
            "payload" => $data,
        ], $statusCode);
    }
}

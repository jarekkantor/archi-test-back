<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Sends success response
     *
     * @param string $message
     * @param array  $data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function resolve($message, $data = [])
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data'    => $data
        ]);
    }

    /**
     * Sends reject response
     *
     * @param  string $error
     * @return \Illuminate\Http\JsonResponse
     */
    public function reject(string $error)
    {
        return response()->json([
            'success' => false,
            'message' => $error,
        ], 422);
    }
}

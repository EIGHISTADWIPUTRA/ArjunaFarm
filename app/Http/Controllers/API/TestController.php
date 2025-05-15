<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Test endpoint untuk Sanctum authentication
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function test()
    {
        return response()->json([
            'message' => 'Anda memiliki akses API yang valid!',
            'user' => auth()->user(),
            'timestamp' => now(),
        ]);
    }

    /**
     * Endpoint yang hanya dapat diakses oleh admin
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function adminOnly()
    {
        return response()->json([
            'message' => 'Anda memiliki akses admin!',
            'user' => auth()->user(),
            'timestamp' => now(),
        ]);
    }
}

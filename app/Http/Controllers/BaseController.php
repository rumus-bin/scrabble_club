<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class BaseController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['code' => 200, 'data' => ['foo' => 'bar']]);
    }
}

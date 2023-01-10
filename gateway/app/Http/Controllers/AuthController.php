<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $url = config('microservice.user') . 'auth/login';
        $response = Http::withHeaders(request()->header())->post($url,$request->all())->json();

        return response()->json($response);
    }
}

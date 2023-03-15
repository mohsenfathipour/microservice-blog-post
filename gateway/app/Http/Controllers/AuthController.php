<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $url = config('microservice.user') . 'auth/login';

        $response = Http::withHeaders(['Accept' => 'application/json'])
                            ->post($url,$request->all());

        return response()->json($response->json(),$response->status());
    }
}

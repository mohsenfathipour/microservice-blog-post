<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        $url = config('microservice.user') . 'permission';

        $response = Http::withToken($request->bearerToken())
            ->withHeaders(['Accept' => 'application/json'])
            ->get($url);

        return response()->json($response->json(),$response->status());
    }

    public function store(Request $request)
    {
        $url = config('microservice.user') . "permission";

        $response = Http::withToken($request->bearerToken())
            ->withHeaders(['Accept' => 'application/json'])
            ->post($url, $request->all());

        return response()->json($response->json(),$response->status());
    }

    public function show(Request $request,int $id)
    {
        $url = config('microservice.user') . "permission/$id";

        $response = Http::withToken($request->bearerToken())
            ->withHeaders(['Accept' => 'application/json'])
            ->get($url);

        return response()->json($response->json(),$response->status());
    }

    public function update(Request $request, int $id)
    {
        $url = config('microservice.user') . "permission/$id";

        $response = Http::withToken($request->bearerToken())
            ->withHeaders(['Accept' => 'application/json'])
            ->post($url, $request->all());

        return response()->json($response->json(),$response->status());
    }

    public function destroy(Request $request, int $id)
    {
        $url = config('microservice.user') . "permission/$id";

        $response = Http::withToken($request->bearerToken())
            ->withHeaders(['Accept' => 'application/json'])
            ->delete($url, $request->all());

        return response()->json($response->json(),$response->status());
    }
}

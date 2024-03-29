<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $url = config('microservice.user') . 'user';

        $response = Http::withToken($request->bearerToken())
            ->withHeaders(['Accept' => 'application/json'])
            ->get($url);

        return response()->json($response->json(),$response->status());
    }


    public function show(int $user_id , Request $request)
    {

        $url = config('microservice.user') . "user/$user_id";

        $response = Http::withToken($request->bearerToken())
            ->withHeaders(['Accept' => 'application/json'])
            ->get($url);

        return response()->json($response->json(),$response->status());
    }

    public function store(Request $request)
    {
        $url = config('microservice.user') . 'user';

        $response = Http::withToken($request->bearerToken())
            ->withHeaders(['Accept' => 'application/json'])
            ->post($url, $request->all());

        return response()->json($response->json(),$response->status());
    }

    public function role(Request $request, int $user_id)
    {
        $url = config('microservice.user') . "user/$user_id/role";

        $response = Http::withToken($request->bearerToken())
            ->withHeaders(['Accept' => 'application/json'])
            ->get($url, $request->all());

        return response()->json($response->json(),$response->status());
    }
    public function storeRoleToUser(Request $request, int $user_id , int $role_id)
    {
        $url = config('microservice.user') . "user/$user_id/role/$role_id";

        $response = Http::withToken($request->bearerToken())
            ->withHeaders(['Accept' => 'application/json'])
            ->post($url, $request->all());

        return response()->json($response->json(),$response->status());
    }
    public function destroyRoleToUser(Request $request, int $user_id , int $role_id)
    {
        $url = config('microservice.user') . "user/$user_id/role/$role_id";

        $response = Http::withToken($request->bearerToken())
            ->withHeaders(['Accept' => 'application/json'])
            ->delete($url, $request->all());

        return response()->json($response->json(),$response->status());
    }





}

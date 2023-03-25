<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $url = config('microservice.user') . 'role';

        $response = Http::withToken($request->bearerToken())
            ->withHeaders(['Accept' => 'application/json'])
            ->get($url);

        return response()->json($response->json(),$response->status());
    }

    public function store(Request $request)
    {
        $url = config('microservice.user') . "role";

        $response = Http::withToken($request->bearerToken())
            ->withHeaders(['Accept' => 'application/json'])
            ->post($url, $request->all());

        return response()->json($response->json(),$response->status());
    }

    public function show(Request $request,int $id)
    {
        $url = config('microservice.user') . "role/$id";

        $response = Http::withToken($request->bearerToken())
            ->withHeaders(['Accept' => 'application/json'])
            ->get($url);

        return response()->json($response->json(),$response->status());
    }

    public function update(Request $request, int $id)
    {
         $url = config('microservice.user') . "role/$id";

        $response = Http::withToken($request->bearerToken())
            ->withHeaders(['Accept' => 'application/json'])
            ->post($url, $request->all());

        return response()->json($response->json(),$response->status());
    }

    public function destroy(Request $request, int $id)
    {
        $url = config('microservice.user') . "role/$id";

        $response = Http::withToken($request->bearerToken())
            ->withHeaders(['Accept' => 'application/json'])
            ->delete($url, $request->all());

        return response()->json($response->json(),$response->status());
    }

    public function permission(Request $request, int $role_id)
    {
        $url = config('microservice.user') . "role/$role_id/permission";

        $response = Http::withToken($request->bearerToken())
            ->withHeaders(['Accept' => 'application/json'])
            ->get($url, $request->all());

        return response()->json($response->json(),$response->status());
    }
    public function storePermissionToRole(Request $request, int $role_id , int $permission_id)
    {
        $url = config('microservice.user') . "role/$role_id/permission/$permission_id";

        $response = Http::withToken($request->bearerToken())
            ->withHeaders(['Accept' => 'application/json'])
            ->post($url, $request->all());

        return response()->json($response->json(),$response->status());
    }
    public function destroyPermissionToRole(Request $request, int $role_id , int $permission_id)
    {
        $url = config('microservice.user') . "role/$role_id/permission/$permission_id";

        $response = Http::withToken($request->bearerToken())
            ->withHeaders(['Accept' => 'application/json'])
            ->delete($url, $request->all());

        return response()->json($response->json(),$response->status());
    }
}

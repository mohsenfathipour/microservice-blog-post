<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CommentController extends Controller
{


    public function show(int $id , Request $request)
    {

        $url = config('microservice.post') . "post/$id/comment";

        $response = Http::withToken($request->bearerToken())
            ->withHeaders(['Accept' => 'application/json'])
            ->get($url);

        return response()->json($response->json(),$response->status());
    }

    public function store(int $id, Request $request)
    {
        $url = config('microservice.post') . "post/$id/comment";

        $response = Http::withToken($request->bearerToken())
            ->withHeaders(['Accept' => 'application/json'])
            ->post($url, $request->all());

        return response()->json($response->json(),$response->status());
    }

}

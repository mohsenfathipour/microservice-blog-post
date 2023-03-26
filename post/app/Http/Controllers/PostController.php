<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $posts = Post::orderByDesc('id')->get();

        return response()->json([
            'success' => true,
            'data' => $posts,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePostRequest $request
     * @return JsonResponse
     */
    public function store(StorePostRequest $request): JsonResponse
    {
        $data = $request->all();



        $post = new Post();
        $post->title = $data['title'];
        $post->content = $data['content'];
        $post->user_id = Auth::user()->id;

        $post->save();

        return response()->json([
            'success' => true,
            'data' => $post
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Post $post
     * @return JsonResponse
     */
    public function show(Post $post): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $post,
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePostRequest $request
     * @param \App\Models\Post $post
     * @return JsonResponse
     */
    public function update(UpdatePostRequest $request, Post $post): JsonResponse
    {
        // Todo: Check User Validation
        $validatedData = $request->validated();

        $post->update($validatedData);

        return response()->json([
            'success' => true,
            'data' => $post,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Post $post
     * @return JsonResponse
     */
    public function destroy(Post $post): JsonResponse
    {
        $post->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}

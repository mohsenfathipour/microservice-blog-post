<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        $perPage = request()->input('perPage', 5); // Default to 10 items per page if not specified
        $page = request()->input('page', 1); // Default to the first page if not specified

        $posts = Post::withCount('comments')->orderByDesc('id')->paginate($perPage, ['*'], 'page', $page); // Get paginated results with the specified perPage and page parameters

        return response()->json([
            'success' => true,
            'data' => $posts->items(),
            'meta' => [
                'current_page' => $posts->currentPage(),
                'last_page' => $posts->lastPage(),
                'per_page' => $posts->perPage(),
                'total' => $posts->total(),
            ],
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
        $post->load(['comments']);
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
        # Check Author:
        if($post->user_id != Auth::user()->id){
            return response()->json([
                'success' => false,
                'message' => 'Access Denied',
            ],Response::HTTP_FORBIDDEN);
        }

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

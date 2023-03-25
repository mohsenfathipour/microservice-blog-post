<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CommentController extends Controller
{
    public function store(Post $post, Request $request)
    {
        $data = $request->all();

        # Check User:
        $url = config('microservice.user') . 'user/' . $data['user_id'];

        $user = Http::withToken($request->bearerToken())
            ->withHeaders(['Accept' => 'application/json'])
            ->get($url);

        if (!isset($user['data']))
            return response()->json([
                'state' => false,
                'data' => null,
                'message' => 'user not found'
            ]);

        $comment = new Comment();
        $comment->content = $data['content'];
        $comment->post_id = $post->id;
        $comment->user_id = $user['data']['id'];

        $comment->save();

        return response()->json([
            'state' => true,
            'data' => $comment
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $posts = Comment::where('post_id',$post->id)->orderByDesc('id')->get();

        return response()->json([
            'state' => true,
            'data' => $posts
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

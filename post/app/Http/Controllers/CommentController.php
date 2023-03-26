<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CommentController extends Controller
{
    public function store(Post $post, Request $request)
    {
        $data = $request->all();



        $comment = new Comment();
        $comment->content = $data['content'];
        $comment->post_id = $post->id;
        $comment->user_id = Auth::user()->id;

        $comment->save();

        return response()->json([
            'success' => true,
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
            'success' => true,
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

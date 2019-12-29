<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{

    /**在 PostController 的 insertPost 中，$request->input() 會取得輸入的值，不需要區分是來自 GET 還是 POST 方法。
     *
     */

    public function insertPost(Request $request)
    {
        $post = new Post;
        $post->post_text = $request->input('post_text');
        $post->save();
    }




    public function allPost()
    {
        $response = "All Posts: ";
        $posts = Post::all();
        foreach ($posts as $post) {
            $response .= $post;
        }
        return $response;
    }
}

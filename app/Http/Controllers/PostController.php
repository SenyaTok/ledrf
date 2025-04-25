<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    //
    public function postSave(Request $postRaw)
    {

        $postData = $postRaw->validate([
            "theme" => "required",
            "text" => "required",
        ]);

        if (!$postRaw->post_id) {
            $post_id = Post::insertGetId([
                'theme' => $postRaw->theme,
                'text' => $postRaw->text,
                'post_type_id' => $postRaw->ptype,
            ]);
        } else {
            $post = Post::find($postRaw->post_id)
                ->update([
                    'theme' => $postRaw->theme,
                    'text' => $postRaw->text,
                    'updated_at'
                ]);
            $post_id = $postRaw->post_id;
        }

        return redirect()->route('seePost', ['id' => $post_id]);
    }
    public function allPosts()
    {
        $posts = Post::where('post_type_id', 1)
            ->paginate(3);
        // dd($posts);

        return view("post.forum", compact("posts"));
    }
    public function seePost($id)
    {
        $post = Post::where("posts.id", $id)
            ->first();

        $theme = ['firstPost' => $post];

        if ($post) {
            $replies = optional($post->replies)->toArray();
            $theme += ['replies' => $replies];
        }

        // dd($theme);

        return view("post.only", compact("theme"));
    }
    public function postEditor(Request $request)
    {
        $data['post'] = Post::find($request->id);
        $data['reply_to'] = $request->idToReply;
        $data['ptypes'] = PostType::get();

        return view("post.editor", compact('data'));
    }
    public function postDelete(Request $request)
    {
        $post = Post::where('id', $request->id)->first();
        $return_to = PostType::where('id', $post->post_type_id)->first()->name;
        $post->delete();

        return redirect()->route("viewPosts", ['ptype' => $return_to]);
    }
}

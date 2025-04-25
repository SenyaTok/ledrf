<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use App\Models\OurWorks;
use App\Models\Post;
use App\Models\PostType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    //
    public function home()
    {

        $data['oworks'] = OurWorks::paginate(4);
        $data['letters'] = Letter::get();

        // dd($data);

        return view('home', compact('data'));
    }

    public function viewPosts($ptype)
    {
        if ($ptype === 'Черновик') {
            if (
                Auth::guest()
                ||
                Auth::user()->role === 3
            ) {
                return redirect()->back()->with('error', 'Отказано в доступе');
            }
        }

        $ptypeid = PostType::select('id')->where('name', $ptype)->first()->id;

        $data['title'] = $ptype;
        $data['posts'] = Post::where('posts.post_type_id', $ptypeid)
            ->paginate(5);

        // dd($data['posts']);

        return view('post.forum', compact('data'));
    }
}

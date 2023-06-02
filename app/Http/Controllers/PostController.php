<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PostDetailResource;

class PostController extends Controller
{
    function index() {
        $data = Post::get();
    // return response()->json(['data'=>$data]);
    return PostDetailResource::collection($data->loadMissing('writter:id,Username'));
    }

    public function show ($id) {
        $posts = Post::with('writter:id,Username')->findOrFail($id);
        return new PostDetailResource($posts);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'text_content' => 'required',
        ]);
        $request['author'] = Auth::user()->id;
        $post = Post::create($request->all());
        return new PostDetailResource($post->loadMissing('writter:id,Username'));
    }

    public function Patch(Request $request,$id)
    {
        $request->validate([
            'title' => 'required',
            'text_content' => 'required',
        ]);
        $patch = Post::findOrFail($id);
        $patch->update($request->all());

        return new PostDetailResource($patch->loadMissing('writter:id,Username'));
    }
    public function delete(Request $request ,$id)
    {
        $delete = Post::findOrfail($id);
        $delete->delete();  
        return response()->json($delete);

    }

}

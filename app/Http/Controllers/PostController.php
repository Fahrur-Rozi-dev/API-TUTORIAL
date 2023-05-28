<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    function index() {
        $data = Post::get();
    // return response()->json(['data'=>$data]);
    return PostResource::collection($data);
    }

}

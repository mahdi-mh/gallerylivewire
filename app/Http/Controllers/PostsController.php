<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function ShowSingle(Post $post){
        return view('singlePost',['post' => $post]);
    }
}

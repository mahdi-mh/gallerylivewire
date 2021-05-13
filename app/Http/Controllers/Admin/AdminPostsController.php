<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminPostsController extends Controller
{
    public function IndexView(){
        return view('admin.adminPosts');
    }
}

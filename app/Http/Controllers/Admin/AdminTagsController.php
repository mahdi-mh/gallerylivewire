<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminTagsController extends Controller
{
    public function IndexView(){
        return view('admin.adminTags');
    }
}

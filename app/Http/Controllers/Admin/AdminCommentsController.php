<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminCommentsController extends Controller
{
    public function IndexView(){
        return view('admin.adminComments');
    }
}

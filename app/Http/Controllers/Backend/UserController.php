<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    public function userList()
    {

    }

    public function createForm()
    {
        return view('backend.users.create');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserlistController extends Controller
{
    //
    public function index()
    {
        $users = User::select('id', 'name', 'email', 'created_at')->paginate(10);
        return view('userlist', compact('users'));
    }


}

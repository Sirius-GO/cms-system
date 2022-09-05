<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth'); //->except(['index']);
    }
    
    public function show(User $user){
        return view('admin.users.profile')->with('user', $user);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
Use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::id();
        $user = User::find($userId);
        
        if($user->id == 1){

            return view('admin.admin_home');
        }
        
        return view('student.student_home');
    }
}

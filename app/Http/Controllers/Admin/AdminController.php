<?php

namespace App\Http\Controllers\Admin;

use App\Eloquent\Contact;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard', ['nav_bar' => 'Dashboard']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}

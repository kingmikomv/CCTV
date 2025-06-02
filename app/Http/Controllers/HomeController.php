<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
         if (Gate::allows('isAdmin')) {
        return view('Dashboard.Admin.index');
    } elseif (Gate::allows('isUser')) {
        return view('Dashboard.User.index');
    }

    abort(403, 'Unauthorized');
    }
}

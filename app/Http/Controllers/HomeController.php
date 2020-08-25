<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $matters = \App\Matter::where('end_flag',false);
        if ( ! $matters->exists() || $matters->count() < 5 ) {
            \App\Http\Controllers\Ajax\ChatController::createMatter();
        }
        $matters = $matters->get()->toArray();
        return view('home', compact('matters'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Board;
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
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($channel = null)
    {
        $board = Board::where('channel', $channel)->first();
        if(!$board) abort(404);
        if(!$channel) abort(404);

        abort(404);
    }
}

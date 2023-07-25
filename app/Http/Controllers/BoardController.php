<?php

namespace App\Http\Controllers;

use App\Events\NewDot;
use App\Models\Board;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    public function index(Board $board)
    {
        return view('board', compact('board'));
    }

    public function addDot(Request $request, Board $board)
    {
        $data = $request->validate([
            'x' => 'required|integer',
            'y' => 'required|integer',
            'color' => 'required|string'
        ]);

        $data['ip'] = $request->ip();
        $dot = $board->dots()->create($data);

        event(new NewDot($data));

        return response()->json(['message' => 'success']);
    }
}

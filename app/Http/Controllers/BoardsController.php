<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BoardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $boards = Board::all();

        // $data = array( $boards );

        // return view('boards.index', $data);
        return view('boards.index')->with('lists', $boards);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('boards.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'content' => 'required',
        ]);

        Board::create($request->all());

        return redirect()->route('boards.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Board $board
     * @return Application|Factory|View
     */
    public function show(Board $board)
    {
        $board = Board::where('id', $board->id)->first();

        return view('boards.show')->with('row', $board);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Board $board
     * @return Application|Factory|View
     */
    public function edit(Board $board)
    {
        $board = Board::where('id', $board->id)->first();

        return view('boards.edit')->with('row', $board);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Board $board
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Board $board)
    {
        $request->validate([
            'subject' => 'required',
            'content' => 'required',
        ]);

        $board->update($request->all());

        return redirect()->route('boards.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Board $board
     * @return \Illuminate\Http\Response
     */
    public function destroy(Board $board)
    {
        $board->delete();

        return redirect()->route('boards.index');
    }
}

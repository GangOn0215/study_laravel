<?php

namespace App\Http\Controllers;

use App\Models\todos;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class TodosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $data = array(
            'action' => '/todos/store',
            'form_info' => array(
                'method' => 'POST',
            )
        );

        return view('todos.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\todos  $todos
     * @return \Illuminate\Http\Response
     */
    public function show(todos $todos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\todos  $todos
     * @return \Illuminate\Http\Response
     */
    public function edit(todos $todos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\todos  $todos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, todos $todos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\todos  $todos
     * @return \Illuminate\Http\Response
     */
    public function destroy(todos $todos)
    {
        //
    }
}

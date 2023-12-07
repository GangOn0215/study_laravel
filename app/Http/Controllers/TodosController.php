<?php

namespace App\Http\Controllers;

use App\Models\Todos;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index() : View
    {
        $data = array();

        $todos = Todos::where('created_member', Auth::id())
            ->orderBy('id', 'desc')
            ->get();

        $data['application'] = $todos;
        return view('todos.index')->with('application', $todos);
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
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required',
        ]);

        $data = array(
            'subject' => $request['subject'],
            'created_member' => auth::id(),
            'date' => date('Y-m-d')
        );

        Todos::create($data);

        return redirect()->route('todos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Todos $todo
     * @return Application|Factory|View
     */
    public function show(Todos $todo)
    {
        $todo = Todos::where('id', $todo->id)->first();

        return view('todos.view')->with('row', $todo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Todos $todo
     * @return Application|Factory|View
     */
    public function edit(Todos $todo)
    {
        $todos = Todos::where('id', $todo->id)->first();

        return view('todos.form')->with('row', $todos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Todos $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, todos $todo)
    {
        $request->validate([
            'subject' => 'required'
        ]);

        $todo->update($request->all());

        return redirect()->route('todos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Todos $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todos $todo)
    {
        $todo->delete();

        return redirect()->route('todos.index');
    }
}

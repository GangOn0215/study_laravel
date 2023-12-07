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
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $data = array();

        // $todos = Todos::get()->where('created_member', auth::id());
        $todos = Todos::where('created_member', Auth::id())
            ->orderBy('id', 'desc')
            ->get();

        $todosList = array();

        foreach($todos as $row) {
            $todosList[] = [
                'id' => $row->id,
                'subject' => $row->subject,
                'content' => $row->content,
                'date' => $row->date
            ];
        }

        $data['application'] = $todosList;

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
     * @param Request $request
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

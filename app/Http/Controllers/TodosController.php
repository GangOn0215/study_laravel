<?php

namespace App\Http\Controllers;

use App\Models\Todos;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class TodosController extends Controller
{
    private $data = array();

    public function __construct()
    {
        $data['session'] = session();
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(Request $request) : View
    {
        $requestAll = $request->all();

        $startDate = $data['start_date'] = $requestAll['start_date'] ?? null;
        $endDate = $data['end_date'] = $requestAll['end_date'] ?? null;

        if(!$startDate && !$endDate) {
            $startDate = $data['start_date'] = date('Y-m-d');
        }

        $todos = Todos::lists(array(
            'limit' => 0,
            'start' => 0,
            'searches' => array('start_date' => $startDate, 'end_date' => $endDate, 'created_member' => Auth::id())
        ));

        $data['application'] = $todos;

        return view('todos.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $application = new \stdClass;
        $todoColumns = Todos::getColumnList();

        foreach($todoColumns as $column) {
            $application->$column = '';
        }

        $data['application'] = $application;

        $data['form_init'] = array(
            'action' => 'todos.store',
            'method' => 'POST',
            'submit_text' => '확인'
        );

        return view('todos.form')->with('data', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'subject' => 'required',
        ]);

        $fileHashName = '';
        $fileOriginalName = '';

        if($request->hasfile('image')) {
            $file = $request->file('image');
            $fileOriginalName =  $file->getClientOriginalName();
            $fileName = explode('.', $file->getClientOriginalName())[0];

            $ext = $file->getClientOriginalExtension();

            $fileHashName = md5($fileName) . '.' . $ext;
            $path = $file->storeAs( 'public/todos/', $fileHashName);
        }

        $data = array(
            'image_hash_id' => $fileHashName,
            'image_name' => $fileOriginalName,
            'subject' => $request['subject'],
            'content' => $request['content'],
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
    public function show(Todos $todo): View|Factory|Application
    {
        $todos = Todos::where('id', $todo->id)->first();

        return view('todos.view')->with('row', $todos);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Todos $todo
     * @return Application|Factory|View
     */
    public function edit(Todos $todo): View|Factory|Application
    {
        $application = Todos::where('id', $todo->id)->first();

        $data['application'] = $application;

        $data['form_init'] = array(
            'action' => 'todos.update',
            'method' => 'PATCH',
            'submit_text' => '수정'
        );

        return view('todos.form')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Todos $todo
     * @return \Illuminate\Http\JsonResponse|RedirectResponse
     */
    public function update(Request $request, todos $todo)
    {
        $requestData = $request->all('ajax');

        if($requestData['ajax'])
        {
            $todo->update($request->all());

            return response()->json([ 'state' => true, 'id' => $todo->id ]);
        }

        $fileHashName = '';
        $fileOriginalName = '';

        if($request->hasfile('image')) {
            $file = $request->file('image');
            $fileOriginalName =  $file->getClientOriginalName();
            $fileName = explode('.', $file->getClientOriginalName())[0];

            $ext = $file->getClientOriginalExtension();

            $fileHashName = md5($fileName) . '.' . $ext;
            $path = $file->storeAs( 'public/todos/', $fileHashName );
        }

        $data = array(
            'subject' => $request['subject'],
            'content' => $request['content'],
            'date' => $request['date']
        );

        if($fileHashName !== '' && $fileOriginalName !== '') {
            $data['image_hash_id'] =  $fileHashName;
            $data['image_name'] = $fileOriginalName;
        }

        $todo->update($data);

        return redirect()->route('todos.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Todos $todo
     * @return RedirectResponse
     */
    public function destroy(Todos $todo): RedirectResponse
    {
        $todo->delete();

        return redirect()->route('todos.index');
    }
}

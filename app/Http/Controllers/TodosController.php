<?php

namespace App\Http\Controllers;

use App\Models\Todos;
use App\Models\TodosGroup;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class TodosController extends Controller
{
    private array $data = array();
    private $session = null;

    public function __construct(Request $request)
    {
        $data['session'] = session();

        // query string
        $checkQueryKeys = array('start_date', 'end_date');
        $data['queryString'] = '?';

        foreach($request->query() as $k => $v) {
            if(in_array($k, $checkQueryKeys)) {
                $data['queryString'] .= "&{$k}= {$v}";
            }
        }

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
            'searches' => array('start_date' => $startDate, 'end_date' => $endDate, 'created_member' => Auth::id(), 'group_id' => 0)
        ));

        $todosGroupList = TodosGroup::lists(array(
            'limit' => 0,
            'start' => 0,
            'searches' => array('created_member' => Auth::id())
        ));

        $data['application'] = $todos;
        $data['group_list'] = $todosGroupList;

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

        // todos sequence 마지막 가져오기
        $sequenceLastRow = Todos::orderBy('sequence', 'desc')->first();

        $data = array(
            'image_hash_id' => $fileHashName,
            'image_name' => $fileOriginalName,
            'subject' => $request['subject'],
            'content' => $request['content'],
            'created_member' => auth::id(),
            'sequence' => $sequenceLastRow->sequence + 1,
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
        $application = Todos::where('id', $todo->id)->first();

        $data['application'] = $application;

        return view('todos.view')->with('data', $data);
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
     * @return JsonResponse|RedirectResponse
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
     * @return JsonResponse|RedirectResponse
     */
    public function destroy(Todos $todo, Request $request)
    {
        $requestData = $request->all();

        $id = $todo['id'];
        $sequence = $todo['sequence'];

        $todo->delete();

        if($request->input('ajax')) {
            return response()->json(
                [
                    'state' => true,
                    'data' => [
                        'id' => $id,
                        'sequence' => $sequence
                    ]
                ]
            );
        }

        return redirect()->route('todos.index');
    }

    public function ajaxSequenceChange(Request $request) {
        $resData = $request->input('data');

        for($i = 0; $i < count($resData['idx']); $i++) {
            $updateData = array(
                'sequence' => $resData['sequence'][$i]
            );

            Todos::where('id', $resData['idx'][$i])
                ->update($updateData);
        }

        return response()->json([ 'state' => true ]);
    }
}

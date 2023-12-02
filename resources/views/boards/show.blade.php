@extends('boards.layout')

@section('content')
    <a href="{{route('boards.index')}}">목록</a>
    <table border="1">
        <tr>
            <th>unique ID</th>
            <td>{{$row->id}}</td>
        </tr>
        <tr>
            <th>Subject</th>
            <td>{{$row->subject}}</td>
        </tr>
        <tr>
            <th>Content</th>
            <td>{{$row->content}}</td>
        </tr>
    </table>
@endsection


@extends('layouts.layout')

@section('content')
    TODOS <br><br>

    <a href="{{route('todos.create')}}">Create</a>
@endsection

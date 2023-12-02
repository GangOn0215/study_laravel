@extends('layouts.layout')

@section('content')

    <style>
        html, body{
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
        }
        .container {
            display: flex;
            width: 100%;
            height: 100%;
            justify-content: center;
            align-items: center;
        }

        .container form {
            width: 300px;
        }

        .container form table {
            widtH: 100%;
        }

        .container form input {
            width: 100%;
        }
    </style>

    <div class="container">
        <form action="{{ $action }}" method="POST">
            @csrf
            @method($form_info['method'])
            <div class="todos-container">
                <div class="todos-header">
                </div>
                <div class="todos-body">
                    <input type="">
                </div>
            </div>
        </form>
    </div>

@endsection

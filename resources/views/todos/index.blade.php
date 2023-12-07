@extends('layouts.layout')

@section('content')
    <section class="flex h-full w-full justify-center">
        <div class="flex flex-col h-full justify-center w-2/6 todo-container">
            <form action="{{ route('todos.store') }}" method="post">
                @csrf
                <div class="flex flex-col w-full ">
                    <div class="flex w-full h-10 todo-header">
                        <input type="text" name="subject" class="w-full border border-gray-400 mr-4 p-2">
                        <button class="w-24  flex-shrink-0 border border-gray-400">추가</button>
                    </div>

                </div>
            </form>

            <div class="flex w-full todo-body mt-8">
                <ul class="flex flex-col w-full">
                    @foreach($application as $row)
                        <li class="flex w-full items-center justify-between h-10 mb-4">
                            <span class="w-5/6 p-2 border border-gray-300 mr-4">
                                <a href="{{route('todos.show', $row->id)}}">
                                    {{$row->subject}}
                                </a>
                            </span>
                            <div class="flex items-center justify-around w-24 h-full border">
                                <button class="">
                                    <a href="{{route('todos.edit', $row->id)}}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </button>
                                <form action="{{route('todos.destroy', $row->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
@endsection

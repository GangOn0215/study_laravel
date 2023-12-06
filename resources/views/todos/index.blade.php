@extends('layouts.layout')

@section('content')
    <section class="flex h-full w-full justify-center">
        <form action="{{ $action }}" method="post" class="flex flex-col h-full justify-center w-2/6">
            @csrf
            @method($form_info['method'])
            <div class="flex flex-col w-full todo-container">
                <div class="flex w-full h-10 todo-header">
                    <input type="text" name="subject" class="w-full border border-gray-400 mr-4 p-2">
                    <button class="w-24  flex-shrink-0 border border-gray-400">추가</button>
                </div>
                <div class="flex w-full todo-body mt-8">
                    <ul class="flex flex-col w-full">
                        <li class="flex w-full items-center justify-between h-10 mb-4">
                            <span class="w-5/6 p-2 border border-gray-300 mr-4">1</span>
                            <div class="flex items-center justify-around w-24 h-full border">
                                <button class="">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button>
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </form>
    </section>
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/datepicker.min.js"></script>
@extends('layouts.layout')

@section('content')
    <section class="flex h-full w-full justify-center">
        <div class="flex flex-col h-full justify-center w-2/6 todo-container">
            <form action="{{ route('todos.update', $row->id) }}" method="post">
                @csrf
                @method('PATCH')
                <div class="flex flex-col w-full">
                    <div class="flex w-full h-10 todo-header mb-4">
                        <input type="text" name="subject" class="w-full border border-gray-400 p-2" value="{{$row->subject}}" placeholder="TODO">
                    </div>
                    <textarea name="content" class="border border-gray-400 mb-4 resize-none p-2" cols="30" rows="10"  placeholder="TODO Description">{{$row->content}}</textarea>
                    <button type="submit" class="w-full  flex-shrink-0 border border-gray-400 p-2">수정</button>
                </div>
            </form>
            </div>
        </div>
    </section>

@endsection



@extends('layouts.layout')

@section('content')
    <section class="flex h-full w-full justify-center">

        <div class="flex flex-col h-full justify-center w-2/6 todo-container">
            <div class="flex date-container">
                <div class="flex justify-between items-center w-full">
                    <input type="text" name="date" class="border border-gray-400 p-2 datepicker" value="{{$row->date}}" readonly>
                </div>
            </div>
            <form action="{{ route('todos.update', $row->id) }}" method="post" class="mt-4">
                @csrf
                @method('PATCH')
                <div class="flex flex-col w-full">
                    <div class="flex w-full h-10 todo-header mb-4">
                        <input type="text" name="subject" class="w-full border border-gray-400 p-2" value="{{$row->subject}}" placeholder="TODO">
                    </div>
                    <textarea name="content" class="border border-gray-400 mb-4 resize-none p-2" cols="30" rows="10"  placeholder="TODO Description">{{$row->content}}</textarea>
                    <div class="flex w-full justify-between ">
                    <button id="prev-page" class="w-full border border-gray-400 p-2 mr-2">이전</button>
                    <button type="submit" class="w-full border border-gray-400 p-2">수정</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <script>
        $('#prev-page').on('click', function(e) {
            e.preventDefault();

            history.back();
        })
    </script>

@endsection



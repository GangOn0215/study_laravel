@extends('todos.layout')

@section('content')
    <section class="flex h-full w-full justify-center">
        <div class="flex flex-col h-full justify-center w-2/6 todo-container">
            <div class="flex todo-header">
                <div class="flex justify-between items-center w-full">
                    <div class="flex justify-between items-center w-full mr-4">
                        <input type="text" class="w-full border border-gray-400 p-2 mr-4 datepicker" placeholder="start date" readonly>
                        <input type="text" class="w-full border border-gray-400 p-2  datepicker" placeholder="end date" readonly>
                    </div>
                    <button class="flex-shrink-0 p-2 border border-gray-400 w-24">검색</button>
                </div>
            </div>

            <div class="flex justify-end mt-8">
                <a href="{{route('todos.create')}}" class="w-24 py-1 px-2 border border-gray-400 text-center">Create</a>
            </div>

            <div class="flex w-full todo-body border border-gray-400 p-4 mt-4">
                <ul class="flex flex-col w-full">
                    @foreach($data['application'] as $row)
                        <li class="flex w-full items-center justify-between h-10 mb-4">
                            <span class="w-5/6 p-2 border border-gray-300 mr-4">
                                <a href="{{route('todos.show', $row->id)}}">
                                    {{$row->subject}}
                                </a>
                            </span>
                            <div class="flex items-center justify-around w-24 h-full border">
                                <button class="btn-check" data-id="{{$row->id}}" data-check="{{$row->is_check}}">
                                    @if($row->is_check)
                                        <i class="fa-solid fa-square-check"></i>
                                    @else
                                        <i class="fa-regular fa-square"></i>
                                    @endif
                                </button>
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

    <script>
        const data = {};

        $(window).on('load', function() {

            $('.btn-check').on('click', function() {
                const id = $(this).attr('data-id');
                const isCheck = parseInt($(this).attr('data-check'));
                const toggleCheck = isCheck === 1 ? 0 : 1;

                $.ajax({
                    type: 'POST',
                    url: `todos/${id}`,
                    dataType: 'json',
                    data: { _token: '{{ csrf_token() }}', _method: 'PATCH', is_check: toggleCheck, ajax: true },
                    success: function(response) {
                        location.reload();
                        if(response) {
                        }
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });
            });


        })
    </script>
@endsection

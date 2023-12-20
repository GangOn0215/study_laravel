@extends('todos.layout')

<style>
    .ui-state-highlight-2 { height: 2.5em; line-height: 2.5em; margin: 1rem; background-color: #cdd1d7 !important; border: 1px solid #9ca3af !important; }
</style>

@section('content')
    <section class="flex w-full justify-center py-6">
        <div class="flex flex-col h-full justify-center todo-container px-4">
            <div class="flex todo-header">
                <form action="{{route('todos.index')}}" method="get">
                    <div class="flex justify-between items-center w-full">
                        <div class="flex justify-between items-center w-full mr-4">
                            <input type="text" name="start_date" class="w-full border border-gray-400 p-2 mr-4 datepicker" placeholder="start date" value="{{$data['start_date']}}" readonly>
                            <input type="text" name="end_date" class="w-full border border-gray-400 p-2  datepicker" placeholder="end date" value="{{$data['end_date']}}" readonly>
                        </div>
                        <button class="flex-shrink-0 p-2 border border-gray-400 w-24">검색</button>
                    </div>
                </form>
            </div>

            <div class="flex justify-end mt-4">
                <a href="{{route('todos.create')}}" class="w-24 py-1 px-2 border border-gray-400 text-center">Create</a>
            </div>

            <div class="flex w-full todo-body border border-gray-400 p-4 mt-4">
                <ul class="flex flex-col w-full" id="sortable">
                    @foreach($data['application'] as $row)
                        <li class="flex w-full items-center justify-between h-10 mb-4 ui-state-default bg-white border-0">
                            <span class="w-5/6 p-2 border border-gray-300 mr-4">
                        <li class="flex w-full items-center justify-between mb-4 ui-state-default bg-transparent border-0 todos-item" data-id="{{$row->id}}" data-sequence="{{$row->sequence}}">
                            <span class="w-5/6 p-2 border border-gray-300 mr-4 bg-white flex justify-between items-center">
                                <a href="{{route('todos.show', $row->id)}}">
                                    {{$row->subject}}
                                </a>
                                <i class="fa-solid fa-bars handle"></i>
                            </span>
                            <div class="flex items-center justify-around w-24 h-full border">
                            <div class="flex items-center justify-around w-24 h-full border bg-white">
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
                                <form action="{{route('todos.destroy', $row->id)}}" method="post" class="m-0">
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

                const checkboxHtml = {
                    0:  '<i class="fa-solid fa-square-check"></i>',
                    1: '<i class="fa-regular fa-square"></i>'
                }

                $.ajax({
                    type: 'POST',
                    url: `todos/${id}`,
                    dataType: 'json',
                    data: { _token: '{{ csrf_token() }}', _method: 'PATCH', is_check: toggleCheck, ajax: true },
                    success: function(response) {
                        // location.reload();
                        if(response.state) {
                            const checkedButton = $(`button.btn-check[data-id="${response.id}"]`);
                            const checkedState = parseInt(checkedButton.attr('data-check'));

                            checkedButton.attr('data-check', checkedState === 0 ? 1 : 0)

                            checkedButton.empty();
                            checkedButton.append(checkboxHtml[checkedState]);
                        }
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });
            });

            const sortable = $('#sortable');

            sortable.sortable({
                placeholder: "ui-state-highlight-2"
            });

            sortable.disableSelection();

        })
    </script>
@endsection

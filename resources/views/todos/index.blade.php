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
                        <li class="flex w-full items-center justify-between mb-4 ui-state-default bg-transparent border-0 todos-item" data-id="{{$row->id}}" data-sequence="{{$row->sequence}}">
                            <span class="w-5/6 p-2 border border-gray-300 mr-4 bg-white flex justify-between items-center">
                                <a href="{{route('todos.show', $row->id)}}">
                                    {{$row->subject}}
                                </a>
                                <i class="fa-solid fa-bars handle"></i>
                            </span>
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
                                <button class="delete-todo" data-id="{{$row->id}}">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </section>

    <script>
        const applicationManage = {
            idx: [],
            sequence: []
        }

        function init() {
            // applicationManage 초기화
            // array 로 만들고 todos items 를 가져옵니다
            reloadApplicationManage(true);

            // 드래그 앤 드랍
            const sortable = $('#sortable');

            sortable.sortable({
                placeholder: "ui-state-highlight-2",
                restrict: true,
                restrictClass: 'handle',
                update: function(e, ui) { // 업데이트 이후
                    // applicationManage의 idx를 reload 시켜줍니다.
                    reloadApplicationManage();

                    // ajax로 변경된 부분을 바로 반영
                    $.ajax({
                        type: 'POST',
                        url: `todos/ajaxSequenceChange`,
                        dataType: 'json',
                        data: { _token: '{{ csrf_token() }}', _method: 'POST', data: applicationManage  },
                        success: function(response) {
                            if(response.state) {
                            }
                        },
                        error: function (e) {
                        }
                    });
                }
            });

            sortable.disableSelection();
        }

        /*
        * 1. 최초 한번 INIT
        * 2. Sortable에 의해 변경된 idx를 reload
        *
        * */
        function reloadApplicationManage(isFirst = false) {
            const todosItemList = Array.from($('.todos-item'));

            // 초기화
            applicationManage['idx'] = [];

            todosItemList.forEach(function(item, index) {
                const id = $(item).attr('data-id');
                const sequence = $(item).attr('data-sequence');

                applicationManage['idx'].push(id);

                if(isFirst) {
                    applicationManage['sequence'].push(sequence);
                }
            });
        }

        $(window).on('load', function() {

            // todos checkbox 눌렀을때
            $('.btn-check').on('click', function() {
                const id = $(this).attr('data-id');
                const isCheck = parseInt($(this).attr('data-check'));
                const toggleCheck = isCheck === 1 ? 0 : 1;

                const checkboxHtml = {
                    0:  '<i class="fa-solid fa-square-check"></i>',
                    1: '<i class="fa-regular fa-square"></i>'
                }

                // todos 상태 toggle 해주는 부분 ( 그냥 ajax로 update 해준다 )
                $.ajax({
                    type: 'POST',
                    url: `todos/${id}`,
                    dataType: 'json',
                    data: { _token: '{{ csrf_token() }}', _method: 'PATCH', is_check: toggleCheck, ajax: true },
                    success: function(response) {
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

            // todos delete 눌렀을때
            $('.delete-todo').on('click', function(e) {
                e.preventDefault();

                const id = $(this).attr('data-id');

                $.ajax({
                    type: 'POST',
                    url: `todos/${id}`,
                    dataType: 'json',
                    data: { _token: '{{ csrf_token() }}', _method: 'DELETE', ajax: true  },
                    success: function(response) {
                        const resData = response.data;

                        if(response.state) {
                            // 삭제 된 todos의 id와 sequence를 applicationManage 변수에서 찾아내서 삭제해야 합니다
                            const idIndex = applicationManage['idx'].indexOf(resData['id'].toString());
                            const seqIndex = applicationManage['sequence'].indexOf(resData['sequence'].toString());

                            applicationManage['idx'].splice(idIndex, 1);
                            applicationManage['sequence'].splice(seqIndex, 1);

                            $(`li.todos-item[data-id="${resData['id']}"]`).fadeOut(300, function() { $(this).remove() });
                        }
                    },
                    error: function (e) {
                    }
                });

            })

            init();
        })

    </script>
@endsection

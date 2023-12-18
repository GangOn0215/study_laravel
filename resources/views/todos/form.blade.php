@extends('todos.layout')

@section('content')
    <section class="flex h-full w-full justify-center">
        <div class="flex justify-center items-center w-full">
            <div class="flex flex-col h-full justify-center w-2/6 todo-container">
                <form action="{{ route($data['form_init']['action'], $data['application']->id) }}" method="post" class="mt-4" enctype="multipart/form-data">
                    @csrf
                    @method($data['form_init']['method'])
                    <div class="flex flex-col w-full">
                        <div class="flex h-60 border border-gray-400 mb-4">
                            <img src="{{asset('storage/todos/' . $data['application']->image_hash_id)}}" alt="" id="image" class="object-cover">
                        </div>
                        <div class="flex date-container mb-4">
                            <input type="text" name="date" class="border border-gray-400 p-2 datepicker w-full" value="{{$data['application']->date ?: date('Y-m-d')}}" readonly>
                        </div>
                        <div class="flex w-full h-10 todo-header mb-4">
                            <input type="text" name="subject" class="w-full border border-gray-400 p-2" value="{{$data['application']->subject}}" placeholder="TODO">
                        </div>
                        <textarea name="content" class="border border-gray-400 mb-4 resize-none p-2" cols="30" rows="10"  placeholder="TODO Description">{{$data['application']->content}}</textarea>
                        <div class="flex mb-4">
                            <input type="file" id="file-info" name="image" style="display: none">
                            <input type="text" id="file-text" class="w-full border border-gray-400 mr-4 p-1.5" readonly="readonly" disabled>
                            <button id="file-button" class="flex-shrink-0 border border-gray-400 p-1.5">첨부파일</button>
                        </div>
                        <div class="flex w-full justify-between">
                            <button id="prev-page" class="w-full border border-gray-400 p-2 mr-2">이전</button>
                            <button type="submit" class="w-full border border-gray-400 p-2">{{$data['form_init']['submit_text']}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
        $('#prev-page').on('click', function(e) {
            e.preventDefault();

            history.back();
        });

        $('#file-button').on('click', function(e) {
            e.preventDefault();

            $('#file-info').click();
        });

        $('#file-info').on('change', function(e) {
            const fileInfo = $(this).prop('files')[0];
            const fileReader = new FileReader();

            fileReader.readAsDataURL(fileInfo);

            $(fileReader).on('load', function() {
                $('#image').attr('src', fileReader.result);
            });

            $('#file-text').val(fileInfo.name);
        });

        </script>

@endsection



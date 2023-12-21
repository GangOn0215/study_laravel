@extends('todos.layout')

@section('content')
    <section class="flex h-full w-full justify-center">
        <div class="flex justify-center items-center w-full">
            <div class="flex flex-col h-full justify-center todo-container py-8">
                <div class="flex flex-col w-full h-full">
                    <div class="flex h-60 border border-gray-400 mb-4 w-full">
                        <img src="{{ $data['application']->image_hash_id ? asset('storage/todos/' . $data['application']->image_hash_id) : ''  }}" alt="" id="image" class="object-cover w-full">
                    </div>
                    <div class="flex date-container mb-4">
                        <div class="border border-gray-400 p-2 w-full">
                            {{$data['application']->date }}
                        </div>
                    </div>
                    <div class="flex w-full h-10 todo-header mb-4">
                        <div class="border border-gray-400 p-2 w-full">
                            {{$data['application']->subject}}
                        </div>
                    </div>
                    <div class="border border-gray-400 p-2 w-full h-60 mb-4">
                        {{$data['application']->content}}
                    </div>

                    <div class="flex w-full justify-between">
                        <button id="prev-page" class="w-full border border-gray-400 p-2">이전</button>
                    </div>
                </div>
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

@extends('boards.layout')
@section('content')
    This Page is Boards
    <a href="/boards/create">Create Boards</a>
    <a href="{{ route('boards.create')  }}">create Boards</a>

    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>제목</th>
                <th>내용</th>
                <th>작성일</th>
                <th>관리</th>
            </tr>
        </thead>
        <tbody>
        @foreach($lists as $row)
            <tr>
                <td>{{$row->id}}</td>
                <td>{{$row->subject}}</td>
                <td>{{$row->content}}</td>
                <td>{{$row->created_at}}</td>
                <td>
                    <a href="{{ route('boards.show', $row->id) }}">보기</a>
                    <a href="{{ route('boards.edit', $row->id)  }}">수정</a>
                    <form action="{{route('boards.destroy', $row->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit">삭제</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

@extends('boards.layout')

@section('content')
    <form action="{{ route('boards.update', $row->id)  }}" method="post">
        @csrf
        @method('PUT')
        <table border="1">
            <tr>
                <th>Subject</th>
                <td>
                    <input type="text" name="subject" value="{{$row->subject}}">
                </td>
            </tr>
            <tr>
                <td>Content</td>
                <td>
                    <textarea name="content" id="" cols="30" rows="10">{{$row->content}}</textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit">Modify</button>
                </td>
            </tr>
        </table>
    </form>
@endsection

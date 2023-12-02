@extends('boards.layout')

@section('content')

This is page Create Board

<form action="{{ route('boards.store')  }}" method="post">
    @csrf
    <table border="1">
        <tr>
            <th>Subject</th>
            <td>
                <input type="text" name="subject">
            </td>
        </tr>
        <tr>
            <td>Content</td>
            <td>
                <textarea name="content" id="" cols="30" rows="10"></textarea>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <button type="submit">Submit</button>
            </td>
        </tr>
    </table>
</form>
@endsection

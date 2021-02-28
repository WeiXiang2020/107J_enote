@extends('layouts/textbook')

@section('site')
@endsection

@section('content')
    <table border="3">
        <tr>
            <td>
                <form method="post">
                    @csrf

                    <input id = message name="message">
                    <button type="submit" >送出</button>
                </form>
            </td>
        </tr>
    </table>

    @foreach($messages as $message)
        @if($message -> student_id == null)
            <div id="layoutSidenav_content" style="position: absolute; color: blue; right: 0;">

                Manifold

            </div>
        @endif

    @endforeach
@endsection

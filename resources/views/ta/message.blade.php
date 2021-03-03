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


    <table border="5" height="500" width="1000">
        @foreach($messages as $message)
            @if(\Illuminate\Support\Facades\Auth::user() -> type == "老師")
                @if($message -> sender == "老師")
                    {{--使用者的信息靠右  --}}
                    <div style="text-align:right">
                        <p>
                            {{$message -> content}}
                        </p>
                    </div>
                @else
                    <div style="text-align:left">
                        <p>
                            {{$message -> content}}
                        </p>
                    </div>
                @endif
            @else
                @if($message -> sender == "學生")
                    {{--使用者的信息靠右  --}}
                    <div style="text-align:right">
                        <p>
                            {{$message -> content}}
                        </p>
                    </div>
                @else
                    <div style="text-align:left">
                        <p>
                            {{$message -> content}}
                        </p>
                    </div>
                @endif
            @endif



        @endforeach
    </table>

@endsection

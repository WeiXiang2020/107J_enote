@extends('layouts/textbook')

@section('site')


@endsection

@section('content')
    @if(\Illuminate\Support\Facades\Auth::user() -> type == "老師")
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h2 class="mt-4"></h2>
                    <div class="card mb-4">
                        <div class="card-header">
                            TA
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">


                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>課堂</th>
                                        <th>TA</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach ($courses as $course)
                                        <tr>
                                            <td >
                                                {{$course -> name}}
                                            </td>

                                            <td >{{--查詢TA--}}
                                                @if ($course -> ta() -> get() -> count() != 0 )
                                                    {{ $course -> ta() -> first() -> student() -> first() -> user() ->first()-> name}}
                                                @else
                                                    null
                                                @endif
                                            </td>

                                            <td width="100" align="center">
                                                {{--                                            若有TA可以變更TA--}}
                                                @if ($course -> ta() -> first() != null )
                                                    <input type="button"
                                                           class="btn btn-outline-dark btn-sm"
                                                           onclick="location.href = '{{$course->id}}/TA/edit'"
                                                           value="更改TA"
                                                    />
                                                    <input type="button"
                                                           class="btn btn-outline-dark btn-sm"
                                                           onclick="location.href = '{{$course -> ta() -> first() ->student_id}}/message/'"
                                                           value="訊息"
                                                    />
                                                @else
                                                    {{-- 若尚未有則設定TA--}}

                                                    <input type="button"
                                                           class="btn btn-outline-dark btn-sm"
                                                           onclick="location.href = '{{$course->id}}/create/'"
                                                           value="設定TA"
                                                    />
                                                @endif


                                            </td>
                                        </tr>

                                    @endforeach

                                    </tbody>
                                </table>


                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    @else
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h2 class="mt-4"></h2>
                    <div class="card mb-4">
                        <div class="card-header">
                            TA
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">


                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>課堂</th>
                                        <th>老師</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach ($courses as $course)
                                        <tr>
                                            <td >
                                                {{$course -> name}}
                                            </td>

                                            <td >{{--查詢老師--}}
                                                {{ $course -> teacher() -> first() -> user() ->first()-> name}}
                                            </td>

                                            <td width="100" align="center">
                                                <input type="button"
                                                       class="btn btn-outline-dark btn-sm"
                                                       onclick="location.href = '{{$course -> teacher() -> first() -> id}}/message/'"
                                                       value="訊息"
                                                />
                                            </td>
                                        </tr>

                                    @endforeach

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    @endif
@endsection

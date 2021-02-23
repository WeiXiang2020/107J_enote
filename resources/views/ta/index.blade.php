@extends('layouts/textbook')

@section('site')


@endsection

@section('content')

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

                                            @if ($course -> ta() -> first() != "" )
                                                have
                                            @else
                                                null
                                            @endif
                                        </td>

                                        <td width="100" align="center">
                                            <input type="button"
                                                   class="btn btn-outline-dark btn-sm"
                                                   onclick="location.href = '{{$course->id}}'"
                                                   value="檢視公告"
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
@endsection

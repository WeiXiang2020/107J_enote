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
                                    <th>姓名</th>
                                    <th>學號</th>
                                    <th>系所</th>
                                    <th>班級</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($students as $student)
                                    <tr>

                                        <td>{{--姓名--}}
                                            {{\App\Models\User::find($student -> user_id) -> name }}
                                        </td>

                                        <td>{{--學號--}}
                                            {{$student -> id}}
                                        </td>
                                        <td >{{--科系名稱--}}
                                            {{$student -> department() -> first() -> name}}
                                        </td>
                                        <td >{{--班級--}}
                                            {{$student -> classroom}}
                                        </td>

                                        <td width="100" align="center">{{--設定檢視與設定button --}}
                                                <input type="button"
                                                       class="btn btn-outline-dark btn-sm"
                                                       onclick="location.href = '{{$student -> id}}/show'"
                                                       value="檢視學生資料"
                                                />
                                                    {{--直接設定的button--}}
                                                <input type="button"
                                                       class="btn btn-outline-dark btn-sm"
                                                       onclick="location.href = 'store'"
                                                       value="設定為TA"
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

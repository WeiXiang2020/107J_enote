@extends('layouts/textbook')

@section('courses')
    @if ($courses -> count() > 0)
        @foreach( $courses as $course)
            <a class="collapse-item" href="/teacher/{{ $course->id }}"
            >
                {{$course -> name}}
            </a>
        @endforeach
    @endif
@endsection

@section('site')

    <b>課程: {{$selected -> name}}</b>
    <input type="button"
           onclick="location.href = '{{$selected -> id}}/notice/create'"
           value="新增公告"
    />

@endsection

@section('notice')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h2 class="mt-4"></h2>
                <div class="card mb-4">
                    <div class="card-header">
                        公告
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>標題</th>
                                        <th>發佈者</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                @foreach ($notices as $notice)
                                    <form  method="POST" role="form" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        {{ method_field('POST') }}

                                        <tr>
                                            <td >
                                                {{$notice -> title}}
                                            </td>
                                            <td>
                                                @if($notice->teacher_id==null)
                                                    {{\App\Models\Student::where('id',$notice->ta_id)-> first()->user()->value('name')}}
                                                @elseif($notice->ta_id==null)
                                                    {{\App\Models\Teacher::where('id',$notice->teacher_id)-> first()->user()->value('name')}}
                                                @endif
                                            </td>
                                            <td width="100" align="center">
                                                <form action="/notices/{{$notice->id}}" method="POST">
                                                    {{ csrf_field() }}
                                                    <a class="btn btn-outline-dark btn-sm" href="/notices/{{$notice->id}}" >檢視公告</a>
                                                </form>
                                            </td>
                                        </tr>
                                    </form>
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

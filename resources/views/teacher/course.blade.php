@extends('layouts/textbook')

@section('site')


@endsection

@section('notice')
    <b>課程: {{$selected -> name}}</b>

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
                                                <input type="button"
                                                       class="btn btn-outline-dark btn-sm"
                                                       onclick="location.href = '{{$notice->id}}'"
                                                       value="檢視公告"
                                                />

                                                <form action="{{$selected -> id}}/{{$notice -> id}}"
                                                      method="post"
                                                >
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger"
                                                            type="submit"
                                                    >
                                                        刪除
                                                    </button>
                                                </form>
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

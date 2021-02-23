@extends('layouts/textbook')

<style>
    label {
        background-color: burlywood;
        color: black;
        font-weight: bold;
        padding: 4px;
        text-transform: uppercase;
        font-family:  "Trebuchet MS","Microsoft JhengHei UI", Helvetica, sans-serif;
    }</style>

@section('notice')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h2 class="mt-4">{{$notice -> name}}
                    <input type="button" value="返回公告列表"
                           onclick="location.href = 'notice'"
                           class="btn btn-outline-dark btn-sm"
                    />
                    @if(\App\Models\User::find(\Illuminate\Support\Facades\Auth::id())-> type== '老師')
                    <input type="button" value="編輯公告"
                           onclick="location.href = '{{$notice -> id }}/edit'"
                           class="btn btn-outline-dark btn-sm"
                    />
                    @endif

                </h2>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        發佈者：
                        @if($notice->teacher_id==null)
                            {{\App\Models\Student::where('id',$notice->ta_id)-> first()->user()->value('name')}}
                        @elseif($notice->ta_id==null)
                            {{\App\Models\Teacher::where('id',$notice->teacher_id)-> first()->user()->value('name')}}
                        @endif
                    </div>
                    <div class="card-body">
                    <div class="form-group width">
                        <h5 class="card-title">
                            <label for="title">標題：</label>
                            {{$notice->title}}</h5>

                    </div><hr class="sidebar-divider">
                    <div class="form-group width">

                            <label for="seller_id">內容：</label>
                            <h5 class="card-title"><br>
                                {{$notice->content}}
                        </h5>
                    </div>
                    </div>

                </div>
{{--                <a class="btn btn-outline-dark btn-sm" style="width:200px;height:30px;" href="{{route('classes.index')}}" >返回公告列表</a>--}}
            </div>
        </main>
    </div>
@endsection

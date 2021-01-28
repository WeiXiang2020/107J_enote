@extends('layouts/hhome')
@section('navv')
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-book"></i>
            <span>課程</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">已選課程:</h6>
                <a class="collapse-item" href="{{route('classes.index')}}">統計學</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
           aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-folder-open"></i>
            <span>筆記專區</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">筆記相關資訊:</h6>
                <a class="collapse-item" href="#">新增筆記</a>
                <a class="collapse-item" href="{{route('mynotes')}}">我的筆記</a>
                <a class="collapse-item" href="#">搜尋筆記</a>
                <a class="collapse-item" href="#">收藏筆記</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Textbook
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseText"
           aria-expanded="true" aria-controls="collapseText">
            <i class="fas fa-fw fa-book"></i>
            <span>教材</span>
        </a>
        <div id="collapseText" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">上課教材:</h6>


{{--                1--}}
                <a class="nav-link collapsed mh5" href="#ch1" data-toggle="collapse" style="color:black;"><span>Ch1</span></a>
                <div id="ch1" class="collapse">
                    <hr class="sidebar-divider bg-dark">
                    <a class="collapse-item" href="#">Ch1</a>
                    <a class="collapse-item" href="#">Ch1-課程筆記</a>
                </div>

{{--                2--}}
                <a class="nav-link collapsed mh5" href="#ch2" data-toggle="collapse" style="color:black;"><span>Ch2</span></a>
                <div id="ch2" class="collapse">
                    <hr class="sidebar-divider bg-dark">
                    <a class="collapse-item" href="#">Ch2</a>
                    <a class="collapse-item" href="#">Ch2-課程筆記</a>
                </div>
            </div>

        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Message
    </div>

    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-comment"></i>
            <span>與Ta聯繫</span></a>
    </li>
@endsection

@section('notice')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        筆記列表
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>標題</th>
                                    <th class="mh1">引用教材</th>
                                    <style type="text/css">
                                        .mh1{
                                            text-align:center;/** 设置水平方向居中 */
                                            vertical-align:middle/** 设置垂直方向居中 */
                                        }
                                    </style>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($notes as $note)
                                <form method="POST" role="form" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <tr>
                                        <td width="280">{{$note->title}}</td>
                                        <td width="500" align="center">
                                            @if($note->textbook==null)
                                               無引用教材
                                            @else
                                                {{$note->textbook->name}}
                                            @endif
                                        </td>
                                        <td width="170" align="center">
                                        <a class="btn btn-primary btn-sm" href="#">檢視筆記</a>
                                        <form action="#" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <input name="delete" type="submit" onclick="javascript: form.action='#';" value="刪除筆記"  class="btn btn-danger btn-sm" >
                                        </form>
                                    </td>
                                    </tr>
                                </form>
{{--                                @endfor--}}
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

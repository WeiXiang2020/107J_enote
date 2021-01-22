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
                <a class="collapse-item" href="/classes/1">統計學</a>
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
                <a class="collapse-item" href="#">我的筆記</a>
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
                <h2 class="mt-4">統計學
                    <a class="btn btn-outline-dark btn-sm" style="margin-left:715px; width:200px; height:30px;"
                       href="{{route('classes.index')}}" >返回公告列表</a>
                </h2>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        發佈者：
                    </div>
                    <div class="card-body">
                    <div class="form-group width">
                        <h5 class="card-title">
                            <label for="title">標題：</label>
                                hi have fun!!!!!!!!!</h5>

                    </div><hr class="sidebar-divider">
                    <div class="form-group width">
                        <h5 class="card-title">
                            <label for="seller_id">內容：</label>
                            contentSFHGSDFHHHHHHHHHHHHHHHHHHHHHHHHHHVDSFBSSGASKGKDNVKSNFVNDS.VJDSNFV.SNDVKJDNV
                        </h5>
                    </div>
                    </div>

                </div>
{{--                <a class="btn btn-outline-dark btn-sm" style="width:200px;height:30px;" href="{{route('classes.index')}}" >返回公告列表</a>--}}
            </div>
        </main>
    </div>
@endsection

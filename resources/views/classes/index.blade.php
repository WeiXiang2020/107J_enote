@extends('layouts/textbook')

@section('notice')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h2 class="mt-4">{{$course->name}}</h2>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        公告
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>標題</th>
                                    <th>發佈者</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
{{--                                @foreach ($carts as $cart)--}}
                                        {{ csrf_field() }}

                                    <tr>
                                    <td >Tiger Nixon</td>
                                    <td width="180">System Architect</td>
                                    <td width="100" align="center">
                                        <form action="/notices/1" method="POST">
                                            {{ csrf_field() }}
                                            <a class="btn btn-outline-dark btn-sm" href="{{route('notices.show')}}" >檢視公告</a>
                                        </form>
                                    </td>
                                    </tr>
{{--                                @endforeach        --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection

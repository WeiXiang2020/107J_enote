@extends('layouts/home')
@section('content')
    <div class="card-header">
    <div class="search-container">
        <form action="{{route('notes.search')}}" class="ml-md-5">
            <input type="text" placeholder="搜尋.." name="searchs"
                   style="width: 800px;height: 40px;margin-left:100px;border-radius:20px;padding-left: 20px">
            <button type="submit" class="btn btn-dark"><i class="fa fa-search fa-1g"></i></button>
        </form>
    </div>
    </div>
@endsection

@section('notice')
    <h4 class="mt-4">搜尋結果</h4>
    <div class="card-body">
        {{$searchs}}
    </div>
@endsection

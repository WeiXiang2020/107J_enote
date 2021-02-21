{{ $courses }}
@extends('layouts/home')
@section('search')
    <div class="search-container">
        <form action="{{route('notes.search')}}" class="ml-md-3">
            <input type="text" placeholder="搜尋.." name="searchs" style="width: 330px;height: 42px;border-radius:20px;padding-left: 20px">
            <button type="submit" class="btn btn-primary" style="border-radius:10px;"><i class="fa fa-search fa-1g"></i></button>
        </form>
    </div>
@endsection

@section('site')
    <input type="button"
           onclick="location.href = 'teacher/notice/1'"
           value="公告"
    />
    <input type="button"
           onclick="location.href = 'teacher/TA/1'"
           value="TA"
    />
@endsection



@section('courses')

    @if ($courses -> count() > 0)
        @foreach($courses as $course)
            <a class="collapse-item" href="/teacher/{{$course->id}}"
            >
                {{$course -> name}}
            </a>
        @endforeach
    @endif

@endsection



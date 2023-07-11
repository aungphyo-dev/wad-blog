@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-end align-items-center">
                <a href="{{route('blog.create')}}" class="btn btn-link">Create New Blog</a>
                <a href="{{route('blog.index')}}" class="btn btn-link">BLog List</a>
            </div>
            <div class="col-12">
                <h3>{{$blog->title}}</h3>
            </div>
            <p>
                {{$blog->description}}
            </p>
        </div>
    </div>
@endsection

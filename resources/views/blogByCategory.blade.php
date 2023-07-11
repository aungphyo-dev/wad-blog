@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-between align-items-center">
                <div class="">
                    Search result by "{{$category->title}} @if(request()->has('keyword')) {{'and '. request()->keyword   }}@endif "
                </div>
                <div>
                </div>
            </div>
            <div class="col-7 mx-auto">
                @forelse ( $blogs as $blog )
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex flex-column justify-content-center align-items-start mb-3">
                                <a href="{{route('blog.detail',$blog->slug)}}" class="text-decoration-none">
                                    <h5 class="card-title">
                                        {{$blog->title}}
                                    </h5>
                                </a>
                                <div class="d-flex flex-row-reverse gap-1 justify-content-between align-items-center">
                            <span class="badge bg-secondary">
                            {{$blog->updated_at->diffforhumans()}}
                        </span>
                                    <span class="badge bg-info">
                                {{$blog->category->title ?? "Unknown"}}
                            </span>
                                    <span class="badge bg-primary">
                                {{$blog->user->name}}
                            </span>
                                </div>
                            </div>
                            <div class="mb-2">
                                {{$blog->excerpt}}
                            </div>
                            <div class="">
                                <a href="{{route('blog.detail',$blog->slug)}}" class="btn btn-outline-success">Read more</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="">
                        there is nothing post!
                    </div>
                @endforelse
                <div class="">
                    {{$blogs->onEachSide(1)->links()}}
                </div>
            </div>
            <div class="col-5">
                @include('layouts.right-side-bar')
            </div>
        </div>
    </div>
@endsection

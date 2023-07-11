@extends('layouts.app')

@section('content')
    <div class="col-8 mx-auto">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex flex-column justify-content-center align-items-start mb-3">
                        <span class="text-decoration-none">
                            <h5 class="card-title">
                                {{$blog->title}}
                            </h5>
                        </span>
                        <div class="d-flex flex-row-reverse gap-1 justify-content-between align-items-center">
                            <span class="badge bg-secondary">
                            {{$blog->created_at->diffforhumans()}}
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
                        {{$blog->description}}
                    </div>
{{--                    <div class="">--}}
{{--                        <a href="{{route('blog.detail',$blog->id)}}" class="btn btn-outline-success">Read more</a>--}}
{{--                    </div>--}}
                </div>
            </div>
    </div>

    @auth
        <div class="col-8 mx-auto">
            <p class="fs-3">Comment & Reply</p>
            <form action="{{route('comment.store')}}" method="post">
                @csrf
                <div class="mb-3">
                    <input type="hidden" name="blog_id" value="{{$blog->id}}">
                    <label for="comment" class="form-label">Comment</label>
                    <textarea style="resize: none" rows="7" type="text" class="form-control" name="comment" id="comment" placeholder="write comment"></textarea>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <p>Commenting as {{\Illuminate\Support\Facades\Auth::user()->name }}</p>
                    <button class="btn btn-sm btn-outline-success">Comment</button>
                </div>
            </form>
        </div>
    @endauth
    <div class="col-8 mx-auto">
        @forelse($blog->comments()->whereNull('parent_id')->latest('id')->get() as $comment)
            <div  class="card mb-3" >
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-primary">{{$comment->user->name}} <i class="bi bi-person"></i></span>
                        <span class="mb-3">{{$comment->updated_at->diffforhumans()}}</span>
                        @can('delete',$comment)
                            <button class="btn btn-sm p-0" form="delete"><i class="bi bi-trash"> </i></button>
                            <form action="{{route('comment.destroy',$comment->id)}}" method="post" id="delete">
                                @csrf
                                @method('DELETE')
                            </form>
                        @endcan
                    </div>
                    <div class="mb-3"><i class="bi bi-chat"></i>  {{$comment->comment}}</div>
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                            @auth
                                <form class="w-100" action="{{route('comment.store',$comment->id)}}" method="post" id="reply">
                                    @csrf
                                    <div class="mb-3 position-relative">
                                        <input type="hidden" name="blog_id" value="{{$blog->id}}">
                                        <input type="hidden" name="parent_id" value="{{$comment->id}}">
                                        <label for="comment" class="form-label">Reply</label>
                                        <textarea style="resize: none" rows="1" type="text" class="form-control" name="comment" id="comment" placeholder="reply comment"></textarea>
                                        <button class="btn py-0 position-absolute" style="top: 38px;right: 0" form="reply">
                                            <i class="bi bi-send"></i>
                                        </button>
                                    </div>
                                </form>
                            @endauth
                    </div>
                </div>
{{--                {{dd($comment->replies)}}--}}
                @forelse($comment->replies as $reply)

                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-primary">{{$comment->user->name}} <i class="bi bi-person"></i></span>
                            <span class="mb-3">{{$comment->updated_at->diffforhumans()}}</span>
                            @can('delete',$comment)
                                <button class="btn btn-sm p-0" form="delete"><i class="bi bi-trash"> </i></button>
                                <form action="{{route('comment.destroy',$comment->id)}}" method="post" id="delete">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @endcan
                        </div>
                        <div class="mb-3"><i class="bi bi-chat"></i>  {{$comment->reply?->comment}}</div>
                    </div>
                @empty
                @endforelse
            </div>
        @empty
            <p>There is no comments</p>
        @endforelse
    </div>

@endsection

@vite(['resources/js/reply.js'])

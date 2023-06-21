@extends('layouts.app')
@section('content')
    <div class="col-6 mx-auto">
        <h4>Edit Article</h4>
        <hr>
        <form action="{{ route('blog.update',$blog->id)}}" method="post">
            @method('PUT')
            @csrf
            <div class="mb-3">
                <label class="form-label" for="blog_title">Article Title</label>
                <input class="form-control @error('blog_title') is-invalid @enderror" value="{{ $blog->title }}" type="text"
                       name="blog_title" id="blog_title">
                @error('blog_title')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label" for="price">Description</label>
                <textarea rows="7" class="form-control @error('blog_description') is-invalid @enderror"
                          name="blog_description" id="price">
                    {{ $blog->description}}
                </textarea>
                @error('blog_description')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <button class="btn btn-outline-primary">Update Article</button>
        </form>
    </div>
@endsection

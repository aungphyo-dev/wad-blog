@extends('layouts.app')
@section('content')
    <div class="col-6 mx-auto">
        <h4>Create New Article</h4>
        <hr>
        <form action="{{route('blog.store')}}" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="blog_name">Article Title</label>
                <input class="form-control @error('blog_name') is-invalid @enderror" value="{{ old('blog_name')}}" type="text"
                       name="blog_name" id="blog_name">
                @error('blog_name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label" for="price">Description</label>
                <textarea rows="7" class="form-control @error('blog_description') is-invalid @enderror"
                          name="blog_description" id="price">
                    {{ old('blog_description')}}
                </textarea>
                @error('blog_description')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <button class="btn btn-outline-primary">Create Article</button>
        </form>
    </div>
@endsection

@extends('layouts.app')
@section('content')
    <div class="col-6 mx-auto">
        <h4>Edit Article</h4>
        <hr>
        <form action="{{ route('category.update',$category->id)}}" method="post">
            @method('PUT')
            @csrf
            <div class="mb-3">
                <label class="form-label" for="category_title">Article Title</label>
                <input class="form-control @error('category_title') is-invalid @enderror" value="{{ $category->title }}" type="text"
                       name="category_title" id="category_title">
                @error('category_title')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <button class="btn btn-outline-primary">Update Category</button>
        </form>
    </div>
@endsection

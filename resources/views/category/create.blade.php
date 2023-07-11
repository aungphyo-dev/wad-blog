@extends('layouts.app')
@section('content')
    <div class="col-6 mx-auto">
        <h4>Create New Category</h4>
        <hr>
        <form action="{{route('category.store')}}" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="category_title">Category Title</label>
                <input class="form-control @error('category_title') is-invalid @enderror" value="{{ old('category_title')}}" type="text"
                       name="category_title" id="category_title">
                @error('category_title')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
{{--            <div class="mb-3">--}}
{{--                <label class="form-label" for="price">Description</label>--}}
{{--                <textarea rows="7" class="form-control @error('category_description') is-invalid @enderror"--}}
{{--                          name="category_description" id="price">{{ old('category_description')}}</textarea>--}}
{{--                @error('category_description')--}}
{{--                <div class="invalid-feedback">--}}
{{--                    {{$message}}--}}
{{--                </div>--}}
{{--                @enderror--}}
{{--            </div>--}}
            <button class="btn btn-outline-primary">Create Category</button>
        </form>
    </div>
@endsection

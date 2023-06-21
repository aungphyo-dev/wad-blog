@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>{{$blog->title}}</h3>
            </div>
            <p>
                {{$blog->description}}
            </p>
        </div>
    </div>
@endsection

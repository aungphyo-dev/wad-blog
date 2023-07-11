@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                Article List
            </div>
            <div class="">
                <form action="" method="GET">
                    <div class="input-group mb-2 position-relative">
                        <label for="input" class=""></label>
                        <input id="input" type="text" class="form-control" name="keyword"
                               value="@if(request()->has('keyword')) {{request()->keyword}} @endif">
                        @if(request()->has('keyword'))
                            <a href="{{route('blog.index')}}" class="position-absolute btn" style="right: 85px ;z-index: 5"> X </a>
                        @endif
                        <button class="btn btn-secondary">Search</button>
                    </div>
                </form>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        @can('admin-only')
                            <th>Blogger</th>
                        @endcan
                        <th>Category</th>
                        <th>Actions</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($blogs as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>
                                {{ $post->title }}
                                <br>
                                <p class="small mb-0">{{ $post->excerpt }}</p>
                            </td>
                            @can('admin-only')
                                <td>{{$post->user->name}}</td>
                            @endcan
{{--                            <td>{{$post->category?->title}}</td>--}}
                            <td>{{$post->category->title ?? "Unknown"}}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('blog.show',$post->id) }}"
                                       class="btn w-100 mb-2">
                                        <i class="bi bi-info"></i>
                                    </a>
                                    @can('update',$post)
                                        <a href="{{ route('blog.edit',$post->id) }}" class="btn  w-100 mb-2">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    @endcan
                                    @can('delete',$post)
                                        <form action="{{ route('blog.destroy',$post->id )}}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                            <td>
                                <p class="small mb-0"><i
                                        class="bi bi-clock"></i> {{ $post->created_at->format('h:i a') }}</p>
                                <p class="small mb-0"><i
                                        class="bi bi-calendar"></i> {{ $post->created_at->format('M d Y') }}</p>
                            </td>
                            <td><p class="small mb-0"><i
                                        class="bi bi-clock"></i> {{ $post->updated_at->format('h:i a') }}</p>
                                <p class="small mb-0"><i
                                        class="bi bi-calendar"></i> {{ $post->updated_at->format('M d Y') }}</p></td>
                        </tr>
                    @empty
                        <td colspan="4">
                            There is no items <br>
                            <a class="btn btn-outline-primary my-2" href="{{ route('blog.create') }}">Create
                                Items</a>
                        </td>
                    @endforelse
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="6">
                            {{$blogs->onEachSide(1)->links()}}
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection

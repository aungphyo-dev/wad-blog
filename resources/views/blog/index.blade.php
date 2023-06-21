@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                Article List
            </div>
            <div class="">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Blogger</th>
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
                                <p class="small mb-0">{{ Str::limit($post->description,30,"...") }}</p>
                            </td>
                            <td>{{$post->user_id}}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('blog.show',$post->id) }}"
                                       class="btn w-100 mb-2">
                                        <i class="bi bi-info"></i>
                                    </a>
                                    <a href="{{ route('blog.edit',$post->id) }}" class="btn  w-100 mb-2">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('blog.destroy',$post->id )}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
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
                        <td colspan="4">
                            {{$blogs->onEachSide(1)->links()}}
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection

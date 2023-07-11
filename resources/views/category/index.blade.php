@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                Category List
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
                    @forelse($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>
                                {{ $category->title }}
                            </td>
                            <td>{{$category->user->name}}</td>
                            <td>
                                <div class="btn-group">
                                    @can('update',$category)
                                        <a href="{{ route('category.edit',$category->id) }}" class="btn  w-100 mb-2">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    @endcan
                                    @can('delete',$category)
                                            <form action="{{ route('category.destroy',$category->id )}}" method="post">
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
                                        class="bi bi-clock"></i> {{ $category->created_at->format('h:i a') }}</p>
                                <p class="small mb-0"><i
                                        class="bi bi-calendar"></i> {{ $category->created_at->format('M d Y') }}</p>
                            </td>
                            <td><p class="small mb-0"><i
                                        class="bi bi-clock"></i> {{ $category->updated_at->format('h:i a') }}</p>
                                <p class="small mb-0"><i
                                        class="bi bi-calendar"></i> {{ $category->updated_at->format('M d Y') }}</p></td>
                        </tr>
                    @empty
                        <td colspan="4">
                            There is no items <br>
                            <a class="btn btn-outline-primary my-2" href="{{ route('category.create') }}">Create
                                Items</a>
                        </td>
                    @endforelse
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="6">
{{--                            {{$categories->onEachSide(1)->links()}}--}}
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                Users List
            </div>
            <div class="">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Article Count</th>
                        <th>Category Count</th>
                        <th>Actions</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>
                                {{ $user->name }}
                                <br>
                                <p class="small mb-0">{{ $user->email}}</p>
                            </td>
                            <td>
                                {{$user->blogs->count()}}
                            </td>
                            <td class="align-middle">
                                    @foreach($user->categories->pluck('title') as $title)
                                        <span class="me-1">{{$title}} |</span>
                                    @endforeach
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('blog.show',$user->id) }}"
                                       class="btn w-100 mb-2">
                                        <i class="bi bi-info"></i>
                                    </a>
                                    <a href="{{ route('blog.edit',$user->id) }}" class="btn  w-100 mb-2">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('blog.destroy',$user->id )}}" method="post">
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
                                        class="bi bi-clock"></i> {{ $user->created_at->format('h:i a') }}</p>
                                <p class="small mb-0"><i
                                        class="bi bi-calendar"></i> {{ $user->created_at->format('M d Y') }}</p>
                            </td>
                            <td><p class="small mb-0"><i
                                        class="bi bi-clock"></i> {{ $user->updated_at->format('h:i a') }}</p>
                                <p class="small mb-0"><i
                                        class="bi bi-calendar"></i> {{ $user->updated_at->format('M d Y') }}</p></td>
                        </tr>
                    @empty
                        <td colspan="4">
                            There is no users <br>
                        </td>
                    @endforelse
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="4">
                            {{$users->onEachSide(1)->links()}}
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection

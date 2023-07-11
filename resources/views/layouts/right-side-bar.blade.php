<div class="position-sticky" style="top: -75px">
    <form action="" method="GET">
        <div class="input-group mb-2 position-relative">
            <input type="text" class="form-control" name="keyword"
                   value="@if(request()->has('keyword')) {{request()->keyword}} @endif">
{{--            @if(request()->has('keyword'))--}}
{{--                <a href="{{route('index')}}" class="position-absolute btn" style="right: 85px ;z-index: 5">--}}
{{--                    X </a>--}}
{{--            @endif--}}
            <button class="btn btn-secondary">Search</button>
        </div>
    </form>
    <div class="">
        <div>Category</div>
        <div class="list-group">
            <a href="{{route('index')}}" class="list-group-item list-group-item-action">All categories</a>
            @forelse(\App\Models\Category::all() as $category)
                <a href="{{route('blogBy.category',$category->slug)}}" class="list-group-item-action list-group-item">{{$category->title}}</a>
            @empty
                <p>There is no category</p>
            @endforelse
        </div>
    </div>
    <div class="">
        <div>Recent blogs</div>
        <div class="list-group">
            @forelse(\App\Models\Blog::latest("id")->limit(5)->get() as $blog)
                <a href="{{route('blog.detail',$blog->slug)}}" class="list-group-item-action list-group-item">{{$blog->title}}</a>
            @empty
                <p>There is no category</p>
            @endforelse
        </div>
    </div>
</div>

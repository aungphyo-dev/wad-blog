<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::when(request()->has('keyword'), function ($query) {
           $query->where(function (Builder $builder){
               $keyword = request()->keyword;
               $builder->where('title', 'like', '%' . $keyword . '%');
               $builder->orWhere('description','like','%'. $keyword.'%');
           });
        })
            ->when(Auth::user()->role === 'user',function ($query){
                $query->where('user_id',Auth::id());
            })
            ->when(request()->name, function ($query) {
                $sort = request()->name;
                $query->orderBy('title', $sort);
            })
//            ->dd()
            ->latest('id')
            ->paginate(10)->withQueryString();
        return view('blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
//        return $request;
        $blog = Blog::create([
            'title' => $request->blog_name,
            'slug' =>Str::slug($request->blog_name),
            'description' => $request->blog_description,
            'excerpt' =>Str::words($request->blog_description,30,'......'),
            'user_id' => Auth::id(),
            'category_id' => $request->blog_category
        ]);
        return redirect()->route('blog.index')->with(['message' => $blog->title . " is created"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view('blog.show',compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        Gate::authorize('delete',$blog);

        return view('blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        Gate::authorize('update',$blog);
//        return $request;
        $blog->title = $request->blog_title;
        $blog->slug = Str::slug($request->blog_name);
        $blog->description = $request->blog_description;
        $blog->excerpt = Str::words($request->blog_description,30,'....');
        $blog->category_id = $request->blog_category;
        $blog->update();
        return redirect()->route('blog.index')->with(['message'=>'blog post is updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        Gate::authorize('blog-delete',$blog);
        $blog->delete();
        return redirect()->back();
    }
}

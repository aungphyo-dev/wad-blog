<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::when(request()->has('keyword'), function ($query) {
            $keyword = request()->keyword;
            $query->where('title', 'like', '%' . $keyword . '%');
        })
            ->when(request()->name, function ($query) {
                $sort = request()->name;
                $query->orderBy('title', $sort);
            })
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
        $blog = Blog::create([
            'title' => $request->blog_name,
            'description' => $request->blog_description,
            'user_id' => Auth::id()
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
        return view('blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        $blog->title = $request->blog_title;
        $blog->description = $request->blog_description;
        $blog->update();
        return redirect()->route('blog.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->back();
    }
}

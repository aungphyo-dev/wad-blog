<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function index()
    {
        $blogs = Blog::when(request()->has('keyword'), function ($query) {
            $keyword = request()->keyword;
            $query->where('title', 'like', '%' . $keyword . '%');
        })
//            ->when(Auth::user()->role === 'user',function ($query){
//                $query->where('user_id',Auth::id());
//            })
                ->when(\request()->has('category'),function ($query){
                    $query->where('category_id',\request()->category);
            })
//            ->dd()
            ->when(request()->name, function ($query) {
                $sort = request()->name;
                $query->orderBy('title', $sort);
            })
            ->latest('id')
            ->paginate(10)->withQueryString();
//        dd($blogs);
        return view('welcome', compact('blogs'));
    }

    public function show($slug)
    {
        $blog = Blog::where("slug",$slug)->firstOrFail();
        return view('detail',compact('blog'));
    }

    public function categoryShow($slug)
    {
        $category = Category::where('slug',$slug)->firstOrFail();
        $blogs = $category->blogs()->
        when(request()->has('keyword'), function ($query) {
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
        return view('blogByCategory',[
            'blogs' => $blogs,
            'category' => $category
        ]);
    }
}

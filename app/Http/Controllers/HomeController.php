<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function users()
    {
        $users = User::when(request()->has('keyword'),function ($query){
            $keyword = request()->keyword;
            $query->where('title','like','%'.$keyword.'%');
        })
            ->when(request()->name,function ($query){
                $sort = request()->name ;
                $query->orderBy('title',$sort);
            })
            ->paginate(10)->withQueryString();
        return view('users',compact('users'));
    }
}

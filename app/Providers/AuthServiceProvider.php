<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use App\Policies\BlogPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\CommentPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use function Symfony\Component\Translation\t;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Category::class => CategoryPolicy::class,
        Blog::class => BlogPolicy::class,
        Comment::class=>CommentPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
//        Gate::define("blog-update",function (User $user , Blog $blog){
//            return $user->id === $blog->user_id;
//        });
//        Gate::define("blog-delete",function (User $user , Blog $blog){
//            return $user->id === $blog->user_id;
//        });
//        Gate::before(function (User $user){
//            if ($user->id ===1 || $user->id === 5){
//                return true;
//            };
//        });
        Gate::define('admin-only',function (User $user){
            return $user->role === 'admin';
        });
    }
}

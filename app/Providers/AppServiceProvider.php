<?php

namespace App\Providers;

use App\Domain\Comments\Models\Comment;
use App\Domain\Posts\Models\Post;
use App\Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Model::unguard();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap(
            [
                'comments' => Comment::class,
                'posts' => Post::class,
                'users' => User::class,
            ]
        );
    }
}

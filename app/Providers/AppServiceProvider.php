<?php

namespace App\Providers;

use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;


class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void

    {
        // Gate::define('update-comment', function (User $user,Review  $review) {
        //     return $user->id === $review->user_id;
        // });
        Paginator::useBootstrapFive();

    }
}

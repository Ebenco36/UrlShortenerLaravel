<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\ShortCodeRepositoryInterface;
use App\Repositories\ShortCodeRepository;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(ShortCodeRepositoryInterface::class, ShortCodeRepository::class);
    }
}

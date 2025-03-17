<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interface\BaseRepositoryInterface;
use App\Repositories\TagRepository;
use App\interface\AuthRepositoryInterface;
use App\Repositories\AuthRepository;


/**
 
* @OA\Info(
* title="E-Learning",
* version="1.0.0"
* )
*/

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BaseRepositoryInterface::class, TagRepository::class);
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

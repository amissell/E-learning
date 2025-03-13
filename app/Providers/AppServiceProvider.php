<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interface\BaseRepositoryInterface;
use App\Repositories\TagRepository;


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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

<?php

namespace App\Providers;

use Laravel\Sanctum\Sanctum;
use App\Repositories\TagRepository;
use App\Repositories\AuthRepository;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\PersonalAccessToken;
use App\interface\AuthRepositoryInterface;
use App\Interface\BaseRepositoryInterface;


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
        $this->app->bind(
          \App\Interface\BaseRepositoryInterface::class,
          \App\Repositories\CourseRepository::class
      );

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
      Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);

    }
}

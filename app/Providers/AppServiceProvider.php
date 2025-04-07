<?php

namespace App\Providers;

use App\Interface\ApiResponseInterface;
use App\Responses\ApiResponse;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ApiResponseInterface::class, ApiResponse::class);
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        URL::forceScheme('https');

        DB::listen(function ($query){
            logger(Str::replaceArray('?', $query->bindings, $query->sql));
        });
    }
}

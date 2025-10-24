<?php

namespace App\Providers;

use App\Models\Question;
use App\Policies\QuestionPolicy;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    protected $policies = [
        Question::class => QuestionPolicy::class,
    ];

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (app()->environment('production')) {
        if ($root = config('app.url')) {
            URL::forceRootUrl($root);   // usa tu dominio como raíz
        }
        URL::forceScheme('https');       // y fuerza el esquema https
    }
    }

    public const HOME = 'home';
}

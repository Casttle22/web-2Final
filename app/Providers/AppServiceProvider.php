<?php

namespace App\Providers;

use App\Models\Question;
use App\Policies\QuestionPolicy;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Gate;

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
    public function boot(): void{
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        // Vite: Render deja el manifest en public/build/.vite/manifest.json
        config([
            'vite.manifest'   => 'build/.vite/manifest.json',
            'vite.build_path' => 'build',
        ]);

        Gate::policy(Question::class, QuestionPolicy::class);
    }
}

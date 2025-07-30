<?php

namespace App\Providers;

use App\Services\SEOService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(SEOService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Set up morph map for polymorphic relationships
        Relation::enforceMorphMap([
            'news' => \App\Models\News::class,
            'documents' => \App\Models\Document::class,
            'document' => \App\Models\Document::class,
            'school' => \App\Models\School::class,
            'center' => \App\Models\Center::class,
            'teacher' => \App\Models\Teacher::class,
        ]);
    }
}

<?php

namespace App\Providers;

use App\Models\Contact;
use App\Models\Educational;
use App\Models\Experience;
use App\Models\Language;
use App\Models\Link;
use App\Models\Project;
use App\Models\ProjectWork;
use App\Models\Skill;
use App\Models\User;
use App\Models\Website;
use App\Observers\ActivityObserver;
use Illuminate\Support\ServiceProvider;

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
        Project::observe(ActivityObserver::class);
        Link::observe(ActivityObserver::class);
        Website::observe(ActivityObserver::class);
        Contact::observe(ActivityObserver::class);
        Educational::observe(ActivityObserver::class);
        Experience::observe(ActivityObserver::class);
        Language::observe(ActivityObserver::class);
        Link::observe(ActivityObserver::class);
        ProjectWork::observe(ActivityObserver::class);
        Skill::observe(ActivityObserver::class);
        User::observe(ActivityObserver::class);
    }
}

<?php

use App\Enums\LandingItemType;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\Landing\FaqController as LandingFaqController;
use App\Http\Controllers\Admin\Landing\ItemController as LandingItemController;
use App\Http\Controllers\Admin\Landing\PlanController as LandingPlanController;
use App\Http\Controllers\Admin\Landing\SettingController as LandingSettingController;
use App\Http\Controllers\Admin\Landing\TestimonialController as LandingTestimonialController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\AwardController;
use App\Http\Controllers\Client\CertificationController;
use App\Http\Controllers\Client\CourseController;
use App\Http\Controllers\Client\CvReferenceController;
use App\Http\Controllers\Client\EducationalController;
use App\Http\Controllers\Client\ExperienceController;
use App\Http\Controllers\Client\HomeController as ClientHomeController;
use App\Http\Controllers\Client\LanguageController;
use App\Http\Controllers\Client\LinkController;
use App\Http\Controllers\Client\ProjectController;
use App\Http\Controllers\Client\ProjectGroupController;
use App\Http\Controllers\Client\SkillController;
use App\Http\Controllers\Client\TenantController;
use App\Http\Controllers\Client\VolunteeringController;
use App\Http\Controllers\Client\WebsiteController;
use App\Http\Controllers\ContentLocaleController;
use App\Http\Controllers\DriveOAuthController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Resume\ContactController;
use App\Http\Controllers\Resume\HomeController;
use App\Http\Controllers\Resume\ResumeController;
use App\Http\Middleware\AttachTenantHeader;
use App\Http\Middleware\InitializeTenancyMiddleware;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

Route::get('/locale/{locale}', LocaleController::class)->name('locale.switch');
Route::get('/content-locale/{locale}', ContentLocaleController::class)->name('content-locale.switch');

Route::get('/drive/oauth/redirect', [DriveOAuthController::class, 'redirect'])->name('drive.oauth.redirect');
Route::get('/drive/oauth/callback', [DriveOAuthController::class, 'callback'])->name('drive.oauth.callback');

Route::get('/', [LandingController::class, 'index'])->name('landing');

Route::middleware(['auth:sanctum', AttachTenantHeader::class])->group(function () {
    Route::middleware('admin')->prefix('admin')->as('admins.')->group(function () {
        Route::get('/dashboard', [AdminHomeController::class, 'index'])->name('index');

        Route::prefix('profile')->as('profile.')->group(function () {
            Route::get('/', [ProfileController::class, 'showAdminProfile'])->name('show');
            Route::get('/edit', [ProfileController::class, 'showAdminProfile'])->name('edit');
            Route::post('/update', [ProfileController::class, 'updateAdminProfile'])->name('update');
        });

        Route::resource('users', UserController::class)->except(['show']);

        Route::prefix('landing')->as('landing.')->group(function () {
            Route::get('settings', [LandingSettingController::class, 'edit'])->name('settings.edit');
            Route::put('settings', [LandingSettingController::class, 'update'])->name('settings.update');

            Route::resource('faqs', LandingFaqController::class)->except(['show']);
            Route::resource('testimonials', LandingTestimonialController::class)->except(['show']);
            Route::resource('plans', LandingPlanController::class)->except(['show']);

            Route::prefix('items/{type}')
                ->as('items.')
                ->whereIn('type', LandingItemType::values())
                ->group(function () {
                    Route::get('/', [LandingItemController::class, 'index'])->name('index');
                    Route::get('/create', [LandingItemController::class, 'create'])->name('create');
                    Route::post('/', [LandingItemController::class, 'store'])->name('store');
                    Route::get('/{item}/edit', [LandingItemController::class, 'edit'])->name('edit');
                    Route::put('/{item}', [LandingItemController::class, 'update'])->name('update');
                    Route::delete('/{item}', [LandingItemController::class, 'destroy'])->name('destroy');
                });
        });
    });

    Route::middleware('client', InitializeTenancyMiddleware::class)->prefix('client')->as('clients.')->group(function () {
        Route::get('/dashboard', [ClientHomeController::class, 'index'])->name('index');

        Route::prefix('profile')->as('profile.')->group(function () {
            Route::get('/', [ProfileController::class, 'showClientProfile'])->name('show');
            Route::get('/edit', [ProfileController::class, 'showClientProfile'])->name('edit');
            Route::post('/update', [ProfileController::class, 'updateClientProfile'])->name('update');
        });

        Route::resource('educationals', EducationalController::class)->except(['show']);

        Route::resource('experiences', ExperienceController::class)->except(['show']);

        Route::resource('languages', LanguageController::class)->except(['show']);

        Route::resource('skills', SkillController::class)->except(['show']);

        Route::resource('project-groups', ProjectGroupController::class)->except(['show']);

        Route::resource('projects', ProjectController::class)->except(['show']);

        Route::resource('links', LinkController::class)->except(['show']);

        Route::prefix('settings')->as('settings.')->group(function () {
            Route::get('/', [TenantController::class, 'show'])->name('show');
            Route::post('/update', [TenantController::class, 'update'])->name('update');
        });

        Route::resource('websites', WebsiteController::class)->except(['show']);
        Route::resource('certifications', CertificationController::class)->except(['show']);
        Route::resource('courses', CourseController::class)->except(['show']);
        Route::resource('awards', AwardController::class)->except(['show']);
        Route::resource('volunteerings', VolunteeringController::class)->except(['show']);
        Route::resource('references', CvReferenceController::class)->except(['show']);
    });
});

Route::middleware([AttachTenantHeader::class, InitializeTenancyMiddleware::class])->group(function () {
    Route::as('portfolio.')->group(function () {
        Route::get('{domain}/', [HomeController::class, 'index'])->name('home');
        Route::get('{domain}/resume', [ResumeController::class, 'index'])->name('resume');
        Route::get('{domain}/projects', [ProjectController::class, 'projects'])->name('projects');
        Route::get('{domain}/contact', [ContactController::class, 'contact'])->name('contact');
        Route::post('{domain}/store', [ContactController::class, 'store'])->name('contacts.store');
        Route::get('{domain}/download-pdf', [ResumeController::class, 'download'])->name('download');
        Route::get('{domain}/cv.pdf', [ResumeController::class, 'viewPdf'])->name('view-pdf');
        Route::post('{domain}/share-drive', [ResumeController::class, 'shareToDrive'])
            ->middleware('throttle:5,1')
            ->name('share-drive');
    });
});



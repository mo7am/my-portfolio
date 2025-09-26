<?php

use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Client\EducationalController;
use App\Http\Controllers\Client\ExperienceController;
use App\Http\Controllers\Client\HomeController as ClientHomeController;
use App\Http\Controllers\Client\LanguageController;
use App\Http\Controllers\Client\LinkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Client\ProjectGroupController;
use App\Http\Controllers\Client\SkillController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Resume\ResumeController;
use App\Http\Controllers\Client\ProjectController;
use App\Http\Controllers\Client\TenantController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\WebsiteController;
use App\Http\Controllers\Resume\ContactController;
use App\Http\Controllers\Resume\HomeController;
use App\Http\Middleware\AttachTenantHeader;
use App\Http\Middleware\InitializeTenancyMiddleware;

require __DIR__.'/auth.php';

Route::get('/', function () {
    if (auth('sanctum')->check()) {
        if (auth('sanctum')->user()->type === \App\Enums\UserType::ADMIN->value) {
            return redirect()->route('admins.index');
        } else if (auth('sanctum')->user()->type === \App\Enums\UserType::CLIENT->value) {
            return redirect()->route('clients.index');
        }
    }
    return redirect()->route('login');
});

Route::middleware(['auth:sanctum', AttachTenantHeader::class])->group(function () {
    Route::middleware('admin')->prefix('admin')->as('admins.')->group(function () {
        Route::get('/dashboard', [AdminHomeController::class, 'index'])->name('index');

        Route::prefix('profile')->as('profile.')->group(function () {
            Route::get('/', [ProfileController::class, 'showAdminProfile'])->name('show');
            Route::get('/edit', [ProfileController::class, 'showAdminProfile'])->name('edit');
            Route::post('/update', [ProfileController::class, 'updateAdminProfile'])->name('update');
        });

        Route::resource('users', UserController::class)->except(['show']);

        
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
    });
});

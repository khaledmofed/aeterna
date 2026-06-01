<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\ArchitectureController;
use App\Http\Controllers\Admin\SolutionsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FooterLinksController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\InvestorsController;
use App\Http\Controllers\Admin\NavigationController;
use App\Http\Controllers\Admin\RoadmapController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SubscribersController;
use App\Http\Controllers\Admin\TokenomicsController;
use App\Http\Controllers\Admin\UseCasesController;
use Illuminate\Support\Facades\Route;

// Dashboard redirect (for Breeze compatibility)
Route::get('/dashboard', fn() => redirect()->route('admin.dashboard'))->middleware(['auth'])->name('dashboard');

// Public
Route::get('/',           [HomeController::class, 'index'])->name('home');
Route::post('/subscribe', [HomeController::class, 'subscribe'])->name('subscribe');
Route::get('/whitepaper', fn() => redirect('https://aeternaio.com/whitepaper'))->name('whitepaper');

// Admin
Route::prefix('admin')->name('admin.')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/',           fn() => redirect()->route('admin.dashboard'));
    Route::get('/dashboard',  [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/hero',  [HeroController::class, 'edit'])->name('hero');
    Route::post('/hero', [HeroController::class, 'update'])->name('hero.update');

    Route::get('/navigation',              [NavigationController::class, 'index'])->name('navigation.index');
    Route::get('/navigation/create',       [NavigationController::class, 'create'])->name('navigation.create');
    Route::post('/navigation',             [NavigationController::class, 'store'])->name('navigation.store');
    Route::get('/navigation/{navigation}/edit', [NavigationController::class, 'edit'])->name('navigation.edit');
    Route::put('/navigation/{navigation}', [NavigationController::class, 'update'])->name('navigation.update');
    Route::delete('/navigation/{navigation}', [NavigationController::class, 'destroy'])->name('navigation.destroy');
    Route::post('/navigation/reorder',     [NavigationController::class, 'reorder'])->name('navigation.reorder');

    Route::get('/solutions',                 [SolutionsController::class, 'index'])->name('solutions.index');
    Route::get('/solutions/create',          [SolutionsController::class, 'create'])->name('solutions.create');
    Route::post('/solutions',                [SolutionsController::class, 'store'])->name('solutions.store');
    Route::get('/solutions/{solution}/edit', [SolutionsController::class, 'edit'])->name('solutions.edit');
    Route::put('/solutions/{solution}',      [SolutionsController::class, 'update'])->name('solutions.update');
    Route::delete('/solutions/{solution}',   [SolutionsController::class, 'destroy'])->name('solutions.destroy');
    Route::post('/solutions/reorder',        [SolutionsController::class, 'reorder'])->name('solutions.reorder');

    Route::get('/architecture',                    [ArchitectureController::class, 'index'])->name('architecture.index');
    Route::get('/architecture/{architecture}/edit',[ArchitectureController::class, 'edit'])->name('architecture.edit');
    Route::put('/architecture/{architecture}',     [ArchitectureController::class, 'update'])->name('architecture.update');

    Route::get('/tokenomics',  [TokenomicsController::class, 'edit'])->name('tokenomics');
    Route::post('/tokenomics', [TokenomicsController::class, 'update'])->name('tokenomics.update');

    Route::get('/investors',             [InvestorsController::class, 'index'])->name('investors.index');
    Route::get('/investors/create',      [InvestorsController::class, 'create'])->name('investors.create');
    Route::post('/investors',            [InvestorsController::class, 'store'])->name('investors.store');
    Route::get('/investors/{investor}/edit', [InvestorsController::class, 'edit'])->name('investors.edit');
    Route::put('/investors/{investor}',  [InvestorsController::class, 'update'])->name('investors.update');
    Route::delete('/investors/{investor}', [InvestorsController::class, 'destroy'])->name('investors.destroy');

    Route::get('/roadmap',           [RoadmapController::class, 'index'])->name('roadmap.index');
    Route::get('/roadmap/create',    [RoadmapController::class, 'create'])->name('roadmap.create');
    Route::post('/roadmap',          [RoadmapController::class, 'store'])->name('roadmap.store');
    Route::get('/roadmap/{roadmap}/edit', [RoadmapController::class, 'edit'])->name('roadmap.edit');
    Route::put('/roadmap/{roadmap}', [RoadmapController::class, 'update'])->name('roadmap.update');
    Route::delete('/roadmap/{roadmap}', [RoadmapController::class, 'destroy'])->name('roadmap.destroy');

    Route::get('/use-cases',              [UseCasesController::class, 'index'])->name('use-cases.index');
    Route::get('/use-cases/create',       [UseCasesController::class, 'create'])->name('use-cases.create');
    Route::post('/use-cases',             [UseCasesController::class, 'store'])->name('use-cases.store');
    Route::get('/use-cases/{useCase}/edit', [UseCasesController::class, 'edit'])->name('use-cases.edit');
    Route::put('/use-cases/{useCase}',    [UseCasesController::class, 'update'])->name('use-cases.update');
    Route::delete('/use-cases/{useCase}', [UseCasesController::class, 'destroy'])->name('use-cases.destroy');

    Route::get('/footer-links',                 [FooterLinksController::class, 'index'])->name('footer-links.index');
    Route::get('/footer-links/create',          [FooterLinksController::class, 'create'])->name('footer-links.create');
    Route::post('/footer-links',                [FooterLinksController::class, 'store'])->name('footer-links.store');
    Route::get('/footer-links/{footerLink}/edit', [FooterLinksController::class, 'edit'])->name('footer-links.edit');
    Route::put('/footer-links/{footerLink}',    [FooterLinksController::class, 'update'])->name('footer-links.update');
    Route::delete('/footer-links/{footerLink}', [FooterLinksController::class, 'destroy'])->name('footer-links.destroy');

    Route::get('/subscribers',              [SubscribersController::class, 'index'])->name('subscribers.index');
    Route::get('/subscribers/export',       [SubscribersController::class, 'export'])->name('subscribers.export');
    Route::delete('/subscribers/{subscriber}', [SubscribersController::class, 'destroy'])->name('subscribers.destroy');

    Route::get('/settings',  [SettingsController::class, 'index'])->name('settings');
    Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');
});

require __DIR__.'/auth.php';

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TimelineController;
use App\Http\Controllers\Admin\ContactLocationController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\AppointmentSettingController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\ContactPageSeoController;
use App\Http\Controllers\Admin\HomePageSeoController;
use App\Http\Controllers\Admin\SectionHeadingController;
use App\Http\Controllers\ImageUploadController;

// Front-end routes
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about-us', [PageController::class, 'about'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Home Page SEO
Route::get('home-page-seo', [HomePageSeoController::class, 'edit'])->name('home-page-seo.edit');
Route::put('home-page-seo', [HomePageSeoController::class, 'update'])->name('home-page-seo.update');

// Contact Page SEO
Route::get('contact-page-seo', [ContactPageSeoController::class, 'edit'])->name('contact-page-seo.edit');
Route::put('contact-page-seo', [ContactPageSeoController::class, 'update'])->name('contact-page-seo.update');

Route::post('/image-upload-direct', [App\Http\Controllers\ImageUploadController::class, 'uploadDirect'])->name('image.upload.direct');

// Blog routes
Route::prefix('blog')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/{slug}', [BlogController::class, 'show'])->name('blog.show');
    Route::get('/category/{slug}', [BlogController::class, 'category'])->name('blog.category');
});

// Admin routes
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    
    // Slider management
    Route::resource('sliders', SliderController::class);
    
    // Feature management
    Route::resource('features', FeatureController::class);
    
    // About management
    Route::get('about', [AboutController::class, 'edit'])->name('about.edit');
    Route::put('about', [AboutController::class, 'update'])->name('about.update');
    
    // Service management
    Route::resource('services', ServiceController::class);
    
    // Blog management
    Route::resource('posts', PostController::class);
    Route::resource('categories', CategoryController::class);
    
    // Timeline management
    Route::resource('timeline', TimelineController::class);
    
    // Contact management
    Route::resource('contact-locations', ContactLocationController::class);
    Route::get('contacts', [ContactController::class, 'adminIndex'])->name('admin.contacts');
    
    // Settings management
    Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('settings', [SettingController::class, 'update'])->name('settings.update');

    // Team management
    Route::resource('team', TeamController::class)->parameters([
        'team' => 'team'
    ])->except(['show']);
    Route::resource('portfolio', PortfolioController::class)->except(['show']);

    // Appointment settings
    Route::get('appointment', [AppointmentSettingController::class, 'edit'])->name('appointment.edit');
    Route::put('appointment', [AppointmentSettingController::class, 'update'])->name('appointment.update');

    // Contact management
    Route::get('admin/contacts', [ContactController::class, 'adminIndex'])->name('admin.contacts');
    Route::get('admin/contacts/{id}', [ContactController::class, 'show'])->name('admin.contacts.show');
    Route::put('admin/contacts/{id}/mark-as-read', [ContactController::class, 'markAsRead'])->name('admin.contacts.mark-as-read');
    Route::delete('admin/contacts/{id}', [ContactController::class, 'destroy'])->name('admin.contacts.destroy');

    Route::get('aboutus', [AboutUsController::class, 'edit'])->name('aboutus.edit');
    Route::put('aboutus', [AboutUsController::class, 'update'])->name('aboutus.update');

    // Home Page SEO
    Route::get('home-page-seo', [HomePageSeoController::class, 'edit'])->name('home-page-seo.edit');
    Route::put('home-page-seo', [HomePageSeoController::class, 'update'])->name('home-page-seo.update');

    // Contact Page SEO
    Route::get('contact-page-seo', [ContactPageSeoController::class, 'edit'])->name('contact-page-seo.edit');
    Route::put('contact-page-seo', [ContactPageSeoController::class, 'update'])->name('contact-page-seo.update');

    // Section Headings
    Route::get('section-headings', [SectionHeadingController::class, 'edit'])->name('section-headings.edit');
    Route::put('section-headings', [SectionHeadingController::class, 'update'])->name('section-headings.update');
});


Route::post('/newsletter-subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// Auth routes
require __DIR__.'/auth.php';
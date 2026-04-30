<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Front\CartController;

Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/blog', [FrontController::class, 'blog'])->name('blog');
Route::get('/about', [FrontController::class, 'about'])->name('about');
Route::get('/services', [FrontController::class, 'services'])->name('services');
Route::get('/shop', [FrontController::class, 'shop'])->name('shop');
Route::get('/contact', [FrontController::class, 'contact'])->name('contact');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

use App\Http\Controllers\Back\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('back/posts', \App\Http\Controllers\Back\PostController::class)->names('back.posts');
    Route::resource('back/testimonials', \App\Http\Controllers\Back\TestimonialController::class)->names('back.testimonials');
    Route::resource('back/products', \App\Http\Controllers\Back\ProductController::class)->names('back.products');
});

require __DIR__.'/auth.php';

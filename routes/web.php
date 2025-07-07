<?php

use App\Http\Controllers\Admin\SubscriptionController as AdminSubscriptionController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UpgradeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\FavoriteController;
use App\Http\Middleware\EnsurePremium;
use App\Http\Controllers\Admin\ShopController as AdminShopController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\StripeWebhookController;






/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('index');
});

Route::get('/home', function () {
    return view('top');
})->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/mypage', [UserController::class, 'mypage'])->name('users.mypage');
    Route::get('/users/show', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/favorites/{shop}', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('/favorites/{shop}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
});

Route::middleware(['auth', EnsurePremium::class])->group(function () {
    Route::get('/reservations/create/{shop}', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservations/confirm', [ReservationController::class, 'confirm'])->name('reservations.confirm');
    Route::post('/reservations/store', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/reservations/complete', [ReservationController::class, 'complete'])->name('reservations.complete');
    Route::get('/reviews/create/{shop}', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/reviews/confirm', [ReviewController::class, 'confirm'])->name('reviews.confirm');
    Route::post('/reviews/store', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
    Route::post('/reviews/update/confirm', [ReviewController::class, 'updateConfirm'])->name('reviews.update.confirm');
    Route::post('/reviews/update', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
});


Route::get('/', [ShopController::class, 'top'])->name('top'); // トップページ（検索フォーム）
Route::get('/shops', [ShopController::class, 'search'])->name('shops.search');
Route::get('/shops/{shop}', [ShopController::class, 'show'])->name('shops.show');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
 // 有料会員へアップグレードの案内ページ（未会員・無料・有料すべてアクセスOK）
Route::get('/users/upgrade', [UpgradeController::class, 'index'])->name('users.upgrade');

Route::middleware(['auth', 'verified', 'not.subscribed','not.admin'])->group(function () {
    Route::get('subscription/create', [SubscriptionController::class, 'create'])->name('subscription.create');
    Route::post('subscription', [SubscriptionController::class, 'store'])->name('subscription.store');


});

Route::middleware(['auth', 'verified', 'subscribed'])->group(function () {
    Route::get('subscription/edit', [SubscriptionController::class, 'edit'])->name('subscription.edit');
    Route::match(['put', 'patch'], 'subscription', [SubscriptionController::class, 'update'])->name('subscription.update');
    Route::get('subscription/cancel', [SubscriptionController::class, 'cancel'])->name('subscription.cancel');
    Route::delete('subscription', [SubscriptionController::class, 'destroy'])->name('subscription.destroy');
});


// 管理者ページ
Route::prefix('admin')->name('admin.')->group(function () {
    Route::redirect('/', 'admin/login')->name('login');
    Route::post('/shops/confirm', [AdminShopController::class, 'confirm'])->name('shops.confirm');
    Route::post('/shops/{shop}/editconfirm', [AdminShopController::class, 'editConfirm'])->name('shops.editconfirm');
    Route::resource('shops', AdminShopController::class);
    Route::get('/subscriptions', [AdminSubscriptionController::class, 'index'])->name('subscriptions.index');
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::resource('categories', CategoryController::class)->except(['show']);

    // 管理者ホーム（ミドルウェアで保護）
    Route::get('home', [Admin\HomeController::class, 'index'])
        ->middleware('auth:admin')
        ->name('home');
});

    Route::post('/nagoyameshi/public/stripe/webhook', [StripeWebhookController::class, 'handleWebhook']);

require __DIR__.'/auth.php';

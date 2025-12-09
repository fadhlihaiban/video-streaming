<?php

use Illuminate\Support\Facades\Route;

//controller admin
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RequestController as AdminRequestController;

//contoller customer
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RequestController;

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminMiddleware;

use App\Http\Controllers\WatchController;

Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

require __DIR__.'/auth.php';

//Route::middleware(['auth','admin'])->prefix('admin')->group(function () {
//Route::middleware(['auth','admin'])->prefix('admin')->group(function () {
Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->group(function () {
    



    //crud video
    Route::resource('videos', VideoController::class)->names('admin.videos');

    //crud customer
    //Route::resource('users', UserController::class)->except(['create', 'store'])->names('admin.users');
    Route::resource('users', UserController::class)->names('admin.users');

    //manajemen permintaan nonton
    Route::get('requests', [AdminRequestController::class, 'index'])->name('admin.requests.index');
    

    Route::post('requests/{request}/approve', [AdminRequestController::class, 'approve'])->name('admin.requests.approve');
    

    Route::post('requests/{request}/reject', [AdminRequestController::class, 'reject'])->name('admin.requests.reject');

});

Route::middleware(['auth'])->group(function() {
    //dashboard
    Route::get('/dashboard', function () {
        if (auth()->user()->level === 'admin') {
            return redirect()->route('admin.requests.index');
        }
        return redirect()->route('customer.videos.index');
    })->name('dashboard');

    //route profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //video yang bisa diminta customer
    Route::get('videos', [CustomerController::class, 'index'])->name('customer.videos.index');

    //proses pengajuan request baru
    Route::post('/request-video/{video}', [RequestController::class, 'store'])->name('customer.request.store');
    

    //status permintaan customer sendiri
    Route::get('my-requests', [RequestController::class, 'index'])->name('customer.requests.index');

    Route::get('watch/{video}', [WatchController::class, 'show'])
     ->middleware('check.access')
     ->name('customer.watch');
});
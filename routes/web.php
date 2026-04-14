<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware(['auth', 'no-cache'])->group(function () {

    Route::get('/', [PostController::class, 'index'])->name('home');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'editProfile'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/avatar/delete', [ProfileController::class, 'deleteAvatar'])->name('avatar.delete');

    Route::get('/profile/password', [ProfileController::class, 'showPasswordForm'])->name('password.edit');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');

    Route::get('/my-posts', [PostController::class, 'manage'])->name('posts.manage');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts-store', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    Route::get('/my-trash', [PostController::class, 'myTrash'])->name('posts.trash');
    Route::post('/posts/{id}/restore', [PostController::class, 'restore'])->name('posts.restore');
    Route::delete('/posts/{id}/force-delete', [PostController::class, 'forceDelete'])->name('posts.force_delete');

    Route::get('/user/{user}/profile', [ProfileController::class, 'showProfile'])->name('user.profile');
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
        Route::get('/admin/trash', [PostController::class, 'adminTrash'])->name('admin.trash');

        Route::get('/admin/users', [AdminController::class, 'adminUsers'])->name('admin.users');
        Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
        Route::put('/admin/users/{user}/update', [AdminController::class, 'updateUser'])->name('admin.users.update');
        Route::post('/admin/users/{user}/block', [AdminController::class, 'toggleBlock'])->name('admin.users.block');
        Route::post('/admin/users/{user}/role', [AdminController::class, 'changeRole'])->name('admin.users.role');
        Route::post('/admin/users/{user}/avatar/delete', [AdminController::class, 'adminDeleteAvatar'])->name('admin.users.delete_avatar');
    });

    Route::middleware(['role:super_admin'])->group(function () {
        Route::get('/super-admin/settings', [AdminController::class, 'superSettings'])->name('super.settings');
    });

});

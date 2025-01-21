<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\ReferenceLetterController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group.
|
*/

Route::get('/accept-invitation/{token}', [ReferenceLetterController::class, 'show'])->name('reference.show');
Route::post('/accept-invitation/{token}', [ReferenceLetterController::class, 'store'])->name('reference.store');
Route::get('/reference-success', [ReferenceLetterController::class, 'success'])->name('reference.success');

Route::middleware('guest')->group(function () {
    Route::view('/login', 'login')->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');

    Route::get('/admin-login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/admin-login', [AdminController::class, 'login'])->name('admin.login.submit');

    Route::view('/register', 'register')->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
    
});

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('home'); // Ensure home.blade.php exists
    })->name('home');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/invitation', [InvitationController::class, 'show'])->name('invitation.show');
    Route::post('/invitation', [InvitationController::class, 'send'])->name('invitation.send');
    Route::get('/pending-invitations', [InvitationController::class, 'showPendingInvitations'])->name('invitation-list.showPendingInvitations');


    Route::get('/reference-letters/{studentId}', [ReferenceLetterController::class, 'index'])
        ->name('reference_letters.index');
    Route::get('/reference-letter/{id}', [ReferenceLetterController::class, 'showReferenceLetter'])
        ->name('reference_letters.show');
});

Route::middleware(['admin'])->group(function () {
    Route::get('/admin-dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    Route::post('/admin/users/{id}/promote', [AdminController::class, 'promoteUser'])->name('admin.users.promote');

    Route::delete('/admin/invitations/{id}', [AdminController::class, 'deleteInvitation'])->name('admin.invitations.delete');

    Route::delete('/admin/reference-letters/{id}', [AdminController::class, 'deleteReferenceLetter'])->name('admin.reference_letters.delete');
});


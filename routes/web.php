<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Crm\Auth\AuthController;
use App\Http\Controllers\Crm\Account\DashboardController;
use App\Http\Controllers\Crm\HomeController;
use App\Http\Controllers\Crm\CheckDataController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::domain(config('crm.domain'))->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('root.index');
    Route::group(['middleware' => ['ifNot.loggedin']], function () {
        Route::prefix('auth')->group(function () {
            Route::name('auth.')->group(function () {
                Route::get('/create-account', [AuthController::class, 'createAccount'])->name('createAccount');
                Route::post('/create-account', [AuthController::class, 'createAccountProcess'])->name('createAccount.Process');
                Route::get('/create-account/success/{success_token}', [AuthController::class, 'createAccountSuccess'])->name('createAccount.Success');
                Route::post('/resend-verification/{success_token}', [AuthController::class, 'resendVerification'])->name('resendVerification.Mail');
                Route::post('/change-email/{success_token}', [AuthController::class, 'changeEmail'])->name('change.Email');
                Route::get('/email-verification/{token}', [AuthController::class, 'accountEmailVerification'])->name('emailVerification');
                Route::get('/login', [AuthController::class, 'signIn'])->name('signIn');
                Route::post('/login', [AuthController::class, 'signInProcess'])->name('signIn.Process');
                Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgotPassword');
                Route::post('/forgot-password', [AuthController::class, 'forgotPasswordProcess'])->name('forgotPassword.Process');
                Route::get('/reset-password/{token}', [AuthController::class, 'resetPassword'])->name('resetPassword');
                Route::post('/reset-password/{token}', [AuthController::class, 'resetPasswordProcess'])->name('resetPassword.Process');
            });
        });
    });
    Route::post('/checks/emailExistOrNot', [CheckDataController::class, 'emailExistOrNot'])->name('emailExistOrNot');
    Route::post('/checks/contactNumberExistOrNot', [CheckDataController::class, 'contactNumberExistOrNot'])->name('contactNumberExistOrNot');
    Route::post('/checks/subdomainExistOrNot', [CheckDataController::class, 'subdomainExistOrNot'])->name('subdomainExistOrNot');
});

Route::group(['domain' => '{subdomain}.' . config('crm.domain'), 'middleware' => ['subdomain.validate']], function () {
    Route::group(['middleware' => ['ifNot.loggedin']], function () {
        Route::prefix('auth')->group(function () {
            Route::name('auth.')->group(function () {
                Route::get('/login', [AuthController::class, 'subdomainLogin'])->name('subdomainLogin');
                Route::get('/business/login', [AuthController::class, 'businessLogin'])->name('businessLogin');
                Route::post('/business/login', [AuthController::class, 'businessLoginProcess'])->name('businessLogin.Process');
            });
        });
    });
    Route::group(['middleware' => ['if.loggedin', 'account.validate']], function () {
        Route::prefix('account')->group(function () {
            Route::name('account.')->group(function () {
                Route::get('/logout', [DashboardController::class, 'logout'])->name('logout');
                Route::get('/dashboard', [DashboardController::class, 'myDashboard'])->name('myDashboard');
            });
        });
    });
});
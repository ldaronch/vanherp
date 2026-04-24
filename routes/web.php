<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Admin\AboutCompanyController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\UserController;

use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('welcome');
});

// Auth Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

use App\Http\Controllers\Admin\PortController;
use App\Http\Controllers\Admin\CircularController;
use App\Http\Controllers\Admin\GuidelineController;
use App\Http\Controllers\Admin\SocialNetworkController;
use App\Http\Controllers\Admin\ContactSettingController;
use App\Http\Controllers\Admin\LegalTextController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('clients', ClientController::class);
    Route::resource('seos', SeoController::class);
    Route::get('about/edit', [AboutCompanyController::class, 'edit'])->name('about.edit');
    Route::put('about/update', [AboutCompanyController::class, 'update'])->name('about.update');
    Route::resource('partners', PartnerController::class);
    Route::resource('contents', ContentController::class);
    Route::resource('banners', BannerController::class);
    Route::resource('users', UserController::class);

    // New Sections
    Route::resource('ports', PortController::class);
    Route::delete('circulars/attachments/{attachment}', [CircularController::class, 'deleteAttachment'])->name('circulars.attachments.destroy');
    Route::resource('circulars', CircularController::class);
    Route::resource('guidelines', GuidelineController::class);
    Route::resource('social-networks', SocialNetworkController::class);
    Route::get('contact/edit', [ContactSettingController::class, 'edit'])->name('contact.edit');
    Route::put('contact/update', [ContactSettingController::class, 'update'])->name('contact.update');
    Route::resource('legal-texts', LegalTextController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('posts', PostController::class);
});

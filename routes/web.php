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
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Models\AboutCompany;
use App\Models\Circular;
use App\Models\Client;
use App\Models\ContactSetting;
use App\Models\Guideline;
use App\Models\Partner;
use App\Models\Port;
use App\Models\SocialNetwork;

Route::get('logo.svg', function () {
    $path = storage_path('app/logo.svg');

    if (!file_exists($path)) {
        $path = storage_path('app/public/logo.svg');
    }

    abort_unless(file_exists($path), 404);

    return response()->file($path, [
        'Content-Type' => 'image/svg+xml',
    ]);
})->name('site.logo');

Route::get('/', function () {
    $contact = ContactSetting::firstOrCreate([], [
        'site_title' => 'Vanherp',
        'email_display' => 'contato@vanherp.com',
        'phone' => '(00) 0000-0000',
        'copyright_text' => '© '.date('Y').' Vanherp. Todos os direitos reservados.',
    ]);

    $about = AboutCompany::first();

    $ports = Port::query()
        ->orderBy('name')
        ->get(['id', 'name', 'location', 'description', 'image']);

    $piClubs = Client::query()
        ->orderBy('company')
        ->orderBy('name')
        ->get(['id', 'company', 'name', 'email', 'phone']);

    $circulars = Circular::query()
        ->orderByDesc('date')
        ->orderByDesc('created_at')
        ->limit(6)
        ->get(['id', 'title', 'date', 'description', 'created_at']);

    $guidelines = Guideline::query()
        ->orderByDesc('created_at')
        ->limit(6)
        ->get(['id', 'title', 'file_path', 'description', 'created_at']);

    $team = Partner::query()
        ->orderBy('name')
        ->get(['id', 'name', 'logo', 'link']);

    $socialNetworks = SocialNetwork::query()
        ->where('is_active', true)
        ->orderBy('name')
        ->get(['id', 'name', 'url', 'icon']);

    return view('welcome', compact('contact', 'about', 'ports', 'piClubs', 'circulars', 'guidelines', 'team', 'socialNetworks'));
});

// Auth Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

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
    Route::patch('social-networks/{socialNetwork}/toggle', [SocialNetworkController::class, 'toggle'])->name('social-networks.toggle');
    Route::resource('social-networks', SocialNetworkController::class);
    Route::get('contact/edit', [ContactSettingController::class, 'edit'])->name('contact.edit');
    Route::put('contact/update', [ContactSettingController::class, 'update'])->name('contact.update');
    Route::resource('legal-texts', LegalTextController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('posts', PostController::class);
});

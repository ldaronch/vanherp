<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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
use App\Http\Controllers\Admin\HomeTextController;
use App\Http\Controllers\Admin\UserController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Models\AboutCompany;
use App\Models\Banner;
use App\Models\Circular;
use App\Models\CircularGuidelineSection;
use App\Models\ContactSetting;
use App\Models\Content;
use App\Models\Guideline;
use App\Models\HomeText;
use App\Models\Partner;
use App\Models\PiClubSection;
use App\Models\Port;
use App\Models\Post;
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

Route::get('storage/{path}', function (string $path) {
    if (preg_match('#(^|/)\.\.(?:/|$)#', $path)) {
        abort(404);
    }

    $path = ltrim($path, '/');

    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }

    return response()->file(Storage::disk('public')->path($path));
})->where('path', '.*')->name('storage.fallback');

Route::get('media/{path}', function (string $path) {
    if (preg_match('#(^|/)\.\.(?:/|$)#', $path)) {
        abort(404);
    }

    $path = ltrim($path, '/');

    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }

    return response()->file(Storage::disk('public')->path($path));
})->where('path', '.*')->name('media');

Route::get('/', function () {
    $settings = ContactSetting::firstOrCreate([], [
        'site_title' => 'Vanherp',
        'email_display' => 'contato@vanherp.com',
        'phone' => '(00) 0000-0000',
        'copyright_text' => '© '.date('Y').' Vanherp. Todos os direitos reservados.',
    ]);

    $homeText = HomeText::first();

    $banners = Banner::query()
        ->where('is_active', true)
        ->orderBy('order')
        ->get(['id', 'title', 'subtitle', 'image', 'link', 'order']);

    $about = AboutCompany::first();

    $ports = Port::query()
        ->orderBy('name')
        ->get(['id', 'name', 'location', 'description', 'image']);

    $portsBanners = Content::query()
        ->where('section', 'port_banner')
        ->where('is_active', true)
        ->latest()
        ->get(['id', 'primary_text', 'title', 'subtitle', 'text', 'image', 'url', 'is_active']);

    $piClubSections = PiClubSection::query()
        ->where('is_active', true)
        ->with(['links' => function ($query) {
            $query->where('is_active', true)
                ->orderBy('sort_order')
                ->orderBy('name');
        }])
        ->orderBy('sort_order')
        ->orderBy('title')
        ->get();

    $circulars = Circular::query()
        ->with('attachments')
        ->orderByDesc('date')
        ->orderByDesc('created_at')
        ->limit(6)
        ->get(['id', 'title', 'date', 'description', 'created_at']);

    $guidelines = Guideline::query()
        ->orderByDesc('created_at')
        ->limit(6)
        ->get(['id', 'title', 'file_path', 'description', 'created_at']);

    $team = Partner::query()
        ->where('is_active', true)
        ->orderByDesc('priority')
        ->orderBy('name')
        ->get(['id', 'name', 'role', 'priority', 'logo', 'link', 'is_active']);

    $partners = Partner::query()
        ->where('is_active', true)
        ->orderByDesc('priority')
        ->orderBy('name')
        ->get(['id', 'name', 'priority', 'logo', 'link', 'is_active']);

    $newsPosts = Post::query()
        ->where('is_published', true)
        ->where('is_featured', true)
        ->orderByDesc('date')
        ->orderByDesc('created_at')
        ->limit(6)
        ->get(['id', 'date', 'title', 'header_line', 'slug', 'content', 'image', 'created_at', 'is_featured']);

    $socialNetworks = SocialNetwork::query()
        ->where('is_active', true)
        ->orderBy('name')
        ->get(['id', 'name', 'url', 'icon']);

    return view('welcome', compact('settings', 'homeText', 'banners', 'about', 'ports', 'portsBanners', 'piClubSections', 'circulars', 'guidelines', 'team', 'partners', 'newsPosts', 'socialNetworks'));
});

Route::get('/our-history', function () {
    $settings = ContactSetting::first();

    $page = Content::query()
        ->where('section', 'our_history')
        ->where('is_active', true)
        ->orderByDesc('sort_order')
        ->orderByDesc('created_at')
        ->first(['id', 'title', 'text', 'image', 'image_caption']);

    $socialNetworks = SocialNetwork::query()
        ->where('is_active', true)
        ->orderBy('name')
        ->get(['id', 'name', 'url', 'icon']);

    return view('our-history', compact('settings', 'page', 'socialNetworks'));
})->name('our-history');

Route::get('/our-services', function () {
    $settings = ContactSetting::first();

    $page = Content::query()
        ->where('section', 'our_services')
        ->where('is_active', true)
        ->orderByDesc('sort_order')
        ->orderByDesc('created_at')
        ->first(['id', 'title', 'text', 'items', 'image']);

    $socialNetworks = SocialNetwork::query()
        ->where('is_active', true)
        ->orderBy('name')
        ->get(['id', 'name', 'url', 'icon']);

    return view('our-services', compact('settings', 'page', 'socialNetworks'));
})->name('our-services');

Route::get('/pi-clubs', function () {
    $settings = ContactSetting::first();

    $sections = PiClubSection::query()
        ->where('is_active', true)
        ->with(['links' => function ($query) {
            $query->where('is_active', true)
                ->orderBy('sort_order')
                ->orderBy('name');
        }])
        ->orderBy('sort_order')
        ->orderBy('title')
        ->get(['id', 'title', 'text', 'sort_order', 'is_active']);

    $socialNetworks = SocialNetwork::query()
        ->where('is_active', true)
        ->orderBy('name')
        ->get(['id', 'name', 'url', 'icon']);

    return view('pi-clubs.index', compact('settings', 'sections', 'socialNetworks'));
})->name('pi-clubs.index');

Route::get('/circulars-guidelines', function () {
    $settings = ContactSetting::first();

    $sections = CircularGuidelineSection::query()
        ->where('is_active', true)
        ->with(['items' => function ($query) {
            $query->where('is_active', true)
                ->orderBy('sort_order')
                ->orderBy('name');
        }])
        ->orderBy('sort_order')
        ->orderBy('title')
        ->get(['id', 'title', 'note', 'show_note', 'sort_order', 'is_active']);

    $socialNetworks = SocialNetwork::query()
        ->where('is_active', true)
        ->orderBy('name')
        ->get(['id', 'name', 'url', 'icon']);

    return view('circulars-guidelines.index', compact('settings', 'sections', 'socialNetworks'));
})->name('circulars-guidelines.index');

Route::get('/contact', function () {
    $settings = ContactSetting::first();

    $socialNetworks = SocialNetwork::query()
        ->where('is_active', true)
        ->orderBy('name')
        ->get(['id', 'name', 'url', 'icon']);

    return view('contact', compact('settings', 'socialNetworks'));
})->name('contact.index');

Route::get('/ports', function () {
    $settings = ContactSetting::first();

    $ports = Port::query()
        ->where('is_active', true)
        ->orderBy('name')
        ->get(['id', 'name', 'url']);

    $socialNetworks = SocialNetwork::query()
        ->where('is_active', true)
        ->orderBy('name')
        ->get(['id', 'name', 'url', 'icon']);

    return view('ports.index', compact('settings', 'ports', 'socialNetworks'));
})->name('ports.index');

Route::get('/our-team', function () {
    $settings = ContactSetting::first();

    $members = Partner::query()
        ->where('is_active', true)
        ->orderByDesc('priority')
        ->orderBy('name')
        ->get(['id', 'name', 'role', 'bio', 'email', 'mobile', 'priority', 'logo', 'link', 'is_active']);

    $socialNetworks = SocialNetwork::query()
        ->where('is_active', true)
        ->orderBy('name')
        ->get(['id', 'name', 'url', 'icon']);

    return view('our-team.index', compact('settings', 'members', 'socialNetworks'));
})->name('our-team.index');

Route::get('/history', function () {
    $settings = ContactSetting::first();
    $about = AboutCompany::first();

    $socialNetworks = SocialNetwork::query()
        ->where('is_active', true)
        ->orderBy('name')
        ->get(['id', 'name', 'url', 'icon']);

    return view('history', compact('settings', 'about', 'socialNetworks'));
})->name('history');

Route::get('/news', function () {
    $settings = ContactSetting::first();

    $posts = Post::query()
        ->where('is_published', true)
        ->orderByDesc('date')
        ->orderByDesc('created_at')
        ->paginate(12, ['id', 'date', 'title', 'header_line', 'slug', 'content', 'image', 'created_at']);

    $socialNetworks = SocialNetwork::query()
        ->where('is_active', true)
        ->orderBy('name')
        ->get(['id', 'name', 'url', 'icon']);

    return view('news.index', compact('settings', 'posts', 'socialNetworks'));
})->name('news.index');

Route::get('/news/{slug}', function (string $slug) {
    $settings = ContactSetting::first();

    $post = Post::query()
        ->where('is_published', true)
        ->where('slug', $slug)
        ->firstOrFail(['id', 'date', 'title', 'header_line', 'slug', 'content', 'image', 'created_at']);

    $socialNetworks = SocialNetwork::query()
        ->where('is_active', true)
        ->orderBy('name')
        ->get(['id', 'name', 'url', 'icon']);

    return view('news.show', compact('settings', 'post', 'socialNetworks'));
})->name('news.show');

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
use App\Http\Controllers\Admin\PiClubController;
use App\Http\Controllers\Admin\PiClubItemController;
use App\Http\Controllers\Admin\CircularGuidelineSectionController;
use App\Http\Controllers\Admin\CircularGuidelineItemController;
use App\Http\Controllers\Admin\PageBannerController;
use App\Http\Controllers\Admin\InstitutionalContentController;

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('clients', ClientController::class);
    Route::resource('pi-clubs', PiClubController::class)->parameters(['pi-clubs' => 'piClub'])->except(['show']);
    Route::patch('pi-clubs/{piClub}/toggle', [PiClubController::class, 'toggle'])->name('pi-clubs.toggle');
    Route::get('pi-clubs/{piClub}/items', [PiClubItemController::class, 'index'])->name('pi-clubs.items.index');
    Route::get('pi-clubs/{piClub}/items/create', [PiClubItemController::class, 'create'])->name('pi-clubs.items.create');
    Route::post('pi-clubs/{piClub}/items', [PiClubItemController::class, 'store'])->name('pi-clubs.items.store');
    Route::get('pi-clubs/{piClub}/items/{item}/edit', [PiClubItemController::class, 'edit'])->name('pi-clubs.items.edit');
    Route::put('pi-clubs/{piClub}/items/{item}', [PiClubItemController::class, 'update'])->name('pi-clubs.items.update');
    Route::patch('pi-clubs/{piClub}/items/{item}/toggle', [PiClubItemController::class, 'toggle'])->name('pi-clubs.items.toggle');
    Route::delete('pi-clubs/{piClub}/items/{item}', [PiClubItemController::class, 'destroy'])->name('pi-clubs.items.destroy');
    Route::resource('circular-guidelines', CircularGuidelineSectionController::class)->parameters(['circular-guidelines' => 'circularGuideline'])->except(['show']);
    Route::patch('circular-guidelines/{circularGuideline}/toggle', [CircularGuidelineSectionController::class, 'toggle'])->name('circular-guidelines.toggle');
    Route::get('circular-guidelines/{circularGuideline}/items', [CircularGuidelineItemController::class, 'index'])->name('circular-guidelines.items.index');
    Route::get('circular-guidelines/{circularGuideline}/items/create', [CircularGuidelineItemController::class, 'create'])->name('circular-guidelines.items.create');
    Route::post('circular-guidelines/{circularGuideline}/items', [CircularGuidelineItemController::class, 'store'])->name('circular-guidelines.items.store');
    Route::get('circular-guidelines/{circularGuideline}/items/{item}/edit', [CircularGuidelineItemController::class, 'edit'])->name('circular-guidelines.items.edit');
    Route::put('circular-guidelines/{circularGuideline}/items/{item}', [CircularGuidelineItemController::class, 'update'])->name('circular-guidelines.items.update');
    Route::patch('circular-guidelines/{circularGuideline}/items/{item}/toggle', [CircularGuidelineItemController::class, 'toggle'])->name('circular-guidelines.items.toggle');
    Route::delete('circular-guidelines/{circularGuideline}/items/{item}', [CircularGuidelineItemController::class, 'destroy'])->name('circular-guidelines.items.destroy');
    Route::resource('seos', SeoController::class);
    Route::get('about/edit', [AboutCompanyController::class, 'edit'])->name('about.edit');
    Route::put('about/update', [AboutCompanyController::class, 'update'])->name('about.update');
    Route::resource('partners', PartnerController::class)->except(['show']);
    Route::patch('partners/{partner}/toggle', [PartnerController::class, 'toggle'])->name('partners.toggle');
    Route::resource('contents', ContentController::class);
    Route::get('home-text/edit', [HomeTextController::class, 'edit'])->name('home-text.edit');
    Route::put('home-text', [HomeTextController::class, 'update'])->name('home-text.update');
    Route::resource('banners', BannerController::class);
    Route::patch('banners/{banner}/toggle', [BannerController::class, 'toggle'])->name('banners.toggle');
    Route::resource('page-banners', PageBannerController::class)->parameters(['page-banners' => 'pageBanner'])->except(['show']);
    Route::patch('page-banners/{pageBanner}/toggle', [PageBannerController::class, 'toggle'])->name('page-banners.toggle');
    Route::resource('users', UserController::class);

    // New Sections
    Route::resource('ports', PortController::class);
    Route::patch('ports/{port}/toggle', [PortController::class, 'toggle'])->name('ports.toggle');
    Route::delete('circulars/attachments/{attachment}', [CircularController::class, 'deleteAttachment'])->name('circulars.attachments.destroy');
    Route::resource('circulars', CircularController::class);
    Route::resource('guidelines', GuidelineController::class);
    Route::patch('social-networks/{socialNetwork}/toggle', [SocialNetworkController::class, 'toggle'])->name('social-networks.toggle');
    Route::resource('social-networks', SocialNetworkController::class);
    Route::get('contact/edit', [ContactSettingController::class, 'edit'])->name('contact.edit');
    Route::put('contact/update', [ContactSettingController::class, 'update'])->name('contact.update');
    Route::resource('legal-texts', LegalTextController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('posts', PostController::class)->except(['show']);
    Route::patch('posts/{post}/toggle', [PostController::class, 'toggle'])->name('posts.toggle');
    Route::patch('contents/{content}/toggle', [ContentController::class, 'toggle'])->name('contents.toggle');

    Route::get('institutional/{section}', [InstitutionalContentController::class, 'index'])->name('institutional-contents.index');
    Route::get('institutional/{section}/create', [InstitutionalContentController::class, 'create'])->name('institutional-contents.create');
    Route::post('institutional/{section}', [InstitutionalContentController::class, 'store'])->name('institutional-contents.store');
    Route::get('institutional/{section}/{content}/edit', [InstitutionalContentController::class, 'edit'])->name('institutional-contents.edit');
    Route::put('institutional/{section}/{content}', [InstitutionalContentController::class, 'update'])->name('institutional-contents.update');
    Route::patch('institutional/{section}/{content}/toggle', [InstitutionalContentController::class, 'toggle'])->name('institutional-contents.toggle');
    Route::delete('institutional/{section}/{content}', [InstitutionalContentController::class, 'destroy'])->name('institutional-contents.destroy');
});

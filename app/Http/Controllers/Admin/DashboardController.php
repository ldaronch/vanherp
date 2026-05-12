<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Circular;
use App\Models\Client;
use App\Models\Guideline;
use App\Models\Partner;
use App\Models\Port;
use App\Models\Post;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'ports' => Port::count(),
            'circulars' => Circular::count(),
            'guidelines' => Guideline::count(),
            'posts_total' => Post::count(),
            'posts_published' => Post::where('is_published', true)->count(),
            'posts_drafts' => Post::where('is_published', false)->count(),
            'categories' => Category::count(),
            'banners' => Banner::count(),
            'partners' => Partner::count(),
            'clients' => Client::count(),
            'users' => User::count(),
        ];

        $recentCirculars = Circular::query()
            ->orderByDesc('created_at')
            ->limit(5)
            ->get(['id', 'title', 'date', 'created_at']);

        $recentPorts = Port::query()
            ->orderByDesc('created_at')
            ->limit(5)
            ->get(['id', 'name', 'location', 'created_at']);

        $recentPosts = Post::query()
            ->orderByDesc('created_at')
            ->limit(5)
            ->get(['id', 'title', 'is_published', 'created_at']);

        return view('admin.dashboard', compact('stats', 'recentCirculars', 'recentPorts', 'recentPosts'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageBannerController extends Controller
{
    private function pages(): array
    {
        return [
            'ports.index' => 'Ports',
            'history' => 'History',
            'our-history' => 'Our history',
            'our-services' => 'Our services',
            'pi-clubs.index' => 'P&I Clubs',
            'circulars-guidelines.index' => 'Circulars & Guidelines',
            'news.index' => 'News (list)',
            'news.show' => 'News (detail)',
            'our-team.index' => 'Our team',
            'contact.index' => 'Contact',
        ];
    }

    public function index()
    {
        $pages = $this->pages();

        $banners = PageBanner::query()
            ->orderByDesc('is_active')
            ->orderBy('page')
            ->orderByDesc('created_at')
            ->get();

        return view('admin.page_banners.index', compact('banners', 'pages'));
    }

    public function create()
    {
        $pages = $this->pages();

        return view('admin.page_banners.create', compact('pages'));
    }

    public function store(Request $request)
    {
        $pages = $this->pages();

        $validated = $request->validate([
            'page' => ['required', 'string', 'in:'.implode(',', array_keys($pages))],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,webp,svg', 'max:4096'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = (bool) $request->boolean('is_active');

        $path = $request->file('image')->store('page-banners', 'public');
        $validated['image'] = $path;

        PageBanner::create($validated);

        return redirect()->route('admin.page-banners.index')->with('success', 'Banner cadastrado com sucesso!');
    }

    public function edit(PageBanner $pageBanner)
    {
        $pages = $this->pages();

        return view('admin.page_banners.edit', ['banner' => $pageBanner, 'pages' => $pages]);
    }

    public function update(Request $request, PageBanner $pageBanner)
    {
        $pages = $this->pages();

        $validated = $request->validate([
            'page' => ['required', 'string', 'in:'.implode(',', array_keys($pages))],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp,svg', 'max:4096'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = (bool) $request->boolean('is_active');

        if ($request->hasFile('image')) {
            if ($pageBanner->image) {
                Storage::disk('public')->delete($pageBanner->image);
            }
            $path = $request->file('image')->store('page-banners', 'public');
            $validated['image'] = $path;
        }

        $pageBanner->update($validated);

        return redirect()->route('admin.page-banners.index')->with('success', 'Banner atualizado com sucesso!');
    }

    public function toggle(PageBanner $pageBanner)
    {
        $pageBanner->update(['is_active' => !$pageBanner->is_active]);

        return redirect()->route('admin.page-banners.index')->with('success', 'Status do banner atualizado com sucesso!');
    }

    public function destroy(PageBanner $pageBanner)
    {
        if ($pageBanner->image) {
            Storage::disk('public')->delete($pageBanner->image);
        }
        $pageBanner->delete();

        return redirect()->route('admin.page-banners.index')->with('success', 'Banner removido com sucesso!');
    }
}


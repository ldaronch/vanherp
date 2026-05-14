<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Content;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{
    public function index()
    {
        $contents = Content::query()
            ->where('section', 'port_banner')
            ->latest()
            ->get();
        return view('admin.contents.index', compact('contents'));
    }

    public function create()
    {
        return view('admin.contents.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'primary_text' => 'nullable|string|max:255',
            'title' => 'required',
            'subtitle' => 'nullable|string|max:255',
            'text' => 'required',
            'url' => 'nullable|url|max:2048',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('contents', 'public');
            $validated['image'] = $path;
        }

        $validated['section'] = 'port_banner';
        $validated['is_active'] = (bool)($validated['is_active'] ?? false);
        Content::create($validated);
        return redirect()->route('admin.contents.index')->with('success', 'Conteúdo cadastrado com sucesso!');
    }

    public function edit(Content $content)
    {
        return view('admin.contents.edit', compact('content'));
    }

    public function update(Request $request, Content $content)
    {
        $validated = $request->validate([
            'primary_text' => 'nullable|string|max:255',
            'title' => 'required',
            'subtitle' => 'nullable|string|max:255',
            'text' => 'required',
            'url' => 'nullable|url|max:2048',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($content->image) {
                Storage::disk('public')->delete($content->image);
            }
            $path = $request->file('image')->store('contents', 'public');
            $validated['image'] = $path;
        }

        $validated['section'] = 'port_banner';
        $validated['is_active'] = (bool)($validated['is_active'] ?? false);
        $content->update($validated);
        return redirect()->route('admin.contents.index')->with('success', 'Conteúdo atualizado com sucesso!');
    }

    public function destroy(Content $content)
    {
        if ($content->image) {
            Storage::disk('public')->delete($content->image);
        }
        $content->delete();
        return redirect()->route('admin.contents.index')->with('success', 'Conteúdo removido com sucesso!');
    }

    public function toggle(Content $content)
    {
        $content->update(['is_active' => !$content->is_active]);
        return redirect()->route('admin.contents.index')->with('success', 'Status do slide atualizado com sucesso!');
    }
}

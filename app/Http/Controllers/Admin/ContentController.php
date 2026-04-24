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
        $contents = Content::latest()->get();
        return view('admin.contents.index', compact('contents'));
    }

    public function create()
    {
        return view('admin.contents.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'subtitle' => 'nullable',
            'text' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'section' => 'nullable',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('contents', 'public');
            $validated['image'] = $path;
        }

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
            'title' => 'required',
            'subtitle' => 'nullable',
            'text' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'section' => 'nullable',
        ]);

        if ($request->hasFile('image')) {
            if ($content->image) {
                Storage::disk('public')->delete($content->image);
            }
            $path = $request->file('image')->store('contents', 'public');
            $validated['image'] = $path;
        }

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
}

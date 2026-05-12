<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'date' => 'required|date',
            'title' => 'required',
            'header_line' => 'nullable|string|max:255',
            'slug' => 'nullable|unique:posts,slug',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);
        $baseSlug = $validated['slug'];
        $suffix = 2;
        while (Post::query()->where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $baseSlug.'-'.$suffix;
            $suffix++;
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts', 'public');
            $validated['image'] = $path;
        }

        $validated['is_published'] = (bool)($validated['is_published'] ?? false);
        $validated['is_featured'] = (bool)($validated['is_featured'] ?? false);
        Post::create($validated);
        return redirect()->route('admin.posts.index')->with('success', 'Notícia cadastrada com sucesso!');
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'date' => 'required|date',
            'title' => 'required',
            'header_line' => 'nullable|string|max:255',
            'slug' => 'nullable|unique:posts,slug,' . $post->id,
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);
        $baseSlug = $validated['slug'];
        $suffix = 2;
        while (Post::query()->where('slug', $validated['slug'])->where('id', '!=', $post->id)->exists()) {
            $validated['slug'] = $baseSlug.'-'.$suffix;
            $suffix++;
        }

        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $path = $request->file('image')->store('posts', 'public');
            $validated['image'] = $path;
        }

        $validated['is_published'] = (bool)($validated['is_published'] ?? false);
        $validated['is_featured'] = (bool)($validated['is_featured'] ?? false);
        $post->update($validated);
        return redirect()->route('admin.posts.index')->with('success', 'Notícia atualizada com sucesso!');
    }

    public function toggle(Post $post)
    {
        $post->update(['is_published' => !$post->is_published]);
        return redirect()->route('admin.posts.index')->with('success', 'Status da notícia atualizado com sucesso!');
    }

    public function destroy(Post $post)
    {
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Notícia removida com sucesso!');
    }
}

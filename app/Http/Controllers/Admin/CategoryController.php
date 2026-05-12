<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories',
        ]);

        Category::create($validated);
        return redirect()->route('admin.categories.index')->with('success', 'Categoria cadastrada com sucesso!');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,' . $category->id,
        ]);

        $category->update($validated);
        return redirect()->route('admin.categories.index')->with('success', 'Categoria atualizada com sucesso!');
    }

    public function destroy(Category $category)
    {
        if ($category->posts()->count() > 0) {
            return redirect()->route('admin.categories.index')->with('error', 'Não é possível excluir uma categoria que possui notícias vinculadas.');
        }
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Categoria removida com sucesso!');
    }
}

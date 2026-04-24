<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Seo;

class SeoController extends Controller
{
    public function index()
    {
        $seos = Seo::all();
        return view('admin.seos.index', compact('seos'));
    }

    public function create()
    {
        return view('admin.seos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'page_name' => 'required|unique:seos',
            'title' => 'required',
            'description' => 'nullable',
            'keywords' => 'nullable',
        ]);

        Seo::create($validated);
        return redirect()->route('admin.seos.index')->with('success', 'SEO cadastrado com sucesso!');
    }

    public function edit(Seo $seo)
    {
        return view('admin.seos.edit', compact('seo'));
    }

    public function update(Request $request, Seo $seo)
    {
        $validated = $request->validate([
            'page_name' => 'required|unique:seos,page_name,' . $seo->id,
            'title' => 'required',
            'description' => 'nullable',
            'keywords' => 'nullable',
        ]);

        $seo->update($validated);
        return redirect()->route('admin.seos.index')->with('success', 'SEO atualizado com sucesso!');
    }

    public function destroy(Seo $seo)
    {
        $seo->delete();
        return redirect()->route('admin.seos.index')->with('success', 'SEO removido com sucesso!');
    }
}

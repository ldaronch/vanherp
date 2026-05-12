<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\LegalText;
use Illuminate\Support\Str;

class LegalTextController extends Controller
{
    public function index()
    {
        $texts = LegalText::all();
        return view('admin.legal_texts.index', compact('texts'));
    }

    public function create()
    {
        return view('admin.legal_texts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:legal_texts',
            'content' => 'required',
        ]);

        LegalText::create($validated);
        return redirect()->route('admin.legal-texts.index')->with('success', 'Texto legal cadastrado com sucesso!');
    }

    public function edit(LegalText $legalText)
    {
        return view('admin.legal_texts.edit', compact('legalText'));
    }

    public function update(Request $request, LegalText $legalText)
    {
        $validated = $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:legal_texts,slug,' . $legalText->id,
            'content' => 'required',
        ]);

        $legalText->update($validated);
        return redirect()->route('admin.legal-texts.index')->with('success', 'Texto legal atualizado com sucesso!');
    }

    public function destroy(LegalText $legalText)
    {
        $legalText->delete();
        return redirect()->route('admin.legal-texts.index')->with('success', 'Texto legal removido com sucesso!');
    }
}

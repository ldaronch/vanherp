<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CircularGuidelineSection;
use Illuminate\Http\Request;

class CircularGuidelineSectionController extends Controller
{
    public function index()
    {
        $sections = CircularGuidelineSection::query()
            ->withCount('items')
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();

        return view('admin.circular_guidelines.index', compact('sections'));
    }

    public function create()
    {
        return view('admin.circular_guidelines.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'note' => ['nullable', 'string'],
            'show_note' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        CircularGuidelineSection::create([
            'title' => $validated['title'],
            'note' => $validated['note'] ?? null,
            'show_note' => (bool) $request->boolean('show_note'),
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => (bool) $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.circular-guidelines.index')->with('success', 'Seção cadastrada com sucesso!');
    }

    public function edit(CircularGuidelineSection $circularGuideline)
    {
        return view('admin.circular_guidelines.edit', ['section' => $circularGuideline]);
    }

    public function update(Request $request, CircularGuidelineSection $circularGuideline)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'note' => ['nullable', 'string'],
            'show_note' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $circularGuideline->update([
            'title' => $validated['title'],
            'note' => $validated['note'] ?? null,
            'show_note' => (bool) $request->boolean('show_note'),
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => (bool) $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.circular-guidelines.index')->with('success', 'Seção atualizada com sucesso!');
    }

    public function toggle(CircularGuidelineSection $circularGuideline)
    {
        $circularGuideline->update(['is_active' => !$circularGuideline->is_active]);

        return redirect()->route('admin.circular-guidelines.index')->with('success', 'Status da seção atualizado com sucesso!');
    }

    public function destroy(CircularGuidelineSection $circularGuideline)
    {
        $circularGuideline->delete();

        return redirect()->route('admin.circular-guidelines.index')->with('success', 'Seção removida com sucesso!');
    }
}


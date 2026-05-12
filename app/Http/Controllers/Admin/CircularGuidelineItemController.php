<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CircularGuidelineItem;
use App\Models\CircularGuidelineSection;
use Illuminate\Http\Request;

class CircularGuidelineItemController extends Controller
{
    public function index(CircularGuidelineSection $circularGuideline)
    {
        $items = CircularGuidelineItem::query()
            ->where('section_id', $circularGuideline->id)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.circular_guideline_items.index', ['section' => $circularGuideline, 'items' => $items]);
    }

    public function create(CircularGuidelineSection $circularGuideline)
    {
        return view('admin.circular_guideline_items.create', ['section' => $circularGuideline]);
    }

    public function store(Request $request, CircularGuidelineSection $circularGuideline)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'url' => ['nullable', 'url', 'max:2048'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        CircularGuidelineItem::create([
            'section_id' => $circularGuideline->id,
            'name' => $validated['name'],
            'url' => $validated['url'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => (bool) $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.circular-guidelines.items.index', $circularGuideline)->with('success', 'Item cadastrado com sucesso!');
    }

    public function edit(CircularGuidelineSection $circularGuideline, CircularGuidelineItem $item)
    {
        abort_unless($item->section_id === $circularGuideline->id, 404);

        return view('admin.circular_guideline_items.edit', ['section' => $circularGuideline, 'item' => $item]);
    }

    public function update(Request $request, CircularGuidelineSection $circularGuideline, CircularGuidelineItem $item)
    {
        abort_unless($item->section_id === $circularGuideline->id, 404);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'url' => ['nullable', 'url', 'max:2048'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $item->update([
            'name' => $validated['name'],
            'url' => $validated['url'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => (bool) $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.circular-guidelines.items.index', $circularGuideline)->with('success', 'Item atualizado com sucesso!');
    }

    public function toggle(CircularGuidelineSection $circularGuideline, CircularGuidelineItem $item)
    {
        abort_unless($item->section_id === $circularGuideline->id, 404);

        $item->update(['is_active' => !$item->is_active]);

        return redirect()->route('admin.circular-guidelines.items.index', $circularGuideline)->with('success', 'Status do item atualizado com sucesso!');
    }

    public function destroy(CircularGuidelineSection $circularGuideline, CircularGuidelineItem $item)
    {
        abort_unless($item->section_id === $circularGuideline->id, 404);

        $item->delete();

        return redirect()->route('admin.circular-guidelines.items.index', $circularGuideline)->with('success', 'Item removido com sucesso!');
    }
}


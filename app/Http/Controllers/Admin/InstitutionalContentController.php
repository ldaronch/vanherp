<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InstitutionalContentController extends Controller
{
    private function sections(): array
    {
        return [
            'our_history' => 'Our history',
            'our_services' => 'Our services',
        ];
    }

    private function sectionLabel(string $section): string
    {
        return $this->sections()[$section] ?? $section;
    }

    private function assertSection(string $section): void
    {
        abort_unless(array_key_exists($section, $this->sections()), 404);
    }

    public function index(string $section)
    {
        $this->assertSection($section);

        $items = Content::query()
            ->where('section', $section)
            ->orderByDesc('sort_order')
            ->orderByDesc('created_at')
            ->get();

        return view('admin.institutional_contents.index', [
            'section' => $section,
            'sectionLabel' => $this->sectionLabel($section),
            'items' => $items,
        ]);
    }

    public function create(string $section)
    {
        $this->assertSection($section);

        return view('admin.institutional_contents.create', [
            'section' => $section,
            'sectionLabel' => $this->sectionLabel($section),
        ]);
    }

    public function store(Request $request, string $section)
    {
        $this->assertSection($section);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'text' => ['required', 'string'],
            'items' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'image_caption' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('contents', 'public');
        }

        Content::create([
            'section' => $section,
            'title' => $validated['title'],
            'text' => $validated['text'],
            'items' => $section === 'our_services' ? ($validated['items'] ?? null) : null,
            'image' => $validated['image'] ?? null,
            'image_caption' => $section === 'our_history' ? ($validated['image_caption'] ?? null) : null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => (bool) $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('admin.institutional-contents.index', $section)
            ->with('success', 'Conteúdo cadastrado com sucesso!');
    }

    public function edit(string $section, Content $content)
    {
        $this->assertSection($section);
        abort_unless($content->section === $section, 404);

        return view('admin.institutional_contents.edit', [
            'section' => $section,
            'sectionLabel' => $this->sectionLabel($section),
            'content' => $content,
        ]);
    }

    public function update(Request $request, string $section, Content $content)
    {
        $this->assertSection($section);
        abort_unless($content->section === $section, 404);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'text' => ['required', 'string'],
            'items' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'image_caption' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            if (!empty($content->image)) {
                Storage::disk('public')->delete($content->image);
            }
            $validated['image'] = $request->file('image')->store('contents', 'public');
        }

        $content->update([
            'title' => $validated['title'],
            'text' => $validated['text'],
            'items' => $section === 'our_services' ? ($validated['items'] ?? null) : null,
            'image' => $validated['image'] ?? $content->image,
            'image_caption' => $section === 'our_history' ? ($validated['image_caption'] ?? null) : null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => (bool) $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('admin.institutional-contents.index', $section)
            ->with('success', 'Conteúdo atualizado com sucesso!');
    }

    public function toggle(string $section, Content $content)
    {
        $this->assertSection($section);
        abort_unless($content->section === $section, 404);

        $content->update(['is_active' => !$content->is_active]);

        return redirect()
            ->route('admin.institutional-contents.index', $section)
            ->with('success', 'Status atualizado com sucesso!');
    }

    public function destroy(string $section, Content $content)
    {
        $this->assertSection($section);
        abort_unless($content->section === $section, 404);

        if (!empty($content->image)) {
            Storage::disk('public')->delete($content->image);
        }

        $content->delete();

        return redirect()
            ->route('admin.institutional-contents.index', $section)
            ->with('success', 'Conteúdo removido com sucesso!');
    }
}

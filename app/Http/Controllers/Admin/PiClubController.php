<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PiClubSection;
use Illuminate\Http\Request;

class PiClubController extends Controller
{
    public function index()
    {
        $sections = PiClubSection::query()
            ->withCount('links')
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();

        return view('admin.pi_clubs.index', compact('sections'));
    }

    public function create()
    {
        return view('admin.pi_clubs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'text' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        PiClubSection::create([
            'title' => $validated['title'],
            'text' => $validated['text'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => (bool) $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.pi-clubs.index')->with('success', 'Seção de P&I Clubs cadastrada com sucesso!');
    }

    public function edit(PiClubSection $piClub)
    {
        return view('admin.pi_clubs.edit', ['section' => $piClub]);
    }

    public function update(Request $request, PiClubSection $piClub)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'text' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $piClub->update([
            'title' => $validated['title'],
            'text' => $validated['text'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => (bool) $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.pi-clubs.index')->with('success', 'Seção de P&I Clubs atualizada com sucesso!');
    }

    public function toggle(PiClubSection $piClub)
    {
        $piClub->update(['is_active' => !$piClub->is_active]);

        return redirect()->route('admin.pi-clubs.index')->with('success', 'Status da seção atualizado com sucesso!');
    }

    public function destroy(PiClubSection $piClub)
    {
        $piClub->delete();

        return redirect()->route('admin.pi-clubs.index')->with('success', 'Seção removida com sucesso!');
    }
}

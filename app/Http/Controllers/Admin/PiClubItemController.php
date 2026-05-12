<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PiClubLink;
use App\Models\PiClubSection;
use Illuminate\Http\Request;

class PiClubItemController extends Controller
{
    public function index(PiClubSection $piClub)
    {
        $items = PiClubLink::query()
            ->where('pi_club_section_id', $piClub->id)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.pi_club_items.index', compact('piClub', 'items'));
    }

    public function create(PiClubSection $piClub)
    {
        return view('admin.pi_club_items.create', compact('piClub'));
    }

    public function store(Request $request, PiClubSection $piClub)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'url' => ['nullable', 'url', 'max:2048'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        PiClubLink::create([
            'pi_club_section_id' => $piClub->id,
            'name' => $validated['name'],
            'url' => $validated['url'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => (bool) $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.pi-clubs.items.index', $piClub)->with('success', 'Item cadastrado com sucesso!');
    }

    public function edit(PiClubSection $piClub, PiClubLink $item)
    {
        abort_unless($item->pi_club_section_id === $piClub->id, 404);

        return view('admin.pi_club_items.edit', compact('piClub', 'item'));
    }

    public function update(Request $request, PiClubSection $piClub, PiClubLink $item)
    {
        abort_unless($item->pi_club_section_id === $piClub->id, 404);

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

        return redirect()->route('admin.pi-clubs.items.index', $piClub)->with('success', 'Item atualizado com sucesso!');
    }

    public function toggle(PiClubSection $piClub, PiClubLink $item)
    {
        abort_unless($item->pi_club_section_id === $piClub->id, 404);

        $item->update(['is_active' => !$item->is_active]);

        return redirect()->route('admin.pi-clubs.items.index', $piClub)->with('success', 'Status do item atualizado com sucesso!');
    }

    public function destroy(PiClubSection $piClub, PiClubLink $item)
    {
        abort_unless($item->pi_club_section_id === $piClub->id, 404);

        $item->delete();

        return redirect()->route('admin.pi-clubs.items.index', $piClub)->with('success', 'Item removido com sucesso!');
    }
}


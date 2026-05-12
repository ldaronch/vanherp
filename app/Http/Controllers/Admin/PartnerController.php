<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Partner;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::query()
            ->orderByDesc('priority')
            ->orderBy('name')
            ->get();

        return view('admin.partners.index', compact('partners'));
    }

    public function create()
    {
        return view('admin.partners.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'mobile' => 'nullable|string|max:50',
            'priority' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'link' => 'nullable|url',
        ]);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('team', 'public');
            $validated['logo'] = $path;
        }

        $validated['is_active'] = (bool) $request->boolean('is_active');
        Partner::create($validated);
        return redirect()->route('admin.partners.index')->with('success', 'Membro cadastrado com sucesso!');
    }

    public function edit(Partner $partner)
    {
        return view('admin.partners.edit', compact('partner'));
    }

    public function update(Request $request, Partner $partner)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'mobile' => 'nullable|string|max:50',
            'priority' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'link' => 'nullable|url',
        ]);

        if ($request->hasFile('logo')) {
            if ($partner->logo) {
                Storage::disk('public')->delete($partner->logo);
            }
            $path = $request->file('logo')->store('team', 'public');
            $validated['logo'] = $path;
        }

        $validated['is_active'] = (bool) $request->boolean('is_active');
        $partner->update($validated);
        return redirect()->route('admin.partners.index')->with('success', 'Membro atualizado com sucesso!');
    }

    public function toggle(Partner $partner)
    {
        $partner->update(['is_active' => !$partner->is_active]);

        return redirect()->route('admin.partners.index')->with('success', 'Status atualizado com sucesso!');
    }

    public function destroy(Partner $partner)
    {
        if ($partner->logo) {
            Storage::disk('public')->delete($partner->logo);
        }
        $partner->delete();
        return redirect()->route('admin.partners.index')->with('success', 'Membro removido com sucesso!');
    }
}

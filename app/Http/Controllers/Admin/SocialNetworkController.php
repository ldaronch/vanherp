<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SocialNetwork;

class SocialNetworkController extends Controller
{
    public function index()
    {
        $networks = SocialNetwork::all();
        return view('admin.social_networks.index', compact('networks'));
    }

    public function create()
    {
        return view('admin.social_networks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'url' => 'required|url',
            'icon' => 'nullable',
            'is_active' => 'boolean',
        ]);

        SocialNetwork::create($validated);
        return redirect()->route('admin.social-networks.index')->with('success', 'Rede social cadastrada com sucesso!');
    }

    public function edit(SocialNetwork $socialNetwork)
    {
        return view('admin.social_networks.edit', compact('socialNetwork'));
    }

    public function update(Request $request, SocialNetwork $socialNetwork)
    {
        $validated = $request->validate([
            'name' => 'required',
            'url' => 'required|url',
            'icon' => 'nullable',
            'is_active' => 'boolean',
        ]);

        $socialNetwork->update($validated);
        return redirect()->route('admin.social-networks.index')->with('success', 'Rede social atualizada com sucesso!');
    }

    public function destroy(SocialNetwork $socialNetwork)
    {
        $socialNetwork->delete();
        return redirect()->route('admin.social-networks.index')->with('success', 'Rede social removida com sucesso!');
    }

    public function toggle(SocialNetwork $socialNetwork)
    {
        $socialNetwork->update([
            'is_active' => !$socialNetwork->is_active,
        ]);

        return redirect()->route('admin.social-networks.index')->with('success', 'Status da rede social atualizado com sucesso!');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Port;

class PortController extends Controller
{
    public function index()
    {
        $ports = Port::query()
            ->orderByDesc('priority')
            ->orderBy('name')
            ->get();
        return view('admin.ports.index', compact('ports'));
    }

    public function create()
    {
        return view('admin.ports.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'url' => 'nullable|url',
            'priority' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = (bool) ($request->boolean('is_active'));
        $validated['priority'] = (int) ($validated['priority'] ?? 0);

        Port::create($validated);
        return redirect()->route('admin.ports.index')->with('success', 'Porto cadastrado com sucesso!');
    }

    public function edit(Port $port)
    {
        return view('admin.ports.edit', compact('port'));
    }

    public function update(Request $request, Port $port)
    {
        $validated = $request->validate([
            'name' => 'required',
            'url' => 'nullable|url',
            'priority' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = (bool) ($request->boolean('is_active'));
        $validated['priority'] = (int) ($validated['priority'] ?? 0);

        $port->update($validated);
        return redirect()->route('admin.ports.index')->with('success', 'Porto atualizado com sucesso!');
    }

    public function toggle(Port $port)
    {
        $port->update(['is_active' => !$port->is_active]);
        return redirect()->route('admin.ports.index')->with('success', 'Status do porto atualizado com sucesso!');
    }

    public function destroy(Port $port)
    {
        $port->delete();
        return redirect()->route('admin.ports.index')->with('success', 'Porto removido com sucesso!');
    }
}

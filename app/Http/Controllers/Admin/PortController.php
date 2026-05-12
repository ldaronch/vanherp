<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Port;
use Illuminate\Support\Facades\Storage;

class PortController extends Controller
{
    public function index()
    {
        $ports = Port::latest()->get();
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
            'location' => 'nullable',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('ports', 'public');
            $validated['image'] = $path;
        }

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
            'location' => 'nullable',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($port->image) {
                Storage::disk('public')->delete($port->image);
            }
            $path = $request->file('image')->store('ports', 'public');
            $validated['image'] = $path;
        }

        $port->update($validated);
        return redirect()->route('admin.ports.index')->with('success', 'Porto atualizado com sucesso!');
    }

    public function destroy(Port $port)
    {
        if ($port->image) {
            Storage::disk('public')->delete($port->image);
        }
        $port->delete();
        return redirect()->route('admin.ports.index')->with('success', 'Porto removido com sucesso!');
    }
}

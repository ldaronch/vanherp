<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Circular;
use App\Models\CircularAttachment;
use Illuminate\Support\Facades\Storage;

class CircularController extends Controller
{
    public function index()
    {
        $circulars = Circular::with('attachments')->latest()->get();
        return view('admin.circulars.index', compact('circulars'));
    }

    public function create()
    {
        return view('admin.circulars.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'date' => 'nullable|date',
            'description' => 'nullable',
            'attachments.*' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $circular = Circular::create($validated);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('circular_attachments', 'public');
                $circular->attachments()->create([
                    'file_path' => $path,
                    'original_name' => $file->getClientOriginalName(),
                ]);
            }
        }

        return redirect()->route('admin.circulars.index')->with('success', 'Circular cadastrada com sucesso!');
    }

    public function edit(Circular $circular)
    {
        $circular->load('attachments');
        return view('admin.circulars.edit', compact('circular'));
    }

    public function update(Request $request, Circular $circular)
    {
        $validated = $request->validate([
            'title' => 'required',
            'date' => 'nullable|date',
            'description' => 'nullable',
            'attachments.*' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $circular->update($validated);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('circular_attachments', 'public');
                $circular->attachments()->create([
                    'file_path' => $path,
                    'original_name' => $file->getClientOriginalName(),
                ]);
            }
        }

        return redirect()->route('admin.circulars.index')->with('success', 'Circular atualizada com sucesso!');
    }

    public function destroy(Circular $circular)
    {
        foreach ($circular->attachments as $attachment) {
            Storage::disk('public')->delete($attachment->file_path);
        }
        $circular->delete();
        return redirect()->route('admin.circulars.index')->with('success', 'Circular removida com sucesso!');
    }

    public function deleteAttachment(CircularAttachment $attachment)
    {
        Storage::disk('public')->delete($attachment->file_path);
        $attachment->delete();
        return back()->with('success', 'Anexo removido com sucesso!');
    }
}

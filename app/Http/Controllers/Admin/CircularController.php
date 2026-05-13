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
            'url' => 'nullable|url|max:2048',
            'file_path' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $incomingUrl = trim((string) $request->input('url', ''));
        $hasUrl = $incomingUrl !== '';
        $hasFile = $request->hasFile('file_path');

        if (!$hasUrl && !$hasFile) {
            return back()
                ->withErrors(['url' => 'Informe um link ou envie ao menos um PDF.'])
                ->withInput();
        }

        $circular = Circular::create([
            'title' => $validated['title'],
            'date' => $validated['date'] ?? null,
            'description' => $validated['description'] ?? null,
            'url' => $hasUrl ? $incomingUrl : null,
        ]);

        if (!$hasUrl && $hasFile) {
            $file = $request->file('file_path');
            $path = $file->store('circular_attachments', 'public');
            $circular->attachments()->create([
                'file_path' => $path,
                'original_name' => $file->getClientOriginalName(),
            ]);
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
            'url' => 'nullable|url|max:2048',
            'file_path' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $incomingUrl = trim((string) $request->input('url', ''));
        $hasIncomingUrl = $incomingUrl !== '';
        $hasNewFile = $request->hasFile('file_path');
        $hasExistingFile = $circular->attachments()->exists();

        if (!$hasIncomingUrl && !$hasNewFile && !$hasExistingFile) {
            return back()
                ->withErrors(['url' => 'Informe um link ou mantenha/envie ao menos um PDF.'])
                ->withInput();
        }

        if ($hasIncomingUrl) {
            foreach ($circular->attachments as $attachment) {
                Storage::disk('public')->delete($attachment->file_path);
            }
            $circular->attachments()->delete();
        }

        if ($hasNewFile) {
            $incomingUrl = '';
            foreach ($circular->attachments as $attachment) {
                Storage::disk('public')->delete($attachment->file_path);
            }
            $circular->attachments()->delete();
        }

        $circular->update([
            'title' => $validated['title'],
            'date' => $validated['date'] ?? null,
            'description' => $validated['description'] ?? null,
            'url' => $incomingUrl !== '' ? $incomingUrl : null,
        ]);

        if ($hasNewFile) {
            $file = $request->file('file_path');
            $path = $file->store('circular_attachments', 'public');
            $circular->attachments()->create([
                'file_path' => $path,
                'original_name' => $file->getClientOriginalName(),
            ]);
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

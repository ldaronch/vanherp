<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Guideline;
use Illuminate\Support\Facades\Storage;

class GuidelineController extends Controller
{
    public function index()
    {
        $guidelines = Guideline::latest()->get();
        return view('admin.guidelines.index', compact('guidelines'));
    }

    public function create()
    {
        return view('admin.guidelines.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'url' => 'nullable|url|max:2048',
            'file_path' => 'nullable|file|mimes:pdf|max:5120',
            'description' => 'nullable',
        ]);

        $incomingUrl = trim((string) $request->input('url', ''));
        $hasUrl = $incomingUrl !== '';
        $hasFile = $request->hasFile('file_path');

        if (!$hasUrl && !$hasFile) {
            return back()
                ->withErrors(['url' => 'Informe um link ou envie um PDF.'])
                ->withInput();
        }

        if ($hasFile) {
            $path = $request->file('file_path')->store('guidelines', 'public');
            $validated['file_path'] = $path;
            $validated['url'] = null;
        } else {
            $validated['file_path'] = '';
            $validated['url'] = $incomingUrl;
        }

        Guideline::create($validated);
        return redirect()->route('admin.guidelines.index')->with('success', 'Diretriz cadastrada com sucesso!');
    }

    public function edit(Guideline $guideline)
    {
        return view('admin.guidelines.edit', compact('guideline'));
    }

    public function update(Request $request, Guideline $guideline)
    {
        $validated = $request->validate([
            'title' => 'required',
            'url' => 'nullable|url|max:2048',
            'file_path' => 'nullable|file|mimes:pdf|max:5120',
            'description' => 'nullable',
        ]);

        $incomingUrl = trim((string) $request->input('url', ''));
        $hasIncomingUrl = $incomingUrl !== '';
        $hasNewFile = $request->hasFile('file_path');
        $hasExistingFile = !empty($guideline->file_path);

        if (!$hasIncomingUrl && !$hasNewFile && !$hasExistingFile) {
            return back()
                ->withErrors(['url' => 'Informe um link ou mantenha/envie um PDF.'])
                ->withInput();
        }

        if ($hasIncomingUrl) {
            if (!empty($guideline->file_path)) {
                Storage::disk('public')->delete($guideline->file_path);
            }
            $validated['file_path'] = '';
            $validated['url'] = $incomingUrl;
        }

        if ($hasNewFile) {
            if ($guideline->file_path) {
                Storage::disk('public')->delete($guideline->file_path);
            }
            $path = $request->file('file_path')->store('guidelines', 'public');
            $validated['file_path'] = $path;
            $validated['url'] = null;
        }

        $guideline->update($validated);
        return redirect()->route('admin.guidelines.index')->with('success', 'Diretriz atualizada com sucesso!');
    }

    public function destroy(Guideline $guideline)
    {
        if ($guideline->file_path) {
            Storage::disk('public')->delete($guideline->file_path);
        }
        $guideline->delete();
        return redirect()->route('admin.guidelines.index')->with('success', 'Diretriz removida com sucesso!');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AboutCompany;
use Illuminate\Support\Facades\Storage;

class AboutCompanyController extends Controller
{
    public function edit()
    {
        $about = AboutCompany::firstOrCreate([], [
            'title' => 'Sobre a Nossa Empresa',
            'content' => 'Conteúdo inicial sobre a empresa.',
        ]);
        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request)
    {
        $about = AboutCompany::first();
        
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($about->image) {
                Storage::disk('public')->delete($about->image);
            }
            $path = $request->file('image')->store('about', 'public');
            $validated['image'] = $path;
        }

        $about->update($validated);
        return redirect()->route('admin.about.edit')->with('success', 'Informações da empresa atualizadas com sucesso!');
    }
}

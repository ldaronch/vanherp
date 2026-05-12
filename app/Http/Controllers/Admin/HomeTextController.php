<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeText;
use Illuminate\Http\Request;

class HomeTextController extends Controller
{
    public function edit()
    {
        $homeText = HomeText::firstOrCreate([], [
            'title' => 'Título da Home',
            'text' => 'Texto da Home',
            'url' => null,
        ]);

        return view('admin.home_text.edit', compact('homeText'));
    }

    public function update(Request $request)
    {
        $homeText = HomeText::firstOrCreate([]);

        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'text' => 'nullable|string',
            'url' => 'nullable|url|max:2048',
        ]);

        $homeText->update($validated);

        return redirect()->route('admin.home-text.edit')->with('success', 'Texto da home atualizado com sucesso!');
    }
}

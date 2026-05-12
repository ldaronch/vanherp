<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ContactSetting;

class ContactSettingController extends Controller
{
    public function edit()
    {
        $contact = ContactSetting::firstOrCreate([], [
            'site_title' => 'Precise Monolith',
            'email_display' => 'contato@empresa.com',
            'phone' => '(00) 0000-0000',
            'emergency_phone' => '(00) 0000-0000',
            'copyright_text' => '© 2026 Todos os direitos reservados.',
        ]);
        return view('admin.contact.edit', compact('contact'));
    }

    public function update(Request $request)
    {
        $contact = ContactSetting::first();
        
        $validated = $request->validate([
            'site_title' => 'nullable',
            'email_leads' => 'nullable|email',
            'email_display' => 'nullable|email',
            'phone' => 'nullable',
            'cellphone' => 'nullable',
            'whatsapp' => 'nullable',
            'emergency_phone' => 'nullable',
            'address' => 'nullable',
            'city' => 'nullable',
            'state' => 'nullable',
            'zip_code' => 'nullable',
            'mailing_address' => 'nullable',
            'maps_iframe' => 'nullable',
            'working_hours' => 'nullable',
            'copyright_text' => 'nullable',
        ]);

        $contact->update($validated);
        return redirect()->route('admin.contact.edit')->with('success', 'Dados de contato atualizados com sucesso!');
    }
}

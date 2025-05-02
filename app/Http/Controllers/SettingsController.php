<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingsController extends Controller
{
    /**
     * Tampilkan halaman pengaturan (admin).
     */
    public function index()
    {
        // Ambil semua pengaturan yang ada
        $settings = Setting::all();
        return view('dashboard.admin.settings.index', compact('settings'));
    }

    /**
     * Form untuk mengedit pengaturan
     */
    public function edit($id)
    {
        // Ambil pengaturan berdasarkan ID
        $setting = Setting::findOrFail($id);
        return view('dashboard.admin.settings.edit', compact('setting'));
    }

    /**
     * Perbarui pengaturan
     */
    public function update(Request $request, $id)
    {
        // Validasi input pengaturan
        $request->validate([
            'key' => 'required|string|max:255',
            'value' => 'required|string',
        ]);

        // Cari pengaturan yang akan diperbarui
        $setting = Setting::findOrFail($id);

        // Update pengaturan dengan data baru
        $setting->update($request->all());

        // Redirect dengan pesan sukses
        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan berhasil diperbarui.');
    }

    /**
     * Hapus pengaturan
     */
    public function destroy($id)
    {
        // Cari pengaturan yang akan dihapus
        $setting = Setting::findOrFail($id);

        // Hapus pengaturan
        $setting->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan berhasil dihapus.');
    }

    /**
     * Menambahkan pengaturan baru
     */
    public function create()
    {
        return view('dashboard.admin.settings.create');
    }

    /**
     * Simpan pengaturan baru
     */
    public function store(Request $request)
    {
        // Validasi input pengaturan
        $request->validate([
            'key' => 'required|string|max:255|unique:settings,key', // pastikan 'key' unik
            'value' => 'required|string',
        ]);

        // Simpan pengaturan baru
        Setting::create($request->all());

        // Redirect dengan pesan sukses
        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan berhasil ditambahkan.');
    }
}

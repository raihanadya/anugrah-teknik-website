<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FAQ;

class FAQController extends Controller
{
    /**
     * Tampilkan semua FAQ (admin).
     */
    public function index()
    {
        $faqs = FAQ::all();
        return view('dashboard.admin.faqs.index', compact('faqs'));
    }

    /**
     * Tampilkan form tambah FAQ baru.
     */
    public function create()
    {
        return view('dashboard.admin.faqs.create');
    }

    /**
     * Simpan data FAQ baru.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string|max:1000',
        ]);

        // Menyimpan FAQ baru ke database
        FAQ::create([
            'question' => $request->question,
            'answer' => $request->answer,
        ]);

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit FAQ.
     */
    public function edit($id)
    {
        $faq = FAQ::findOrFail($id);
        return view('dashboard.admin.faqs.edit', compact('faq'));
    }

    /**
     * Perbarui data FAQ.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string|max:1000',
        ]);

        // Cari FAQ yang akan diperbarui
        $faq = FAQ::findOrFail($id);
        $faq->update([
            'question' => $request->question,
            'answer' => $request->answer,
        ]);

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ berhasil diperbarui.');
    }

    /**
     * Hapus data FAQ.
     */
    public function destroy($id)
    {
        // Cari dan hapus FAQ berdasarkan ID
        $faq = FAQ::findOrFail($id);
        $faq->delete();

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ berhasil dihapus.');
    }
}

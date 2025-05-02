<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;

class ContactMessageController extends Controller
{
    /**
     * Simpan pesan kontak dari form pengguna.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email',
            'subject' => 'required|string|max:150',
            'message' => 'required|string',
        ]);

        ContactMessage::create($request->all());

        return redirect()->back()->with('success', 'Pesan Anda telah dikirim. Terima kasih!');
    }

    /**
     * Tampilkan semua pesan untuk admin.
     */
    public function index()
    {
        $messages = ContactMessage::latest()->get();
        return view('dashboard.admin.messages.index', compact('messages'));
    }

    /**
     * Tandai pesan sebagai sudah dibaca.
     */
    public function markAsRead($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->is_read = true;
        $message->save();

        return redirect()->back()->with('success', 'Pesan telah ditandai sebagai dibaca.');
    }

    /**
     * Hapus pesan.
     */
    public function destroy($id)
    {
        ContactMessage::destroy($id);
        return redirect()->back()->with('success', 'Pesan telah dihapus.');
    }
}

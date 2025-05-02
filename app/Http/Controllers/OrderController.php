<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Tampilkan form pemesanan untuk pelanggan.
     */
    public function create(Request $request)
    {
        // Validasi jika service_id tidak ada
        $service = Service::findOrFail($request->service_id);
        return view('pages.form_pemesanan', compact('service'));
    }

    /**
     * Simpan pemesanan dari pelanggan.
     */
    public function store(Request $request)
    {
        // Validasi input dari pelanggan
        $request->validate([
            'service_id' => 'required|exists:services,id',  // Pastikan service_id valid
            'address' => 'required|string|max:255',  // Alamat wajib diisi
            'notes' => 'nullable|string|max:500',  // Catatan opsional
            'date' => 'required|date|after_or_equal:today',  // Pastikan tanggal pemesanan valid
        ]);

        // Membuat pemesanan
        Order::create([
            'user_id' => Auth::id(),  // Ambil ID user yang sedang login
            'service_id' => $request->service_id,
            'address' => $request->address,
            'notes' => $request->notes,
            'date' => $request->date,
            'status' => 'pending',  // Status awal pemesanan adalah pending
        ]);

        // Redirect setelah pemesanan berhasil
        return redirect()->route('user.orders')->with('success', 'Pemesanan berhasil dibuat.');
    }

    /**
     * Tampilkan daftar pesanan pelanggan.
     */
    public function userOrders()
    {
        // Ambil semua pesanan milik pengguna yang sedang login
        $orders = Order::where('user_id', Auth::id())->latest()->get();
        return view('dashboard.user.orders', compact('orders'));
    }

    /**
     * Tampilkan semua pesanan untuk admin.
     */
    public function adminOrders()
    {
        // Admin dapat melihat semua pesanan dengan relasi user dan service
        $orders = Order::with('user', 'service')->latest()->get();
        return view('dashboard.admin.orders.index', compact('orders'));
    }

    /**
     * Ubah status pemesanan (admin).
     */
    public function updateStatus(Request $request, $id)
    {
        // Validasi input status
        $order = Order::findOrFail($id);
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',  // Validasi status yang diperbolehkan
        ]);

        // Update status pesanan
        $order->update(['status' => $request->status]);

        // Redirect kembali dengan pesan sukses
        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
}

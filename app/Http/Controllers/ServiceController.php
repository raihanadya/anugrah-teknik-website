<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Category;

class ServiceController extends Controller
{
    /**
     * Tampilkan semua layanan (admin panel)
     */
    public function index(Request $request)
    {
        $query = Service::with('category');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $services = $query->latest()->paginate(10)->withQueryString();
        $categories = Category::all();

        return view('dashboard.admin.services.index', compact('services', 'categories'));
    }


    /**
     * Form tambah layanan baru
     */
    public function create()
    {
        // Ambil semua kategori untuk dropdown
        $categories = Category::all();
        return view('dashboard.admin.services.create', compact('categories'));
    }

    /**
     * Simpan layanan baru
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',  // Nama layanan wajib diisi
            'category_id' => 'required|exists:categories,id',  // Pastikan category_id valid
            'description' => 'nullable|string',  // Deskripsi opsional
            'price' => 'required|numeric',  // Harga harus numeric
            'unit' => 'required|string',  // Satuan harus diisi
            'is_outside_area' => 'nullable|boolean',  // Jika ada field ini, validasi boolean
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'  // Validasi gambar
        ]);

        // Ambil semua data input
        $data = $request->all();

        // Jika ada gambar yang diupload, simpan ke folder services
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('services', 'public');
        }

        // Simpan layanan baru ke database
        Service::create($data);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    /**
     * Form edit layanan
     */
    public function edit($id)
    {
        // Ambil data layanan yang ingin diedit dan semua kategori
        $service = Service::findOrFail($id);
        $categories = Category::all();
        return view('dashboard.admin.services.edit', compact('service', 'categories'));
    }

    /**
     * Update layanan
     */
    public function update(Request $request, $id)
    {
        // Ambil layanan yang akan diperbarui
        $service = Service::findOrFail($id);

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'unit' => 'required|string',
            'is_outside_area' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Ambil semua data input
        $data = $request->all();

        // Jika ada gambar yang diupload, simpan ke folder services
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($service->image) {
                \Storage::delete('public/' . $service->image);
            }
            $data['image'] = $request->file('image')->store('services', 'public');
        }

        // Perbarui data layanan
        $service->update($data);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    /**
     * Hapus layanan
     */
    public function destroy($id)
    {
        // Ambil layanan yang akan dihapus
        $service = Service::findOrFail($id);

        // Hapus gambar jika ada
        if ($service->image) {
            \Storage::delete('public/' . $service->image);
        }

        // Hapus layanan dari database
        $service->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil dihapus.');
    }
}

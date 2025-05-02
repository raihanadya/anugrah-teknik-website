<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    /**
     * Tampilkan semua testimonial untuk admin.
     */
    public function index()
    {
        $testimonials = Testimonial::latest()->get();
        return view('dashboard.admin.testimonials.index', compact('testimonials'));
    }

    /**
     * Simpan testimonial baru dari form user (frontend).
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'content' => 'required|string|max:1000',
            'rating'  => 'nullable|integer|min:1|max:5',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('testimonials', 'public');
        }

        Testimonial::create($data);

        return redirect()->back()->with('success', 'Testimoni berhasil dikirim, menunggu persetujuan admin.');
    }

    /**
     * Aktifkan/nonaktifkan testimonial.
     */
    public function toggleStatus($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->is_active = !$testimonial->is_active;
        $testimonial->save();

        return redirect()->back()->with('success', 'Status testimoni berhasil diperbarui.');
    }

    /**
     * Hapus testimonial.
     */
    public function destroy($id)
    {
        Testimonial::destroy($id);
        return redirect()->back()->with('success', 'Testimoni berhasil dihapus.');
    }
}

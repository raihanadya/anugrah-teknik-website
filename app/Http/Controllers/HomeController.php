<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\FAQ;
use App\Models\Promo;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama dengan layanan populer, FAQ, dan promosi aktif.
     */
    public function index()
    {
        // Menggunakan cache untuk menyimpan layanan populer, FAQ, dan promosi yang aktif
        $services = Cache::remember('popular_services', now()->addMinutes(10), function () {
            return Service::latest()->take(4)->get(); // Menampilkan layanan populer
        });

        $faqs = Cache::remember('faqs', now()->addMinutes(10), function () {
            return FAQ::all(); // Mengambil FAQ yang ada
        });

        $promos = Cache::remember('active_promos', now()->addMinutes(10), function () {
            return Promo::where('is_active', true)->get(); // Mengambil promosi aktif
        });

        return view('pages.home', compact('services', 'faqs', 'promos'));
    }

    /**
     * Menampilkan halaman layanan dengan kategori.
     */
    public function layanan()
    {
        // Menggunakan cache untuk mengambil layanan dengan kategori
        $services = Cache::remember('all_services_with_category', now()->addMinutes(10), function () {
            return Service::with('category')->get(); // Mengambil layanan dengan kategori terkait
        });

        return view('pages.layanan', compact('services'));
    }

    /**
     * Menampilkan detail layanan berdasarkan ID.
     */
    public function detail($id)
    {
        // Menggunakan cache untuk detail layanan berdasarkan ID
        $service = Cache::remember("service_detail_{$id}", now()->addMinutes(10), function () use ($id) {
            return Service::with('category')->findOrFail($id); // Menampilkan layanan dan kategori berdasarkan ID
        });

        return view('pages.detail', compact('service'));
    }

    /**
     * Menampilkan halaman tentang.
     */
    public function tentang()
    {
        return view('pages.tentang');
    }

    /**
     * Menampilkan halaman kebijakan.
     */
    public function kebijakan()
    {
        return view('pages.kebijakan');
    }

    /**
     * Menampilkan halaman FAQ.
     */
    public function faq()
    {
        // Menggunakan cache untuk FAQ
        $faqs = Cache::remember('faqs', now()->addMinutes(10), function () {
            return FAQ::all(); // Mengambil FAQ yang ada
        });

        return view('pages.faq', compact('faqs'));
    }

    /**
     * Menampilkan halaman kontak.
     */
    public function kontak()
    {
        return view('pages.kontak');
    }

    /**
     * Menampilkan halaman 404 (not found).
     */
    public function notfound()
    {
        return response()->view('errors.404', [], 404);
    }
}

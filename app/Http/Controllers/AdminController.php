<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Category;
use App\Models\Promo;
use App\Models\FAQ;
use App\Models\User;
use App\Models\Order;

class AdminController extends Controller
{
    /**
     * Dashboard admin
     */
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalServices = Service::count();
        $totalOrders = Order::count();
        $totalPromos = Promo::count();

        return view('dashboard.admin.index', compact('totalUsers', 'totalServices', 'totalOrders', 'totalPromos'));
    }

    /**
     * Manajemen kategori layanan
     */
    public function categories()
    {
        $categories = Category::all();
        return view('dashboard.admin.categories.index', compact('categories'));
    }

    public function createCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100'
        ]);

        Category::create(['name' => $request->name]);

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('dashboard.admin.categories.edit', compact('category'));
    }

    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100'
        ]);

        $category = Category::findOrFail($id);
        $category->update(['name' => $request->name]);

        return redirect()->route('admin.categories')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);

        // Cek apakah ada layanan yang terkait dengan kategori ini
        if ($category->services()->count() > 0) {
            return redirect()->back()->with('error', 'Kategori ini tidak bisa dihapus karena ada layanan yang terkait.');
        }

        $category->delete();
        return redirect()->back()->with('success', 'Kategori berhasil dihapus.');
    }

    /**
     * Manajemen FAQ
     */
    public function faqs()
    {
        $faqs = FAQ::all();
        return view('dashboard.admin.faqs.index', compact('faqs'));
    }

    public function storeFaq(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string'
        ]);

        FAQ::create($request->all());
        return redirect()->back()->with('success', 'FAQ berhasil ditambahkan.');
    }

    public function editFaq($id)
    {
        $faq = FAQ::findOrFail($id);
        return view('dashboard.admin.faqs.edit', compact('faq'));
    }

    public function updateFaq(Request $request, $id)
    {
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string'
        ]);

        $faq = FAQ::findOrFail($id);
        $faq->update($request->all());

        return redirect()->route('admin.faqs')->with('success', 'FAQ berhasil diperbarui.');
    }

    public function deleteFaq($id)
    {
        FAQ::destroy($id);
        return redirect()->back()->with('success', 'FAQ berhasil dihapus.');
    }

    /**
     * Manajemen promo
     */
    public function promos()
    {
        $promos = Promo::all();
        return view('dashboard.admin.promos.index', compact('promos'));
    }

    public function storePromo(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'discount' => 'required|numeric|min:1|max:100',
            'is_active' => 'required|boolean'
        ]);

        Promo::create($request->all());
        return redirect()->back()->with('success', 'Promo berhasil ditambahkan.');
    }

    public function editPromo($id)
    {
        $promo = Promo::findOrFail($id);
        return view('dashboard.admin.promos.edit', compact('promo'));
    }

    public function updatePromo(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'discount' => 'required|numeric|min:1|max:100',
            'is_active' => 'required|boolean'
        ]);

        $promo = Promo::findOrFail($id);
        $promo->update($request->all());

        return redirect()->route('admin.promos')->with('success', 'Promo berhasil diperbarui.');
    }

    public function deletePromo($id)
    {
        Promo::destroy($id);
        return redirect()->back()->with('success', 'Promo berhasil dihapus.');
    }
}

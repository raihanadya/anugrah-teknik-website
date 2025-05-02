@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-semibold mb-6">Dashboard Admin</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Card Jumlah User -->
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4">
            <div class="text-gray-500 dark:text-gray-300 text-sm">Total Pengguna</div>
            <div class="text-2xl font-bold text-gray-800 dark:text-white">120</div>
        </div>

        <!-- Card Jumlah Layanan -->
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4">
            <div class="text-gray-500 dark:text-gray-300 text-sm">Jumlah Layanan</div>
            <div class="text-2xl font-bold text-gray-800 dark:text-white">15</div>
        </div>

        <!-- Card Jumlah Pesanan -->
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4">
            <div class="text-gray-500 dark:text-gray-300 text-sm">Total Pemesanan</div>
            <div class="text-2xl font-bold text-gray-800 dark:text-white">87</div>
        </div>

        <!-- Card Jumlah Promo Aktif -->
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4">
            <div class="text-gray-500 dark:text-gray-300 text-sm">Promo Aktif</div>
            <div class="text-2xl font-bold text-gray-800 dark:text-white">3</div>
        </div>
    </div>

    <!-- Statistik atau grafik bisa ditambahkan di sini -->
    <div class="mt-10">
        <h2 class="text-xl font-semibold mb-4">Aktivitas Terbaru</h2>
        <ul class="space-y-3">
            <li class="bg-white dark:bg-gray-800 p-3 rounded shadow">Pesanan #1123 oleh Budi (menunggu konfirmasi)</li>
            <li class="bg-white dark:bg-gray-800 p-3 rounded shadow">Testimoni baru dari Sari</li>
            <li class="bg-white dark:bg-gray-800 p-3 rounded shadow">User baru: admin2@example.com</li>
        </ul>
    </div>
</div>
@endsection

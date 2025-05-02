@extends('layouts.admin')

@section('title', 'Daftar Layanan')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">Daftar Layanan</h2>
        <a href="{{ route('admin.services.create') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow text-sm">
            + Tambah Layanan
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded dark:bg-green-900 dark:text-green-200">
            {{ session('success') }}
        </div>
    @endif
    <form method="GET" class="mb-4 flex flex-wrap gap-2 items-center">
        <input type="text" name="search" value="{{ request('search') }}"
            placeholder="Cari nama layanan"
            class="px-4 py-2 border rounded w-full md:w-1/3 dark:bg-gray-700 dark:text-white dark:border-gray-600">

        <select name="category_id"
            class="px-4 py-2 border rounded w-full md:w-1/4 dark:bg-gray-700 dark:text-white dark:border-gray-600">
            <option value="">Semua Kategori</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <button type="submit"
            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded shadow text-sm">
            Cari
        </button>
    </form>

    <table class="min-w-full table-auto bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
        <thead>
            <tr>
                <th class="px-4 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-300">No</th>
                <th class="px-4 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-300">Nama Layanan</th>
                <th class="px-4 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-300">Kategori</th>
                <th class="px-4 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-300">Harga</th>
                <th class="px-4 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-300">Satuan</th>
                <th class="px-4 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-300">Wilayah</th>
                <th class="px-4 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-300">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-sm divide-y divide-gray-200 dark:divide-gray-700">
            @forelse ($services as $index => $service)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <td class="px-4 py-3">{{ $index + 1 }}</td>
                    <td class="px-4 py-3">{{ $service->name }}</td>
                    <td class="px-4 py-3">{{ $service->category->name ?? '-' }}</td>
                    <td class="px-4 py-3">Rp{{ number_format($service->price, 0, ',', '.') }}</td>
                    <td class="px-4 py-3">{{ $service->unit }}</td>
                    <td class="px-4 py-3">
                        {{ $service->is_outside_area ? 'Luar Area' : 'Dalam Area' }}
                    </td>
                    <td class="px-4 py-3 space-x-2">
                        <a href="{{ route('admin.services.edit', $service->id) }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                            Edit
                        </a>
                        <!-- <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus layanan ini?')"
                                    class="text-red-600 hover:text-red-800">
                                Hapus
                            </button>
                        </form> -->
                        <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" class="inline">
                        @csrf
                            @method('DELETE')
                            <button type="button"
                                onclick="openDeleteModal('{{ route('admin.services.destroy', $service->id) }}')"
                                class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">Tidak ada layanan yang tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="mt-6">
        {{ $services->links() }}
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
        <div class="bg-white dark:bg-gray-800 p-6 rounded shadow-lg w-full max-w-md">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Konfirmasi Hapus</h3>
            <p class="text-gray-600 dark:text-gray-300 mb-6">Apakah Anda yakin ingin menghapus layanan ini?</p>
            <form id="deleteForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-500 rounded text-sm">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded text-sm">Hapus</button>
                </div>
            </form>
        </div>
    </div>

@push('scripts')
    <script>
        function openDeleteModal(actionUrl) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');
            form.action = actionUrl;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Optional: Tutup modal jika klik di luar kotak modal
        window.addEventListener('click', function(e) {
            const modal = document.getElementById('deleteModal');
            if (e.target === modal) {
                closeModal();
            }
        });
    </script>
@endpush

@endsection

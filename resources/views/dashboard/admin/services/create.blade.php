@extends('layouts.admin')

@section('title', 'Tambah Layanan')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-semibold">Tambah Layanan Baru</h2>
    </div>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded dark:bg-red-900 dark:text-red-200">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li class="text-sm">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white dark:bg-gray-800 p-6 rounded shadow">
        @csrf

        <div>
            <label for="name" class="block font-medium mb-1">Nama Layanan</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}"
                   class="w-full px-4 py-2 border rounded dark:bg-gray-700 dark:text-white dark:border-gray-600 @error('name') border-red-500 @enderror"
                   required>
            @error('name')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="category_id" class="block font-medium mb-1">Kategori</label>
            <select name="category_id" id="category_id"
                    class="w-full px-4 py-2 border rounded dark:bg-gray-700 dark:text-white dark:border-gray-600 @error('category_id') border-red-500 @enderror"
                    required>
                <option value="">-- Pilih Kategori --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description" class="block font-medium mb-1">Deskripsi</label>
            <textarea name="description" id="description" rows="4"
                      class="w-full px-4 py-2 border rounded dark:bg-gray-700 dark:text-white dark:border-gray-600 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
            @error('description')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="price" class="block font-medium mb-1">Harga</label>
                <input type="number" name="price" id="price" value="{{ old('price') }}"
                       class="w-full px-4 py-2 border rounded dark:bg-gray-700 dark:text-white dark:border-gray-600 @error('price') border-red-500 @enderror"
                       required>
                @error('price')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="unit" class="block font-medium mb-1">Satuan</label>
                <input type="text" name="unit" id="unit" value="{{ old('unit') }}"
                       class="w-full px-4 py-2 border rounded dark:bg-gray-700 dark:text-white dark:border-gray-600 @error('unit') border-red-500 @enderror"
                       required>
                @error('unit')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label class="inline-flex items-center space-x-2">
                <input type="checkbox" name="is_outside_area" value="1"
                       class="rounded border-gray-300 dark:border-gray-600"
                       @checked(old('is_outside_area'))>
                <span>Layanan untuk luar area?</span>
            </label>
            @error('is_outside_area')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="image" class="block font-medium mb-1">Gambar (opsional)</label>
            <input type="file" name="image" id="image"
                   class="w-full text-sm text-gray-600 dark:text-gray-200 file:mr-4 file:py-2 file:px-4 file:border file:border-gray-300 file:rounded file:bg-gray-50 file:text-sm file:font-semibold hover:file:bg-gray-100 dark:file:bg-gray-700 dark:file:text-white dark:file:border-gray-600 @error('image') border-red-500 @enderror">
            @error('image')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-3">
            <img id="image-preview" class="w-32 h-32 object-cover rounded hidden" alt="Preview Gambar">
        </div>

        <div class="flex justify-end">
            <a href="{{ route('admin.services.index') }}"
               class="px-4 py-2 mr-3 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 rounded text-sm">
                Batal
            </a>
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white dark:text-white px-4 py-2 rounded shadow text-sm">
                Simpan
            </button>
        </div>
    </form>
@endsection

@push('scripts')
<script>
    document.getElementById('image').addEventListener('change', function (event) {
        const preview = document.getElementById('image-preview');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            };

            reader.readAsDataURL(file);
        } else {
            preview.src = '';
            preview.classList.add('hidden');
        }
    });
</script>
@endpush

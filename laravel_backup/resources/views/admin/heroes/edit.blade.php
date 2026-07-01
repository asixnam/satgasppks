@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-white p-6">
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Edit Hero</h1>
        <a href="{{ route('admin.hero.index') }}" 
           class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg font-medium transition duration-200 shadow-sm">
            ← Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="max-w-2xl mx-auto">
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-8">
            <form action="{{ route('admin.hero.update', $hero->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                
                <!-- Nama Gambar Field -->
                <div>
                    <label for="nama_gambar" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Gambar <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="nama_gambar"
                           name="nama_gambar" 
                           value="{{ old('nama_gambar', $hero->nama_gambar) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                           placeholder="Masukkan nama hero..."
                           required>
                    @error('nama_gambar')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Gambar Lama -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Saat Ini:</label>
                    <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                        <img src="{{ asset('storage/' . $hero->gambar) }}" 
                             class="max-w-full h-48 object-contain mx-auto" 
                             alt="{{ $hero->nama_gambar }}">
                    </div>
                </div>
                
                <!-- Upload Gambar Baru Field -->
                <div>
                    <label for="gambar" class="block text-sm font-medium text-gray-700 mb-2">
                        Upload Gambar Baru <span class="text-gray-500">(Opsional)</span>
                    </label>
                    <div class="relative">
                        <input type="file" 
                               id="gambar"
                               name="gambar" 
                               accept="image/*"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200 file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-sm file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                    </div>
                    <p class="text-gray-500 text-sm mt-1">Kosongkan jika tidak ingin mengubah gambar. Format: JPG, PNG, GIF. Maksimal 2MB</p>
                    @error('gambar')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image Preview for New Upload -->
                <div id="imagePreview" class="hidden">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Preview Gambar Baru:</label>
                    <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                        <img id="previewImg" src="" alt="Preview" class="max-w-full h-48 object-contain mx-auto">
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex justify-end gap-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.hero.index') }}" 
                       class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg font-medium transition duration-200">
                        Batal
                    </a>
                    <button type="submit" 
                            class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg font-medium transition duration-200 shadow-sm">
                        Update Hero
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript for Image Preview -->
<script>
document.getElementById('gambar').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    } else {
        preview.classList.add('hidden');
    }
});
</script>
@endsection
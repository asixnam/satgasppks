@extends('layouts.admin')

@section('content')
    <div class="min-h-screen bg-gray-50 py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Tambah Edukasi Baru</h1>
                        <p class="mt-2 text-sm text-gray-600">Buat konten edukasi untuk meningkatkan pengetahuan pengguna</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('admin.edukasis.index') }}" 
                           class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>

            <!-- Main Form Card -->
            <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
                <div class="px-8 py-6 bg-gradient-to-r from-green-600 to-green-700">
                    <h2 class="text-xl font-semibold text-white">Form Tambah Edukasi</h2>
                    <p class="text-green-100 text-sm mt-1">Lengkapi informasi di bawah ini dengan teliti</p>
                </div>

                <form action="{{ route('admin.edukasis.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
                    @csrf

                    <div class="space-y-8">
                        <!-- Judul Field -->
                        <div class="group">
                            <label for="judul" class="block text-sm font-semibold text-gray-900 mb-2">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                    Judul Edukasi
                                    <span class="text-red-500 ml-1">*</span>
                                </span>
                            </label>
                            <input type="text" 
                                   name="judul" 
                                   id="judul" 
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-100 transition-all duration-200 text-gray-900 placeholder-gray-400 @error('judul') border-red-300 focus:border-red-500 focus:ring-red-100 @enderror"
                                   value="{{ old('judul') }}" 
                                   placeholder="Masukkan judul yang menarik dan informatif"
                                   required>
                            @error('judul')
                                <div class="mt-2 flex items-center text-red-600 text-sm">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Konten Field -->
                        <div class="group">
                            <label for="konten" class="block text-sm font-semibold text-gray-900 mb-2">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    Konten Edukasi
                                    <span class="text-red-500 ml-1">*</span>
                                </span>
                            </label>
                            <div class="relative">
                                <textarea name="konten" 
                                          id="konten" 
                                          rows="8" 
                                          class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-100 transition-all duration-200 text-gray-900 placeholder-gray-400 resize-y @error('konten') border-red-300 focus:border-red-500 focus:ring-red-100 @enderror" 
                                          placeholder="Tulis konten edukasi yang bermanfaat dan mudah dipahami..."
                                          required>{{ old('konten') }}</textarea>
                                <div class="absolute bottom-3 right-3 text-xs text-gray-400">
                                    Minimum 50 karakter
                                </div>
                            </div>
                            @error('konten')
                                <div class="mt-2 flex items-center text-red-600 text-sm">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Gambar Field -->
                        <div class="group">
                            <label for="gambar" class="block text-sm font-semibold text-gray-900 mb-2">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    Gambar Pendukung
                                    <span class="text-gray-500 text-xs ml-2">(Opsional)</span>
                                </span>
                            </label>
                            <div class="relative">
                                <input type="file" 
                                       name="gambar" 
                                       id="gambar" 
                                       class="hidden"
                                       accept="image/*"
                                       onchange="previewImage(this)">
                                <label for="gambar" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors @error('gambar') border-red-300 bg-red-50 @enderror">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6" id="upload-placeholder">
                                        <svg class="w-8 h-8 mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                        </svg>
                                        <p class="mb-1 text-sm text-gray-500">
                                            <span class="font-semibold">Klik untuk upload</span> atau drag & drop
                                        </p>
                                        <p class="text-xs text-gray-400">PNG, JPG, WEBP (Maks. 5MB)</p>
                                    </div>
                                    <div class="hidden" id="preview-container">
                                        <img id="preview-image" class="h-28 w-auto rounded-lg object-cover" alt="Preview">
                                        <p class="text-xs text-gray-600 mt-2 text-center">Klik untuk mengganti</p>
                                    </div>
                                </label>
                            </div>
                            @error('gambar')
                                <div class="mt-2 flex items-center text-red-600 text-sm">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-10 pt-6 border-t border-gray-200">
                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('admin.edukasis.index') }}" 
                               class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-xl text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-200">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="inline-flex items-center px-8 py-3 border border-transparent rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Simpan Edukasi
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    </script>
@endsection
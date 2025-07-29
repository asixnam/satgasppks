{{-- resources/views/admin/edukasis/edit.blade.php --}}
@extends('layouts.admin')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h1 class="text-2xl font-bold text-gray-900">Edit Edukasi</h1>
                    <p class="mt-1 text-sm text-gray-600">Perbarui informasi edukasi yang sudah ada</p>
                </div>
            </div>

            <!-- Form Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <form action="{{ route('admin.edukasis.update', $edukasi->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="px-6 py-6 space-y-6">
                        <!-- Judul Field -->
                        <div class="space-y-2">
                            <label for="judul" class="block text-sm font-semibold text-gray-700">
                                Judul <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="judul" 
                                   id="judul" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200 text-gray-900 placeholder-gray-500"
                                   value="{{ old('judul', $edukasi->judul) }}"
                                   placeholder="Masukkan judul edukasi">
                            @error('judul')
                                <p class="text-red-500 text-sm mt-1 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Konten Field -->
                        <div class="space-y-2">
                            <label for="konten" class="block text-sm font-semibold text-gray-700">
                                Konten <span class="text-red-500">*</span>
                            </label>
                            <textarea name="konten" 
                                      id="konten" 
                                      rows="8"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200 text-gray-900 placeholder-gray-500 resize-vertical"
                                      placeholder="Masukkan konten edukasi...">{{ old('konten', $edukasi->konten) }}</textarea>
                            @error('konten')
                                <p class="text-red-500 text-sm mt-1 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Current Image Display -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">Gambar Saat Ini</label>
                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                @if ($edukasi->gambar)
                                    <div class="flex items-center space-x-4">
                                        <img src="{{ asset('storage/' . $edukasi->gambar) }}" 
                                             alt="Gambar Edukasi" 
                                             class="h-24 w-24 object-cover rounded-lg border border-gray-300 shadow-sm">
                                        <div class="flex-1">
                                            <p class="text-sm font-medium text-gray-700">Gambar tersimpan</p>
                                            <p class="text-xs text-gray-500 mt-1">Klik "Pilih File" di bawah untuk mengganti gambar</p>
                                        </div>
                                    </div>
                                @else
                                    <div class="text-center py-4">
                                        <svg class="w-12 h-12 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 48 48">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L32 26.414m-5-5l1.586-1.586a2 2 0 012.828 0L40 28M8 12v.01M16 12v.01M24 12v.01M32 12v.01"></path>
                                        </svg>
                                        <p class="text-sm text-gray-500">Tidak ada gambar tersimpan</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Upload New Image -->
                        <div class="space-y-2">
                            <label for="gambar" class="block text-sm font-semibold text-gray-700">
                                Ganti Gambar (opsional)
                            </label>
                            <div class="relative">
                                <input type="file" 
                                       name="gambar" 
                                       id="gambar" 
                                       accept="image/*"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-200 file:mr-4 file:py-2 file:px-4 file:rounded-l-lg file:border-0 file:text-sm file:font-medium file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                                <p class="text-xs text-gray-500 mt-1">Format yang didukung: JPG, PNG, GIF. Maksimal 2MB</p>
                            </div>
                            @error('gambar')
                                <p class="text-red-500 text-sm mt-1 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 rounded-b-lg">
                        <div class="flex items-center justify-end space-x-3">
                            <a href="{{ route('admin.edukasis.index') }}"
                               class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Batal
                            </a>
                            <button type="submit"
                                    class="inline-flex items-center px-6 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-lg shadow-sm hover:bg-green-700 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transform hover:scale-105 transition-all duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Perbarui Edukasi
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
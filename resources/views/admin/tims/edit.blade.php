@extends('layouts.admin')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-2xl mx-auto">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Edit Anggota Tim</h1>
                        <p class="text-gray-600 mt-1">Perbarui informasi anggota tim</p>
                    </div>
                    <a href="{{ route('tims.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali
                    </a>
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="px-8 py-6 bg-gradient-to-r from-blue-600 to-blue-700">
                    <h2 class="text-xl font-semibold text-white">Informasi Anggota</h2>
                </div>
                
                <form action="{{ route('tims.update', $tim->id) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <!-- Foto Section -->
                    <div class="space-y-4">
                        <label class="block text-sm font-medium text-gray-700">Foto Profil</label>
                        
                        @if ($tim->foto)
                            <div class="flex items-center space-x-6">
                                <div class="relative">
                                    <img src="{{ asset('storage/' . $tim->foto) }}" 
                                         class="w-24 h-24 object-cover rounded-full ring-4 ring-blue-100">
                                    <div class="absolute -bottom-1 -right-1 bg-green-500 rounded-full p-1">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Foto saat ini</p>
                                    <p class="text-xs text-gray-500">Upload foto baru untuk menggantinya</p>
                                </div>
                            </div>
                        @endif
                        
                        <div class="relative">
                            <input type="file" name="foto" id="foto" 
                                   class="hidden" accept="image/*" onchange="previewImage(event)">
                            <label for="foto" 
                                   class="flex items-center justify-center w-full px-4 py-3 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition-colors duration-200">
                                <div class="text-center">
                                    <svg class="mx-auto h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-600">
                                        <span class="font-medium text-blue-600">Klik untuk upload</span> atau drag & drop
                                    </p>
                                    <p class="text-xs text-gray-500">PNG, JPG, JPEG hingga 5MB</p>
                                </div>
                            </label>
                        </div>
                        
                        <!-- Preview for new image -->
                        <div id="imagePreview" class="hidden">
                            <img id="preview" class="w-24 h-24 object-cover rounded-full ring-4 ring-blue-100">
                            <p class="text-sm text-gray-600 mt-2">Preview foto baru</p>
                        </div>
                        
                        @error('foto')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Personal Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama -->
                        <div class="space-y-2">
                            <label for="nama" class="block text-sm font-medium text-gray-700">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="nama"
                                   name="nama" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('nama') border-red-500 @enderror" 
                                   value="{{ old('nama', $tim->nama) }}" 
                                   placeholder="Masukkan nama lengkap"
                                   required>
                            @error('nama')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jabatan -->
                        <div class="space-y-2">
                            <label for="jabatan" class="block text-sm font-medium text-gray-700">
                                Jabatan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="jabatan"
                                   name="jabatan" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('jabatan') border-red-500 @enderror" 
                                   value="{{ old('jabatan', $tim->jabatan) }}"
                                   placeholder="Contoh: Manager, Developer, Designer"
                                   required>
                            @error('jabatan')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="space-y-2">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700">
                            Deskripsi
                        </label>
                        <textarea id="deskripsi"
                                  name="deskripsi" 
                                  rows="4"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('deskripsi') border-red-500 @enderror"
                                  placeholder="Tulis deskripsi singkat tentang anggota tim...">{{ old('deskripsi', $tim->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                        <button type="submit" 
                                class="flex-1 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-medium py-3 px-6 rounded-lg transition-all duration-200 transform hover:scale-105 focus:ring-4 focus:ring-green-200">
                            <div class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Update Anggota
                            </div>
                        </button>
                        
                        <a href="{{ route('tims.index') }}" 
                           class="flex-1 sm:flex-none bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-3 px-6 rounded-lg transition-all duration-200 text-center">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript for Image Preview -->
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('preview');
            const previewContainer = document.getElementById('imagePreview');
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                previewContainer.classList.add('hidden');
            }
        }
        
        // Auto-hide success/error messages
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                alert.style.opacity = '0';
                setTimeout(function() {
                    alert.remove();
                }, 300);
            });
        }, 5000);
    </script>
@endsection
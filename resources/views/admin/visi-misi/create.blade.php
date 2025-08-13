@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-50 p-6">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Tambah Visi & Misi</h1>
            <p class="text-gray-600">Tambahkan visi dan misi organisasi Anda</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <form action="{{ route('admin.visi-misi.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label for="about" class="block text-sm font-medium text-gray-700 mb-2">
                        Tentang SATGAS PPKPT <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        name="about" 
                        id="about"
                        rows="4"
                        class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200 resize-none"
                        placeholder="Masukkan Deskripsi SATGAS PPKPT"
                        required
                    ></textarea>
                </div>

                <!-- Visi Section -->
                <div>
                    <label for="visi" class="block text-sm font-medium text-gray-700 mb-2">
                        Visi <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        name="visi" 
                        id="visi"
                        rows="4"
                        class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200 resize-none"
                        placeholder="Masukkan visi organisasi..."
                        required
                    ></textarea>
                </div>

                <!-- Misi Section -->
                <div>
                    <label for="misi" class="block text-sm font-medium text-gray-700 mb-2">
                        Misi <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        name="misi" 
                        id="misi"
                        rows="6"
                        class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200 resize-none"
                        placeholder="Masukkan misi organisasi..."
                        required
                    ></textarea>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('admin.visi-misi.index') }}" 
                       class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-200">
                        Batal
                    </a>
                    <button 
                        type="submit" 
                        class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-200 transition duration-200 font-medium">
                        <i class="fas fa-save mr-2"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
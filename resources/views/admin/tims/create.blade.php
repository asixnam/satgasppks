@extends('layouts.admin')

@section('content')
    <div class="max-w-xl mx-auto p-8 bg-white rounded-lg shadow-lg border border-gray-200">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Tambah Anggota Tim</h1>
        
        <form action="{{ route('tims.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-700">Nama</label>
                <input type="text" 
                       name="nama" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 bg-white" 
                       placeholder="Masukkan nama lengkap"
                       required>
            </div>
            
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-700">Jabatan</label>
                <input type="text" 
                       name="jabatan" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 bg-white" 
                       placeholder="Masukkan jabatan"
                       required>
            </div>
            
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-700">Deskripsi</label>
                <textarea name="deskripsi" 
                          rows="4"
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 bg-white resize-vertical" 
                          placeholder="Masukkan deskripsi (opsional)"></textarea>
            </div>
            
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-700">Foto</label>
                <div class="relative">
                    <input type="file" 
                           name="foto" 
                           accept="image/*"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 bg-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                </div>
                <p class="text-xs text-gray-500 mt-1">Format yang didukung: JPG, PNG, GIF (Max: 2MB)</p>
            </div>
            
            <div class="pt-4">
                <button type="submit" 
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-200 focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transform hover:scale-[1.02] active:scale-[0.98]">
                    <span class="flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Simpan Anggota Tim
                    </span>
                </button>
            </div>
        </form>
    </div>
@endsection
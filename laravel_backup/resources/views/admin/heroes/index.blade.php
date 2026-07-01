@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-white p-6">
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Kelola Hero</h1>
        <a href="{{ route('admin.hero.create') }}" 
           class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg font-medium transition duration-200 shadow-sm">
            + Tambah Hero
        </a>
    </div>

    <!-- Heroes Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($heroes as $hero)
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition duration-200 overflow-hidden">
                <!-- Image Container -->
                <div class="aspect-video bg-gray-50 flex items-center justify-center">
                    <img src="{{ asset('storage/' . $hero->gambar) }}" 
                         class="max-w-full max-h-full object-contain" 
                         alt="{{ $hero->nama_gambar }}">
                </div>
                
                <!-- Content -->
                <div class="p-4">
                    <h3 class="font-semibold text-gray-800 mb-3 truncate">{{ $hero->nama_gambar }}</h3>
                    
                    <!-- Action Buttons - Aligned Right -->
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('admin.hero.edit', $hero->id) }}" 
                           class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded text-sm font-medium transition duration-200">
                            Edit
                        </a>
                        
                        <form action="{{ route('admin.hero.destroy', $hero->id) }}" 
                              method="POST" 
                              class="inline" 
                              onsubmit="return confirm('Yakin ingin menghapus hero ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded text-sm font-medium transition duration-200">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Empty State -->
    @if($heroes->isEmpty())
        <div class="text-center py-12">
            <div class="text-gray-400 mb-4">
                <svg class="mx-auto h-16 w-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" 
                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-600 mb-2">Belum ada hero</h3>
            <p class="text-gray-500 mb-4">Mulai dengan menambahkan hero pertama Anda.</p>
            <a href="{{ route('admin.hero.create') }}" 
               class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg font-medium transition duration-200">
                + Tambah Hero Pertama
            </a>
        </div>
    @endif
</div>
@endsection
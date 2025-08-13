@extends('layouts.admin')

@section('content')
<div class="p-6 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Visi & Misi</h1>
            <p class="text-gray-600">Kelola Visi dan Misi SATGAS PPKS UNU Yogyakarta</p>
        </div>

        @if($data)
            <!-- Content Card -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                

                <div class="mb-8">
                    <div class="flex items-center mb-4">
                        <div class="w-1 h-8 bg-green-500 rounded-full mr-4"></div>
                        <h2 class="text-lg font-semibold text-gray-800">Tentang</h2>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 border-l-4 border-green-500">
                        <p class="text-gray-700 leading-relaxed">{{ $data->about }}</p>
                    </div>
                </div>
                <!-- Visi Section -->
                <div class="mb-8">
                    <div class="flex items-center mb-4">
                        <div class="w-1 h-8 bg-green-500 rounded-full mr-4"></div>
                        <h2 class="text-lg font-semibold text-gray-800">Visi</h2>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 border-l-4 border-green-500">
                        <p class="text-gray-700 leading-relaxed">{{ $data->visi }}</p>
                    </div>
                </div>

                <!-- Misi Section -->
                <div class="mb-8">
                    <div class="flex items-center mb-4">
                        <div class="w-1 h-8 bg-green-500 rounded-full mr-4"></div>
                        <h2 class="text-lg font-semibold text-gray-800">Misi</h2>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 border-l-4 border-green-500">
                        <ul class="space-y-3">
                            @foreach(explode("\n", $data->misi) as $item)
                                @if(trim($item))
                                    <li class="flex items-start">
                                        <div class="w-2 h-2 bg-green-500 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                                        <span class="text-gray-700">{{ trim($item) }}</span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Action Button -->
                <div class="pt-4 border-t border-gray-200">
                    <a href="{{ route('admin.visi-misi.edit', $data->id) }}" 
                       class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition duration-200 ease-in-out shadow-sm hover:shadow-md">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Visi & Misi
                    </a>
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-lg shadow-sm p-8 text-center">
                <div class="mb-6">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Belum ada data Visi & Misi</h3>
                    <p class="text-gray-600 mb-6">Mulai dengan menambahkan visi dan misi organisasi Anda</p>
                </div>
                
                <a href="{{ route('admin.visi-misi.create') }}" 
                   class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition duration-200 ease-in-out shadow-sm hover:shadow-md">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah Visi & Misi
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
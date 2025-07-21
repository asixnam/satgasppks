@extends('layouts.admin')

@section('content')
    <div class="min-h-screen bg-gray-50 p-6">
        <div class="max-w-6xl mx-auto bg-white rounded-lg shadow-lg p-6">
            <!-- Header Section -->
            <div class="flex justify-between items-center mb-6 border-b pb-4">
                <h1 class="text-3xl font-bold text-gray-800">Profil Tim</h1>
                <a href="{{ route('tims.create') }}" 
                   class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg font-medium transition duration-200 shadow-md hover:shadow-lg">
                    Tambah Anggota
                </a>
            </div>

            <!-- Table Section -->
            <div class="overflow-x-auto">
                <table class="w-full bg-white border border-gray-200 rounded-lg overflow-hidden">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 border-b">Nama</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 border-b">Jabatan</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 border-b">Foto</th>
                            <th class="px-6 py-4 text-right text-sm font-semibold text-gray-700 border-b">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tims as $tim)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-6 py-4 border-b border-gray-200 text-gray-800">{{ $tim->nama }}</td>
                                <td class="px-6 py-4 border-b border-gray-200 text-gray-600">{{ $tim->jabatan }}</td>
                                <td class="px-6 py-4 border-b border-gray-200">
                                    @if ($tim->foto)
                                        <img src="{{ asset('storage/' . $tim->foto) }}" 
                                             class="h-16 w-16 rounded-full object-cover shadow-sm"
                                             alt="Foto {{ $tim->nama }}">
                                    @else
                                        <div class="h-16 w-16 bg-gray-200 rounded-full flex items-center justify-center">
                                            <span class="text-gray-500 text-xs">No Photo</span>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 border-b border-gray-200 text-right">
                                    <div class="flex justify-end space-x-2">
                                        <a href="{{ route('tims.edit', $tim->id) }}" 
                                           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-200">
                                            Edit
                                        </a>
                                        <form action="{{ route('tims.destroy', $tim->id) }}" method="POST" class="inline"
                                              onsubmit="return confirm('Yakin hapus anggota {{ $tim->nama }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-200">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @if($tims->isEmpty())
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                        <p class="text-lg font-medium">Belum ada anggota tim</p>
                                        <p class="text-sm">Klik "Tambah Anggota" untuk menambahkan anggota baru</p>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
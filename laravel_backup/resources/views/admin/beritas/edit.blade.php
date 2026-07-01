@extends('layouts.admin')

@section('content')
    <div class="max-w-4xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Berita</h1>

      <form action="{{ route('admin.beritas.update', $berita) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow-md space-y-6">
            @csrf
            @method('PUT')

            <!-- Judul Field -->
            <div class="space-y-2">
                <label for="judul" class="block text-sm font-medium text-gray-700">Judul Berita</label>
                <input type="text" id="judul" name="judul" value="{{ old('judul', $berita->judul) }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition"
                    placeholder="Masukkan judul berita">
                @error('judul')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Isi Berita Field -->
            <div class="space-y-2">
                <label for="isi" class="block text-sm font-medium text-gray-700">Isi Berita</label>
                <textarea id="isi" name="isi" rows="8"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition"
                    placeholder="Tulis isi berita disini">{{ old('isi', $berita->isi) }}</textarea>
                @error('isi')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Gambar Field -->
            <div class="space-y-2">
                <label for="gambar" class="block text-sm font-medium text-gray-700">
                    Gambar Berita <span class="text-gray-500 font-normal">(biarkan kosong jika tidak diganti)</span>
                </label>

                <!-- File Input -->
                <div class="flex flex-col space-y-4">
                    <input type="file" id="gambar" name="gambar"
                        class="block w-full text-sm text-gray-500
                                  file:mr-4 file:py-2 file:px-4
                                  file:rounded-md file:border-0
                                  file:text-sm file:font-semibold
                                  file:bg-green-50 file:text-green-700
                                  hover:file:bg-green-100">

                    <!-- Current Image Preview -->
                    @if ($berita->gambar)
                        <div class="mt-2">
                            <p class="text-sm text-gray-500 mb-1">Gambar saat ini:</p>
                            <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita Saat Ini"
                                class="max-w-xs rounded-md shadow border border-gray-200">
                        </div>
                    @endif
                </div>

                @error('gambar')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.beritas.index') }}"
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                    Batal
                </a>
                <button type="submit"
                    class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                    Perbarui Berita
                </button>
            </div>
        </form>
    </div>
@endsection

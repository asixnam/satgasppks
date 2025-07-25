{{-- resources/views/admin/edukasis/edit.blade.php --}}
@extends('layouts.admin')

@section('content')
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Edit Edukasi</h1>

        <form action="{{ route('admin.edukasis.update', $edukasi->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="judul" class="block font-medium">Judul</label>
                <input type="text" name="judul" id="judul" class="w-full border rounded p-2"
                    value="{{ old('judul', $edukasi->judul) }}">
                @error('judul')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="konten" class="block font-medium">Konten</label>
                <textarea name="konten" id="konten" class="w-full border rounded p-2">{{ old('konten', $edukasi->konten) }}</textarea>
                @error('konten')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="gambar" class="block font-medium">Gambar Saat Ini</label><br>
                @if ($edukasi->gambar)
                    <img src="{{ asset('storage/' . $edukasi->gambar) }}" alt="gambar" class="h-24 mb-2">
                @else
                    <span>Tidak ada gambar</span>
                @endif
            </div>

            <div>
                <label for="gambar" class="block font-medium">Ganti Gambar (opsional)</label>
                <input type="file" name="gambar" id="gambar" class="w-full">
                @error('gambar')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        </form>
    </div>
@endsection

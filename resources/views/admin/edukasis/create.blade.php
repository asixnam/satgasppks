@extends('admin.dashboard')

@section('content')
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Tambah Edukasi</h1>

        <form action="{{ route('edukasis.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label for="judul" class="block font-medium">Judul</label>
                <input type="text" name="judul" id="judul" class="w-full border rounded p-2"
                    value="{{ old('judul') }}" required>
                @error('judul')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="konten" class="block font-medium">Konten</label>
                <textarea name="konten" id="konten" rows="5" class="w-full border rounded p-2" required>{{ old('konten') }}</textarea>
                @error('konten')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="gambar" class="block font-medium">Gambar (opsional)</label>
                <input type="file" name="gambar" id="gambar" class="w-full">
                @error('gambar')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
        </form>
    </div>
@endsection

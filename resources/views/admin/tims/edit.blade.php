@extends('admin.dashboard')

@section('content')
    <div class="max-w-xl mx-auto p-6 bg-white rounded shadow">
        <h1 class="text-xl font-bold mb-4">Edit Anggota Tim</h1>
        <form action="{{ route('tims.update', $tim->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label>Nama</label>
                <input type="text" name="nama" class="w-full border p-2" value="{{ old('nama', $tim->nama) }}" required>
            </div>
            <div class="mb-4">
                <label>Jabatan</label>
                <input type="text" name="jabatan" class="w-full border p-2" value="{{ old('jabatan', $tim->jabatan) }}"
                    required>
            </div>
            <div class="mb-4">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="w-full border p-2">{{ old('deskripsi', $tim->deskripsi) }}</textarea>
            </div>
            <div class="mb-4">
                <label>Foto Baru (opsional)</label>
                <input type="file" name="foto" class="w-full border p-2">
                @if ($tim->foto)
                    <p class="mt-2 text-sm">Foto saat ini:</p>
                    <img src="{{ asset('storage/' . $tim->foto) }}" class="w-24 h-24 object-cover rounded mt-1">
                @endif
            </div>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Update</button>
        </form>
    </div>
@endsection

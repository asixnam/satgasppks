@extends('admin.dashboard')

@section('content')
    <div class="max-w-xl mx-auto p-6 bg-white rounded shadow">
        <h1 class="text-xl font-bold mb-4">Tambah Anggota Tim</h1>
        <form action="{{ route('tims.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label>Nama</label>
                <input type="text" name="nama" class="w-full border p-2" required>
            </div>
            <div class="mb-4">
                <label>Jabatan</label>
                <input type="text" name="jabatan" class="w-full border p-2" required>
            </div>
            <div class="mb-4">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="w-full border p-2"></textarea>
            </div>
            <div class="mb-4">
                <label>Foto</label>
                <input type="file" name="foto" class="w-full border p-2">
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
        </form>
    </div>
@endsection

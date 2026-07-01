@extends('layouts.admin')

@section('title', 'Edit Laporan')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Edit Laporan</h1>

    <form method="POST" action="{{ route('admin.laporans.update', $laporan->id) }}">
        @csrf
        @method('PUT')

        <div class="bg-gray-100 p-4 rounded-lg mb-6">
            <h2 class="font-semibold text-lg mb-4">Data Pelapor</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="text" name="nama" value="{{ $laporan->nama }}" placeholder="Nama">
                <input type="text" name="hubungan" value="{{ $laporan->hubungan }}" placeholder="Hubungan">
                <input type="text" name="tempat_lahir" value="{{ $laporan->tempat_lahir }}" placeholder="Tempat Lahir">
                <input type="date" name="tanggal_lahir" value="{{ $laporan->tanggal_lahir }}">
                <input type="text" name="jenis_kelamin" value="{{ $laporan->jenis_kelamin }}" placeholder="Jenis Kelamin">
                <input type="number" name="usia" value="{{ $laporan->usia }}" placeholder="Usia">
                <input type="text" name="pekerjaan" value="{{ $laporan->pekerjaan }}" placeholder="Pekerjaan">
                <input type="text" name="no_telepon" value="{{ $laporan->no_telepon }}" placeholder="No. Telepon">
                <input type="text" name="alamat" value="{{ $laporan->alamat }}" placeholder="Alamat">
                <textarea name="keterangan" placeholder="Keterangan">{{ $laporan->keterangan }}</textarea>
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection

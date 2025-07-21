@extends('layouts.admin')

@section('title', 'Daftar Laporan')

@section('content')
<h1>Daftar Laporan</h1>
<a href="{{ route('laporans.create') }}">Tambah Laporan</a>
@foreach ($laporans as $laporan)
    <div>
        <h3>{{ $laporan->judul }}</h3>
        <p>{{ Str::limit($laporan->isi, 100) }}</p>
        <a href="{{ route('laporans.edit', $laporan->id) }}">Edit</a>
        <form action="{{ route('laporans.destroy', $laporan->id) }}" method="POST">
            @csrf @method('DELETE')
            <button type="submit">Hapus</button>
        </form>
    </div>
@endforeach
@show 
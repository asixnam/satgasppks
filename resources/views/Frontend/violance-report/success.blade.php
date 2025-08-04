@extends('Layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-green-50">
    <div class="bg-white p-8 rounded shadow text-center max-w-xl w-full">
        <h1 class="text-2xl font-bold text-green-600 mb-4">Laporan Berhasil Dikirim</h1>

        @if(session('success'))
            <p class="mb-4">{{ session('success') }}</p>
        @endif

        <div class="bg-gray-100 text-gray-800 p-4 rounded mb-4">
            <p class="font-semibold">Kode Laporan Anda:</p>
            <p class="text-lg font-mono">{{ $reportId }}</p>
        </div>

        <a href="{{ route('home') }}" class="text-blue-600 hover:underline">Kembali ke Beranda</a>
    </div>
</div>
@endsection

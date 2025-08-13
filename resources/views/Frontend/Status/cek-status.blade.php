@extends('Layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 flex flex-col items-center justify-start py-12 px-4">
    <!-- Header Section -->
    <div class="text-center mb-8 mt-16">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-600 rounded-full mb-4">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
        </div>
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Cek Status Laporan</h1>
        <p class="text-gray-600">Masukkan nomor tiket untuk melihat status laporan Anda</p>
    </div>

    <!-- Form Card -->
    <div class="w-full max-w-xl bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
        <div class="p-8">
            @if($error)
                <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded-r-lg mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700 font-medium">{{ $error }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <form method="GET" action="{{ route('cek-status') }}" class="space-y-6">
                <div>
                    <label for="ticket_number" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nomor Tiket
                    </label>
                    <div class="relative">
                        <input 
                            type="text" 
                            name="ticket_number" 
                            id="ticket_number" 
                            class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-gray-700 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 focus:outline-none transition-all duration-200 placeholder-gray-400"
                            placeholder="Contoh: PPKS-2024-000001"
                            value="{{ request('ticket_number') }}"
                            required
                        >
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m0 0a2 2 0 012 2m-2-2h-3m-9 1V7a2 2 0 012-2h3m0 0a2 2 0 012 2v1M9 7h3"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold py-3 px-6 rounded-xl hover:from-blue-700 hover:to-blue-800 focus:ring-4 focus:ring-blue-200 focus:outline-none transform hover:scale-[1.02] transition-all duration-200 shadow-lg">
                    <span class="flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Cek Status Laporan
                    </span>
                </button>
            </form>
        </div>
    </div>

    <!-- Result Card -->
    @if($report)
        <div class="w-full max-w-xl mt-8 bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-8 py-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-bold text-white">Status Laporan Ditemukan</h3>
                        <p class="text-green-100 text-sm">Informasi lengkap laporan Anda</p>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="p-8 space-y-4">
                <div class="grid grid-cols-1 gap-4">
                    <div class="flex justify-between items-center py-3 border-b border-gray-100">
                        <span class="text-gray-600 font-medium">Nomor Tiket</span>
                        <span class="text-gray-900 font-semibold bg-gray-100 px-3 py-1 rounded-full text-sm">
                            {{ $report->code }}
                        </span>
                    </div>

                    <div class="flex justify-between items-center py-3 border-b border-gray-100">
                        <span class="text-gray-600 font-medium">Status</span>
                        <span class="px-3 py-1 rounded-full text-sm font-semibold
                            @if($report->status == 'Selesai') 
                                bg-green-100 text-green-800
                            @elseif($report->status == 'Diproses') 
                                bg-yellow-100 text-yellow-800
                            @elseif($report->status == 'Ditolak') 
                                bg-red-100 text-red-800
                            @else 
                                bg-blue-100 text-blue-800
                            @endif">
                            {{ $report->status }}
                        </span>
                    </div>

                    <div class="flex justify-between items-center py-3 border-b border-gray-100">
                        <span class="text-gray-600 font-medium">Tanggal Lapor</span>
                        <span class="text-gray-900 font-semibold">
                            {{ $report->created_at->format('d M Y, H:i') }}
                        </span>
                    </div>

                    <div class="flex justify-between items-center py-3">
                        <span class="text-gray-600 font-medium">Pelapor</span>
                        <span class="text-gray-900 font-semibold">
                            {{ $report->reporter->name ?? 'Anonim' }}
                        </span>
                    </div>
                </div>

                <!-- Additional Info -->
                <div class="mt-6 p-4 bg-blue-50 rounded-xl border border-blue-100">
                    <div class="flex items-start">
                        <svg class="flex-shrink-0 h-5 w-5 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div class="ml-3">
                            <h4 class="text-sm font-semibold text-blue-800">Informasi</h4>
                            <p class="text-sm text-blue-700 mt-1">
                                Jika ada pertanyaan lebih lanjut mengenai laporan ini, silakan hubungi tim support dengan menyertakan nomor tiket.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Help Section -->
    <div class="w-full max-w-xl mt-8 text-center">
        <p class="text-gray-600 text-sm">
            Tidak dapat menemukan nomor tiket Anda? 
            <a href="{{ route('cek-status') }}" class="text-blue-600 hover:text-blue-800 font-semibold hover:underline transition-colors">
                Cek Satatus Pelaporan
            </a>
        </p>
    </div>
</div>
@endsection
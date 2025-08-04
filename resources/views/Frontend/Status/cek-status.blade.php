@extends('Layouts.app')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-start py-12 px-4">
    <div class="w-full max-w-xl bg-white p-6 rounded-xl shadow-md">

        <h2 class="text-2xl font-bold mb-6 text-center">Cek Status Laporan</h2>

        @if($error)
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                {{ $error }}
            </div>
        @endif

        <form method="GET" action="{{ route('cek-status') }}">
            <label for="ticket_number" class="block mb-2 font-semibold">Nomor Tiket</label>
            <input 
                type="text" 
                name="ticket_number" 
                id="ticket_number" 
                class="w-full border border-gray-300 rounded px-4 py-2 mb-4"
                placeholder="PPKS-2024-000001"
                value="{{ request('ticket_number') }}"
                required
            >

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                Cek Status
            </button>
        </form>
    </div>

    @if($report)
        <div class="w-full max-w-xl mt-8 bg-green-50 border border-green-300 p-6 rounded-lg shadow">
            <h3 class="text-xl font-bold text-green-800 mb-4">Status Laporan</h3>

            <p><strong>Nomor Tiket:</strong> {{ $report->code }}</p>
            <p><strong>Status:</strong> {{ $report->status }}</p>
            <p><strong>Tanggal Lapor:</strong> {{ $report->created_at->format('d M Y') }}</p>
            <p><strong>Pelapor:</strong> {{ $report->reporter->name ?? '-' }}</p>
        </div>
    @endif
</div>
@endsection

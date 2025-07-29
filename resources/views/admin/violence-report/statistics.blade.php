@extends('layouts.admin')

@section('title', 'Statistik Laporan Kekerasan')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Statistik Laporan Kekerasan</h2>
        <div class="flex gap-3">
            <a href="{{ route('admin.violence-reports.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                ← Kembali
            </a>
            <button onclick="exportStatistics()" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                ↓ Export
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white p-6 rounded-lg shadow border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 uppercase">Total Laporan</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($totalReports) }}</p>
                </div>
                <div class="text-3xl text-gray-400">📄</div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow border-l-4 border-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 uppercase">Korban Disable</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($disableVictims) }}</p>
                </div>
                <div class="text-3xl text-gray-400">♿</div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow border-l-4 border-cyan-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 uppercase">Laporan Bulan Ini</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($recentReports) }}</p>
                </div>
                <div class="text-3xl text-gray-400">📅</div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 uppercase">Tingkat Pemrosesan</p>
                    <p class="text-2xl font-bold text-gray-900">
                        {{ $totalReports > 0 ? number_format(($totalReports - $disableVictims) / $totalReports * 100, 1) : 0 }}%
                    </p>
                </div>
                <div class="text-3xl text-gray-400">📈</div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Violence Type Chart -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Jenis Kekerasan (Top 5)</h3>
            @if($violenceTypes->count() > 0)
                <div class="mb-4">
                    <canvas id="violenceTypeChart" class="max-h-64"></canvas>
                </div>
                <div class="space-y-2">
                    @foreach($violenceTypes as $type)
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-700">{{ $type->jenis_kekerasan }}</span>
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">{{ $type->total }}</span>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-500 py-8">Belum ada data jenis kekerasan</p>
            @endif
        </div>

        <!-- Gender Distribution Chart -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Distribusi Jenis Kelamin Korban</h3>
            @if($genderStats->count() > 0)
                <div class="mb-4">
                    <canvas id="genderChart" class="max-h-64"></canvas>
                </div>
                <div class="flex justify-center gap-4 text-sm">
                    @foreach($genderStats as $gender)
                        <span class="flex items-center gap-1">
                            <div class="w-3 h-3 rounded-full {{ $gender->jenis_kelamin == 'Laki-laki' ? 'bg-blue-500' : 'bg-green-500' }}"></div>
                            {{ $gender->jenis_kelamin }}: {{ $gender->total }}
                        </span>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-500 py-8">Belum ada data distribusi gender</p>
            @endif
        </div>
    </div>

    <!-- Additional Statistics -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Victim Status -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Status Korban</h3>
            @if(isset($victimStatusStats) && $victimStatusStats->count() > 0)
                <div class="space-y-3">
                    @foreach($victimStatusStats as $status)
                        <div>
                            <div class="flex justify-between items-center mb-1">
                                <span class="font-medium text-gray-700">{{ $status->status_korban }}</span>
                                <span class="px-2 py-1 text-xs rounded {{ $status->status_korban == 'Disable' ? 'bg-yellow-100 text-yellow-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ $status->total }}
                                </span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="h-2 rounded-full {{ $status->status_korban == 'Disable' ? 'bg-yellow-500' : 'bg-blue-500' }}" 
                                     style="width: {{ $totalReports > 0 ? ($status->total / $totalReports) * 100 : 0 }}%">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-500">Belum ada data status korban</p>
            @endif
        </div>

        <!-- Perpetrator Relationship -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Hubungan Pelaku dengan Korban</h3>
            @if(isset($perpetratorRelationStats) && $perpetratorRelationStats->count() > 0)
                <div class="space-y-3">
                    @foreach($perpetratorRelationStats as $relation)
                        <div>
                            <div class="flex justify-between items-center mb-1">
                                <span class="font-medium text-gray-700">{{ $relation->hubungan_dengan_korban }}</span>
                                <span class="px-2 py-1 bg-gray-100 text-gray-800 text-xs rounded">{{ $relation->total }}</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-gray-500 h-2 rounded-full" 
                                     style="width: {{ $totalReports > 0 ? ($relation->total / $totalReports) * 100 : 0 }}%">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-500">Belum ada data hubungan pelaku</p>
            @endif
        </div>
    </div>

    <!-- Monthly Reports Chart -->
    @if(isset($monthlyReports) && $monthlyReports->count() > 0)
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Tren Laporan Bulanan (6 Bulan Terakhir)</h3>
        <canvas id="monthlyChart" class="max-h-80"></canvas>
    </div>
    @endif
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Violence Type Chart
@if($violenceTypes->count() > 0)
var ctx1 = document.getElementById('violenceTypeChart').getContext('2d');
var violenceTypeChart = new Chart(ctx1, {
    type: 'doughnut',
    data: {
        labels: {!! json_encode($violenceTypes->pluck('jenis_kekerasan')) !!},
        datasets: [{
            data: {!! json_encode($violenceTypes->pluck('total')) !!},
            backgroundColor: ['#3b82f6', '#10b981', '#06b6d4', '#f59e0b', '#ef4444'],
            borderWidth: 2,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { position: 'bottom' } }
    }
});
@endif

// Gender Chart
@if($genderStats->count() > 0)
var ctx2 = document.getElementById('genderChart').getContext('2d');
var genderChart = new Chart(ctx2, {
    type: 'pie',
    data: {
        labels: {!! json_encode($genderStats->pluck('jenis_kelamin')) !!},
        datasets: [{
            data: {!! json_encode($genderStats->pluck('total')) !!},
            backgroundColor: ['#3b82f6', '#10b981'],
            borderWidth: 2,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { position: 'bottom' } }
    }
});
@endif

// Monthly Chart
@if(isset($monthlyReports) && $monthlyReports->count() > 0)
var ctx3 = document.getElementById('monthlyChart').getContext('2d');
var monthlyChart = new Chart(ctx3, {
    type: 'line',
    data: {
        labels: {!! json_encode($monthlyReports->map(function($item) { return $item->year . '-' . str_pad($item->month, 2, '0', STR_PAD_LEFT); })) !!},
        datasets: [{
            label: 'Jumlah Laporan',
            data: {!! json_encode($monthlyReports->pluck('total')) !!},
            borderColor: '#3b82f6',
            backgroundColor: 'rgba(59, 130, 246, 0.1)',
            borderWidth: 2,
            fill: true
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: { y: { beginAtZero: true } }
    }
});
@endif

function exportStatistics() {
    window.location.href = "{{ route('admin.violence-reports.export-statistics') }}";
}
</script>
@endpush
@endsection
@extends('layouts.admin')

@section('title', 'Detail Laporan Kekerasan')

@section('content')
<div class="min-h-screen bg-gray-50 p-4">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <h1 class="text-2xl font-semibold text-gray-900">Detail Laporan Kekerasan</h1>
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ url('/admin/violence-reports/' . $report->id . '/edit') }}" 
                            class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-lg transition-colors duration-200 inline-flex items-center text-sm">
                            <i class="fas fa-edit mr-2"></i>
                            Edit
                        </a>
                        <a href="{{ route('admin.violence-reports.index') }}" 
                           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-colors duration-200 inline-flex items-center text-sm">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="space-y-6">
            <!-- First Row: Client & Reporter -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Client Information -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-green-600 px-6 py-4">
                        <h2 class="text-lg font-semibold text-white flex items-center">
                            <i class="fas fa-user mr-2"></i>
                            Data Klien (Korban)
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Nama Lengkap:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->client->nama_lengkap ?? '-' }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Jenis Kelamin:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->client->jenis_kelamin ?? '-' }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Status Korban:</span>
                                <span class="flex-1">
                                    @if($report->client->status_korban ?? null)
                                        @php
                                            $badgeClass = $report->client->status_korban === 'Disable' 
                                                ? 'bg-red-100 text-red-800' 
                                                : 'bg-green-100 text-green-800';
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $badgeClass }}">
                                            {{ $report->client->status_korban }}
                                        </span>
                                    @else
                                        <span class="text-sm text-gray-900">-</span>
                                    @endif
                                </span>
                            </div>
                            @if($report->client->status_korban === 'Disable' && $report->client->kategori_disable)
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Kategori Disable:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->client->kategori_disable }}</span>
                            </div>
                            @endif
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Status:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->client->status ?? '-' }}</span>
                            </div>
                            @if($report->client->sumber_informasi)
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Sumber Informasi:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->client->sumber_informasi }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Reporter Information -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-blue-600 px-6 py-4">
                        <h2 class="text-lg font-semibold text-white flex items-center">
                            <i class="fas fa-user-tie mr-2"></i>
                            Data Pelapor
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Nama Lengkap:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->reporter->nama_lengkap ?? '-' }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Hubungan dengan Pelaku:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->reporter->hubungan_pelapor_dengan_pelaku ?? '-' }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Tempat Lahir:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->reporter->tempat_lahir ?? '-' }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Tanggal Lahir:</span>
                                <span class="flex-1 text-sm text-gray-900">
                                    @if($report->reporter->tanggal_lahir)
                                        {{ \Carbon\Carbon::parse($report->reporter->tanggal_lahir)->format('d/m/Y') }}
                                    @else
                                        -
                                    @endif
                                </span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Jenis Kelamin:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->reporter->jenis_kelamin ?? '-' }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Usia:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->reporter->usia ?? '-' }} {{ $report->reporter->usia ? 'tahun' : '' }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Status Pelapor:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->reporter->status_pelapor ?? '-' }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">No. Telepon:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->reporter->no_telepon ?? '-' }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Alamat:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->reporter->alamat ?? '-' }}</span>
                            </div>
                            @if($report->reporter->keterangan_tambahan)
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Keterangan Tambahan:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->reporter->keterangan_tambahan }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Second Row: Perpetrator & Violence -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Perpetrator Information -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-orange-500 px-6 py-4">
                        <h2 class="text-lg font-semibold text-white flex items-center">
                            <i class="fas fa-user-times mr-2"></i>
                            Data Pelaku
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Nama Pelaku:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->perpetrator->nama ?? '-' }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Hubungan dengan Korban:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->perpetrator->hubungan_dengan_korban ?? '-' }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">No. Telepon:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->perpetrator->telepon ?? '-' }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Jenis Kelamin:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->perpetrator->jenis_kelamin ?? '-' }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Keterangan:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->perpetrator->keterangan ?? '-' }}</span>
                            </div>
                            @if($report->perpetrator->upload_bukti && is_array($report->perpetrator->upload_bukti) && count($report->perpetrator->upload_bukti) > 0)
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Upload Bukti:</span>
                                <div class="flex-1">
                                    @foreach($report->perpetrator->upload_bukti as $bukti)
                                        <div class="mb-1">
                                            <a href="{{ $bukti }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm underline">
                                                Lihat Bukti {{ $loop->iteration }}
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Violence Information -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-red-600 px-6 py-4">
                        <h2 class="text-lg font-semibold text-white flex items-center">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            Data Kekerasan
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Jenis Kekerasan:</span>
                                <span class="flex-1">
                                    @if($report->violance && $report->violance->jenis_kekerasan)
                                        @php
                                            $badgeClasses = match(strtolower($report->violance->jenis_kekerasan)) {
                                                'fisik' => 'bg-red-100 text-red-800',
                                                'psikis', 'psikologis' => 'bg-yellow-100 text-yellow-800',
                                                'seksual' => 'bg-purple-100 text-purple-800',
                                                'ekonomi' => 'bg-blue-100 text-blue-800',
                                                default => 'bg-gray-100 text-gray-800'
                                            };
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $badgeClasses }}">
                                            {{ $report->violance->jenis_kekerasan }}
                                        </span>
                                    @else
                                        <span class="text-sm text-gray-900">-</span>
                                    @endif
                                </span>
                            </div>
                            
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Bentuk Kekerasan:</span>
                                <div class="flex-1">
                                    @if($report->violance && $report->violance->bentuk_kekerasan)
                                        @if(is_array($report->violance->bentuk_kekerasan))
                                            @foreach($report->violance->bentuk_kekerasan as $bentuk)
                                                <span class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded mr-1 mb-1">
                                                    {{ $bentuk }}
                                                </span>
                                            @endforeach
                                        @else
                                            <span class="text-sm text-gray-900">{{ $report->violance->bentuk_kekerasan }}</span>
                                        @endif
                                    @else
                                        <span class="text-sm text-gray-900">-</span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Lokasi Kejadian:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->violance->lokasi_kejadian ?? '-' }}</span>
                            </div>
                            
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Waktu Kejadian:</span>
                                <span class="flex-1 text-sm text-gray-900">
                                    @if($report->violance->waktu_kejadian)
                                        {{ \Carbon\Carbon::parse($report->violance->waktu_kejadian)->format('d/m/Y H:i') }}
                                    @else
                                        -
                                    @endif
                                </span>
                            </div>
                        </div>
                        
                        @if($report->violance && $report->violance->deskripsi_kekerasan)
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <h3 class="text-sm font-medium text-gray-700 mb-3">Deskripsi Kekerasan:</h3>
                            <div class="bg-gray-50 p-4 rounded-lg text-sm text-gray-900 leading-relaxed">
                                {{ $report->violance->deskripsi_kekerasan }}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Report Information -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-gray-600 px-6 py-4">
                    <h2 class="text-lg font-semibold text-white flex items-center">
                        <i class="fas fa-info-circle mr-2"></i>
                        Informasi Laporan
                    </h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-3">
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">ID Laporan:</span>
                                <span class="flex-1 text-sm text-gray-900 font-mono">{{ $report->id }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Tanggal Dibuat:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Terakhir Update:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->updated_at->format('d/m/Y H:i') }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Status:</span>
                                <span class="flex-1">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Aktif
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Actions -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mt-6">
            <div class="px-6 py-4">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                    <a href="{{ route('admin.violence-reports.index') }}" 
                       class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition-colors duration-200 inline-flex items-center text-sm">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali ke Daftar
                    </a>
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ url('/admin/violence-reports/' . $report->id . '/edit') }}" 
                            class="bg-amber-500 hover:bg-amber-600 text-white px-6 py-2 rounded-lg transition-colors duration-200 inline-flex items-center text-sm">
                            <i class="fas fa-edit mr-2"></i>
                            Edit Laporan
                        </a>
                        <button type="button" onclick="deleteReport('{{ $report->id }}')" 
                                class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-lg transition-colors duration-200 inline-flex items-center text-sm">
                            <i class="fas fa-trash mr-2"></i>
                            Hapus Laporan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function deleteReport(id) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#059669',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading
            Swal.fire({
                title: 'Menghapus...',
                text: 'Sedang memproses penghapusan data',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });

            // Perform delete with fetch
            fetch(`/admin/violence-reports/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                Swal.fire({
                    icon: 'success',
                    title: 'Terhapus!',
                    text: 'Data berhasil dihapus',
                    timer: 2000,
                    showConfirmButton: false,
                    confirmButtonColor: '#059669'
                }).then(() => {
                    window.location.href = '/admin/violence-reports';
                });
            })
            .catch(error => {
                console.error('Delete error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Gagal menghapus data',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#059669'
                });
            });
        }
    });
}
</script>
@endsection
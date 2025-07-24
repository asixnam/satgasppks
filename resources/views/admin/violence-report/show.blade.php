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
                        <a href="{{ url('/admin/violence-reports') }}" 
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
                                <span class="w-2/5 text-sm font-medium text-gray-700">NIM:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->client->nim ?? '-' }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Program Studi:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->client->program_studi ?? '-' }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Fakultas:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->client->fakultas ?? '-' }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Angkatan:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->client->angkatan ?? '-' }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Tempat Lahir:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->client->tempat_lahir ?? '-' }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Tanggal Lahir:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->client->tanggal_lahir ? $report->client->tanggal_lahir->format('d/m/Y') : '-' }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Agama:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->client->agama ?? '-' }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Status Perkawinan:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->client->status_perkawinan ?? '-' }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Sumber Rujukan:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->client->sumber_rujukan ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reporter Information -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-green-500 px-6 py-4">
                        <h2 class="text-lg font-semibold text-white flex items-center">
                            <i class="fas fa-user-tie mr-2"></i>
                            Data Pelapor
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Nama:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->reporter->nama ?? '-' }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Hubungan:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->reporter->hubungan ?? '-' }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Tempat Lahir:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->reporter->tempat_lahir ?? '-' }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Tanggal Lahir:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->reporter->tanggal_lahir ? $report->reporter->tanggal_lahir->format('d/m/Y') : '-' }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Jenis Kelamin:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->reporter->jenis_kelamin == 'L' ? 'Laki-laki' : ($report->reporter->jenis_kelamin == 'P' ? 'Perempuan' : '-') }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Usia:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->reporter->usia ?? '-' }} tahun</span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Pekerjaan:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->reporter->pekerjaan ?? '-' }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">No. Telepon:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->reporter->no_telepon ?? '-' }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Alamat:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->reporter->alamat ?? '-' }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Keterangan:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->reporter->keterangan ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Second Row: Perpetrator & Violence -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Perpetrator Information -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-amber-500 px-6 py-4">
                        <h2 class="text-lg font-semibold text-white flex items-center">
                            <i class="fas fa-user-times mr-2"></i>
                            Data Pelaku
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Nama Pelaku:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->perpetrator->nama_pelaku ?? '-' }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Hubungan dengan Korban:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->perpetrator->hubungan_dengan_korban ?? '-' }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">NIK:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->perpetrator->nik_pelaku ?? '-' }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Jenis Kelamin:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->perpetrator->jenis_kelamin_pelaku == 'L' ? 'Laki-laki' : ($report->perpetrator->jenis_kelamin_pelaku == 'P' ? 'Perempuan' : '-') }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Umur:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->perpetrator->umur_pelaku ?? '-' }} tahun</span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Tempat Lahir:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->perpetrator->tempat_lahir_pelaku ?? '-' }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Tanggal Lahir:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->perpetrator->tanggal_lahir_pelaku ? $report->perpetrator->tanggal_lahir_pelaku->format('d/m/Y') : '-' }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Agama:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->perpetrator->agama_pelaku ?? '-' }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Pekerjaan:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->perpetrator->pekerjaan_pelaku ?? '-' }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">No. Telepon:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->perpetrator->telepon_pelaku ?? '-' }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Alamat:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->perpetrator->alamat_pelaku ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Violence Information -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-red-500 px-6 py-4">
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
                                            $badgeClasses = match($report->violance->jenis_kekerasan) {
                                                'Fisik' => 'bg-red-100 text-red-800',
                                                'Psikis' => 'bg-yellow-100 text-yellow-800',
                                                'Seksual' => 'bg-purple-100 text-purple-800',
                                                'Ekonomi' => 'bg-blue-100 text-blue-800',
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
                                <span class="w-2/5 text-sm font-medium text-gray-700">Waktu Kejadian:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->violance->waktu_kejadian ? $report->violance->waktu_kejadian->format('d/m/Y H:i') : '-' }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Lokasi Kejadian:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->violance->lokus_kejadian ?? '-' }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Kategori Pidana:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->violance->kategori_pidana ?? '-' }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Bentuk Kekerasan:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->violance->bentuk_kekerasan ?? '-' }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-2/5 text-sm font-medium text-gray-700">Keterangan Pihak Ke-3:</span>
                                <span class="flex-1 text-sm text-gray-900">{{ $report->violance->keterangan_pihak_ke3 ?? '-' }}</span>
                            </div>
                        </div>
                        
                        @if($report->violance && $report->violance->narasi_kronologis)
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <h3 class="text-sm font-medium text-gray-700 mb-3">Narasi Kronologis:</h3>
                            <div class="bg-gray-50 p-4 rounded-lg text-sm text-gray-900 leading-relaxed">
                                {{ $report->violance->narasi_kronologis }}
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
                    <a href="{{ url('/admin/violence-reports') }}" 
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
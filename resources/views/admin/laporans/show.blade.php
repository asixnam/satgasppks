@extends('admin.dashboard')

@section('content')
    <div class="w-full h-full overflow-y-auto">
        <div class="container mx-auto p-6 pb-20">
            <div class="bg-white rounded-xl shadow-lg max-w-none">
                <!-- Header -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-6">
                    <h2 class="text-2xl font-bold">Detail Laporan</h2>
                </div>

                <!-- Main Content -->
                <div class="p-6">
                    <!-- Two Column Section -->
                    <div class="flex flex-col md:flex-row gap-6 mb-8">
                        <!-- Left Column: Reporter Data -->
                        <div class="w-full md:w-1/2 bg-gray-50 rounded-lg p-6 shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2 flex items-center">
                                <i class="fas fa-user-circle mr-2 text-blue-600"></i>Data Pelapor
                            </h3>
                            @forelse ($laporans as $laporan)
                                <div class="space-y-4">
                                    <div class="grid grid-cols-3 gap-2">
                                        <span class="font-medium text-gray-600">Nama:</span>
                                        <span
                                            class="text-gray-800 col-span-2">{{ $laporan->nama ?? 'Tidak tersedia' }}</span>
                                    </div>
                                    <div class="grid grid-cols-3 gap-2">
                                        <span class="font-medium text-gray-600">Hubungan:</span>
                                        <span
                                            class="text-gray-800 col-span-2">{{ $laporan->hubungan ?? 'Tidak tersedia' }}</span>
                                    </div>
                                    <div class="grid grid-cols-3 gap-2">
                                        <span class="font-medium text-gray-600">Tempat Lahir:</span>
                                        <span
                                            class="text-gray-800 col-span-2">{{ $laporan->tempat_lahir ?? 'Tidak tersedia' }}</span>
                                    </div>
                                    <div class="grid grid-cols-3 gap-2">
                                        <span class="font-medium text-gray-600">Tanggal Lahir:</span>
                                        <span class="text-gray-800 col-span-2">
                                            @if ($laporan->tanggal_lahir)
                                                {{ \Carbon\Carbon::parse($laporan->tanggal_lahir)->format('d M Y') }}
                                            @else
                                                Tidak tersedia
                                            @endif
                                        </span>
                                    </div>
                                    <div class="grid grid-cols-3 gap-2">
                                        <span class="font-medium text-gray-600">Jenis Kelamin:</span>
                                        <span
                                            class="text-gray-800 col-span-2 capitalize">{{ $laporan->jenis_kelamin ?? 'Tidak tersedia' }}</span>
                                    </div>
                                    <div class="grid grid-cols-3 gap-2">
                                        <span class="font-medium text-gray-600">Usia:</span>
                                        <span class="text-gray-800 col-span-2">
                                            {{ $laporan->usia ? $laporan->usia . ' tahun' : 'Tidak tersedia' }}
                                        </span>
                                    </div>
                                    <div class="grid grid-cols-3 gap-2">
                                        <span class="font-medium text-gray-600">Pekerjaan:</span>
                                        <span
                                            class="text-gray-800 col-span-2">{{ $laporan->pekerjaan ?? 'Tidak disebutkan' }}</span>
                                    </div>
                                    <div class="grid grid-cols-3 gap-2">
                                        <span class="font-medium text-gray-600">No. Telepon:</span>
                                        <span
                                            class="text-gray-800 col-span-2">{{ $laporan->no_telepon ?? 'Tidak ada' }}</span>
                                    </div>
                                    <div class="grid grid-cols-3 gap-2">
                                        <span class="font-medium text-gray-600">Alamat:</span>
                                        <span
                                            class="text-gray-800 col-span-2">{{ $laporan->alamat ?? 'Tidak tersedia' }}</span>
                                    </div>
                                    @if ($laporan->keterangan)
                                        <div class="grid grid-cols-3 gap-2">
                                            <span class="font-medium text-gray-600">Keterangan:</span>
                                            <span class="text-gray-800 col-span-2">{{ $laporan->keterangan }}</span>
                                        </div>
                                    @endif
                                </div>
                            @empty
                                <p class="text-gray-500 italic">Tidak ada data pelapor tersedia.</p>
                            @endforelse
                        </div>

                        <!-- Right Column: Client Data -->
                        <div class="w-full md:w-1/2 bg-gray-50 rounded-lg p-6 shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2 flex items-center">
                                <i class="fas fa-user mr-2 text-green-600"></i>Data Klien
                            </h3>
                            @forelse ($kliens as $klien)
                                <div class="space-y-4">
                                    <div class="grid grid-cols-3 gap-2">
                                        <span class="font-medium text-gray-600">Nama Lengkap:</span>
                                        <span
                                            class="text-gray-800 col-span-2">{{ $klien->nama_lengkap ?? 'Tidak tersedia' }}</span>
                                    </div>
                                    <div class="grid grid-cols-3 gap-2">
                                        <span class="font-medium text-gray-600">NIM:</span>
                                        <span class="text-gray-800 col-span-2">{{ $klien->nim ?? 'Tidak tersedia' }}</span>
                                    </div>
                                    <div class="grid grid-cols-3 gap-2">
                                        <span class="font-medium text-gray-600">Program Studi:</span>
                                        <span
                                            class="text-gray-800 col-span-2">{{ $klien->program_studi ?? 'Tidak tersedia' }}</span>
                                    </div>
                                    <div class="grid grid-cols-3 gap-2">
                                        <span class="font-medium text-gray-600">Fakultas:</span>
                                        <span
                                            class="text-gray-800 col-span-2">{{ $klien->fakultas ?? 'Tidak tersedia' }}</span>
                                    </div>
                                    <div class="grid grid-cols-3 gap-2">
                                        <span class="font-medium text-gray-600">Angkatan:</span>
                                        <span
                                            class="text-gray-800 col-span-2">{{ $klien->angkatan ?? 'Tidak tersedia' }}</span>
                                    </div>
                                    <div class="grid grid-cols-3 gap-2">
                                        <span class="font-medium text-gray-600">Tempat Lahir:</span>
                                        <span
                                            class="text-gray-800 col-span-2">{{ $klien->tempat_lahir ?? 'Tidak tersedia' }}</span>
                                    </div>
                                    <div class="grid grid-cols-3 gap-2">
                                        <span class="font-medium text-gray-600">Tanggal Lahir:</span>
                                        <span class="text-gray-800 col-span-2">
                                            @if ($klien->tanggal_lahir)
                                                {{ \Carbon\Carbon::parse($klien->tanggal_lahir)->format('d M Y') }}
                                            @else
                                                Tidak tersedia
                                            @endif
                                        </span>
                                    </div>
                                    <div class="grid grid-cols-3 gap-2">
                                        <span class="font-medium text-gray-600">Agama:</span>
                                        <span
                                            class="text-gray-800 col-span-2">{{ $klien->agama ?? 'Tidak tersedia' }}</span>
                                    </div>
                                    <div class="grid grid-cols-3 gap-2">
                                        <span class="font-medium text-gray-600">Status Kawin:</span>
                                        <span
                                            class="text-gray-800 col-span-2">{{ $klien->status_perkawinan ?? 'Tidak tersedia' }}</span>
                                    </div>
                                    <div class="grid grid-cols-3 gap-2">
                                        <span class="font-medium text-gray-600">Sumber Rujukan:</span>
                                        <span
                                            class="text-gray-800 col-span-2">{{ $klien->sumber_rujukan ?? 'Tidak tersedia' }}</span>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-500 italic">Tidak ada data klien tersedia.</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Violence Information Section -->
                    <div class="bg-red-50 rounded-lg p-6 mb-8 shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2 flex items-center">
                            <i class="fas fa-exclamation-triangle mr-2 text-red-600"></i>Informasi Kekerasan
                        </h3>
                        @forelse ($informasiKekerasan as $info)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Left Column -->
                                <div class="space-y-4">
                                    <div class="grid grid-cols-3 gap-2">
                                        <span class="font-medium text-gray-600">Jenis Kekerasan:</span>
                                        <span
                                            class="text-gray-800 col-span-2">{{ $info->jenis_kekerasan ?? 'Tidak tersedia' }}</span>
                                    </div>
                                    <div class="grid grid-cols-3 gap-2">
                                        <span class="font-medium text-gray-600">Lokus Kejadian:</span>
                                        <span
                                            class="text-gray-800 col-span-2">{{ $info->lokus_kejadian ?? 'Tidak tersedia' }}</span>
                                    </div>
                                    <div class="grid grid-cols-3 gap-2">
                                        <span class="font-medium text-gray-600">Waktu Kejadian:</span>
                                        <span class="text-gray-800 col-span-2">
                                            @if ($info->waktu_kejadian)
                                                {{ \Carbon\Carbon::parse($info->waktu_kejadian)->format('d M Y, H:i') }}
                                            @else
                                                Tidak tersedia
                                            @endif
                                        </span>
                                    </div>
                                    <div class="grid grid-cols-3 gap-2">
                                        <span class="font-medium text-gray-600">Kategori Pidana:</span>
                                        <span
                                            class="text-gray-800 col-span-2">{{ $info->kategori_pidana ?? 'Tidak tersedia' }}</span>
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="space-y-4">
                                    <div class="grid grid-cols-3 gap-2">
                                        <span class="font-medium text-gray-600">Bentuk Kekerasan:</span>
                                        <span
                                            class="text-gray-800 col-span-2">{{ $info->bentuk_kekerasan ?? 'Tidak tersedia' }}</span>
                                    </div>
                                    <div class="grid grid-cols-3 gap-2">
                                        <span class="font-medium text-gray-600">Keterangan Pihak Ke-3:</span>
                                        <span
                                            class="text-gray-800 col-span-2">{{ $info->keterangan_pihak_ke3 ?? 'Tidak tersedia' }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Chronology (Full Width) -->
                            <div class="mt-6">
                                <div class="grid grid-cols-1 gap-2">
                                    <span class="font-medium text-gray-600">Narasi Kronologis:</span>
                                    <div class="bg-white rounded-lg p-4 mt-2 border border-red-200">
                                        <p class="text-gray-800 leading-relaxed whitespace-pre-line">
                                            {{ $info->narasi_kronologis ?? 'Tidak tersedia' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 italic">Tidak ada informasi kekerasan tersedia.</p>
                        @endforelse
                    </div>

                    <!-- Perpetrator Data Section -->
                    <div class="bg-orange-50 rounded-lg p-6 mb-8 shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2 flex items-center">
                            <i class="fas fa-user-slash mr-2 text-orange-600"></i>Data Pelaku
                        </h3>
                        @forelse ($pelakuLaporan as $pelaku)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Left Column -->
                                <div class="space-y-4">
                                    <div class="grid grid-cols-3 gap-2">
                                        <span class="font-medium text-gray-600">Nama:</span>
                                        <span
                                            class="text-gray-800 col-span-2">{{ $pelaku->nama ?? 'Tidak tersedia' }}</span>
                                    </div>
                                    <div class="grid grid-cols-3 gap-2">
                                        <span class="font-medium text-gray-600">Hubungan:</span>
                                        <span
                                            class="text-gray-800 col-span-2">{{ $pelaku->hubungan ?? 'Tidak tersedia' }}</span>
                                    </div>
                                    <div class="grid grid-cols-3 gap-2">
                                        <span class="font-medium text-gray-600">Tempat Lahir:</span>
                                        <span
                                            class="text-gray-800 col-span-2">{{ $pelaku->tempat_lahir ?? 'Tidak tersedia' }}</span>
                                    </div>
                                    <div class="grid grid-cols-3 gap-2">
                                        <span class="font-medium text-gray-600">Tanggal Lahir:</span>
                                        <span class="text-gray-800 col-span-2">
                                            @if ($pelaku->tanggal_lahir)
                                                {{ \Carbon\Carbon::parse($pelaku->tanggal_lahir)->format('d M Y') }}
                                            @else
                                                Tidak tersedia
                                            @endif
                                        </span>
                                    </div>
                                    <div class="grid grid-cols-3 gap-2">
                                        <span class="font-medium text-gray-600">Jenis Kelamin:</span>
                                        <span
                                            class="text-gray-800 col-span-2 capitalize">{{ $pelaku->jenis_kelamin ?? 'Tidak tersedia' }}</span>
                                    </div>
                                    <div class="grid grid-cols-3 gap-2">
                                        <span class="font-medium text-gray-600">Usia:</span>
                                        <span class="text-gray-800 col-span-2">
                                            {{ $pelaku->usia ? $pelaku->usia . ' tahun' : 'Tidak tersedia' }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="space-y-4">
                                    <div class="grid grid-cols-3 gap-2">
                                        <span class="font-medium text-gray-600">Pekerjaan:</span>
                                        <span
                                            class="text-gray-800 col-span-2">{{ $pelaku->pekerjaan ?? 'Tidak tersedia' }}</span>
                                    </div>
                                    <div class="grid grid-cols-3 gap-2">
                                        <span class="font-medium text-gray-600">No. Telepon:</span>
                                        <span
                                            class="text-gray-800 col-span-2">{{ $pelaku->no_telepon ?? 'Tidak tersedia' }}</span>
                                    </div>
                                    <div class="grid grid-cols-3 gap-2">
                                        <span class="font-medium text-gray-600">Alamat:</span>
                                        <span
                                            class="text-gray-800 col-span-2">{{ $pelaku->alamat ?? 'Tidak tersedia' }}</span>
                                    </div>
                                    @if ($pelaku->keterangan)
                                        <div class="grid grid-cols-3 gap-2">
                                            <span class="font-medium text-gray-600">Keterangan:</span>
                                            <span class="text-gray-800 col-span-2">{{ $pelaku->keterangan }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 italic">Tidak ada data pelaku tersedia.</p>
                        @endforelse
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-8 flex flex-wrap gap-3 pt-6 border-t no-print">
                        <a href="{{ route('admin.laporans.edit', $laporan->id ?? 0) }}"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded-lg transition-colors flex items-center">
                            <i class="fas fa-edit mr-2"></i>Edit Laporan
                        </a>

                        <button onclick="window.print()"
                            class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition-colors flex items-center">
                            <i class="fas fa-print mr-2"></i>Cetak
                        </button>

                        <form method="POST" action="{{ route('admin.laporans.destroy', $laporan->id ?? 0) }}"
                            class="inline-block"
                            onsubmit="return confirm('Yakin ingin menghapus laporan ini? Tindakan ini tidak dapat dibatalkan.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-lg transition-colors flex items-center">
                                <i class="fas fa-trash mr-2"></i>Hapus Laporan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        html {
            overflow: auto !important;
            height: auto !important;
        }

        body {
            overflow: auto !important;
            height: auto !important;
            margin: 0;
            padding: 0;
        }


        .content-wrapper,
        .main-content,
        [data-content],
        .dashboard-content {
            overflow-y: auto !important;
            height: auto !important;
            max-height: none !important;
            min-height: 100vh;
        }


        .layout-fixed .content-wrapper,
        .layout-fixed .main-content,
        .sidebar-mini .content-wrapper {
            height: auto !important;
            min-height: 100vh !important;
            overflow-y: visible !important;
        }


        .container {
            position: relative;
            z-index: 1;
        }

        .pb-20 {
            padding-bottom: 5rem;
        }

        /* Print styles */
        @media print {

            .no-print,
            .no-print * {
                display: none !important;
            }

            body,
            .container {
                width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .bg-gradient-to-r {
                background: #1e40af !important;
            }

            .bg-gray-50,
            .bg-red-50,
            .bg-orange-50 {
                background-color: transparent !important;
                border: 1px solid #e5e7eb !important;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            let currentElement = document.querySelector('.container').parentElement;
            while (currentElement && currentElement !== document.body) {
                currentElement.style.overflow = 'visible';
                currentElement.style.height = 'auto';
                currentElement.style.maxHeight = 'none';
                currentElement = currentElement.parentElement;
            }


            document.body.style.overflow = 'auto';
            document.body.style.height = 'auto';
            document.documentElement.style.overflow = 'auto';
            document.documentElement.style.height = 'auto';

            document.body.offsetHeight;
        });
    </script>
@endsection

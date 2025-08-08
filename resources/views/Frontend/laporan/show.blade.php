@extends('Layouts.app')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 pt-20 pb-12">
    <div class="container mx-auto px-4 py-8">
        
        <!-- Header Section -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-primary rounded-full mb-4 shadow-lg">
                <i class="fas fa-file-alt text-white text-2xl"></i>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-3">
                Detail Laporan Kekerasan
            </h1>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                Informasi lengkap mengenai laporan yang telah Anda submit
            </p>
        </div>

        <!-- Ticket Info -->
        <div class="max-w-4xl mx-auto mb-8">
            <div class="bg-white rounded-2xl shadow-xl p-6">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="flex items-center mb-4 md:mb-0">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-hashtag text-blue-600 text-lg"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Nomor Tiket</p>
                            <p class="text-xl font-bold text-gray-800">PPKS-{{ date('Y') }}-{{ str_pad($report->id, 6, '0', STR_PAD_LEFT) }}</p>
                        </div>
                    </div>
                    <div class="text-center md:text-right">
                        <p class="text-sm text-gray-500">Status</p>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            <i class="fas fa-check-circle mr-2"></i>
                            Diterima
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto space-y-8">
            
            <!-- First Row: Client & Reporter -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                <!-- Client Information -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-green-500 to-green-600 px-6 py-4">
                        <h2 class="text-xl font-bold text-white flex items-center">
                            <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            Data Klien (Korban)
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex flex-col sm:flex-row">
                                <span class="w-full sm:w-2/5 text-sm font-semibold text-gray-700 mb-1 sm:mb-0">Nama Lengkap:</span>
                                <span class="flex-1 text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-lg">{{ $report->client->nama_lengkap ?? '-' }}</span>
                            </div>
                            <div class="flex flex-col sm:flex-row">
                                <span class="w-full sm:w-2/5 text-sm font-semibold text-gray-700 mb-1 sm:mb-0">Jenis Kelamin:</span>
                                <span class="flex-1 text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-lg">{{ $report->client->jenis_kelamin ?? '-' }}</span>
                            </div>
                            <div class="flex flex-col sm:flex-row">
                                <span class="w-full sm:w-2/5 text-sm font-semibold text-gray-700 mb-1 sm:mb-0">Status Korban:</span>
                                <div class="flex-1">
                                    @if($report->client->status_korban ?? null)
                                        @php
                                            $badgeClass = $report->client->status_korban === 'Disable' 
                                                ? 'bg-red-100 text-red-800 border-red-200' 
                                                : 'bg-green-100 text-green-800 border-green-200';
                                        @endphp
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium border {{ $badgeClass }}">
                                            {{ $report->client->status_korban }}
                                        </span>
                                    @else
                                        <span class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-lg inline-block">-</span>
                                    @endif
                                </div>
                            </div>
                            @if($report->client->status_korban === 'Disable' && $report->client->kategori_disable)
                            <div class="flex flex-col sm:flex-row">
                                <span class="w-full sm:w-2/5 text-sm font-semibold text-gray-700 mb-1 sm:mb-0">Kategori Disable:</span>
                                <span class="flex-1 text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-lg">{{ $report->client->kategori_disable }}</span>
                            </div>
                            @endif
                            <div class="flex flex-col sm:flex-row">
                                <span class="w-full sm:w-2/5 text-sm font-semibold text-gray-700 mb-1 sm:mb-0">Status:</span>
                                <span class="flex-1 text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-lg">{{ $report->client->status ?? '-' }}</span>
                            </div>
                            @if($report->client->sumber_informasi)
                            <div class="flex flex-col sm:flex-row">
                                <span class="w-full sm:w-2/5 text-sm font-semibold text-gray-700 mb-1 sm:mb-0">Sumber Informasi:</span>
                                <span class="flex-1 text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-lg">{{ $report->client->sumber_informasi }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Reporter Information -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                        <h2 class="text-xl font-bold text-white flex items-center">
                            <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-user-tie text-white"></i>
                            </div>
                            Data Pelapor
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex flex-col sm:flex-row">
                                <span class="w-full sm:w-2/5 text-sm font-semibold text-gray-700 mb-1 sm:mb-0">Nama Lengkap:</span>
                                <span class="flex-1 text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-lg">{{ $report->reporter->nama_lengkap ?? '-' }}</span>
                            </div>
                            <div class="flex flex-col sm:flex-row">
                                <span class="w-full sm:w-2/5 text-sm font-semibold text-gray-700 mb-1 sm:mb-0">Hubungan dengan Pelaku:</span>
                                <span class="flex-1 text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-lg">{{ $report->reporter->hubungan_pelapor_dengan_pelaku ?? '-' }}</span>
                            </div>
                            <div class="flex flex-col sm:flex-row">
                                <span class="w-full sm:w-2/5 text-sm font-semibold text-gray-700 mb-1 sm:mb-0">Tempat Lahir:</span>
                                <span class="flex-1 text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-lg">{{ $report->reporter->tempat_lahir ?? '-' }}</span>
                            </div>
                            <div class="flex flex-col sm:flex-row">
                                <span class="w-full sm:w-2/5 text-sm font-semibold text-gray-700 mb-1 sm:mb-0">Tanggal Lahir:</span>
                                <span class="flex-1 text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-lg">
                                    @if($report->reporter->tanggal_lahir)
                                        {{ \Carbon\Carbon::parse($report->reporter->tanggal_lahir)->format('d/m/Y') }}
                                    @else
                                        -
                                    @endif
                                </span>
                            </div>
                            <div class="flex flex-col sm:flex-row">
                                <span class="w-full sm:w-2/5 text-sm font-semibold text-gray-700 mb-1 sm:mb-0">Jenis Kelamin:</span>
                                <span class="flex-1 text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-lg">{{ $report->reporter->jenis_kelamin ?? '-' }}</span>
                            </div>
                            <div class="flex flex-col sm:flex-row">
                                <span class="w-full sm:w-2/5 text-sm font-semibold text-gray-700 mb-1 sm:mb-0">Usia:</span>
                                <span class="flex-1 text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-lg">{{ $report->reporter->usia ?? '-' }} {{ $report->reporter->usia ? 'tahun' : '' }}</span>
                            </div>
                            <div class="flex flex-col sm:flex-row">
                                <span class="w-full sm:w-2/5 text-sm font-semibold text-gray-700 mb-1 sm:mb-0">Status Pelapor:</span>
                                <span class="flex-1 text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-lg">{{ $report->reporter->status_pelapor ?? '-' }}</span>
                            </div>
                            <div class="flex flex-col sm:flex-row">
                                <span class="w-full sm:w-2/5 text-sm font-semibold text-gray-700 mb-1 sm:mb-0">No. Telepon:</span>
                                <span class="flex-1 text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-lg">{{ $report->reporter->no_telepon ?? '-' }}</span>
                            </div>
                            <div class="flex flex-col sm:flex-row">
                                <span class="w-full sm:w-2/5 text-sm font-semibold text-gray-700 mb-1 sm:mb-0">Alamat:</span>
                                <span class="flex-1 text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-lg">{{ $report->reporter->alamat ?? '-' }}</span>
                            </div>
                            @if($report->reporter->keterangan_tambahan)
                            <div class="flex flex-col sm:flex-row">
                                <span class="w-full sm:w-2/5 text-sm font-semibold text-gray-700 mb-1 sm:mb-0">Keterangan Tambahan:</span>
                                <span class="flex-1 text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-lg">{{ $report->reporter->keterangan_tambahan }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Second Row: Perpetrator & Violence -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                <!-- Perpetrator Information -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-orange-500 to-orange-600 px-6 py-4">
                        <h2 class="text-xl font-bold text-white flex items-center">
                            <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-user-times text-white"></i>
                            </div>
                            Data Pelaku
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex flex-col sm:flex-row">
                                <span class="w-full sm:w-2/5 text-sm font-semibold text-gray-700 mb-1 sm:mb-0">Nama Pelaku:</span>
                                <span class="flex-1 text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-lg">{{ $report->perpetrator->nama ?? '-' }}</span>
                            </div>
                            <div class="flex flex-col sm:flex-row">
                                <span class="w-full sm:w-2/5 text-sm font-semibold text-gray-700 mb-1 sm:mb-0">Hubungan dengan Korban:</span>
                                <span class="flex-1 text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-lg">{{ $report->perpetrator->hubungan_dengan_korban ?? '-' }}</span>
                            </div>
                            <div class="flex flex-col sm:flex-row">
                                <span class="w-full sm:w-2/5 text-sm font-semibold text-gray-700 mb-1 sm:mb-0">No. Telepon:</span>
                                <span class="flex-1 text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-lg">{{ $report->perpetrator->telepon ?? '-' }}</span>
                            </div>
                            <div class="flex flex-col sm:flex-row">
                                <span class="w-full sm:w-2/5 text-sm font-semibold text-gray-700 mb-1 sm:mb-0">Jenis Kelamin:</span>
                                <span class="flex-1 text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-lg">{{ $report->perpetrator->jenis_kelamin ?? '-' }}</span>
                            </div>
                            <div class="flex flex-col sm:flex-row">
                                <span class="w-full sm:w-2/5 text-sm font-semibold text-gray-700 mb-1 sm:mb-0">Keterangan:</span>
                                <span class="flex-1 text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-lg">{{ $report->perpetrator->keterangan ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Violence Information -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-red-500 to-red-600 px-6 py-4">
                        <h2 class="text-xl font-bold text-white flex items-center">
                            <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-exclamation-triangle text-white"></i>
                            </div>
                            Data Kekerasan
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex flex-col sm:flex-row">
                                <span class="w-full sm:w-2/5 text-sm font-semibold text-gray-700 mb-1 sm:mb-0">Jenis Kekerasan:</span>
                                <div class="flex-1">
                                    @if($report->violence && $report->violence->jenis_kekerasan)
                                        @php
                                            $badgeClasses = match(strtolower($report->violence->jenis_kekerasan)) {
                                                'fisik' => 'bg-red-100 text-red-800 border-red-200',
                                                'psikis', 'psikologis' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                                'seksual' => 'bg-purple-100 text-purple-800 border-purple-200',
                                                'ekonomi' => 'bg-blue-100 text-blue-800 border-blue-200',
                                                default => 'bg-gray-100 text-gray-800 border-gray-200'
                                            };
                                        @endphp
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium border {{ $badgeClasses }}">
                                            {{ $report->violence->jenis_kekerasan }}
                                        </span>
                                    @else
                                        <span class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-lg inline-block">-</span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="flex flex-col sm:flex-row">
                                <span class="w-full sm:w-2/5 text-sm font-semibold text-gray-700 mb-1 sm:mb-0">Bentuk Kekerasan:</span>
                                <div class="flex-1">
                                    @if($report->violence && $report->violence->bentuk_kekerasan)
                                        @if(is_array($report->violence->bentuk_kekerasan))
                                            <div class="flex flex-wrap gap-2">
                                                @foreach($report->violence->bentuk_kekerasan as $bentuk)
                                                    <span class="inline-block bg-gray-100 text-gray-800 text-sm px-3 py-1 rounded-full border border-gray-200">
                                                        {{ $bentuk }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @else
                                            <span class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-lg inline-block">{{ $report->violence->bentuk_kekerasan }}</span>
                                        @endif
                                    @else
                                        <span class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-lg inline-block">-</span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="flex flex-col sm:flex-row">
                                <span class="w-full sm:w-2/5 text-sm font-semibold text-gray-700 mb-1 sm:mb-0">Lokasi Kejadian:</span>
                                <span class="flex-1 text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-lg">{{ $report->violence->lokasi_kejadian ?? '-' }}</span>
                            </div>
                            
                            <div class="flex flex-col sm:flex-row">
                                <span class="w-full sm:w-2/5 text-sm font-semibold text-gray-700 mb-1 sm:mb-0">Waktu Kejadian:</span>
                                <span class="flex-1 text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-lg">
                                    @if($report->violence->waktu_kejadian)
                                        {{ \Carbon\Carbon::parse($report->violence->waktu_kejadian)->format('d/m/Y H:i') }}
                                    @else
                                        -
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Violence Description -->
            @if($report->violence && $report->violence->deskripsi_kekerasan)
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="bg-gradient-to-r from-purple-500 to-purple-600 px-6 py-4">
                    <h2 class="text-xl font-bold text-white flex items-center">
                        <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-file-alt text-white"></i>
                        </div>
                        Deskripsi Kekerasan
                    </h2>
                </div>
                <div class="p-6">
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 p-6 rounded-xl border border-gray-200">
                        <p class="text-gray-900 leading-relaxed">{{ $report->violence->deskripsi_kekerasan }}</p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Evidence Section -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="bg-gradient-to-r from-gray-600 to-gray-700 px-6 py-4">
                    <h2 class="text-xl font-bold text-white flex items-center">
                        <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-paperclip text-white"></i>
                        </div>
                        Bukti Laporan
                    </h2>
                </div>
                <div class="p-6">
                    @php
                        $bukti = is_string($report->perpetrator->upload_bukti)
                            ? json_decode($report->perpetrator->upload_bukti, true)
                            : $report->perpetrator->upload_bukti;
                    @endphp

                    @if (is_array($bukti) && count($bukti) > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($bukti as $file)
                                @php
                                    $filePath = is_array($file) ? $file['path'] ?? '' : $file;
                                    $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                                @endphp

                                @if (in_array($fileExtension, ['jpg', 'jpeg', 'png']))
                                    <div class="relative group">
                                        <div class="bg-gray-100 rounded-xl p-4 hover:shadow-lg transition-all duration-300">
                                            <a href="{{ asset('storage/' . $filePath) }}" target="_blank">
                                                <img src="{{ asset('storage/' . $filePath) }}" alt="Bukti Kekerasan" class="w-full h-48 object-cover rounded-lg border border-gray-200">
                                                <div class="mt-3 flex items-center justify-center">
                                                    <span class="text-sm text-gray-600 flex items-center">
                                                        <i class="fas fa-external-link-alt mr-2"></i>
                                                        Lihat Gambar
                                                    </span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @elseif (in_array($fileExtension, ['pdf', 'doc', 'docx']))
                                    <div class="bg-blue-50 rounded-xl p-6 border border-blue-200 hover:shadow-lg transition-all duration-300">
                                        <div class="text-center">
                                            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                                <i class="fas fa-file-{{ $fileExtension === 'pdf' ? 'pdf' : 'word' }} text-blue-600 text-2xl"></i>
                                            </div>
                                            <h3 class="font-semibold text-gray-800 mb-2">{{ basename($filePath) }}</h3>
                                            <a href="{{ asset('storage/' . $filePath) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                                <i class="fas fa-download mr-2"></i>
                                                Unduh Dokumen
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-file-alt text-gray-400 text-2xl"></i>
                            </div>
                            <p class="text-gray-500 text-lg">Tidak ada bukti terlampir</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Report Information -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 px-6 py-4">
                    <h2 class="text-xl font-bold text-white flex items-center">
                        <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-info-circle text-white"></i>
                        </div>
                        Informasi Laporan
                    </h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-4">
                            <div class="flex flex-col sm:flex-row">
                                <span class="w-full sm:w-2/5 text-sm font-semibold text-gray-700 mb-1 sm:mb-0">ID Laporan:</span>
                                <span class="flex-1 text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-lg font-mono">{{ $report->id }}</span>
                            </div>
                            <div class="flex flex-col sm:flex-row">
                                <span class="w-full sm:w-2/5 text-sm font-semibold text-gray-700 mb-1 sm:mb-0">Tanggal Dibuat:</span>
                                <span class="flex-1 text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-lg">{{ $report->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex flex-col sm:flex-row">
                                <span class="w-full sm:w-2/5 text-sm font-semibold text-gray-700 mb-1 sm:mb-0">Terakhir Update:</span>
                                <span class="flex-1 text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-lg">{{ $report->updated_at->format('d/m/Y H:i') }}</span>
                            </div>
                            <div class="flex flex-col sm:flex-row">
                                <span class="w-full sm:w-2/5 text-sm font-semibold text-gray-700 mb-1 sm:mb-0">Status:</span>
                                <div class="flex-1">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 border border-green-200">
                                        <i class="fas fa-check-circle mr-2"></i>
                                        Aktif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="bg-gradient-to-r from-yellow-50 to-orange-50 rounded-2xl border-2 border-yellow-200 p-6">
                <div class="flex items-start space-x-4">
                    <div class="w-12 h-12 bg-yellow-500 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-phone text-white text-xl"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Butuh Bantuan atau Informasi Lebih Lanjut?</h3>
                        <p class="text-gray-700 mb-4">
                            Tim SATGAS PPKS siap membantu Anda. Jangan ragu untuk menghubungi kami jika ada pertanyaan atau memerlukan dukungan lebih lanjut.
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex items-center space-x-3 p-3 bg-white rounded-lg border border-yellow-200">
                                <i class="fas fa-phone text-yellow-600"></i>
                                <span class="text-gray-800 font-medium">085156900844</span>
                            </div>
                            <div class="flex items-center space-x-3 p-3 bg-white rounded-lg border border-yellow-200">
                                <i class="fas fa-envelope text-yellow-600"></i>
                                <span class="text-gray-800 font-medium">satgasppks@unu-jogja.ac.id</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('frontend.cek-status') }}" 
                   class="bg-gradient-to-r from-primary to-accent text-white font-bold py-3 px-8 rounded-xl hover:shadow-lg transform hover:-translate-y-1 transition-all duration-300 inline-flex items-center justify-center">
                    <i class="fas fa-search mr-2"></i>
                    Cek Status Laporan Lain
                </a>
                <a href="/" 
                   class="bg-white text-gray-700 font-semibold py-3 px-8 rounded-xl border-2 border-gray-200 hover:border-primary hover:text-primary transition-all duration-300 inline-flex items-center justify-center">
                    <i class="fas fa-home mr-2"></i>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Styles -->
<style>
    .container {
        max-width: 100%;
        padding-left: 1rem;
        padding-right: 1rem;
    }

    @media (min-width: 640px) {
        .container {
            padding-left: 2rem;
            padding-right: 2rem;
        }
    }

    @media (min-width: 1024px) {
        .container {
            padding-left: 4rem;
            padding-right: 4rem;
        }
    }

    /* Custom scrollbar for better UX */
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f5f9;
    }

    ::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    /* Animation for cards */
    .bg-white {
        transition: transform 0.2s ease-in-out;
    }

    .bg-white:hover {
        transform: translateY(-2px);
    }

    /* Custom focus styles */
    .focus\:ring-primary:focus {
        --tw-ring-color: rgb(59 130 246 / 0.5);
    }

    /* Responsive text sizes */
    @media (max-width: 640px) {
        .text-3xl {
            font-size: 1.875rem;
            line-height: 2.25rem;
        }
        
        .text-4xl {
            font-size: 2.25rem;
            line-height: 2.5rem;
        }
    }
</style>

@endsection
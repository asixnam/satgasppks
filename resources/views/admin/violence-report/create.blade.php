@extends('layouts.admin')

@section('title', 'Tambah Laporan Kekerasan')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="bg-green-600 px-6 py-4">
                <div class="flex justify-between items-center">
                    <h1 class="text-xl font-semibold text-white">Tambah Laporan Kekerasan</h1>
                    <a href="{{ url('/admin/violence-reports') }}" 
                       class="inline-flex items-center px-4 py-2 bg-green-500 hover:bg-green-400 text-white rounded-md transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali
                    </a>
                </div>
            </div>

            <form id="reportForm" action="{{ url('/admin/violence-reports') }}" method="POST">
                @csrf
                
                <!-- Tab Navigation -->
                <div class="border-b border-gray-200">
                    <nav class="flex space-x-8 px-6" aria-label="Tabs">
                        <button type="button" class="tab-button active py-4 px-1 border-b-2 border-green-500 font-medium text-sm text-green-600" data-tab="client">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Data Klien
                        </button>
                        <button type="button" class="tab-button py-4 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300" data-tab="reporter">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Data Pelapor
                        </button>
                        <button type="button" class="tab-button py-4 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300" data-tab="perpetrator">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18 21l3-3m-6.364-9.364L21 3l-3 3m-6.364 9.364a9 9 0 11-12.728 0"/>
                            </svg>
                            Data Pelaku
                        </button>
                        <button type="button" class="tab-button py-4 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300" data-tab="violence">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.767.833.19 2.5 1.732 2.5z"/>
                            </svg>
                            Data Kekerasan
                        </button>
                    </nav>
                </div>

                <!-- Tab Content -->
                <div class="p-6">
                    <!-- Client Tab -->
                    <div id="client-tab" class="tab-content active">
                        <h2 class="text-lg font-medium text-gray-900 mb-6">Informasi Klien (Korban)</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Nama Lengkap <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="client_data[nama_lengkap]" 
                                       value="{{ old('client_data.nama_lengkap', $report->client->nama_lengkap ?? '') }}" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('client_data.nama_lengkap') border-red-500 @enderror">
                                @error('client_data.nama_lengkap')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    NIM <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="client_data[nim]" 
                                       value="{{ old('client_data.nim', $report->client->nim ?? '') }}" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('client_data.nim') border-red-500 @enderror">
                                @error('client_data.nim')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Program Studi</label>
                                <input type="text" name="client_data[program_studi]" 
                                       value="{{ old('client_data.program_studi', $report->client->program_studi ?? '') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Fakultas</label>
                                <select name="client_data[fakultas]" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                    <option value="">Pilih Fakultas</option>
                                    <option value="FMIPA" {{ old('client_data.fakultas', $report->client->fakultas ?? '') == 'FMIPA' ? 'selected' : '' }}>FMIPA</option>
                                    <option value="FEB" {{ old('client_data.fakultas', $report->client->fakultas ?? '') == 'FEB' ? 'selected' : '' }}>FEB</option>
                                    <option value="FH" {{ old('client_data.fakultas', $report->client->fakultas ?? '') == 'FH' ? 'selected' : '' }}>FH</option>
                                    <option value="FK" {{ old('client_data.fakultas', $report->client->fakultas ?? '') == 'FK' ? 'selected' : '' }}>FK</option>
                                    <option value="FT" {{ old('client_data.fakultas', $report->client->fakultas ?? '') == 'FT' ? 'selected' : '' }}>FT</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Angkatan</label>
                                <input type="number" name="client_data[angkatan]" 
                                       value="{{ old('client_data.angkatan', $report->client->angkatan ?? '') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tempat Lahir</label>
                                <input type="text" name="client_data[tempat_lahir]" 
                                       value="{{ old('client_data.tempat_lahir', $report->client->tempat_lahir ?? '') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
                                <input type="date" name="client_data[tanggal_lahir]" 
                                       value="{{ old('client_data.tanggal_lahir', $report->client->tanggal_lahir ?? '') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Agama</label>
                                <select name="client_data[agama]" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                    <option value="">Pilih Agama</option>
                                    <option value="Islam" {{ old('client_data.agama', $report->client->agama ?? '') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="Kristen" {{ old('client_data.agama', $report->client->agama ?? '') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                    <option value="Katolik" {{ old('client_data.agama', $report->client->agama ?? '') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                    <option value="Hindu" {{ old('client_data.agama', $report->client->agama ?? '') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="Buddha" {{ old('client_data.agama', $report->client->agama ?? '') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                    <option value="Konghucu" {{ old('client_data.agama', $report->client->agama ?? '') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Status Perkawinan</label>
                                <select name="client_data[status_perkawinan]" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                    <option value="">Pilih Status</option>
                                    <option value="Belum Menikah" {{ old('client_data.status_perkawinan', $report->client->status_perkawinan ?? '') == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                                    <option value="Menikah" {{ old('client_data.status_perkawinan', $report->client->status_perkawinan ?? '') == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                                    <option value="Cerai" {{ old('client_data.status_perkawinan', $report->client->status_perkawinan ?? '') == 'Cerai' ? 'selected' : '' }}>Cerai</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Sumber Rujukan</label>
                                <input type="text" name="client_data[sumber_rujukan]" 
                                       value="{{ old('client_data.sumber_rujukan', $report->client->sumber_rujukan ?? '') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            </div>
                        </div>
                    </div>

                    <!-- Reporter Tab -->
                    <div id="reporter-tab" class="tab-content hidden">
                        <h2 class="text-lg font-medium text-gray-900 mb-6">Informasi Pelapor</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Nama Pelapor <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="reporter_data[nama]" 
                                       value="{{ old('reporter_data.nama', $report->reporter->nama ?? '') }}" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('reporter_data.nama') border-red-500 @enderror">
                                @error('reporter_data.nama')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Hubungan dengan Korban</label>
                                <input type="text" name="reporter_data[hubungan]" 
                                       value="{{ old('reporter_data.hubungan', $report->reporter->hubungan ?? '') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tempat Lahir</label>
                                <input type="text" name="reporter_data[tempat_lahir]" 
                                       value="{{ old('reporter_data.tempat_lahir', $report->reporter->tempat_lahir ?? '') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
                                <input type="date" name="reporter_data[tanggal_lahir]" 
                                       value="{{ old('reporter_data.tanggal_lahir', $report->reporter->tanggal_lahir ?? '') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                                <select name="reporter_data[jenis_kelamin]" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L" {{ old('reporter_data.jenis_kelamin', $report->reporter->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('reporter_data.jenis_kelamin', $report->reporter->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Usia</label>
                                <input type="number" name="reporter_data[usia]" 
                                       value="{{ old('reporter_data.usia', $report->reporter->usia ?? '') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Pekerjaan</label>
                                <input type="text" name="reporter_data[pekerjaan]" 
                                       value="{{ old('reporter_data.pekerjaan', $report->reporter->pekerjaan ?? '') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">No. Telepon</label>
                                <input type="text" name="reporter_data[no_telepon]" 
                                       value="{{ old('reporter_data.no_telepon', $report->reporter->no_telepon ?? '') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                                <textarea name="reporter_data[alamat]" rows="3" 
                                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">{{ old('reporter_data.alamat', $report->reporter->alamat ?? '') }}</textarea>
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                                <textarea name="reporter_data[keterangan]" rows="3" 
                                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">{{ old('reporter_data.keterangan', $report->reporter->keterangan ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Perpetrator Tab -->
                    <div id="perpetrator-tab" class="tab-content hidden">
                        <h2 class="text-lg font-medium text-gray-900 mb-6">Informasi Pelaku</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Nama Pelaku <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="perpetrator_data[nama_pelaku]" 
                                       value="{{ old('perpetrator_data.nama_pelaku', $report->perpetrator->nama_pelaku ?? '') }}" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('perpetrator_data.nama_pelaku') border-red-500 @enderror">
                                @error('perpetrator_data.nama_pelaku')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Hubungan dengan Korban</label>
                                <input type="text" name="perpetrator_data[hubungan_dengan_korban]" 
                                       value="{{ old('perpetrator_data.hubungan_dengan_korban', $report->perpetrator->hubungan_dengan_korban ?? '') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">NIK Pelaku</label>
                                <input type="text" name="perpetrator_data[nik_pelaku]" 
                                       value="{{ old('perpetrator_data.nik_pelaku', $report->perpetrator->nik_pelaku ?? '') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                                <select name="perpetrator_data[jenis_kelamin_pelaku]" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L" {{ old('perpetrator_data.jenis_kelamin_pelaku', $report->perpetrator->jenis_kelamin_pelaku ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('perpetrator_data.jenis_kelamin_pelaku', $report->perpetrator->jenis_kelamin_pelaku ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Umur</label>
                                <input type="number" name="perpetrator_data[umur_pelaku]" 
                                       value="{{ old('perpetrator_data.umur_pelaku', $report->perpetrator->umur_pelaku ?? '') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tempat Lahir</label>
                                <input type="text" name="perpetrator_data[tempat_lahir_pelaku]" 
                                       value="{{ old('perpetrator_data.tempat_lahir_pelaku', $report->perpetrator->tempat_lahir_pelaku ?? '') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
                                <input type="date" name="perpetrator_data[tanggal_lahir_pelaku]" 
                                       value="{{ old('perpetrator_data.tanggal_lahir_pelaku', $report->perpetrator->tanggal_lahir_pelaku ?? '') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Agama</label>
                                <select name="perpetrator_data[agama_pelaku]" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                    <option value="">Pilih Agama</option>
                                    <option value="Islam" {{ old('perpetrator_data.agama_pelaku', $report->perpetrator->agama_pelaku ?? '') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="Kristen" {{ old('perpetrator_data.agama_pelaku', $report->perpetrator->agama_pelaku ?? '') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                    <option value="Katolik" {{ old('perpetrator_data.agama_pelaku', $report->perpetrator->agama_pelaku ?? '') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                    <option value="Hindu" {{ old('perpetrator_data.agama_pelaku', $report->perpetrator->agama_pelaku ?? '') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="Buddha" {{ old('perpetrator_data.agama_pelaku', $report->perpetrator->agama_pelaku ?? '') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                    <option value="Konghucu" {{ old('perpetrator_data.agama_pelaku', $report->perpetrator->agama_pelaku ?? '') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Pekerjaan</label>
                                <input type="text" name="perpetrator_data[pekerjaan_pelaku]" 
                                       value="{{ old('perpetrator_data.pekerjaan_pelaku', $report->perpetrator->pekerjaan_pelaku ?? '') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">No. Telepon</label>
                                <input type="text" name="perpetrator_data[telepon_pelaku]" 
                                       value="{{ old('perpetrator_data.telepon_pelaku', $report->perpetrator->telepon_pelaku ?? '') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Pelaku</label>
                                <textarea name="perpetrator_data[alamat_pelaku]" rows="3" 
                                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">{{ old('perpetrator_data.alamat_pelaku') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Violence Tab -->
                    <div id="violence-tab" class="tab-content hidden">
                        <h2 class="text-lg font-medium text-gray-900 mb-6">Informasi Kekerasan</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Jenis Kekerasan <span class="text-red-500">*</span>
                                </label>
                                <select name="violance_data[jenis_kekerasan]" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('violance_data.jenis_kekerasan') border-red-500 @enderror">
                                    <option value="">Pilih Jenis Kekerasan</option>
                                    <option value="Fisik" {{ old('violance_data.jenis_kekerasan') == 'Fisik' ? 'selected' : '' }}>Fisik</option>
                                    <option value="Psikis" {{ old('violance_data.jenis_kekerasan') == 'Psikis' ? 'selected' : '' }}>Psikis</option>
                                    <option value="Seksual" {{ old('violance_data.jenis_kekerasan') == 'Seksual' ? 'selected' : '' }}>Seksual</option>
                                    <option value="Ekonomi" {{ old('violance_data.jenis_kekerasan') == 'Ekonomi' ? 'selected' : '' }}>Ekonomi</option>
                                </select>
                                @error('violance_data.jenis_kekerasan')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Waktu Kejadian</label>
                                <input type="datetime-local" name="violance_data[waktu_kejadian]" 
                                       value="{{ old('violance_data.waktu_kejadian') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi Kejadian</label>
                                <input type="text" name="violance_data[lokus_kejadian]" 
                                       value="{{ old('violance_data.lokus_kejadian') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori Pidana</label>
                                <input type="text" name="violance_data[kategori_pidana]" 
                                       value="{{ old('violance_data.kategori_pidana') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Bentuk Kekerasan</label>
                                <input type="text" name="violance_data[bentuk_kekerasan]" 
                                       value="{{ old('violance_data.bentuk_kekerasan') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan Pihak Ke-3</label>
                                <input type="text" name="violance_data[keterangan_pihak_ke3]" 
                                       value="{{ old('violance_data.keterangan_pihak_ke3') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Narasi Kronologis</label>
                                <textarea name="violance_data[narasi_kronologis]" rows="5" 
                                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">{{ old('violance_data.narasi_kronologis') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Footer -->
                <div class="bg-gray-50 px-6 py-4 flex justify-between items-center border-t border-gray-200">
                    <a href="{{ url('/admin/violence-reports') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Batal
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center px-6 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-md transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>
                        Simpan Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Tab functionality
document.addEventListener('DOMContentLoaded', function() {
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');
    
    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');
            
            // Remove active classes
            tabButtons.forEach(btn => {
                btn.classList.remove('active', 'border-green-500', 'text-green-600');
                btn.classList.add('border-transparent', 'text-gray-500');
            });
            
            tabContents.forEach(content => {
                content.classList.add('hidden');
                content.classList.remove('active');
            });
            
            // Add active classes
            this.classList.add('active', 'border-green-500', 'text-green-600');
            this.classList.remove('border-transparent', 'text-gray-500');
            
            const targetContent = document.getElementById(targetTab + '-tab');
            targetContent.classList.remove('hidden');
            targetContent.classList.add('active');
        });
    });
});

// Form submission
document.getElementById('reportForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const data = {};
    
    // Organize data by categories
    for (let [key, value] of formData.entries()) {
        const keys = key.split(/[\[\]]+/).filter(k => k);
        if (keys.length === 2) {
            if (!data[keys[0]]) data[keys[0]] = {};
            data[keys[0]][keys[1]] = value;
        }
    }
    
    // Show loading state
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = `
        <svg class="animate-spin -ml-1 mr-3 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        Menyimpan...
    `;
    submitBtn.disabled = true;
    
    fetch('/admin/violence-reports', {
        method: 'POST',
        body: JSON.stringify(data),
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Show success message
            showNotification('Laporan berhasil disimpan!', 'success');
            setTimeout(() => {
                window.location.href = '/admin/violence-reports';
            }, 1500);
        } else {
            throw new Error(data.message || 'Terjadi kesalahan');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification(error.message || 'Terjadi kesalahan saat menyimpan data', 'error');
        
        // Restore button
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    });
});

// Notification function
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 p-4 rounded-md shadow-lg transition-all duration-300 ${
        type === 'success' ? 'bg-green-500 text-white' : 
        type === 'error' ? 'bg-red-500 text-white' : 
        'bg-blue-500 text-white'
    }`;
    
    notification.innerHTML = `
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                ${type === 'success' ? 
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>' :
                    type === 'error' ?
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>' :
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>'
                }
            </svg>
            <span>${message}</span>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        notification.style.opacity = '0';
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 5000);
}
</script>
@endsection
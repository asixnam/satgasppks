@extends('layouts.admin')

@section('title', 'Buat Laporan Kekerasan')

@section('content')
<!-- Error Messages -->
@if ($errors->any())
    <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
        <div class="flex items-center mb-2">
            <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
            <h4 class="text-red-800 font-medium">Terdapat kesalahan dalam form:</h4>
        </div>
        <ul class="list-disc list-inside text-red-700 text-sm space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Success Message -->
@if (session('success'))
    <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                <span class="text-green-800 font-medium">{{ session('success') }}</span>
            </div>
            <button onclick="this.parentElement.parentElement.remove()" class="text-green-500 hover:text-green-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
@endif

<!-- Error Message -->
@if (session('error'))
    <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <i class="fas fa-exclamation-triangle text-red-500 mr-2"></i>
                <span class="text-red-800 font-medium">{{ session('error') }}</span>
            </div>
            <button onclick="this.parentElement.parentElement.remove()" class="text-red-500 hover:text-red-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
@endif

<div class="container mx-auto p-6">
    <div class="bg-white rounded-lg shadow-lg">
        <!-- Header -->
        <div class="border-b px-6 py-4 flex justify-between items-center">
            <h3 class="text-xl font-semibold text-gray-800">Buat Laporan Kekerasan Baru</h3>
            <a href="{{ route('admin.violence-reports.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition text-sm">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>

        <form action="{{ route('admin.violence-reports.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            
            <!-- Tab Navigation -->
            <div class="border-b mb-6">
                <nav class="flex space-x-8">
                    <button type="button" onclick="showTab('client')" class="tab-btn py-2 px-1 border-b-2 border-blue-500 text-blue-600 font-medium text-sm">
                        <i class="fas fa-user mr-2"></i>Data Klien
                    </button>
                    <button type="button" onclick="showTab('reporter')" class="tab-btn py-2 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium text-sm">
                        <i class="fas fa-user-tie mr-2"></i>Data Pelapor
                    </button>
                    <button type="button" onclick="showTab('perpetrator')" class="tab-btn py-2 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium text-sm">
                        <i class="fas fa-user-times mr-2"></i>Data Pelaku
                    </button>
                    <button type="button" onclick="showTab('violence')" class="tab-btn py-2 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium text-sm">
                        <i class="fas fa-exclamation-triangle mr-2"></i>Data Kekerasan
                    </button>
                </nav>
            </div>

            <!-- Client Tab -->
            <div id="client" class="tab-content">
                <h5 class="text-lg font-medium mb-4">Informasi Klien (Korban)</h5>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="client_data[nama_lengkap]" value="{{ old('client_data.nama_lengkap') }}" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        @error('client_data.nama_lengkap')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                        <select name="client_data[jenis_kelamin]" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki" {{ old('client_data.jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('client_data.jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('client_data.jenis_kelamin')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status Korban <span class="text-red-500">*</span></label>
                        <select name="client_data[status_korban]" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="">Pilih Status</option>
                            <option value="Disable" {{ old('client_data.status_korban') == 'Disable' ? 'selected' : '' }}>Disable</option>
                            <option value="Tidak" {{ old('client_data.status_korban') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                        </select>
                        @error('client_data.status_korban')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kategori Disable</label>
                        <input type="text" name="client_data[kategori_disable]" value="{{ old('client_data.kategori_disable') }}" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @error('client_data.kategori_disable')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status <span class="text-red-500">*</span></label>
                        <input type="text" name="client_data[status]" value="{{ old('client_data.status') }}" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        @error('client_data.status')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Sumber Informasi</label>
                        <textarea name="client_data[sumber_informasi]" rows="3" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('client_data.sumber_informasi') }}</textarea>
                        @error('client_data.sumber_informasi')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Reporter Tab -->
            <div id="reporter" class="tab-content hidden">
                <h5 class="text-lg font-medium mb-4">Informasi Pelapor</h5>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Hubungan Pelapor dengan Pelaku <span class="text-red-500">*</span></label>
                        <input type="text" name="reporter_data[hubungan_pelapor_dengan_pelaku]" value="{{ old('reporter_data.hubungan_pelapor_dengan_pelaku') }}" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        @error('reporter_data.hubungan_pelapor_dengan_pelaku')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="reporter_data[nama_lengkap]" value="{{ old('reporter_data.nama_lengkap') }}" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        @error('reporter_data.nama_lengkap')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir <span class="text-red-500">*</span></label>
                        <input type="text" name="reporter_data[tempat_lahir]" value="{{ old('reporter_data.tempat_lahir') }}" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        @error('reporter_data.tempat_lahir')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir <span class="text-red-500">*</span></label>
                        <input type="date" name="reporter_data[tanggal_lahir]" value="{{ old('reporter_data.tanggal_lahir') }}" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        @error('reporter_data.tanggal_lahir')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                        <select name="reporter_data[jenis_kelamin]" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki" {{ old('reporter_data.jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('reporter_data.jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('reporter_data.jenis_kelamin')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Usia <span class="text-red-500">*</span></label>
                        <input type="number" name="reporter_data[usia]" value="{{ old('reporter_data.usia') }}" min="1" max="120" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        @error('reporter_data.usia')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status Pelapor <span class="text-red-500">*</span></label>
                        <input type="text" name="reporter_data[status_pelapor]" value="{{ old('reporter_data.status_pelapor') }}" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        @error('reporter_data.status_pelapor')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon <span class="text-red-500">*</span></label>
                        <input type="text" name="reporter_data[no_telepon]" value="{{ old('reporter_data.no_telepon') }}" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        @error('reporter_data.no_telepon')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat <span class="text-red-500">*</span></label>
                        <textarea name="reporter_data[alamat]" rows="3" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>{{ old('reporter_data.alamat') }}</textarea>
                        @error('reporter_data.alamat')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan Tambahan</label>
                        <textarea name="reporter_data[keterangan_tambahan]" rows="3" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('reporter_data.keterangan_tambahan') }}</textarea>
                        @error('reporter_data.keterangan_tambahan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Perpetrator Tab -->
            <div id="perpetrator" class="tab-content hidden">
                <h5 class="text-lg font-medium mb-4">Informasi Pelaku</h5>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Hubungan dengan Korban <span class="text-red-500">*</span></label>
                        <input type="text" name="perpetrator_data[hubungan_dengan_korban]" value="{{ old('perpetrator_data.hubungan_dengan_korban') }}" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        @error('perpetrator_data.hubungan_dengan_korban')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pelaku <span class="text-red-500">*</span></label>
                        <input type="text" name="perpetrator_data[nama]" value="{{ old('perpetrator_data.nama') }}" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        @error('perpetrator_data.nama')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                        <input type="text" name="perpetrator_data[telepon]" value="{{ old('perpetrator_data.telepon') }}" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @error('perpetrator_data.telepon')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                        <select name="perpetrator_data[jenis_kelamin]" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki" {{ old('perpetrator_data.jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('perpetrator_data.jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('perpetrator_data.jenis_kelamin')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan <span class="text-red-500">*</span></label>
                        <textarea name="perpetrator_data[keterangan]" rows="4" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>{{ old('perpetrator_data.keterangan') }}</textarea>
                        @error('perpetrator_data.keterangan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Upload Bukti</label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4">
                            <div class="text-center">
                                <i class="fas fa-cloud-upload-alt text-gray-400 text-3xl mb-2"></i>
                                <p class="text-gray-500 text-sm">Upload file bukti (optional)</p>
                                <input type="file" name="perpetrator_data[upload_bukti][]" multiple class="mt-2 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            </div>
                        </div>
                        @error('perpetrator_data.upload_bukti')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Violence Tab -->
            <div id="violence" class="tab-content hidden">
                <h5 class="text-lg font-medium mb-4">Informasi Kekerasan</h5>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kekerasan <span class="text-red-500">*</span></label>
                        <input type="text" name="violance_data[jenis_kekerasan]" value="{{ old('violance_data.jenis_kekerasan') }}" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        @error('violance_data.jenis_kekerasan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi Kejadian <span class="text-red-500">*</span></label>
                        <input type="text" name="violance_data[lokasi_kejadian]" value="{{ old('violance_data.lokasi_kejadian') }}" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        @error('violance_data.lokasi_kejadian')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Waktu Kejadian <span class="text-red-500">*</span></label>
                        <input type="date" name="violance_data[waktu_kejadian]" value="{{ old('violance_data.waktu_kejadian') }}" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        @error('violance_data.waktu_kejadian')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Bentuk Kekerasan <span class="text-red-500">*</span></label>
                        <div class="space-y-2">
                            @php
                                $oldBentukKekerasan = old('violance_data.bentuk_kekerasan', []);
                            @endphp
                            <div class="flex items-center">
                                <input type="checkbox" name="violance_data[bentuk_kekerasan][]" value="Fisik" 
                                       {{ in_array('Fisik', $oldBentukKekerasan) ? 'checked' : '' }}
                                       class="mr-2">
                                <label class="text-sm">Fisik</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" name="violance_data[bentuk_kekerasan][]" value="Psikis" 
                                       {{ in_array('Psikis', $oldBentukKekerasan) ? 'checked' : '' }}
                                       class="mr-2">
                                <label class="text-sm">Psikis</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" name="violance_data[bentuk_kekerasan][]" value="Seksual" 
                                       {{ in_array('Seksual', $oldBentukKekerasan) ? 'checked' : '' }}
                                       class="mr-2">
                                <label class="text-sm">Seksual</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" name="violance_data[bentuk_kekerasan][]" value="Ekonomi" 
                                       {{ in_array('Ekonomi', $oldBentukKekerasan) ? 'checked' : '' }}
                                       class="mr-2">
                                <label class="text-sm">Ekonomi</label>
                            </div>
                        </div>
                        @error('violance_data.bentuk_kekerasan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Kekerasan <span class="text-red-500">*</span></label>
                        <textarea name="violance_data[deskripsi_kekerasan]" rows="6" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>{{ old('violance_data.deskripsi_kekerasan') }}</textarea>
                        @error('violance_data.deskripsi_kekerasan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="border-t pt-6 mt-6 flex justify-between">
                <a href="{{ route('admin.violence-reports.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600 transition text-sm">
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition text-sm">
                    <i class="fas fa-save mr-2"></i>Simpan Laporan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function showTab(tabName) {
    // Hide all tabs
    document.querySelectorAll('.tab-content').forEach(tab => {
        tab.classList.add('hidden');
    });
    
    // Remove active state from all tab buttons
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('border-blue-500', 'text-blue-600');
        btn.classList.add('border-transparent', 'text-gray-500');
    });
    
    // Show selected tab
    document.getElementById(tabName).classList.remove('hidden');
    
    // Add active state to clicked button
    event.target.classList.remove('border-transparent', 'text-gray-500');
    event.target.classList.add('border-blue-500', 'text-blue-600');
}
</script>

@endsection
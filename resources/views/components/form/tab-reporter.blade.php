@php
    // Tentukan data yang akan ditampilkan di form
    $formData = [];
    
    // Jika ada old data (dari validation error), gunakan itu
    if (!empty($oldData)) {
        $formData = $oldData;
    } 
    // Jika ada edit data (sedang edit record), gunakan itu
    elseif (isset($editData) && $editData) {
        $formData = [
            'hubungan_pelapor_dengan_pelaku' => $editData->hubungan_pelapor_dengan_pelaku ?? '',
            'nama_lengkap' => $editData->nama_lengkap ?? '',
            'tempat_lahir' => $editData->tempat_lahir ?? '',
            'tanggal_lahir' => $editData->tanggal_lahir ?? '',
            'jenis_kelamin' => $editData->jenis_kelamin ?? '',
            'usia' => $editData->usia ?? '',
            'status_pelapor' => $editData->status_pelapor ?? '',
            'no_telepon' => $editData->no_telepon ?? '',
            'alamat' => $editData->alamat ?? '',
            'keterangan_tambahan' => $editData->keterangan_tambahan ?? ''
        ];
    }
    // Jika tidak ada data apapun, gunakan array kosong (untuk create)
@endphp

<!-- Reporter Tab -->
<div id="reporter" class="tab-content hidden">
    <h5 class="text-lg font-medium mb-4">Informasi Pelapor</h5>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Hubungan Pelapor dengan Pelaku <span class="text-red-500">*</span></label>
            <input type="text"
                   name="reporter_data[hubungan_pelapor_dengan_pelaku]"
                   value="{{ old('reporter_data.hubungan_pelapor_dengan_pelaku', $formData['hubungan_pelapor_dengan_pelaku'] ?? '') }}"
                   class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   required>
            @error('reporter_data.hubungan_pelapor_dengan_pelaku')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div> -->

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Hubungan Pelapor dengan Pelaku <span class="text-red-500">*</span>
            </label>
            <select name="reporter_data[hubungan_pelapor_dengan_pelaku]"
                    class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    required>
                @php
                    $hubunganPelaporOptions = ['Teman', 'Masyarakat', 'Tendik', 'Dosen', 'Tenaga Kerja', 'Lainnya'];
                    $selected = old('reporter_data.hubungan_pelapor_dengan_pelaku', $formData['hubungan_pelapor_dengan_pelaku'] ?? '');
                @endphp

                <option value="">-- Pilih Hubungan --</option>
                @foreach ($hubunganPelaporOptions as $option)
                    <option value="{{ $option }}" {{ $selected === $option ? 'selected' : '' }}>
                        {{ $option }}
                    </option>
                @endforeach
            </select>
            @error('reporter_data.hubungan_pelapor_dengan_pelaku')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
            <input type="text"
                   name="reporter_data[nama_lengkap]"
                   value="{{ old('reporter_data.nama_lengkap', $formData['nama_lengkap'] ?? '') }}"
                   class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   required>
            @error('reporter_data.nama_lengkap')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir <span class="text-red-500">*</span></label>
            <input type="text"
                   name="reporter_data[tempat_lahir]"
                   value="{{ old('reporter_data.tempat_lahir', $formData['tempat_lahir'] ?? '') }}"
                   class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   required>
            @error('reporter_data.tempat_lahir')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir <span class="text-red-500">*</span></label>
            <input type="date"
                name="reporter_data[tanggal_lahir]"
                value="{{ old('reporter_data.tanggal_lahir', isset($formData['tanggal_lahir']) ? \Carbon\Carbon::parse($formData['tanggal_lahir'])->format('Y-m-d') : '') }}"
                class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                required>
            @error('reporter_data.tanggal_lahir')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
            <select name="reporter_data[jenis_kelamin]"
                    class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    required>
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Laki-laki" {{ old('reporter_data.jenis_kelamin', $formData['jenis_kelamin'] ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('reporter_data.jenis_kelamin', $formData['jenis_kelamin'] ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
            @error('reporter_data.jenis_kelamin')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Usia <span class="text-red-500">*</span></label>
            <input type="number"
                   name="reporter_data[usia]"
                   value="{{ old('reporter_data.usia', $formData['usia'] ?? '') }}"
                   min="1"
                   max="120"
                   class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   required>
            @error('reporter_data.usia')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
           <label class="block text-sm font-medium text-gray-700 mb-1">Status Pelapor <span class="text-red-500">*</span></label>
            <select name="reporter_data[status_pelapor]"
                    class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    required>
                <option value="">-- Pilih Status --</option>
                <option value="Mahasiswa" {{ old('reporter_data.status_pelapor') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                <option value="Dosen" {{ old('reporter_data.status_pelapor') == 'dosen' ? 'selected' : '' }}>Dosen</option>
                <option value="Tendik" {{ old('reporter_data.status_pelapor') == 'tendik' ? 'selected' : '' }}>Tendik</option>
                <option value="Pegawai" {{ old('reporter_data.status_pelapor') == 'pegawai' ? 'selected' : '' }}>Pegawai Lainya</option>
                
            </select>
            @error('reporter_data.status_pelapor')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon <span class="text-red-500">*</span></label>
            <input type="text"
                   name="reporter_data[no_telepon]"
                   value="{{ old('reporter_data.no_telepon', $formData['no_telepon'] ?? '') }}"
                   class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   required>
            @error('reporter_data.no_telepon')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
            <input type="email"
                name="reporter_data[email]"
                value="{{ old('reporter_data.email', $formData['email'] ?? '') }}"
                class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Harus Menggunakan @unu-jogja.ac.id"
                required>
            @error('reporter_data.email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Alamat <span class="text-red-500">*</span></label>
            <textarea name="reporter_data[alamat]"
                      rows="3"
                      class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                      required>{{ old('reporter_data.alamat', $formData['alamat'] ?? '') }}</textarea>
            @error('reporter_data.alamat')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan Tambahan</label>
            <textarea name="reporter_data[keterangan_tambahan]"
                      rows="3"
                      class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('reporter_data.keterangan_tambahan', $formData['keterangan_tambahan'] ?? '') }}</textarea>
            @error('reporter_data.keterangan_tambahan')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>
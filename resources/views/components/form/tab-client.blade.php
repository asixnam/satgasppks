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
            'nama_lengkap' => $editData->nama_lengkap ?? '',
            'jenis_kelamin' => $editData->jenis_kelamin ?? '',
            'status_korban' => $editData->status_korban ?? '',
            'kategori_disable' => $editData->kategori_disable ?? '',
            'status' => $editData->status ?? '',
            'sumber_informasi' => $editData->sumber_informasi ?? ''
        ];
    }
    // Jika tidak ada data apapun, gunakan array kosong (untuk create)
@endphp

<!-- Client Tab -->
<div id="client" class="tab-content">
    <h5 class="text-lg font-medium mb-4">Informasi Klien (Korban)</h5>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
            <input type="text"
                   name="client_data[nama_lengkap]"
                   value="{{ old('client_data.nama_lengkap', $formData['nama_lengkap'] ?? '') }}"
                   class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   required>
            @error('client_data.nama_lengkap')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
            <select name="client_data[jenis_kelamin]"
                    class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    required>
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Laki-laki" {{ old('client_data.jenis_kelamin', $formData['jenis_kelamin'] ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('client_data.jenis_kelamin', $formData['jenis_kelamin'] ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
            @error('client_data.jenis_kelamin')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Status Korban <span class="text-red-500">*</span></label>
            <select name="client_data[status_korban]"
                    class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    required>
                <option value="">Pilih Status</option>
                <option value="Disable" {{ old('client_data.status_korban', $formData['status_korban'] ?? '') == 'Disable' ? 'selected' : '' }}>Disable</option>
                <option value="Tidak" {{ old('client_data.status_korban', $formData['status_korban'] ?? '') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
            </select>
            @error('client_data.status_korban')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kategori Disable</label>
            <select name="client_data[kategori_disable]"
                    class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                @php
                    $options = ['Tuli', 'Daksa', 'Bisu', 'Netra', 'Grahita', 'Rungu', 'Mental', 'Lainnya'];
                    $selected = old('client_data.kategori_disable', $formData['kategori_disable'] ?? '');
                @endphp

                <option value="">-- Pilih Kategori --</option>
                @foreach ($options as $option)
                    <option value="{{ $option }}" {{ $selected === $option ? 'selected' : '' }}>{{ $option }}</option>
                @endforeach
            </select>
            @error('client_data.kategori_disable')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Status <span class="text-red-500">*</span></label>
            <input type="text"
                   name="client_data[status]"
                   value="{{ old('client_data.status', $formData['status'] ?? '') }}"
                   class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   required>
            @error('client_data.status')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div> -->

        <div>
    <label class="block text-sm font-medium text-gray-700 mb-1">
        Status <span class="text-red-500">*</span>
    </label>
    <select name="client_data[status]"
            class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            required>
        @php
            $statusOptions = ['Mahasiswa', 'Dosen', 'Tendik', 'Pegawai Lainnya'];
            $selectedStatus = old('client_data.status', $formData['status'] ?? '');
        @endphp

        <option value="">-- Pilih Status --</option>
        @foreach ($statusOptions as $option)
            <option value="{{ $option }}" {{ $selectedStatus === $option ? 'selected' : '' }}>{{ $option }}</option>
        @endforeach
    </select>
    @error('client_data.status')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Sumber Informasi</label>
            <textarea name="client_data[sumber_informasi]"
                      rows="3"
                      class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('client_data.sumber_informasi', $formData['sumber_informasi'] ?? '') }}</textarea>
            @error('client_data.sumber_informasi')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>
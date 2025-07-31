<!-- Client Tab -->
<div id="client" class="tab-content">
    <h5 class="text-lg font-medium mb-4">Informasi Klien (Korban)</h5>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
            <input type="text"
                   name="client_data[nama_lengkap]"
                   value="{{ old('client_data.nama_lengkap', $oldData['nama_lengkap'] ?? '') }}"
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
                <option value="Laki-laki" {{ old('client_data.jenis_kelamin', $oldData['jenis_kelamin'] ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('client_data.jenis_kelamin', $oldData['jenis_kelamin'] ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
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
                <option value="Disable" {{ old('client_data.status_korban', $oldData['status_korban'] ?? '') == 'Disable' ? 'selected' : '' }}>Disable</option>
                <option value="Tidak" {{ old('client_data.status_korban', $oldData['status_korban'] ?? '') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
            </select>
            @error('client_data.status_korban')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kategori Disable</label>
            <input type="text"
                   name="client_data[kategori_disable]"
                   value="{{ old('client_data.kategori_disable', $oldData['kategori_disable'] ?? '') }}"
                   class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            @error('client_data.kategori_disable')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Status <span class="text-red-500">*</span></label>
            <input type="text"
                   name="client_data[status]"
                   value="{{ old('client_data.status', $oldData['status'] ?? '') }}"
                   class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   required>
            @error('client_data.status')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Sumber Informasi</label>
            <textarea name="client_data[sumber_informasi]"
                      rows="3"
                      class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('client_data.sumber_informasi', $oldData['sumber_informasi'] ?? '') }}</textarea>
            @error('client_data.sumber_informasi')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>

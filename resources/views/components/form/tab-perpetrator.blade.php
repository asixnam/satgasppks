<!-- Perpetrator Tab -->
<div id="perpetrator" class="tab-content hidden">
    <h5 class="text-lg font-medium mb-4">Informasi Pelaku</h5>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Hubungan dengan Korban <span class="text-red-500">*</span></label>
            <input type="text"
                   name="perpetrator_data[hubungan_dengan_korban]"
                   value="{{ old('perpetrator_data.hubungan_dengan_korban', $oldData['hubungan_dengan_korban'] ?? '') }}"
                   class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   required>
            @error('perpetrator_data.hubungan_dengan_korban')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pelaku <span class="text-red-500">*</span></label>
            <input type="text"
                   name="perpetrator_data[nama]"
                   value="{{ old('perpetrator_data.nama', $oldData['nama'] ?? '') }}"
                   class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   required>
            @error('perpetrator_data.nama')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
            <input type="text"
                   name="perpetrator_data[telepon]"
                   value="{{ old('perpetrator_data.telepon', $oldData['telepon'] ?? '') }}"
                   class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            @error('perpetrator_data.telepon')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
            <select name="perpetrator_data[jenis_kelamin]"
                    class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    required>
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Laki-laki" {{ old('perpetrator_data.jenis_kelamin', $oldData['jenis_kelamin'] ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('perpetrator_data.jenis_kelamin', $oldData['jenis_kelamin'] ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
            @error('perpetrator_data.jenis_kelamin')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan <span class="text-red-500">*</span></label>
            <textarea name="perpetrator_data[keterangan]"
                      rows="4"
                      class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                      required>{{ old('perpetrator_data.keterangan', $oldData['keterangan'] ?? '') }}</textarea>
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
                    <input type="file"
                        name="perpetrator_data[upload_bukti][]"
                        multiple
                        class="mt-2 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                </div>
            </div>
            @error('perpetrator_data.upload_bukti')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

    </div>
</div>

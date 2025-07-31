<!-- Violence Tab -->
<div id="violence" class="tab-content hidden">
    <h5 class="text-lg font-medium mb-4">Informasi Kekerasan</h5>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kekerasan <span class="text-red-500">*</span></label>
            <input type="text"
                   name="violance_data[jenis_kekerasan]"
                   value="{{ old('violance_data.jenis_kekerasan', $oldData['jenis_kekerasan'] ?? '') }}"
                   class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   required>
            @error('violance_data.jenis_kekerasan')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi Kejadian <span class="text-red-500">*</span></label>
            <input type="text"
                   name="violance_data[lokasi_kejadian]"
                   value="{{ old('violance_data.lokasi_kejadian', $oldData['lokasi_kejadian'] ?? '') }}"
                   class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   required>
            @error('violance_data.lokasi_kejadian')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Waktu Kejadian <span class="text-red-500">*</span></label>
            <input type="date"
                   name="violance_data[waktu_kejadian]"
                   value="{{ old('violance_data.waktu_kejadian', $oldData['waktu_kejadian'] ?? '') }}"
                   class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   required>
            @error('violance_data.waktu_kejadian')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Bentuk Kekerasan <span class="text-red-500">*</span></label>
            <div class="space-y-2">
                @php
                    $oldBentukKekerasan = old('violance_data.bentuk_kekerasan', $oldData['bentuk_kekerasan'] ?? []);
                    if (is_string($oldBentukKekerasan)) {
                        $oldBentukKekerasan = explode(',', $oldBentukKekerasan);
                    }
                @endphp
                <div class="flex items-center">
                    <input type="checkbox"
                           name="violance_data[bentuk_kekerasan][]"
                           value="Fisik"
                           {{ in_array('Fisik', $oldBentukKekerasan) ? 'checked' : '' }}
                           class="mr-2">
                    <label class="text-sm">Fisik</label>
                </div>
                <div class="flex items-center">
                    <input type="checkbox"
                           name="violance_data[bentuk_kekerasan][]"
                           value="Psikis"
                           {{ in_array('Psikis', $oldBentukKekerasan) ? 'checked' : '' }}
                           class="mr-2">
                    <label class="text-sm">Psikis</label>
                </div>
                <div class="flex items-center">
                    <input type="checkbox"
                           name="violance_data[bentuk_kekerasan][]"
                           value="Seksual"
                           {{ in_array('Seksual', $oldBentukKekerasan) ? 'checked' : '' }}
                           class="mr-2">
                    <label class="text-sm">Seksual</label>
                </div>
                <div class="flex items-center">
                    <input type="checkbox"
                           name="violance_data[bentuk_kekerasan][]"
                           value="Ekonomi"
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
            <textarea name="violance_data[deskripsi_kekerasan]"
                      rows="6"
                      class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                      required>{{ old('violance_data.deskripsi_kekerasan', $oldData['deskripsi_kekerasan'] ?? '') }}</textarea>
            @error('violance_data.deskripsi_kekerasan')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>

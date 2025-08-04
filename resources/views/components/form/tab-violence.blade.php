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
            'jenis_kekerasan' => $editData->jenis_kekerasan ?? '',
            'lokasi_kejadian' => $editData->lokasi_kejadian ?? '',
            'waktu_kejadian' => $editData->waktu_kejadian ?? '',
            'bentuk_kekerasan' => $editData->bentuk_kekerasan ?? [],
            'deskripsi_kekerasan' => $editData->deskripsi_kekerasan ?? ''
        ];
    }
    // Jika tidak ada data apapun, gunakan array kosong (untuk create)
@endphp

<!-- Violence Tab -->
<div id="violence" class="tab-content hidden">
    <h5 class="text-lg font-medium mb-4">Informasi Kekerasan</h5>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kekerasan <span class="text-red-500">*</span></label>
            <input type="text"
                   name="violance_data[jenis_kekerasan]"
                   value="{{ old('violance_data.jenis_kekerasan', $formData['jenis_kekerasan'] ?? '') }}"
                   class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   placeholder="Contoh: Kekerasan Dalam Rumah Tangga"
                   required>
            @error('violance_data.jenis_kekerasan')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi Kejadian <span class="text-red-500">*</span></label>
            <input type="text"
                   name="violance_data[lokasi_kejadian]"
                   value="{{ old('violance_data.lokasi_kejadian', $formData['lokasi_kejadian'] ?? '') }}"
                   class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   placeholder="Contoh: Rumah, Kantor, Jalan, dll"
                   required>
            @error('violance_data.lokasi_kejadian')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Waktu Kejadian <span class="text-red-500">*</span></label>
            <input type="date"
                   name="violance_data[waktu_kejadian]"
                   value="{{ old('violance_data.waktu_kejadian', $formData['waktu_kejadian'] ?? '') }}"
                   class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   max="{{ date('Y-m-d') }}"
                   required>
            @error('violance_data.waktu_kejadian')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Bentuk Kekerasan <span class="text-red-500">*</span></label>
            <div class="space-y-2">
                @php
                    $oldBentukKekerasan = old('violance_data.bentuk_kekerasan', $formData['bentuk_kekerasan'] ?? []);
                    if (is_string($oldBentukKekerasan)) {
                        $oldBentukKekerasan = explode(',', $oldBentukKekerasan);
                    }

                    $bentukKekerasanOptions = [
                        'Fisik' => 'Fisik (Pukulan, tendangan, tamparan, dll)',
                        'Psikis' => 'Psikis (Ancaman, intimidasi, penghinaan, dll)',
                        'Seksual' => 'Seksual (Pelecehan, pemaksaan, dll)',
                        'Ekonomi' => 'Ekonomi (Kontrol keuangan, larangan bekerja, dll)'
                    ];
                @endphp

                @foreach($bentukKekerasanOptions as $value => $label)
                    <div class="flex items-start">
                        <input type="checkbox"
                               name="violance_data[bentuk_kekerasan][]"
                               value="{{ $value }}"
                               {{ in_array($value, $oldBentukKekerasan) ? 'checked' : '' }}
                               class="mr-2 mt-1 text-blue-600 focus:ring-blue-500">
                        <label class="text-sm text-gray-700">{{ $label }}</label>
                    </div>
                @endforeach
            </div>
            @error('violance_data.bentuk_kekerasan')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Deskripsi Kekerasan <span class="text-red-500">*</span>
            </label>
            <textarea name="violance_data[deskripsi_kekerasan]"
                      rows="6"
                      class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                      placeholder="Jelaskan secara detail kronologi dan bentuk kekerasan yang terjadi..."
                      maxlength="3000"
                      required>{{ old('violance_data.deskripsi_kekerasan', $formData['deskripsi_kekerasan'] ?? '') }}</textarea>
            <div class="text-xs text-gray-500 mt-1">
                <span id="violence-char-count">0</span>/3000 karakter
            </div>
            @error('violance_data.deskripsi_kekerasan')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Character counter untuk deskripsi kekerasan
    const textarea = document.querySelector('textarea[name="violance_data[deskripsi_kekerasan]"]');
    const counter = document.getElementById('violence-char-count');

    function updateViolenceCount() {
        const count = textarea.value.length;
        counter.textContent = count;
        counter.style.color = count > 2700 ? '#ef4444' : count > 2400 ? '#f59e0b' : '#6b7280';
    }

    if (textarea && counter) {
        updateViolenceCount();
        textarea.addEventListener('input', updateViolenceCount);
    }

    // Validasi checkbox - minimal satu harus dipilih
    const checkboxes = document.querySelectorAll('input[name="violance_data[bentuk_kekerasan][]"]');
    const checkboxContainer = checkboxes[0]?.closest('div').parentElement;

    function validateCheckboxes() {
        const checked = Array.from(checkboxes).some(cb => cb.checked);

        // Remove existing error message
        const existingError = checkboxContainer?.querySelector('.checkbox-error');
        if (existingError) {
            existingError.remove();
        }

        if (!checked && checkboxContainer) {
            const errorMsg = document.createElement('p');
            errorMsg.className = 'text-red-500 text-xs mt-1 checkbox-error';
            errorMsg.textContent = 'Pilih minimal satu bentuk kekerasan';
            checkboxContainer.appendChild(errorMsg);
            return false;
        }
        return true;
    }

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', validateCheckboxes);
    });

    // Validasi saat form submit
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            if (!validateCheckboxes()) {
                e.preventDefault();
                checkboxContainer?.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        });
    }
});
</script>

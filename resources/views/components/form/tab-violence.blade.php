@php
    // Tentukan data yang akan ditampilkan di form
    $formData = [];

    if (!empty($oldData)) {
        $formData = $oldData;
    } elseif (!empty($editData)) {
        $formData = [
            'jenis_kekerasan'     => $editData->jenis_kekerasan ?? '',
            'lokasi_kejadian'     => $editData->lokasi_kejadian ?? '',
            'waktu_kejadian'      => $editData->waktu_kejadian ?? '',
            'bentuk_kekerasan'    => $editData->bentuk_kekerasan ?? [],
            'deskripsi_kekerasan' => $editData->deskripsi_kekerasan ?? '',
        ];
    }

    $oldBentukKekerasan = old('violance_data.bentuk_kekerasan');
    if (is_null($oldBentukKekerasan)) {
        $stored = $formData['bentuk_kekerasan'] ?? [];
        $oldBentukKekerasan = is_string($stored)
            ? array_map('trim', explode(',', $stored))
            : (array) $stored;
    }

    $bentukKekerasanOptions = [
        'Fisik'         => 'Fisik',
        'Psikis'        => 'Psikis',
        'Seksual'       => 'Seksual',
        'Ekonomi'       => 'Ekonomi',
        'Perundungan'   => 'Perundungan',
        'Diskriminasi'  => 'Diskriminasi',
    ];
@endphp

<div id="violence" class="tab-content hidden">
    <h5 class="text-lg font-medium mb-4">Informasi Kekerasan</h5>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        {{-- Bentuk Kekerasan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Bentuk Kekerasan <span class="text-red-500">*</span>
            </label>
            <div class="space-y-2">
                @foreach ($bentukKekerasanOptions as $value => $label)
                    <div class="flex items-start">
                        <input
                            type="checkbox"
                            name="violance_data[bentuk_kekerasan][]"
                            value="{{ $value }}"
                            id="bentuk_kekerasan_{{ $value }}"
                            {{ in_array($value, $oldBentukKekerasan) ? 'checked' : '' }}
                            class="mr-2 mt-1 text-blue-600 border-gray-300 rounded focus:ring-blue-500 bentuk-kekerasan-checkbox"
                            onchange="updateJenisKekerasan()"
                        >
                        <label for="bentuk_kekerasan_{{ $value }}" class="text-sm text-gray-700">
                            {{ $label }}
                        </label>
                    </div>
                @endforeach
            </div>
            @error('violance_data.bentuk_kekerasan')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Jenis Kekerasan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Jenis Kekerasan <span class="text-red-500">*</span>
            </label>
            <select
                name="violance_data[jenis_kekerasan]"
                id="jenis_kekerasan"
                data-selected="{{ old('violance_data.jenis_kekerasan', $formData['jenis_kekerasan'] ?? '') }}"
                class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                required
            >
                <option value="">-- Pilih Jenis Kekerasan --</option>
            </select>
            @error('violance_data.jenis_kekerasan')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Lokasi Kejadian --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Lokasi Kejadian <span class="text-red-500">*</span>
            </label>
            <input
                type="text"
                name="violance_data[lokasi_kejadian]"
                value="{{ old('violance_data.lokasi_kejadian', $formData['lokasi_kejadian'] ?? '') }}"
                class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Contoh: Rumah, Kantor, Jalan, dll"
                required
            >
            @error('violance_data.lokasi_kejadian')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Waktu Kejadian --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Waktu Kejadian <span class="text-red-500">*</span>
            </label>
            <input
                type="date"
                name="violance_data[waktu_kejadian]"
                value="{{ old('violance_data.waktu_kejadian', isset($formData['waktu_kejadian']) ? \Carbon\Carbon::parse($formData['waktu_kejadian'])->format('Y-m-d') : '') }}"
                class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                max="{{ date('Y-m-d') }}"
                required
            >
            @error('violance_data.waktu_kejadian')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Deskripsi --}}
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Deskripsi Kekerasan <span class="text-red-500">*</span>
            </label>
            <textarea
                name="violance_data[deskripsi_kekerasan]"
                rows="6"
                class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Jelaskan secara detail kronologi dan bentuk kekerasan yang terjadi..."
                maxlength="3000"
                required
            >{{ old('violance_data.deskripsi_kekerasan', $formData['deskripsi_kekerasan'] ?? '') }}</textarea>
            <div class="text-xs text-gray-500 mt-1">
                <span id="violence-char-count">0</span>/3000 karakter
            </div>
            @error('violance_data.deskripsi_kekerasan')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>

{{-- SCRIPT --}}
<script>
    const jenisKekerasanOptions = {
        Fisik: ['Tawuran', 'Penganiayaan', 'Perkelahian', 'Ekspoitasi Ekonomi', 'Pembunuhan'],
        Psikis: ['Pengucilan Sosial', 'Penolakan', 'Penghinaan', 'Penyebaran rumor', 'Intimidasi'],
        Perundungan: ['Penolakan', 'Penghinaan'],
        Seksual: ['Mengintip', 'Rayuan seksual'],
        Diskriminasi: ['Larangan keyakinan', 'Pemaksaan keyakinan'],
        Ekonomi: ['Eksploitasi', 'Pemerasan', 'Penipuan']
    };

    function updateJenisKekerasan() {
        const selectedBentuk = Array.from(document.querySelectorAll('.bentuk-kekerasan-checkbox'))
            .filter(cb => cb.checked)
            .map(cb => cb.value);

        const jenisSelect = document.getElementById('jenis_kekerasan');
        const selectedValue = jenisSelect.getAttribute('data-selected');
        jenisSelect.innerHTML = '<option value="">-- Pilih Jenis Kekerasan --</option>';

        const combinedOptions = new Set();
        selectedBentuk.forEach(bentuk => {
            if (jenisKekerasanOptions[bentuk]) {
                jenisKekerasanOptions[bentuk].forEach(jenis => combinedOptions.add(jenis));
            }
        });

        combinedOptions.forEach(jenis => {
            const option = document.createElement('option');
            option.value = jenis;
            option.textContent = jenis;
            if (selectedValue === jenis) {
                option.selected = true;
            }
            jenisSelect.appendChild(option);
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Init jenis kekerasan dropdown
        updateJenisKekerasan();

        // Deskripsi counter
        const textarea = document.querySelector('textarea[name="violance_data[deskripsi_kekerasan]"]');
        const counter = document.getElementById('violence-char-count');
        if (textarea && counter) {
            function updateViolenceCount() {
                const count = textarea.value.length;
                counter.textContent = count;
                counter.style.color =
                    count > 2700 ? '#ef4444' :
                    count > 2400 ? '#f59e0b' :
                    '#6b7280';
            }

            updateViolenceCount();
            textarea.addEventListener('input', updateViolenceCount);
        }

        // Validasi checkbox minimal 1
        const checkboxes = document.querySelectorAll('input[name="violance_data[bentuk_kekerasan][]"]');
        const checkboxContainer = checkboxes[0]?.closest('div').parentElement;
        function validateCheckboxes() {
            const checked = Array.from(checkboxes).some(cb => cb.checked);
            const existingError = checkboxContainer?.querySelector('.checkbox-error');
            if (existingError) existingError.remove();
            if (!checked && checkboxContainer) {
                const errorMsg = document.createElement('p');
                errorMsg.className = 'text-red-500 text-xs mt-1 checkbox-error';
                errorMsg.textContent = 'Pilih minimal satu bentuk kekerasan';
                checkboxContainer.appendChild(errorMsg);
                return false;
            }
            return true;
        }

        checkboxes.forEach(cb => cb.addEventListener('change', validateCheckboxes));
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function (e) {
                if (!validateCheckboxes()) {
                    e.preventDefault();
                    checkboxContainer?.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            });
        }
    });
</script>

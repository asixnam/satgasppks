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

    // Handle bentuk_kekerasan - decode JSON if needed
    $oldBentukKekerasan = old('violence_data.bentuk_kekerasan');
    if (is_null($oldBentukKekerasan)) {
        $stored = $formData['bentuk_kekerasan'] ?? [];
        if (is_string($stored)) {
            // Decode JSON string jika diperlukan
            $decoded = json_decode($stored, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $oldBentukKekerasan = $decoded;
            } else {
                // Fallback jika bukan JSON, split by comma
                $oldBentukKekerasan = array_map('trim', explode(',', $stored));
            }
        } else {
            $oldBentukKekerasan = (array) $stored;
        }
    }

    // Handle jenis_kekerasan - decode JSON if needed
    $oldJenisKekerasan = old('violence_data.jenis_kekerasan');
    if (is_null($oldJenisKekerasan)) {
        $stored = $formData['jenis_kekerasan'] ?? [];
        if (is_string($stored)) {
            // Decode JSON string jika diperlukan
            $decoded = json_decode($stored, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $oldJenisKekerasan = $decoded;
            } else {
                // Fallback jika bukan JSON, split by comma
                $oldJenisKekerasan = array_map('trim', explode(',', $stored));
            }
        } else {
            $oldJenisKekerasan = (array) $stored;
        }
    }

    $bentukKekerasanOptions = [
        'Fisik'         => 'Fisik',
        'Psikis'        => 'Psikis',
        'Seksual'       => 'Seksual',
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
            @foreach (collect($bentukKekerasanOptions)->chunk(3) as $row)
            <div class="grid grid-cols-3 gap-2 mb-2">
                @foreach ($row as $value => $label)
                    <div class="flex items-start">
                        <input
                            type="checkbox"
                            name="violence_data[bentuk_kekerasan][]"
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
        @endforeach

            @error('violence_data.bentuk_kekerasan')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Jenis Kekerasan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Jenis Kekerasan <span class="text-red-500">*</span>
            </label>
            <select
                name="violence_data[jenis_kekerasan][]"
                id="jenis_kekerasan"
                multiple
                data-selected='@json($oldJenisKekerasan)'
                class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                required>
            </select>

            @error('violence_data.jenis_kekerasan')
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
                name="violence_data[lokasi_kejadian]"
                value="{{ old('violence_data.lokasi_kejadian', $formData['lokasi_kejadian'] ?? '') }}"
                class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Contoh: Rumah, Kantor, Jalan, dll"
                required
            >
            @error('violence_data.lokasi_kejadian')
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
                name="violence_data[waktu_kejadian]"
                value="{{ old('violence_data.waktu_kejadian', isset($formData['waktu_kejadian']) ? \Carbon\Carbon::parse($formData['waktu_kejadian'])->format('Y-m-d') : '') }}"
                class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                max="{{ date('Y-m-d') }}"
                required
            >
            @error('violence_data.waktu_kejadian')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Deskripsi --}}
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Deskripsi Kekerasan <span class="text-red-500">*</span>
            </label>
            <textarea
                name="violence_data[deskripsi_kekerasan]"
                rows="6"
                class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Jelaskan secara detail kronologi dan bentuk kekerasan yang terjadi..."
                maxlength="3000"
                required
            >{{ old('violence_data.deskripsi_kekerasan', $formData['deskripsi_kekerasan'] ?? '') }}</textarea>
            <div class="text-xs text-gray-500 mt-1">
                <span id="violence-char-count">0</span>/3000 karakter
            </div>
            @error('violence_data.deskripsi_kekerasan')
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
        Seksual: [
            'Ujaran diskriminatif', 'Ekshibisionisme', 'Ucapan seksual', 'Tatapan seksual', 'Pesan seksual',
            'Rekaman tanpa izin', 'Unggah tanpa izin', 'Sebar informasi pribadi', 'Mengintip', 'Rayuan seksual',
            'Sanksi seksual', 'Sentuhan fisik', 'Buka pakaian', 'Pemaksaan seksual', 'Budaya kampus berbahaya',
            'Percobaan perkosaan', 'Perkosaan', 'Paksa aborsi', 'Paksa hamil', 'Sterilisasi paksa',
            'Penyiksaan seksual', 'Eksploitasi seksual', 'Perbudakan seksual', 'Perdagangan orang', 'Pembiaran kekerasan'
        ],
        Diskriminasi: [
            'Penolakan', 'Intimidasi', 'Larangan berkeyakinan', 'Pemaksaan/larangan perayaan & donasi',
            'Penghalangan hak mahasiswa', 'Diskriminasi/intoleransi lainnya'
        ],
    };

    function updateJenisKekerasan() {
        const selectedBentuk = Array.from(document.querySelectorAll('.bentuk-kekerasan-checkbox'))
            .filter(cb => cb.checked)
            .map(cb => cb.value);

        const jenisSelect = document.getElementById('jenis_kekerasan');

        // Ambil data yang dipilih sebelumnya
        let selectedValues = [];
        try {
            selectedValues = JSON.parse(jenisSelect.getAttribute('data-selected') || '[]');
        } catch (e) {
            selectedValues = [];
        }

        // Simpan nilai yang sudah dipilih untuk mempertahankannya
        const currentlySelected = Array.from(jenisSelect.selectedOptions).map(option => option.value);

        // Kosongkan isi select
        jenisSelect.innerHTML = '';

        // Gabungkan semua jenis dari bentuk terpilih
        const combinedOptions = new Set();
        selectedBentuk.forEach(bentuk => {
            if (jenisKekerasanOptions[bentuk]) {
                jenisKekerasanOptions[bentuk].forEach(jenis => combinedOptions.add(jenis));
            }
        });

        // Tambahkan opsi
        combinedOptions.forEach(jenis => {
            const option = document.createElement('option');
            option.value = jenis;
            option.textContent = jenis;

            // Cek apakah harus dipilih berdasarkan:
            // 1. Data yang sudah ada sebelumnya (selectedValues)
            // 2. Pilihan saat ini (currentlySelected)
            if (selectedValues.includes(jenis) || currentlySelected.includes(jenis)) {
                option.selected = true;
            }

            jenisSelect.appendChild(option);
        });

        // Update data-selected dengan pilihan saat ini
        jenisSelect.setAttribute('data-selected', JSON.stringify(Array.from(jenisSelect.selectedOptions).map(option => option.value)));
    }

    // Character counter
    function updateCharCount() {
        const textarea = document.querySelector('textarea[name="violence_data[deskripsi_kekerasan]"]');
        const counter = document.getElementById('violence-char-count');
        if (textarea && counter) {
            counter.textContent = textarea.value.length;
        }
    }

    // Initialize saat halaman dimuat
    document.addEventListener('DOMContentLoaded', () => {
        // Update jenis kekerasan berdasarkan bentuk yang terpilih
        updateJenisKekerasan();

        // Setup event listeners
        document.querySelectorAll('.bentuk-kekerasan-checkbox').forEach(cb => {
            cb.addEventListener('change', updateJenisKekerasan);
        });

        // Setup character counter
        const textarea = document.querySelector('textarea[name="violence_data[deskripsi_kekerasan]"]');
        if (textarea) {
            textarea.addEventListener('input', updateCharCount);
            updateCharCount(); // Initialize count
        }

        // Setup change listener untuk jenis kekerasan
        const jenisSelect = document.getElementById('jenis_kekerasan');
        if (jenisSelect) {
            jenisSelect.addEventListener('change', function() {
                // Update data-selected saat user mengubah pilihan
                const selected = Array.from(this.selectedOptions).map(option => option.value);
                this.setAttribute('data-selected', JSON.stringify(selected));
            });
        }
    });
</script>

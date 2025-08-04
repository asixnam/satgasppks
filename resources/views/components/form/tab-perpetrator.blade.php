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
            'hubungan_dengan_korban' => $editData->hubungan_dengan_korban ?? '',
            'nama' => $editData->nama ?? '',
            'telepon' => $editData->telepon ?? '',
            'jenis_kelamin' => $editData->jenis_kelamin ?? '',
            'keterangan' => $editData->keterangan ?? '',
            'upload_bukti' => $editData->upload_bukti ?? []
        ];
    }
    // Jika tidak ada data apapun, gunakan array kosong (untuk create)
@endphp

<!-- Perpetrator Tab -->
<div id="perpetrator" class="tab-content hidden">
    <h5 class="text-lg font-medium mb-4">Informasi Pelaku</h5>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Hubungan dengan Korban <span class="text-red-500">*</span>
            </label>
            <input type="text"
                   name="perpetrator_data[hubungan_dengan_korban]"
                   value="{{ old('perpetrator_data.hubungan_dengan_korban', $formData['hubungan_dengan_korban'] ?? '') }}"
                   class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   placeholder="Contoh: Suami, Ayah, Teman, dll"
                   required>
            @error('perpetrator_data.hubungan_dengan_korban')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Nama Pelaku <span class="text-red-500">*</span>
            </label>
            <input type="text"
                   name="perpetrator_data[nama]"
                   value="{{ old('perpetrator_data.nama', $formData['nama'] ?? '') }}"
                   class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   placeholder="Masukkan nama lengkap pelaku"
                   required>
            @error('perpetrator_data.nama')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
            <input type="text"
                   name="perpetrator_data[telepon]"
                   value="{{ old('perpetrator_data.telepon', $formData['telepon'] ?? '') }}"
                   class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   placeholder="Contoh: 081234567890"
                   pattern="[0-9+\-\s]*">
            @error('perpetrator_data.telepon')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Jenis Kelamin <span class="text-red-500">*</span>
            </label>
            <select name="perpetrator_data[jenis_kelamin]"
                    class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    required>
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Laki-laki" {{ old('perpetrator_data.jenis_kelamin', $formData['jenis_kelamin'] ?? '') == 'Laki-laki' ? 'selected' : '' }}>
                    Laki-laki
                </option>
                <option value="Perempuan" {{ old('perpetrator_data.jenis_kelamin', $formData['jenis_kelamin'] ?? '') == 'Perempuan' ? 'selected' : '' }}>
                    Perempuan
                </option>
            </select>
            @error('perpetrator_data.jenis_kelamin')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Keterangan <span class="text-red-500">*</span>
            </label>
            <textarea name="perpetrator_data[keterangan]"
                      rows="4"
                      class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                      placeholder="Jelaskan keterangan tambahan tentang pelaku..."
                      maxlength="2000"
                      required>{{ old('perpetrator_data.keterangan', $formData['keterangan'] ?? '') }}</textarea>
            <div class="text-xs text-gray-500 mt-1">
                <span id="char-count">0</span>/2000 karakter
            </div>
            @error('perpetrator_data.keterangan')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Upload Bukti <span class="text-gray-500 text-sm">(Opsional, Maks 5 file, 5MB/file)</span>
            </label>
            
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-blue-400 transition-colors">
                <svg class="mx-auto h-8 w-8 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                </svg>
                <p class="text-sm text-gray-600 mb-2">
                    Klik untuk upload atau drag & drop file
                </p>
                <p class="text-xs text-gray-500 mb-3">
                    JPG, PNG, PDF, DOC, DOCX
                </p>
                <input type="file"
                       name="perpetrator_data[upload_bukti][]"
                       id="file-input"
                       multiple
                       accept=".jpg,.jpeg,.png,.pdf,.doc,.docx"
                       class="hidden">
                <button type="button" onclick="document.getElementById('file-input').click()"
                        class="px-4 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition-colors">
                    Pilih File
                </button>
            </div>

            <div id="file-list" class="mt-3 hidden">
                <p class="text-sm font-medium text-gray-700 mb-2">File dipilih:</p>
                <div id="files-container" class="space-y-2"></div>
            </div>

            @if(isset($formData['upload_bukti']) && !empty($formData['upload_bukti']))
                <div class="mt-4">
                    <p class="text-sm font-medium text-gray-700 mb-2">File yang sudah ada:</p>
                    <div class="space-y-2">
                        @php
                            $files = is_string($formData['upload_bukti']) ? json_decode($formData['upload_bukti'], true) : $formData['upload_bukti'];
                        @endphp
                        @foreach($files ?? [] as $file)
                            <div class="flex items-center justify-between p-2 bg-gray-50 rounded border">
                                <span class="text-sm text-gray-700 truncate">{{ basename($file) }}</span>
                                <a href="{{ asset('storage/' . $file) }}" target="_blank" 
                                   class="text-blue-600 hover:text-blue-700 text-sm">Lihat</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @error('perpetrator_data.upload_bukti')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Character counter
    const textarea = document.querySelector('textarea[name="perpetrator_data[keterangan]"]');
    const counter = document.getElementById('char-count');
    
    function updateCount() {
        const count = textarea.value.length;
        counter.textContent = count;
        counter.style.color = count > 1800 ? '#ef4444' : count > 1500 ? '#f59e0b' : '#6b7280';
    }
    
    if (textarea && counter) {
        updateCount();
        textarea.addEventListener('input', updateCount);
    }

    // File upload
    const fileInput = document.getElementById('file-input');
    const fileList = document.getElementById('file-list');
    const filesContainer = document.getElementById('files-container');
    
    fileInput.addEventListener('change', function() {
        const files = this.files;
        filesContainer.innerHTML = '';
        
        if (files.length === 0) {
            fileList.classList.add('hidden');
            return;
        }
        
        if (files.length > 5) {
            alert('Maksimal 5 file');
            this.value = '';
            return;
        }
        
        let valid = true;
        Array.from(files).forEach((file, index) => {
            if (file.size > 5 * 1024 * 1024) {
                alert(`${file.name} terlalu besar (maks 5MB)`);
                valid = false;
                return;
            }
            
            const div = document.createElement('div');
            div.className = 'flex items-center justify-between p-2 bg-blue-50 rounded border';
            div.innerHTML = `
                <span class="text-sm text-gray-700 truncate">${file.name}</span>
                <button type="button" onclick="removeFile(${index})" class="text-red-600 hover:text-red-700 text-sm">
                    Hapus
                </button>
            `;
            filesContainer.appendChild(div);
        });
        
        if (!valid) {
            this.value = '';
            fileList.classList.add('hidden');
            return;
        }
        
        fileList.classList.remove('hidden');
    });
    
    window.removeFile = function(index) {
        const dt = new DataTransfer();
        Array.from(fileInput.files).forEach((file, i) => {
            if (i !== index) dt.items.add(file);
        });
        fileInput.files = dt.files;
        fileInput.dispatchEvent(new Event('change'));
    };
});
</script>
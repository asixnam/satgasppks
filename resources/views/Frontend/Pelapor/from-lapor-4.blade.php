@extends('Frontend.Home.home')

@section('content')
<div class="form-container py-4 px-2">
    <div class="container mx-auto max-w-4xl p-14">
        <!-- Progress Indicator -->
        <div class="progress-indicator">
            <div class="flex justify-center items-center">
                <div class="flex items-center">
                    <div class="progress-step completed">1</div>
                    <span class="ml-2 text-xs sm:text-sm text-blue-600 font-medium hidden sm:inline">Pelapor</span>
                </div>
                <div class="progress-line"></div>
                <div class="flex items-center">
                    <div class="progress-step active-step">2</div>
                    <span class="ml-2 text-xs sm:text-sm text-blue-600 font-medium hidden sm:inline">Klien(Korban)</span>
                </div>
                <div class="flex items-center">
                    <div class="progress-step completed">3</div>
                    <span class="ml-2 text-xs sm:text-sm text-green-400 font-medium hidden sm:inline">Kekerasan</span>
                </div>
                <div class="progress-line"></div>
                 <div class="flex items-center">
                    <div class="progress-step active-step">4</div>
                    <span class="ml-2 text-xs sm:text-sm text-blue-600 font-medium hidden sm:inline">Pelaku</span>
                </div>
            </div>
        </div>

        <div class="form-card">
            <!-- Header Section -->
            <div class="header-section">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-white bg-opacity-20 rounded-full mb-4">
                    <i class="fas fa-user-shield text-2xl text-white"></i>
                </div>
                <h1 class="text-2xl sm:text-3xl font-bold text-white mb-2">Informasi Pelaku</h1>
                <p class="text-white text-opacity-90 text-sm sm:text-base">Lengkapi data pelaku dengan benar dan akurat</p>
            </div>

            <!-- Form Section -->
            <div class="form-section p-4 sm:p-8">
                <form id="pelakuForm" action="{{ route('lapor.step4.post') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    
                    <!-- Basic Information -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
                        <!-- Hubungan dengan Korban -->
                        <div class="input-group">
                            <select name="hubungan_dengan_korban" id="hubungan_dengan_korban" class="form-input" required>
                                <option value="" disabled {{ old('hubungan_dengan_korban') ? '' : 'selected' }} hidden>Pilih Hubungan</option>
                                <option value="keluarga" {{ old('hubungan_dengan_korban') == 'keluarga' ? 'selected' : '' }}>Keluarga</option>
                                <option value="teman" {{ old('hubungan_dengan_korban') == 'teman' ? 'selected' : '' }}>Teman</option>
                                <option value="tetangga" {{ old('hubungan_dengan_korban') == 'tetangga' ? 'selected' : '' }}>Tetangga</option>
                                <option value="rekan_kerja" {{ old('hubungan_dengan_korban') == 'rekan_kerja' ? 'selected' : '' }}>Rekan Kerja</option>
                                <option value="dosen" {{ old('hubungan_dengan_korban') == 'dosen' ? 'selected' : '' }}>Dosen</option>
                                <option value="mahasiswa" {{ old('hubungan_dengan_korban') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                                <option value="staff" {{ old('hubungan_dengan_korban') == 'staff' ? 'selected' : '' }}>Staff</option>
                                <option value="atasan" {{ old('hubungan_dengan_korban') == 'atasan' ? 'selected' : '' }}>Atasan</option>
                                <option value="bawahan" {{ old('hubungan_dengan_korban') == 'bawahan' ? 'selected' : '' }}>Bawahan</option>
                                <option value="tidak_dikenal" {{ old('hubungan_dengan_korban') == 'tidak_dikenal' ? 'selected' : '' }}>Tidak Dikenal</option>
                                <option value="lainnya" {{ old('hubungan_dengan_korban') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            <label for="hubungan_dengan_korban" class="form-label">Hubungan dengan Korban *</label>
                            <i class="fas fa-users input-icon"></i>
                            @error('hubungan_dengan_korban')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- NIK -->
                        <div class="input-group">
                            <input type="text" name="nik_pelaku" id="nik_pelaku" class="form-input" placeholder=" " value="{{ old('nik_pelaku') }}" maxlength="16">
                            <label for="nik_pelaku" class="form-label">NIK Pelaku</label>
                            <i class="fas fa-id-card input-icon"></i>
                            @error('nik_pelaku')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nama Lengkap -->
                        <div class="input-group">
                            <input type="text" name="nama_pelaku" id="nama_pelaku" class="form-input" placeholder=" " value="{{ old('nama_pelaku') }}" required>
                            <label for="nama_pelaku" class="form-label">Nama Lengkap Pelaku *</label>
                            <i class="fas fa-user input-icon"></i>
                            @error('nama_pelaku')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Jenis Kelamin -->
                        <div class="input-group">
                            <select name="jenis_kelamin_pelaku" id="jenis_kelamin_pelaku" class="form-input" required>
                                <option value="" disabled {{ old('jenis_kelamin_pelaku') ? '' : 'selected' }} hidden>Pilih Jenis Kelamin</option>
                                <option value="laki-laki" {{ old('jenis_kelamin_pelaku') == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="perempuan" {{ old('jenis_kelamin_pelaku') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            <label for="jenis_kelamin_pelaku" class="form-label">Jenis Kelamin *</label>
                            <i class="fas fa-venus-mars input-icon"></i>
                            @error('jenis_kelamin_pelaku')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Umur -->
                        <div class="input-group">
                            <input type="number" name="umur_pelaku" id="umur_pelaku" class="form-input" placeholder=" " value="{{ old('umur_pelaku') }}" min="1" max="100">
                            <label for="umur_pelaku" class="form-label">Umur Pelaku</label>
                            <i class="fas fa-calendar-alt input-icon"></i>
                            @error('umur_pelaku')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tempat Lahir -->
                        <div class="input-group">
                            <input type="text" name="tempat_lahir_pelaku" id="tempat_lahir_pelaku" class="form-input" placeholder=" " value="{{ old('tempat_lahir_pelaku') }}">
                            <label for="tempat_lahir_pelaku" class="form-label">Tempat Lahir</label>
                            <i class="fas fa-map-marker-alt input-icon"></i>
                            @error('tempat_lahir_pelaku')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tanggal Lahir -->
                        <div class="input-group">
                            <input type="date" name="tanggal_lahir_pelaku" id="tanggal_lahir_pelaku" class="form-input" placeholder=" " value="{{ old('tanggal_lahir_pelaku') }}" max="{{ date('Y-m-d') }}">
                            <label for="tanggal_lahir_pelaku" class="form-label">Tanggal Lahir</label>
                            <i class="fas fa-birthday-cake input-icon"></i>
                            @error('tanggal_lahir_pelaku')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Agama -->
                        <div class="input-group">
                            <select name="agama_pelaku" id="agama_pelaku" class="form-input">
                                <option value="" disabled {{ old('agama_pelaku') ? '' : 'selected' }} hidden>Pilih Agama</option>
                                <option value="Islam" {{ old('agama_pelaku') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen" {{ old('agama_pelaku') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                <option value="Katolik" {{ old('agama_pelaku') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                <option value="Hindu" {{ old('agama_pelaku') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Buddha" {{ old('agama_pelaku') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                <option value="Konghucu" {{ old('agama_pelaku') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                            </select>
                            <label for="agama_pelaku" class="form-label">Agama</label>
                            <i class="fas fa-pray input-icon"></i>
                            @error('agama_pelaku')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status Perkawinan -->
                        <div class="input-group">
                            <select name="status_perkawinan_pelaku" id="status_perkawinan_pelaku" class="form-input">
                                <option value="" disabled {{ old('status_perkawinan_pelaku') ? '' : 'selected' }} hidden>Pilih Status Perkawinan</option>
                                <option value="Belum Menikah" {{ old('status_perkawinan_pelaku') == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                                <option value="Menikah" {{ old('status_perkawinan_pelaku') == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                                <option value="Cerai" {{ old('status_perkawinan_pelaku') == 'Cerai' ? 'selected' : '' }}>Cerai</option>
                                <option value="Janda/Duda" {{ old('status_perkawinan_pelaku') == 'Janda/Duda' ? 'selected' : '' }}>Janda/Duda</option>
                            </select>
                            <label for="status_perkawinan_pelaku" class="form-label">Status Perkawinan</label>
                            <i class="fas fa-heart input-icon"></i>
                            @error('status_perkawinan_pelaku')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Pendidikan -->
                        <div class="input-group">
                            <select name="pendidikan_pelaku" id="pendidikan_pelaku" class="form-input">
                                <option value="" disabled {{ old('pendidikan_pelaku') ? '' : 'selected' }} hidden>Pilih Pendidikan</option>
                                <option value="SD" {{ old('pendidikan_pelaku') == 'SD' ? 'selected' : '' }}>SD</option>
                                <option value="SMP" {{ old('pendidikan_pelaku') == 'SMP' ? 'selected' : '' }}>SMP</option>
                                <option value="SMA/SMK" {{ old('pendidikan_pelaku') == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                                <option value="Diploma" {{ old('pendidikan_pelaku') == 'Diploma' ? 'selected' : '' }}>Diploma</option>
                                <option value="Sarjana" {{ old('pendidikan_pelaku') == 'Sarjana' ? 'selected' : '' }}>Sarjana</option>
                                <option value="Magister" {{ old('pendidikan_pelaku') == 'Magister' ? 'selected' : '' }}>Magister</option>
                                <option value="Doktor" {{ old('pendidikan_pelaku') == 'Doktor' ? 'selected' : '' }}>Doktor</option>
                            </select>
                            <label for="pendidikan_pelaku" class="form-label">Pendidikan</label>
                            <i class="fas fa-graduation-cap input-icon"></i>
                            @error('pendidikan_pelaku')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Pekerjaan -->
                        <div class="input-group">
                            <input type="text" name="pekerjaan_pelaku" id="pekerjaan_pelaku" class="form-input" placeholder=" " value="{{ old('pekerjaan_pelaku') }}">
                            <label for="pekerjaan_pelaku" class="form-label">Pekerjaan</label>
                            <i class="fas fa-briefcase input-icon"></i>
                            @error('pekerjaan_pelaku')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Alamat -->
                        <div class="input-group lg:col-span-2">
                            <textarea name="alamat_pelaku" id="alamat_pelaku" class="form-input" placeholder=" " rows="3">{{ old('alamat_pelaku') }}</textarea>
                            <label for="alamat_pelaku" class="form-label">Alamat Lengkap</label>
                            <i class="fas fa-home input-icon"></i>
                            @error('alamat_pelaku')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nomor Telepon -->
                        <div class="input-group">
                            <input type="text" name="telepon_pelaku" id="telepon_pelaku" class="form-input" placeholder=" " value="{{ old('telepon_pelaku') }}">
                            <label for="telepon_pelaku" class="form-label">Nomor Telepon</label>
                            <i class="fas fa-phone input-icon"></i>
                            @error('telepon_pelaku')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Jenis Kekerasan -->
                        <div class="input-group">
                            <select name="jenis_kekerasan" id="jenis_kekerasan" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="" disabled {{ old('jenis_kekerasan') ? '' : 'selected' }} hidden>Pilih Jenis Kekerasan</option>
                                <option value="fisik" {{ old('jenis_kekerasan') == 'fisik' ? 'selected' : '' }}>Kekerasan Fisik</option>
                                <option value="psikis" {{ old('jenis_kekerasan') == 'psikis' ? 'selected' : '' }}>Kekerasan Psikis</option>
                                <option value="seksual" {{ old('jenis_kekerasan') == 'seksual' ? 'selected' : '' }}>Kekerasan Seksual</option>
                                <option value="verbal" {{ old('jenis_kekerasan') == 'verbal' ? 'selected' : '' }}>Kekerasan Verbal</option>
                                <option value="ekonomi" {{ old('jenis_kekerasan') == 'ekonomi' ? 'selected' : '' }}>Kekerasan Ekonomi</option>
                                <option value="penelantaran" {{ old('jenis_kekerasan') == 'penelantaran' ? 'selected' : '' }}>Penelantaran</option>
                                <option value="lainnya" {{ old('jenis_kekerasan') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            <label for="jenis_kekerasan" class="form-label">Jenis Kekerasan *</label>
                            <i class="fas fa-exclamation-triangle input-icon"></i>
                            
                            @error('jenis_kekerasan')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Waktu Kejadian -->
                        <div class="input-group">
                            <input type="datetime-local" name="waktu_kejadian" id="waktu_kejadian" class="form-input" placeholder=" " value="{{ old('waktu_kejadian') }}">
                            <label for="waktu_kejadian" class="form-label">Waktu Kejadian</label>
                            <i class="fas fa-clock input-icon"></i>
                            @error('waktu_kejadian')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tempat Kejadian -->
                        <div class="input-group lg:col-span-2">
                            <textarea name="tempat_kejadian" id="tempat_kejadian" class="form-input" placeholder=" " rows="3">{{ old('tempat_kejadian') }}</textarea>
                            <label for="tempat_kejadian" class="form-label">Tempat Kejadian</label>
                            <i class="fas fa-location-arrow input-icon"></i>
                            @error('tempat_kejadian')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Kronologi -->
                        <div class="input-group lg:col-span-2">
                            <textarea name="kronologi" id="kronologi" class="form-input" placeholder=" " rows="5" required>{{ old('kronologi') }}</textarea>
                            <label for="kronologi" class="form-label">Kronologi Kejadian *</label>
                            <i class="fas fa-file-alt input-icon"></i>
                            @error('kronologi')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Keterangan Tambahan -->
                        <div class="input-group lg:col-span-2">
                            <textarea name="keterangan_tambahan" id="keterangan_tambahan" class="form-input" placeholder=" " rows="3">{{ old('keterangan_tambahan') }}</textarea>
                            <label for="keterangan_tambahan" class="form-label">Keterangan Tambahan</label>
                            <i class="fas fa-comment input-icon"></i>
                            @error('keterangan_tambahan')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Upload Bukti -->
<div class="input-group lg:col-span-2">
    <label for="upload_bukti" class="block text-sm font-semibold text-gray-800 mb-2">
        Upload Bukti Pendukung
    </label>

    <label for="upload_bukti" class="w-full flex flex-col items-center justify-center px-6 py-10 bg-white border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-primary-500 transition">
        <i class="fas fa-cloud-upload-alt text-4xl text-primary-500 mb-3"></i>
        <span class="text-gray-700 font-medium">Klik atau seret file ke sini</span>
        <span class="text-xs text-gray-500 mt-1">Format: PDF, JPG, PNG, DOC (Maks 5MB/file)</span>
        <input type="file" name="upload_bukti[]" id="upload_bukti" class="hidden" multiple accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
    </label>

    <div id="file-preview" class="mt-4 space-y-1 text-sm text-gray-600"></div>

    @error('upload_bukti')
        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
    @enderror
</div>
                    </div>

                    <!-- Error/Success Messages -->
                    @if(session('error'))
                        <div class="alert alert-error mt-4">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success mt-4">
                            <i class="fas fa-check-circle"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row justify-between items-center pt-6 gap-4 border-t border-gray-200 mt-6">
                        <button type="button" class="back-btn" onclick="window.history.back()">
                            <i class="fas fa-arrow-left"></i>
                            <span>Kembali</span>
                        </button>
                        
                        <button type="submit" class="submit-btn">
                            <i class="fas fa-paper-plane"></i>
                            <span>Kirim Laporan</span>
                        </button>
                    </div>
                </form>
            </div>


        </div>

        <!-- Information Box -->
        <div class="info-box">
            <div class="flex items-start">
                <i class="fas fa-shield-alt text-blue-600 text-lg mr-3 mt-1 flex-shrink-0"></i>
                <div>
                    <h3 class="text-blue-800 font-semibold mb-2">Jaminan Kerahasiaan & Keamanan</h3>
                    <p class="text-blue-700 text-sm leading-relaxed">
                        Semua informasi yang Anda berikan akan dijaga kerahasiaannya dan ditangani oleh tim profesional. 
                        Laporan akan diproses sesuai dengan prosedur yang berlaku untuk memastikan keamanan dan perlindungan korban.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('pelakuForm');
    const submitBtn = form.querySelector('button[type="submit"]');
    
    // Initialize all form functionalities
    initializeFloatingLabels();
    initializeFileUpload();
    initializeFormValidation();
    initializeInputFilters();
    initializeFormSubmission();
    initializeKeyboardNavigation();

    // Floating labels functionality
    function initializeFloatingLabels() {
        document.querySelectorAll('select.form-input, input.form-input, textarea.form-input').forEach(field => {
            field.addEventListener('change', updateLabel);
            field.addEventListener('input', updateLabel);
            field.addEventListener('focus', updateLabel);
            field.addEventListener('blur', updateLabel);
            
            // Check initial state
            if (field.value) {
                field.classList.add('has-value');
            }
        });

        function updateLabel() {
            if (this.value) {
                this.classList.add('has-value');
            } else {
                this.classList.remove('has-value');
            }
        }
    }

    // File upload functionality
    function initializeFileUpload() {
        const fileInput = document.getElementById('upload_bukti');
        const filePreview = document.getElementById('file-preview');
        
        fileInput.addEventListener('change', function() {
            filePreview.innerHTML = '';
            
            if (this.files.length > 0) {
                const fileList = document.createElement('div');
                fileList.className = 'file-list';
                
                Array.from(this.files).forEach((file, index) => {
                    const fileItem = document.createElement('div');
                    fileItem.className = 'file-item flex items-center justify-between p-2 bg-gray-50 rounded mb-2';
                    
                    const fileInfo = document.createElement('div');
                    fileInfo.className = 'flex items-center';
                    
                    const fileIcon = document.createElement('i');
                    fileIcon.className = getFileIcon(file.type);
                    fileIcon.style.marginRight = '8px';
                    fileIcon.style.color = '#6b7280';
                    
                    const fileName = document.createElement('span');
                    fileName.textContent = file.name;
                    fileName.className = 'text-sm text-gray-700';
                    
                    const fileSize = document.createElement('span');
                    fileSize.textContent = ` (${formatFileSize(file.size)})`;
                    fileSize.className = 'text-xs text-gray-500';
                    
                    fileInfo.appendChild(fileIcon);
                    fileInfo.appendChild(fileName);
                    fileInfo.appendChild(fileSize);
                    
                    const removeBtn = document.createElement('button');
                    removeBtn.type = 'button';
                    removeBtn.className = 'text-red-500 hover:text-red-700 text-sm';
                    removeBtn.innerHTML = '<i class="fas fa-times"></i>';
                    removeBtn.onclick = () => removeFile(index);
                    
                    fileItem.appendChild(fileInfo);
                    fileItem.appendChild(removeBtn);
                    fileList.appendChild(fileItem);
                });
                
                filePreview.appendChild(fileList);
            }
        });
        
        function getFileIcon(fileType) {
            if (fileType.includes('pdf')) return 'fas fa-file-pdf';
            if (fileType.includes('image')) return 'fas fa-file-image';
            if (fileType.includes('word') || fileType.includes('document')) return 'fas fa-file-word';
            return 'fas fa-file';
        }
        
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }
        
        function removeFile(index) {
            const dt = new DataTransfer();
            const files = fileInput.files;
            
            for (let i = 0; i < files.length; i++) {
                if (i !== index) {
                    dt.items.add(files[i]);
                }
            }
            
            fileInput.files = dt.files;
            fileInput.dispatchEvent(new Event('change'));
        }
    }

    // Form validation functionality
    function initializeFormValidation() {
        const requiredFields = form.querySelectorAll('[required]');
        
        requiredFields.forEach(field => {
            field.addEventListener('blur', function() {
                validateField(this);
            });
            
            field.addEventListener('input', function() {
                if (this.classList.contains('error')) {
                    validateField(this);
                }
            });
        });
        
        function validateField(field) {
            const value = field.value.trim();
            const fieldContainer = field.closest('.input-group');
            
            if (value === '') {
                field.classList.add('error');
                field.style.borderColor = '#ef4444';
                showFieldError(fieldContainer, 'Field ini wajib diisi');
            } else {
                field.classList.remove('error');
                field.style.borderColor = '#10b981';
                hideFieldError(fieldContainer);
            }
        }
        
        function showFieldError(container, message) {
            let errorDiv = container.querySelector('.error-message');
            if (!errorDiv) {
                errorDiv = document.createElement('div');
                errorDiv.className = 'error-message';
                container.appendChild(errorDiv);
            }
            errorDiv.textContent = message;
        }
        
        function hideFieldError(container) {
            const errorDiv = container.querySelector('.error-message');
            if (errorDiv) {
                errorDiv.remove();
            }
        }
    }

    // Input filters functionality
    function initializeInputFilters() {
        // NIK filter (only numbers, max 16 digits)
        const nikInput = document.getElementById('nik_pelaku');
        if (nikInput) {
            nikInput.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '').substring(0, 16);
            });
        }

        // Name filters (only letters and spaces)
        const namaInput = document.getElementById('nama_pelaku');
        if (namaInput) {
            namaInput.addEventListener('input', function() {
                this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
            });
        }

        const tempatLahirInput = document.getElementById('tempat_lahir_pelaku');
        if (tempatLahirInput) {
            tempatLahirInput.addEventListener('input', function() {
                this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
            });
        }

        // Phone number filter (only numbers and +, -, (, ), spaces)
        const teleponInput = document.getElementById('telepon_pelaku');
        if (teleponInput) {
            teleponInput.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9+\-\(\)\s]/g, '');
            });
        }

        // Age validation
        const umurInput = document.getElementById('umur_pelaku');
        if (umurInput) {
            umurInput.addEventListener('input', function() {
                let value = parseInt(this.value);
                if (value < 1) this.value = 1;
                if (value > 100) this.value = 100;
            });
        }

        // Character limit for text areas
        const textareas = ['kronologi', 'keterangan_tambahan', 'alamat_pelaku', 'tempat_kejadian'];
        textareas.forEach(id => {
            const textarea = document.getElementById(id);
            if (textarea) {
                textarea.addEventListener('input', function() {
                    const maxLength = this.getAttribute('maxlength') || 1000;
                    if (this.value.length > maxLength) {
                        this.value = this.value.substring(0, maxLength);
                    }
                });
            }
        });
    }

    // Form submission functionality
    function initializeFormSubmission() {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Disable submit button to prevent double submission
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> <span>Mengirim...</span>';
            
            // Validate all required fields
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('error');
                    field.style.borderColor = '#ef4444';
                    
                    const fieldContainer = field.closest('.input-group');
                    showFieldError(fieldContainer, 'Field ini wajib diisi');
                }
            });
            
            // Validate file uploads
            const fileInput = document.getElementById('upload_bukti');
            if (fileInput.files.length > 0) {
                const maxSize = 5 * 1024 * 1024; // 5MB
                const allowedTypes = ['application/pdf', 'image/jpeg', 'image/jpg', 'image/png', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
                
                Array.from(fileInput.files).forEach(file => {
                    if (file.size > maxSize) {
                        isValid = false;
                        showAlert('File ' + file.name + ' terlalu besar. Maksimal 5MB per file.', 'error');
                    }
                    
                    if (!allowedTypes.includes(file.type)) {
                        isValid = false;
                        showAlert('File ' + file.name + ' tidak diizinkan. Hanya PDF, JPG, PNG, DOC yang diperbolehkan.', 'error');
                    }
                });
            }
            
            // Validate NIK format
            const nikInput = document.getElementById('nik_pelaku');
            if (nikInput.value && nikInput.value.length !== 16) {
                isValid = false;
                nikInput.classList.add('error');
                nikInput.style.borderColor = '#ef4444';
                showFieldError(nikInput.closest('.input-group'), 'NIK harus 16 digit');
            }
            
            // Validate phone number format
            const teleponInput = document.getElementById('telepon_pelaku');
            if (teleponInput.value && teleponInput.value.length < 10) {
                isValid = false;
                teleponInput.classList.add('error');
                teleponInput.style.borderColor = '#ef4444';
                showFieldError(teleponInput.closest('.input-group'), 'Nomor telepon minimal 10 digit');
            }
            
            if (isValid) {
                // Show confirmation dialog
                showConfirmationDialog();
            } else {
                // Re-enable submit button
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fas fa-paper-plane"></i> <span>Kirim Laporan</span>';
                
                // Scroll to first error
                const firstError = form.querySelector('.error');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
        });
        
        function showFieldError(container, message) {
            let errorDiv = container.querySelector('.error-message');
            if (!errorDiv) {
                errorDiv = document.createElement('div');
                errorDiv.className = 'error-message';
                errorDiv.style.color = '#ef4444';
                errorDiv.style.fontSize = '0.875rem';
                errorDiv.style.marginTop = '0.25rem';
                container.appendChild(errorDiv);
            }
            errorDiv.textContent = message;
        }
        
        function showAlert(message, type) {
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert alert-${type} fixed top-4 right-4 z-50 max-w-md`;
            alertDiv.innerHTML = `
                <div class="flex items-center">
                    <i class="fas fa-${type === 'error' ? 'exclamation-circle' : 'check-circle'} mr-2"></i>
                    <span>${message}</span>
                </div>
            `;
            
            document.body.appendChild(alertDiv);
            
            setTimeout(() => {
                alertDiv.remove();
            }, 5000);
        }
        
        function showConfirmationDialog() {
    // Hapus dialog sebelumnya jika ada
    const existingDialog = document.getElementById('confirmation-dialog');
    if (existingDialog) existingDialog.remove();

    const dialog = document.createElement('div');
    dialog.id = 'confirmation-dialog';
    dialog.className = 'fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-[1000]';
    dialog.innerHTML = `
        <div class="bg-white rounded-xl shadow-xl p-6 w-full max-w-md mx-4 animate-fadeIn">
            <div class="flex items-center mb-4">
                <div class="bg-blue-100 text-blue-600 rounded-full p-2 mr-3">
                    <i class="fas fa-question-circle text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800">Konfirmasi Pengiriman</h3>
            </div>
            <p class="text-gray-600 mb-6 text-sm leading-relaxed">
                Apakah Anda yakin ingin mengirim laporan ini? Pastikan semua data sudah benar.
            </p>
            <div class="flex justify-end gap-3">
                <button 
                    type="button" 
                    class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition"
                    onclick="
                        document.getElementById('confirmation-dialog').remove();
                        const submitBtn = document.getElementById('pelakuForm').querySelector('button[type=submit]');
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = '<i class=\\'fas fa-paper-plane\\'></i> <span>Kirim Laporan</span>';
                    ">
                    Batal
                </button>
                <button 
                    type="button" 
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"
                    onclick="
                        document.getElementById('confirmation-dialog').remove();
                        document.getElementById('pelakuForm').submit();
                    ">
                    Ya, Kirim
                </button>
            </div>
        </div>
    `;

    document.body.appendChild(dialog);
}

    }

    // Keyboard navigation functionality
    function initializeKeyboardNavigation() {
        const formInputs = form.querySelectorAll('input, select, textarea, button');
        
        formInputs.forEach((input, index) => {
            input.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && this.tagName !== 'TEXTAREA') {
                    e.preventDefault();
                    const nextInput = formInputs[index + 1];
                    if (nextInput) {
                        nextInput.focus();
                    }
                }
            });
        });
    }

    // Auto-save functionality (optional)
    function initializeAutoSave() {
        const formData = {};
        
        form.querySelectorAll('input, select, textarea').forEach(field => {
            field.addEventListener('input', function() {
                formData[this.name] = this.value;
                // Save to sessionStorage for temporary storage
                sessionStorage.setItem('pelakuFormData', JSON.stringify(formData));
            });
        });
        
        // Load saved data on page load
        const savedData = sessionStorage.getItem('pelakuFormData');
        if (savedData) {
            const data = JSON.parse(savedData);
            Object.keys(data).forEach(key => {
                const field = form.querySelector(`[name="${key}"]`);
                if (field) {
                    field.value = data[key];
                    field.dispatchEvent(new Event('change'));
                }
            });
        }
    }

    // Initialize auto-save if needed
    // initializeAutoSave();
    
    // Additional utility functions
    function formatPhoneNumber(input) {
        let value = input.value.replace(/\D/g, '');
        if (value.length >= 10) {
            value = value.replace(/(\d{4})(\d{4})(\d{4})/, '$1-$2-$3');
        }
        input.value = value;
    }
    
    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
    
    function sanitizeInput(input) {
        return input.trim().replace(/[<>]/g, '');
    }
    
    // Add smooth scrolling for form navigation
    function scrollToElement(element) {
        element.scrollIntoView({
            behavior: 'smooth',
            block: 'center'
        });
    }
    
    // Add loading state management
    function setLoadingState(isLoading) {
        if (isLoading) {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> <span>Mengirim...</span>';
        } else {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fas fa-paper-plane"></i> <span>Kirim Laporan</span>';
        }
    }
    
    // Add form reset functionality
    function resetForm() {
        form.reset();
        document.querySelectorAll('.has-value').forEach(field => {
            field.classList.remove('has-value');
        });
        document.querySelectorAll('.error').forEach(field => {
            field.classList.remove('error');
            field.style.borderColor = '';
        });
        document.querySelectorAll('.error-message').forEach(error => {
            error.remove();
        });
        document.getElementById('file-preview').innerHTML = '';
        sessionStorage.removeItem('pelakuFormData');
    }
    
    // Expose useful functions globally if needed
    window.formUtils = {
        resetForm,
        setLoadingState,
        scrollToElement,
        formatPhoneNumber,
        validateEmail,
        sanitizeInput
    };
});
</script>

<link rel="stylesheet" href="{{ asset('assets/pelapor/pelapor.css') }}">

@endsection
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
                    <i class="fas fa-user-edit text-2xl text-white"></i>
                </div>
                <h1 class="text-2xl sm:text-3xl font-bold text-white mb-2">Informasi Klien (Korban)</h1>
                <p class="text-white text-opacity-90 text-sm sm:text-base">Silakan lengkapi informasi klien di bawah ini</p>
            </div>

            <!-- Form Section -->
            <div class="form-section p-4 sm:p-8">
                <form id="clientForm" action="{{ route('lapor.step2.post') }}" method="POST">
                    @csrf
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
                        <!-- Nama Lengkap -->
                        <div class="input-group lg:col-span-2">
                            <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-input" placeholder=" " value="{{ old('nama_lengkap') }}" required>
                            <label for="nama_lengkap" class="form-label">Nama Lengkap *</label>
                            <i class="fas fa-user input-icon"></i>
                            @error('nama_lengkap')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- NIM -->
                        <div class="input-group">
                            <input type="text" name="nim" id="nim" class="form-input" placeholder=" " value="{{ old('nim') }}" required>
                            <label for="nim" class="form-label">NIM *</label>
                            <i class="fas fa-id-card input-icon"></i>
                            @error('nim')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Program Studi -->
                        <div class="input-group">
                            <select name="program_studi" id="program_studi" class="form-input" required>
                                <option value="" disabled {{ old('program_studi') ? '' : 'selected' }} hidden>Pilih Program Studi</option>
                                <option value="Teknik Elektro" {{ old('program_studi') == 'Teknik Elektro' ? 'selected' : '' }}>Teknik Elektro</option>
                                <option value="Teknik Komputer" {{ old('program_studi') == 'Teknik Komputer' ? 'selected' : '' }}>Teknik Komputer</option>
                                <option value="Informatika" {{ old('program_studi') == 'Informatika' ? 'selected' : '' }}>Informatika</option>
                                <option value="Manajemen" {{ old('program_studi') == 'Manajemen' ? 'selected' : '' }}>Manajemen</option>
                                <option value="Akuntansi" {{ old('program_studi') == 'Akuntansi' ? 'selected' : '' }}>Akuntansi</option>
                                <option value="Agribisnis" {{ old('program_studi') == 'Agribisnis' ? 'selected' : '' }}>Agribisnis</option>
                                <option value="Teknologi Hasil Pertanian" {{ old('program_studi') == 'Teknologi Hasil Pertanian' ? 'selected' : '' }}>Teknologi Hasil Pertanian</option>
                                <option value="Farmasi" {{ old('program_studi') == 'Farmasi' ? 'selected' : '' }}>Farmasi</option>
                                <option value="Pendidikan Guru Sekolah Dasar" {{ old('program_studi') == 'Pendidikan Guru Sekolah Dasar' ? 'selected' : '' }}>Pendidikan Guru Sekolah Dasar</option>
                                <option value="Pendidikan Bahasa Inggris" {{ old('program_studi') == 'Pendidikan Bahasa Inggris' ? 'selected' : '' }}>Pendidikan Bahasa Inggris</option>
                                <option value="Studi Islam Interdisipliner" {{ old('program_studi') == 'Studi Islam Interdisipliner' ? 'selected' : '' }}>Studi Islam Interdisipliner</option>
                            </select>
                            <label for="program_studi" class="form-label">Program Studi *</label>
                            <i class="fas fa-graduation-cap input-icon"></i>
                            @error('program_studi')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Fakultas -->
                        <div class="input-group">
                            <select name="fakultas" id="fakultas" class="form-input" required>
                                <option value="" disabled {{ old('fakultas') ? '' : 'selected' }} hidden>Pilih Fakultas</option>
                                <option value="Fakultas Teknologi Informasi" {{ old('fakultas') == 'Fakultas Teknologi Informasi' ? 'selected' : '' }}>Fakultas Teknologi Informasi</option>
                                <option value="Fakultas Ekonomi" {{ old('fakultas') == 'Fakultas Ekonomi' ? 'selected' : '' }}>Fakultas Ekonomi</option>
                                <option value="Fakultas Industri Halal" {{ old('fakultas') == 'Fakultas Industri Halal' ? 'selected' : '' }}>Fakultas Industri Halal</option>
                                <option value="Fakultas Dirasah Islamiyah" {{ old('fakultas') == 'Fakultas Dirasah Islamiyah' ? 'selected' : '' }}>Fakultas Dirasah Islamiyah</option>
                                <option value="Fakultas Ilmu Pendidikan" {{ old('fakultas') == 'Fakultas Ilmu Pendidikan' ? 'selected' : '' }}>Fakultas Ilmu Pendidikan</option>
                            </select>
                            <label for="fakultas" class="form-label">Fakultas *</label>
                            <i class="fas fa-university input-icon"></i>
                            @error('fakultas')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Angkatan -->
                        <div class="input-group">
                            <input type="text" name="angkatan" id="angkatan" class="form-input" placeholder=" " value="{{ old('angkatan') }}" required>
                            <label for="angkatan" class="form-label">Angkatan *</label>
                            <i class="fas fa-calendar-alt input-icon"></i>
                            @error('angkatan')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tempat Lahir -->
                        <div class="input-group">
                            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-input" placeholder=" " value="{{ old('tempat_lahir') }}" required>
                            <label for="tempat_lahir" class="form-label">Tempat Lahir *</label>
                            <i class="fas fa-map-marker-alt input-icon"></i>
                            @error('tempat_lahir')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tanggal Lahir -->
                        <div class="input-group">
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-input" placeholder=" " value="{{ old('tanggal_lahir') }}" max="{{ date('Y-m-d') }}" required>
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir *</label>
                            <i class="fas fa-birthday-cake input-icon"></i>
                            @error('tanggal_lahir')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Agama -->
                        <div class="input-group">
                            <select name="agama" id="agama" class="form-input" required>
                                <option value="" disabled {{ old('agama') ? '' : 'selected' }} hidden>Pilih Agama</option>
                                <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                            </select>
                            <label for="agama" class="form-label">Agama *</label>
                            <i class="fas fa-pray input-icon"></i>
                            @error('agama')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status Perkawinan -->
                        <div class="input-group">
                            <select name="status_perkawinan" id="status_perkawinan" class="form-input" required>
                                <option value="" disabled {{ old('status_perkawinan') ? '' : 'selected' }} hidden>Pilih Status Perkawinan</option>
                                <option value="Belum Menikah" {{ old('status_perkawinan') == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                                <option value="Menikah" {{ old('status_perkawinan') == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                                <option value="Cerai" {{ old('status_perkawinan') == 'Cerai' ? 'selected' : '' }}>Cerai</option>
                                <option value="Janda/Duda" {{ old('status_perkawinan') == 'Janda/Duda' ? 'selected' : '' }}>Janda/Duda</option>
                            </select>
                            <label for="status_perkawinan" class="form-label">Status Perkawinan *</label>
                            <i class="fas fa-heart input-icon"></i>
                            @error('status_perkawinan')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Sumber Rujukan -->
                        <div class="input-group lg:col-span-2">
                            <input type="text" name="sumber_rujukan" id="sumber_rujukan" class="form-input" placeholder=" " value="{{ old('sumber_rujukan') }}" required>
                            <label for="sumber_rujukan" class="form-label">Sumber Rujukan/Informasi *</label>
                            <i class="fas fa-info-circle input-icon"></i>
                            @error('sumber_rujukan')
                                <div class="error-message">{{ $message }}</div>
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
                        <a href="{{ route('lapor.form') }}" class="back-btn order-2 sm:order-1">
                            <i class="fas fa-arrow-left"></i>
                            <span>Kembali</span>
                        </a>
                        
                        <button type="submit" class="submit-btn order-1 sm:order-2">
                            <i class="fas fa-arrow-right"></i>
                            <span>Lanjutkan</span>
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
                    <h3 class="text-blue-800 font-semibold mb-2">Jaminan Kerahasiaan</h3>
                    <p class="text-blue-700 text-sm leading-relaxed">
                        Semua informasi yang Anda berikan akan dijaga kerahasiaannya sesuai dengan ketentuan yang berlaku. 
                        Data pribadi hanya akan digunakan untuk keperluan penanganan kasus dan tidak akan disebarluaskan tanpa persetujuan.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>




<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('clientForm');
    const submitBtn = form.querySelector('button[type="submit"]');
    
    // Handle floating labels
    initializeFloatingLabels();
    
    // Auto-populate fakultas based on program studi
    initializeFakultasAutofill();
    
    // Form submission handler
    initializeFormSubmission();
    
    // Real-time validation
    initializeRealTimeValidation();
    
    // Input filters
    initializeInputFilters();
    
    // Keyboard navigation
    initializeKeyboardNavigation();

    // Floating labels functionality
    function initializeFloatingLabels() {
        document.querySelectorAll('select.form-input, input.form-input').forEach(field => {
            field.addEventListener('change', updateLabel);
            field.addEventListener('input', updateLabel);
            
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

    // Auto-populate fakultas based on program studi
    function initializeFakultasAutofill() {
        const prodiSelect = document.getElementById('program_studi');
        const fakultasSelect = document.getElementById('fakultas');
        
        const prodiToFakultas = {
            'Teknik Elektro': 'Fakultas Teknologi Informasi',
            'Teknik Komputer': 'Fakultas Teknologi Informasi',
            'Informatika': 'Fakultas Teknologi Informasi',
            'Manajemen': 'Fakultas Ekonomi',
            'Akuntansi': 'Fakultas Ekonomi',
            'Agribisnis': 'Fakultas Industri Halal',
            'Teknologi Hasil Pertanian': 'Fakultas Industri Halal',
            'Farmasi': 'Fakultas Industri Halal',
            'Pendidikan Guru Sekolah Dasar': 'Fakultas Ilmu Pendidikan',
            'Pendidikan Bahasa Inggris': 'Fakultas Ilmu Pendidikan',
            'Studi Islam Interdisipliner': 'Fakultas Dirasah Islamiyah'
        };
        
        prodiSelect.addEventListener('change', function() {
            const selectedProdi = this.value;
            const correspondingFakultas = prodiToFakultas[selectedProdi];
            
            if (correspondingFakultas) {
                fakultasSelect.value = correspondingFakultas;
                fakultasSelect.classList.add('has-value');
            }
        });
    }

    // Form submission functionality
    function initializeFormSubmission() {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!form.checkValidity()) {
                const firstInvalid = form.querySelector(':invalid');
                if (firstInvalid) {
                    firstInvalid.scrollIntoView({behavior: 'smooth', block: 'center'});
                    firstInvalid.focus();
                }
                return;
            }

            // Show loading state
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i><span>Menyimpan...</span>';
            
            // Submit the form
            this.submit();
        });
    }

    // Real-time validation functionality
    function initializeRealTimeValidation() {
        form.querySelectorAll('[required]').forEach(field => {
            field.addEventListener('blur', function() {
                if (this.value.trim() === '') {
                    this.style.borderColor = '#ef4444';
                } else {
                    this.style.borderColor = '#10b981';
                }
            });
        });
    }

    // Input filters functionality
    function initializeInputFilters() {
        // Filter for name input (only letters and spaces)
        document.getElementById('nama_lengkap').addEventListener('input', function() {
            this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
        });

        // Filter for birth place input (only letters and spaces)
        document.getElementById('tempat_lahir').addEventListener('input', function() {
            this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
        });
        
        // Filter for angkatan (only numbers, 4 digits)
        document.getElementById('angkatan').addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '').substring(0, 4);
        });
    }

    // Keyboard navigation functionality
    function initializeKeyboardNavigation() {
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && e.target.tagName !== 'TEXTAREA') {
                e.preventDefault();
                const inputs = Array.from(form.querySelectorAll('input, select'));
                const currentIndex = inputs.indexOf(e.target);
                const nextInput = inputs[currentIndex + 1];
                
                if (nextInput) {
                    nextInput.focus();
                } else {
                    form.querySelector('button[type="submit"]').focus();
                }
            }
        });
    }
});
</script>

<link rel="stylesheet" href="{{ asset('assets/pelapor/pelapor.css') }}">

@endsection
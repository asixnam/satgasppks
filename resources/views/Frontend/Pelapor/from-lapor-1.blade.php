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
                <h1 class="text-2xl sm:text-3xl font-bold text-white mb-2">Informasi Pelapor</h1>
                <p class="text-white text-opacity-90 text-sm sm:text-base">Mohon lengkapi informasi pelapor dengan akurat</p>
            </div>

            <!-- Form Section -->
            <div class="form-section p-4 sm:p-8">
                <form id="reporterForm" action="{{ route('lapor.post') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
                        
                        <!-- Hubungan Pelapor-Klien -->
                        <div class="input-group lg:col-span-2">
                            <select name="hubungan" id="hubungan" class="form-input" required>
                                <option value="" disabled {{ old('hubungan') ? '' : 'selected' }} hidden>Pilih Hubungan</option>
                                <option value="diri_sendiri" {{ old('hubungan') == 'diri_sendiri' ? 'selected' : '' }}>Diri Sendiri</option>
                                <option value="keluarga" {{ old('hubungan') == 'keluarga' ? 'selected' : '' }}>Keluarga</option>
                                <option value="teman_dekat" {{ old('hubungan') == 'teman_dekat' ? 'selected' : '' }}>Teman Dekat</option>
                                <option value="teman_kos" {{ old('hubungan') == 'teman_kos' ? 'selected' : '' }}>Teman Kos</option>
                                <option value="teman_organisasi" {{ old('hubungan') == 'teman_organisasi' ? 'selected' : '' }}>Teman Organisasi</option>
                                <option value="tetangga" {{ old('hubungan') == 'tetangga' ? 'selected' : '' }}>Tetangga</option>
                                <option value="rekan_kerja" {{ old('hubungan') == 'rekan_kerja' ? 'selected' : '' }}>Rekan Kerja</option>
                                <option value="lainnya" {{ old('hubungan') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            <label for="hubungan" class="form-label">Hubungan Pelapor dengan Klien *</label>
                            <i class="fas fa-users input-icon"></i>
                            @error('hubungan')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nama Lengkap -->
                        <div class="input-group lg:col-span-2">
                            <input type="text" name="nama" id="nama" class="form-input" placeholder=" " value="{{ old('nama') }}" required>
                            <label for="nama" class="form-label">Nama Lengkap *</label>
                            <i class="fas fa-user input-icon"></i>
                            @error('nama')
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

                        <!-- Jenis Kelamin -->
                        <div class="input-group">
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-input" required>
                                <option value="" disabled {{ old('jenis_kelamin') ? '' : 'selected' }} hidden>Pilih Jenis Kelamin</option>
                                <option value="laki-laki" {{ old('jenis_kelamin') == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="perempuan" {{ old('jenis_kelamin') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin *</label>
                            <i class="fas fa-venus-mars input-icon"></i>
                            @error('jenis_kelamin')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Usia -->
                        <div class="input-group">
                            <input type="number" name="usia" id="usia" min="1" max="120" class="form-input" placeholder=" " value="{{ old('usia') }}" required>
                            <label for="usia" class="form-label">Usia (tahun) *</label>
                            <i class="fas fa-calendar-alt input-icon"></i>
                            @error('usia')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Pekerjaan -->
                        <div class="input-group">
                            <input type="text" name="pekerjaan" id="pekerjaan" class="form-input" placeholder=" " value="{{ old('pekerjaan') }}">
                            <label for="pekerjaan" class="form-label">Pekerjaan/Profesi</label>
                            <i class="fas fa-briefcase input-icon"></i>
                            @error('pekerjaan')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- No. Telepon -->
                        <div class="input-group">
                            <input type="tel" name="no_telepon" id="no_telepon" class="form-input" placeholder=" " value="{{ old('no_telepon') }}">
                            <label for="no_telepon" class="form-label">No. Telepon/WhatsApp</label>
                            <i class="fas fa-phone input-icon"></i>
                            @error('no_telepon')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Alamat -->
                        <div class="input-group lg:col-span-2">
                            <textarea name="alamat" id="alamat" class="form-textarea" placeholder=" " rows="3" required>{{ old('alamat') }}</textarea>
                            <label for="alamat" class="form-label">Alamat Lengkap *</label>
                            <i class="fas fa-map-marked-alt input-icon"></i>
                            @error('alamat')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Keterangan Tambahan -->
                        <div class="input-group lg:col-span-2">
                            <textarea name="keterangan" id="keterangan" class="form-textarea" placeholder=" " rows="3">{{ old('keterangan') }}</textarea>
                            <label for="keterangan" class="form-label">Keterangan Tambahan</label>
                            <i class="fas fa-info-circle input-icon"></i>
                            @error('keterangan')
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
                        
                        
                        <button type="submit" class="submit-btn ml-auto order-1 sm:order-2">
                            <i class="fas fa-save"></i>
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
                        Data pribadi hanya akan digunakan untuk keperluan penanganan kasus.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('reporterForm');
    const submitBtn = form.querySelector('button[type="submit"]');
    
    // Initialize Flatpickr for date input
    flatpickr("#tanggal_lahir", {
        dateFormat: "d/m/Y",
        maxDate: "today",
        yearDropdown: true,
        monthDropdown: true
    });

    // Handle floating labels
    initializeFloatingLabels();

    // Auto calculate age from birth date
    initializeAgeCalculation();

    // Format phone number
    initializePhoneNumberFormatting();

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
        document.querySelectorAll('select.form-input, input.form-input, textarea.form-textarea').forEach(field => {
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

    // Age calculation functionality
    function initializeAgeCalculation() {
        document.getElementById('tanggal_lahir').addEventListener('change', function() {
            const dateParts = this.value.split('/');
            if (dateParts.length === 3) {
                const birthDate = new Date(dateParts[2], dateParts[1] - 1, dateParts[0]);
                const today = new Date();
                let age = today.getFullYear() - birthDate.getFullYear();
                const monthDiff = today.getMonth() - birthDate.getMonth();
                
                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                
                if (age >= 0 && age <= 120) {
                    const usiaInput = document.getElementById('usia');
                    usiaInput.value = age;
                    usiaInput.classList.add('has-value');
                }
            }
        });
    }

    // Phone number formatting functionality
    function initializePhoneNumberFormatting() {
        document.getElementById('no_telepon').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            
            if (value.startsWith('0')) {
                value = '62' + value.substring(1);
            } else if (!value.startsWith('62') && value.length > 0) {
                value = '62' + value;
            }
            
            e.target.value = value;
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
            
            // Simulate form processing
            setTimeout(() => {
                alert('Data berhasil disimpan!');
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fas fa-save"></i><span>Simpan dan Lanjutkan</span>';
            }, 1500);
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
        document.getElementById('nama').addEventListener('input', function() {
            this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
        });

        // Filter for birth place input (only letters and spaces)
        document.getElementById('tempat_lahir').addEventListener('input', function() {
            this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
        });
    }

    // Keyboard navigation functionality
    function initializeKeyboardNavigation() {
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && e.target.tagName !== 'TEXTAREA') {
                e.preventDefault();
                const inputs = Array.from(form.querySelectorAll('input, select, textarea'));
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
@extends('layouts.app')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
{{-- CSS yang kamu sudah buat sebelumnya tetap digunakan --}}
<style>
    .form-container {
        background: white;
        min-height: 100vh;
        position: relative;
        overflow: hidden;
    }
    
    .form-container::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -20%;
        width: 150%;
        height: 200%;
        background: radial-gradient(circle at 20% 20%, rgba(59,130,246,0.05) 0%, transparent 40%);
        animation: backgroundMove 20s ease-in-out infinite;
    }
    
    @keyframes backgroundMove {
        0%, 100% { transform: translateX(0) translateY(0); }
        50% { transform: translateX(30px) translateY(-20px); }
    }
    
    .form-card {
        background: rgba(255,255,255,0.98);
        border-radius: 20px;
        box-shadow: 0 25px 45px rgba(0,0,0,0.1);
        position: relative;
        z-index: 1;
        border: 1px solid rgba(0,0,0,0.05);
        margin: 1rem;
    }
    
    .header-section {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        background-size: 400% 400%;
        animation: gradientAnimation 8s ease infinite;
        padding: 2rem;
        text-align: center;
        border-radius: 20px 20px 0 0;
    }
    
    @keyframes gradientAnimation {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    
    .progress-indicator {
        background: rgba(59,130,246,0.1);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        padding: 1rem;
        margin: 1rem;
        border: 1px solid rgba(59,130,246,0.2);
    }
    
    .progress-step {
        transition: all 0.3s ease;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 0.75rem;
    }
    
    .progress-step.completed {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
    }
    
    .progress-step.active-step {
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        color: white;
    }
    
    .progress-step.inactive {
        background: rgba(59,130,246,0.1);
        color: rgba(59,130,246,0.6);
        border: 2px solid rgba(59,130,246,0.2);
    }
    
    .progress-line {
        height: 2px;
        background: linear-gradient(90deg, #10b981, #3b82f6);
        border-radius: 1px;
        width: 24px;
        flex-shrink: 0;
    }
    
    .input-group {
        position: relative;
        margin-bottom: 1.5rem;
    }
    
    .form-input, .form-textarea {
        width: 100%;
        padding: 0.875rem 0.875rem 0.875rem 2.5rem;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        background: rgba(255,255,255,0.9);
    }
    
    .form-textarea {
        resize: vertical;
        min-height: 100px;
    }
    
    .form-input:focus, .form-textarea:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
        transform: translateY(-1px);
    }
    
    .form-input:valid {
        border-color: #10b981;
    }
    
    .form-label {
        position: absolute;
        left: 2.5rem;
        top: 0.875rem;
        color: #6b7280;
        font-weight: 500;
        transition: all 0.3s ease;
        pointer-events: none;
        background: white;
        padding: 0 0.25rem;
        font-size: 0.875rem;
    }
    
    .form-input:focus + .form-label,
    .form-input:not(:placeholder-shown) + .form-label,
    .form-input.has-value + .form-label,
    .form-textarea:focus + .form-label,
    .form-textarea:not(:placeholder-shown) + .form-label {
        top: -0.375rem;
        left: 2rem;
        font-size: 0.75rem;
        color: #3b82f6;
    }
    
    .input-icon {
        position: absolute;
        left: 0.75rem;
        top: 0.875rem;
        color: #9ca3af;
        transition: all 0.3s ease;
        font-size: 0.875rem;
    }
    
    .form-input:focus ~ .input-icon,
    .form-textarea:focus ~ .input-icon {
        color: #3b82f6;
        transform: scale(1.05);
    }
    
    .btn {
        padding: 0.875rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        font-size: 0.875rem;
        text-decoration: none;
    }
    
    .submit-btn {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        color: white;
        box-shadow: 0 8px 16px rgba(59,130,246,0.3);
    }
    
    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 24px rgba(59,130,246,0.4);
    }
    
    .back-btn {
        background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
        color: white;
    }
    
    .back-btn:hover {
        transform: translateY(-1px);
        color: white;
        text-decoration: none;
    }
    
    .section-divider {
        background: linear-gradient(135deg, rgba(59,130,246,0.05) 0%, rgba(147,197,253,0.05) 100%);
        border: 1px solid rgba(59,130,246,0.1);
        border-radius: 12px;
        padding: 1.25rem;
        margin: 1.5rem 0;
    }
    
    .section-title {
        color: #1f2937;
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .info-box {
        background: linear-gradient(135deg, rgba(59,130,246,0.1) 0%, rgba(147,197,253,0.1) 100%);
        border: 2px solid rgba(59,130,246,0.2);
        border-radius: 12px;
        padding: 1.25rem;
        margin: 1rem;
    }
    
    .required-mark {
        color: #ef4444;
        font-weight: 600;
    }
    
    .info-text {
        font-size: 0.75rem;
        color: #6b7280;
        font-style: italic;
        margin-bottom: 0.5rem;
        padding-left: 2.5rem;
    }
    
    /* Responsive Design */
    @media (max-width: 640px) {
        .form-card { margin: 0.5rem; border-radius: 16px; }
        .header-section { padding: 1.5rem 1rem; border-radius: 16px 16px 0 0; }
        .form-section { padding: 1.5rem 1rem; }
        .progress-indicator { padding: 0.75rem; margin: 0.5rem; }
        .progress-step { width: 28px; height: 28px; font-size: 0.7rem; }
        .progress-line { width: 16px; }
        .section-divider { padding: 1rem; margin: 1rem 0; }
        .section-title { font-size: 0.9rem; }
        .form-input, .form-textarea { padding: 0.75rem 0.75rem 0.75rem 2.25rem; font-size: 0.8rem; }
        .form-label { font-size: 0.8rem; left: 2.25rem; }
        .input-icon { left: 0.625rem; font-size: 0.8rem; }
        .btn { padding: 0.75rem 1.25rem; font-size: 0.8rem; }
        .info-text { padding-left: 2.25rem; }
    }
    
    @media (max-width: 480px) {
        .progress-step span { display: none; }
        .header-section h1 { font-size: 1.5rem; }
        .header-section p { font-size: 0.875rem; }
        .form-textarea { min-height: 80px; }
    }
</style>
@show

@section('content')
<div class="form-container">
    <div class="container mx-auto px-2 py-4">
        <div class="max-w-4xl mx-auto p-14">
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
                    <div class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 bg-white bg-opacity-20 rounded-full mb-4">
                        <i class="fas fa-exclamation-triangle text-2xl sm:text-3xl text-white"></i>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-white mb-2">Informasi Kekerasan</h1>
                    <p class="text-sm sm:text-base text-white text-opacity-90">Isi informasi kekerasan dengan lengkap dan benar</p>
                </div>

                <!-- Form Section -->
                <div class="form-section p-4 sm:p-6 lg:p-8">
                    <form action="{{ route('lapor.step3.post') }}" method="POST">
                        @csrf
                        <!-- <input type="hidden" name="pelapor_id" value="{{ $pelapor->id }}"> -->

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
                            <div class="input-group">
                                <select name="jenis_kekerasan" id="jenis_kekerasan" class="form-input" required>
                                    <option value="" disabled hidden>Pilih jenis kekerasan</option>
                                    <option value="fisik" {{ old('jenis_kekerasan') == 'fisik' ? 'selected' : '' }}>Kekerasan Fisik</option>
                                    <option value="psikis" {{ old('jenis_kekerasan') == 'psikis' ? 'selected' : '' }}>Kekerasan Psikis</option>
                                    <option value="seksual" {{ old('jenis_kekerasan') == 'seksual' ? 'selected' : '' }}>Kekerasan Seksual</option>
                                    <option value="ekonomi" {{ old('jenis_kekerasan') == 'ekonomi' ? 'selected' : '' }}>Kekerasan Ekonomi</option>
                                </select>
                                <label for="jenis_kekerasan" class="form-label">Jenis Kekerasan <span class="required-mark">*</span></label>
                                <i class="fas fa-hand-paper input-icon"></i>
                                @error('jenis_kekerasan')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="input-group" id="kategori_group" style="display: {{ old('jenis_kekerasan') == 'seksual' ? 'block' : 'none' }}">
                                <select name="kategori_kekerasan_seksual" id="kategori_kekerasan_seksual" class="form-input">
                                    <option value="" disabled hidden>Pilih kategori</option>
                                    <option value="pelecehan" {{ old('kategori_kekerasan_seksual') == 'pelecehan' ? 'selected' : '' }}>Pelecehan Seksual</option>
                                    <option value="pemerkosaan" {{ old('kategori_kekerasan_seksual') == 'pemerkosaan' ? 'selected' : '' }}>Pemerkosaan</option>
                                    <option value="eksploitasi" {{ old('kategori_kekerasan_seksual') == 'eksploitasi' ? 'selected' : '' }}>Eksploitasi Seksual</option>
                                </select>
                                <label for="kategori_kekerasan_seksual" class="form-label">Kategori Kekerasan Seksual</label>
                                <i class="fas fa-list-alt input-icon"></i>
                            </div>
                        </div>

                        <!-- Lokasi dan waktu -->
                        <div class="section-divider">
                            <h3 class="section-title">
                                <i class="fas fa-map-marker-alt text-orange-500"></i>
                                Informasi Lokasi dan Waktu
                            </h3>

                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
                                <div class="input-group">
                                    <select name="lokus_kejadian" class="form-input" required>
                                        <option value="" disabled hidden>Pilih lokasi</option>
                                        <option value="rumah" {{ old('lokus_kejadian') == 'rumah' ? 'selected' : '' }}>Rumah</option>
                                        <option value="sekolah" {{ old('lokus_kejadian') == 'sekolah' ? 'selected' : '' }}>Sekolah/Kampus</option>
                                        <option value="tempat_kerja" {{ old('lokus_kejadian') == 'tempat_kerja' ? 'selected' : '' }}>Tempat Kerja</option>
                                        <option value="tempat_umum" {{ old('lokus_kejadian') == 'tempat_umum' ? 'selected' : '' }}>Tempat Umum</option>
                                        <option value="online" {{ old('lokus_kejadian') == 'online' ? 'selected' : '' }}>Online/Media Sosial</option>
                                    </select>
                                    <label class="form-label">Lokus Kejadian <span class="required-mark">*</span></label>
                                    <i class="fas fa-location-arrow input-icon"></i>
                                </div>

                                <div class="input-group">
                                    <input type="datetime-local" name="waktu_kejadian" class="form-input" value="{{ old('waktu_kejadian') }}" required>
                                    <label class="form-label">Waktu Kejadian <span class="required-mark">*</span></label>
                                    <i class="fas fa-clock input-icon"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Tambahan -->
                        <div class="section-divider">
                            <h3 class="section-title">
                                <i class="fas fa-info-circle text-blue-500"></i>
                                Informasi Tambahan
                            </h3>
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
                                <div class="input-group">
                                    <select name="keterangan_pihak_ke3" class="form-input">
                                        <option value="" disabled hidden>Pilih</option>
                                        <option value="ada_saksi" {{ old('keterangan_pihak_ke3') == 'ada_saksi' ? 'selected' : '' }}>Ada Saksi</option>
                                        <option value="tidak_ada_saksi" {{ old('keterangan_pihak_ke3') == 'tidak_ada_saksi' ? 'selected' : '' }}>Tidak Ada Saksi</option>
                                        <option value="ada_pelapor_lain" {{ old('keterangan_pihak_ke3') == 'ada_pelapor_lain' ? 'selected' : '' }}>Ada Pelapor Lain</option>
                                    </select>
                                    <label class="form-label">Keterangan Adanya Pihak ke-3</label>
                                    <i class="fas fa-users input-icon"></i>
                                </div>

                                <div class="input-group">
                                    <select name="kategori_pidana" class="form-input">
                                        <option value="" disabled hidden>Pilih</option>
                                        <option value="ringan" {{ old('kategori_pidana') == 'ringan' ? 'selected' : '' }}>Pidana Ringan</option>
                                        <option value="sedang" {{ old('kategori_pidana') == 'sedang' ? 'selected' : '' }}>Pidana Sedang</option>
                                        <option value="berat" {{ old('kategori_pidana') == 'berat' ? 'selected' : '' }}>Pidana Berat</option>
                                    </select>
                                    <label class="form-label">Kategori Pidana</label>
                                    <i class="fas fa-gavel input-icon"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Narasi -->
                        <div class="section-divider">
                            <h3 class="section-title">
                                <i class="fas fa-file-alt text-red-500"></i>
                                Deskripsi Kekerasan
                            </h3>
                            <div class="space-y-4 sm:space-y-6">
                                <div class="input-group">
                                    <textarea name="bentuk_kekerasan" class="form-textarea" required>{{ old('bentuk_kekerasan') }}</textarea>
                                    <label class="form-label">Bentuk Kekerasan <span class="required-mark">*</span></label>
                                    <i class="fas fa-edit input-icon"></i>
                                </div>
                                <div class="input-group">
                                    <div class="info-text">
                                        <strong>Panduan:</strong> Jelaskan proses, modus dan eksploitasi yang dialami; kapan dan dimana terjadi; seberapa sering terjadi
                                    </div>
                                    <textarea name="narasi_kronologis" class="form-textarea" style="min-height: 120px;" required>{{ old('narasi_kronologis') }}</textarea>
                                    <label class="form-label">Narasi Kronologis Kekerasan <span class="required-mark">*</span></label>
                                    <i class="fas fa-list-ol input-icon"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol -->
                        <div class="flex flex-col sm:flex-row justify-between items-center pt-6 sm:pt-8 gap-3 sm:gap-4 border-t border-gray-200 mt-6 sm:mt-8">
                            <button type="button" class="btn back-btn w-full sm:w-auto" onclick="history.back()">
                                <i class="fas fa-arrow-left"></i>
                                <span>Kembali</span>
                            </button>
                            <button type="submit" class="btn submit-btn w-full sm:w-auto">
                                <i class="fas fa-save"></i>
                                <span>Simpan dan Lanjutkan</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Box Info -->
            <div class="info-box">
                <div class="flex items-start">
                    <i class="fas fa-shield-alt text-blue-600 text-base sm:text-lg mr-3 mt-1 flex-shrink-0"></i>
                    <div>
                        <h3 class="text-blue-800 font-semibold mb-2 text-sm sm:text-base">Jaminan Kerahasiaan</h3>
                        <p class="text-blue-700 text-xs sm:text-sm leading-relaxed">
                            Data Anda akan dijaga kerahasiaannya dan hanya digunakan untuk keperluan penanganan kasus ini sesuai dengan ketentuan yang berlaku.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@show

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('violenceForm');

    document.querySelectorAll('select.form-input, input.form-input, textarea.form-textarea').forEach(field => {
        field.addEventListener('change', updateLabel);
        field.addEventListener('input', updateLabel);
    });

    function updateLabel() {
        if (this.value) {
            this.classList.add('has-value');
        } else {
            this.classList.remove('has-value');
        }
    }

    // Auto resize
    document.querySelectorAll('textarea').forEach(textarea => {
        textarea.addEventListener('input', function () {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });
    });

    // Toggle kategori kekerasan seksual
    document.getElementById('jenis_kekerasan').addEventListener('change', function () {
        const kategoriGroup = document.getElementById('kategori_group');
        const kategoriField = document.getElementById('kategori_kekerasan_seksual');

        if (this.value === 'seksual') {
            kategoriGroup.style.display = 'block';
            kategoriField.setAttribute('required', 'required');
        } else {
            kategoriGroup.style.display = 'none';
            kategoriField.removeAttribute('required');
            kategoriField.value = '';
            kategoriField.classList.remove('has-value');
        }
    });
});
</script>
@show

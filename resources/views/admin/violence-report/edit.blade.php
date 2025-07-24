@extends('layouts.admin')

@section('title', 'Edit Laporan Kekerasan')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Edit Laporan Kekerasan</h3>
                        <a href="{{ url('/admin/violence-reports/' . $report->id) }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>

                <form id="reportForm" action="{{ url('/admin/violence-reports/' . $report->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="client-tab" data-bs-toggle="tab" data-bs-target="#client" type="button" role="tab">
                                    <i class="fas fa-user"></i> Data Klien
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="reporter-tab" data-bs-toggle="tab" data-bs-target="#reporter" type="button" role="tab">
                                    <i class="fas fa-user-tie"></i> Data Pelapor
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="perpetrator-tab" data-bs-toggle="tab" data-bs-target="#perpetrator" type="button" role="tab">
                                    <i class="fas fa-user-times"></i> Data Pelaku
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="violence-tab" data-bs-toggle="tab" data-bs-target="#violence" type="button" role="tab">
                                    <i class="fas fa-exclamation-triangle"></i> Data Kekerasan
                                </button>
                            </li>
                        </ul>

                        <!-- Tab panes with pre-filled data -->
                        <div class="tab-content mt-4">
                            <!-- Client Tab -->
                            <div class="tab-pane active" id="client" role="tabpanel">
                                <h5 class="mb-3">Informasi Klien (Korban)</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="nama_lengkap">Nama Lengkap <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="client_data[nama_lengkap]" 
                                                   value="{{ $report->client->nama_lengkap ?? '' }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="nim">NIM <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="client_data[nim]" 
                                                   value="{{ $report->client->nim ?? '' }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="program_studi">Program Studi</label>
                                            <input type="text" class="form-control" name="client_data[program_studi]" 
                                                   value="{{ $report->client->program_studi ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="fakultas">Fakultas</label>
                                            <select class="form-control" name="client_data[fakultas]">
                                                <option value="">Pilih Fakultas</option>
                                                <option value="FMIPA" {{ ($report->client->fakultas ?? '') == 'FMIPA' ? 'selected' : '' }}>FMIPA</option>
                                                <option value="FEB" {{ ($report->client->fakultas ?? '') == 'FEB' ? 'selected' : '' }}>FEB</option>
                                                <option value="FH" {{ ($report->client->fakultas ?? '') == 'FH' ? 'selected' : '' }}>FH</option>
                                                <option value="FK" {{ ($report->client->fakultas ?? '') == 'FK' ? 'selected' : '' }}>FK</option>
                                                <option value="FT" {{ ($report->client->fakultas ?? '') == 'FT' ? 'selected' : '' }}>FT</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="angkatan">Angkatan</label>
                                            <input type="number" class="form-control" name="client_data[angkatan]" 
                                                   value="{{ $report->client->angkatan ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="tempat_lahir">Tempat Lahir</label>
                                            <input type="text" class="form-control" name="client_data[tempat_lahir]" 
                                                   value="{{ $report->client->tempat_lahir ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="tanggal_lahir">Tanggal Lahir</label>
                                            <input type="date" class="form-control" name="client_data[tanggal_lahir]" 
                                                   value="{{ $report->client->tanggal_lahir ? $report->client->tanggal_lahir->format('Y-m-d') : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="agama">Agama</label>
                                            <select class="form-control" name="client_data[agama]">
                                                <option value="">Pilih Agama</option>
                                                <option value="Islam" {{ ($report->client->agama ?? '') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                                <option value="Kristen" {{ ($report->client->agama ?? '') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                                <option value="Katolik" {{ ($report->client->agama ?? '') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                                <option value="Hindu" {{ ($report->client->agama ?? '') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                                <option value="Buddha" {{ ($report->client->agama ?? '') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                                <option value="Konghucu" {{ ($report->client->agama ?? '') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="status_perkawinan">Status Perkawinan</label>
                                            <select class="form-control" name="client_data[status_perkawinan]">
                                                <option value="">Pilih Status</option>
                                                <option value="Belum Menikah" {{ old('client_data.status_perkawinan') == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                                                <option value="Menikah" {{ old('client_data.status_perkawinan') == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                                                <option value="Cerai" {{ old('client_data.status_perkawinan') == 'Cerai' ? 'selected' : '' }}>Cerai</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="sumber_rujukan">Sumber Rujukan</label>
                                            <input type="text" class="form-control" name="client_data[sumber_rujukan]" 
                                                   value="{{ old('client_data.sumber_rujukan') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Reporter Tab -->
                            <div class="tab-pane" id="reporter" role="tabpanel">
                                <h5 class="mb-3">Informasi Pelapor</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="reporter_nama">Nama Pelapor <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('reporter_data.nama') is-invalid @enderror" 
                                                   name="reporter_data[nama]" value="{{ old('reporter_data.nama') }}" required>
                                            @error('reporter_data.nama')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="hubungan">Hubungan dengan Korban</label>
                                            <input type="text" class="form-control" name="reporter_data[hubungan]" 
                                                   value="{{ old('reporter_data.hubungan') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="tempat_lahir_reporter">Tempat Lahir</label>
                                            <input type="text" class="form-control" name="reporter_data[tempat_lahir]" 
                                                   value="{{ old('reporter_data.tempat_lahir') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="tanggal_lahir_reporter">Tanggal Lahir</label>
                                            <input type="date" class="form-control" name="reporter_data[tanggal_lahir]" 
                                                   value="{{ old('reporter_data.tanggal_lahir') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="jenis_kelamin">Jenis Kelamin</label>
                                            <select class="form-control" name="reporter_data[jenis_kelamin]">
                                                <option value="">Pilih Jenis Kelamin</option>
                                                <option value="L" {{ old('reporter_data.jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                                <option value="P" {{ old('reporter_data.jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="usia">Usia</label>
                                            <input type="number" class="form-control" name="reporter_data[usia]" 
                                                   value="{{ old('reporter_data.usia') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="pekerjaan">Pekerjaan</label>
                                            <input type="text" class="form-control" name="reporter_data[pekerjaan]" 
                                                   value="{{ old('reporter_data.pekerjaan') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="no_telepon">No. Telepon</label>
                                            <input type="text" class="form-control" name="reporter_data[no_telepon]" 
                                                   value="{{ old('reporter_data.no_telepon') }}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <label for="alamat">Alamat</label>
                                            <textarea class="form-control" name="reporter_data[alamat]" rows="3">{{ old('reporter_data.alamat') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <label for="keterangan">Keterangan</label>
                                            <textarea class="form-control" name="reporter_data[keterangan]" rows="3">{{ old('reporter_data.keterangan') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Perpetrator Tab -->
                            <div class="tab-pane" id="perpetrator" role="tabpanel">
                                <h5 class="mb-3">Informasi Pelaku</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="nama_pelaku">Nama Pelaku <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('perpetrator_data.nama_pelaku') is-invalid @enderror" 
                                                   name="perpetrator_data[nama_pelaku]" value="{{ old('perpetrator_data.nama_pelaku') }}" required>
                                            @error('perpetrator_data.nama_pelaku')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="hubungan_dengan_korban">Hubungan dengan Korban</label>
                                            <input type="text" class="form-control" name="perpetrator_data[hubungan_dengan_korban]" 
                                                   value="{{ old('perpetrator_data.hubungan_dengan_korban') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="nik_pelaku">NIK Pelaku</label>
                                            <input type="text" class="form-control" name="perpetrator_data[nik_pelaku]" 
                                                   value="{{ old('perpetrator_data.nik_pelaku') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="jenis_kelamin_pelaku">Jenis Kelamin</label>
                                            <select class="form-control" name="perpetrator_data[jenis_kelamin_pelaku]">
                                                <option value="">Pilih Jenis Kelamin</option>
                                                <option value="L" {{ old('perpetrator_data.jenis_kelamin_pelaku') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                                <option value="P" {{ old('perpetrator_data.jenis_kelamin_pelaku') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="umur_pelaku">Umur</label>
                                            <input type="number" class="form-control" name="perpetrator_data[umur_pelaku]" 
                                                   value="{{ old('perpetrator_data.umur_pelaku') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="tempat_lahir_pelaku">Tempat Lahir</label>
                                            <input type="text" class="form-control" name="perpetrator_data[tempat_lahir_pelaku]" 
                                                   value="{{ old('perpetrator_data.tempat_lahir_pelaku') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="tanggal_lahir_pelaku">Tanggal Lahir</label>
                                            <input type="date" class="form-control" name="perpetrator_data[tanggal_lahir_pelaku]" 
                                                   value="{{ old('perpetrator_data.tanggal_lahir_pelaku') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="agama_pelaku">Agama</label>
                                            <select class="form-control" name="perpetrator_data[agama_pelaku]">
                                                <option value="">Pilih Agama</option>
                                                <option value="Islam" {{ old('perpetrator_data.agama_pelaku') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                                <option value="Kristen" {{ old('perpetrator_data.agama_pelaku') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                                <option value="Katolik" {{ old('perpetrator_data.agama_pelaku') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                                <option value="Hindu" {{ old('perpetrator_data.agama_pelaku') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                                <option value="Buddha" {{ old('perpetrator_data.agama_pelaku') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                                <option value="Konghucu" {{ old('perpetrator_data.agama_pelaku') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="pekerjaan_pelaku">Pekerjaan</label>
                                            <input type="text" class="form-control" name="perpetrator_data[pekerjaan_pelaku]" 
                                                   value="{{ old('perpetrator_data.pekerjaan_pelaku') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="telepon_pelaku">No. Telepon</label>
                                            <input type="text" class="form-control" name="perpetrator_data[telepon_pelaku]" 
                                                   value="{{ old('perpetrator_data.telepon_pelaku') }}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <label for="alamat_pelaku">Alamat Pelaku</label>
                                            <textarea class="form-control" name="perpetrator_data[alamat_pelaku]" rows="3">{{ old('perpetrator_data.alamat_pelaku') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Violence Tab -->
                            <div class="tab-pane" id="violence" role="tabpanel">
                                <h5 class="mb-3">Informasi Kekerasan</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="jenis_kekerasan">Jenis Kekerasan <span class="text-danger">*</span></label>
                                            <select class="form-control @error('violance_data.jenis_kekerasan') is-invalid @enderror" 
                                                    name="violance_data[jenis_kekerasan]" required>
                                                <option value="">Pilih Jenis Kekerasan</option>
                                                <option value="Fisik" {{ old('violance_data.jenis_kekerasan') == 'Fisik' ? 'selected' : '' }}>Fisik</option>
                                                <option value="Psikis" {{ old('violance_data.jenis_kekerasan') == 'Psikis' ? 'selected' : '' }}>Psikis</option>
                                                <option value="Seksual" {{ old('violance_data.jenis_kekerasan') == 'Seksual' ? 'selected' : '' }}>Seksual</option>
                                                <option value="Ekonomi" {{ old('violance_data.jenis_kekerasan') == 'Ekonomi' ? 'selected' : '' }}>Ekonomi</option>
                                            </select>
                                            @error('violance_data.jenis_kekerasan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="waktu_kejadian">Waktu Kejadian</label>
                                            <input type="datetime-local" class="form-control" name="violance_data[waktu_kejadian]" 
                                                   value="{{ old('violance_data.waktu_kejadian') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="lokus_kejadian">Lokasi Kejadian</label>
                                            <input type="text" class="form-control" name="violance_data[lokus_kejadian]" 
                                                   value="{{ old('violance_data.lokus_kejadian') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="kategori_pidana">Kategori Pidana</label>
                                            <input type="text" class="form-control" name="violance_data[kategori_pidana]" 
                                                   value="{{ old('violance_data.kategori_pidana') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="bentuk_kekerasan">Bentuk Kekerasan</label>
                                            <input type="text" class="form-control" name="violance_data[bentuk_kekerasan]" 
                                                   value="{{ old('violance_data.bentuk_kekerasan') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="keterangan_pihak_ke3">Keterangan Pihak Ke-3</label>
                                            <input type="text" class="form-control" name="violance_data[keterangan_pihak_ke3]" 
                                                   value="{{ old('violance_data.keterangan_pihak_ke3') }}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <label for="narasi_kronologis">Narasi Kronologis</label>
                                            <textarea class="form-control" name="violance_data[narasi_kronologis]" rows="5">{{ old('violance_data.narasi_kronologis') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <a href="{{ url('/admin/violence-reports') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Laporan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$('#reportForm').on('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const data = {};
    
    // Organize data by categories
    for (let [key, value] of formData.entries()) {
        const keys = key.split(/[\[\]]+/).filter(k => k);
        if (keys.length === 2) {
            if (!data[keys[0]]) data[keys[0]] = {};
            data[keys[0]][keys[1]] = value;
        }
    }
    
    $.ajax({
        url: '/admin/violence-reports',
        method: 'POST',
        data: JSON.stringify(data),
        contentType: 'application/json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            Swal.fire('Berhasil!', 'Laporan berhasil disimpan', 'success')
                .then(() => window.location.href = '/admin/violence-reports');
        },
        error: function(xhr) {
            let message = 'Terjadi kesalahan';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                message = xhr.responseJSON.message;
            }
            Swal.fire('Error!', message, 'error');
        }
    });
});
</script>
@endsection


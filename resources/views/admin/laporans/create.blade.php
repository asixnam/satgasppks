@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Tambah Laporan</h1>

    {{-- Menampilkan error validasi --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul class="list-disc pl-6">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.laporans.store') }}" class="bg-white p-6 rounded shadow-md space-y-8">
        @csrf

        {{-- Informasi Laporan --}}
        <div>
            <h2 class="text-lg font-semibold mb-4 border-b pb-2">Informasi Laporan</h2>
            <div class="space-y-4">
                <div>
                    <label>Judul</label>
                    <input type="text" name="judul" class="form-input w-full" />
                </div>
                <div>
                    <label>Isi Laporan</label>
                    <textarea name="isi" class="form-textarea w-full"></textarea>
                </div>
            </div>
        </div>

        {{-- Data Pelapor --}}
        <div>
            <h2 class="text-lg font-semibold mb-4 border-b pb-2">Data Pelapor</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input-text name="pelapor_nama" label="Nama" />
                <input-text name="pelapor_hubungan" label="Hubungan" />
                <input-text name="pelapor_tempat_lahir" label="Tempat Lahir" />
                <input type="date" name="pelapor_tanggal_lahir" class="form-input" />
                <select name="pelapor_jenis_kelamin" class="form-select">
                    <option value="laki-laki">Laki-laki</option>
                    <option value="perempuan">Perempuan</option>
                </select>
                <input type="text" name="pelapor_usia" class="form-input" placeholder="Usia" />
                <input type="text" name="pelapor_pekerjaan" class="form-input" placeholder="Pekerjaan" />
                <input type="text" name="pelapor_no_telepon" class="form-input" placeholder="No. Telepon" />
                <input type="text" name="pelapor_alamat" class="form-input" placeholder="Alamat" />
                <textarea name="pelapor_keterangan" class="form-textarea" placeholder="Keterangan"></textarea>
            </div>
        </div>

        {{-- Data Klien --}}
        <div>
            <h2 class="text-lg font-semibold mb-4 border-b pb-2">Data Klien</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="text" name="klien_nama" placeholder="Nama Lengkap" class="form-input" />
                <input type="text" name="klien_nim" placeholder="NIM" class="form-input" />
                <input type="text" name="klien_program_studi" placeholder="Program Studi" class="form-input" />
                <input type="text" name="klien_fakultas" placeholder="Fakultas" class="form-input" />
                <input type="text" name="klien_angkatan" placeholder="Angkatan" class="form-input" />
                <input type="text" name="klien_tempat_lahir" placeholder="Tempat Lahir" class="form-input" />
                <input type="date" name="klien_tanggal_lahir" class="form-input" />
                <input type="text" name="klien_agama" placeholder="Agama" class="form-input" />
                <input type="text" name="klien_status_perkawinan" placeholder="Status Kawin" class="form-input" />
                <input type="text" name="klien_sumber_rujukan" placeholder="Sumber Rujukan" class="form-input" />
            </div>
        </div>

        {{-- Informasi Kekerasan --}}
        <div>
            <h2 class="text-lg font-semibold mb-4 border-b pb-2">Informasi Kekerasan</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="text" name="jenis_kekerasan" placeholder="Jenis Kekerasan" class="form-input" />
                <input type="text" name="bentuk_kekerasan" placeholder="Bentuk Kekerasan" class="form-input" />
                <input type="text" name="lokus_kejadian" placeholder="Lokus Kejadian" class="form-input" />
                <input type="datetime-local" name="waktu_kejadian" class="form-input" />
                <input type="text" name="kategori_pidana" placeholder="Kategori Pidana" class="form-input" />
                <input type="text" name="keterangan_pihak_ke3" placeholder="Keterangan Pihak Ke-3" class="form-input" />
            </div>
            <div class="mt-4">
                <textarea name="narasi_kronologis" class="form-textarea w-full" placeholder="Narasi Kronologis"></textarea>
            </div>
        </div>

        {{-- Data Pelaku --}}
        <div>
            <h2 class="text-lg font-semibold mb-4 border-b pb-2">Data Pelaku</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="text" name="pelaku_nama" placeholder="Nama" class="form-input" />
                <input type="text" name="pelaku_hubungan" placeholder="Hubungan" class="form-input" />
                <input type="text" name="pelaku_tempat_lahir" placeholder="Tempat Lahir" class="form-input" />
                <input type="date" name="pelaku_tanggal_lahir" class="form-input" />
                <select name="pelaku_jenis_kelamin" class="form-select">
                    <option value="laki-laki">Laki-laki</option>
                    <option value="perempuan">Perempuan</option>
                </select>
                <input type="text" name="pelaku_usia" placeholder="Usia" class="form-input" />
                <input type="text" name="pelaku_pekerjaan" placeholder="Pekerjaan" class="form-input" />
                <input type="text" name="pelaku_no_telepon" placeholder="No. Telepon" class="form-input" />
                <input type="text" name="pelaku_alamat" placeholder="Alamat" class="form-input" />
                <textarea name="pelaku_keterangan" placeholder="Keterangan" class="form-textarea"></textarea>
            </div>
        </div>

        {{-- Tombol Submit --}}
        <div class="pt-4">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">
                Simpan Laporan
            </button>
        </div>
    </form>
</div>
@endsection

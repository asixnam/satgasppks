<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Reporter;
use App\Models\Violance;
use App\Models\Perpetrator;
use App\Models\ViolenceReport;
use Illuminate\Database\Seeder;

class ViolenceReportSeeder extends Seeder
{
    public function run()
    {
        // Sample Client (Korban)
        $client = Client::create([
            'nama_lengkap' => 'Siti Aminah',
            'jenis_kelamin' => 'Perempuan', // sesuai enum: 'Laki-laki', 'Perempuan'
            'status_korban' => 'Disable', // sesuai enum: 'Disable', 'Tidak'
            'kategori_disable' => 'Tuli',
            'status' => 'Mahasiswa',
            'sumber_informasi' => 'Media Sosial'
        ]);

        // Sample Reporter (Pelapor)
        $reporter = Reporter::create([
            'hubungan_pelapor_dengan_pelaku' => 'Tidak Ada Hubungan', // sesuai field di migrasi
            'nama_lengkap' => 'Budi Santoso', // sesuai field di migrasi
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '1999-08-20',
            'jenis_kelamin' => 'Laki-laki', // sesuai enum: 'Laki-laki', 'Perempuan'
            'usia' => 24,
            'status_pelapor' => 'Mahasiswa', // sesuai field di migrasi
            'no_telepon' => '081234567890',
            'alamat' => 'Jl. Merdeka No. 123, Bandung',
            'keterangan_tambahan' => 'Saya melihat langsung kejadian tersebut.' // sesuai field di migrasi
        ]);

        // Sample Violence
        $violance = Violance::create([
            'jenis_kekerasan' => 'Kekerasan Seksual',
            'bentuk_kekerasan' => json_encode(['Ucapan seksual', 'Tatapan seksual']), // JSON array sesuai migrasi
            'lokasi_kejadian' => 'Kampus', // sesuai field di migrasi
            'waktu_kejadian' => '2024-01-15 14:30:00',
            'deskripsi_kekerasan' => 'Pelaku menyampaikan ucapan seksual tidak pantas di depan umum dan memberikan tatapan yang tidak nyaman kepada korban.'
        ]);

        // Sample Perpetrator (Pelaku)
        $perpetrator = Perpetrator::create([
            'hubungan_dengan_korban' => 'Sesama Mahasiswa',
            'nama' => 'John Doe',
            'telepon' => null, // sesuai field di migrasi (nullable)
            'jenis_kelamin' => 'Laki-laki', // sesuai enum: 'Laki-laki', 'Perempuan'
            'keterangan' => 'Berambut cepak, memakai jaket hitam saat kejadian', // sesuai field di migrasi
            'upload_bukti' => json_encode(['bukti1.jpg', 'screenshot_chat.png']) // JSON array
        ]);

        // Hubungkan semua ke dalam violence report
        ViolenceReport::create([
            'id_client' => $client->id,
            'id_reporter' => $reporter->id,
            'id_perpetrator' => $perpetrator->id,
            'id_violance' => $violance->id
        ]);

        // Sample data kedua untuk variasi
        $client2 = Client::create([
            'nama_lengkap' => 'Ahmad Rizki',
            'jenis_kelamin' => 'Laki-laki',
            'status_korban' => 'Tidak',
            'kategori_disable' => null, // null karena status_korban = 'Tidak'
            'status' => 'Dosen',
            'sumber_informasi' => 'Laporan Langsung'
        ]);

        $reporter2 = Reporter::create([
            'hubungan_pelapor_dengan_pelaku' => 'Atasan',
            'nama_lengkap' => 'Maya Sari',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1985-03-15',
            'jenis_kelamin' => 'Perempuan',
            'usia' => 39,
            'status_pelapor' => 'Dosen',
            'no_telepon' => '087654321098',
            'alamat' => 'Jl. Sudirman No. 456, Jakarta',
            'keterangan_tambahan' => 'Melaporkan atas nama korban yang merasa tidak nyaman.'
        ]);

        $violance2 = Violance::create([
            'jenis_kekerasan' => 'Kekerasan Psikis',
            'bentuk_kekerasan' => json_encode(['Intimidasi', 'Ancaman']),
            'lokasi_kejadian' => 'Ruang Kerja',
            'waktu_kejadian' => '2024-02-10 09:15:00',
            'deskripsi_kekerasan' => 'Pelaku melakukan intimidasi berulang kali dan memberikan ancaman terhadap karir korban.'
        ]);

        $perpetrator2 = Perpetrator::create([
            'hubungan_dengan_korban' => 'Rekan Kerja',
            'nama' => 'R.S.',
            'telepon' => '081987654321',
            'jenis_kelamin' => 'Laki-laki',
            'keterangan' => 'Pria berusia sekitar 45 tahun, jabatan senior, sering memakai kemeja biru',
            'upload_bukti' => json_encode(['email_ancaman.pdf', 'rekaman_audio.mp3'])
        ]);

        ViolenceReport::create([
            'id_client' => $client2->id,
            'id_reporter' => $reporter2->id,
            'id_perpetrator' => $perpetrator2->id,
            'id_violance' => $violance2->id
        ]);
    }
}

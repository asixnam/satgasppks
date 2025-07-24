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
        // Buat sample client
        $client = Client::create([
            'nama_lengkap' => 'Siti Aminah',
            'nim' => '123456789',
            'program_studi' => 'Psikologi',
            'fakultas' => 'Fakultas Psikologi',
            'angkatan' => '2021',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '2000-05-15',
            'agama' => 'Islam',
            'status_perkawinan' => 'Belum Menikah',
            'sumber_rujukan' => 'Mandiri'
        ]);

        // Buat sample reporter
        $reporter = Reporter::create([
            'hubungan' => 'Teman',
            'nama' => 'Budi Santoso',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '1999-08-20',
            'jenis_kelamin' => 'laki-laki',
            'usia' => 24,
            'pekerjaan' => 'Mahasiswa',
            'no_telepon' => '081234567890',
            'alamat' => 'Jl. Merdeka No. 123, Bandung',
            'keterangan' => 'Saksi mata kejadian'
        ]);

        // Buat sample violance
        $violance = Violance::create([
            'jenis_kekerasan' => 'Kekerasan Psikis',
            'lokus_kejadian' => 'Kampus',
            'waktu_kejadian' => '2024-01-15 14:30:00',
            'keterangan_pihak_ke3' => 'Ada saksi lain',
            'kategori_pidana' => 'Pencemaran Nama Baik',
            'bentuk_kekerasan' => 'Verbal abuse',
            'narasi_kronologis' => 'Korban mengalami intimidasi verbal secara berulang di area kampus.'
        ]);

        // Buat sample perpetrator
        $perpetrator = Perpetrator::create([
            'hubungan_dengan_korban' => 'Teman Sekelas',
            'nik_pelaku' => '1234567890123456',
            'nama_pelaku' => 'John Doe',
            'jenis_kelamin_pelaku' => 'laki-laki',
            'umur_pelaku' => 22,
            'tempat_lahir_pelaku' => 'Surabaya',
            'tanggal_lahir_pelaku' => '2001-03-10',
            'agama_pelaku' => 'Kristen',
            'status_perkawinan_pelaku' => 'Belum Menikah',
            'pendidikan_pelaku' => 'S1',
            'pekerjaan_pelaku' => 'Mahasiswa',
            'alamat_pelaku' => 'Jl. Kenangan No. 456, Surabaya',
            'telepon_pelaku' => '087654321098',
            'jenis_kekerasan' => 'Kekerasan Psikis',
            'waktu_kejadian' => '2024-01-15 14:30:00',
            'tempat_kejadian' => 'Gedung Kuliah A Lt. 2',
            'kronologi' => 'Pelaku melakukan intimidasi verbal kepada korban di depan teman-teman sekelas.',
            'keterangan_tambahan' => 'Kejadian berlangsung selama 15 menit',
            'upload_bukti' => [
                'foto1.jpg',
                'rekaman_audio.mp3'
            ]
        ]);

        // Buat violence report yang menghubungkan semua entitas
        ViolenceReport::create([
            'id_client' => $client->id,
            'id_reporter' => $reporter->id,
            'id_perpetrator' => $perpetrator->id,
            'id_violance' => $violance->id
        ]);
    }
}

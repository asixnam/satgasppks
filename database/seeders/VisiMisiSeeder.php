<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VisiMisi;

class VisiMisiSeeder extends Seeder
{
    public function run(): void
    {
        VisiMisi::create([
            'visi' => 'Menjadi lembaga yang profesional, responsif, dan berintegritas dalam mewujudkan lingkungan yang bebas dari kekerasan serta menjunjung tinggi keadilan dan kesetaraan.',
            'misi' => implode("\n", [
                '1. Memberikan layanan perlindungan dan pendampingan kepada korban kekerasan secara cepat, aman, dan terpercaya.',
                '2. Menyediakan edukasi dan sosialisasi secara berkala untuk meningkatkan kesadaran masyarakat terhadap isu kekerasan dan diskriminasi.',
                '3. Menjalin kerja sama dengan berbagai pihak dalam upaya pencegahan dan penanganan kekerasan.',
                '4. Mengembangkan sistem pelaporan dan pendataan yang transparan dan akuntabel.',
                '5. Mendorong kebijakan yang berpihak pada korban dan menjamin hak-haknya.',
            ]),
            'about' => 'Deskripsi singkat tentang lembaga ini.'
        ]);
    }
}

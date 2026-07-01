<?php
namespace Database\Seeders;

use App\Models\VisiMisi;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            ViolenceReportSeeder::class,
            UserSeeder::class,
            VisiMisiSeeder::class,
        ]);
    }
}
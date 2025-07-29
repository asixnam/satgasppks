<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\LaporanController;
use App\Http\Controllers\InformasiPelakuController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\Admin\LaporanController as AdminLaporanController;
use App\Http\Controllers\Admin\EdukasiController as AdminEdukasiController;
use App\Http\Controllers\Admin\TentangKamiController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\TimController;


//============== BAGIAN BACKEND==================////

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\ViolenceReportController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\VisiMisiController;




//////// Bagian Frontend /////////
use App\Http\Controllers\Frontend\Pages\PagesController;
use App\Http\Controllers\Frontend\Pelapor\LaporController;
use App\Http\Controllers\Frontend\Articel\ArticelController;
use App\Http\Controllers\Frontend\About\AboutController;
use App\Http\Controllers\Frontend\Edukasi\EdukasiController;
use App\Http\Controllers\Frontend\Status\StatusController;




// =====Bagian Route Frontend======//
Route::get('/', [PagesController::class, 'home']);

// Bagian Pelapor User
Route::get('/lapor', [LaporController::class, 'index'])->name('lapor.form');
Route::post('/lapor', [LaporController::class, 'store'])->name('lapor.post');

Route::get('/lapor/step2', [LaporController::class, 'step2'])->name('lapor.step2');
Route::post('/lapor/step2', [LaporController::class, 'storeStep2'])->name('lapor.step2.post');

Route::get('/lapor/step3', [LaporController::class, 'step3'])->name('lapor.step3');
Route::post('/lapor/step3', [LaporController::class, 'storeStep3'])->name('lapor.step3.post');

Route::get('/step4', [LaporController::class, 'step4'])->name('lapor.step4');
Route::post('/step4', [LaporController::class, 'storeStep4'])->name('lapor.step4.post');

Route::get('/selesai', [LaporController::class, 'selesai'])->name('lapor.selesai');

// Bagian Articel
Route::prefix('berita')->name('berita.')->group(function() {
    Route::get('/', [ArticelController::class, 'index'])->name('index');
    Route::get('/{id}', [ArticelController::class, 'show'])->name('show');
});
// Route::get('/berita', [ArticelController::class, 'index'])->name('frontend.articel');
// Route::get('/detail-articel', [ArticelController::class, 'detail'])->name('detail.articel');

Route::get('/tentang-kami', [AboutController::class, 'index'])->name('tentang-kami');

// Bagian Cek Status
Route::get('/cek-status', [StatusController::class, 'index'])->name('status');

// Bagian Edukasi
Route::get('/edukasi', [EdukasiController::class, 'index'])->name('frontend.edukasi');
Route::get('/detail-edukasi/{id}', [EdukasiController::class, 'show'])->name('detail.edukasi');

Route::post('/informasi-pelaku/store', [InformasiPelakuController::class, 'store'])->name('informasi-pelaku.store');


// ===================BAGIAN BACKEND=================///

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Violence Reports (dipindahkan ke dalam admin group)
    Route::prefix('violence-reports')->name('violence-reports.')->group(function () {
        Route::get('/', [ViolenceReportController::class, 'index'])->name('index');
        Route::get('/bulk-delete', [ViolenceReportController::class, 'bulk-delete'])->name('bulk-delete');
        Route::get('/create', [ViolenceReportController::class, 'create'])->name('create');
        Route::post('/store', [ViolenceReportController::class, 'store'])->name('store');
        Route::get('/{id}', [ViolenceReportController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [ViolenceReportController::class, 'edit'])->name('edit'); 
        Route::put('/{id}', [ViolenceReportController::class, 'update'])->name('update');
        Route::delete('/{id}', [ViolenceReportController::class, 'destroy'])->name('destroy');

        // Additional routes
       // Routes baru untuk statistik dan fitur tambahan
        Route::get('/statistics/dashboard', [ViolenceReportController::class, 'statistics'])->name('statistics');
        Route::get('/statistics/export', [ViolenceReportController::class, 'exportStatistics'])->name('export-statistics');
        Route::get('/statistics/chart-data', [ViolenceReportController::class, 'getChartData'])->name('chart-data');
        
        Route::get('/export', [ViolenceReportController::class, 'export'])->name('export');
        Route::get('/details/all', [ViolenceReportController::class, 'reportsWithDetails'])->name('details.all');
        Route::get('/filter/violence-type/{type}', [ViolenceReportController::class, 'filterByViolenceType'])->name('filter.violence-type');
        Route::get('/filter/faculty/{faculty}', [ViolenceReportController::class, 'filterByFaculty'])->name('filter.faculty');
    });
    Route::get('/laporans', [LaporanController::class, 'index'])->name('laporans.index');
    Route::get('/laporans/create', [LaporanController::class, 'create'])->name('laporans.create');
    Route::post('/laporans', [LaporanController::class, 'store'])->name('laporans.store');
    Route::get('/laporans/{id}/edit', [LaporanController::class, 'edit'])->name('laporans.edit');
    Route::put('/laporans/{id}', [LaporanController::class, 'update'])->name('laporans.update');
    Route::delete('/laporans/{id}', [LaporanController::class, 'destroy'])->name('laporans.destroy');
    Route::get('/laporans/{id}', [LaporanController::class, 'show'])->name('laporans.show');

    //Berita
    Route::get('/beritas', [BeritaController::class, 'index'])->name('beritas.index');
    Route::get('/beritas/create', [BeritaController::class, 'create'])->name('beritas.create');
    Route::post('/beritas', [BeritaController::class, 'store'])->name('beritas.store');
    Route::get('/beritas/{id}/edit', [BeritaController::class, 'edit'])->name('beritas.edit');
    Route::delete('/beritas/{id}', [BeritaController::class, 'destroy'])->name('beritas.destroy');
    Route::put('/beritas/{id}', [BeritaController::class, 'update'])->name('beritas.update');

    //Edukasi
    Route::get('/edukasis', [AdminEdukasiController::class, 'index'])->name('edukasis.index');
    Route::get('/edukasis/create', [AdminEdukasiController::class, 'create'])->name('edukasis.create');
    Route::post('/edukasis', [AdminEdukasiController::class, 'store'])->name('edukasis.store');
    Route::get('/edukasis/{id}/edit', [AdminEdukasiController::class, 'edit'])->name('edukasis.edit');
    Route::delete('/edukasis/{id}', [AdminEdukasiController::class, 'destroy'])->name('edukasis.destroy');
    Route::put('/edukasis/{id}', [AdminEdukasiController::class, 'update'])->name('edukasis.update');

    //tim
    Route::get('/tims', [TimController::class, 'index'])->name('tims.index');
    Route::get('/tims/create', [TimController::class, 'create'])->name('tims.create');
    Route::post('/tims', [TimController::class, 'store'])->name('tims.store');
    Route::get('/tims/{id}/edit', [TimController::class, 'edit'])->name('tims.edit');
    Route::delete('/tims/{id}', [TimController::class, 'destroy'])->name('tims.destroy');
    Route::put('/tims/{id}', [TimController::class, 'update'])->name('tims.update');

    //Visi Misi
    Route::get('/visi-misi', [VisiMisiController::class, 'index'])->name('visi-misi.index');
    Route::get('/visi-misi/create', [VisiMisiController::class, 'create'])->name('visi-misi.create');
    Route::post('/visi-misi', [VisiMisiController::class, 'store'])->name('visi-misi.store');
    Route::get('/visi-misi/{visiMisi}/edit', [VisiMisiController::class, 'edit'])->name('visi-misi.edit');
    Route::put('/visi-misi/{visiMisi}', [VisiMisiController::class, 'update'])->name('visi-misi.update');

    //Hero
    Route::get('/hero/create', [HeroController::class, 'create'])->name('hero.create');
    Route::post('/hero', [HeroController::class, 'store'])->name('hero.store');
    Route::get('/hero/{id}/edit', [HeroController::class, 'edit'])->name('hero.edit');
    Route::put('/hero/{id}', [HeroController::class, 'update'])->name('hero.update');
    Route::get('/hero', [HeroController::class, 'index'])->name('hero.index');
    Route::delete('/hero/{hero}', [HeroController::class, 'destroy'])->name('hero.destroy');

});

// Auth
Route::middleware(['web'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login.submit', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// laporan-kekerasan

// Route::prefix('violence-reports')->group(function () {
//     Route::get('/', [ViolenceReportController::class, 'index']);
//     Route::post('/', [ViolenceReportController::class, 'store']);
//     Route::get('/{id}', [ViolenceReportController::class, 'show']);
//     Route::put('/{id}', [ViolenceReportController::class, 'update']);
//     Route::delete('/{id}', [ViolenceReportController::class, 'destroy']);
    
//     // Additional routes
//     Route::get('/details/all', [ViolenceReportController::class, 'reportsWithDetails']);
//     Route::get('/filter/violence-type/{type}', [ViolenceReportController::class, 'filterByViolenceType']);
//     Route::get('/filter/faculty/{faculty}', [ViolenceReportController::class, 'filterByFaculty']);
// });
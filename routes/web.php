<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\Admin\EdukasiController as AdminEdukasiController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\TimController;


//============== BAGIAN BACKEND==================////

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ViolenceReportController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\VisiMisiController;

//////// Bagian Frontend /////////
use App\Http\Controllers\Frontend\AppController;


// =====Bagian Route Frontend======//
// Homepage
Route::get('/', [AppController::class, 'home'])->name('home');

// Berita (News/Articles) Routes
Route::get('/berita', [AppController::class, 'berita'])->name('berita');
Route::get('/berita/{id}', [AppController::class, 'showBerita'])->name('berita.show');

// Edukasi (Education) Routes
Route::get('/edukasi', [AppController::class, 'edukasi'])->name('edukasi');
Route::get('/edukasi/{id}', [AppController::class, 'showEdukasi'])->name('edukasi.show');

// About Us Route
Route::get('/tentang-kami', [AppController::class, 'tentangKami'])->name('tentang-kami');

// Violence Report Routes
Route::get('/lapor-kekerasan', [AppController::class, 'createLaporan'])->name('lapor-kekerasan.create');
Route::post('/lapor-kekerasan', [AppController::class, 'store'])->name('lapor-kekerasan.store');
Route::get('/lapor-kekerasan/success', [AppController::class, 'successLaporan'])->name('Frontend.violance-report.success');

// Status Check Routes
Route::get('/cek-status', [AppController::class, 'cekStatus'])->name('cek-status');
Route::get('/cek-status/{code}', [AppController::class, 'showLaporan'])->name('cek-status.show');


// API Routes for latest content (optional)
Route::get('/api/latest-berita/{limit?}', [AppController::class, 'latestBerita'])->name('api.latest-berita');
Route::get('/api/latest-edukasi/{limit?}', [AppController::class, 'latestEdukasi'])->name('api.latest-edukasi');

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
    
    // Route untuk update status
    Route::patch('/{id}/status', [ViolenceReportController::class, 'updateStatus'])->name('update-status');

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
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

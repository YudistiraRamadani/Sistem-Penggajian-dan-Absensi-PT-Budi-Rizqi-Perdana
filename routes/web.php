<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('user.index');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('auth', 'role:admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.index');

    Route::get('/admin/viewJabatan', [AdminController::class, 'viewJabatan'])->name('admin.dataJabatan');
    Route::get('/admin/formJabatan', [AdminController::class, 'storeJabatan'])->name('admin.formJabatan');
    Route::post('/admin/inputJabatan', [AdminController::class, 'tambahJabatan'])->name('admin.tambahJabatan');
    Route::put('/admin/editJabatan/{id_jabatan}', [AdminController::class, 'editJabatan'])->name('admin.editJabatan');
    Route::delete('/admin/deleteJabatan', [AdminController::class, 'deleteJabatan'])->name('admin.hapusJabatan');

    Route::get('/admin/viewKaryawan', [AdminController::class, 'viewKaryawan'])->name('admin.dataKaryawan');
    Route::put('/admin/editKaryawan/{id}', [AdminController::class, 'editKaryawan'])->name('admin.editKaryawan');
    Route::delete('/admin/deleteKaryawan', [AdminController::class, 'hapusKaryawan'])->name('admin.hapusKaryawan');
    Route::post('/admin/tambahKaryawan', [AdminController::class, 'tambahKaryawan'])->name('admin.tambahKaryawan');

    Route::get('/admin/viewPK', [AdminController::class, 'viewPK'])->name('admin.dataPK');
    Route::put('/admin/editPK/{id}', [AdminController::class, 'editPK'])->name('admin.editPK');
    Route::delete('/admin/deletePK', [AdminController::class, 'hapusPK'])->name('admin.hapusPK');
    Route::post('/admin/tambahPK', [AdminController::class, 'tambahPK'])->name('admin.tambahPK');

    Route::get('/admin/viewAbsensi', [AdminController::class, 'viewAbsensi'])->name('admin.dataAbsensi');
    Route::put('/admin/editAbsensi/{id_absensi}', [AdminController::class, 'editAbsensi'])->name('admin.editAbsensi');
    Route::delete('/admin/deleteAbsensi', [AdminController::class, 'hapusAbsensi'])->name('admin.hapusAbsensi');
    Route::post('/admin/tambahAbsensi', [AdminController::class, 'tambahAbsensi'])->name('admin.tambahAbsensi');

    Route::get('/admin/viewKehadiran', [AdminController::class, 'viewKehadiran'])->name('admin.dataKehadiran');
    Route::get('/admin/viewDetailKehadiran/{id_absensi}', [AdminController::class, 'viewDetailKehadiran'])->name('admin.detailKehadiran');

    Route::get('/admin/viewGaji', [AdminController::class, 'viewGaji'])->name('admin.dataGaji');
    Route::get('/admin/viewFormGaji', [AdminController::class, 'viewGaji'])->name('admin.showFormGaji');
    Route::post('/admin/viewFormGaji', [AdminController::class, 'viewFormGaji'])->name('admin.viewFormGaji');
    Route::post('/admin/storeGaji', [AdminController::class, 'storeGaji'])->name('admin.storeGaji');
    Route::get('/admin/gaji', [AdminController::class, 'viewDataGaji'])->name('admin.viewDataGaji');
    Route::delete('/admin/deleteGaji', [AdminController::class, 'deleteGaji'])->name('admin.hapusGaji');


    // Route::post('/admin/viewFormGaji', [AdminController::class, 'viewFormGaji'])->name('admin.viewFormGaji');

    // Route::post('/admin/formGaji/{id}', [AdminController::class, 'viewFormGaji'])->name('admin.formGaji');
    // Route::post('/admin/simpanGaji', [AdminController::class, 'simpanGaji'])->name('admin.simpanGaji');
});
Route::middleware('auth', 'role:user')->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/user/absensi', [UserController::class, 'absensi'])->name('user.absensi');
    Route::get('/user/absensi/{id}', [UserController::class, 'detailAbsensi'])->name('user.detailAbsensi');
    Route::post('/user/absenMasuk', [UserController::class, 'absenMasuk'])->name('user.absenMasuk');
    Route::post('/user/absenPulang', [UserController::class, 'absenPulang'])->name('user.absenPulang');

    Route::get('/user/gaji', [UserController::class, 'viewGaji'])->name('user.gaji');


    Route::get('/user/index', [UserController::class, 'view'])->name('user.index');
    Route::put('/user/edit/{id}', [UserController::class, 'update'])->name('user.update');
    Route::post('/user/input', [UserController::class, 'create'])->name('user.input');
    Route::delete('/user/delete', [UserController::class, 'delete'])->name('user.delete');
});

require __DIR__ . '/auth.php';

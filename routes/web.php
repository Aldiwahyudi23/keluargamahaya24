<?php

use App\Http\Controllers\AccessMenuController;
use App\Http\Controllers\AccessProgramController;
use App\Http\Controllers\AccessSubMenuController;
use App\Http\Controllers\AllRouteUrlController;
use App\Http\Controllers\AnggaranController;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\BantuanController;
use App\Http\Controllers\BayarPinjamanController;
use App\Http\Controllers\DataWargaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HubunganWargaController;
use App\Http\Controllers\KategoriAnggaranProgramController;
use App\Http\Controllers\LaporanSaldoController;
use App\Http\Controllers\LayoutAppUserController;
use App\Http\Controllers\LayoutPemasukanController;
use App\Http\Controllers\LayoutPengeluaranController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MenuFooterController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\ProfileAppController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubMenuController;
use App\Http\Controllers\TabunganController;
use App\Http\Controllers\UserController;
use App\Models\Access_Pemasukan;
use App\Models\AccessProgram;
use App\Models\DataWarga;
use App\Models\Layout_Pemasukan;
use App\Models\LayoutAppUser;
use App\Models\LayoutPengeluaran;
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

Route::get('/', [HomeController::class, 'index'])->middleware(['auth'])->name('home');
Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::get('/setting/app', [HomeController::class, 'setting'])->middleware(['auth', 'verified'])->name('set');

Route::middleware('auth')->group(function () {
    Route::get('/profile/edit/data', [ProfileController::class, 'edit_data'])->middleware(['auth', 'verified'])->name('profile.edit.data');
    Route::get('/profile/edit/data/anak/{id}', [ProfileController::class, 'data_hubungan_anak'])->middleware(['auth', 'verified'])->name('data_hubungan_anak');
    Route::get('/profile', [ProfileController::class, 'edit'])->middleware(['auth', 'verified'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->middleware(['auth', 'verified'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->middleware(['auth', 'verified'])->name('profile.destroy');
});

Route::resource('menu', MenuController::class)->middleware(['auth', 'verified']);
Route::get('/menus/trash/', [MenuController::class, 'trash'])->middleware(['auth', 'verified'])->name('menu.trash');
Route::post('/menus/kill/{id}', [MenuController::class, 'kill'])->middleware(['auth', 'verified'])->name('menu.kill');
Route::get('/menus/restore/{id}', [MenuController::class, 'restore'])->middleware(['auth', 'verified'])->name('menu.restore');

Route::resource('sub-menu', SubMenuController::class)->middleware(['auth', 'verified']);
Route::get('/sub-menus/trash/', [SubMenuController::class, 'trash'])->middleware(['auth', 'verified'])->name('sub-menu.trash');
Route::post('/sub-menus/kill/{id}', [SubMenuController::class, 'kill'])->middleware(['auth', 'verified'])->name('sub-menu.kill');
Route::get('/sub-menus/restore/{id}', [SubMenuController::class, 'restore'])->middleware(['auth', 'verified'])->name('sub-menu.restore');

Route::resource('program', ProgramController::class)->middleware(['auth', 'verified']);
Route::get('/programs/user/pilih', [ProgramController::class, 'program_pilih'])->middleware(['auth', 'verified'])->name('program.pilih');
Route::get('/programs/trash/', [ProgramController::class, 'trash'])->middleware(['auth', 'verified'])->name('program.trash');
Route::post('/programs/kill/{id}', [ProgramController::class, 'kill'])->middleware(['auth', 'verified'])->name('program.kill');
Route::get('/programs/restore/{id}', [ProgramController::class, 'restore'])->middleware(['auth', 'verified'])->name('program.restore');

Route::resource('role', RoleController::class)->middleware(['auth', 'verified']);
Route::get('/roles/trash/', [RoleController::class, 'trash'])->middleware(['auth', 'verified'])->name('role.trash');
Route::post('/roles/kill/{id}', [RoleController::class, 'kill'])->middleware(['auth', 'verified'])->name('role.kill');
Route::get('/roles/restore/{id}', [RoleController::class, 'restore'])->middleware(['auth', 'verified'])->name('role.restore');
Route::resource('kategori', KategoriAnggaranProgramController::class)->middleware(['auth', 'verified']);
Route::get('/kategoris/trash/', [KategoriAnggaranProgramController::class, 'trash'])->middleware(['auth', 'verified'])->name('kategori.trash');
Route::post('/kategoris/kill/{id}', [KategoriAnggaranProgramController::class, 'kill'])->middleware(['auth', 'verified'])->name('kategori.kill');
Route::get('/kategoris/restore/{id}', [KategoriAnggaranProgramController::class, 'restore'])->middleware(['auth', 'verified'])->name('kategori.restore');

Route::resource('route-url', AllRouteUrlController::class)->middleware(['auth', 'verified']);
Route::get('/route-urls/trash/', [AllRouteUrlController::class, 'trash'])->middleware(['auth', 'verified'])->name('route-url.trash');
Route::post('/route-urls/kill/{id}', [AllRouteUrlController::class, 'kill'])->middleware(['auth', 'verified'])->name('route-url.kill');
Route::get('/route-urls/restore/{id}', [AllRouteUrlController::class, 'restore'])->middleware(['auth', 'verified'])->name('route-url.restore');

Route::resource('access-menu', AccessMenuController::class)->middleware(['auth', 'verified']);
Route::resource('access-program', AccessProgramController::class)->middleware(['auth', 'verified']);
Route::resource('access-sub-menu', AccessSubMenuController::class)->middleware(['auth', 'verified']);
Route::resource('menu-footer', MenuFooterController::class)->middleware(['auth', 'verified']);

Route::resource('profile-app', ProfileAppController::class)->middleware(['auth', 'verified']);
Route::get('profile-app/layout/login', [ProfileAppController::class, 'login'])->middleware(['auth', 'verified'])->name('profile-app-login');

Route::resource('/layout-app-user', LayoutAppUserController::class)->middleware(['auth', 'verified']);

Route::resource('data-warga', DataWargaController::class)->middleware(['auth', 'verified']);
Route::post('/data/warga/cek-akun/{id}', [DataWargaController::class, 'is_active'])->middleware(['auth', 'verified'])->name('data-wargas.is_active');
Route::POST('/data/warga/cek-akun/', [DataWargaController::class, 'store_user'])->middleware(['auth', 'verified'])->name('data-warga.store_user');
Route::get('/data/warga/trash/', [DataWargaController::class, 'trash'])->middleware(['auth', 'verified'])->name('data-warga.trash');
Route::post('/data/warga/kill/{id}', [DataWargaController::class, 'kill'])->middleware(['auth', 'verified'])->name('data-warga.kill');
Route::get('/data/warga/restore/{id}', [DataWargaController::class, 'restore'])->middleware(['auth', 'verified'])->name('data-warga.restore');
Route::get('/data/cari/', [DataWargaController::class, 'cari_keluarga'])->name('cari');
Route::get('/data/detail/{id}', [DataWargaController::class, 'data_warga_detail'])->name('data_warga_detail');

Route::resource('profile-user', ProfileController::class)->middleware(['auth', 'verified']);
Route::get('/pengaturan/email', [ProfileController::class, 'edit_email'])->middleware(['auth'])->name('pengaturan.email');
Route::post('/pengaturan/ubah-email', [ProfileController::class, 'ubah_email'])->middleware(['auth'])->name('pengaturan.ubah-email');
Route::get('/pengaturan/password', [ProfileController::class, 'edit_password'])->middleware(['auth', 'verified'])->name('pengaturan.password');
Route::post('/pengaturan/ubah-password', [ProfileController::class, 'ubah_password'])->middleware(['auth', 'verified'])->name('pengaturan.ubah-password');

Route::resource('data-hubungan-warga', HubunganWargaController::class)->middleware(['auth', 'verified']);

Route::resource('data-user', UserController::class)->middleware(['auth', 'verified']);

Route::resource('pengajuan', PengajuanController::class)->middleware(['auth', 'verified']);
Route::get('/pengajuans/trash/', [PengajuanController::class, 'trash'])->middleware(['auth', 'verified'])->name('pengajuan.trash');
Route::post('/pengajuans/kill/{id}', [PengajuanController::class, 'kill'])->middleware(['auth', 'verified'])->name('pengajuan.kill');
Route::get('/pengajuans/restore/{id}', [PengajuanController::class, 'restore'])->middleware(['auth', 'verified'])->name('pengajuan.restore');
Route::get('/pengajuans/edit/{id}', [PengajuanController::class, 'edit_user'])->middleware(['auth', 'verified'])->name('pengajuan.edit.user');
Route::get('/pengajuans/kas', [PengajuanController::class, 'index_pemasukan'])->middleware(['auth', 'verified'])->name('table-pengajuan-kas');
Route::get('/pengajuans/tabungan', [PengajuanController::class, 'index_tabungan'])->middleware(['auth', 'verified'])->name('table-pengajuan-tabungan');
Route::get('/pengajuans/tarik/tabungan', [PengajuanController::class, 'tarik_tabungan'])->middleware(['auth', 'verified'])->name('table-pengajuan-tarik_tabungan');
Route::get('/pengajuans/pinjam', [PengajuanController::class, 'index_pinjam'])->middleware(['auth', 'verified'])->name('table-pengajuan-pinjaman');
Route::get('/pengajuans/bayar', [PengajuanController::class, 'index_bayar_pinjam'])->middleware(['auth', 'verified'])->name('table-pengajuan-bayar_pinjaman');
Route::get('/pengajuans/laporan/{id}', [PengajuanController::class, 'laporan_pinjaman'])->middleware(['auth', 'verified'])->name('pengajuan.laporan');
Route::post('/pengajuans/laporan/{id}', [PengajuanController::class, 'kirim_laporan_pinjaman'])->middleware(['auth', 'verified'])->name('kirim_pengajuan.laporan');
Route::get('/pengajuans/user/{id}', [PengajuanController::class, 'pengajuan_user'])->middleware(['auth', 'verified'])->name('pengajuan.user');


Route::resource('pemasukan', PemasukanController::class)->middleware(['auth', 'verified']);
Route::get('/pemasukans/trash/', [PemasukanController::class, 'trash'])->middleware(['auth', 'verified'])->name('pemasukan.trash');
Route::post('/pemasukans/kill/{id}', [PemasukanController::class, 'kill'])->middleware(['auth', 'verified'])->name('pemasukan.kill');
Route::get('/pemasukans/restore/{id}', [PemasukanController::class, 'restore'])->middleware(['auth', 'verified'])->name('pemasukan.restore');
Route::get('/pemasukans/bayar', [PemasukanController::class, 'pemasukan_index'])->middleware(['auth', 'verified'])->name('pemasukan-index');
Route::get('/pemasukans/detail/kas/{id}', [PemasukanController::class, 'detail_anggota_kas'])->middleware(['auth', 'verified'])->name('detail.anggota.kas');
Route::get('/pemasukans/detail/tabungan/{id}', [PemasukanController::class, 'detail_anggota_tabungan'])->middleware(['auth', 'verified'])->name('detail.anggota.tabungan');

Route::resource('user', UserController::class)->middleware(['auth', 'verified']);
Route::resource('layout-halaman-pemasukan', LayoutPemasukanController::class)->middleware(['auth', 'verified']);
Route::post('layout-halaman-pemasukan/access-pemasukan', [LayoutPemasukanController::class, 'access_pemasukan'])->middleware(['auth', 'verified'])->name('access-pemasukan');
Route::post('/layout-halaman-pemasukan/access-pemasukan/is-active/{id}', [LayoutPemasukanController::class, 'is_active_access'])->middleware(['auth', 'verified'])->name('is_active_access');
Route::delete('/layout-halaman-pemasukan/access-pemasukan/hapus/{id}', [LayoutPemasukanController::class, 'access_pemasukan_hapus'])->middleware(['auth', 'verified'])->name('access_pemasukan_hapus');


Route::resource('pengeluaran', PengeluaranController::class)->middleware(['auth', 'verified']);
Route::get('/pengeluarans/trash/', [PengeluaranController::class, 'trash'])->middleware(['auth', 'verified'])->name('pengeluaran.trash');
Route::post('/pengeluarans/kill/{id}', [PengeluaranController::class, 'kill'])->middleware(['auth', 'verified'])->name('pengeluaran.kill');
Route::get('/pengeluarans/restore/{id}', [PengeluaranController::class, 'restore'])->middleware(['auth', 'verified'])->name('pengeluaran.restore');
Route::get('/pengeluarans/bayar', [PengeluaranController::class, 'pengeluaran_index'])->middleware(['auth', 'verified'])->name('pengeluaran-index');
Route::get('/pengeluarans/laporan/detail/{id}', [PengeluaranController::class, 'detail_pengeluaran'])->middleware(['auth', 'verified'])->name('laporan.pengeluaran.detail');
Route::get('/pengeluarans/laporan', [PengeluaranController::class, 'laporan_pengeluaran'])->middleware(['auth', 'verified'])->name('laporan.pengeluaran');
Route::get('/pengeluarans/input', [PengeluaranController::class, 'input_pengeluaran'])->middleware(['auth', 'verified'])->name('input.pengeluaran');
Route::post('/pengeluarans/pinjaman/', [PengeluaranController::class, 'pengeluaran_pinjaman'])->middleware(['auth', 'verified'])->name('pinjaman.pengeluaran');
// Laporan Pinjaman Admin
Route::get('/laporan-pinjaman/admin', [PengeluaranController::class, 'laporan_pinjaman_admin'])->middleware(['auth', 'verified'])->name('laporan.pinjaman');

Route::resource('layout-halaman-pengeluaran', LayoutPengeluaranController::class)->middleware(['auth', 'verified']);
// Data Anggaran
Route::resource('anggaran', AnggaranController::class)->middleware(['auth', 'verified']);
Route::get('/anggarans/trash/', [AnggaranController::class, 'trash'])->middleware(['auth', 'verified'])->name('anggaran.trash');
Route::post('/anggarans/kill/{id}', [AnggaranController::class, 'kill'])->middleware(['auth', 'verified'])->name('anggaran.kill');
Route::get('/anggarans/restore/{id}', [AnggaranController::class, 'restore'])->middleware(['auth', 'verified'])->name('anggaran.restore');


Route::resource('pinjaman', BayarPinjamanController::class)->middleware(['auth', 'verified']);
Route::get('/form/bayar/pinjaman/{id}', [BayarPinjamanController::class, 'form_bayar_pinjaman'])->middleware(['auth', 'verified'])->name('form.bayar.pinjaman'); //tidak di pake
Route::get('/show/bayar/pinjaman/{id}', [BayarPinjamanController::class, 'lihat_data_bayar'])->middleware(['auth', 'verified'])->name('lihat.data.bayar'); //tidak di pake
Route::get('/bayar/pinjaman/trash/', [BayarPinjamanController::class, 'trash'])->middleware(['auth', 'verified'])->name('bayar.pinjaman.trash'); //tidak di pake
Route::post('/bayar/pinjaman/kill/{id}', [BayarPinjamanController::class, 'kill'])->middleware(['auth', 'verified'])->name('bayar.pinjaman.kill'); //tidak di pake
Route::get('/bayar/pinjaman/restore/{id}', [BayarPinjamanController::class, 'restore'])->middleware(['auth', 'verified'])->name('bayar.pinjaman.restore'); //tidak di pake

//DATA bantuan
Route::resource('bantuan', BantuanController::class)->middleware(['auth', 'verified']);
Route::get('/bantuans/trash/', [BantuanController::class, 'trash'])->middleware(['auth', 'verified', 'checkRole:1'])->name('bantuan.trash');
Route::post('/bantuans/kill/{id}', [BantuanController::class, 'kill'])->middleware(['auth', 'verified', 'checkRole:1'])->name('bantuan.kill');
Route::get('/bantuans/restore/{id}', [BantuanController::class, 'restore'])->middleware(['auth', 'verified', 'checkRole:1'])->name('bantuan.restore');
Route::get('/bantuans/detail/', [BantuanController::class, 'bantuan_index'])->middleware(['auth'])->name('bantuan_umum');
Route::get('/bantuans/detail/{id}', [BantuanController::class, 'bantuan'])->middleware(['auth'])->name('bantuan.detail');
Route::get('/bantuans/login/{id}', [BantuanController::class, 'login'])->name('bantuan.login');

Route::resource('laporan-saldo', LaporanSaldoController::class)->middleware(['auth', 'verified']);
Route::get('/laporan-saldos/umum/', [LaporanSaldoController::class, 'laporan_saldo'])->middleware(['auth', 'verified'])->name('laporan_umum');
Route::get('/laporan-saldos/admin/', [LaporanSaldoController::class, 'laporan_saldo_admin'])->middleware(['auth', 'verified'])->name('laporan_admin');

Route::resource('tabungan', TabunganController::class)->middleware(['auth', 'verified']);
Route::get('tabungans/{id}', [TabunganController::class, 'tabungan_user'])->middleware(['auth', 'verified'])->name('tabungan_user');
Route::get('simulasi-kredit/', [HomeController::class, 'simulasi_kredit'])->middleware(['auth', 'verified'])->name('simulasi_kredit');

//Data Asset
Route::resource('aset', AsetController::class)->middleware(['auth', 'verified']);
Route::get('/asets/trash/', [AsetController::class, 'trash'])->middleware(['auth', 'verified', 'checkRole:Admin'])->name('aset.trash');
Route::post('/asets/kill/{id}', [AsetController::class, 'kill'])->middleware(['auth', 'verified', 'checkRole:Admin'])->name('aset.kill');
Route::get('/asets/restore/{id}', [AsetController::class, 'restore'])->middleware(['auth', 'verified', 'checkRole:Admin'])->name('aset.restore');


require __DIR__ . '/auth.php';

<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('select-regency','Owner\KamarController@selectRegency'); // Select Regency
Route::get('select-district','Owner\KamarController@selectDistrict'); // Select District
Route::get('select-village','Owner\KamarController@selectVillage'); // Select District

Auth::routes();

///// FRONTEND \\\\\
// Homepage

Route::get('/','Frontend\FrontendsController@homepage'); // homepage
Route::get('/room/{slug}','Frontend\FrontendsController@showkamar'); //Show Kamar
Route::get('show-all-room','Frontend\FrontendsController@showAllKamar'); //Show all kamar
Route::get('kategori/{category}','Frontend\FrontendsController@showByKategori'); //Show by Kategori
Route::get('filter-kamar','Frontend\FrontendsController@filterKamar'); //Filter kamar
Route::get('kost','Frontend\FrontendsController@showByKecamatan'); // show kamar by kecamatan

Route::get('simpan/kamar','Frontend\FrontendsController@simpanKamar'); // proses simpan kamar (favorite)
Route::get('hapus/kamar','Frontend\FrontendsController@hapusKamar'); // proses hapus kamar (favorite)

// PusatBantuan
Route::get('pusat-bantuan','Frontend\FrontendsController@pusatBantuan');
Route::get('syarat-dan-ketentuan','Frontend\FrontendsController@syaratKetentuan');
Route::get('kebijakan-privasi','Frontend\FrontendsController@kebijakanPrivasi');
Route::get('download-apk','Frontend\FrontendsController@downloadApk')->name('download.apk');

Route::middleware('auth')->group(function () {
  Route::get('/home', 'HomeController@index');

  ////// PEMILIK \\\\\\
  Route::prefix('/pemilik')->middleware('role:Pemilik')->group(function () {

    Route::resource('kamar','Owner\KamarController'); //Data Kamar
    Route::prefix('delete')->group(function(){
      Route::get('fasilitas-kamar/{id}','Owner\KamarController@delFasilitasKamarService');
      Route::get('fasilitas-kamar-mandi/{id}','Owner\KamarController@delFasilitasKamarMandiService');
      Route::get('fasilitas-parkir/{id}','Owner\KamarController@delFasilitasParkirService');
      Route::get('area/{id}','Owner\KamarController@delAreaService');
      Route::get('foto-kamar/{foto_kamar}','Owner\KamarController@delFotoKamarService');
    });

    Route::get('promo','Owner\PromoController@promo')->name('kamar.promo'); // Promo Kamar Index
    Route::get('promo/create','Owner\PromoController@promoCreate')->name('kamar.promo.create'); // Promo Kamar Create
    Route::post('promo/store','Owner\PromoController@promoProces')->name('kamar.promo.store'); // Promo Kamar Proses
    Route::get('promo/inactive-promo','Owner\PromoController@inactivePromo')->name('kamar.promo.inactive'); // InActive Promo
    Route::get('promo/edit/{id}','Owner\PromoController@promoEdit')->name('kamar.promo.edit'); // Promo Edit
    Route::put('promo/update/{id}','Owner\PromoController@promoUpdate')->name('kamar.promo.update'); // Promo Edit

    Route::post('rekening','Owner\BankController@rekening'); // Rekening
    Route::get('rekening/{id}','Owner\BankController@rekeningEdit'); // Rekening Edit
    Route::get('rekening/update','Owner\BankController@rekeningUpdate'); // Rekening Update
    Route::post('testimoni','Owner\ProfileController@testimoni');

    Route::get('booking-list','Owner\BookListController@index')->name('booking-list'); // Booking List
    Route::get('room/{key}','Owner\BookListController@confirm_payment'); // Confirm payment from user
    Route::put('payment-confirm/{key}','Owner\BookListController@proses_confirm_payment'); // Proses Confirm Payment
    Route::get('reject-payment','Owner\BookListController@reject_confirm_payment'); // Reject Payment
    Route::get('penghuni','Owner\PenghuniController@penghuni'); // Penghuni
    Route::get('done-sewa','Owner\BookListController@doneSewa'); //Done Sewa
  });


  ///// USER \\\\\
  Route::prefix('/user')->middleware('role:Pencari')->group(function () {
    Route::post('/transaction-room/{id}','User\TransactionController@store')->name('sewa.store'); // Proses save Room
    Route::get('room/{key}','User\TransactionController@detail_payment'); // Detail payment
    Route::put('konfirmasi-payment/{id}','User\TransactionController@update'); // Konfirmasi Payment
    Route::get('tagihan','User\TransactionController@tagihan'); // Ambil data tagihan
    Route::get('myroom','User\MyRoomsController@myroom'); // Kamar aktif
    Route::get('review/{key}','User\MyRoomsController@review'); // Review Kamar
    Route::post('review-proses/{key}','User\MyRoomsController@reviewProses'); // Review Kamar
  });

  ////// GLOBAL ROUTE \\\\\\
  Route::get('profile','GlobalController@profile');
  Route::put('profile/{id}','GlobalController@profileUpdate');
});


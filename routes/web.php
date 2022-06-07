<?php

use GuzzleHttp\Psr7\Request;
use App\Mail\KonfirmasiBooking;
use Illuminate\Support\Facades\Mail;
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

Route::get('/', function () {
    return view('home');
});

Route::get('/site/rute/{slug}','SiteController@detail')->name('rute.detail');
Route::get('/blog/{slug}','BlogController@detail')->name('blog.detail');
Route::get('/cara-pembayaran','HomeController@tataCaraPembayaran')->name('tata.pembayaran.index');
Route::get('/sop','HomeController@sop')->name('sop.index');


Route::get('/booking','BookingController@index')->name('booking.index');
Route::post('/booking','BookingController@kuota')->name('booking.kuota');

Route::get('/cek-status/booking/','HomeController@cekStatusBooking')->name('cek.status.booking');

Route::get('/booking/{site_id}/{tanggal}','BookingController@formBook')->name('booking.form');

Route::post('/booking/form','BookingController@formBookPost')->name('booking.form.post');

Route::prefix('admin')->middleware(['auth','admin'])->group(function () {
    Route::get('dashboard','Admin\DashboardController@index')->name('admin.dashboard.index');

    // Blog
Route::get('blog','Admin\BlogController@index')->name('admin.blog.index');
    Route::get('blog/create','Admin\BlogController@create')->name('admin.blog.create');
    Route::get('blog/edit/{id}','Admin\BlogController@edit')->name('admin.blog.edit');
    Route::post('blog/store','Admin\BlogController@store')->name('admin.blog.store');
    Route::post('blog/update/{id}','Admin\BlogController@update')->name('admin.blog.update');
    Route::post('blog/delete/{id}','Admin\BlogController@delete')->name('admin.blog.delete');

    Route::get('sop','Admin\SOPController@index')->name('admin.sop.index');
    Route::post('sop/update','Admin\SOPController@update')->name('admin.sop.update');

    // Site
    Route::get('site','Admin\SiteController@index')->name('admin.site.index');
    Route::get('site/create','Admin\SiteController@create')->name('admin.site.create');
    Route::get('site/edit/{id}','Admin\SiteController@edit')->name('admin.site.edit');
    Route::post('site/store','Admin\SiteController@store')->name('admin.site.store');
    Route::post('site/update/{id}','Admin\SiteController@update')->name('admin.site.update');
    Route::post('site/delete/{id}','Admin\SiteController@delete')->name('admin.site.delete');

    // Kuota Gunnung
    Route::get('kuota-gunung','Admin\KuotaGunungController@index')->name('admin.kuota-gunung.index');
    Route::post('kuota-gunung/store','Admin\KuotaGunungController@store')->name('admin.kuota-gunung.store');
    Route::get('kuota-gunung/edit/{id}','Admin\KuotaGunungController@edit')->name('admin.kuota-gunung.edit');
    Route::post('kuota-gunung/update/{id}','Admin\KuotaGunungController@update')->name('admin.kuota-gunung.update');
    Route::post('kuota-gunung/delete/{id}','Admin\KuotaGunungController@delete')->name('admin.kuota-gunung.delete');

    // Transaksi
    Route::get('transaksi','Admin\TransactionController@index')->name('admin.transaksi.index');

    Route::get('transaksi/edit/{id}','Admin\TransactionController@edit')->name('admin.transaksi.edit');
    Route::post('transaksi/update/{id}','Admin\TransactionController@update')->name('admin.transaksi.update');
    Route::get('transaksi/detail/{id}','Admin\TransactionController@detail')->name('admin.transaksi.detail');

    Route::get('scan/qr-code','Admin\QrCodeController@index')->name('scan.index');
    Route::post('scan/qr-code','Admin\QrCodeController@update')->name('scan.update');
    Route::post('scan/qr-code/turun','Admin\QrCodeController@updateTurun')->name('scan.update.turun');



});

Auth::routes([
        'register' => false, // Registration Routes...
        'reset' => false, // Password Reset Routes...
        'verify' => false, // Email Verification Routes...
]);

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/midtrans/callback', 'BookingController@callback')->name('callback.midtrans');

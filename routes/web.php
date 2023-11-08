<?php

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
    return view('welcome');
});
Route::group([ 'prefix'=>'umkm'], function() {
    Route::get('index', 'UmkmController@index')->name('umkm.index');
    Route::get('datatable', 'UmkmController@datatable')->name('umkm.datatable');
    Route::group([ 'prefix'=>'produk'], function() {
        Route::get('index', 'ProdukController@index')->name('produk.index');
        Route::get('datatable', 'ProdukController@datatable')->name('produk.datatable');
    });
});
Route::group([ 'prefix'=>'umkm' ], function() {
    Route::post('get-kota', 'UmkmController@getKota')->name('umkm.get-kota');
});
 
Auth::routes();
Route::group(['middleware' => ['auth']], function() {
    Route::group([ 'prefix'=>'umkm' ], function() {
        Route::get('create', 'UmkmController@create')->name('umkm.create');
        Route::get('edit/{id}', 'UmkmController@edit')->name('umkm.edit');
        Route::get('index-admin', 'UmkmController@indexAdmin')->name('umkm.index-admin');

        Route::put('update/{id}', 'UmkmController@update')->name('umkm.update');
        Route::post('store', 'UmkmController@store')->name('umkm.store');
        Route::delete('delete/{id}', 'UmkmController@delete')->name('umkm.delete');
        Route::get('detail/{id}', 'UmkmController@detail')->name('umkm.detail');
        Route::group([ 'prefix'=>'produk' ], function() {
            Route::get('create/{umkmId}', 'ProdukController@create')->name('produk.create');
            Route::get('edit/{id}', 'ProdukController@edit')->name('produk.edit');
            Route::get('index-admin/{umkmId}', 'ProdukController@index')->name('produk.index-admin');

            Route::post('update/{id}', 'ProdukController@update')->name('produk.update');
            Route::post('store', 'ProdukController@store')->name('produk.store');
            Route::post('delete/{id}', 'ProdukController@delete')->name('produk.delete');
            Route::get('detail/{id}', 'ProdukController@detail')->name('produk.detail');

        });
    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

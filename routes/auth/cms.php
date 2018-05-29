<?php

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

Route::group(['prefix' => 'karantina-tumbuhan'], function () {

	Route::get('/', 'KarantinaTumbuhanController@index')->name('cms_karantina_tumbuhan_index');
	Route::get('data', 'KarantinaTumbuhanController@getData')->name('cms_karantina_tumbuhan_data');
	Route::post('store', 'KarantinaTumbuhanController@store')->name('cms_karantina_tumbuhan_store');
	Route::post('edit', 'KarantinaTumbuhanController@edit')->name('cms_karantina_tumbuhan_edit');
	Route::get('varifikasi', 'KarantinaTumbuhanController@varifikasi')->name('cms_karantina_tumbuhan_varifikasi');
	Route::post('confirm', 'KarantinaTumbuhanController@confirm')->name('cms_karantina_tumbuhan_confirm');
	Route::get('print', 'KarantinaTumbuhanController@print')->name('cms_karantina_tumbuhan_print_terima_sample');
});

Route::group(['prefix' => 'korfug'], function () {

	Route::get('/', 'KorfugController@index')->name('cms_korfug_index');
	Route::get('data', 'KorfugController@getData')->name('cms_korfug_data');
	Route::post('store', 'KorfugController@store')->name('cms_korfug_store');
	Route::post('edit', 'KorfugController@edit')->name('cms_korfug_edit');
	Route::post('delete', 'KorfugController@delete')->name('cms_korfug_delete');
	Route::get('print', 'KorfugController@print')->name('cms_korfug_print');
});

Route::group(['prefix' => 'sample-tumbuhan'], function () {

	Route::get('/', 'SampleTumbuhanController@index')->name('cms_sample_tumbuhan_index');
	Route::get('data', 'SampleTumbuhanController@getData')->name('cms_sample_tumbuhan_data');
	Route::post('store', 'SampleTumbuhanController@store')->name('cms_sample_tumbuhan_store');
	Route::post('edit', 'SampleTumbuhanController@edit')->name('cms_sample_tumbuhan_edit');
});

Route::group(['prefix' => 'master-data'], function () {

	Route::group(['prefix' => 'upt'], function () {
		Route::get('/', 'MasterUptController@index')->name('cms_master_upt_index');
		Route::get('data', 'MasterUptController@getData')->name('cms_master_upt_data');
		Route::post('store', 'MasterUptController@store')->name('cms_master_upt_store');
		Route::post('edit', 'MasterUptController@edit')->name('cms_master_upt_edit');
	});
	
	Route::group(['prefix' => 'laboratorium'], function () {
		Route::get('/', 'MasterLaboraoriumController@index')->name('cms_master_laboratorium_index');
		Route::get('data', 'MasterLaboraoriumController@getData')->name('cms_master_laboratorium_data');
		Route::post('store', 'MasterLaboraoriumController@store')->name('cms_master_laboratorium_store');
		Route::post('edit', 'MasterLaboraoriumController@edit')->name('cms_master_laboratorium_edit');
	});
	
	Route::group(['prefix' => 'daftar-daerah'], function () {
		Route::get('/', 'DaftarDaerahController@index')->name('cms_master_daftar_daerah_index');
		Route::get('data', 'DaftarDaerahController@getData')->name('cms_master_daftar_daerah_data');
		Route::post('store', 'DaftarDaerahController@store')->name('cms_master_daftar_daerah_store');
		Route::post('edit', 'DaftarDaerahController@edit')->name('cms_master_daftar_daerah_edit');
	});
	
	Route::group(['prefix' => 'kegiatan'], function () {
		Route::get('/', 'MasterKegiatanController@index')->name('cms_master_kegiatan_index');
		Route::get('data', 'MasterKegiatanController@getData')->name('cms_master_kegiatan_data');
		Route::post('store', 'MasterKegiatanController@store')->name('cms_master_kegiatan_store');
		Route::post('edit', 'MasterKegiatanController@edit')->name('cms_master_kegiatan_edit');
	});
	
	Route::group(['prefix' => 'kategori'], function () {
		Route::get('/', 'MasterKategoriController@index')->name('cms_master_kategori_index');
		Route::get('data', 'MasterKategoriController@getData')->name('cms_master_kategori_data');
		Route::post('store', 'MasterKategoriController@store')->name('cms_master_kategori_store');
		Route::post('edit', 'MasterKategoriController@edit')->name('cms_master_kategori_edit');
	});
	
	Route::group(['prefix' => 'perusahaan'], function () {
		Route::get('/', 'MasterPerusahaanController@index')->name('cms_master_perusahaan_index');
		Route::get('data', 'MasterPerusahaanController@getData')->name('cms_master_perusahaan_data');
		Route::post('store', 'MasterPerusahaanController@store')->name('cms_master_perusahaan_store');
		Route::post('edit', 'MasterPerusahaanController@edit')->name('cms_master_perusahaan_edit');
	});
	
	Route::group(['prefix' => 'dokter'], function () {
		Route::get('/', 'MasterDokterController@index')->name('cms_master_dokter_index');
		Route::get('data', 'MasterDokterController@getData')->name('cms_master_dokter_data');
		Route::post('store', 'MasterDokterController@store')->name('cms_master_dokter_store');
		Route::post('edit', 'MasterDokterController@edit')->name('cms_master_dokter_edit');
	});
	
	
});

Route::group(['prefix' => 'target-pengujian'], function () {
	Route::get('/', 'TargetPengujianController@index')->name('cms_target_pengujian_index');
	Route::get('data', 'TargetPengujianController@getData')->name('cms_target_pengujian_data');
	Route::post('store', 'TargetPengujianController@store')->name('cms_target_pengujian_store');
	Route::post('edit', 'TargetPengujianController@edit')->name('cms_target_pengujian_edit');
});

Route::group(['prefix' => 'metode-pengujian'], function () {
	Route::get('/', 'MetodePengujianController@index')->name('cms_metode_pengujian_index');
	Route::get('data', 'MetodePengujianController@getData')->name('cms_metode_pengujian_data');
	Route::post('store', 'MetodePengujianController@store')->name('cms_metode_pengujian_store');
	Route::post('edit', 'MetodePengujianController@edit')->name('cms_metode_pengujian_edit');
});

Route::group(['prefix' => 'daftar-pengujian'], function () {
	Route::get('/', 'DaftarPengujianController@index')->name('cms_daftar_pengujian_index');
	Route::get('data', 'DaftarPengujianController@getData')->name('cms_daftar_pengujian_data');
	Route::post('store', 'DaftarPengujianController@store')->name('cms_daftar_pengujian_store');
	Route::post('edit', 'DaftarPengujianController@edit')->name('cms_daftar_pengujian_edit');
});

Route::group(['prefix' => 'kelompok-pengujian'], function () {
	Route::get('/', 'KelompokPengujianController@index')->name('cms_kelompok_pengujian_index');
	Route::get('data', 'KelompokPengujianController@getData')->name('cms_kelompok_pengujian_data');
	Route::post('store', 'KelompokPengujianController@store')->name('cms_kelompok_pengujian_store');
	Route::post('edit', 'KelompokPengujianController@edit')->name('cms_kelompok_pengujian_edit');
});

Route::group(['prefix' => 'penugasan'], function () {
	Route::get('/', 'PenugasanController@index')->name('cms_penugasan_index');
	Route::get('data', 'PenugasanController@getData')->name('cms_penugasan_data');
	Route::post('store', 'PenugasanController@store')->name('cms_penugasan_store');
	Route::post('edit', 'PenugasanController@edit')->name('cms_penugasan_edit');
});

Route::group(['prefix' => 'hasil-laboratorium'], function () {
	Route::get('/', 'HasilLaboratoriumController@index')->name('cms_hasil_laboratorium_index');
	Route::get('data', 'HasilLaboratoriumController@getData')->name('cms_hasil_laboratorium_data');
	Route::post('store', 'HasilLaboratoriumController@store')->name('cms_hasil_laboratorium_store');
	Route::post('edit', 'HasilLaboratoriumController@edit')->name('cms_hasil_laboratorium_edit');
});
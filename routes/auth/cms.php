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

Route::group(['prefix' => 'master-data'], function () {

	Route::group(['prefix' => 'daftar-daerah'], function () {
		Route::get('/', 'Pages\DaerahController@index')->name('cms_master_daerah_index');
		Route::get('data', 'Pages\DaerahController@getData')->name('cms_master_daerah_data');
		Route::post('store', 'Pages\DaerahController@store')->name('cms_master_daerah_store');
		Route::post('edit', 'Pages\DaerahController@edit')->name('cms_master_daerah_edit');
	});

	Route::group(['prefix' => 'daftar-jabatan'], function () {
		Route::get('/', 'Pages\JabatanController@index')->name('cms_master_jabatan_index');
		Route::get('data', 'Pages\JabatanController@getData')->name('cms_master_jabatan_data');
		Route::post('store', 'Pages\JabatanController@store')->name('cms_master_jabatan_store');
		Route::post('edit', 'Pages\JabatanController@edit')->name('cms_master_jabatan_edit');
	});

	Route::group(['prefix' => 'daftar-kelompok-metode-pengujian'], function () {
		Route::get('/', 'Pages\KelompokMetodePengujianController@index')->name('cms_master_kel_metode_pengujian_index');
		Route::get('data', 'Pages\KelompokMetodePengujianController@getData')->name('cms_master_kel_metode_pengujian_data');
		Route::post('store', 'Pages\KelompokMetodePengujianController@store')->name('cms_master_kel_metode_pengujian_store');
		Route::post('edit', 'Pages\KelompokMetodePengujianController@edit')->name('cms_master_kel_metode_pengujian_edit');
	});

	Route::group(['prefix' => 'daftar-laboratorium'], function () {
		Route::get('/', 'Pages\LaboratoriumController@index')->name('cms_master_laboratorium_index');
		Route::get('data', 'Pages\LaboratoriumController@getData')->name('cms_master_laboratorium_data');
		Route::post('store', 'Pages\LaboratoriumController@store')->name('cms_master_laboratorium_store');
		Route::post('edit', 'Pages\LaboratoriumController@edit')->name('cms_master_laboratorium_edit');
	});

	Route::group(['prefix' => 'daftar-target-pengujian'], function () {
		Route::get('/', 'Pages\TargetPengujianController@index')->name('cms_master_target_pengujian_index');
		Route::get('data', 'Pages\TargetPengujianController@getData')->name('cms_master_target_pengujian_data');
		Route::post('store', 'Pages\TargetPengujianController@store')->name('cms_master_target_pengujian_store');
		Route::post('edit', 'Pages\TargetPengujianController@edit')->name('cms_master_target_pengujian_edit');
	});
	
	Route::group(['prefix' => 'daftar-metode-pengujian'], function () {
		Route::get('/', 'Pages\MetodePengujianController@index')->name('cms_master_metode_pengujian_index');
		Route::get('data', 'Pages\MetodePengujianController@getData')->name('cms_master_metode_pengujian_data');
		Route::post('store', 'Pages\MetodePengujianController@store')->name('cms_master_metode_pengujian_store');
		Route::post('edit', 'Pages\MetodePengujianController@edit')->name('cms_master_metode_pengujian_edit');
	});
	
	Route::group(['prefix' => 'daftar-pegawai'], function () {
		Route::get('/', 'Pages\PegawaiController@index')->name('cms_master_pegawai_index');
		Route::get('data', 'Pages\PegawaiController@getData')->name('cms_master_pegawai_data');
		Route::post('store', 'Pages\PegawaiController@store')->name('cms_master_pegawai_store');
		Route::post('edit', 'Pages\PegawaiController@edit')->name('cms_master_pegawai_edit');
	});
	
	Route::group(['prefix' => 'daftar-kode-hs'], function () {
		Route::get('/', 'Pages\KodeHsController@index')->name('cms_master_kode_hs_index');
		Route::get('data', 'Pages\KodeHsController@getData')->name('cms_master_kode_hs_data');
		Route::post('store', 'Pages\KodeHsController@store')->name('cms_master_kode_hs_store');
		Route::post('edit', 'Pages\KodeHsController@edit')->name('cms_master_kode_hs_edit');
	});
	
	Route::group(['prefix' => 'daftar-kelompok-sample'], function () {
		Route::get('/', 'Pages\KelompokSampleController@index')->name('cms_master_kelompok_sample_index');
		Route::get('data', 'Pages\KelompokSampleController@getData')->name('cms_master_kelompok_sample_data');
		Route::post('store', 'Pages\KelompokSampleController@store')->name('cms_master_kelompok_sample_store');
		Route::post('edit', 'Pages\KelompokSampleController@edit')->name('cms_master_kelompok_sample_edit');
	});
	
	Route::group(['prefix' => 'daftar-satuan'], function () {
		Route::get('/', 'Pages\SatuanController@index')->name('cms_master_satuan_index');
		Route::get('data', 'Pages\SatuanController@getData')->name('cms_master_satuan_data');
		Route::post('store', 'Pages\SatuanController@store')->name('cms_master_satuan_store');
		Route::post('edit', 'Pages\SatuanController@edit')->name('cms_master_satuan_edit');
	});
	
	Route::group(['prefix' => 'daftar-upt'], function () {
		Route::get('/', 'Pages\UptController@index')->name('cms_master_upt_index');
		Route::get('data', 'Pages\UptController@getData')->name('cms_master_upt_data');
		Route::post('store', 'Pages\UptController@store')->name('cms_master_upt_store');
		Route::post('edit', 'Pages\UptController@edit')->name('cms_master_upt_edit');
	});
	
	Route::group(['prefix' => 'daftar-target-uji-golongan'], function () {
		Route::get('/', 'Pages\TargetUjiGolonganController@index')->name('cms_master_target_uji_golongan_index');
		Route::get('data', 'Pages\TargetUjiGolonganController@getData')->name('cms_master_target_uji_golongan_data');
		Route::post('store', 'Pages\TargetUjiGolonganController@store')->name('cms_master_target_uji_golongan_store');
		Route::post('edit', 'Pages\TargetUjiGolonganController@edit')->name('cms_master_target_uji_golongan_edit');
	});
	
	Route::group(['prefix' => 'daftar-target-pest'], function () {
		Route::get('/', 'Pages\TargetPestController@index')->name('cms_master_target_pest_index');
		Route::get('data', 'Pages\TargetPestController@getData')->name('cms_master_target_pest_data');
		Route::post('store', 'Pages\TargetPestController@store')->name('cms_master_target_pest_store');
		Route::post('edit', 'Pages\TargetPestController@edit')->name('cms_master_target_pest_edit');
	});
	
	Route::group(['prefix' => 'daftar-jenis-pengujian'], function () {
		Route::get('/', 'Pages\JenisPengujianController@index')->name('cms_master_jenis_pengujian_index');
		Route::get('data', 'Pages\JenisPengujianController@getData')->name('cms_master_jenis_pengujian_data');
		Route::post('store', 'Pages\JenisPengujianController@store')->name('cms_master_jenis_pengujian_store');
		Route::post('edit', 'Pages\JenisPengujianController@edit')->name('cms_master_jenis_pengujian_edit');
	});
	
	Route::group(['prefix' => 'daftar-perusahaan'], function () {
		Route::get('/', 'Pages\PerusahaanController@index')->name('cms_master_perusahaan_index');
		Route::get('data', 'Pages\PerusahaanController@getData')->name('cms_master_perusahaan_data');
		Route::post('store', 'Pages\PerusahaanController@store')->name('cms_master_perusahaan_store');
		Route::post('edit', 'Pages\PerusahaanController@edit')->name('cms_master_perusahaan_edit');
	});
	
	Route::group(['prefix' => 'daftar-negara'], function () {
		Route::get('/', 'Pages\NegaraController@index')->name('cms_master_negara_index');
		Route::get('data', 'Pages\NegaraController@getData')->name('cms_master_negara_data');
		Route::post('store', 'Pages\NegaraController@store')->name('cms_master_negara_store');
		Route::post('edit', 'Pages\NegaraController@edit')->name('cms_master_negara_edit');
	});
	
	Route::group(['prefix' => 'daftar-media-transpor'], function () {
		Route::get('/', 'Pages\MediaTransporController@index')->name('cms_master_media_transpor_index');
		Route::get('data', 'Pages\MediaTransporController@getData')->name('cms_master_media_transpor_data');
		Route::post('store', 'Pages\MediaTransporController@store')->name('cms_master_media_transpor_store');
		Route::post('edit', 'Pages\MediaTransporController@edit')->name('cms_master_media_transpor_edit');
	});
	
	Route::group(['prefix' => 'daftar-kegiatan'], function () {
		Route::get('/', 'Pages\KegiatanController@index')->name('cms_master_kegiatan_index');
		Route::get('data', 'Pages\KegiatanController@getData')->name('cms_master_kegiatan_data');
		Route::post('store', 'Pages\KegiatanController@store')->name('cms_master_kegiatan_store');
		Route::post('edit', 'Pages\KegiatanController@edit')->name('cms_master_kegiatan_edit');
	});
	
	Route::group(['prefix' => 'daftar-dokter-hewan'], function () {
		Route::get('/', 'Pages\DokterHewanController@index')->name('cms_master_dokter_hewan_index');
		Route::get('data', 'Pages\DokterHewanController@getData')->name('cms_master_dokter_hewan_data');
		Route::post('store', 'Pages\DokterHewanController@store')->name('cms_master_dokter_hewan_store');
		Route::post('edit', 'Pages\DokterHewanController@edit')->name('cms_master_dokter_hewan_edit');
	});
	
	Route::group(['prefix' => 'daftar-kategori'], function () {
		Route::get('/', 'Pages\KategoriController@index')->name('cms_master_kategori_index');
		Route::get('data', 'Pages\KategoriController@getData')->name('cms_master_kategori_data');
		Route::post('store', 'Pages\KategoriController@store')->name('cms_master_kategori_store');
		Route::post('edit', 'Pages\KategoriController@edit')->name('cms_master_kategori_edit');
	});
	
	Route::group(['prefix' => 'daftar-sample'], function () {
		Route::get('/', 'Pages\SampleController@index')->name('cms_master_sample_index');
		Route::get('data', 'Pages\SampleController@getData')->name('cms_master_sample_data');
		Route::post('store', 'Pages\SampleController@store')->name('cms_master_sample_store');
		Route::post('edit', 'Pages\SampleController@edit')->name('cms_master_sample_edit');
	});
	
	Route::group(['prefix' => 'daftar-permohonan'], function () {
		Route::get('/', 'Pages\PermohonanController@index')->name('cms_master_permohonan_index');
		Route::get('data', 'Pages\PermohonanController@getData')->name('cms_master_permohonan_data');
		Route::post('store', 'Pages\PermohonanController@store')->name('cms_master_permohonan_store');
		Route::post('edit', 'Pages\PermohonanController@edit')->name('cms_master_permohonan_edit');
	});

	
});
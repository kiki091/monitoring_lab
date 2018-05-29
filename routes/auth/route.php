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


Route::group(['middleware' => ['web']], function () 
{
	//Route::group(['domain' => env('WORLD_WIDE_WEB') . env('AUTH_DOMAIN_PREFIX') . env('APP_DOMAIN')], function()
	
	Route::get('/', 'Auth\AuthController@index')->name('users_login');
	Route::get('register', 'Auth\AuthController@register')->name('users_register');
	Route::post('registered', 'Auth\AuthController@registered')->name('users_registered');

	Route::post('auth', 'Auth\AuthController@authenticate')->name('users_authenticate');
	Route::post('change-password', 'Auth\AuthController@changePassword')->name('users_chenge_password');
	Route::get('logout', 'Auth\AuthController@logout')->name('users_logout');

	Route::group(['middleware' => ['users', 'auth.privilege']], function (){

		Route::group(['prefix' => RouteUsersLocation::setUsersLocation()], function () {

			Route::get('/', 'Auth\DashboardController@index')->name('users_dashboard');

			// CMS MANAGEMENT ROUTE
			
			include __DIR__.'/cms.php';

			// ACCOUNT MANAGEMENT ROUTE

			Route::group(['prefix' => 'account'], function () {

				// MENU GROUP MANAGEMENT ROUTE

				Route::group(['prefix' => 'menu-group'], function ()
				{
					Route::get('/', 'Auth\MenuGroupController@index')->name('CmsMenuGroupManager');
					Route::get('data', 'Auth\MenuGroupController@getData')->name('CmsMenuGroupManagerGetData');
					Route::post('change-status', 'Auth\MenuGroupController@changeStatus')->name('CmsMenuGroupManagerChangeStatus');
				});

				// MENU NAVIGATION MANAGEMENT ROUTE

				Route::group(['prefix' => 'menu-navigation'], function ()
				{
					Route::get('/', 'Auth\MenuNavigationController@index')->name('CmsMenuNavigation');
					Route::get('data', 'Auth\MenuNavigationController@getData')->name('CmsMenuNavigationGetData');
					Route::post('change-status', 'Auth\MenuNavigationController@changeStatus')->name('CmsMenuNavigationChangeStatus');
				});

				// SUB MENU NAVIGATION MANAGEMENT ROUTE

				Route::group(['prefix' => 'sub-menu-navigation'], function ()
				{
					Route::get('/', 'Auth\SubMenuNavigationController@index')->name('CmsSubMenuNavigation');
					Route::get('data', 'Auth\SubMenuNavigationController@getData')->name('CmsSubMenuNavigationGetData');
					Route::post('change-status', 'Auth\SubMenuNavigationController@changeStatus')->name('CmsSubMenuNavigationChangeStatus');
				});

				// USER ACCOUNT MANAGEMENT ROUTE

				Route::group(['prefix' => 'user-account'], function ()
				{
					Route::get('/', 'Auth\UserAccountController@index')->name('CmsUserAccount');
					Route::get('data', 'Auth\UserAccountController@getData')->name('CmsUserAccountGetData');
					Route::post('change-status', 'Auth\UserAccountController@changeStatus')->name('CmsUserAccountChangeStatus');
					Route::post('store', 'Auth\UserAccountController@store')->name('CmsUserAccountStoreData');
					Route::post('edit', 'Auth\UserAccountController@edit')->name('CmsUserAccountEditData');
					Route::post('change-password', 'Auth\UserAccountController@changePassword')->name('CmsUserAccountChangePassword');
				});
			});
		});
	});
});

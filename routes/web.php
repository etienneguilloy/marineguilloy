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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('administration')->group(function () {
   Route::get('categorie', 'Administration\CategorieController@index')->name('categorieHome');
   Route::post('categorie', 'Administration\CategorieController@categorieAdd')->name('categorieAdd');
   Route::post('categorieLibel', 'Administration\CategorieController@categorieLibel')->name('categorieLibel');
   Route::delete('categorie/{id}', 'Administration\CategorieController@categorieDelete')->name('categorieDelete');
   
   Route::get('album/{id}', 'Administration\AlbumController@index')->name('albumHome');
   Route::post('album', 'Administration\AlbumController@albumAdd')->name('albumAdd');
   Route::delete('album/{id}', 'Administration\AlbumController@albumDelete')->name('albumDelete');
   Route::patch('album/{id}', 'Administration\AlbumController@albumEdit')->name('albumEdit');
   
   Route::post('photo', 'Administration\PhotoController@photoAdd')->name('photoAdd');
   Route::post('photoDelete', 'Administration\PhotoController@photoDelete')->name('photoDelete');
   Route::patch('photo/{id}', 'Administration\PhotoController@photoEdit')->name('photoEdit');
});

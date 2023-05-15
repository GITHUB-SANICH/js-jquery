<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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


Route::get('/', 'StaticController@index_metod');

//учебные шеблоны
Route::get('/about-us', 'StaticController@about_metod');

//шаблон ДЗ
Route::get('/blog', 'DzController@dz_metod');

//Route::get('/str/{id}/{second}', function ($id, $second) {
//	return "ID str: $id. Second: $second";
//});

//Route::get('/', function () {
//	return view('welcome');
//});

//отслеживание ссылок с вызовом контроллера
//Route::get('/articles', 'ArticlesController@create');	//отслеживание страницы
Route::get('/articles/{id}', 'ArticlesController@show');	//отслеживание динамических страниц
//Route::get('/articles/{id}', 'CommentController@show');	//отслеживание динамических страниц
Route::post('/articles/{id}', 'CommentController@store');	//отслеживание динамических страниц

Route::get('/article/add', 'ArticlesController@create');	//отслеживание страницы заполнения формы
Route::post('/article/add', 'ArticlesController@store');	//вызов контроллера при передачи данных со страницы методом пост
//роуты вызывающие контроллеры изменения и удаления статей
Route::get('/article/{id}/edit', 'ArticlesController@edit');	//отслеживание страницы редактирования статьи
Route::put('/article/{id}/edit', 'ArticlesController@update');	//отслеживание страницы редактирования статьи
Route::delete('/article/{id}/delete', 'ArticlesController@destroy');	//отслеживание страницы редактирования статьи
//роуты ДЗ
Route::controller(ShopController::class)->group(function(){
	Route::get('/public/shop', 'index');		//отслеживание страницы редактирования статьи
	Route::get('/public/shop/add', 'create');	//отслеживание страницы добавления товаров
	Route::post('/public/shop/add', 'store');	//вызов контроллера при передачи данных со страницы методом пост
	Route::get('/public/shop/{id}', 'show');	//отслеживание страницы товара
	Route::get('/public/shop/{id}/edit', 'edit');	//отслеживание страницы редактирования статьи
	Route::put('/public/shop/{id}/edit', 'update');
	Route::delete('/public/shop/{id}/delete', 'destroy');
});

//Route::resource('/public/shop', 'ShopController'); 


//Route::get('/public/shop', 'ShopController@index');		//отслеживание страницы редактирования статьи
//Route::get('/public/shop/add', 'ShopController@create');	//отслеживание страницы добавления товаров
//Route::post('/public/shop/add', 'ShopController@store');	//вызов контроллера при передачи данных со страницы методом пост
//Route::get('/public/shop/{id}', 'ShopController@show');	//отслеживание страницы товара
//Route::get('/public/shop/{id}/edit', 'ShopController@edit');	//отслеживание страницы редактирования статьи
//Route::put('/public/shop/{id}/edit', 'ShopController@update');
//Route::delete('/public/shop/{id}/delete', 'ShopController@destroy');

//resource - отслеживает все страницы определенного вида и подберает для них соответствующие методы соответствующих контроллеров
//Route::resource('/articles', 'ArticlesController'); 

Route::get('/user', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();


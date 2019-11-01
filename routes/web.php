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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::post('/app/add_product', "ProductController@storeProduct");
Route::get('/app/all_product', "ProductController@all_product");
Route::get('/app/product/{id}', "ProductController@show_product");
Route::post('/app/delete_product', "ProductController@delete_Product");
Route::post('/app/edit_product', "ProductController@updateProduct");

Route::post('/app/add_category', "CategoryController@storeCategory");
Route::get('/app/all_category', "CategoryController@all_Category");
Route::get('/app/category/{id}', "CategoryController@show_Category");
Route::post('/app/delete_category', "CategoryController@delete_Category");
Route::post('/app/edit_category', "CategoryController@updateCategory");


Route::get('/app/all_tag', "TagController@allTag");
Route::post('/app/add_tag', "TagController@storeTag");
Route::post('/app/edit_tag', "TagController@updateTag");
Route::post('/app/delete_tag', "TagController@deleteTag");



Route::post('/app/registration', "UserController@registration");
Route::post('/app/login', "UserController@login");



Route::any('{slug}', 'HomeController@home')->where('slug', '([A-z\d-\/_.]+)?');

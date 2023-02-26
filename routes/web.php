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

//Route::get('/','Frontend\HomeController@index');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::post('/hi','HomeController@getTest')->name('test');
Route::post('/password/mail','Auth\ForgotPasswordController@sendCodeResetPassword')->name('send.reset.password.mail');
Route::get('/password/reset/confirm','Auth\ResetPasswordController@showResetForm')->name('get.link.reset.password');
Route::post('/password/reset/confirm','Auth\ResetPasswordController@resetPassword')->name('reset.password');

Route::group([
	'namespace'=>'Frontend'
],function(){
	Route::get('/','HomeController@index')->name('index');
	Route::get('contact','HomeController@contact')->name('contact');
	Route::post('contact', 'HomeController@submitContact')->name('submitContact');
	Route::get('/checkout','HomeController@checkout')->name('checkout');
	Route::get('/show','HomeController@show')->name('show');
	Route::get('product/find', 'HomeController@find')->name('frontend.product.find');

	Route::group([
		'prefix'=>'category',
		'namespace'=>'Category'
	],function(){
		Route::get('{category}','CategoryController@products')->name('frontend.category.products');
	});

	Route::group([
		'prefix'=>'cart',
		'namespace'=>'Cart'
	],function(){
		Route::get('index','CartController@index')->name('frontend.cart.index');
		Route::get('total','CartController@total')->name('frontend.cart.total');
		Route::post('updateItem','CartController@updateItem')->name('frontend.cart.updateItem');
		Route::get('add/{product_id}','CartController@add')->name('frontend.cart.add');
		Route::get('plus/{rowId}','CartController@plus')->name('frontend.cart.plus');
		Route::get('minus/{rowId}','CartController@minus')->name('frontend.cart.minus');
		Route::get('remove/{rowId}','CartController@remove')->name('frontend.cart.remove');
		Route::get('confirm','CartController@confirm')->name('frontend.cart.confirm');
	});

	Route::group([
		'prefix'=>'product',
		'namespace'=>'Product'
	],function(){
		Route::get('/details/{id}','ProductController@show')->name('frontend.product.show');
		Route::get('search/{key}','ProductController@search')->name('frontend.product.search');

	});

	Route::group([
		'prefix'=>'user',
		'namespace'=>'User',
		'middleware'=>'auth'
	],function(){
		Route::get('show','UserController@show')->name('frontend.user.show');
		Route::get('edit','UserController@edit')->name('frontend.user.edit');
		Route::get('change-password','UserController@changePasswordForm')->name('frontend.user.changePasswordForm');
		Route::match(['put','patch'],'/','UserController@update')->name('frontend.user.update');
		Route::match(['put','patch'],'change-password','UserController@changePassword')->name('frontend.user.changePassword');
		Route::get('orders', 'UserController@orders')->name('frontend.user.orders');
		Route::get('orders/{id}', 'UserController@showOrder')->name('frontend.user.showOrder');
	});
});


Route::group([
	'prefix'=>'admin',
	'namespace'=>'Backend',
	'middleware'=>'auth'
],function(){
	Route::get('/','DashboardController@index')->name('backend.dashboard');

	Route::group([
		'prefix'=>'user',
		'namespace'=>'User'
	],function(){
		Route::get('/test','UserController@test')->name('backend.user.test');
		Route::post('/test','UserController@test1')->name('backend.user.test1');
		Route::get('/index','UserController@index')->name('backend.user.index');
		Route::get('/create','UserController@create')->name('backend.user.create');

		Route::post('/','UserController@store')->name('backend.user.store');

		Route::get('/edit/{id}','UserController@edit')->name('backend.user.edit');
		Route::get('/cap-nhat','UserController@edit1')->name('backend.user.edit1');
		Route::match(['put','patch'],'/{id}','UserController@update')->name('backend.user.update');
		
		Route::get('/{id}','UserController@show')->name('backend.user.show');

		Route::get('products/{id}','UserController@showProducts')->name('backend.user.showProducts');

		Route::delete('delete/{id}','UserController@destroy')->name('backend.user.delete');
	});

	Route::group([
		'prefix'=>'product',
		'namespace'=>'Product'
	],function(){
		Route::get('/index','ProductController@index')->name('backend.product.index');
		Route::get('/create','ProductController@create')->name('backend.product.create');
		Route::post('/','ProductController@store')->name('backend.product.store');
		Route::get('/edit/{product}','ProductController@edit')->name('backend.product.edit');

		// Route::get('/edit/{product}','ProductController@edit')->name('backend.product.edit')->middleware('can:update,product');
		
		Route::match(['put','patch'],'/{id}','ProductController@update')->name('backend.product.update');

		Route::get('/{id}','ProductController@show')->name('backend.product.show');
		Route::get('/orders/{id}','ProductController@showOrders')->name('backend.product.showOrders');
		Route::delete('/delete/{id}','ProductController@destroy')->name('backend.product.delete');
		Route::get('/images/{id}','ProductController@showImages')->name('backend.product.showImages');
		
		Route::get('/test','ProductController@test');
	});

	Route::group([
		'prefix'=>'category',
		'namespace'=>'Category'
	],function(){
		Route::get('/index','CategoryController@index')->name('backend.category.index');
		Route::get('/show/{id}','CategoryController@show')->name('backend.category.show');
		Route::get('/create','CategoryController@create')->name('backend.category.create');
		Route::post('/','CategoryController@store')->name('backend.category.store');

		Route::get('/edit/{id}','CategoryController@edit')->name('backend.category.edit');
		Route::match(['put','patch'],'/{id}','CategoryController@update')->name('backend.category.update');

		Route::delete('/delete/{id}','CategoryController@destroy')->name('backend.category.delete');

		Route::get('products/{id}','CategoryController@showProducts')->name('backend.category.showProducts');
	});

	Route::group([
		'prefix'=>'contact',
		'namespace'=>'Contact'
	],function(){
		Route::get('/index','ContactController@index')->name('backend.contact.index');
		Route::get('/show/{id}','ContactController@show')->name('backend.contact.show');
		Route::delete('/delete/{id}','ContactController@destroy')->name('backend.contact.delete');
	});

	Route::group([
		'prefix'=>'order',
		'namespace'=>'Order'
	],function(){
		Route::get('/index','OrderController@index')->name('backend.order.index');
		Route::get('/products/{id}','OrderController@showProducts')->name('backend.order.showProducts');
		Route::get('new-orders','OrderController@newOrders')->name('backend.order.newOrders');
		Route::get('revenue','OrderController@revenue')->name('backend.order.revenue');
		Route::get('confirm','OrderController@confirm')->name('backend.order.confirm')->middleware('auth');
		Route::match(['put','patch'],'confirm/{order_id}','OrderController@confirm')->name('backend.order.confirm')->middleware('auth');
		Route::match(['put','patch'],'complete/{order_id}','OrderController@complete')->name('backend.order.complete')->middleware('auth');
		Route::delete('/delete/{id}','OrderController@destroy')->name('backend.order.delete');
	});
});
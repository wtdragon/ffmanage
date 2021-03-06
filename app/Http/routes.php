<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', 'middleware' => 'auth',function () {
//    return view('home');
//});


Route::get('/', [
 
	    'middleware' => 'acl'
 
	]);

//分红信息

Route::resource('intrests','IntrestsController');

//合同记录

Route::resource('contracts', 'ContractsController');

//员工记录

Route::resource('employees', 'EmployeesController');

//职位记录

Route::resource('positions', 'PositionsController');

//产品记录

Route::resource('products', 'ProductsController');

//客户记录

Route::resource('customers','CustomersController');

//生成报表

Route::resource('reports', 'ReportsController');

Route::get('prodreports',[
		'as'=>'prodreports',
		'uses'=>'ReportsController@prodreports'
	]);
	
Route::get('contractreports',[
		'as'=>'contractreports',
		'uses'=>'ReportsController@contractreports'
	]);	
	
Route::get('ctrreports',[
		'as'=>'ctrreports',
		'uses'=>'ReportsController@ctrreports'
	]);
	
Route::get('cusreports',[
		'as'=>'cusreports',
		'uses'=>'ReportsController@cusreports'
	]);		
Route::get('download/{filename}',[
		'as'=>'download',
		'uses'=>'ReportsController@download'
	]);	
	
Route::post('cdata',[
		'as'=>'cdata',
		'uses'=>'ReportsController@anydata'
	]);
 
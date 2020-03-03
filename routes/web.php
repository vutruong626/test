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
//     return view('index');
// });





Route::namespace('Frontend')->group(function () {
    Route::get('/','PageController@index');

    Route::get('/create','PageController@create')->name('get_register');
    Route::post('/create/register','PageController@register')->name('create_register');
    Route::get('/success','PageController@success')->name('success');
});

Route::namespace('Backend')->group(function () {
    Route::get('/admin','LoginController@index')->name('login');
    Route::post('/admin','LoginController@getAdmin')->name('get_admin');

    Route::get('/list/user','LoginController@listUser')->name('list_user');
    Route::get('/edit-user/{id?}','LoginController@editUser')->name('edit_user');
    Route::put('/edit-user','LoginController@updateUser')->name('update_user');



    Route::get('/register','LoginController@register')->name('register');
    Route::post('/create','LoginController@createUser')->name('create_user');
    
    // PageController
    Route::get('/list-brief','PageController@listBrief')->name('list_brief');
    Route::get('/validation/{id?}','PageController@validationBrief')->name('validattion_brief');
    Route::post('/validation/cancel/{id?}','PageController@cancelBrief')->name('cancel_brief');
    Route::get('/validation/step-1/{id?}','PageController@successBrief')->name('success_brief');
   

    // Route::get('/list-brief','PageController@ListAuthenticationManage')->name('list_manage');
    // Route::get('/validation/step-2/{id?}','PageController@AuthenticationManage')->name('authentication_manage');
    // Route::post('/validation/step-2/cancel/{id?}','PageController@ManageErrAuthentication')->name('managetauthentication');
    // Route::post('/validation/step-2/success/{id?}','PageController@ManageSuccessAuthentication')->name('managecussessauthentication');

});
<?php
/**
 * Created by PhpStorm.
 * User: Andersen_user
 * Date: 21.08.2015
 * Time: 0:31
 */



Route::controllers([
    'auth' => 'Notprometey\Mposuccess\Http\Auth\AuthController',
    'password' => 'Notprometey\Mposuccess\Http\Auth\PasswordController',
    //'admin' => 'Notprometey\Mposuccess\Http\Middleware\AdminMiddleware',
]);



Route::get('/', array(
    'as' => 'home',
    'uses' => 'Notprometey\Mposuccess\Controllers\FrontController@index',
));


Route::get('success/defense', array(
    'as' => 'defense',
    'uses' => 'Notprometey\Mposuccess\Controllers\FrontController@defense',
));

Route::get('news', array(
    'as' => 'news',
    'uses' => 'Notprometey\Mposuccess\Controllers\FrontController@news',
));

Route::get('article', array(
    'as' => 'article',
    'uses' => 'Notprometey\Mposuccess\Controllers\FrontController@article',
));

Route::group(['prefix' => 'about'], function()
{

    Route::get('/', array(
        'as' => 'about',
        'uses' => 'Notprometey\Mposuccess\Controllers\FrontController@about',
    ));

    Route::get('contacts', array(
        'as' => 'contacts',
        'uses' => 'Notprometey\Mposuccess\Controllers\FrontController@contacts',
    ));

    Route::get('rights', array(
        'as' => 'rights',
        'uses' => 'Notprometey\Mposuccess\Controllers\FrontController@rights',
    ));

    Route::get('charter', array(
        'as' => 'charter',
        'uses' => 'Notprometey\Mposuccess\Controllers\FrontController@charter',
    ));

    Route::get('regdocs', array(
        'as' => 'regdocs',
        'uses' => 'Notprometey\Mposuccess\Controllers\FrontController@regdocs',
    ));

});
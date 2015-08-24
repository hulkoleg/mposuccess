<?php
/**
 * Created by PhpStorm.
 * User: Andersen_user
 * Date: 21.08.2015
 * Time: 0:31
 */
Route::group(array(
    'prefix' => config('mposuccess.site_url'),
    'middleware' => 'Notprometey\Mposuccess\Http\Middleware\Front'),
    function() {
        Route::get('/', array(
            'as' => 'home',
            'uses' => 'Notprometey\Mposuccess\Controllers\FrontController@index',
        ));
    }
);

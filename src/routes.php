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
]);


Route::group([
        'middleware' => 'Notprometey\Mposuccess\Http\Middleware\AdminMiddleware',
        'prefix' => 'admin'
    ],
    function(){
        /*
         * Роуты для админа. Проверка на админа в Notprometey\Mposuccess\Http\Middleware\Admin и если нет прав перенапровление а лучше 404
         */
    }
);

Route::group([
    'middleware' => 'Notprometey\Mposuccess\Http\Middleware\UserMiddleware',
    'prefix' => 'profile'
],
    function(){
        Route::get('/', array(
            'as'    => 'profile.home',
            'uses'  => 'Notprometey\Mposuccess\Controllers\UserController@personal',
        ));

        Route::get('personal', array(
            'as' => 'profile.personal',
            'uses' => 'Notprometey\Mposuccess\Controllers\UserController@personal',
        ));

        Route::post('changeData', array(
            'as'    => 'profile.changeData',
            'uses'  => 'Notprometey\Mposuccess\Controllers\UserController@changeData',
        ));

        Route::post('changeAvatar', array(
            'as'    => 'profile.changeAvatar',
            'uses'  => 'Notprometey\Mposuccess\Controllers\UserController@changeAvatar',
        ));

        Route::get('removeAvatar', array(
            'as'    => 'profile.removeAvatar',
            'uses'  => 'Notprometey\Mposuccess\Controllers\UserController@removeAvatar',
        ));

        Route::post('changePassword', array(
            'as'    => 'profile.changePassword',
            'uses'  => 'Notprometey\Mposuccess\Controllers\UserController@changePassword',
        ));

        Route::get('news', array(
            'as' => 'profile.news',
            'uses' => 'Notprometey\Mposuccess\Controllers\UserController@news',
        ));

        Route::get('score/refill', array(
            'as' => 'profile.refill',
            'uses' => 'Notprometey\Mposuccess\Controllers\UserController@refill',
        ));

        Route::get('catalog', array(
            'as' => 'profile.catalog',
            'uses' => 'Notprometey\Mposuccess\Controllers\UserController@catalog',
        ));

    }
);

Route::group([
        'middleware' => 'Notprometey\Mposuccess\Http\Middleware\ProfileMiddleware',
        'prefix' => 'profile'
    ],
    function(){


        Route::get('score/withdrawal', array(
            'as' => 'profile.withdrawal',
            'uses' => 'Notprometey\Mposuccess\Controllers\ProfileController@withdrawal',
        ));

        Route::get('score/purchases', array(
            'as' => 'profile.purchases',
            'uses' => 'Notprometey\Mposuccess\Controllers\ProfileController@purchases',
        ));

        Route::get('score/places', array(
            'as' => 'profile.places',
            'uses' => 'Notprometey\Mposuccess\Controllers\ProfileController@places',
        ));

        Route::get('structures/{id}', array(
            'as' => 'profile.structures',
            'uses' => 'Notprometey\Mposuccess\Controllers\ProfileController@structures',
        ));

        Route::get('tree', array(
            'as' => 'profile.tree',
            'uses' => 'Notprometey\Mposuccess\Controllers\ProfileController@tree',
        ));
    }
);


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


Route::any('test/tree', array(
    'as' => 'regdocs',
    'uses' => 'Notprometey\Mposuccess\Controllers\FrontController@test',
));
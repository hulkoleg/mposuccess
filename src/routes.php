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
        'prefix'     => config('mposuccess.panel_admin_url')
    ],
    function(){
        /*
         * Роуты для админа. Проверка на админа в Notprometey\Mposuccess\Http\Middleware\Admin и если нет прав перенапровление а лучше 404
         */
        Route::get('article', array(
            'as'    => config('mposuccess.admin_prefix') . '.article',
            'uses'  => 'Notprometey\Mposuccess\Controllers\AdminController@article'
        ));

        Route::get('news', array(
            'as'    => config('mposuccess.admin_prefix') . '.news',
            'uses'  => 'Notprometey\Mposuccess\Controllers\AdminController@news'
        ));

        Route::get('news/add', array(
            'as'    => config('mposuccess.admin_prefix') . '.news.add',
            'uses'  => 'Notprometey\Mposuccess\Controllers\AdminController@addNews'
        ));

        Route::get('payments', array(
            'as'    => config('mposuccess.admin_prefix') . '.payments',
            'uses'  => 'Notprometey\Mposuccess\Controllers\AdminController@payments'
        ));

        Route::get('reports', array(
            'as'    => config('mposuccess.admin_prefix') . '.reports',
            'uses'  => 'Notprometey\Mposuccess\Controllers\AdminController@reports'
        ));

        Route::get('roles', array(
            'as'    => config('mposuccess.admin_prefix') . '.roles',
            'uses'  => 'Notprometey\Mposuccess\Controllers\AdminController@roles'
        ));

        Route::get('users', array(
            'as'    => config('mposuccess.admin_prefix') . '.users',
            'uses'  => 'Notprometey\Mposuccess\Controllers\AdminController@users'
        ));
    }
);

Route::group([
    'middleware' => 'Notprometey\Mposuccess\Http\Middleware\UserMiddleware',
    'prefix'     => config('mposuccess.panel_url')
],
    function(){
        Route::get('/', array(
            'as'    => config('mposuccess.panel_url') . '.home',
            'uses'  => 'Notprometey\Mposuccess\Controllers\UserController@dashboard',
        ));

        /*
         * Мой профиль
         */
        Route::get('personal', array(
            'as'    => config('mposuccess.panel_url') . '.personal',
            'uses'  => 'Notprometey\Mposuccess\Controllers\UserController@personal',
        ));

        Route::get('user/{id}', array(
            'as'    => config('mposuccess.panel_url') . '.user',
            'uses'  => 'Notprometey\Mposuccess\Controllers\UserController@user',
        ));


        Route::post('changeData', array(
            'as'    => config('mposuccess.panel_url') . '.changeData',
            'uses'  => 'Notprometey\Mposuccess\Controllers\UserController@changeData',
        ));

        Route::post('changeAvatar', array(
            'as'    => config('mposuccess.panel_url') . '.changeAvatar',
            'uses'  => 'Notprometey\Mposuccess\Controllers\UserController@changeAvatar',
        ));

        Route::get('removeAvatar', array(
            'as'    => config('mposuccess.panel_url') . '.removeAvatar',
            'uses'  => 'Notprometey\Mposuccess\Controllers\UserController@removeAvatar',
        ));

        Route::post('changePassword', array(
            'as'    => config('mposuccess.panel_url') . '.changePassword',
            'uses'  => 'Notprometey\Mposuccess\Controllers\UserController@changePassword',
        ));

        /*
         * Личные данные
         */
        Route::get('dashboard', array(
            'as'    => config('mposuccess.panel_url') . '.dashboard',
            'uses'  => 'Notprometey\Mposuccess\Controllers\UserController@dashboard',
        ));

        Route::get('news', array(
            'as'    => config('mposuccess.panel_url') . '.news',
            'uses'  => 'Notprometey\Mposuccess\Controllers\UserController@news',
        ));

        Route::get('post/{id}', array(
            'as'    => config('mposuccess.panel_url') . '.post',
            'uses'  => 'Notprometey\Mposuccess\Controllers\UserController@post',
        ));

        Route::get('score/refill', array(
            'as'    => config('mposuccess.panel_url') . '.refill',
            'uses'  => 'Notprometey\Mposuccess\Controllers\UserController@refill',
        ));

        Route::get('catalog', array(
            'as'    => config('mposuccess.panel_url') . '.catalog',
            'uses'  => 'Notprometey\Mposuccess\Controllers\UserController@catalog',
        ));

    }
);

Route::group([
        'middleware' => 'Notprometey\Mposuccess\Http\Middleware\ProfileMiddleware',
        'prefix'     => config('mposuccess.panel_url')
    ],
    function(){


        Route::get('score/withdrawal', array(
            'as'    => config('mposuccess.panel_url') . '.withdrawal',
            'uses'  => 'Notprometey\Mposuccess\Controllers\ProfileController@withdrawal',
        ));

        Route::get('score/purchases', array(
            'as'    => config('mposuccess.panel_url') . '.purchases',
            'uses'  => 'Notprometey\Mposuccess\Controllers\ProfileController@purchases',
        ));

        Route::get('score/places', array(
            'as'    => config('mposuccess.panel_url') . '.places',
            'uses'  => 'Notprometey\Mposuccess\Controllers\ProfileController@places',
        ));

        Route::get('structures/{id}', array(
            'as'    => config('mposuccess.panel_url') . '.structures',
            'uses'  => 'Notprometey\Mposuccess\Controllers\ProfileController@structures',
        ));

        Route::get('tree', array(
            'as'    => config('mposuccess.panel_url') . '.tree',
            'uses'  => 'Notprometey\Mposuccess\Controllers\ProfileController@tree',
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
<?php

return [
    'site_url' => '/',
    'profile_url' => 'profile',
    'teacher_url' => 'admin',

    'news_type_private'         => '1',
    'news_type_company'         => '2',
    'news_type_world'           => '3',
    'news_storage_img'          => '/images/news/',
    'news_private_default_img'  => '/images/news/' . 'default-private.png',


    /*
     * Переменная $company_title - переменная которая всегда есть в заголовке в виде названия сайта или компании.
     */
    'company_title' => 'Test_Company',

    /*
     * Переменная $default_title - это переменная вызывается в случае отсутствия переменной заголовка.
     */
    'default_title' => 'Значение по умолчанию'

];
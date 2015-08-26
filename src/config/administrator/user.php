<?php

/**
 * Actors model config
 */

return array(

	'title' => 'User',

	'single' => 'User',

	'model' => 'Notprometey\Mposuccess\Models\User',

	/**
	 * The display columns
	 */
	'columns' => array(
		'id' 			=> array('title' => 'ID'),
		'name' 			=> array('title' => 'Имя пользователя'),
		'email' 		=> array('title' => 'Почта'),
		'created_at'	=> array('title' => 'Создан'),
		'updated_at'	=> array('title' => 'Изменён'),
		'password'		=> array('title' => 'Хэш пароля')
	),

	/**
	 * The filter set
	 */
	'filters' => array(
		'id' 			=> array('title' => 'ID'),
		'name' 			=> array('title' => 'Имя пользователя'),
		'email'			=> array('title' => 'Почта'),
		'created_at' 	=> array('title' => 'Создан', 'type' => 'datetime'),
		'updated_at' 	=> array('title' => 'Изменён', 'type' => 'datetime'),
	),

	/**
	 * The editable fields
	 */
	'edit_fields' => array(
		'id' 		=> array('title' => 'ID'),
		'name'		=> array('title' => 'Имя пользователя'),
		'email'		=> array('title' => 'Почта'),
		'password'	=> array('title' => 'Пароль')
	),

	/**
	 * The validation rules for the form, based on the Laravel validation class
	 *
	 * @type array
	 */
	'rules' => array(
		'name' => 'required|min:3|max:255',
		'email' => 'required|email|max:255|unique:users',
		'password' => 'required|min:6',
	),

	//test
	'before_save' => function(&$data)
	{
		$data['name'] = $data['name'] . ' - test';
	},

);
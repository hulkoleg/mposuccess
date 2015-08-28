<?php

/**
 * Actors model config
 */

return array(

	'title' => 'Пользователи',

	'single' => 'пользователя',

	'model' => 'Notprometey\Mposuccess\Models\User',

	/**
	 * The display columns
	 */
	'columns' => array(
		'id' 			=> array('title' => 'ID'),
		'name' 			=> array('title' => 'Имя пользователя'),
		'email' 		=> array('title' => 'Почта'),
		'roles' 		=> array(
			'type' 		 => 'relationship',
			'title' 	 => 'Роли',
			'output' => function($value)
			{
				$roles = array();
				foreach($value->toArray() as $role) {
					$roles[] = $role['name'];
				}
				return implode(", ", $roles);
			},
		),
		'permissions' 		=> array(
			'type' 		 => 'relationship',
			'title' 	 => 'Права',
			'output' => function($value)
			{
				$permissions = array();
				foreach($value->toArray() as $permission) {
					$permissions[] = $permission['name'];
				}
				return implode(", ", $permissions);
			},
		),
		'password'		=> array('title' => 'Хэш пароля'),
		'created_at'	=> array('title' => 'Создан'),
		'updated_at'	=> array('title' => 'Изменён'),
	),

	/**
	 * The filter set
	 */
	'filters' => array(
		'id' 			=> array('title' => 'ID'),
		'name' 			=> array('title' => 'Имя пользователя', 'limit' => 10),
		'email'			=> array('title' => 'Почта'),
		'created_at' 	=> array('title' => 'Создан', 'type' => 'datetime'),
		'updated_at' 	=> array('title' => 'Изменён', 'type' => 'datetime'),
		'roles' 		=> array('type'  => 'relationship', 'title' => 'Роли'),
		'permissions' 	=> array('type'  => 'relationship', 'title' => 'Права'),
	),

	/**
	 * The editable fields
	 */
	'edit_fields' => array(
		'name' 			=> array('title' => 'Имя пользователя',	'limit' => 255),
		'email'			=> array('title' => 'Почта', 'limit' => 255),
		'password'		=> array('title' => 'Пароль'),
		'roles' 		=> array('title' => 'Роли', 'type' => 'relationship'),
		'permissions' 	=> array('title' => 'Права', 'type'  => 'relationship')
	),

	/**
	 * The validation rules for the form, based on the Laravel validation class
	 */
	'rules' => array(
		'name' 		=> 'required|min:3|max:255',
		'email' 	=> 'required|email|max:255|unique:users',
		'password' 	=> 'required|min:6',
	),
);
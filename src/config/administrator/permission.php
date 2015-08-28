<?php

/**
 * Actors model config
 */

return array(

	'title' => 'Права',

	'single' => 'право',

	'model' => 'Notprometey\Mposuccess\Models\PermissionCustom',

	/**
	 * The display columns
	 */
	'columns' => array(
		'id' 			=> array('title' => 'ID'),
		'name' 			=> array('title' => 'Название'),
		'slug' 			=> array('title' => 'Значение(slug)'),
		'description' 	=> array('title' => 'Описание'),
		'model' 		=> array('title' => 'Модель'),
		'created_at'	=> array('title' => 'Создана'),
		'updated_at'	=> array('title' => 'Изменена')
	),

	/**
	 * The filter set
	 */
	'filters' => array(
		'id' 			=> array('title' => 'ID'),
		'name' 			=> array('title' => 'Название'),
		'slug' 			=> array('title' => 'Значение(slug)'),
		'description' 	=> array('title' => 'Описание'),
		'model' 		=> array('title' => 'Модель'),
	),

	/**
	 * The editable fields
	 */
	'edit_fields' => array(
		'name' 			=> array('title' => 'Название', 'limit' => 255),
		'slug' 			=> array('title' => 'Значение(slug)', 'limit' => 255),
		'description' 	=> array('title' => 'Описание', 'limit' => 255),
		'test'			=> array('title' => 'Модель', /*'name_field' => 'model',*/) //!!! not working - if model use
	),

	/**
	 * The validation rules for the form, based on the Laravel validation class
	 */
	'rules' => array(
		'name' 			=> 'required|min:3|max:255',
		'slug' 			=> 'required|min:3|max:255|unique:permissions',
		'description' 	=> 'min:3|max:255',
		'model' 		=> 'min:3|max:255',
	),
);
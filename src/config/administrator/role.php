<?php

/**
 * Actors model config
 */

return array(

	'title' => 'Роли',

	'single' => 'роль',

	'model' => 'Notprometey\Mposuccess\Models\RoleCustom',

	/**
	 * The display columns
	 */
	'columns' => array(
		'id' 			=> array('title' => 'ID'),
		'name' 			=> array('title' => 'Имя роли'),
		'slug' 			=> array('title' => 'Значение(slug)'),
		'description' 	=> array('title' => 'Описание'),
		'level' 		=> array('title' => 'Уровень'),
		'created_at'	=> array('title' => 'Создана'),
		'updated_at'	=> array('title' => 'Изменена'),
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
	),

	/**
	 * The filter set
	 */
	'filters' => array(
		'id' 			=> array('title' => 'ID'),
		'name' 			=> array('title' => 'Имя роли'),
		'slug' 			=> array('title' => 'Значение(slug)'),
		'description' 	=> array('title' => 'Описание'),
		'level' 		=> array('title' => 'Уровень', 'type' => 'key'),
		'permissions' 	=> array('title' => 'Права', 'type' => 'relationship')
	),

	/**
	 * The editable fields
	 */
	'edit_fields' => array(
		'name' 			=> array('title' => 'Имя роли', 'limit' => 255),
		'slug' 			=> array('title' => 'Значение(slug)', 'limit' => 255),
		'description' 	=> array('title' => 'Описание', 'limit' => 255),
		'level' 		=> array('title' => 'Уровень', 'type' => 'number'),
		'permissions' 	=> array('title' => 'Права', 'type'  => 'relationship')
	),

	/**
	 * The validation rules for the form, based on the Laravel validation class
	 */
	'rules' => array(
		'name' 			=> 'required|min:3|max:255',
		'slug' 			=> 'required|min:3|max:255|unique:roles',
		'description' 	=> 'min:3|max:255'
	),
);
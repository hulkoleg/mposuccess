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
		'id',
		'name',
		'email'
	),

	/**
	 * The filter set
	 */
	'filters' => array(
		'id',
		'name',
		'email'
	),

	/**
	 * The editable fields
	 */
	'edit_fields' => array(
		'id',
		'name',
		'email'
	),

);
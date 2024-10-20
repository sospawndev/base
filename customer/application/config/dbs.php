<?php
$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost',
	
	/*
	'username' => 'u1734743_sospawn',
	'password' => '@8m8R;)&*,@4', 
	'database' => 'u1734743_sospawn',
	*/
	'username' => 'root',
	'password' => '', 
	'database' => 'sospawn_base',
	'dbdriver' => 'mysqli',
	'dbprefix' => 'm_',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => true,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
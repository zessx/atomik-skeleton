<?php

define('ROOT', 	'http://'.$_SERVER['SERVER_NAME'].'/'.Atomik::get('base_dir'));
define('PAGE', 	isset($_GET['action']) ? $_GET['action'] : '');

if(!Atomik::has('session.user')) {
	if(PAGE != 'connexion')
		Atomik::redirect(ROOT.'connexion');
} else {
	define('USER_ID',		Atomik::get('session.user.id'));
	define('USER_NAME',		Atomik::get('session.user.name'));
	define('USER_ROLE', 	Atomik::get('session.user.role'));
	define('USER_ADMIN', 	Atomik::get('session.user.role') == 'administrateur');
}

/* Générer un nouvel utilisateur */
$login = 'user';
$psswd = 'user';
$salt  = md5($login);
$hash  = sha1($psswd.$salt);
//echo 'Salt : '.$salt.' / Hash : '.$hash;
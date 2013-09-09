<?php

define('ROOT', 	'http://'.$_SERVER['SERVER_NAME'].'/'.Atomik::get('base_dir'));
define('PAGE', 	isset($_GET['action']) ? $_GET['action'] : '');

session_start();

if(!isset($_SESSION['user.id'])) {
	if(PAGE != 'connexion')
		Atomik::redirect(ROOT.'connexion');
} else {
	define('USER_ID',		$_SESSION['user.id']);
	define('USER_NAME',		$_SESSION['user.name']);
	define('USER_ROLE', 	$_SESSION['user.role']);
	define('USER_ADMIN', 	$_SESSION['user.role'] == 'administrateur');
}

/* Générer un nouvel utilisateur */
$login = 'user';
$psswd = 'user';
$salt  = md5($login);
$hash  = sha1($psswd.$salt);
//echo 'Salt : '.$salt.' / Hash : '.$hash;
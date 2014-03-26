<?php

/* Pre-dispatch file, launched after Atomik::Dispatch::Before */

define('ROOT', 	'http://'.$_SERVER['SERVER_NAME'].'/'.Atomik::get('base_dir'));
define('PAGE', 	isset($_GET['action']) ? $_GET['action'] : '');
define('EOL', 	"\r\n");

include 'class/DateFormat.php';
include 'class/Tools.php';
include 'class/Form.php';
include 'class/Uploader.php';

if(!Atomik::has('session.user')) {
	if(PAGE != 'connexion')
		Atomik::redirect(Atomik::url('@login'));
} else {
	define('ROLE_ADMIN', 		in_array(Atomik::get('session.user.role'), array('superadministrateur', 'administrateur')));
	define('ROLE_SUPERADMIN', 	Atomik::get('session.user.role') == 'superadministrateur');
}

// Tools::generateUser('user', 'user');
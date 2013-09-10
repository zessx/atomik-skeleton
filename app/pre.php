<?php

/* Pre-dispatch file, launched after Atomik::Dispatch::Before */

define('ROOT', 	'http://'.$_SERVER['SERVER_NAME'].'/'.Atomik::get('base_dir'));
define('PAGE', 	isset($_GET['action']) ? $_GET['action'] : '');
define('EOL', 	"\r\n");

if(!Atomik::has('session.user')) {
	if(PAGE != 'connexion')
		Atomik::redirect(ROOT.'connexion');
} else {
	define('ROLE_ADMIN', 	Atomik::get('session.user.role') == 'administrateur');
}

// Tools::generateUser('user', 'user');
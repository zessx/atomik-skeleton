<?php

/* Pre-dispatch file, launched after Atomik::Dispatch::Before */

define('ROOT', 	'http://'.$_SERVER['SERVER_NAME'].'/'.Atomik::get('base_dir'));
define('PAGE', 	isset($_GET['action']) ? $_GET['action'] : '');
define('EOL', 	"\r\n");

Atomik::needed('DateFormat');
Atomik::needed('Form');
Atomik::needed('Tools');
Atomik::needed('Mailer');
Atomik::needed('Uploader');

if(!Atomik::has('session.user')) {
	if(PAGE != 'connexion')
		Atomik::redirect(Atomik::url('@login'));
} else {
	define('ROLE_ADMIN', 		in_array(Atomik::get('session.user.role'), array('superadministrateur', 'administrateur')));
	define('ROLE_SUPERADMIN', 	Atomik::get('session.user.role') == 'superadministrateur');
}

// Tools::generateUser('user', 'user');
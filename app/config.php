<?php

/* Local conf */
Atomik::set(array(

	'base_dir' => '_zessx/atomik-skeleton/',

	'plugins' => array(
		'DebugBar' => array(
			'include_vendors' => array('css', 'js')
		),
		'Errors' => array(
			'catch_errors' => true
		),
		'Session' => array(
			'autostart' => true
		),
		'Flash',
		'Db' => array(
			'dsn' => 'mysql:host=localhost;dbname=atomik_db',
			'username' => 'root',
			'password' => ''
		)
	),

	'atomik' => array(
		'url_rewriting' => true,
		'debug' => false,
		'files' => array(
			'bootstrap' => 'app/init.php',
			'pre_dispatch' => 'app/pre.php',
			'post_dispatch' => 'app/post.php'
		)
	),

	'dompdf' => array(
		'path' => 'vendor/dompdf/',
		'files' => array(
			'config' => 'dompdf_config.inc.php'
		)
	),

	'phpexcel' => array(
		'path' => 'vendor/phpexcel/',
		'files' => array(
			'config' => 'PHPExcel.php'
		)
	),

	'helpers' => array(
		'filters' => array(
			'required_message' => 'Vous devez remplir le champ %s.',
			'default_message' => 'Le champ %s n\'est pas valide.',
		)
	),

	'upload' => array(
		'dir' => 'upload/',
		'max_filesize' => 2 * 1024
	),

	'mails' => array(
		'dir' => 'app/mails/',
		'sender' => 'no-reply@zes.sx',
	),

	'app' => array(
		'layout' => '_layout',
		'language' => 'fr',
		'routes' => array(

			/* Général */
			'/' => array(
				'@name' => 'home',
				'action' => 'index',
			),
			'connexion' => array(
				'@name' => 'login',
				'action' => 'utilisateurs/connexion',
				),
			'deconnexion' => array(
				'@name' => 'logout',
				'action' => 'utilisateurs/deconnexion',
				),

			/* Erreurs */
			'404' => array(
				'@name' => '404',
				'action' => '404',
			),

			/* Utilisateurs */
			'utilisateurs' => array(
				'@name' => 'ut_all',
				'action' => 'utilisateurs/index',
			),
			'utilisateurs/ajouter' => array(
				'@name' => 'ut_add',
				'action' => 'utilisateurs/ajouter',
			),
			'utilisateurs/modifier/:id' => array(
				'@name' => 'ut_upd',
				'action' => 'utilisateurs/modifier',
			),
			'utilisateurs/supprimer/:id' => array(
				'@name' => 'ut_del',
				'action' => 'utilisateurs/supprimer',
			),
			'utilisateurs/mot-de-passe/:id' => array(
				'@name' => 'ut_regen_pwd',
				'action' => 'utilisateurs/regenerer-mdp',
			),
			'utilisateurs/mon-compte/mot-de-passe' => array(
				'@name' => 'ut_upd_pwd',
				'action' => 'utilisateurs/modifier-mdp',
			),
			'utilisateurs/mon-compte' => array(
				'@name' => 'ut_account',
				'action' => 'utilisateurs/mon-compte',
			),

			/* Client */
			'clients' => array(
				'@name' => 'cl_all',
				'action' => 'clients/index',
			),
			'clients/ajouter' => array(
				'@name' => 'cl_add',
				'action' => 'clients/ajouter',
			),
			'clients/modifier/:id' => array(
				'@name' => 'cl_upd',
				'action' => 'clients/modifier',
			),
			'clients/supprimer/:id' => array(
				'@name' => 'cl_del',
				'action' => 'clients/supprimer',
			),
			'clients/modifier/:id/supprimer_fichier/:file' => array(
				'@name' => 'cl_del_file',
				'action' => 'clients/supprimer_fichier',
			),

		)
	),

));


if(substr($_SERVER['SERVER_ADDR'], 0, 3) != "127") {

	/* Remote conf */
	Atomik::set(array(

		'base_dir' => '',

		'plugins' => array(
			'Db' => array(
				'dsn' => 'mysql:host=localhost;dbname=atomik_db',
				'username' => 'root',
				'password' => ''
			)
		),

		'atomik' => array(
			'debug' => false,
		),

	));

}


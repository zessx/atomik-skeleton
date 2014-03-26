<?php

/* Local conf */
Atomik::set(array(

	'base_dir' => 'atomik-skeleton/',

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

	'app' => array(
		'layout' => '_layout',
		'language' => 'fr',
		'routes' => array(

			'404' 											=> array('action' => '404'),

			'connexion' 									=> array('action' => 'utilisateurs/connexion'),
			'deconnexion' 									=> array('action' => 'utilisateurs/deconnexion'),

			'utilisateurs'											=> array('action' => 'utilisateurs/index'),
			'utilisateurs/ajouter'									=> array('action' => 'utilisateurs/ajouter'),
			'utilisateurs/modifier/:id' 							=> array('action' => 'utilisateurs/modifier'),
			'utilisateurs/supprimer/:id' 							=> array('action' => 'utilisateurs/supprimer'),
			'utilisateurs/mot-de-passe/:id' 						=> array('action' => 'utilisateurs/regenerer-mdp'),
			'utilisateurs/mon-compte' 								=> array('action' => 'utilisateurs/mon-compte'),
			'utilisateurs/mon-compte/mot-de-passe' 					=> array('action' => 'utilisateurs/modifier-mdp'),

			'clients'										=> array('action' => 'clients/index'),
			'clients/ajouter'								=> array('action' => 'clients/ajouter'),
			'clients/modifier/:id' 							=> array('action' => 'clients/modifier'),
			'clients/modifier/:id/supprimer_fichier/:file' 	=> array('action' => 'clients/supprimer_fichier'),
			'clients/supprimer/:id' 						=> array('action' => 'clients/supprimer'),

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


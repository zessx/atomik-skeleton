<?php

/* Local conf */
Atomik::set(array(

	'base_dir' => 'atomik-skeleton/',
	'autostart' => false,

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

	'app' => array(
		'layout' => '_layout',
		'language' => 'fr',
		'routes' => array(

			'404' 			=> array('action' => '404'),

			'connexion' 		=> array('action' => 'employes/connexion'),
			'deconnexion' 		=> array('action' => 'employes/deconnexion'),

			'clients'			=> array('action' => 'clients/index'),
			'clients/ajouter'		=> array('action' => 'clients/ajouter'),
			'clients/modifier/:id' 	=> array('action' => 'clients/modifier'),
			'clients/supprimer/:id' => array('action' => 'clients/supprimer'),

		)
	),

	'helpers' => array(
		'filters' => array(
			'required_message' => 'Vous devez remplir le champ %s.',
			'default_message' => 'Le champ %s n\'est pas valide.',
		)
	)	
	
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
	));

}


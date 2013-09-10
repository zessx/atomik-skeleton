<?php

Atomik::set(array(

	'base_dir' => 'test/atomik/',
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
			'bootstrap' => 'app/init.php'
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


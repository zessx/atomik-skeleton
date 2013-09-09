<?php

Atomik::disableLayout();

$title 		= 'Connexion';
$subtitle	= '';

$data = array(
	'identifiant' 	=> isset($_POST['identifiant']) ? $_POST['identifiant'] : '',
	'mot_de_passe'	=> ''
);
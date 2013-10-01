<?php

$fields = array(
	'id_utilisateur'	=> array(
		'type'			=> Form::TYPE_HIDDEN,
		'required'		=> true
	),
	'nom' => array(
		'label'			=> 'Nom',
		'required'		=> true,
		'weight'		=> Form::WEIGHT_HEAVY,
		'size'			=> Form::SIZE_HALF,
		'filter'		=> FILTER_SANITIZE_STRING,
	),
	'prenom' => array(
		'label'			=> 'Prénom',
		'required'		=> true,
		'weight'		=> Form::WEIGHT_HEAVY,
		'size'			=> Form::SIZE_HALF,
		'filter'		=> FILTER_SANITIZE_STRING,
	),
	'identifiant' => array(
		'label'			=> 'Identifiant',
		'size'			=> Form::SIZE_HALF,
		'filter'		=> FILTER_SANITIZE_STRING,
		'disabled'		=> true,
	),
	'mot_de_passe' => array(
		'label'			=> 'Mot de passe',
		'type'			=> Form::TYPE_PASSWORD,
		'required'		=> true,
		'size'			=> Form::SIZE_HALF,
		'filter'		=> FILTER_SANITIZE_STRING,
	),
	'role' => array(
		'label'			=> 'Rôle',
		'size'			=> Form::SIZE_HALF,
		'filter'		=> FILTER_SANITIZE_STRING,
		'disabled'		=> true,
	),
	'mot_de_passe_crypte' => array(
		'type'			=> Form::TYPE_HIDDEN,
	),
	'sel' => array(
		'type'			=> Form::TYPE_HIDDEN,
	),
);

$utilisateur = $this['db']->selectOne('utilisateurs', array('id_utilisateur' => Atomik::get('session.user.id')));
$utilisateur['mot_de_passe_crypte'] = $utilisateur['mot_de_passe'];
$utilisateur['mot_de_passe'] = '';

$title 		= 'Mon compte';
$subtitle	= $utilisateur['prenom'].' '.$utilisateur['nom'];
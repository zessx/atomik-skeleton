<?php

$fields = array(
    'raison_sociale' => array(
    	'label' 	=> 'Raison sociale',
        'required'	=> true,
        'weight'	=> Form::HEAVY_WEIGHT,
        'filter'    => FILTER_SANITIZE_STRING,
    ),
    'nom' => array(
    	'label' 	=> 'Nom',
        'size'		=> Form::HALF_SIZE,
        'filter'    => FILTER_SANITIZE_STRING,
    ),
    'prenom' => array(
    	'label' 	=> 'Prénom',
        'size'		=> Form::HALF_SIZE,
        'filter'    => FILTER_SANITIZE_STRING,
    ),
    'adresse' => array(
    	'label' 	=> 'Adresse',
        'filter'    => FILTER_SANITIZE_STRING,
    ),
    'code_postal' => array(
    	'label' 	=> 'Code postal',
        'size'		=> Form::HALF_SIZE,
        'filter'    => FILTER_SANITIZE_STRING,
    ),
    'ville' => array(
    	'label' 	=> 'Ville',
        'size'		=> Form::HALF_SIZE,
        'filter'    => FILTER_SANITIZE_STRING,
    ),
    'telephone' => array(
    	'label' 	=> 'Téléphone',
        'size'		=> Form::HALF_SIZE,
        'filter'    => FILTER_SANITIZE_STRING,
    ),
    'mobile' => array(
    	'label' 	=> 'Mobile',
        'size'		=> Form::HALF_SIZE,
        'filter'    => FILTER_SANITIZE_STRING,
    ),
    'fax' => array(
    	'label' 	=> 'Fax',
        'size'		=> Form::HALF_SIZE,
        'filter'    => FILTER_SANITIZE_STRING,
    ),
    'email' => array(
        'required' => true,
    	'label' 	=> 'Email',
        'size'		=> Form::HALF_SIZE,
        'filter'    => FILTER_VALIDATE_EMAIL,
    ),
);

$title 		= 'Ajouter un client';
$subtitle	= '';

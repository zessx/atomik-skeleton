<?php

$fields = array(
    'raison_sociale' => array(
    	'label' 	=> 'Raison sociale',
        'required'	=> true,
        'weight'	=> Form::WEIGHT_HEAVY,
        'filter'    => FILTER_SANITIZE_STRING,
    ),
    'nom' => array(
    	'label' 	=> 'Nom',
        'size'		=> Form::SIZE_HALF,
        'filter'    => FILTER_SANITIZE_STRING,
    ),
    'prenom' => array(
    	'label' 	=> 'Prénom',
        'size'		=> Form::SIZE_HALF,
        'filter'    => FILTER_SANITIZE_STRING,
    ),
    'adresse' => array(
    	'label' 	=> 'Adresse',
        'filter'    => FILTER_SANITIZE_STRING,
    ),
    'code_postal' => array(
    	'label' 	=> 'Code postal',
        'size'		=> Form::SIZE_HALF,
        'filter'    => FILTER_SANITIZE_STRING,
    ),
    'ville' => array(
    	'label' 	=> 'Ville',
        'size'		=> Form::SIZE_HALF,
        'filter'    => FILTER_SANITIZE_STRING,
    ),
    'telephone' => array(
    	'label' 	=> 'Téléphone',
        'size'		=> Form::SIZE_HALF,
        'filter'    => FILTER_SANITIZE_STRING,
    ),
    'mobile' => array(
    	'label' 	=> 'Mobile',
        'size'		=> Form::SIZE_HALF,
        'filter'    => FILTER_SANITIZE_STRING,
    ),
    'fax' => array(
    	'label' 	=> 'Fax',
        'size'		=> Form::SIZE_HALF,
        'filter'    => FILTER_SANITIZE_STRING,
    ),
    'email' => array(
        'required' => true,
    	'label' 	=> 'Email',
        'size'		=> Form::SIZE_HALF,
        'filter'    => FILTER_VALIDATE_EMAIL,
    ),
);

$title 		= 'Ajouter un client';
$subtitle	= '';

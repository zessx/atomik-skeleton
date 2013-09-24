<?php

$row = $this['db']->query('SHOW COLUMNS FROM utilisateurs LIKE "role"')->fetch(PDO::FETCH_ASSOC);
preg_match('/enum\(\'(.*)\'\)$/', $row['Type'], $matches);
$roles = explode('\',\'', $matches[1]);
$roles = array_reduce($roles, function ($result, $item) {
    $result[$item] = ucfirst($item);
    return $result;
}, array());

$fields = array(
    'nom' => array(
    	'label' 	=> 'Nom',
        'required'  => true,
        'weight'    => Form::WEIGHT_HEAVY,
        'size'		=> Form::SIZE_HALF,
        'filter'    => FILTER_SANITIZE_STRING,
    ),
    'prenom' => array(
    	'label' 	=> 'Prénom',
        'required'  => true,
        'weight'    => Form::WEIGHT_HEAVY,
        'size'		=> Form::SIZE_HALF,
        'filter'    => FILTER_SANITIZE_STRING,
    ),
    'identifiant' => array(
    	'label' 	=> 'Identifiant',
        'required'  => true,
        'size'		=> Form::SIZE_HALF,
        'filter'    => FILTER_SANITIZE_STRING,
    ),
    'mot_de_passe' => array(
    	'label' 	=> 'Mot de passe',
        'required'  => true,
        'size'		=> Form::SIZE_HALF,
        'filter'    => FILTER_SANITIZE_STRING,
    ),
    'role' => array(
        'label'     => 'Rôle',
        'required'  => true,
        'type'      => Form::TYPE_SELECT,
        'size'      => Form::SIZE_HALF,
        'filter'    => FILTER_SANITIZE_STRING,
        'options'   => $roles,
    ),
);

$title 		= 'Ajouter un client';
$subtitle	= '';

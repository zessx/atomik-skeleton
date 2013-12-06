<?php

$fields = array(
    'id_utilisateur' => array(
        'type'      => Form::TYPE_HIDDEN,
        'required'  => true
    ),
    'prenom' => array(
        'label'     => 'Prénom',
        'required'  => true,
        'weight'    => Form::WEIGHT_HEAVY,
        'size'      => Form::SIZE_HALF,
        'filter'    => FILTER_SANITIZE_STRING,
    ),
    'nom' => array(
        'label'     => 'Nom',
        'required'  => true,
        'weight'    => Form::WEIGHT_HEAVY,
        'size'      => Form::SIZE_HALF,
        'filter'    => FILTER_SANITIZE_STRING,
    ),
    'identifiant' => array(
        'label'     => 'Identifiant',
        'size'      => Form::SIZE_HALF,
        'filter'    => FILTER_SANITIZE_STRING,
        'disabled'  => true,
    ),
    'role' => array(
        'label'     => 'Rôle',
        'size'      => Form::SIZE_HALF,
        'filter'    => FILTER_SANITIZE_STRING,
        'disabled'  => true,
    ),
    'email' => array(
        'label'     => 'Email',
        'required'  => false,
        'size'      => Form::SIZE_HALF,
        'filter'    => FILTER_VALIDATE_EMAIL,
    ),
    'sel' => array(
        'type'      => Form::TYPE_HIDDEN,
    ),
);

$utilisateur = $this['db']->selectOne('utilisateurs', array('id_utilisateur' => Atomik::get('session.user.id')));

$title 		= 'Mon compte';
$subtitle	= $utilisateur['prenom'].' '.$utilisateur['nom'];
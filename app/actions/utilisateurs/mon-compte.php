<?php

$fields = array(
    'id_utilisateur' => array(
        'type'      => Form::HIDDEN_TYPE,
        'required'  => true
    ),
    'nom' => array(
        'label'     => 'Nom',
        'required'  => true,
        'weight'    => Form::HEAVY_WEIGHT,
        'size'      => Form::HALF_SIZE,
        'filter'    => FILTER_SANITIZE_STRING,
    ),
    'prenom' => array(
        'label'     => 'Prénom',
        'required'  => true,
        'weight'    => Form::HEAVY_WEIGHT,
        'size'      => Form::HALF_SIZE,
        'filter'    => FILTER_SANITIZE_STRING,
    ),
    'identifiant' => array(
        'label'     => 'Identifiant',
        'size'      => Form::HALF_SIZE,
        'filter'    => FILTER_SANITIZE_STRING,
        'disabled'  => true,
    ),
    'mot_de_passe' => array(
        'label'     => 'Mot de passe',
        'type'      => Form::PASSWORD_TYPE,
        'required'  => true,
        'size'      => Form::HALF_SIZE,
        'filter'    => FILTER_SANITIZE_STRING,
    ),
    'role' => array(
        'label'     => 'Rôle',
        'size'      => Form::HALF_SIZE,
        'filter'    => FILTER_SANITIZE_STRING,
        'disabled'  => true,
    ),
    'mot_de_passe_crypte' => array(
        'type'      => Form::HIDDEN_TYPE,
    ),
    'sel' => array(
        'type'      => Form::HIDDEN_TYPE,
    ),
);

$utilisateur = $this['db']->selectOne('utilisateurs', array('id_utilisateur' => Atomik::get('session.user.id')));
$utilisateur['mot_de_passe_crypte'] = $utilisateur['mot_de_passe'];
$utilisateur['mot_de_passe'] = '';

$title 		= 'Mon compte';
$subtitle	= $utilisateur['prenom'].' '.$utilisateur['nom'];
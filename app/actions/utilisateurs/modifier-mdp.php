<?php

$fields = array(
    'id_utilisateur' => array(
        'type'      => Form::TYPE_HIDDEN,
        'required'  => true
    ),
    'mot_de_passe' => array(
        'label'     => 'Mot de passe actuel',
        'type'      => Form::TYPE_PASSWORD,
        'required'  => true,
        'size'      => Form::SIZE_HALF,
        'filter'    => FILTER_SANITIZE_STRING,
        'help'      => 'Entrez votre mot de passe actuel'
    ),
    'mot_de_passe_crypte' => array(
        'type'      => Form::TYPE_HIDDEN,
    ),
    'mot_de_passe_nouveau' => array(
        'label'     => 'Nouveau mot de passe',
        'type'      => Form::TYPE_PASSWORD,
        'required'  => true,
        'size'      => Form::SIZE_HALF,
        'filter'    => FILTER_SANITIZE_STRING,
        'help'      => 'Entrez votre nouveau mot de passe'
    ),
    'mot_de_passe_confirmation' => array(
        'label'     => 'Confirmation',
        'type'      => Form::TYPE_PASSWORD,
        'required'  => true,
        'size'      => Form::SIZE_HALF,
        'filter'    => FILTER_SANITIZE_STRING,
        'help'      => 'Confirmez le nouveau mot de passe'
    ),
    'sel' => array(
        'type'      => Form::TYPE_HIDDEN,
    ),
);

$utilisateur = $this['db']->selectOne('utilisateurs', array('id_utilisateur' => Atomik::get('session.user.id')));
$utilisateur['mot_de_passe_crypte'] = $utilisateur['mot_de_passe'];
$utilisateur['mot_de_passe'] = '';

$title 		= 'Mon compte';
$subtitle	= $utilisateur['prenom'].' '.$utilisateur['nom'];
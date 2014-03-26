<?php

$roles = array(
    'utilisateur' => 'Utilisateur',
    'administrateur' => 'Administrateur'
);
if(ROLE_SUPERADMIN)
    $roles['superadministrateur'] = 'Super Administrateur';

$fields = array(
    'id_utilisateur' => array(
        'type'      => Form::TYPE_HIDDEN,
        'required'  => true
    ),
    'nom' => array(
        'label'     => 'Nom',
        'required'  => true,
        'weight'    => Form::WEIGHT_HEAVY,
        'size'      => Form::SIZE_HALF,
        'filter'    => FILTER_SANITIZE_STRING,
    ),
    'prenom' => array(
        'label'     => 'Prénom',
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
        'required'  => true,
        'type'      => Form::TYPE_SELECT,
        'size'      => Form::SIZE_HALF,
        'filter'    => FILTER_SANITIZE_STRING,
        'options'   => $roles,
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

if (!isset($this['request.id'])) {
    $this->flash('Le paramètre [id] est manquant.', 'danger');
    Atomik::redirect(Atomik::url('@ut_all'), false);
}

$utilisateur = $this['db']->selectOne('utilisateurs', array('id_utilisateur' => $this['request.id']));

$title 		= 'Informations sur l\'utilisateur';
$subtitle	= $utilisateur['prenom'].' '.$utilisateur['nom'];
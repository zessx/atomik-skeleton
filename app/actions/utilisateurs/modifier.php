<?php

$row = $this['db']->query('SHOW COLUMNS FROM utilisateurs LIKE "role"')->fetch(PDO::FETCH_ASSOC);
preg_match('/enum\(\'(.*)\'\)$/', $row['Type'], $matches);
$roles = explode('\',\'', $matches[1]);
$roles = array_reduce($roles, function ($result, $item) {
    $result[$item] = ucfirst($item);
    return $result;
}, array());

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
    'mot_de_passe' => array(
        'label'     => 'Mot de passe',
        'type'      => Form::TYPE_PASSWORD,
        'required'  => true,
        'size'      => Form::SIZE_HALF,
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
    'mot_de_passe_crypte' => array(
        'type'      => Form::TYPE_HIDDEN,
    ),
    'sel' => array(
        'type'      => Form::TYPE_HIDDEN,
    ),
);

if (!isset($this['request.id'])) {
    $this->flash('Le paramètre [id] est manquant.', 'danger');
    $this->redirect('utilisateurs', false);
}

$utilisateur = $this['db']->selectOne('utilisateurs', array('id_utilisateur' => $this['request.id']));
$utilisateur['mot_de_passe_crypte'] = $utilisateur['mot_de_passe'];
$utilisateur['mot_de_passe'] = '';

$title 		= 'Informations sur l\'utilisateur';
$subtitle	= $utilisateur['prenom'].' '.$utilisateur['nom'];
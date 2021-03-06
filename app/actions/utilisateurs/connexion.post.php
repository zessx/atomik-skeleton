<?php

$fields = array(
    'identifiant' => array(
    	'required' 	=> true,
        'filter' 	=> FILTER_SANITIZE_STRING,
    ),
    'mot_de_passe' => array(
    	'required' => true,
    ),
);

if (($data = $this->filter($_POST, $fields)) === false) {
    Atomik::flash($this['helpers.filters.messages'], 'danger');
    return;
}

$utilisateur = $this['db']->selectOne('utilisateurs', array(
	'identifiant' 	=> $data['identifiant'],
	'mot_de_passe'	=> sha1($data['mot_de_passe'].md5($data['identifiant']))
));

if(!$utilisateur) {
	Atomik::flash('Identifiant ou mot de passe incorrect', 'danger');
} else {

    Atomik::set('session.user.id',      $utilisateur['id_utilisateur']);
    Atomik::set('session.user.name',    $utilisateur['prenom'].' '.$utilisateur['nom']);
    Atomik::set('session.user.role',    $utilisateur['role']);

    Tools::log('utilisateurs', $utilisateur['id_utilisateur'], 'connexion');
	Atomik::flash('Bienvenue, '.Atomik::get('session.user.name'), 'success');
	Atomik::redirect(Atomik::url('@home'), false);

}
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
    $this->flash($this['helpers.filters.messages'], 'danger');
    return;
}

$employe = $this['db']->selectOne('employes', array(
	'identifiant' 	=> $data['identifiant'],
	'mot_de_passe'	=> sha1($data['mot_de_passe'].md5($data['identifiant']))
));

if(!$employe) {
	$this->flash('Identifiant ou mot de passe incorrect', 'danger');
} else {

	$_SESSION['user.id'] 	= $employe['id_employe'];
	$_SESSION['user.name'] 	= $employe['prenom'].' '.$employe['nom'];
	$_SESSION['user.role'] 	= $employe['role'];

	$this->flash('Bienvenue, '.Atomik::get('session.user.name'), 'success');
	$this->redirect(ROOT);

}
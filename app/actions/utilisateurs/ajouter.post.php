<?php

if (($data = $this->filter($_POST, $fields)) === false) {
	Atomik::flash($this['helpers.filters.messages'], 'danger');
	return;
}

if($this['db']->count('utilisateurs', array('identifiant' => $data['identifiant'])) > 0) {
	Atomik::flash('Cet identifiant est déjà attribué à un autre utilisateur.', 'danger');
	return;
}

$pass = $data['mot_de_passe'];
$salt = md5($data['identifiant']);
$hash = sha1($pass.$salt);

$data['sel'] = $salt;
$data['mot_de_passe'] = $hash;

if($this['db']->insert('utilisateurs', $data)) {
	$id = $this['db']->lastInsertId();
	Tools::log('utilisateurs', $id, 'insert');
	Mailer::send($data['email'], 'creation_compte', array(
		'nom' => $data['nom'],
		'prenom' => $data['prenom'],
		'url' => ROOT,
		'identifiant' => $data['identifiant'],
		'mot_de_passe' => $pass,
	));
	Atomik::flash('L\'utilisateur a bien été ajouté.&nbsp;&nbsp;<a href="'.Atomik::url('@ut_upd', array('id' => $id)).'" type="button" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span> Accès direct</a>', 'success');
} else {
	Atomik::flash('Une erreur est survenue lors de l\'ajout de l\'utilisateur.', 'danger');
}
Atomik::redirect(Atomik::url('@ut_all'), false);
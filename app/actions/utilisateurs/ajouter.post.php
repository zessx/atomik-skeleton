<?php

if (($data = $this->filter($_POST, $fields)) === false) {
    $this->flash($this['helpers.filters.messages'], 'danger');
    return;
}

if($this['db']->count('utilisateurs', array('identifiant' => $data['identifiant'])) > 0) {
	$this->flash('Cet identifiant est déjà attribué à un autre utilisateur.', 'danger');
    return;
}

$salt = md5($data['identifiant']);
$hash = sha1($data['mot_de_passe'].$salt);

$data['sel'] = $salt;
$data['mot_de_passe'] = $hash;

if($this['db']->insert('utilisateurs', $data)) {
    Tools::log('utilisateurs', $this['db']->lastInsertId(), 'insert');
    $this->flash('L\'utilisateur a bien été ajouté.', 'success');
} else {
    $this->flash('Une erreur est survenue lors de l\'ajout de l\'utilisateur.', 'danger');
}
$this->redirect(ROOT.'utilisateurs');
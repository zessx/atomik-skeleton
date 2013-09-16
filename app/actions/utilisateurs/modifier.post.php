<?php

if (($data = $this->filter($_POST, $fields)) === false) {
    $this->flash($this['helpers.filters.messages'], 'danger');
    return;
}

$hash = sha1($data['mot_de_passe'].$data['sel']);
if(($this['db']->selectValue('utilisateurs', 'identifiant', array('id_utilisateur' => $data['id_utilisateur'])) != $data['identifiant']) ||	($data['mot_de_passe_crypte'] != $hash)) {
	$data['mot_de_passe'] = $hash;
	unset($data['mot_de_passe_crypte']);
}

if($this['db']->update('utilisateurs', $data, array('id_utilisateur' => $data['id_utilisateur']))) {
    Tools::log('utilisateurs', $data['id_utilisateur'], 'update');
    $this->flash('L\'utilisateur a bien été modifié.', 'success');
} else {
    $this->flash('Une erreur est survenue lors de la modification de l\'utilisateur.', 'danger');
}
$this->redirect(ROOT.'utilisateurs');
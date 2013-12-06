<?php

if (($data = $this->filter($_POST, $fields)) === false) {
    $this->flash($this['helpers.filters.messages'], 'danger');
    return;
}

if($this['db']->update('utilisateurs', $data, array('id_utilisateur' => $data['id_utilisateur']))) {
	$id = $data['id_utilisateur'];
    Tools::log('utilisateurs', $id, 'update');
    $this->flash('L\'utilisateur a bien été modifié.&nbsp;&nbsp;<a href="'.ROOT.'utilisateurs/modifier/'.$id.'" type="button" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span> Accès direct</a>', 'success');
} else {
    $this->flash('Une erreur est survenue lors de la modification de l\'utilisateur.', 'danger');
}
$this->redirect(ROOT.'utilisateurs');
<?php

if (($data = $this->filter($_POST, $fields)) === false) {
    Atomik::flash($this['helpers.filters.messages'], 'danger');
    return;
}

if($this['db']->update('utilisateurs', $data, array('id_utilisateur' => $data['id_utilisateur']))) {
	$id = $data['id_utilisateur'];
    Tools::log('utilisateurs', $id, 'update');
    Atomik::flash('L\'utilisateur a bien été modifié.&nbsp;&nbsp;<a href="'.Atomik::url('@ut_upd', array('id' => $id)).'" type="button" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span> Accès direct</a>', 'success');
} else {
    Atomik::flash('Une erreur est survenue lors de la modification de l\'utilisateur.', 'danger');
}
Atomik::redirect(Atomik::url('@ut_all'), false);
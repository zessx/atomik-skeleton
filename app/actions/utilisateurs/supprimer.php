<?php

if (!isset($this['request.id'])) {

	$this->flash('Le paramètre [id] est manquant.', 'danger');
	
} else {

	if($this['db']->delete('utilisateurs', array('id_utilisateur' => $this['request.id']))) {
		Tools::log('utilisateurs', $this['request.id'], 'delete');
		$this->flash('L\'utilisateur a bien été supprimé.', 'success');
	} else {
		$this->flash('Une erreur est survenue lors de la suppression de l\'utilisateur.', 'danger');
	}

}
$this->redirect(ROOT.'utilisateurs', false);

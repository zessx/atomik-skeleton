<?php

if (!isset($this['request.id'])) {

    $this->flash('Le paramètre [id] est manquant.', 'danger');

} else {

	$utilisateur = $this['db']->selectOne('utilisateurs', array('id_utilisateur' => $this['request.id']));
	if(	!ROLE_ADMIN ||
		($utilisateur['role'] == 'administrateur' && !ROLE_SUPERADMIN) ||
		($utilisateur['role'] == 'superadministrateur')
	) {

	    $this->flash('Vous n\'avez pas les droits suffisants pour supprimer cet utilisateur.', 'danger');

	} else {

		if($this['db']->update('utilisateurs', array('archive' => 1), array('id_utilisateur' => $this['request.id']))) {
			Tools::log('utilisateurs', $this['request.id'], 'delete');
		    $this->flash('L\'utilisateur a bien été supprimé.', 'success');
		} else {
			$this->flash('Une erreur est survenue lors de la suppression de l\'utilisateur.', 'danger');
		}

	}
}
$this->redirect(Atomik::url('@ut_all'), false);

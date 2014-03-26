<?php

if (!isset($this['request.id'])) {

    Atomik::flash('Le paramètre [id] est manquant.', 'danger');

} else {

	$utilisateur = $this['db']->selectOne('utilisateurs', array('id_utilisateur' => $this['request.id']));
	if(	!ROLE_ADMIN ||
		($utilisateur['role'] == 'administrateur' && !ROLE_SUPERADMIN) ||
		($utilisateur['role'] == 'superadministrateur')
	) {

	    Atomik::flash('Vous n\'avez pas les droits suffisants pour supprimer cet utilisateur.', 'danger');

	} else {

		if($this['db']->update('utilisateurs', array('archive' => 1), array('id_utilisateur' => $this['request.id']))) {
			Tools::log('utilisateurs', $this['request.id'], 'delete');
		    Atomik::flash('L\'utilisateur a bien été supprimé.', 'success');
		} else {
			Atomik::flash('Une erreur est survenue lors de la suppression de l\'utilisateur.', 'danger');
		}

	}
}
Atomik::redirect(Atomik::url('@ut_all'), false);

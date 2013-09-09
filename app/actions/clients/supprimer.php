<?php

if (!isset($this['request.id'])) {

    $this->flash('Le paramètre [id] est manquant.', 'danger');
    
} else {

	if($this['db']->delete('clients', array('id_client' => $this['request.id']))) {
	    $this->flash('Le client a bien été supprimé.', 'success');
	} else {
		$this->flash('Une erreur est survenue lors de la suppression du client.', 'danger');
	}

}
$this->redirect(ROOT.'clients', false);

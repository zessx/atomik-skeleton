<?php

if (!isset($this['request.id'])) {

	$this->flash('Le paramètre [id] est manquant.', 'danger');
	
} else {

	$client = $this['db']->selectOne('clients', array('id_client' => $this['request.id']));
	if($client['logo'] && !Uploader::delete($client['logo']))
		$this->flash('Une erreur est survenue lors de la suppression du logo du client.', 'danger');

	if($this['db']->delete('clients', array('id_client' => $this['request.id']))) {
		Tools::log('clients', $this['request.id'], 'delete');
		$this->flash('Le client a bien été supprimé.', 'success');
	} else {
		$this->flash('Une erreur est survenue lors de la suppression du client.', 'danger');
	}

}
$this->redirect(ROOT.'clients', false);

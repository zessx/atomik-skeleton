<?php

if (!isset($this['request.id'])) {

	Atomik::flash('Le paramètre [id] est manquant.', 'danger');

} else {

	$client = $this['db']->selectOne('clients', array('id_client' => $this['request.id']));
	if($client['logo'] && !Uploader::delete($client['logo']))
		Atomik::flash('Une erreur est survenue lors de la suppression du logo du client.', 'danger');

	if($this['db']->delete('clients', array('id_client' => $this['request.id']))) {
		Tools::log('clients', $this['request.id'], 'delete');
		Atomik::flash('Le client a bien été supprimé.', 'success');
	} else {
		Atomik::flash('Une erreur est survenue lors de la suppression du client.', 'danger');
	}

}
Atomik::redirect(Atomik::url('@cl_all'), false);

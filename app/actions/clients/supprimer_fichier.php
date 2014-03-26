<?php

if (!isset($this['request.id'])) {
    $this->flash('Le paramètre [id] est manquant.', 'danger');
    $this->redirect(Atomik::url('@cl_all'), false);
}
if (!isset($this['request.file'])) {
    $this->flash('Le paramètre [file] est manquant.', 'danger');
    $this->redirect(Atomik::url('@cl_all'), false);
}

$client = $this['db']->selectOne('clients', array('id_client' => $this['request.id']));

if (!$client) {
    $this->flash('Ce client n\'existe pas.', 'danger');
    $this->redirect(Atomik::url('@cl_all'), false);
}

if(Uploader::delete($client[$this['request.file']])) {
	$this['db']->update('clients', array($this['request.file'] => ''), array('id_client' => $client['id_client']));
	$this->flash('Le fichier a bien été supprimé.', 'success');
} else {
	$this->flash('Une erreur est survenue lors de la suppression du fichier.', 'danger');
}

$this->redirect(Atomik::url('@cl_upd', array('id' => $this['request.id'])), false);
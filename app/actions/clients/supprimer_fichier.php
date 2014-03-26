<?php

if (!isset($this['request.id'])) {
    Atomik::flash('Le paramètre [id] est manquant.', 'danger');
    Atomik::redirect(Atomik::url('@cl_all'), false);
}
if (!isset($this['request.file'])) {
    Atomik::flash('Le paramètre [file] est manquant.', 'danger');
    Atomik::redirect(Atomik::url('@cl_all'), false);
}

$client = $this['db']->selectOne('clients', array('id_client' => $this['request.id']));

if (!$client) {
    Atomik::flash('Ce client n\'existe pas.', 'danger');
    Atomik::redirect(Atomik::url('@cl_all'), false);
}

if(Uploader::delete($client[$this['request.file']])) {
	$this['db']->update('clients', array($this['request.file'] => ''), array('id_client' => $client['id_client']));
	Atomik::flash('Le fichier a bien été supprimé.', 'success');
} else {
	Atomik::flash('Une erreur est survenue lors de la suppression du fichier.', 'danger');
}

Atomik::redirect(Atomik::url('@cl_upd', array('id' => $this['request.id'])), false);
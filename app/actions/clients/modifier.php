<?php

if (!isset($this['request.id'])) {
    $this->flash('Le paramètre [id] est manquant.', 'danger');
    $this->redirect('clients', false);
}

$client = $this['db']->selectOne('clients', array('id_client' => $this['request.id']));

$title 		= 'Informations sur le client';
$subtitle	= $client['raison_sociale'];
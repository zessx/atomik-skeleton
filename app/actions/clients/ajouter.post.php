<?php

if (($data = $this->filter($_POST, $fields)) === false) {
	$this->flash($this['helpers.filters.messages'], 'danger');
	return;
}

$error = false;
if(!isset($_POST['logo']) && $_FILES['logo'] && $_FILES['logo']['tmp_name']) {
	$message = Uploader::upload('logo', '', $fields['logo']['extensions']);
	if(isset($message['success'])) {
		$data['logo'] = $message['success'];
	} else {
		$error = true;
		$this->flash($message['error'], 'danger');
	}
}

if(!$error) {
	if($this['db']->insert('clients', $data)) {
		Tools::log('clients', $this['db']->lastInsertId(), 'insert');
		$this->flash('Le client a bien été ajouté.', 'success');
		$this->redirect(ROOT.'clients');
	} else {
		$this->flash('Une erreur est survenue lors de l\'ajout du client.', 'danger');
	}
}
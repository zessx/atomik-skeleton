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
	if($this['db']->update('clients', $data, array('id_client' => $data['id_client']))) {
		Tools::log('clients', $data['id_client'], 'update');
		$this->flash('Le client a bien été modifié.', 'success');
		Atomik::redirect(Atomik::url('@cl_all'), false);
	} else {
		$this->flash('Une erreur est survenue lors de la modification du client.', 'danger');
	}
}
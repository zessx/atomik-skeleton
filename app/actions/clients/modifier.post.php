<?php

if (($data = $this->filter($_POST, $fields)) === false) {
    $this->flash($this['helpers.filters.messages'], 'danger');
    return;
}

if($this['db']->update('clients', $data, array('id_client' => $data['id_client']))) {
    Tools::log('clients', $data['id_client'], 'update');
    $this->flash('Le client a bien été modifié.', 'success');
} else {
    $this->flash('Une erreur est survenue lors de la modification du client.', 'danger');
}
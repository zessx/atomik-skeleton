<?php

if (($data = $this->filter($_POST, $fields)) === false) {
    $this->flash($this['helpers.filters.messages'], 'danger');
    return;
}

if($this['db']->insert('clients', $data)) {
    Tools::log('clients', $this['db']->lastInsertId(), 'insert');
    $this->flash('Le client a bien été ajouté.', 'success');
} else {
    $this->flash('Une erreur est survenue lors de l\'ajout du client.', 'danger');
}
$this->redirect(ROOT.'clients');
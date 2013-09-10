<?php

$fields = array(
    'raison_sociale' => array(
        'required' => true,
        'filter'    => FILTER_SANITIZE_STRING,
    ),
    'nom' => array(
        'filter'    => FILTER_SANITIZE_STRING,
    ),
    'prenom' => array(
        'filter'    => FILTER_SANITIZE_STRING,
    ),
    'adresse' => array(
        'filter'    => FILTER_SANITIZE_STRING,
    ),
    'code_postal' => array(
        'filter'    => FILTER_SANITIZE_STRING,
    ),
    'ville' => array(
        'filter'    => FILTER_SANITIZE_STRING,
    ),
    'telephone' => array(
        'filter'    => FILTER_SANITIZE_STRING,
    ),
    'mobile' => array(
        'filter'    => FILTER_SANITIZE_STRING,
    ),
    'fax' => array(
        'filter'    => FILTER_SANITIZE_STRING,
    ),
    'email' => array(
        'required' => true,
        'filter'    => FILTER_VALIDATE_EMAIL,
    ),
);


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
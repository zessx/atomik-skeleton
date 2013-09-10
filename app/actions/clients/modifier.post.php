<?php

$fields = array(
    'id_client' => array(
        'required'  => true
    ),
    'raison_sociale' => array(
        'required' => true,
        'filter'    => FILTER_SANITIZE_STRING,
    ),
    'nom' => array(
        'filter' 	=> FILTER_SANITIZE_STRING,
    ),
    'prenom' => array(
        'filter' 	=> FILTER_SANITIZE_STRING,
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

if($this['db']->update('clients', $data, array('id_client' => $data['id_client']))) {
    Tools::log('clients', $data['id_client'], 'update');
    $this->flash('Le client a bien été modifié.', 'success');
} else {
    $this->flash('Une erreur est survenue lors de la modification du client.', 'danger');
}
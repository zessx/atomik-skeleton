<?php

$fields = array(
    'nom' => array(
    	'required' 	=> true,
        'filter' 	=> FILTER_SANITIZE_STRING,
    ),
    'prenom' => array(
    	'required' => true,
        'filter' 	=> FILTER_SANITIZE_STRING,
    ),
);

if (($data = $this->filter($_POST, $fields)) === false) {
    $this->flash($this['helpers.filters.messages'], 'danger');
    return;
}

$this['db']->insert('clients', $data);

$this->flash('Le client a bien été ajouté.', 'success');
$this->redirect(ROOT.'clients');
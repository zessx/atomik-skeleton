<?php

if (($data = $this->filter($_POST, $fields)) === false) {
    $this->flash($this['helpers.filters.messages'], 'danger');
    return;
}

if($this['db']->update('utilisateurs', $data, array('id_utilisateur' => $data['id_utilisateur']))) {
    Tools::log('utilisateurs', $data['id_utilisateur'], 'update');
    $this->flash('Vos informations ont bien été modifiées.', 'success');
} else {
    $this->flash('Une erreur est survenue lors de la modification de vos informations.', 'danger');
}
$this->redirect(ROOT.'utilisateurs/mon-compte');
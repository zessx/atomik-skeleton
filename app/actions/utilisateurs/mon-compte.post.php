<?php

if (($data = $this->filter($_POST, $fields)) === false) {
    Atomik::flash($this['helpers.filters.messages'], 'danger');
    return;
}

if($this['db']->update('utilisateurs', $data, array('id_utilisateur' => $data['id_utilisateur']))) {
    Tools::log('utilisateurs', $data['id_utilisateur'], 'update');
    Atomik::flash('Vos informations ont bien été modifiées.', 'success');
} else {
    Atomik::flash('Une erreur est survenue lors de la modification de vos informations.', 'danger');
}
Atomik::redirect(Atomik::url('@ut_account'), false);
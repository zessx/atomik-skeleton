<?php

if (($data = $this->filter($_POST, $fields)) === false) {
    Atomik::flash($this['helpers.filters.messages'], 'danger');
    return;
}

if($data['mot_de_passe_nouveau'] != $data['mot_de_passe_confirmation']) {
	Atomik::flash('Les deux mots de passes saisis ne sont pas identiques.', 'danger');
    return;
}

$hash = sha1($data['mot_de_passe'].$data['sel']);
if($hash != $data['mot_de_passe_crypte']) {
	Atomik::flash('Le mot de passe actuel n\'est pas valide.', 'danger');
    return;
}

$hash = sha1($data['mot_de_passe_nouveau'].$data['sel']);
$data['mot_de_passe'] = $hash;
unset($data['mot_de_passe_crypte']);
unset($data['mot_de_passe_nouveau']);
unset($data['mot_de_passe_confirmation']);

if($this['db']->update('utilisateurs', $data, array('id_utilisateur' => $data['id_utilisateur']))) {
    Tools::log('utilisateurs', $data['id_utilisateur'], 'update');
    Atomik::flash('Vos informations ont bien été modifiées.', 'success');
} else {
    Atomik::flash('Une erreur est survenue lors de la modification de vos informations.', 'danger');
}
Atomik::redirect(Atomik::url('@ut_account'), false);
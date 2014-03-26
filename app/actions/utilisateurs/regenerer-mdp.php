<?php

if (!isset($this['request.id'])) {
    Atomik::flash('Le paramètre [id] est manquant.', 'danger');
    Atomik::redirect(Atomik::url('@ut_all'), false);
}

$utilisateur = $this['db']->selectOne('utilisateurs', array('id_utilisateur' => $this['request.id']));

$pass_length = 8;

$pass = substr(str_shuffle(strtolower(sha1(rand().time()))), 0, $pass_length);
$hash = sha1($pass.$utilisateur['sel']);

$utilisateur['mot_de_passe'] = $hash;

if($this['db']->update('utilisateurs', $utilisateur, array('id_utilisateur' => $utilisateur['id_utilisateur']))) {
    Tools::log('utilisateurs', $data['id_utilisateur'], 'update');
    Atomik::flash('Un nouveau mot de passe à bien été généré : <span class="label label-success">'.$pass.'</span><br>N\'oubliez pas de le copier en lieu sûr !', 'warning');
} else {
    Atomik::flash('Une erreur est survenue lors de la génération du nouveau mot de passe.', 'danger');
}
Atomik::redirect(Atomik::url('@ut_upd', array('id' => $utilisateur['id_utilisateur'])), false);
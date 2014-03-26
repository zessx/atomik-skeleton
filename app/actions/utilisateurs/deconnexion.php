<?php

$title 		= 'Déconnexion';
$subtitle	= '';

Tools::log('utilisateurs', Atomik::get('session.user.id'), 'deconnexion');

Atomik::delete('session.user');

$this->flash('Vous avez bien été déconnecté', 'success');

$this->redirect(Atomik::url('@login'));
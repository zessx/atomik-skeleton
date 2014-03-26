<?php

$title 		= 'Déconnexion';
$subtitle	= '';

Tools::log('utilisateurs', Atomik::get('session.user.id'), 'deconnexion');

Atomik::delete('session.user');

$this->flash('Vous avez bien été déconnecté', 'success');

Atomik::redirect(Atomik::url('@login'), false);
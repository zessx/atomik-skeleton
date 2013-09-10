<?php

$title 		= 'Déconnexion';
$subtitle	= '';

Atomik::delete('session.user');

$this->redirect(ROOT.'connexion');
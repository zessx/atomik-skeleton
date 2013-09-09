<?php

$title 		= 'Déconnexion';
$subtitle	= '';

$_SESSION['user.id'] 	= null;
$_SESSION['user.name'] 	= null;
$_SESSION['user.role'] 	= null;

$this->redirect(ROOT.'connexion');
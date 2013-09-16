<?php

$utilisateurs = $this['db']->select('utilisateurs', array('archive'=>0));

$title 		= 'Liste des utilisateurs';
$subtitle	= '';
<?php

class Tools 
{

	/* Ajoute un log en BDD */
	public static function log($object, $id, $action, $comment = '') {
		Atomik::get('db')->insert('logs', array(
			'date' 			=> date('Y-m-d H:i:s'),
			'employe'	 	=> Atomik::get('session.user.id'),
			'objet'		 	=> $object,
			'id_objet'		=> $id,
			'action' 		=> $action,
			'commentaire' 	=> $comment
		));
	}

	/* Génère un nouvel utilisateur */
	public static function generateUser($login, $psswd) {
		$salt  = md5($login);
		$hash  = sha1($psswd.$salt);
		Atomik::flash('User : '.$login.'<br>Pass : '.$psswd.'<br>Salt : '.$salt.'<br>Hash : '.$hash, 'success');
	}

}
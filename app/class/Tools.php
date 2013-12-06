<?php

class Tools 
{

	/* Ajoute un log en BDD */
	public static function log($object, $id, $action, $comment = '') {
		Atomik::get('db')->insert('logs', array(
			'date' 				=> date('Y-m-d H:i:s'),
			'ip'				=> $_SERVER['REMOTE_ADDR'],
			'utilisateur'		=> Atomik::get('session.user.name'),
			'id_utilisateur' 	=> Atomik::get('session.user.id'),
			'objet'		 		=> $object,
			'id_objet'			=> $id,
			'action' 			=> $action,
			'commentaire' 		=> $comment
		));
	}

	/* Génère un nouvel utilisateur */
	public static function generateUser($login, $psswd) {
		$salt  = md5($login);
		$hash  = sha1($psswd.$salt);
		Atomik::flash('User : '.$login.'<br>Pass : '.$psswd.'<br>Salt : '.$salt.'<br>Hash : '.$hash, 'success');
	}

	/* Retourne la classe correspondant à l'avancement */
	public static function getProgressClass($percent) {
		if($percent < 75) return 'success';
		if($percent < 90) return 'warning';
		return 'danger';
	}

	/* Retourne la classe correspondant à la proximité de l'échéance */
	public static function getTermClass($date) {
		$start = date_create('now');
		$end = date_create($date);
		$interval = date_diff($start, $end);
		$lastdays = $interval->format('%a');
		if($lastdays > 30) return 'success';
		if($lastdays > 10) return 'warning';
		return 'danger';
	}

	/* Recherche une variable dans les données POST et GET */
	public static function requestParam($name, $type = 'both') {
		if($type == 'post' || $type == 'both')
			if(isset($_POST[$name]))
				return $_POST[$name];
		if($type == 'get' || $type == 'both')
			if(isset($_GET[$name]))
				return $_GET[$name];
		return null;
	}
	
}
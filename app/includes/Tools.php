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

	/* Recherche une variable dans les données POST, GET, FILE */
	public static function requestParam($name, $type = 'post|get') {
		if(strpos($type, 'post') !== false || $type == 'all')
			if(isset($_POST[$name]))
				return $_POST[$name];
		if(strpos($type, 'get') !== false || $type == 'all')
			if(isset($_GET[$name]))
				return $_GET[$name];
		if(strpos($type, 'file') !== false || $type == 'all')
			if(isset($_FILE[$name]))
				return $_FILE[$name];
		return null;
	}

	/* Générer un slug */
	public static function slugify($input, $slugs = array()) {
		$output = preg_replace('/[^\pL\d]+/u', '-', $input);
		$output = trim($output, '-');
		$output = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $output);
		$output = strtolower($output);
		$output = preg_replace('/[^\w-]+/', '', $output);
		$output = empty($output) ? 'n-a' : $output;
		if(!empty($slugs) && array_search($output, $slugs) !== false) {
			$n = 1;
			foreach ($slugs as $slug) {
				$matches = array();
				if(preg_match('/^'.$output.'(?<suffix>-\d+)?$/', $slug, $matches)) {
					$n = intval(substr($matches['suffix'], 1)) + 1;
				}
			}
			$output .= '-'.$n;
		}
		return $output;
	}

}
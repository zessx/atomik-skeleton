<?php

class Mailer
{

	/*
	* Populate a template, and send the related mail
	* Template syntax :
	*  - [[ title ]]    (will be tranfered from mail's body to title, can contain variables)
	*  - {{ variable }}
	*/
	public static function send($email, $template, $datas) {

		// Retrieve and populate template
		$template = file_get_contents(Atomik::get('mails.dir').$template.'.phtml');
		foreach($datas as $key => $value) {
		    $template = preg_replace('/{{\s*'.$key.'\s*}}/i', $value, $template);
		}

		// Prepare mail common headers
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-Type: text/html; charset="UTF-8"'."\r\n";
		$headers .= 'Content-Transfer-Encoding: 8bit'."\r\n";
		$headers .= 'From: ' . Atomik::get('mails.sender') . "\r\n";

		// Set title
		preg_match('/\<title\>\s*(?<title>.*?)\s*\<\/title\>/i', $template, $matches);
		$title = $matches['title'];

		// Set message
		$message = $template;

		// Send mail
		@mail($email, $title, $message, $headers);

	}

}
<?php

class Uploader 
{

	/* Upload a file */
	public static function upload($id, $filename = '', $extensions = array('pdf')) {

		$_file       = $_FILES[$id]["tmp_name"];
		$_filename   = self::clean($filename != '' ? $filename : time().'_'.$_FILES[$id]["name"]);
		$_filesize   = $_FILES[$id]["size"];
		$_filetype   = $_FILES[$id]["type"];

		$mimetypes = self::getMimeTypes($extensions);

		if(!empty($_file))
		{
			if(!in_array($_filetype, $mimetypes)) {
				return array('error' => 'Ce type de fichier n\'est pas autorisé.');
			}
			
			if($_filesize / 1024 > Atomik::get('upload.max_filesize')){
				return array('error' => 'Le poids du fichier est supérieur à '.(Atomik::get('upload.max_filesize') / 1024).'M.');
			}

			if(file_exists(Atomik::get('upload.dir')))
			{
				if (is_uploaded_file($_file))
				{
					$fullpath = Atomik::get('upload.dir').$_filename;

					if (file_exists($fullpath))
						@unlink($fullpath);

					try {
						copy($_file, $fullpath);
					} catch (Exception $e) {
						return array('error' => 'Une erreur est survenue lors de l\'envoi du fichier.');
					}
				}
			}
			else
			{
				return array('error' => 'Le dossier d\'upload n\'existe pas.');
			}

			return array('success' => $_filename);
		}     

		return array('error' => 'Aucun fichier n\'a été détecté pour l\'envoi.');

	}

	/* Delete a file */
	public static function delete($filename) {
		
		$fullpath = Atomik::get('upload.dir').$filename;

		if(file_exists($fullpath))
		{
			return unlink($fullpath);
		}

		return false;
	}

	/* Clean filename */
	private static function clean($string) {
		$string = utf8_decode($string);
		$string = strtr(
		strtr(
			$string,
			utf8_decode(
				'ŠŽšžŸÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÑÒÓÔÕÖØÙÚÛÜÝàáâãäåçèéêëìíîïñòóôõöøùúûüýÿ?$,&:()!{}."§_#=/\\;°'),
				'SZszYAAAAAACEEEEIIIINOOOOOOUUUUYaaaaaaceeeeiiiinoooooouuuuyy'
			),
			array(
				'Þ' => 'TH', 
				'þ' => 'th', 
				'Ð' => 'DH', 
				'ð' => 'dh', 
				'@'=>'-at-',
				'ß' => 'ss', 
				'Œ' => 'OE', 
				'œ' => 'oe', 
				'Æ' => 'AE',
				'æ' => 'ae', 
				'µ' => 'u', 
				'+' => '-', 
				' '=>'-'
			)
		);

		if(empty($string))
			return '-';
		return strtolower($string);
	}

	/* Get MimeTypes from extension */
	public static function getMimeTypes($extensions) {

		$mt = array(
			'hqx'   =>  array('application/mac-binhex40', 'application/mac-binhex', 'application/x-binhex40', 'application/x-mac-binhex40'),
			'cpt'   =>  'application/mac-compactpro',
			'csv'   =>  array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain'),
			'bin'   =>  array('application/macbinary', 'application/mac-binary', 'application/octet-stream', 'application/x-binary', 'application/x-macbinary'),
			'dms'   =>  'application/octet-stream',
			'lha'   =>  'application/octet-stream',
			'lzh'   =>  'application/octet-stream',
			'exe'   =>  array('application/octet-stream', 'application/x-msdownload'),
			'class' =>  'application/octet-stream',
			'psd'   =>  array('application/x-photoshop', 'image/vnd.adobe.photoshop'),
			'so'    =>  'application/octet-stream',
			'sea'   =>  'application/octet-stream',
			'dll'   =>  'application/octet-stream',
			'oda'   =>  'application/oda',
			'pdf'   =>  array('application/pdf', 'application/x-download', 'binary/octet-stream'),
			'ai'    =>  array('application/pdf', 'application/postscript'),
			'eps'   =>  'application/postscript',
			'ps'    =>  'application/postscript',
			'smi'   =>  'application/smil',
			'smil'  =>  'application/smil',
			'mif'   =>  'application/vnd.mif',
			'xls'   =>  array('application/vnd.ms-excel', 'application/msexcel', 'application/x-msexcel', 'application/x-ms-excel', 'application/x-excel', 'application/x-dos_ms_excel', 'application/xls', 'application/x-xls', 'application/excel', 'application/download', 'application/vnd.ms-office', 'application/msword'),
			'ppt'   =>  array('application/powerpoint', 'application/vnd.ms-powerpoint'),
			'pptx'  =>  array('application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/x-zip', 'application/zip'),
			'wbxml' =>  'application/wbxml',
			'wmlc'  =>  'application/wmlc',
			'dcr'   =>  'application/x-director',
			'dir'   =>  'application/x-director',
			'dxr'   =>  'application/x-director',
			'dvi'   =>  'application/x-dvi',
			'gtar'  =>  'application/x-gtar',
			'gz'    =>  'application/x-gzip',
			'gzip'  =>  'application/x-gzip',
			'php'   =>  array('application/x-httpd-php', 'application/php', 'application/x-php', 'text/php', 'text/x-php', 'application/x-httpd-php-source'),
			'php4'  =>  'application/x-httpd-php',
			'php3'  =>  'application/x-httpd-php',
			'phtml' =>  'application/x-httpd-php',
			'phps'  =>  'application/x-httpd-php-source',
			'js'    =>  array('application/x-javascript', 'text/plain'),
			'swf'   =>  'application/x-shockwave-flash',
			'sit'   =>  'application/x-stuffit',
			'tar'   =>  'application/x-tar',
			'tgz'   =>  array('application/x-tar', 'application/x-gzip-compressed'),
			'xhtml' =>  'application/xhtml+xml',
			'xht'   =>  'application/xhtml+xml',
			'zip'   =>  array('application/x-zip', 'application/zip', 'application/x-zip-compressed', 'application/s-compressed', 'multipart/x-zip'),
			'rar'   =>  array('application/x-rar', 'application/rar', 'application/x-rar-compressed'),
			'mid'   =>  'audio/midi',
			'midi'  =>  'audio/midi',
			'mpga'  =>  'audio/mpeg',
			'mp2'   =>  'audio/mpeg',
			'mp3'   =>  array('audio/mpeg', 'audio/mpg', 'audio/mpeg3', 'audio/mp3'),
			'aif'   =>  array('audio/x-aiff', 'audio/aiff'),
			'aiff'  =>  array('audio/x-aiff', 'audio/aiff'),
			'aifc'  =>  'audio/x-aiff',
			'ram'   =>  'audio/x-pn-realaudio',
			'rm'    =>  'audio/x-pn-realaudio',
			'rpm'   =>  'audio/x-pn-realaudio-plugin',
			'ra'    =>  'audio/x-realaudio',
			'rv'    =>  'video/vnd.rn-realvideo',
			'wav'   =>  array('audio/x-wav', 'audio/wave', 'audio/wav'),
			'bmp'   =>  array('image/bmp', 'image/x-windows-bmp'),
			'gif'   =>  'image/gif',
			'jpeg'  =>  array('image/jpeg', 'image/pjpeg'),
			'jpg'   =>  array('image/jpeg', 'image/pjpeg'),
			'jpe'   =>  array('image/jpeg', 'image/pjpeg'),
			'png'   =>  array('image/png',  'image/x-png'),
			'tiff'  =>  'image/tiff',
			'tif'   =>  'image/tiff',
			'css'   =>  array('text/css', 'text/plain'),
			'html'  =>  array('text/html', 'text/plain'),
			'htm'   =>  array('text/html', 'text/plain'),
			'shtml' =>  array('text/html', 'text/plain'),
			'txt'   =>  'text/plain',
			'text'  =>  'text/plain',
			'log'   =>  array('text/plain', 'text/x-log'),
			'rtx'   =>  'text/richtext',
			'rtf'   =>  'text/rtf',
			'xml'   =>  array('application/xml', 'text/xml', 'text/plain'),
			'xsl'   =>  array('application/xml', 'text/xsl', 'text/xml'),
			'mpeg'  =>  'video/mpeg',
			'mpg'   =>  'video/mpeg',
			'mpe'   =>  'video/mpeg',
			'qt'    =>  'video/quicktime',
			'mov'   =>  'video/quicktime',
			'avi'   =>  array('video/x-msvideo', 'video/msvideo', 'video/avi', 'application/x-troff-msvideo'),
			'movie' =>  'video/x-sgi-movie',
			'doc'   =>  array('application/msword', 'application/vnd.ms-office'),
			'docx'  =>  array('application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/zip', 'application/msword', 'application/x-zip'),
			'dot'   =>  array('application/msword', 'application/vnd.ms-office'),
			'dotx'  =>  array('application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/zip', 'application/msword'),
			'xlsx'  =>  array('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/zip', 'application/vnd.ms-excel', 'application/msword', 'application/x-zip'),
			'word'  =>  array('application/msword', 'application/octet-stream'),
			'xl'    =>  'application/excel',
			'eml'   =>  'message/rfc822',
			'json'  =>  array('application/json', 'text/json'),
			'pem'   =>  array('application/x-x509-user-cert', 'application/x-pem-file', 'application/octet-stream'),
			'p10'   =>  array('application/x-pkcs10', 'application/pkcs10'),
			'p12'   =>  'application/x-pkcs12',
			'p7a'   =>  'application/x-pkcs7-signature',
			'p7c'   =>  array('application/pkcs7-mime', 'application/x-pkcs7-mime'),
			'p7m'   =>  array('application/pkcs7-mime', 'application/x-pkcs7-mime'),
			'p7r'   =>  'application/x-pkcs7-certreqresp',
			'p7s'   =>  'application/pkcs7-signature',
			'crt'   =>  array('application/x-x509-ca-cert', 'application/x-x509-user-cert', 'application/pkix-cert'),
			'crl'   =>  array('application/pkix-crl', 'application/pkcs-crl'),
			'der'   =>  'application/x-x509-ca-cert',
			'kdb'   =>  'application/octet-stream',
			'pgp'   =>  'application/pgp',
			'gpg'   =>  'application/gpg-keys',
			'sst'   =>  'application/octet-stream',
			'csr'   =>  'application/octet-stream',
			'rsa'   =>  'application/x-pkcs7',
			'cer'   =>  array('application/pkix-cert', 'application/x-x509-ca-cert'),
			'3g2'   =>  'video/3gpp2',
			'3gp'   =>  'video/3gp',
			'mp4'   =>  'video/mp4',
			'm4a'   =>  'audio/x-m4a',
			'f4v'   =>  'video/mp4',
			'webm'  =>  'video/webm',
			'aac'   =>  'audio/x-acc',
			'm4u'   =>  'application/vnd.mpegurl',
			'm3u'   =>  'text/plain',
			'xspf'  =>  'application/xspf+xml',
			'vlc'   =>  'application/videolan',
			'wmv'   =>  array('video/x-ms-wmv', 'video/x-ms-asf'),
			'au'    =>  'audio/x-au',
			'ac3'   =>  'audio/ac3',
			'flac'  =>  'audio/x-flac',
			'ogg'   =>  'audio/ogg',
			'kmz'   =>  array('application/vnd.google-earth.kmz', 'application/zip', 'application/x-zip'),
			'kml'   =>  array('application/vnd.google-earth.kml+xml', 'application/xml', 'text/xml'),
			'ics'   =>  'text/calendar',
			'zsh'   =>  'text/x-scriptzsh',
			'7zip'  =>  array('application/x-compressed', 'application/x-zip-compressed', 'application/zip', 'multipart/x-zip'),
			'cdr'   =>  array('application/cdr', 'application/coreldraw', 'application/x-cdr', 'application/x-coreldraw', 'image/cdr', 'image/x-cdr', 'zz-application/zz-winassoc-cdr'),
			'wma'   =>  array('audio/x-ms-wma', 'video/x-ms-asf'),
			'jar'   =>  array('application/java-archive', 'application/x-java-application', 'application/x-jar', 'application/x-compressed')
		);
		if(!is_array($extensions))
			$extensions = array($extensions);
		$_mt = array();
		foreach ($extensions as $extension) {
			if(array_key_exists($extension, $mt)) {
				foreach ($mt[$extension] as $m) {
					array_push($_mt, $m);
				}
			}
		}
		return $_mt;

	}

}
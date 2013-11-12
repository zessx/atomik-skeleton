<?php

class Form 
{

	const TYPE_TEXT			= 'text';
	const TYPE_PASSWORD		= 'password';
	const TYPE_HIDDEN		= 'hidden';
	const TYPE_TEXTAREA		= 'textarea';
	const TYPE_CHECKBOX		= 'checkbox';
	const TYPE_RADIO		= 'radio';
	const TYPE_SELECT		= 'select';
	const TYPE_FILE			= 'file';
	const TYPE_DATE			= 'date';
	const TYPE_HOUR			= 'hour';

	const REGEX_DATE		= '/^(?:0[1-9]|[12]\d|3[01])\/(?:0[1-9]|1[012])\/(?:19|20|21)\d{2}$/';
	const REGEX_HOUR		= '/^(?:[01]\d|[2][0123]):[012345]\d$/';

	const WEIGHT_LIGHT 		= '-sm';
	const WEIGHT_MEDIUM 	= '-md';
	const WEIGHT_HEAVY 		= '-lg';

	const SIZE_FULL 		= '-12';
	const SIZE_HALF 		= '-6';
	const SIZE_THIRD 		= '-4';
	const SIZE_QUARTER 		= '-3';

	/* Génère les champs formulaire à partir d'un tableau d'options */	
	public static function generateFields($form, $fields, $object = null) {

		$group = 0;

		foreach ($fields as $_key => $field) {

			$value = null;
			if($object != null && isset($object[$_key]))
				$value = $object[$_key];
			
			$_type 			= isset($field['type']) 		? $field['type'] : self::TYPE_TEXT;
			$_size 			= isset($field['size']) 		? $field['size'] : self::SIZE_FULL;
			$_weight 		= isset($field['weight']) 		? $field['weight'] : self::WEIGHT_LIGHT;
			$_label 		= isset($field['label']) 		? $field['label'] : $_key;
			$_required 		= isset($field['required']) 	? $field['required'] : false;
			$_disabled 		= isset($field['disabled']) 	? $field['disabled'] : false;
			$_options 		= isset($field['options']) 		? $field['options'] : array();
			$_checked		= isset($field['checked']) 		? $field['checked'] : (bool)$value;
			$_extensions	= isset($field['extensions']) 	? $field['extensions'] : array('pdf');
			$_thumbnail		= isset($field['thumbnail']) 	? $field['thumbnail'] : false;
			$_help 			= isset($field['help']) 		? '<p class="help-block">'.$field['help'].'</p>'.EOL : '';
			$_id			= isset($field['id']) 			? ' id="'.$field['id'].'" ' : '';
			$_classes		= isset($field['classes']) 		? ' '.$field['classes'].' ' : '';
			$_link 			= false;

			if(isset($field['link'])) {
				$params = array();
				preg_match('/(?<=:)[\w-]+/', $field['link'], $params);
				$_link = $field['link'];
				foreach ($params as $param) {
					$_link = str_replace(':'.$param, $object[$param], $_link);
				}
			}

			$class_label 	= 'col-lg-2 control-label label'.$_weight;
			$class_wrap 	= 'field-wrap col-lg-10';
			$title_input 	= $_required ? 'Ce champ est obligatoire' : '';

			echo '<div '.$_id.' class="form-group col-lg'.$_size.($_required ? ' has-error' : '').$_classes.'">'.EOL;
				
				if($_type != self::TYPE_HIDDEN) {
					if($_link && $value != null) {
						echo '<a class="internal" href="'.$_link.'">';
						echo '<label for="'.$_key.'" class="'.$class_label.'"><i class="glyphicon glyphicon-circle-arrow-right"></i>'.$_label.'</label>'.EOL;
						echo '</a>';
					} else {
						echo '<label for="'.$_key.'" class="'.$class_label.'">'.$_label.'</label>'.EOL;
					}
				}
				
				switch($_type) {

					case self::TYPE_HIDDEN:
						echo $form->hidden(
							$_key, 
							$value
						).EOL;
						break;

					case self::TYPE_TEXT:
						echo '<div class="'.$class_wrap.'">'.EOL;
							echo $form->input($_key, $value, 'text', 
								array_merge(
									($_disabled ? array('readonly' => '') : array()), 
									(count($_options) > 0 ? array(
										'data-provide' => 'typeahead',
										'data-items' => 8,
										'data-value' => $value,
										'data-source' => json_encode(array_values($_options)), 
										'autocomplete' => 'off',
									) : array()), 
									array(
										'class' 		=> 'form-control input'.$_weight, 
										'placeholder' 	=> $_label, 
										'title' 		=> $title_input,
									)
								)
							).EOL;
							echo $_help;
						echo '</div>'.EOL;
						break;

					case self::TYPE_PASSWORD:
						echo '<div class="'.$class_wrap.'">'.EOL;
							echo $form->input($_key, $value, 'text', 
								array_merge(
									($_disabled ? array('readonly' => '') : array()), 
									array(
										'class' 		=> 'form-control input'.$_weight, 
										'placeholder' 	=> $_label, 
										'title' 		=> $title_input,
									)
								)
							).EOL;
							echo $_help;
						echo '</div>'.EOL;
						break;

					case self::TYPE_TEXTAREA:
						echo '<div class="'.$class_wrap.'">'.EOL;
							echo $form->textarea($_key, $value, 
								array_merge(
									($_disabled ? array('readonly' => '') : array()), 
									array(
										'class' 		=> 'form-control input'.$_weight, 
										'rows' 			=> '7', 
										'placeholder' 	=> $_label, 
										'title' 		=> $title_input,
									)
								)
							).EOL;
							echo $_help;
						echo '</div>'.EOL;
						break;

					case self::TYPE_CHECKBOX:
						echo '<div class="'.$class_wrap.'">'.EOL;
							echo $form->checkbox($_key, $_checked, $value,  
								array_merge(
									($_disabled ? array('readonly' => '') : array()), 
									array(
										'class' 		=> 'input'.$_weight, 
										'title' 		=> $title_input,
									)
								)
							).EOL;
							echo $_help;
						echo '</div>'.EOL;
						break;

					case self::TYPE_SELECT:
						echo '<div class="'.$class_wrap.'">'.EOL;
							echo $form->select($_key, $_options, $value, 
								array_merge(
									($_disabled ? array('readonly' => '') : array()), 
									array(
										'class' 		=> 'form-control input'.$_weight, 
										'title' 		=> $title_input,
									)
								)
							).EOL;
							echo $_help;
						echo '</div>'.EOL;
						break;

					case self::TYPE_FILE:
						echo '<div class="'.$class_wrap.'">'.EOL;
							if($value) {
								$parts = explode('.', $value);
								$extension = strtolower(end($parts));
								if(in_array($extension, array('jpg', 'jpeg', 'gif', 'png'))) {
									// display image
									echo '<a href="'.ROOT.Atomik::get('upload.dir').$value.'" class="'.($_thumbnail ? ' fancybox' : '" target="related_page').'">';
									echo '<img src="'.ROOT.Atomik::get('upload.dir').$value.'" alt="'.$value.'" width="250">';
									echo '</a>'.EOL;
								} else {
									// display link
									echo '<a href="'.ROOT.Atomik::get('upload.dir').$value.'" class="btn btn-info btn-sm'.($_thumbnail ? ' fancybox' : '" target="related_page').'">';
									echo '<i class="glyphicon glyphicon-save"></i> Télécharger le fichier : '.$value;
									echo '</a>'.EOL;
								}
								echo '<a href="'.ROOT.PAGE.'/supprimer_fichier/'.$_key.'" class="btn btn-danger btn-sm btn-delete" data-modal-content="Êtes-vous sûr de vouloir supprimer le fichier ?"><i class="glyphicon glyphicon-remove"></i> Supprimer le fichier</a>'.EOL;
								echo $form->hidden(
									$_key, 
									$value
								).EOL;
							} else {
								echo $form->file($_key, 
									array_merge(
										($_disabled ? array('readonly' => '') : array()), 
										array(
											'title' 		=> $title_input,
										)
									)
								).EOL;
								echo '<p class="help-block">Le fichier doit être au format '.implode(',', $_extensions).'</p>';
								echo $_help;
							}
						echo '</div>'.EOL;
						break;

					case self::TYPE_DATE:
						echo '<div class="'.$class_wrap.'">'.EOL;
							echo '<div class="datepicker input-group">'.EOL;
								echo $form->input($_key, ($value == null ? null : DateFormat::toHTML($value, 'Y-m-d')), 'text', 
									array_merge(
										($_disabled ? array('readonly' => '') : array()), 
										array(
											'class' 		=> 'form-control input'.$_weight,
											'placeholder' 	=> $_label,
											'title' 		=> $title_input,
											'data-format' 	=> 'dd/MM/yyyy"'
										)
									)
								).EOL;
								echo '<span class="input-group-addon"><i></i></span>'.EOL;
							echo '</div>'.EOL;
							echo $_help;
						echo '</div>'.EOL;
						break;

					case self::TYPE_HOUR:
						echo '<div class="'.$class_wrap.'">'.EOL;
							echo '<div class="timepicker input-group">'.EOL;
								echo $form->input($_key, ($value == null ? null : DateFormat::alter($value, 'H:i:s', 'H:i')), 'text', 
									array_merge(
										($_disabled ? array('readonly' => '') : array()), 
										array(
											'class' 		=> 'form-control input'.$_weight,
											'placeholder' 	=> $_label,
											'title' 		=> $title_input,
											'data-format' 	=> 'hh:mm"'
										)
									)
								).EOL;
								echo '<span class="input-group-addon"><i></i></span>'.EOL;
							echo '</div>'.EOL;
							echo $_help;
						echo '</div>'.EOL;
						break;

				}

			echo '</div>'.EOL;

		}

		echo '<div class="clearfix"></div>'.EOL;

	}

}
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
			
			$_type 		= isset($field['type']) 	? $field['type'] : self::TYPE_TEXT;
			$_size 		= isset($field['size']) 	? $field['size'] : self::SIZE_FULL;
			$_weight 	= isset($field['weight']) 	? $field['weight'] : self::WEIGHT_LIGHT;
			$_label 	= isset($field['label']) 	? $field['label'] : $_key;
			$_required 	= isset($field['required']) ? $field['required'] : false;
			$_disabled 	= isset($field['disabled']) ? $field['disabled'] : false;
			$_options 	= isset($field['options']) 	? $field['options'] : array();
			$_checked	= isset($field['checked']) 	? $field['checked'] : (bool)$value;
			$_help 		= isset($field['help']) 	? '<p class="help-block">'.$field['help'].'</p>'.EOL : '';
			$_link 		= false;

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

			echo '<div class="form-group col-lg'.$_size.($_required ? ' has-error' : '').'">'.EOL;
				
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
									($_disabled ? array('disabled' => '') : array()), 
									(count($_options) > 0 ? array(
										'data-provide' => 'typeahead',
										'data-items' => 8,
										'data-value' => $value,
										'data-source' => json_encode(array_values($_options)), 
										'autocomplete' => 'false',
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
							echo $form->input($_key, $value, 'password', 
								array_merge(
									($_disabled ? array('disabled' => '') : array()), 
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
									($_disabled ? array('disabled' => '') : array()), 
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
									($_disabled ? array('disabled' => '') : array()), 
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
									($_disabled ? array('disabled' => '') : array()), 
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
						//@TODO
						echo '<div class="'.$class_wrap.'">'.EOL;
							echo $form->file($_key, 
								array_merge(
									($_disabled ? array('disabled' => '') : array()), 
									array(
										'title' 		=> $title_input,
									)
								)
							).EOL;
							echo $_help;
						echo '</div>'.EOL;
						break;

					case self::TYPE_DATE:
						echo '<div class="'.$class_wrap.'">'.EOL;
							echo '<div class="datepicker input-group">'.EOL;
								echo $form->input($_key, ($value == null ? null : DateFormat::toHTML($value)), 'text', 
									array_merge(
										($_disabled ? array('disabled' => '') : array()), 
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
										($_disabled ? array('disabled' => '') : array()), 
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
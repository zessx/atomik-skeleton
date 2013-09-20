<?php

class Form 
{

	const TEXT_TYPE			= 'text';
	const PASSWORD_TYPE		= 'password';
	const HIDDEN_TYPE		= 'hidden';
	const TEXTAREA_TYPE		= 'textarea';
	const CHECKBOX_TYPE		= 'checkbox';
	const RADIO_TYPE		= 'radio';
	const SELECT_TYPE		= 'select';
	const FILE_TYPE			= 'file';
	const DATE_TYPE			= 'date';

	const LIGHT_WEIGHT 		= '-sm';
	const MEDIUM_WEIGHT 	= '-md';
	const HEAVY_WEIGHT 		= '-lg';

	const FULL_SIZE 		= '-12';
	const HALF_SIZE 		= '-6';

	/* Génère les champs formulaire à partir d'un tableau d'options */	
	public static function generateFields($form, $fields, $object = null) {

		$group = 0;

		foreach ($fields as $_key => $field) {

			$value = null;
			if($object != null && isset($object[$_key]))
				$value = $object[$_key];
			
			$_type 		= isset($field['type']) 	? $field['type'] : self::TEXT_TYPE;
			$_size 		= isset($field['size']) 	? $field['size'] : self::FULL_SIZE;
			$_weight 	= isset($field['weight']) 	? $field['weight'] : self::LIGHT_WEIGHT;
			$_label 	= isset($field['label']) 	? $field['label'] : $_key;
			$_required 	= isset($field['required']) ? $field['required'] : false;
			$_disabled 	= isset($field['disabled']) ? $field['disabled'] : false;
			$_options 	= isset($field['options']) 	? $field['options'] : array();
			$_checked	= isset($field['checked']) 	? $field['checked'] : 0;
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
				
				if($_type != self::HIDDEN_TYPE) {
					if($_link && $value != null) {
						echo '<a class="internal" href="'.$_link.'">';
						echo '<label for="'.$_key.'" class="'.$class_label.'"><i class="glyphicon glyphicon-circle-arrow-right"></i>'.$_label.'</label>'.EOL;
						echo '</a>';
					} else {
						echo '<label for="'.$_key.'" class="'.$class_label.'">'.$_label.'</label>'.EOL;
					}
				}
				
				switch($_type) {

					case self::HIDDEN_TYPE:
						echo $form->hidden(
							$_key, 
							$value
						).EOL;
						break;

					case self::TEXT_TYPE:
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

					case self::PASSWORD_TYPE:
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

					case self::TEXTAREA_TYPE:
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

					case self::CHECKBOX_TYPE:
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

					case self::SELECT_TYPE:
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

					case self::FILE_TYPE:
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

					case self::DATE_TYPE:
						//@TODO
						echo '<div class="'.$class_wrap.'">'.EOL;
							echo $form->input($_key, ($value == null ? null : date('d/m/Y', strtotime($value))), 'text', 
								array_merge(
									($_disabled ? array('disabled' => '') : array()), 
									array(
										'class' 		=> 'form-control datepicker input'.$_weight,
										'placeholder' 	=> $_label,
										'title' 		=> $title_input,
									)
								)
							).EOL;
							echo $_help;
						echo '</div>'.EOL;
						break;

				}

			echo '</div>'.EOL;

		}

		echo '<div class="clearfix"></div>'.EOL;

	}

}
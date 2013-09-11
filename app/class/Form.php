<?php

class Form 
{

	const TEXT_TYPE			= 'text';
	const HIDDEN_TYPE		= 'hidden';
	const TEXTAREA_TYPE		= 'textarea';
	const CHECKBOX_TYPE		= 'checkbox';
	const RADIO_TYPE		= 'radio';
	const SELECT_TYPE		= 'select';
	const FILE_TYPE			= 'file';

	const LIGHT_WEIGHT 		= '-sm';
	const MEDIUM_WEIGHT 	= '-md';
	const HEAVY_WEIGHT 		= '-lg';

	const FULL_SIZE 		= '-10';
	const HALF_SIZE 		= '-4';

	/* Génère les champs formulaire à partir d'un tableau d'options */
	public static function generateFields($form, $fields, $object = null) {

		$group = 0;

		foreach ($fields as $_key => $field) {

			$_type 		= isset($field['type']) 	? $field['type'] : self::TEXT_TYPE;
			$_size 		= isset($field['size']) 	? $field['size'] : self::FULL_SIZE;
			$_weight 	= isset($field['weight']) 	? $field['weight'] : self::LIGHT_WEIGHT;
			$_label 	= isset($field['label']) 	? $field['label'] : $_key;
			$_required 	= isset($field['required']) ? $field['required'] : false;
			$_options 	= isset($field['options']) 	? $field['options'] : array();
			$_help 		= isset($field['help']) 	? '<p class="help-block">'.$field['help'].'</p>'.EOL : '';

			$value = null;
			if($object != null && isset($object[$_key]))
				$value = $object[$_key];

			$class_label 	= 'col-lg-2 control-label label'.$_weight;

			$group_open		= '<div class="form-group'.($_required ? ' required' : '').'">'.EOL;
			$group_close	=  '</div>'.EOL;
			if($_size == self::HALF_SIZE) {
				if($group == 0) {
					$group_close = '';
				} elseif($group == 1) {
					$group_open = '';
				}
				$group = ($group+1) % 2;
			}			

			echo $group_open;
				
			switch($_type) {

				case self::TEXT_TYPE:
					echo '<label for="'.$_key.'" class="'.$class_label.'">'.$_label.'</label>'.EOL;
					echo '<div class="col-lg'.$_size.'">'.EOL;
						echo $form->input($_key, $value, 'text', array('class' => 'form-control input'.$_weight, 'placeholder' => $_label)).EOL;
						echo $_help;
					echo '</div>'.EOL;
					break;

				case self::HIDDEN_TYPE:
					echo $form->hidden($_key, $value).EOL;
					break;

				case self::TEXTAREA_TYPE:
					echo '<label for="'.$_key.'" class="'.$class_label.'">'.$_label.'</label>'.EOL;
					echo '<div class="col-lg'.$_size.'">'.EOL;
						echo $form->textarea($_key, $value, array('class' => 'form-control input'.$_weight, 'rows' => '7', 'placeholder' => $_label)).EOL;
						echo $_help;
					echo '</div>'.EOL;
					break;

				case self::CHECKBOX_TYPE:
					//@TODO
					break;

				case self::RADIO_TYPE:
					//@TODO
					break;

				case self::SELECT_TYPE:
					echo '<label for="'.$_key.'" class="'.$class_label.'">'.$_label.'</label>'.EOL;
					echo '<div class="col-lg'.$_size.'">'.EOL;
						echo $form->select($_key, $_options, $value, array('class' => 'form-control input'.$_weight)).EOL;
						echo $_help;
					echo '</div>'.EOL;
					break;

				case self::FILE_TYPE:
					//@TODO
					echo '<label for="'.$_key.'" class="'.$class_label.'">'.$_label.'</label>'.EOL;
					echo '<div class="col-lg'.$_size.'">'.EOL;
						echo $form->file($_key).EOL;
						echo $_help;
					echo '</div>'.EOL;
					break;

			}

			echo $group_close;

		}

	}

}
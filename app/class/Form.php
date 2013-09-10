<?php

class Form 
{

	const TEXT_TYPE		= 'text';
	const HIDDEN_TYPE		= 'hidden';
	const TEXTAREA_TYPE	= 'textarea';
	const CHECKBOX_TYPE	= 'checkbox';
	const RADIO_TYPE		= 'radio';
	const SELECT_TYPE		= 'select';

	const LIGHT_WEIGHT 	= '-sm';
	const MEDIUM_WEIGHT 	= '-md';
	const HEAVY_WEIGHT 	= '-lg';

	const FULL_SIZE 		= '-10';
	const HALF_SIZE 		= '-4';

	/* Génère les champs formulaire à partir d'un tableau d'options */
	public static function generateFields($form, $fields, $object = null) {

		$group = 0;

		foreach ($fields as $key => $field) {

			if(!isset($field['type'])) 			$field['type'] = self::TEXT_TYPE;
			if(!isset($field['size'])) 			$field['size'] = self::FULL_SIZE;
			if(!isset($field['weight'])) 		$field['weight'] = self::LIGHT_WEIGHT;
			if(!isset($field['label'])) 		$field['label'] = $key;
			if(!isset($field['required'])) 		$field['required'] = false;

			$value = null;
			if($object != null && isset($object[$key]))
				$value = $object[$key];

			$class_label 	= 'col-lg-2 control-label label'.$field['weight'];
			$class_wrap 	= 'col-lg'.$field['size'];
			$class_input 	= 'form-control input'.$field['weight'];

			$group_open		= '<div class="form-group'.($field['required'] ? ' required' : '').'">'.EOL;
			$group_close	=  '</div>'.EOL;
			if($field['size'] == self::HALF_SIZE) {
				if($group == 0) {
					$group_close = '';
				} elseif($group == 1) {
					$group_open = '';
				}
				$group = ($group+1) % 2;
			}			

			echo $group_open;
				
			switch($field['type']) {

				case self::TEXT_TYPE:
					echo '<label for="'.$key.'" class="'.$class_label.'">'.$field['label'].'</label>'.EOL;
					echo '<div class="'.$class_wrap.'">'.EOL;
						echo $form->input($key, $value, 'text', array('class' => $class_input, 'placeholder' => $field['label'])).EOL;
					echo '</div>'.EOL;
					break;

				case self::HIDDEN_TYPE:
					echo $form->hidden($key, $value).EOL;
					break;

				case self::TEXTAREA_TYPE:
					echo '<label for="'.$key.'" class="'.$class_label.'">'.$field['label'].'</label>'.EOL;
					echo $form->textarea($key, $value).EOL;
					break;

				case self::CHECKBOX_TYPE:
					//@TODO
					echo '<label for="'.$key.'" class="'.$class_label.'">'.$field['label'].'</label>'.EOL;
					echo $form->input($key, $value, 'hidden').EOL;
					break;

				case self::RADIO_TYPE:
					//@TODO
					echo '<label for="'.$key.'" class="'.$class_label.'">'.$field['label'].'</label>'.EOL;
					echo $form->input($key, $value, 'hidden').EOL;
					break;

				case self::SELECT_TYPE:
					//@TODO
					echo '<label for="'.$key.'" class="'.$class_label.'">'.$field['label'].'</label>'.EOL;
					echo $form->input($key, $value, 'hidden').EOL;
					break;

			}

			echo $group_close;

		}

	}

}
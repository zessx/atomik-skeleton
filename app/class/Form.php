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
	const DATE_TYPE			= 'date';

	const LIGHT_WEIGHT 		= '-sm';
	const MEDIUM_WEIGHT 	= '-md';
	const HEAVY_WEIGHT 		= '-lg';

	const FULL_SIZE 		= '-12';//-10
	const HALF_SIZE 		= '-6';//-4

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
			$_checked	= isset($field['checked']) 	? $field['checked'] : 0;
			$_help 		= isset($field['help']) 	? '<p class="help-block">'.$field['help'].'</p>'.EOL : '';

			$value = null;
			if($object != null && isset($object[$_key]))
				$value = $object[$_key];

			$class_label 	= 'col-lg-2 control-label label'.$_weight;
			$class_wrap 	= 'field-wrap col-lg-10';
			$title_input 	= $_required ? 'Ce champ est obligatoire' : '';

			echo '<div class="form-group col-lg'.$_size.($_required ? ' has-error' : '').'">'.EOL;
				
			switch($_type) {

				case self::TEXT_TYPE:
					echo '<label for="'.$_key.'" class="'.$class_label.'">'.$_label.'</label>'.EOL;
					echo '<div class="'.$class_wrap.'">'.EOL;
						echo $form->input($_key, $value, 'text', array('class' => 'form-control input'.$_weight, 'placeholder' => $_label, 'title' => $title_input)).EOL;
						echo $_help;
					echo '</div>'.EOL;
					break;

				case self::HIDDEN_TYPE:
					echo $form->hidden($_key, $value).EOL;
					break;

				case self::TEXTAREA_TYPE:
					echo '<label for="'.$_key.'" class="'.$class_label.'">'.$_label.'</label>'.EOL;
					echo '<div class="'.$class_wrap.'">'.EOL;
						echo $form->textarea($_key, $value, array('class' => 'form-control input'.$_weight, 'rows' => '7', 'placeholder' => $_label, 'title' => $title_input)).EOL;
						echo $_help;
					echo '</div>'.EOL;
					break;

				case self::CHECKBOX_TYPE:
					echo '<label for="'.$_key.'" class="'.$class_label.'">'.$_label.'</label>'.EOL;
					echo '<div class="'.$class_wrap.'">'.EOL;
						echo $form->checkbox($_key, $_checked, $value, array('class' => 'input'.$_weight, 'title' => $title_input)).EOL;
						echo $_help;
					echo '</div>'.EOL;
					break;

				case self::SELECT_TYPE:
					echo '<label for="'.$_key.'" class="'.$class_label.'">'.$_label.'</label>'.EOL;
					echo '<div class="'.$class_wrap.'">'.EOL;
						echo $form->select($_key, $_options, $value, array('class' => 'form-control input'.$_weight, 'title' => $title_input)).EOL;
						echo $_help;
					echo '</div>'.EOL;
					break;

				case self::FILE_TYPE:
					//@TODO
					echo '<label for="'.$_key.'" class="'.$class_label.'">'.$_label.'</label>'.EOL;
					echo '<div class="'.$class_wrap.'">'.EOL;
						echo $form->file($_key, array('title' => $title_input)).EOL;
						echo $_help;
					echo '</div>'.EOL;
					break;

				case self::DATE_TYPE:
					//@TODO
					echo '<label for="'.$_key.'" class="'.$class_label.'">'.$_label.'</label>'.EOL;
					echo '<div class="'.$class_wrap.'">'.EOL;
						echo $form->input($_key, ($value == null ? null : date('d/m/Y', strtotime($value))), 'text', array('class' => 'form-control datepicker input'.$_weight, 'placeholder' => $_label, 'title' => $title_input)).EOL;
						echo $_help;
					echo '</div>'.EOL;
					break;

			}

			echo '</div>'.EOL;

		}

		echo '<div class="clearfix"></div>'.EOL;

	}

}
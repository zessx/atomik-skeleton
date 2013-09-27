Atomik Skeleton
===============
Structure de base pour un backend basé sur [Atomik Framework](http://atomikframework.com/) et [Bootstrap 3](getbootstrap.com)

Installation
------------
- Récupérer les sources
- Adapter base_dir dans le fichier `app/config.php`
- Créer la BDD et utiliser `_setup/atomik_db.sql`
- Identifiants : `admin:admin` / `user:user`

Configuration
-------------
***config.php***

Fichier de configuration
- Gestion de la BDD
- Gestion des routes

***init.php***

Exécuté avant le lancement d'Atomik

***pre.php***

Exécuté avant l'appel des vues
- Définition de constantes
- Gestion des sessions

***post.php***

Exécuté après l'appel des vues

Utilisation
-----------
***Tools.php***

Contient des fonctions utilitaires

***DateFormat.php***

Formate les dates pour l'affichage ou le stockage :
```
DateFormat::alter('14 July 2013', 'd F Y', 'Y, M dS');
DateFormat::toSQL('14/07/2013'); 
DateFormat::toHTML('2013-07-14 12:30:00'); 
```

***Form.php***

Permet de générer des champs avec les classes de Bootstrap 3 : <br>
Pour chaque champ, des options sont fixées :<br>
- `type`     : type du champ (hidden, text, textarea, checkbox, select, file, date, password)
- `size`     : largeur du champ (pour des formulaires sur 1 ou 2 colonnes)
- `weight`   : importance du champ (définit sa hauteur)
- `label`    : label du champ
- `required` : le champ est-il requit
- `disabled` : désactive le champ
- `options`  : pour le type "select", ou le type "text" avec un typeahead
- `checked`  : pour le type "checkbox"
- `help`     : texte d'aide placé sous le champ
- `link`     : lien ajouté sur le label 

Exemple d'utilisation :
```
/* action.php */
$fields = array(
    'nom' => array(
        'label'     => 'Nom',
        'required'  => true,
        'weight'    => Form::WEIGHT_HEAVY,
        'filter'    => FILTER_SANITIZE_STRING,
    ),
    'role' => array(
        'label'     => 'Rôle',
        'required'  => true,
        'options'   => array('Administrateur', 'Modérateur', 'Rédacteur', 'Utilisateur', 'Invité'),
        'filter'    => FILTER_SANITIZE_STRING,
    ),
    'telephone' => array(
        'label'     => 'Téléphone',
        'size'	   	=> Form::SIZE_HALF,
        'filter'    => FILTER_SANITIZE_STRING,
    ),
    'email' => array(
        'required'  => true,
      	'label'     => 'Email',
        'size'	    => Form::SIZE_HALF,
        'filter'    => FILTER_VALIDATE_EMAIL,
    )
);
```
```
/* view.php */
<?= $form = $this->form($url_send, null, array('class' => 'form-horizontal')) ?>
<?= Form::generateFields($form, $fields, $object) ?>

	<hr>
	
	<div class="form-group">
		<div class="col-lg-offset-2 col-lg-4">
			<?= $form->buttons('Valider', $url_cancel, array('class' => 'btn btn-primary')) ?>
		</div>
	</div>
</form>
```
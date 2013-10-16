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
***Formatage des dates***

`DateFormat` fournit des fonctions pour formater les dates pour l'affichage ou le stockage :
- `toSQL($date, $before = 'd/m/Y')`		: formate la date pour un stockage en base de donnée
- `toHTML($date, $before = 'Y-m-d H:i:s')`	: formate la date pour un affichage en front (format européen d/m/Y)
- `alter($date, $before, $after)`		: permet de passe d'un format choisi à un autre

Exemple d'utilisation :
```
DateFormat::alter('14 July 2013', 'd F Y', 'Y, M dS');
// output : 2013, Jul 14th
DateFormat::toSQL('14/07/2013'); 
// output : 2013-07-14 00:00:00
DateFormat::toHTML('2013-07-14 12:30:00'); 
// output : 14/07/2013
```

***Génération de formulaire***

`Form` fournit des fonction permettant de générer des champs avec les classes de Bootstrap 3 : <br>
Pour chaque champ, des options sont fixées :<br>
- `type`        : type du champ (hidden, text, textarea, checkbox, select, file, date, password)
- `size`        : largeur du champ (pour des formulaires sur 1 ou 2 colonnes)
- `weight`      : importance du champ (définit sa hauteur)
- `label`       : label du champ
- `required`    : le champ est-il requit
- `disabled`    : désactive le champ
- `options`     : pour le type "select", ou le type "text" avec un typeahead
- `checked`     : pour le type "checkbox"
- `extensions`  : pour le type "file", définit les extensions autorisées
- `thumbnail`   : pour le type "file", permet d'afficher un fichier avec fancybox
- `help`        : texte d'aide placé sous le champ
- `id`          : précise l'idntifiant du `form-group`
- `classes`     : précise les classes du `form-group`
- `link`        : lien ajouté sur le label 

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
    ),
    'logo' => array(
        'label'         => 'Logo',
        'type'          => Form::TYPE_FILE,
        'thumbnail'     => true,
        'extensions'    => array('jpg', 'gif', 'png'),
    ),
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

***Affichage de tables de données***

Le plugin `datatables.js` permet l'affichage de tables de données avancées.<br>
Certaines classes ont été ajoutées aux classes de base pour faciliter la mise en place de ces tables :
- `table`		: classe de base, pour l'initialisation de la datatable (obligatoire)
- `table-hover`		: coloration au passage de la souris sur une ligne (recommandé)
- `table-condensed`	: la hauteur des lignes est réduite (recommandé)
- `table-bordered`	: les cellules sont délimitées par des bordures (recommandé)
- `table-striped`	: la couleur de fond des lignes est alternée (recommandé)
- `table-sortable`	: autorise le clic sur les en-tête pour trier les colonnes
- `table-persistent`	: permet la persistence de l'état de la table
- `table-filtrable`	: ajoute un champ pour filtrer les résultats
- `table-paginable`	: ajoute une pagination

Ainsi que quelques options :
- `data-sort-cols`  	: colonnes utilisées pour le tri (requiert la classe `table-sortable`)
- `data-sort-dirs`     	: sens utilisés pour le tri des colonnes définies dans l'option `data-sort-cols` (asc|desc)
- `data-display-length` : nombre de ligne à afficher (25 par défaut)
- `data-hide-controls`	: permet de cacher les contrôle au-dessus ou au-dessous de la table (top|bottom) 

Exemple d'utilisation :
```
<table class="table table-hover table-condensed table-bordered table-striped 
				table-filtrable table-paginable table-sortable table-persistent" 
	data-sort-cols="0,2" 
	data-sort-dirs="asc,desc" 
	data-display-length="10"
    data-hide-controls="top">
	<thead>
		<tr>
			<th>Column header</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Column value</td>
		</tr>
	</tbody>
</table>
```

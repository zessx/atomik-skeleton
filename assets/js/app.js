$(document).ready(function(){

	/*
	* Left nav
	*/
	$('.sidenav[data-spy="affix"]').affix({
		offset: { 
			bottom: function () {
				return (this.bottom = $('footer').outerHeight(true) + 60)
			}
		}
	});

	/*
	* Enhanced data tables
	*/
	$('.table').each(function(){

		var domtop = '';
		var dombottom = '';

		if($(this).is('.table-paginable')) {
			var filter = $(this).is('.table-filtrable') ? 'f' : '';
			domtop = "<'row'<'col-md-2 col-sm-6 col-xs-12'l><'col-md-3 hidden-sm hidden-xs'i><'col-md-3 col-sm-6 hidden-xs'"+filter+"><'col-md-4 hidden-sm hidden-xs'p>>";
			dombottom = "<'row'<'col-md-2 hidden-sm hidden-xs'l><'col-md-3 hidden-sm hidden-xs'i><'col-md-3 hidden-sm hidden-xs'"+filter+"><'col-md-4 col-sm-12'p>>";
		} else {
			if($(this).is('.table-filtrable')) {
				domtop = "<'row'<'col-md-9 col-sm-6 hidden-xs'><'col-md-3 col-sm-6 col-xs-12'f>>";
				dombottom = "<'row'<'col-md-9 col-sm-6 hidden-xs'><'col-md-3 col-sm-6 hidden-xs'f>>";
			}
		}
		var dom = 't';
		if(!($(this).data('hide-controls') == 'top')) 
			dom = domtop + dom;
		if(!($(this).data('hide-controls') == 'bottom')) 
			dom = dom + dombottom;

		var options = {
			'sDom': dom,
			'sPaginationType': 'bootstrap',
			'bStateSave': $(this).is('.table-persistent'),
			'aoColumnDefs': [{ 
				'bSortable': $(this).is('.table-sortable'),
				"aTargets": ['_all']
			}],
			'iDisplayLength': $(this).data('display-length') ? $(this).data('display-length') : 25,
			'oLanguage': {
				'sLengthMenu': '_MENU_ par page',
				'sZeroRecords': 'Aucun résultat disponible',
				'sSearch': 'Filter ',
				'sProcessing': 'Traitement ...',
				'sLoadingRecords': 'Chargement ...',
				'sInfoFiltered': ' - Filtré à partir _MAX_ résultats',
				'sInfoEmpty': 'Aucun résultat disponible',
				'sInfo': '&nbsp;(_START_~_END_ / _TOTAL_)',
				'sEmptyTable': 'Aucun résultat disponible'
			}
		}

		var sortColumns = [0];
		var sortDirections = ['asc'];
		if($(this).data('sort-cols')) 
			sortColumns = $(this).data('sort-cols').toString().indexOf(',') >= 0 ? $(this).data('sort-cols').split(',') : [$(this).data('sort-cols')];
		if($(this).data('sort-dirs'))
			sortDirections = $(this).data('sort-dirs').toString().indexOf(',') >= 0 ? $(this).data('sort-dirs').split(',') : [$(this).data('sort-dirs')];

		var sort = [];
		var n = sortColumns.length;
		for (var i=0; i<n; i++) {
			sort.push([$.trim(sortColumns[i]), (sortDirections[i] ? $.trim(sortDirections[i]) : 'asc')]);
		}
		options["aaSorting"] = sort;

		var table = $(this).dataTable(options);
	});
	$('.dataTables_wrapper').find('input, select').addClass('form-control input-sm');

	/* 
	* Add a confirm button to all a.btn-delete 	
	*/
	$('a.btn-delete').on('click', function(ev) {
		ev.preventDefault();
		var modalTitle 		= $(this).data('modalTitle') ? $(this).data('modalTitle') : 'Confirmation de la suppression';
		var modalContent 	= $(this).data('modalContent') ? $(this).data('modalContent') : 'Êtes-vous sur de vouloir supprimer cet élément ?';
		var modalConfirm 	= $(this).data('modalConfirm') ? $(this).data('modalConfirm') : 'Oui, supprimer';
		var modalCancel		= $(this).data('modalCancel') ? $(this).data('modalCancel') : 'Non, annuler';
		var modal = $('<div class="modal fade"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h4 class="modal-title">'+modalTitle+'</h4></div><div class="modal-body"><p>'+modalContent+'</p></div><div class="modal-footer"><a type="button" class="btn btn-default" data-dismiss="modal">'+modalCancel+'</a><a type="button" class="btn btn-danger" href="'+$(this).attr('href')+'">'+modalConfirm+'</button></div></div></div>');
		$('body').append(modal);
		modal.modal('show');
	});

	/*
	* Datepickers
	*/
	$('.datepicker').datetimepicker({
		pickTime: false,
		language: 'fr',
	});
	$('.timepicker').datetimepicker({
		pickDate: false,
		language: 'fr',
	});

	/*
	* Enable tabs direct links
	*/
	if(hash = document.location.hash) {
		$('.nav-tabs a[href="'+hash.replace("#", "#tab_")+'"]').tab('show');
	} 
	$('.nav-tabs').click('a', function(ev) {
		window.location.hash = ev.target.hash.replace("#tab_", "#");
	})

	/*
	* Force form submit when a flash message is confirmed
	*/
	$('.btn-force-submit').click(function(e) {
		e.preventDefault();
		if($(this).data('form')) {
			var form = $('#'+$(this).data('form'));
			form.append('<input type="hidden" name="force-submit" value="1">').submit();
		}
	});

	/*
	* Enable fancybox
	*/
	$('.fancybox').fancybox();
	
});

;(function($){
	$.fn.datetimepicker.dates['fr'] = {
		days: ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"],
		daysShort: ["Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam", "Dim"],
		daysMin: ["D", "L", "Ma", "Me", "J", "V", "S", "D"],
		months: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"],
		monthsShort: ["Jan", "Fev", "Mar", "Avr", "Mai", "Jui", "Jul", "Aou", "Sep", "Oct", "Nov", "Dec"],
		today: "Aujourd'hui"
	};
}(jQuery));
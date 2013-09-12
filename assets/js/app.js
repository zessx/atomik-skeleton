$(document).ready(function(){

	/*
	* Enhanced data tables
	*/
	$('.table-enhanced').each(function(){
		var options = {
			"sDom": "<'row'<'col-md-2 col-sm-6 col-xs-12'l><'col-md-4 hidden-sm hidden-xs'i><'col-md-3 hidden-xs'f><'col-md-3 hidden-sm hidden-xs'p>>t<'row'<'col-md-2 hidden-sm hidden-xs'l><'col-md-4 hidden-sm hidden-xs'i><'col-md-3  hidden-sm hidden-xs'f><'col-md-3 col-sm-12'p>>",
			"sPaginationType": "bootstrap",
			"bStateSave": true,
			"iDisplayLength": 25,
			"oLanguage": {
				"sLengthMenu": "_MENU_ par page",
				"sZeroRecords": "Aucun résultat disponible",
				"sSearch": "Filter ",
				"sProcessing": "Traitement ...",
				"sLoadingRecords": "Chargement ...",
				"sInfoFiltered": " - Filtré à partir _MAX_ résultats",
				"sInfoEmpty": "Aucun résultat disponible",
				"sInfo": "_START_ à _END_ sur _TOTAL_ résultats",
				"sEmptyTable": "Aucun résultat disponible"
			}
		}

		/*
		* If a custom sort column is set
		* eg. <table class="table table-enhanced" data-sort-cols="2,0" data-sort-dirs="desc,asc">
		*/
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
    $(".datepicker").datepicker({
    	format: 'dd/mm/yyyy',
    	language: 'fr'
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

});

$(document).ready(function(){
   $('#tabla_lista').dataTable( { //CONVERTIMOS NUESTRO LISTADO DE LA FORMA DEL JQUERY.DATATABLES- PASAMOS EL ID DE LA TABLA
        //"sPaginationType": "full_numbers", //DAMOS FORMATO A LA PAGINACION(NUMEROS)
		//"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		"iDisplayLength": -1,
		"bLengthChange": false,
		"oLanguage": {
				"sProcessing": "Cargando...",
				"sLengthMenu": "Ver _MENU_ registros",
				"sZeroRecords": "No se produjo ningún resultado",
				"sEmptyTable": "No existen registros para mostrar",
				"sInfo": "Resultado _START_ - _END_ de _TOTAL_ registros",
				"sInfoEmpty": "Registros 0 - 0 de 0 Entradas",
				"sInfoFiltered": "(Filtrado de _MAX_ registros)",
				"sInfoPostFix": "",
				"sSearch": "Buscar:",
				"sUrl": "",
				"oPaginate": {
					"sFirst":    "Primero",
					"sPrevious": "Anterior",
					"sNext":     "Siguiente",
					"sLast":     "Último"
				},
				"fnInfoCallback": null
			}
    } );
    
    
     $('.edit').editable('/series/series/update', {
         id        : 'data[Series][id]',
         name      : 'data[Series][progreso]',
         tooltip   : 'Clic para editar',
		 style     : 'display:inline',
		 width	   : 40,
		 callback  : function(value, settings) {
						$('#'+value.id).html(value.progreso);
						$('#d_'+value.id).html(value.descarga);
                     },
		 ajaxoptions : {dataType : "json"}
    });
	
	$('.dl').editable('/series/series/updated', {
         id        : 'data[Series][id]',
         name      : 'data[Series][descarga]',
         tooltip   : 'Clic para editar',
		 style     : 'display:inline',
		 width	   : 40
    });

    $('.datepicker').datepicker({
	  	inline: true,
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        numberOfMonths: 1,
        showButtonPanel: true,
	});
});

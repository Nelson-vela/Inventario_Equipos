 

$(document).ready(function() {

	listarTablaAreas()

});



var listarTablaAreas = function(){

	var table = $('#tablaAreas').DataTable({
		"bDeferRender": true,   
		"sPaginationType": "full_numbers",
		responsive: true,
		"ajax": {
			"type":"POST",
			"url":"ajax/tableAreas.ajax.php"
		},
		"columns":[
		{ "data": "id"},		 
		{ "data": "area"},  
		{ "data": "fecha"},  
		{ "data": "acciones"}             
		],

		"oLanguage": {
			"sProcessing":     "Procesando...",
			"sLengthMenu": 'Mostrar <select>'+
			'<option value="10">10</option>'+
			'<option value="20">20</option>'+
			'<option value="30">30</option>'+
			'<option value="40">40</option>'+
			'<option value="50">50</option>'+
			'<option value="-1">All</option>'+
			'</select> registros',    
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando del (_START_ al _END_) de un total de _TOTAL_ registros",
			"sInfoEmpty":      "Mostrando del 0 al 0 de un total de 0 registros",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Filtrar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Por favor espere - cargando...",
			"oPaginate": {
				"sFirst":    "Primero",
				"sLast":     "Último",
				"sNext":     "Siguiente",
				"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		}
	});

    /*obtener_data_edita("#example", table);
    obtener_data_elimina("#example", table);*/
    /* ActivadoDesactivado("#tablePresupuesto", table);*/
    /*EditarGastos("#tableDocumentosCompras", table);
    EliminarGastos("#tableDocumentosCompras", table);*/

}







	 $("#tablaAreas").on( 'click', 'button.btnEditarArea', function (){

	 	var idArea = $(this).attr('idArea');
	 	console.log("idArea", idArea);


	 	
	 	var datos = new FormData();

	 	datos.append('idAreas',idArea);


	 	$.ajax({

	 		url:"ajax/areas.ajax.php",
	 		method: "POST",
	 		data: datos,
	 		cache: false,
	 		contentType: false,
	 		processData: false,
	 		dataType: "json",    
	 		success: function(respuesta){ 		 
	 	 
 
				$("#editarArea").val(respuesta['area']);			 
				$("#idAreasEditar").val(respuesta['id']);
  
			}

		});




	 })









	 $("#tablaAreas").on( 'click', 'button.btnEliminarArea', function (){

	 	var idArea = $(this).attr('idArea');
	 	console.log("idArea", idArea);


	 	swal({

	 		title: "¿Está seguro de borrar el área?",
	 		text: "¡No se podrá deshacer la operación!",
	 		type: "warning",		
	 		showCancelButton: true,
	 		confirmButtonColor: "#3085d5",
	 		cancelButtonColor: "#d33",
	 		cancelButtonText: "Cancelar",		
	 		confirmButtonText: "Si, borrar área"		

	 	}).then((result) => {
	 		if (result.value) {

	 			window.location = "index.php?ruta=areas&idArea="+idArea;

	 		}
	 	})


	 })

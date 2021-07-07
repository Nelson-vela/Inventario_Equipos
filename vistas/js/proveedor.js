 

$(document).ready(function() {

	listarTablaProveedor()

});



var listarTablaProveedor = function(){

	var table = $('#tablaProveedor').DataTable({
		"bDeferRender": true,   
		"sPaginationType": "full_numbers",
		responsive: true,
		"ajax": {
			"type":"POST",
			"url":"ajax/tableProveedor.ajax.php"
		},
		"columns":[
		{ "data": "id"},		 
		{ "data": "proveedor"}, 
		{ "data": "ruc"},  
		{ "data": "direccion"}, 
		{ "data": "email"}, 
		{ "data": "telefono"}, 
		{ "data": "fecha_ingreso"},  
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







	 $("#tablaProveedor").on( 'click', 'button.btnEditarProveedor', function (){

	 	var idProveedor = $(this).attr('idProveedor');
	 	console.log("idProveedor", idProveedor);


	 	
	 	var datos = new FormData();

	 	datos.append('idProveedor',idProveedor);


	 	$.ajax({

	 		url:"ajax/proveedor.ajax.php",
	 		method: "POST",
	 		data: datos,
	 		cache: false,
	 		contentType: false,
	 		processData: false,
	 		dataType: "json",    
	 		success: function(respuesta){ 		 
	 	 
 
				$("#editarRucProveedor").val(respuesta['ruc']);	
				$("#editarNombreProveedor").val(respuesta['proveedor']); 
				$("#editarDireccionProveedor").val(respuesta['direccion']);
				$("#editarTelefonoProveedor").val(respuesta['telefono']);
				$("#editarEmailProveedor").val(respuesta['email']);
				$("#idProveedorEditar").val(respuesta['id']);
  
			}

		});




	 })









	 $("#tablaProveedor").on( 'click', 'button.btnEliminarProveedor', function (){

	 	var idProveedor = $(this).attr('idProveedor');
	 	console.log("idProveedor", idProveedor);


	 	swal({

	 		title: "¿Está seguro de borrar el proveedor?",
	 		text: "¡No se podrá deshacer la operación!",
	 		type: "warning",		
	 		showCancelButton: true,
	 		confirmButtonColor: "#3085d5",
	 		cancelButtonColor: "#d33",
	 		cancelButtonText: "Cancelar",		
	 		confirmButtonText: "Si, borrar documento"		

	 	}).then((result) => {
	 		if (result.value) {

	 			window.location = "index.php?ruta=proveedores&idProveedor="+idProveedor;

	 		}
	 	})


	 })


/*=============================================
=            EDITAR CLIENTES         =
=============================================*/
$(document).ready(function() {

	listarTablaClientes()

});



var listarTablaClientes = function(){

	var table = $('.tablaClientes').DataTable({
		"bDeferRender": true,   
		"sPaginationType": "full_numbers",
		responsive: true,
		"ajax": {
			"type":"POST",
			"url":"ajax/tableClientes.ajax.php"
		},
		"columns":[
		{ "data": "id"},
		{ "data": "nombre"}, 
		{ "data": "area"}, 
		{ "data": "dni"},
		{ "data": "email"},
		{ "data": "telefono"},	
		{ "data": "direccion"},	
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
    EditarClientes(".tablaClientes", table);
    EliminarClientes(".tablaClientes", table);

}



var EditarClientes = function(tbody, table){

	$(tbody).on( 'click', 'button.editarClientes', function (){

	 

		var idCliente = $(this).attr('idCliente');

		var datos = new FormData();

		datos.append('idCliente', idCliente);

		$.ajax({

			url:"ajax/clientes.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function(respuesta){


				$('#editarCliente').val(respuesta['nombre']);
				$('#editarAreaCliente').val(respuesta['id_area']);
				$('#idCliente').val(respuesta['id']);
				$('#editarDocumentoID').val(respuesta['documentoID']);
				$('#editarEmail').val(respuesta['email']);
				$('#editarTelefono').val(respuesta['telefono']);
				$('#editarDirecciónCliente').val(respuesta['direccion']);

  

			}

		})

	})

}




/*=============================================
=            BORRAR CLIENTES         =
=============================================*/

var EliminarClientes = function(tbody, table){

	$('.tablaClientes tbody').on('click', 'button.eliminarClientes', function(){



		var idCliente = $(this).attr('idCliente');
		console.log("idCliente", idCliente);

		swal({

			title: "¿Está seguro de borrar al usuario?",
			text: "¡Si no lo esta puede cancelar la acción!",
			type: "warning",		
			showCancelButton: true,
			confirmButtonColor: "#3085d5",
			cancelButtonColor: "#d33",
			cancelButtonText: "Cancelar",		
			confirmButtonText: "Si, borrar usuario"		

		}).then((result) => {
			if (result.value) {

				window.location = "index.php?ruta=clientes&idCliente="+idCliente;

			}
		})
  

	})


}






/*$('#nombreClientePiso').change(function() {

	var cliente = $(this).val();
	console.log("cliente", cliente);

	var datos = new FormData();

	datos.append('cliente', cliente);

	$.ajax({

		url:"ajax/clientes.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){





		}

	})





});
*/



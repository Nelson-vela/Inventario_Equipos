

$(document).ready(function() {

	listarTablaGastosFijo()

});



var listarTablaGastosFijo = function(){

	var table = $('#tableGastosFijos').DataTable({
		"bDeferRender": true,   
		"sPaginationType": "full_numbers",
		responsive: true,
		"ajax": {
			"type":"POST",
			"url":"ajax/tablegastosfijos.ajax.php"
		},
		"columns":[
		{ "data": "id"},
		{ "data": "descripcion"}, 
		{ "data": "gastos"}, 
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
    EditarGastosFijos("#tableGastosFijos", table);
    EliminarGastosFijos("#tableGastosFijos", table);

}



/*=============================================
=           EDITAR USUARIO            =
=============================================*/


var EditarGastosFijos  = function(tbody, table){

	$(tbody).on( 'click', 'button.editarGastosFijos', function (){

		var idGastosFijos = $(this).attr('idGastosFijos'); 
		console.log("idGastosFijos", idGastosFijos);

		var datos = new FormData();
		datos.append("idGastosFijos", idGastosFijos);

		$.ajax({

			url:"ajax/gastosfijos.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function(respuesta){

			console.log("respuesta", respuesta);
			$('#editarDescripcionGastosFijos').val(respuesta['descripcion']);
			$("#editarMontoGastosFijos").val(respuesta["monto"]);

			$("#editarFechaGastosFijos").val(respuesta["fecha"]);			

			$("#idPresupuestoFijos").val(respuesta["id"]);			

		}

	});

	})

}



/*=============================================
=           ACTIVAR USUARIO      =
=============================================*/
/*var ActivadoDesactivado  = function(tbody, table){

 $(tbody).on( 'click', 'button.btnEstadoUsuario', function (){

	var idUsuario = $(this).attr("idUsuario");
	var estadoUsuario = $(this).attr("estadoUsuario");

	var datos = new FormData();

	datos.append("activarId", idUsuario);
	datos.append("activarUsuario", estadoUsuario);


	$.ajax({

		url:"ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){

		}
	})


	if (estadoUsuario == 0) {

		$(this).removeClass('btn-success');
		$(this).addClass('btn-danger');
		$(this).html('Desactivado');
		$(this).attr('estadoUsuario',1);

	}else{

		$(this).addClass('btn-success');
		$(this).removeClass('btn-danger');
		$(this).html('Activado');
		$(this).attr('estadoUsuario',0);

	}

	

})

}*/



/*=============================================
=         BORRAR USUARIO           =
=============================================*/

var EliminarGastosFijos  = function(tbody, table){

	$(tbody).on( 'click', 'button.eliminarGastosFijos', function (){

		var idGastosFijos = $(this).attr('idGastosFijos'); 
		console.log("idGastosFijos", idGastosFijos);

		swal({

			title: "¿Está seguro de borrar el gasto fijo?",
			text: "¡Si no lo esta puede cancelar la acción!",
			type: "warning",		
			showCancelButton: true,
			confirmButtonColor: "#3085d5",
			cancelButtonColor: "#d33",
			cancelButtonText: "Cancelar",		
			confirmButtonText: "Si, borrar gasto fijo"		

		}).then((result) => {
			if (result.value) {

				window.location = "index.php?ruta=gastos-fijos&idGastosFijos="+idGastosFijos;

			}
		})


	})

}



$('.input-daterange').datepicker({

	"locale": {
		"separator": " - ",
		"applyLabel": "Aplicar",
		"cancelLabel": "Cancelar",
		"fromLabel": "Desde",
		"toLabel": "Hasta",
		"customRangeLabel": "Custom",
		"daysOfWeek": [
		"Do",
		"Lu",
		"Ma",
		"Mi",
		"Ju",
		"Vi",
		"Sa"
		],
		"monthNames": [
		"Enero",
		"Febrero",
		"Marzo",
		"Abril",
		"Mayo",
		"Junio",
		"Julio",
		"Agosto",
		"Septiembre",
		"Octubre",
		"Noviembre",
		"Diciembre"
		],
		"firstDay": 1
	},

	format: "yyyy-mm-dd",
	autoclose: true

});

/*fetch_data('no');*/
$('#search').click(function(){

	var start_date = $('#start_date').val();
	console.log("start_date", start_date);

	var end_date = $('#end_date').val();
	console.log("end_date", end_date);

	if(start_date != '' && end_date !=''){

		var datos = new FormData();

		datos.append("inicioFecha", start_date);
		datos.append("finFecha", end_date);


		$.ajax({

			url:"ajax/presupuesto.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function(respuesta){

				var totalC = respuesta[0];

				var gastosTotal  =  Number($('#gastosTotal').html());
				var serviciosC =    Number(totalC).toFixed(2);


				var gananciaReal = serviciosC - gastosTotal;
				

				$('#serviciosCobrados').html("€ "+Number(totalC).toFixed(2));		
				$('#gananciasReal').html("€ "+Number(gananciaReal).toFixed(2));			
				

				
			}


			
		})


	}else{

		swal({



			type: "warning",

			title: "¡Debe seleccionar la fecha!",

			showConfirmButton: true,

			confirmButtonText: "Cerrar",

			closeOnConfirm: false

		})
	}
}); 
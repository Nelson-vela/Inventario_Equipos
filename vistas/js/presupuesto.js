

$(document).ready(function() {

	listarTablaPresupuesto()

});



var listarTablaPresupuesto = function(){

	var table = $('#tablePresupuesto').DataTable({
		"bDeferRender": true,   
		"sPaginationType": "full_numbers",
		responsive: true,
		"ajax": {
			"type":"POST",
			"url":"ajax/tablePresupuesto.ajax.php"
		},
		"columns":[
		{ "data": "id"},
		{ "data": "descripcion"}, 
		{ "data": "cantidad"}, 
		{ "data": "gastos"}, 
		{ "data": "gastoTotal"}, 
		{ "data": "fecha"},
		{ "data": "responsable"},
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
    EditarGastos("#tablePresupuesto", table);
    EliminarGastos("#tablePresupuesto", table);

}



/*=============================================
=           EDITAR USUARIO            =
=============================================*/


var EditarGastos  = function(tbody, table){

	$(tbody).on( 'click', 'button.editarGastos', function (){

		var idGastos = $(this).attr('idGastos'); 
		console.log("idGastos", idGastos);

		var datos = new FormData();
		datos.append("idGastos", idGastos);

		$.ajax({

			url:"ajax/presupuesto.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function(respuesta){

			//console.log("respuesta", respuesta);
			$('#editarDescripcionGastos').val(respuesta['descripcion']);

			$('#editarCantidadGastos').val(respuesta['cantidad']);

			$("#editarMontoGastos").val(respuesta["gastos"]);

			$("#editarMontoGastosTotal").val(respuesta["gastoTotal"]);

			$("#editaroFechaGastos").val(respuesta["fecha"]);	

			$("#editarResponsableGastos").val(respuesta["responsable"]);			

			$("#idPresupuesto").val(respuesta["id"]);			

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

var EliminarGastos  = function(tbody, table){

	$(tbody).on( 'click', 'button.eliminarGastos', function (){

		var idGastos = $(this).attr('idGastos'); 
		console.log("idGastos", idGastos);

		swal({

			title: "¿Está seguro de borrar la compra?",
			text: "¡Si no lo esta puede cancelar la acción!",
			type: "warning",		
			showCancelButton: true,
			confirmButtonColor: "#3085d5",
			cancelButtonColor: "#d33",
			cancelButtonText: "Cancelar",		
			confirmButtonText: "Si, borrar compra"		

		}).then((result) => {
			if (result.value) {

				window.location = "index.php?ruta=gastos&idGastos="+idGastos;

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




$("#nuevoMontoGastos").change(function() {
	
	var monto = $(this).val();

	var cantidad = $("#nuevoCantidadGastos").val();

	var total = Number(monto)*Number(cantidad);

	$("#nuevoMontoGastosTotal").val(total);


});


$("#nuevoCantidadGastos").change(function() {
	
	var cantidad = $(this).val();

	var monto = $("#nuevoMontoGastos").val();

	var total = Number(monto)*Number(cantidad);

	$("#nuevoMontoGastosTotal").val(total);




});






$("#editarMontoGastos").change(function() {
	
	var monto = $(this).val();

	var cantidad = $("#editarCantidadGastos").val();

	var total = Number(monto)*Number(cantidad);

	$("#editarMontoGastosTotal").val(total);


});


$("#editarCantidadGastos").change(function() {
	
	var cantidad = $(this).val();

	var monto = $("#editarMontoGastos").val();

	var total = Number(monto)*Number(cantidad);

	$("#editarMontoGastosTotal").val(total);




});



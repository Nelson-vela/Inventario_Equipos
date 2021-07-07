
/*=============================================
=            EDITAR CLIENTES         =
=============================================*/
var servicio = $(".tablaServicios").DataTable({
	
	 "ajax": "ajax/tablaServicios.ajax.php",
	 "deferRender": true,
	 "retrieve": true,
	 "processing": true,
	  "columnDefs": [

	 {
	 	"targets": -1,
	 	"data": null,
	 	"defaultContent": '<div class="btn-group"><button class="btn btn-warning btnEditarVenta" idVenta><i class="fa fa-pencil"></i></button><button class="btn btn-info btnEnviarCorreo" idClie><i class="fa fa-mail-forward"></i></button><button class="btn btn-success btnReporte" idClie><i class="fa fa-download"></i></button><button class="btn btn-danger btnEliminarVenta" idVenta><i class="fa fa-times"></i></button></div>'

	 },

	  {
	 	"targets": -2,
	 	"data": null,
	 	"defaultContent": '<div class="btn-group"><button class="btn btn-success btn-xs btnActivarServicio" idVenta estadoVenta>Cancelado</button></div>'

	 }


	 ],

	 
	 "language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
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

/*$(document).ready(function() {

$('.tablaServicios tbody').ready('button.btnActivarServicio', function(){

var data = servicio.row( $(this).parents('tr') ).data();

$('.btnActivarServicio').attr('estadoVenta', data[8])
	
})

})*/

 
/*=============================================
ACTIVAR LOS BOTONES CON LOS ID CORRESPONDIENTES
=============================================*/

$('.tablaServicios tbody').on('click', 'button', function () {
	
	var data = servicio.row( $(this).parents('tr') ).data();
	
	$(this).attr("idVenta", data[9])	
	$(this).attr("idClie", data[10])
	$(this).attr("estadoVenta", data[8])	
	/*$(this).attr("codigo", data[2])	
	$(this).attr("imagen", data[1])	*/

})


		/*=============================================
		=       BOTÓN EDITAR VENTA      =
		=============================================*/

		$('.ventas tbody').on('click', 'button.btnEditarVenta', function(){

			var idVenta = $(this).attr('idVenta');

			window.location = "index.php?ruta=editar-venta&idVenta="+idVenta;
		})


		/*=============================================
		=       BOTÓN CORREO     =
		=============================================*/
/*
		$('.tablaServicios tbody').on('click', 'button.btnEnviarCorreo', function(){

			var idClie = $(this).attr('idClie');

			window.location = "index.php?ruta=correo&idClie="+idClie;
		})
*/
		/*=============================================
		=       BOTÓN REPORTES     =
		=============================================*/

		$('.tablaServicios tbody').on('click', 'button.btnReporte', function(){

			var idClie = $(this).attr('idClie');

			window.location = "index.php?ruta=reporte&idClie="+idClie;
		})




		/*=============================================
		=       BOTÓN ELIMINAR VENTA      =
		=============================================*/


	$('.ventas tbody').on('click', 'button.btnEliminarVenta', function(){

			var idVenta = $(this).attr('idVenta');
			console.log("idVenta", idVenta);

			swal({

				title: "¿Está seguro de borrar la venta?",
				text: "¡Si no lo esta puede cancelar la acción!",
				type: "warning",		
				showCancelButton: true,
				confirmButtonColor: "#3085d5",
				cancelButtonColor: "#d33",
				cancelButtonText: "Cancelar",		
				confirmButtonText: "Si, borrar usuario"		

			}).then((result) => {
				if (result.value) {

					window.location = "index.php?ruta=ventas&idVenta="+idVenta;
				}
			})

			
		})



/*=============================================
=           ACTIVAR VENTA      =
=============================================*/


$('.ventas tbody').on('click', 'button.btnActivarServicio', function(){

	var idVenta = $(this).attr("idVenta");
	console.log("idVenta", idVenta);
	var estadoVenta = $(this).attr("estadoVenta");
	console.log("estadoVenta", estadoVenta);

	var datos = new FormData();

	datos.append("activarId", idVenta);
	datos.append("activarVenta", estadoVenta);


	$.ajax({

		url:"ajax/ventas.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){

		}
	})


	if (estadoVenta == 0) {

		$(this).removeClass('btn-success');
		$(this).addClass('btn-danger');
		$(this).html('Pendiente');
		$(this).attr('estadoVenta',1);

	}else{

		$(this).addClass('btn-success');
		$(this).removeClass('btn-danger');
		$(this).html('Cancelado');
		$(this).attr('estadoVenta',0);

	}

	

})


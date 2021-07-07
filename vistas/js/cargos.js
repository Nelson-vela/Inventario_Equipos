

$(document).ready(function() {

	listarTablaCargosE();

});



var listarTablaCargosE = function(){

	var table = $('#tablaCargosE').DataTable({
		"bDeferRender": true,   
		"sPaginationType": "full_numbers",
		responsive: true,
		"ajax": {
			"type":"POST",
			"url":"ajax/tableCargos.ajax.php"
		},
		"columns":[
		{ "data": "id"},
		{ "data": "codigo"}, 
		{ "data": "usuarioe"}, 
		{ "data": "usuarior"}, 
		{ "data": "area"}, 
		{ "data": "equipo"}, 
		{ "data": "fechaEntrega"}, 
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
    EditarCargo("#tablaCargosE", table);
    EliminarCargo("#tablaCargosE", table);

}








/*=============================================
=            BORRAR CLIENTES         =
=============================================*/

var EliminarCargo = function(tbody, table){

	/*$('#tablaCargosE tbody').on('click', 'button.eliminarCargo', function(){*/
		$(tbody).on( 'click', 'button.eliminarCargo', function (){




		var idCargo = $(this).attr('idCargo');
		console.log("idCargo", idCargo);

		swal({

			title: "¿Está seguro de borrar el cargo?",
			text: "¡Si no lo esta puede cancelar la acción!",
			type: "warning",		
			showCancelButton: true,
			confirmButtonColor: "#3085d5",
			cancelButtonColor: "#d33",
			cancelButtonText: "Cancelar",		
			confirmButtonText: "Si, borrar cargo"		

		}).then((result) => {
			if (result.value) {

				window.location = "index.php?ruta=administrar-cargos&idCargo="+idCargo;

			}
		})
  

	})


}




var EditarCargo = function(tbody, table){

	$(tbody).on( 'click', 'button.editarCargo', function (){

	 

		var idCargo = $(this).attr('idCargo');

		var datos = new FormData();

		datos.append('idCargo', idCargo);

		$.ajax({

			url:"ajax/cargos.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function(respuesta){


				$('#editarCargoEquipo').val(respuesta['id_equipo']);
				$('#editarCargoUsuario').val(respuesta['id_cliente']);
				$('#idCargoE').val(respuesta['id']);
				$('#editarFechaEquipoCargo').val(respuesta['fechaEntrega']);
				$('#editarhoraEntregaCargo').val(respuesta['horaEntrega']);
				$('#editarCargoUsuarioEntrega').val(respuesta['id_clienteEntrega']);
		
		

  

			}

		})

	})

}



/*=============================================
RANGO DE FECHAS
=============================================*/

$('#daterange-btn').daterangepicker(
  {
    ranges   : {
      'Hoy'       : [moment(), moment()],
      'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Últimos 7 días' : [moment().subtract(6, 'days'), moment()],
      'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
      'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
      'Último mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment(),
    endDate  : moment()
  },
  function (start, end) {
    $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var fechaInicial = start.format('YYYY-MM-DD');

    var fechaFinal = end.format('YYYY-MM-DD');
     

    var capturarRango = $("#daterange-btn span").html();
   
   	localStorage.setItem("capturarRango", capturarRango);

   	window.location = "index.php?ruta=administrar-cargos&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

  }

)


/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/

$(".daterangepicker.opensleft .range_inputs .cancelBtn").on("click", function(){

	localStorage.removeItem("capturarRango");
	localStorage.clear();
	window.location = "administrar-cargos";
})

/*=============================================
CAPTURAR HOY
=============================================*/

$(".daterangepicker.opensleft .ranges li").on("click", function(){

	var textoHoy = $(this).attr("data-range-key");

	if(textoHoy == "Hoy"){

		var d = new Date();
		
		var dia = d.getDate();
		var mes = d.getMonth()+1;
		var año = d.getFullYear();

		if(mes < 10){

			var fechaInicial = año+"-0"+mes+"-"+dia;
			var fechaFinal = año+"-0"+mes+"-"+dia;

		}else if(dia < 10){

			var fechaInicial = año+"-"+mes+"-0"+dia;
			var fechaFinal = año+"-"+mes+"-0"+dia;

		}else if(mes < 10 && dia < 10){

			var fechaInicial = año+"-0"+mes+"-0"+dia;
			var fechaFinal = año+"-0"+mes+"-0"+dia;

		}else{

			var fechaInicial = año+"-"+mes+"-"+dia;
	    	var fechaFinal = año+"-"+mes+"-"+dia;

		}

		dia = ("0"+dia).slice(-2);
		mes = ("0"+mes).slice(-2);

		var fechaInicial = año+"-"+mes+"-"+dia;
		var fechaFinal = año+"-"+mes+"-"+dia;	

    	localStorage.setItem("capturarRango", "Hoy");

    	window.location = "index.php?ruta=administrar-cargos&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

	}

})
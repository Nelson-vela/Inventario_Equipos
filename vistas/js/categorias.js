
/*=============================================
=            EDITAR CLIENTES         =
=============================================*/
var categorias = $(".tablaCategorias").DataTable({
	
	"ajax": "ajax/tablaCategorias.ajax.php",
	"deferRender": true,
	"retrieve": true,
	"processing": true,
	"columnDefs": [

	{
		"targets": -1,
		"data": null,
		"defaultContent": '<div class="btn-group"><button class="btn btn-warning btn-xs btnEditarCategoria" idCategoria data-toggle="modal" data-target="#modalEditarCategoria"><i class="fa fa-pencil"></i></button><button class="btn btn-danger btn-xs btnEliminarCategoria" idCategoria><i class="fa fa-times"></i></button></div>'

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

/*=============================================
ACTIVAR LOS BOTONES CON LOS ID CORRESPONDIENTES
=============================================*/

$('.tablaCategorias tbody').on( 'click', 'button', function () {
	
	var data = categorias.row( $(this).parents('tr') ).data();
	
	$(this).attr("idCategoria", data[2])	
	/*$(this).attr("codigo", data[2])	
	$(this).attr("imagen", data[1])	*/

})



$('.tablaCategorias tbody').on('click', 'button.btnEditarCategoria', function(){

	var idCategoria = $(this).attr('idCategoria');

		//console.log("idCategoria", idCategoria);
		
		var datos = new FormData();
		datos.append("idCategoria", idCategoria);

		$.ajax({

			url:"ajax/categorias.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function(respuesta){

			//console.log("respuesta", respuesta);
			$('#editarCategoria').val(respuesta['categoria']);
			$('#idCategoria').val(respuesta['id']);


		}


	})


	})



$('.tablaCategorias tbody').on('click', 'button.btnEliminarCategoria', function(){


	var idCategoria = $(this).attr('idCategoria');
	//console.log("idCategoria", idCategoria);
	
	swal({

		title: "¿Está seguro de borrar la categoría?",
		text: "¡Si no lo esta puede cancelar la acción!",
		type: "warning",		
		showCancelButton: true,
		confirmButtonColor: "#3085d5",
		cancelButtonColor: "#d33",
		cancelButtonText: "Cancelar",		
		confirmButtonText: "Si, borrar categoría"		
		
	}).then((result) => {
		if (result.value) {

			window.location = "index.php?ruta=categorias&idCategoria="+idCategoria;

		}
	})



})
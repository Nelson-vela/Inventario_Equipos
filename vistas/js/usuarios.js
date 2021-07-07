/*=============================================
=           SUBIENDO FOTO           =
=============================================*/

$('.nuevaFoto').change(function(){

	var imagen = this.files[0];


/*=============================================
=           VALIDANDO EL FORTMATO DE LA FOTO           =
=============================================*/

if (imagen['type'] != "image/jpeg" && imagen['type'] != "image/png" ) {

	$('.nuevaFoto').val('');

	swal({

		text: 'Error al subir la imagen',		
		title: "¡La imagen debe estar en formato JPEG o PNG!",
		type: "error",
		confirmButtonText: "¡Cerrar!"				

	});

}else if (imagen['size'] > 2000000 ) {

	$('.nuevaFoto').val('');

	swal({

		text: 'Error al subir la imagen',		
		title: "¡La imagen no debe pesar más de 2mb!",
		type: "error",
		confirmButtonText: "¡Cerrar!"				

	});


}else{

	var datosImagen = new FileReader;
	datosImagen.readAsDataURL(imagen);

	$(datosImagen).on('load', function(event){

		var rutaImagen = event.target.result;

		$('.previsualizar').attr('src', rutaImagen);


	})


}

})


$(document).ready(function() {

 listarTablaUsuarios()

});



var listarTablaUsuarios = function(){

    var table = $('#tableUsuarios').DataTable({
     "bDeferRender": true,   
     "sPaginationType": "full_numbers",
     responsive: true,
     "ajax": {
      "type":"POST",
      "url":"ajax/tablaUsuarios.ajax.php"
  },
  "columns":[
  { "data": "id"},
  { "data": "nombre"}, 
  { "data": "usuario"}, 
  { "data": "foto"},                
  { "data": "perfil"},                
  { "data": "estado"},                
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
    ActivadoDesactivado("#tableUsuarios", table);
    EditarUsuario("#tableUsuarios", table);
     EliminarUsuario("#tableUsuarios", table);

}



/*=============================================
=           EDITAR USUARIO            =
=============================================*/


var EditarUsuario  = function(tbody, table){

 $(tbody).on( 'click', 'button.editarUsuario', function (){

	var idUsuario = $(this).attr('idUsuario'); 
	console.log("idUsuario", idUsuario);
	
	var datos = new FormData();
	datos.append("idUsuario", idUsuario);

	$.ajax({

		url:"ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			//console.log("respuesta", respuesta);
			$('#editarNombre').val(respuesta['nombre']);
			$("#editarUsuario").val(respuesta["usuario"]);

			$("#editarPerfil").html(respuesta["perfil"]);
			$("#editarPerfil").val(respuesta["perfil"]);

			$("#fotoActual").val(respuesta["foto"]);
			
			$("#passwordActual").val(respuesta["password"]);

			$("#idUsuario").val(respuesta["id"]);

			if(respuesta["foto"] != ""){

				$(".previsualizar").attr("src", respuesta["foto"]);

			}

		}

	});

})

}



/*=============================================
=           ACTIVAR USUARIO      =
=============================================*/
var ActivadoDesactivado  = function(tbody, table){

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

}
/*=============================================
=           VALIDAR NOMBRE QUE NO SE REPITA           =
=============================================*/


$('#nuevoUsuario').change(function(){

	$('.alert').remove();

	var usuario = $(this).val();

	var datos = new FormData();

	datos.append('validarUsuario', usuario);

	$.ajax({

		url:"ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			if (respuesta) {

				$('#nuevoUsuario').parent().after('<div class="alert alert-warning">El usuario ya existe </div>');

				$('#nuevoUsuario').val('');

			}



		}
	})



})




/*=============================================
=         BORRAR USUARIO           =
=============================================*/

var EliminarUsuario  = function(tbody, table){

 $(tbody).on( 'click', 'button.eliminarUsuario', function (){

	var idUsuario = $(this).attr('idUsuario');
	var fotoUsuario = $(this).attr('fotoUsuario');
	var nombre = $(this).attr('nombre');

	swal({

		title: "¿Está seguro de borrar el usuario?",
		text: "¡Si no lo esta puede cancelar la acción!",
		type: "warning",		
		showCancelButton: true,
		confirmButtonColor: "#3085d5",
		cancelButtonColor: "#d33",
		cancelButtonText: "Cancelar",		
		confirmButtonText: "Si, borrar usuario"		
		
	}).then((result) => {
		if (result.value) {

			window.location = "index.php?ruta=usuarios&idUsuario="+idUsuario+"&nombreborrar="+nombre+"&fotoUsuario="+fotoUsuario;

		}
	})


})

}
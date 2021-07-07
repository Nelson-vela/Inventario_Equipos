/*=============================================
CAPTURAR LA CATEGORIA PARA ASIGNAR CODIGO
=============================================*/

$('#nuevaCategoria').change(function(){

	var idCategoria = $(this).val();
	//console.log("idCategoria", idCategoria);
	
	var datos = new FormData();
	datos.append("idCategoria", idCategoria);   //CAPTURAMOS LA CATEGORIA NO EL ID

	$.ajax({

		url:"ajax/productos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			if (!respuesta) {

				var nuevoCodigo = idCategoria+"01";
				$('#nuevoCodigo').val(nuevoCodigo);

			}else{

				var nuevoCodigo = Number(respuesta['codigo'])+1;
				//console.log("nuevoCodigo", nuevoCodigo);

				$('#nuevoCodigo').val(nuevoCodigo);

			}

		}


	})

})

/*=============================================
AGREGAR PRECIO  DE VENTA
=============================================*/

$('#nuevoPrecioCompra').change(function(){   //cuando sufra un cambio en su entrada

	if ($('.porcentaje').prop("checked")) {

		var valorPorcentaje = $('.nuevoPorcentaje').val();


		var porcentaje = $('#nuevoPrecioCompra').val() * valorPorcentaje/100; 

		var precioVenta =  Number($('#nuevoPrecioCompra').val())+porcentaje;

		$('#nuevoPrecioVenta').val(precioVenta);
		$('#nuevoPrecioVenta').prop("readonly", true);

	}

})

/*=============================================
CAMBIO DE PORCENTAJE
=============================================*/


$('.nuevoPorcentaje').change(function(){   //cuando sufra un cambio en su input

	if ($('.porcentaje').prop("checked")) {

		var valorPorcentaje = $('.nuevoPorcentaje').val();


		var porcentaje = $('#nuevoPrecioCompra').val() * valorPorcentaje/100; 

		var precioVenta =  Number($('#nuevoPrecioCompra').val())+porcentaje;

		$('#nuevoPrecioVenta').val(precioVenta);
		$('#nuevoPrecioVenta').prop("readonly", true);


	}

})

/*=============================================
DESBLOQUEAR EL PRECIO VENTA SI EL CHECKED ESTA ACTIVADO PORCENTAJE
=============================================*/


$('.porcentaje').on("ifUnchecked", function(){

	$('#nuevoPrecioVenta').prop("readonly", false);
	$('#editarPrecioVenta').prop("readonly", false);

})

/*=============================================
BLOQUEAR EL PRECIO VENTA SI EL CHECKED ESTA ACTIVADO PORCENTAJE
=============================================*/

$('.porcentaje').on("ifChecked", function(){

	$('#nuevoPrecioVenta').prop("readonly", true);
	$('#editarPrecioVenta').prop("readonly", true);

})




/*=============================================
=           SUBIENDO FOTO           =
=============================================*/

$('.nuevaImagen').change(function(){

	var imagen = this.files[0];


/*=============================================
=           VALIDANDO EL FORTMATO DE LA FOTO           =
=============================================*/

if (imagen['type'] != "image/jpeg" && imagen['type'] != "image/png" ) {

	$('.nuevaImagen').val('');

	swal({

		text: 'Error al subir la imagen',		
		title: "¡La imagen debe estar en formato JPEG o PNG!",
		type: "error",
		confirmButtonText: "¡Cerrar!"				

	});

}else if (imagen['size'] > 2000000 ) {

	$('.nuevaImagen').val('');

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







/********************************************************************************************************/
/********************************************************************************************************/
/********************************************************************************************************/




/*=============================================
=           EDITAR PRODUCTO           =
=============================================*/

$('.tablaProductos tbody').on('click', 'button.btnEditarProducto', function(){

	var idProducto = $(this).attr('idProducto');
	
	var datos = new FormData();

	datos.append('idProducto', idProducto);

	$.ajax({

		url:"ajax/productos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			var datosCategoria = new FormData();
			datosCategoria.append('idCategoria', respuesta['id_categoria']); 


			$.ajax({

				url:"ajax/categorias.ajax.php",
				method: "POST",
				data: datosCategoria,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(respuesta){				 


					$('#editarCategoria').val(respuesta['id']);
					$('#editarCategoria').html(respuesta['categoria']);

				}


			})

			$('#editarCodigo').val(respuesta['codigo']);
			$('#editarDescripcion').val(respuesta['descripcion']);
			$('#editarStock').val(respuesta['stock']);
			$('#editarPrecioCompra').val(respuesta['precio_compra']);
			$('#editarPrecioVenta').val(respuesta['precio_venta']);
			$('#idEditar').val(respuesta['id']);

			if (respuesta['imagen'] !="") {

				$('#imagenActual').val(respuesta['imagen']);

				$(".previsualizar").attr("src", respuesta['imagen']);


			}

		}

	}) 

})




/*=============================================
EDITAR PRECIO  DE VENTA
=============================================*/

$('#editarPrecioCompra').change(function(){   //cuando sufra un cambio en su entrada

	if ($('.porcentaje').prop("checked")) {

		var valorPorcentaje = $('.editarPorcentaje').val();


		var porcentaje = $('#editarPrecioCompra').val() * valorPorcentaje/100; 

		var precioVenta =  Number($('#editarPrecioCompra').val())+porcentaje;

		$('#editarPrecioVenta').val(precioVenta);
		$('#editarPrecioVenta').prop("readonly", true);

	}

})

/*=============================================
CAMBIO DE PORCENTAJE
=============================================*/


$('.editarPorcentaje').change(function(){   //cuando sufra un cambio en su input

	if ($('.porcentaje').prop("checked")) {

		var valorPorcentaje = $('.editarPorcentaje').val();


		var porcentaje = $('#editarPrecioCompra').val() * valorPorcentaje/100; 

		var precioVenta =  Number($('#editarPrecioCompra').val())+porcentaje;

		$('#editarPrecioVenta').val(precioVenta);
		$('#editarPrecioVenta').prop("readonly", true);


	}

})


/*=============================================
=           EDITAR FOTO           =
=============================================*/

$('.editarImagen').change(function(){

	var imagen = this.files[0];


/*=============================================
=           VALIDANDO EL FORTMATO DE LA FOTO           =
=============================================*/

if (imagen['type'] != "image/jpeg" && imagen['type'] != "image/png" ) {

	$('.editarImagen').val('');

	swal({

		text: 'Error al subir la imagen',		
		title: "¡La imagen debe estar en formato JPEG o PNG!",
		type: "error",
		confirmButtonText: "¡Cerrar!"				

	});

}else if (imagen['size'] > 2000000 ) {

	$('.editarImagen').val('');

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















/********************************************************************************************************/
/********************************************************************************************************/
/********************************************************************************************************/



$('.tablaProductos tbody').on('click', 'button.btnEliminarProducto', function(){


	var idProducto = $(this).attr('idProducto');
	var imagen = $(this).attr('imagen');
	var codigo = $(this).attr('codigo');
	console.log("codigo", codigo);
	console.log("imagen", imagen);
	console.log("idProducto", idProducto);

	swal({

		title: "¿Está seguro de borrar el servicio?",
		text: "¡Si no lo esta puede cancelar la acción!",
		type: "warning",		
		showCancelButton: true,
		confirmButtonColor: "#3085d5",
		cancelButtonColor: "#d33",
		cancelButtonText: "Cancelar",		
		confirmButtonText: "Si, borrar servicio"		
		
	}).then((result) => {
		if (result.value) {

			window.location = "index.php?ruta=productos&idProducto="+idProducto+"&codigoborrar="+codigo+"&imagen="+imagen;

		}
	})


})
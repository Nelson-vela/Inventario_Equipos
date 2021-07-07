$(document).ready(function() {

 listarProductos()

});




var table2 = $('.tablaVentas').DataTable({


	"ajax": "ajax/DataTable-ventas.ajax.php",
	"columnDefs": [

	{
		"targets": -5,
		"data": null,
		"defaultContent": '<img class="img-thumbnail imgTablaVenta" width="40px">'

	},

	{
		"targets": -1,
		"data": null,
		"defaultContent": '<div class="btn-group"><button class="btn btn-primary agregarProducto recuperarBoton" idProducto >Agregar</button></div>'

	},

	{
		"targets": -2,
		"data": null,
		"defaultContent": '<div class="btn-group"><button class="btn btn-success limiteStock"></button></div>'

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

})



/*=============================================
ACTIVAR LOS BOTONES CON LOS ID CORRESPONDIENTES
=============================================*/

$('.tablaVentas tbody').on( 'click', 'button.agregarProducto', function () {

	var data = table2.row( $(this).parents('tr') ).data();
	
	$(this).attr("idProducto", data[5])
	// $(this).attr("codigo", data[3])	
	// $(this).attr("imagen", data[4])	
	

})



		/*=============================================
	=         CARGAR IMAGENES TABLA DINÁMICA        =
	=============================================*/



	function cargarImagenesProductos(){

		var imgTabla = $('.imgTablaVenta');
		var limiteStock = $('.limiteStock');

		for(var i = 0; i < imgTabla.length; i ++){

			var data = table2.row( $(imgTabla[i]).parents("tr")).data();	

			$(imgTabla[i]).attr("src", data[1]);

			if (data[4] <= 10) {

				$(limiteStock[i]).addClass("btn-danger");
				$(limiteStock[i]).html(data[4]);


			}else if(data[4] > 11 && data[4]<=15){

				$(limiteStock[i]).addClass("btn-warning");
				$(limiteStock[i]).html(data[4]);

			}else{

				$(limiteStock[i]).addClass("btn-succes");
				$(limiteStock[i]).html(data[4]);

			}

		}



	}


	/*=============================================
	=         CARGAR IMAGENES CUANDO SE INICIA POR PRIMERA VEZ        =
	=============================================*/

	setTimeout(function(){

		cargarImagenesProductos();

	},100)

	/*=============================================
CARGAMOS LAS IMÁGENES CUANDO INTERACTUAMOS CON EL FILTRO DE CANTIDAD
=============================================*/

$("select[name='DataTables_Table_0_length']").change(function(){

	cargarImagenesProductos();

})


	/*=============================================
	=         CARGAR IMAGENES CUANDO INTERACTUAMOS CON EL BUSCADOR        =
	=============================================*/

	$("input[aria-controls='DataTables_Table_0']").focus(function(){

		$(document).keyup(function(event){

			event.preventDefault();
			cargarImagenesProductos();


		})

	})


/*=============================================
	=         CARGAR IMAGENES CUANDO INTERACTUAMOS CON EL PAGINADO        =
	=============================================*/


	$('.dataTables_paginate').click(function(){

		cargarImagenesProductos();
	})


	/*=============================================
CARGAMOS LAS IMÁGENES CUANDO INTERACTUAMOS CON EL FILTRO DE ORDENAR
=============================================*/

$(".sorting").click(function(){

	
	cargarImagenesProductos();

})



	/*=============================================
AGREGANDO PRODUCTO A LA TABLA 
=============================================*/


$('.tablaVentas tbody').on('click', 'button.agregarProducto', function(){

	var idProducto = $(this).attr('idProducto');
	//console.log("idProducto", idProducto);

	$(this).removeClass('btn-primary agregarProducto');

	$(this).addClass('btn-default');

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
			//console.log("respuesta", respuesta);

			var descripcion = respuesta['descripcion'];
			var precio = respuesta['precio_venta'];
			var stock = respuesta['stock'];


			//$('#agregarProducto').val(descripcion);


			$('.nuevoProducto').append(

				'<div class="row" style="padding: 5px 15px">'+

				'<!-- Descripción del producto -->'+

				'<div class="col-xs-6" style="padding-right:0px">'+

				'<div class="input-group">'+

				'<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProducto+'"><i class="fa fa-times"></i></button></span>'+

				'<input type="text" class="form-control nuevaDescripcionProducto" id="agregarProducto" name="agregarProducto" idProducto="'+idProducto+'" placeholder="Descripción del producto" value="'+descripcion+'" readonly required>'+

				'</div>'+

				'</div>'+

				'<!-- Cantidad del producto -->'+

				'<div class="col-xs-3">'+

				'<input type="number" class="form-control nuevaCantidadProducto" id="nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="'+stock+'" nuevoStock = "'+Number(stock-1)+'" required>'+

				'</div>'+ 

				'<!-- Precio del producto -->'+

				'<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+

				'<div class="input-group">'+

				'<span class="input-group-addon"><i class="fa fa-euro"></i></span>'+

				'<input type="text" class="form-control nuevoPrecioProducto" id="nuevoPrecioProducto" name="nuevoPrecioProducto" precioReal="'+precio+'" value="'+precio+'" readonly required>'+

				'</div>'+

				'</div>'+

				'</div>'  

				)

			sumarTotalPrecio()

			//agregarPrecioIng()

			agregarImpuesto() 

			listarProductos()

			

			// FORMATO DE PRECIO A MONEDA
			$('.nuevoPrecioProducto').number(true, 2);
			
		}

	})


})

/*=============================================
=         QUITAR PRODUCTO DE LA VENTA Y RECUPERAR BOTON          =
=============================================*/


$('.formularioVentas').on('click', 'button.quitarProducto', function(){	 

	$(this).parent().parent().parent().parent().remove();

	var idProducto = $(this).attr('idProducto');

	$('button.recuperarBoton[idProducto = "'+idProducto+'"]').removeClass('btn-default');
	$('button.recuperarBoton[idProducto = "'+idProducto+'"]').addClass('btn-primary agregarProducto');

	if ($('.nuevoProducto').children().length == 0) {

		$('#nuevoTotalVenta').val(0);
		$('#totalVenta').val(0);
		$('#nuevoImpuestoVenta').val(0);
		$('#nuevoTotalVenta').attr('total', 0);

	}else{

		sumarTotalPrecio()

		//agregarPrecioIng()

		agregarImpuesto()

		listarProductos()

		


	}

	
})



/*=============================================
=         AGREGAR PRODUCTO DESDE LOS DISPOSITIVOS         =
=============================================*/


$('.btnAgregarProducto').click(function(){

	var datos = new FormData();

	datos.append('traerProductos', 'ok');

	$.ajax({

		url:"ajax/productos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			//console.log("respuesta", respuesta);
			
			$('.nuevoProducto').append(

				'<div class="row" style="padding: 5px 15px">'+

				'<!-- Descripción del producto -->'+

				'<div class="col-xs-6" style="padding-right:0px">'+

				'<div class="input-group">'+

				'<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto><i class="fa fa-times"></i></button></span>'+

				'<select class="form-control nuevaDescripcionProducto agregarProducto" idProducto name="nuevaDescripcionProducto" required>'+

				'<option>Seleccione el productos </option>'+

				'</select>'+

				'</div>'+

				'</div>'+

				'<!-- Cantidad del producto -->'+

				'<div class="col-xs-3 ingresoCantidad">'+

				'<input type="number" class="form-control nuevaCantidadProducto" id="nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock nuevoStock required>'+

				'</div>'+ 

				'<!-- Precio del producto -->'+

				'<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+

				'<div class="input-group">'+

				'<span class="input-group-addon"><i class="fa fa-euro"></i></span>'+

				'<input type="text"  class="form-control nuevoPrecioProducto" id="nuevoPrecioProducto" precioReal name="nuevoPrecioProducto" readonly required>'+

				'</div>'+

				'</div>'+

				'</div>'  

				)




			/*=============================================
				=         AGREGAR PRODUCTO AL SELECT       =
				=============================================*/

				respuesta.forEach(funcionForEach);

				function funcionForEach(item, index){

					$('.nuevaDescripcionProducto').append(


						'<option idProducto="'+item.id+'" value="'+item.descripcion+'">'+item.descripcion+'</option>'

						)

				}	

				sumarTotalPrecio()

				//agregarPrecioIng()

				agregarImpuesto()

				

				

					// FORMATO DE PRECIO A MONEDA
					$('.nuevoPrecioProducto').number(true, 2);

				}


			})


})


		/*=============================================
		=         SELLECCIONAR PRODUCTO       =
		=============================================*/


		$('.formularioVentas').on('change', 'select.nuevaDescripcionProducto', function(){	 


			var nombreProducto = $(this).val();
			//console.log("nombreProducto", nombreProducto);
			

			var nuevoPrecioProducto = $(this).parent().parent().parent().children('.ingresoPrecio').children().children('.nuevoPrecioProducto');
			var nuevaCantidadProducto = $(this).parent().parent().parent().children('.ingresoCantidad').children('#nuevaCantidadProducto');
			

			var datos = new FormData();

			datos.append('nombreProducto', nombreProducto);

			$.ajax({

				url:"ajax/productos.ajax.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(respuesta){
					//console.log("respuesta", respuesta);
					

					$(nuevoPrecioProducto).val(respuesta['precio_venta']);
					$(nuevoPrecioProducto).attr('precioReal', respuesta['precio_venta']);
					$(nuevaCantidadProducto).attr('stock', respuesta['stock']);
					$(nuevaCantidadProducto).attr('nuevoStock', Number(respuesta['stock'])-1);

					listarProductos()


				}

			})


		})



		/*=============================================
		=         MODIFICA LA CANTIDAD       =
		=============================================*/

		$('.formularioVentas').on('change', 'input.nuevaCantidadProducto', function(){	//mo



			var precio = $(this).parent().parent().children('.ingresoPrecio').children().children('.nuevoPrecioProducto');
			//console.log("precio", precio);	 

			precioFinal = $(this).val() * precio.attr('precioReal');	

			precio.val(precioFinal);

			var nuevoStock = Number($(this).attr('stock')) - $(this).val();

			$(this).attr('nuevoStock', nuevoStock);

			if (Number($(this).val()) > Number($(this).attr('stock'))) {

				swal({

					title: "La cantidad supera el stock",
					text: "¡Sólo hay "+$(this).attr("stock")+" unidades!",
					type: "error",		 	
					confirmButtonText: "Cerrar"		

				})

			}

			sumarTotalPrecio() 

			//agregarPrecioIng();  

			agregarImpuesto()

			listarProductos()

			

		})


		/*=============================================
		=         	SUMAR TOTAL PRECIO    =
		=============================================*/


		function sumarTotalPrecio(){

			var precioItem = $('.nuevoPrecioProducto');

			var arraySumarPrecio = [];

			for (var i = 0; i < precioItem.length; i++){

				arraySumarPrecio.push(Number($(precioItem[i]).val()));
				

			}

			function sumarArrayPrecio(total, numero){

				return total+numero;


			}

			var sumaTotalPrecio = arraySumarPrecio.reduce(sumarArrayPrecio)
			
			$('#nuevoTotalVenta').val(sumaTotalPrecio);
			$('#totalVenta').val(sumaTotalPrecio);
			$('#nuevoTotalVenta').attr('total', sumaTotalPrecio);
		}



		/*=============================================
		=         	AGREGAR IMPUESTOS     =
		=============================================*/ 

		function agregarImpuesto(){

			var impuesto = $('#nuevoImpuestoVenta').val();

			//var precioTotal = $('#nuevoTotalVenta').attr('total')
			var precioTotal = $('#nuevoTotalVenta').attr('total')
		 

			var precioImpuesto = Number(precioTotal*impuesto/100);


			var totalConImpuesto = Number(precioImpuesto)+Number(precioTotal);

			$('#nuevoTotalVenta').val(totalConImpuesto);
			$('#totalVenta').val(totalConImpuesto);
			$('#nuevoPrecioImpuesto').val(precioImpuesto);
			$('#nuevoPrecioNeto').val(precioTotal);

		}

		/*=============================================
		=        CUANDO CAMBIA EL IMPUESTO         =
		=============================================*/

		$('#nuevoImpuestoVenta').change(function(){

			agregarImpuesto()




		})


		/*=============================================
		=         	AGREGAR pecio     =
		=============================================*/ 

		function agregarPrecioIng(){

			var precioIng = $('#precioIng').val();

			var precioTotal = $('#nuevoTotalVenta').attr('total')

			var precioGeneral = Number(precioTotal)+Number(precioIng);


			//var totalConImpuesto = Number(precioImpuesto)+Number(precioTotal);

			$('#nuevoTotalVenta').val(precioGeneral);
			$('#totalVenta').val(precioGeneral);

			//$('#nuevoPrecioImpuesto').val(precioImpuesto);
			$('#nuevoPrecioNeto').val(precioGeneral);

		}


		/*=============================================
		=        CUANDO CAMBIA EL PRECIO         =
		=============================================*/


		$('#precioIng').change(function() {
			
			//agregarPrecioIng();

		});

		/*=============================================
		=        FORMATO DE PRECIO A MONEDA        =
		=============================================*/
		
		$('#nuevoTotalVenta').number(true, 2);


	/*=============================================
		=       SELECCIONAR MÉTODO DE PAGO        =
		=============================================*/

		$('#nuevoMetodoPago').change(function(){

			var metodo = $(this).val();

			if (metodo == 'Efectivo') {

				$(this).parent().parent().removeClass('col-xs-6');
				$(this).parent().parent().addClass('col-xs-4');

				$(this).parent().parent().parent().children('.cajasMetodoPago').html(

					'<div class="col-xs-4">'+

					'<div class="input-group">'+

					'<span class="input-group-addon"><i class="fa fa-euro"></i></span>'+

					'<input type="text" class="form-control nuevoValorEfectivo" placeholder="00000"  required>'+

					'</div>'+

					'</div>'+

					'<div class="col-xs-4 capturarCambioEfectivo" style="padding-left:0px">'+

					'<div class="input-group">'+

					'<span class="input-group-addon"><i class="fa fa-euro"></i></span>'+

					'<input type="text" class="form-control nuevoCambioEfectivo" name="nuevoCambioEfectivo" placeholder="00000" readonly required>'+

					'</div>'+

					'</div>'	

					)


		/*=============================================
		=        FORMATO DE PRECIO A MONEDA        =
		=============================================*/
		
		$('.nuevoCambioEfectivo').number(true, 2);
		$('.nuevoValorEfectivo').number(true, 2);

		listaMetodoPago()

	}else{

		$(this).parent().parent().removeClass('col-xs-4');
		$(this).parent().parent().addClass('col-xs-6');

		$(this).parent().parent().parent().children('.cajasMetodoPago').html(

			'<div class="col-xs-6" style="padding-left:0px">'+

			'<div class="input-group">'+

			'<input type="text" class="form-control nuevoCodigoTransaccion" id="nuevoCodigoTransaccion" name="nuevoCodigoTransaccion" placeholder="Código transacción"  required>'+

			'<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+

			'</div>'+

			'</div>'

			)


	}


})

		/*=============================================
		=        CAMBIO EFECTIVO       =
		=============================================*/

		$('.formularioVentas').on('change', 'input.nuevoValorEfectivo', function(){	

			var efectivo = $(this).val();

			var cambio = Number(efectivo) - Number($('#nuevoTotalVenta').val());

			var nuevoCambioEfectivo = $(this).parent().parent().parent().children('.capturarCambioEfectivo').children().children('.nuevoCambioEfectivo');  

			nuevoCambioEfectivo.val(cambio);



		})


/*=============================================
		=        CAMBIO TRANSACCION       =
		=============================================*/

		$('.formularioVentas').on('change', 'input.nuevoCodigoTransaccion', function(){	

			listaMetodoPago()


		})





		/*=============================================
		=        LISTAR TODOS LOS PRODUCTOS      =
		=============================================*/

		function listarProductos(){


			var listarProductos = [];	

			var descripcion = $('.nuevaDescripcionProducto');

			var cantidad = $('.nuevaCantidadProducto');

			var precio = $('.nuevoPrecioProducto');

			for (var i = 0; i < descripcion.length; i++) {
				

				listarProductos.push({'id': $(descripcion[i]).attr('idProducto'),				
					'descripcion': $(descripcion[i]).val(),
					'cantidad': $(cantidad[i]).val(),
					'stock': $(cantidad[i]).attr('nuevoStock'),
					'precio': $(precio[i]).attr('precioReal'),
					'total': $(precio[i]).val()
				})



			}

			console.log("listarProductos", JSON.stringify(listarProductos));

			$('#listaProductos').val(JSON.stringify(listarProductos));
			
		}


		function listaMetodoPago(){


			if($('#nuevoMetodoPago').val() == 'Efectivo'){

				$('#listaMetodoPago').val('Efectivo');

			}else{

				$('#listaMetodoPago').val($('#nuevoMetodoPago').val()+'-'+$('.nuevoCodigoTransaccion').val());

			}

		} 



$(".piso").click(function() {
	
//$('seleccPiso').empty();

$('#seleccPiso option').remove();


	var id = $("#seleccionarCliente").val();
	console.log("id", id);


	var datos = new FormData();
		datos.append("idPiso", id);

		$.ajax({

			url:"ajax/pisos.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function(respuesta){

				
			respuesta.forEach(seleccionarPiso);

			function seleccionarPiso(item, index){


				var piso = item.piso;
				console.log("piso", piso);

				var direccion = item.direccion;
				console.log("direccion", direccion);

				var id = item.id;				

				$("#seleccPiso").append('<option value="'+direccion+'">'+piso+' - '+direccion+'</option>');				


			}			 		

		}

	});

});



$(".selectPiso").click(function(e) {
	
e.preventDefault();

	var direccion = $("#seleccPiso").val();
	
	$("#nuevaDireccion").val(direccion);


});




$("#seleccionarCliente").change(function() {



	var id = $(this).find(":selected").val();
	console.log("id", id);


	var datos = new FormData();
		datos.append("idCliente", id);

		$.ajax({

			url:"ajax/clientes.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function(respuesta){


		        $("#nuevaTelefono").val(respuesta['telefono']);
		        $("#nuevaEmail").val(respuesta['email']);
				
			/*respuesta.forEach(seleccionarPiso);

			function seleccionarPiso(item, index){


				var piso = item.piso;
				console.log("piso", piso);

				var direccion = item.direccion;
				console.log("direccion", direccion);

				var id = item.id;				

				$("#seleccPiso").append('<option value="'+direccion+'">'+piso+' - '+direccion+'</option>');				


			}	*/		 		

		}

	});



});
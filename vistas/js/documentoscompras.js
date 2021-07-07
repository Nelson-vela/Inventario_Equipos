 

$(document).ready(function() {

	listarTablaDocumentosCompras()

});



var listarTablaDocumentosCompras = function(){

	var table = $('#tableDocumentosCompras').DataTable({
		"bDeferRender": true,   
		"sPaginationType": "full_numbers",
		responsive: true,
		"ajax": {
			"type":"POST",
			"url":"ajax/tableDocumentosCompras.ajax.php"
		},
		"columns":[
		{ "data": "id"},		 
		{ "data": "proveedor"}, 
		{ "data": "tipo"},  
		{ "data": "numero"}, 
		{ "data": "fecha_emision"}, 
		{ "data": "fecha_almacenamiento"}, 
		{ "data": "total"}, 
		{ "data": "usuario_ingresado"}, 
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




/*=============================================
=      AGREGAR PRODUCTO AL DOCUEMENTO DE COMPRA    =
=============================================*/

/*================================
=            MOSTERAR LOS PRODUCTOS AGREGAADOS AL LOCALSTORAGE CUANDO SE RECARGA LA PÁGINA            =
================================*/



if(localStorage.getItem("listaProductos3") != null){

	var listaCarrito3 = JSON.parse(localStorage.getItem("listaProductos3"));
	console.log("listaCarrito3", listaCarrito3);

	listaCarrito3.forEach(funcionForEach2);

	function funcionForEach2(item2, index){  


		$('#listaProductoComprado').append(

			'<tr>'+

			'<td class="tituloP">'+item2.titulo+'</td>'+

			'<td class="cantidadP">'+item2.cantidad+'</td>'+

			'<td class="precioP" precioDocum="'+item2.precio+'"> S/ '+(Number(item2.precio).toFixed(2))+'</td>'+

			'<td class="totalP" totalDocum="'+item2.total+'"> S/ '+(Number(item2.total).toFixed(2))+'</td>'+



			'<td><button class="btn btn-danger btnEliminarProductoDocumento" titulo2="'+item2.titulo+'" ><i class="fa fa-times"></i></button></td>'+

			'</tr>',  

			)





	}

	sumarTotalPrecio()

     /* //agregarPrecioIng()

      agregarImpuesto() 

      listarProductos()*/

      listarProductosDocumento();
      
  }







/*================================
=            AGREGAR PRODUCTO A LA TABKA Y AL LOCALSTORAGE            =
================================*/




$("#modalAgregarGastos").on('click', 'button.btnAgregarProductoDocumento', function (e){

	e.preventDefault();


	var producto = $("#nuevoDescripcionGastos").val();
	var cantidad =  $("#nuevoCantidadGastos").val();
	var precio =  $("#nuevoMontoGastos").val();
	var total =  $("#nuevoMontoGastosTotal").val();


	if(producto != "" && cantidad != "" && precio != ""){


	}else{

		/*$("#nuevoDescripcionGastos").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> El campo <strong>direccion</strong>  es obligatorio</div>')*/

		swal({

			title: "¡Debe llenar todos los campos!",			 
			type: "warning",			 
			confirmButtonColor: "#3085d5",				 
			confirmButtonText: "Cerrar"		

		}) 

		return false;
	}



	$('#listaProductoComprado').append(

		'<tr>'+

		'<td class="tituloP">'+producto+'</td>'+

		'<td class="cantidadP">'+cantidad+'</td>'+

		'<td class="precioP" precioDocum="'+precio+'"> S/ '+(Number(precio).toFixed(2))+'</td>'+

		'<td class="totalP" totalDocum="'+total+'"> S/ '+(Number(total).toFixed(2))+'</td>'+



		'<td><button class="btn btn-danger btnEliminarProductoDocumento" titulo2="'+producto+'" ><i class="fa fa-times"></i></button></td>'+

		'</tr>',  

		)


	if(localStorage.getItem("listaProductos3") == null){

		listaCarrito3 = [];

	}else{

		var listaProductos3 = JSON.parse(localStorage.getItem("listaProductos3"));

  		/*for(var i = 0; i < listaProductos3.length; i++){


  		}*/

  		listaCarrito3.concat(localStorage.getItem("listaProductos3"));

  	}

  	listaCarrito3.push({"titulo":producto,
  		"cantidad":cantidad, 
  		"precio":precio,
  		"total":total});

  	localStorage.setItem("listaProductos3", JSON.stringify(listaCarrito3));

  //	listarProductosDocumento();
  listarProductosDocumento();
  sumarTotalPrecio()


  var producto = $("#nuevoDescripcionGastos").val('');
  var cantidad =  $("#nuevoCantidadGastos").val('');
  var precio =  $("#nuevoMontoGastos").val('');
  var total =  $("#nuevoMontoGastosTotal").val('');





});



/*================================
=   LISTAR PRODCUTOS PARA AHREGAR A LA BASE DE DATOS         =
================================*/




function listarProductosDocumento(){


	var listarProductos = []; 

	var titulo = $('.tituloP');

	var cantidad = $('.cantidadP');

	var precio = $('.precioP');

	var total = $('.totalP');

	for (var i = 0; i < titulo.length; i++) {


		listarProductos.push({'titulo': $(titulo[i]).html(),
			'cantidad': $(cantidad[i]).html(),
			'precio': $(precio[i]).attr("precioDocum"),
			'total': $(total[i]).attr("totalDocum")
		})



	}

	console.log("listarProductos", JSON.stringify(listarProductos));

	$('#listaProductosDocumento').val(JSON.stringify(listarProductos));



}






/*================================
=            ELIMINAR            =
================================*/ 




$('#modalAgregarGastos').on('click', 'button.btnEliminarProductoDocumento', function(){  

	console.log("eliminar");


	$(this).parent().parent().remove();


	var titulo = $('.tituloP');

	var cantidad = $('.cantidadP');

	var precio = $('.precioP');

	var total = $('.totalP');

	listaCarrito3 = [];

	if(titulo.length != 0){

		for(var i = 0; i < titulo.length; i++){


			var tituloArray = $(titulo[i]).html();
			var cantidadArray = $(cantidad[i]).html();
			var precioArray = $(precio[i]).attr("precioDocum"); 
			var totalArray =  $(total[i]).attr("totalDocum");   



			listaCarrito3.push({"titulo":tituloArray,
				"cantidad":cantidadArray, 
				"precio":precioArray,
				"total":totalArray});

		}

		localStorage.setItem("listaProductos3",JSON.stringify(listaCarrito3));

		sumarTotalPrecio()
		listarProductosDocumento()


	}else{

		localStorage.removeItem("listaProductos3");
		$('#nuevoTotalVenta').val(0);
		$('#totalVenta').val(0);
		$('#nuevoImpuestoVenta').val(0);
		$('#nuevoTotalVenta').attr('total', 0);



	}




})



/*================================
=            BOTON SALIER DEL MODAL            =
================================*/






$(".salirDocumentoCompra").click(function() {


	if (window.localStorage) { 

		if (window.localStorage.getItem('listaProductos3')){

			/*swal({

				title: "¡Tiene productos sin guardar!",
				text: "perderá todo si cierra la ventana",
				type: "warning",		
				showCancelButton: true,
				confirmButtonColor: "#3085d5",
				cancelButtonColor: "#d33",
				cancelButtonText: "Cancelar",		
				confirmButtonText: "Si, salir"		

			}).then((result) => {
				if (result.value) {*/

					localStorage.removeItem("listaProductos3");

					$("#listaProductoComprado td").remove();
					$('#nuevoTotalVenta').val(0);
					$('#totalVenta').val(0);
					$('#nuevoImpuestoVenta').val(0);
					$('#nuevoTotalVenta').attr('total', 0);

			/*	}
		})*/

	}


}




});



/*==================================
=            SUMA TOTAL            =
==================================*/



function sumarTotalPrecio(){

	var subtotales = $(".totalP");
	var arraySumaSubtotales = [];

	
	for(var i = 0; i < subtotales.length; i++){

		var subtotalesArray = $(subtotales[i]).attr("totaldocum");
		arraySumaSubtotales.push(Number(subtotalesArray));
		
	}

	
	function sumaArraySubtotales(total, numero){

		return total + numero;

	}

	var sumaTotal = arraySumaSubtotales.reduce(sumaArraySubtotales);
	/*
	$(".sumaSubTotal").html('<strong>PEN S/ <span>'+(sumaTotal).toFixed(2)+'</span></strong>');

	$(".sumaCesta").html((sumaTotal).toFixed(2));

	localStorage.setItem("sumaCesta", (sumaTotal).toFixed(2));*/

	$('#nuevoTotalVenta').val(Number(sumaTotal).toFixed(2));
	$('#totalVenta').val(sumaTotal);
	$('#nuevoTotalVenta').attr('total', sumaTotal);


}







/*=========================================
=          VALIDAR SI EXISTE EL TIPO DE DOCUMENTO, CON LA MISMA SERIE, DEL MISMO PROVEEDOR           =
=========================================*/






$("#nuevoNumeroDocumento, #nuevoSerieDocumento, #nuevoTipoDocumento, #nuevoProveedorDocumento").change(function() {


	/*var nDocumento = $(this).val();*/

	var nDocumento = $("#nuevoNumeroDocumento").val();	
	var serie = $("#nuevoSerieDocumento").val();	
	var tipoDocumento = $("#nuevoTipoDocumento").val();
	var proveedor =  $("#nuevoProveedorDocumento").val();


	var datos = new FormData();

	datos.append('nDocumento',nDocumento);
	datos.append('serie',serie); 
	datos.append('tipoDocumento',tipoDocumento);
	datos.append('proveedor',proveedor);

	$.ajax({

		url:"ajax/documentosCompras.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",    
		success: function(respuesta){ 
			console.log("respuesta", respuesta);

			if (respuesta) {

				swal({

					title: "¡El número de documento ya fue registrado!",			 
					type: "warning",			 
					confirmButtonColor: "#3085d5",				 
					confirmButtonText: "Cerrar"		

				}) 

				//return false;
				

				$("#nuevoNumeroDocumento").val('');

			}



		}

	});



	



});




























/*=========================================
=            GUARDAR PROVEEDOR            =
=========================================*/





$(".guardarProveedor").click(function(e) {

	e.preventDefault();

	var nombre = $("#nuevoNombreProveedor").val(); 
	var direccion = $("#nuevoDireccionProveedor").val();   
	var ruc = $("#nuevoRucProveedor").val(); 
	var telefono = $("#nuevoTelefonoProveedor").val();   
	var email = $("#nuevoEmailProveedor").val(); 
	var idUsuarioC = $("#idUsuarioC").val();


	var datos = new FormData();

	datos.append('nombre',nombre);
	datos.append('direccion',direccion); 
	datos.append('ruc',ruc);
	datos.append('telefono',telefono);
	datos.append('email',email);
	datos.append('idUsuarioC',idUsuarioC);



	if(nombre != ""){

		/*var expresion = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]*$/;

		if(!expresion.test(nombre)){

			$("#nuevoNombreProveedor").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> No se permiten números ni caracteres especiales</div>')

			return false;

		}*/

	}else{

		$("#nuevoNombreProveedor").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> El campo <strong>nombre</strong>  es obligatorio</div>')

		return false;
	}



	if(direccion != ""){

		/*var expresion = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9# ]*$/;

		if(!expresion.test(direccion)){

			$("#nuevoDireccionProveedor").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> No se permiten caracteres especiales</div>')

			return false;

		}
		*/
	}else{

		$("#nuevoDireccionProveedor").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> El campo <strong>direccion</strong>  es obligatorio</div>')

		return false;
	}




	if(ruc != ""){

		var expresion = /^[0-9]*$/;

		if(!expresion.test(ruc)){

			$("#nuevoRucProveedor").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> Escriba correctamente el ruc</div>')

			return false;

		}

		if (ruc.length < 11 ) {
			$("#nuevoRucProveedor").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> Debe tener 11 caracteres el ruc </div>')

			return false;

		}

	}else{

		$("#nuevoRucProveedor").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> El campo <strong>ruc</strong>  es obligatorio</div>')

		return false;
	}


      /*if($("#nuevoTelefonoClienteVendedora").val() == ""){

        alert("El campo Teléfono no puede estar vacío.");

        $("#nuevoTelefonoClienteVendedora").focus();

        return false;

    }*/

    if(telefono != ""){

    	/*var expresion = /^[0-9]*$/;

    	if(!expresion.test(telefono)){

    		$("#nuevoTelefonoProveedor").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> Escriba correctamente el número telefónico</div>')

    		return false;

    	}*/

    }else{

    	$("#nuevoTelefonoProveedor").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> El campo <strong>teléfono</strong> es obligatorio</div>')

    	return false;
    }




    if(email != ""){

    	var expresion = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;

    	if(!expresion.test(email)){

    		$("#nuevoEmailProveedor").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> Escriba correctamente el correo electrónico</div>')

    		return false;

    	}


    }else{

    	$("#nuevoEmailProveedor").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> El campo <strong>email</strong> es obligatorio</div>')

    	return false;
    }




    $.ajax({

    	url:"ajax/documentosCompras.ajax.php",
    	method: "POST",
    	data: datos,
    	cache: false,
    	contentType: false,
    	processData: false,
    	dataType: "json",    
    	success: function(respuesta){ 



    		return true;

    	}

    });


    $('#mensajeP').fadeOut("fast",function(){

    	$('#mensajeP').html('<div class="alert alert-success" style="text-align: center; font-size: 15px" >Los datos se ingresaron correctamente<div>'); 
    });


    $('#mensajeP').fadeIn("slow");
    $('#mensajeP').fadeOut("slow");


    setTimeout(function(){ $('#modalAgregarProveedor').modal('hide');},900);
    

    $("#nuevoNombreProveedor").val(''); 
    $("#nuevoDireccionProveedor").val('');   
    $("#nuevoRucProveedor").val(''); 
    $("#nuevoTelefonoProveedor").val('');   
    $("#nuevoEmailProveedor").val(''); 
    $("#idUsuarioC").val('');

});





 

 $('#modalAgregarGastos').on('click', 'button.guardarCompraProveedores', function(){


 	console.log("guardado");


 	if (!$("#listaProductoComprado tr").html()) {

 		swal({

 			title: "¡No tiene ningun producto agregado!",			 
 			type: "warning",			 
 			confirmButtonColor: "#3085d5",				 
 			confirmButtonText: "Cerrar"		

 		}) 

 		return false;

 	}/*else{

 		return true;


 	}*/

 }) 






 $('#tableDocumentosCompras').on('click', 'button.ingresarCompras', function(){  

 	/* $(".ingresarCompras").click(function() {*/

 		$('#listaProductoComprado tr').remove();


 		var id_tipodocumento_detalle = $(this).attr("idTipoDocumentoDetalle");


 		$("#id_tipodocumento_detalle").val(id_tipodocumento_detalle);

 		var datos = new FormData();
 		datos.append("id_tipodocumento_detalle", id_tipodocumento_detalle);

 		$.ajax({

 			url:"ajax/documentosCompras.ajax.php",
 			method: "POST",
 			data: datos,
 			cache: false,
 			contentType: false,
 			processData: false,
 			dataType: "json",
 			success: function(respuesta){
 				console.log("respuesta", respuesta);

			//console.log("respuesta", respuesta);
			$('#nuevoResponsableGastos').val(respuesta['responsable']);
			$('#listaProductosDocumento').val(respuesta['productos']);


			$("#nuevoTotalVenta").val(respuesta["total"]);
			$("#totalVenta").val(respuesta["total"]);





			var productos = JSON.parse(respuesta['productos']);
			console.log("productos", productos);

			productos.forEach(funcionForEach3);

			function funcionForEach3(item3, index){  


				$('#listaProductoComprado').append(

					'<tr>'+

					'<td class="tituloP">'+item3.titulo+'</td>'+

					'<td class="cantidadP">'+item3.cantidad+'</td>'+

					'<td class="precioP" precioDocum="'+item3.precio+'"> S/ '+(Number(item3.precio).toFixed(2))+'</td>'+

					'<td class="totalP" totalDocum="'+item3.total+'"> S/ '+(Number(item3.total).toFixed(2))+'</td>'+



					'<td><button class="btn btn-danger btnEliminarProductoDocumento" titulo2="'+item3.titulo+'" ><i class="fa fa-times"></i></button></td>'+

					'</tr>',  

					)




			}



		}

	});



 	});




	 /*========================================================
	 =            ELIMINAR DOCUMENTO DE DE COMPRA             =
	 ========================================================*/




	 $("#tableDocumentosCompras").on( 'click', 'button.eliminarTipoDocumentoDetalle', function (){

	 	var idTipoDocumentoDetalle = $(this).attr('idTipoDocumentoDetalle');
	 	console.log("idTipoDocumentoDetalle", idTipoDocumentoDetalle);


	 	swal({

	 		title: "¿Está seguro de borrar el documento?",
	 		text: "¡No se podrá deshacer la operación!",
	 		type: "warning",		
	 		showCancelButton: true,
	 		confirmButtonColor: "#3085d5",
	 		cancelButtonColor: "#d33",
	 		cancelButtonText: "Cancelar",		
	 		confirmButtonText: "Si, borrar documento"		

	 	}).then((result) => {
	 		if (result.value) {

	 			window.location = "index.php?ruta=gastos&idTipoDocumentoDetalle="+idTipoDocumentoDetalle;

	 		}
	 	})


	 })


	 /*========================================================
	 =            ELIMINAR DOCUMENTO DE DE COMPRA             =
	 ========================================================*/




	 $("#tableDocumentosCompras").on( 'click', 'button.editarTipoDocumentoDetalle', function (){

	 	var idTipoDocumentoDetalle = $(this).attr('idTipoDocumentoDetalle');
	 	console.log("idTipoDocumentoDetalles", idTipoDocumentoDetalle);


	 	
	 	var datos = new FormData();

	 	datos.append('idTipoDocumentoDetalles',idTipoDocumentoDetalle);


	 	$.ajax({

	 		url:"ajax/documentosCompras.ajax.php",
	 		method: "POST",
	 		data: datos,
	 		cache: false,
	 		contentType: false,
	 		processData: false,
	 		dataType: "json",    
	 		success: function(respuesta){ 
	 			 

	 			


	 			var fechaEmi = respuesta['fecha_emision']; // Default datetime will be like this.
				//By Spliting the input control value with space
				var fechaEmision = fechaEmi.split(' ')[0];
				 


				var fechaAlm = respuesta['fecha_almacenamiento']; // Default datetime will be like this.
				//By Spliting the input control value with space
				var fechaAlmacenamiento = fechaAlm.split(' ')[0];
			 
				//date -2010-10-18
				//date -2010-10-18
 
				$("#editarFechaAlmacenamiento").val(fechaAlmacenamiento);	
				$("#editarFechaEmision").val(fechaEmision); 


				$("#editarSerieDocumento").val(respuesta['serie']);
				$("#editarNumeroDocumento").val(respuesta['ntipo']);
				$("#editarTipoDocumento").val(respuesta['id_tipo_documento']);
				$("#editarProveedorDocumento").val(respuesta['id_proveedor']);

				$("#idDocumentoCompra").val(respuesta['id']);








			}

		});




	 })





$("#editarNumeroDocumento, #editarSerieDocumento, #editarTipoDocumento, #editarProveedorDocumento").change(function() {


	/*var nDocumento = $(this).val();*/

	var nDocumento = $("#editarNumeroDocumento").val();	
	console.log("nDocumento", nDocumento);
	var serie = $("#editarSerieDocumento").val();	
	console.log("serie", serie);
	var tipoDocumento = $("#editarTipoDocumento").val();
	console.log("tipoDocumento", tipoDocumento);
	var proveedor =  $("#editarProveedorDocumento").val();
	console.log("proveedor", proveedor);


	var datos = new FormData();

	datos.append('nDocumento',nDocumento);
	datos.append('serie',serie); 
	datos.append('tipoDocumento',tipoDocumento);
	datos.append('proveedor',proveedor);

	$.ajax({

		url:"ajax/documentosCompras.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",    
		success: function(respuesta){ 
			console.log("respuesta", respuesta);

			if (respuesta) {

				swal({

					title: "¡El número de documento ya fue registrado!",			 
					type: "warning",			 
					confirmButtonColor: "#3085d5",				 
					confirmButtonText: "Cerrar"		

				}) 

				//return false;
				

				$("#editarNumeroDocumento").val('');

			}



		}

	});



	



});












/*========================================================
	 =            ELIMINAR DOCUMENTO DE DE COMPRA             =
	 ========================================================*/




	 $("#tableDocumentosCompras").on( 'click', 'a.escogReport', function (){

	 	var idCompras = $(this).attr('idCompras');
	 	console.log("idCompras", idCompras);



	 	$(".irHorizontal").attr("href","index.php?ruta=reporteComprash&idCompras="+idCompras);

	 	$(".irVertical").attr("href","index.php?ruta=reporteComprasv&idCompras="+idCompras);



	 	 })
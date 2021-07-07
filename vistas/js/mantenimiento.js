 

$(document).ready(function() {

	listarTablaMantenimiento()

});



var listarTablaMantenimiento = function(){

	var table = $('#tablaMantenimientoEquipo').DataTable({
		"bDeferRender": true,   
		"sPaginationType": "full_numbers",
		responsive: true,
		"ajax": {
			"type":"POST",
			"url":"ajax/tableMantenimiento.ajax.php"
		},
		"columns":[
		{ "data": "id"},		 
		{ "data": "categoria"}, 
		{ "data": "area"},  
		{ "data": "equipo"}, 
		{ "data": "responsable"}, 
		{ "data": "observaciones"}, 
		{ "data": "requerimientos"}, 
		{ "data": "total"}, 
		{ "data": "conclusion"}, 
		{ "data": "fecha_mantenimiento"}, 
		{ "data": "estado"}, 
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






$(".nuevaAreaEquipoMantenimiento").change(function(){

	var area = $(this).val();	 

	$(".nuevaEquipoMantenimiento").html("");



	var datos = new FormData();
	datos.append("idArea", area);


	$.ajax({
		url:"ajax/areas.ajax.php",
		method:"POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",		 
		success:function(respuesta){ 

			if (respuesta[0]) {

				respuesta.forEach(funcionForEach);

				function funcionForEach(item, index){

					$(".nuevaEquipoMantenimiento").append(

						'<option value="'+item["id"]+'">'+item["alias"]+'</option>'

						)
				}


			}

		}

	})


})



/*=====================================
=            OBSERVACIONES            =
=====================================*/




$(".addMantenimiento").on('click',function (){


	localStorage.removeItem("listaObservacionesM"); 
	/*   $('#listaRequerimientosMantenimiento tr').remove();*/
	localStorage.removeItem("listaRequerimientosM");    



	$('#nuevoTotalRequerimiento').val(0);
	$('#totalRequerimiento').val(0);	 
	$('#nuevoTotalRequerimiento').attr('total', 0);

})






$("#modalAgregarMantenimiento").on('click', 'button.btnAgregarObservacionesMantenimiento', function (e){

	e.preventDefault();

	var observaciones = $("#nuevaObservacionesMantenimiento").val();

	if(observaciones != ""){

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



	$('#listObservacionesMantenimiento').append(

		'<tr>'+

		'<td class="observaciones">'+observaciones+'</td>'+           

		'<td><button class="btn btn-danger btnEliminarObservacionesMantenimiento" observaciones="'+observaciones+'" ><i class="fa fa-times"></i></button></td>'+

		'</tr>',  

		)


	if(localStorage.getItem("listaObservacionesM") == null){

		listaObservaciones = [];

	}else{

		var listaObservacionesM = JSON.parse(localStorage.getItem("listaObservacionesM"));

        /*for(var i = 0; i < listaObservacionesM.length; i++){


        }*/

        listaObservaciones.concat(localStorage.getItem("listaObservacionesM"));

    }

    listaObservaciones.push({"observaciones":observaciones });

    localStorage.setItem("listaObservacionesM", JSON.stringify(listaObservaciones));


    listarObservacionesEquipo();
 /* listarProductosDocumento();
 sumarTotalPrecio()*/


 $("#nuevaObservacionesMantenimiento").val(''); 

});







/*=====================================
=            LISTAR OBSERVACIONES            =
=====================================*/

function listarObservacionesEquipo(){


	var listaObservacionesM = []; 


	var observaciones = $('.observaciones');



	for (var i = 0; i < observaciones.length; i++) {


		listaObservacionesM.push({'observaciones': $(observaciones[i]).html()})



	}

	console.log("listaObservacionesM", JSON.stringify(listaObservacionesM));

	$('#nuevaListaObservacionesMantenimiento').val(JSON.stringify(listaObservacionesM));
	$('#editarListaObservacionesMantenimiento').val(JSON.stringify(listaObservacionesM));



}





/*=====================================
=            SALIR DEL MODAL Y ELIMINAR LOCALSTORAGE            =
=====================================*/



$("#modalAgregarMantenimiento, #modalEditarMantenimiento").on( 'click', 'button.btnSalirAgregarMantenimiento', function (){


	$('#listObservacionesMantenimiento tr').remove();

	localStorage.removeItem("listaObservacionesM");


	$('#listaRequerimientosMantenimiento tr').remove();

	localStorage.removeItem("listaRequerimientosM");


	

})






/*=====================================
=          ELIMINAR  OBSERVACIONES            =
=====================================*/


$('#modalAgregarMantenimiento').on('click', 'button.btnEliminarObservacionesMantenimiento', function(){        


	$(this).parent().parent().remove();


	var observaciones = $('.observaciones');



	listaObservaciones = [];

	if(observaciones.length != 0){

		for(var i = 0; i < observaciones.length; i++){


			var observacionesArray = $(observaciones[i]).html();

			listaObservaciones.push({"observaciones":observacionesArray});
		}

		localStorage.setItem("listaObservacionesM",JSON.stringify(listaObservaciones));

		listarObservacionesEquipo()


	}else{

		localStorage.removeItem("listaObservacionesM");   

	}

})









/*=====================================
=            REQUERIMINETOS            =
=====================================*/

$("#modalAgregarMantenimiento").on('click', 'button.btnAgregarRequerimientosMantenimiento', function (e){

	e.preventDefault();

	var requerimiento = $("#nuevaRequerimientosMantenimiento").val();	 
	var precio =  $("#nuevaPrecioMantenimiento").val();

	if(requerimiento != "" && precio != ""){

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



	$('#listaRequerimientosMantenimiento').append(

		'<tr>'+

		'<td class="requerimiento">'+requerimiento+'</td>'+

		'<td class="precioR" precioRM ="'+precio+'"> S/ '+(Number(precio).toFixed(2))+'</td>'+


		'<td><button class="btn btn-danger btnEliminarRequerimientoMantenimiento" requerimiento="'+requerimiento+'" ><i class="fa fa-times"></i></button></td>'+

		'</tr>',  

		)


	if(localStorage.getItem("listaRequerimientosM") == null){

		listaRequerimientos = [];

	}else{

		var listaRequerimientosM = JSON.parse(localStorage.getItem("listaRequerimientosM"));

  		/*for(var i = 0; i < listaRequerimientosM.length; i++){


  		}*/

  		listaRequerimientos.concat(localStorage.getItem("listaRequerimientosM"));

  	}

  	listaRequerimientos.push({"requerimiento":requerimiento,  		
  		"precio":precio});

  	localStorage.setItem("listaRequerimientosM", JSON.stringify(listaRequerimientos));

  //	listarProductosDocumento();
  listarRequerimientosMantenimiento();
  sumarTotalPrecioRequerimiento()


  $("#nuevaRequerimientosMantenimiento").val(''); 
  $("#nuevaPrecioMantenimiento").val('');





});


/*==============================================
=            ELIMINAR REQUERIMIENTO            =
==============================================*/



$('#modalAgregarMantenimiento').on('click', 'button.btnEliminarRequerimientoMantenimiento', function(){   


	$(this).parent().parent().remove();


	var requerimiento = $('.requerimiento');

	var precio = $('.precioR'); 

	listaRequerimientos = [];

	if(requerimiento.length != 0){

		for(var i = 0; i < requerimiento.length; i++){


			var requerimientoArray = $(requerimiento[i]).html();			 
			var precioArray = $(precio[i]).attr("precio"); 

			listaRequerimientos.push({"requerimiento":requerimientoArray,	 
				"precio":precioArray});

		}

		localStorage.setItem("listaRequerimientosM",JSON.stringify(listaRequerimientos));

		sumarTotalPrecioRequerimiento()
		listarRequerimientosMantenimiento()


	}else{

		localStorage.removeItem("listaRequerimientosM");
		$('#nuevoTotalRequerimiento').val(0);
		$('#totalRequerimiento').val(0);	 
		$('#nuevoTotalRequerimiento').attr('total', 0);



	}




})





















/*=====================================
=          LISTAR  REQUERIMINETOS            =
=====================================*/


function listarRequerimientosMantenimiento(){


	var listaRequerimientosM = []; 

	var requerimiento = $('.requerimiento'); 

	var precio = $('.precioR');


	for (var i = 0; i < requerimiento.length; i++) {


		listaRequerimientosM.push({'requerimiento': $(requerimiento[i]).html(),						 
			'precio': $(precio[i]).attr("precioRM")})



	}

	console.log("listaRequerimientosM", JSON.stringify(listaRequerimientosM));

	$('#nuevaListaRequerimientosMantenimiento').val(JSON.stringify(listaRequerimientosM));



}


/*=====================================
=            SUMA TOTAL DE LOS REQUERIMIENTOS            =
=====================================*/



function sumarTotalPrecioRequerimiento(){

	var subtotales = $(".precioR");
	var arraySumaSubtotales = [];

	
	for(var i = 0; i < subtotales.length; i++){

		var subtotalesArray = $(subtotales[i]).attr("precioRM");
		arraySumaSubtotales.push(Number(subtotalesArray));
		
	}

	
	function sumaArraySubtotales2(total, numero){

		return total + numero;

	}

	var sumaTotal = arraySumaSubtotales.reduce(sumaArraySubtotales2);
	/*
	$(".sumaSubTotal").html('<strong>PEN S/ <span>'+(sumaTotal).toFixed(2)+'</span></strong>');

	$(".sumaCesta").html((sumaTotal).toFixed(2));

	localStorage.setItem("sumaCesta", (sumaTotal).toFixed(2));*/

	$('#nuevoTotalRequerimiento').val(Number(sumaTotal).toFixed(2));
	$('#totalRequerimiento').val(sumaTotal);
	$('#nuevoTotalRequerimiento').attr('total', sumaTotal);


}





/*==============================================
=            VER OBSERVACONES MODAL            =
==============================================*/


/*var verDetalles  = function(tbody, table){ */

	$("#tablaMantenimientoEquipo").on( 'click', 'button.verObservacionesMantenimientos', function (e){ 

		e.preventDefault();

		$('#listaObservacionesPorId tr').remove();

		var idMantenimiento =  $(this).attr('idMantenimiento');   

		var datos = new FormData();
		datos.append('idMantenimiento', idMantenimiento); 


		$.ajax({

			url:"ajax/mantenimiento.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function(respuesta){                


				if (respuesta['observaciones'] != "[]" ) {

					var observaciones = JSON.parse(respuesta['observaciones']);


					observaciones.forEach(funcionForEach3);

					function funcionForEach3(item3, index){  


						$('#listaObservacionesPorId').append(

							'<tr>'+              

							'<td class="observaciones2">'+item3.observaciones+'</td>'+

							'</tr>',);

					}

				}else{


					$('#listaObservacionesPorId').append(

						'<tr>'+

						'<td class="observaciones2">No hay detalles</td>'+              



						'</tr>',);


				}
			}


		})



	})


	/*  }*/





	$("#tablaMantenimientoEquipo").on( 'click', 'button.verRequerimientosMantenimientos', function (e){ 

		e.preventDefault();

		$('#listaRequerimientosPorId tr').remove();		
		$('#TotalRequerimientoEquipo').val(0);	 
		

		var idMantenimiento =  $(this).attr('idMantenimiento');  

		var datos = new FormData();
		datos.append('idMantenimiento', idMantenimiento); 


		$.ajax({

			url:"ajax/mantenimiento.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function(respuesta){                


				if (respuesta['requerimientos'] != "[]" ) {

					var requerimientos = JSON.parse(respuesta['requerimientos']);


					requerimientos.forEach(funcionForEach4);

					function funcionForEach4(item3, index){  


						$('#listaRequerimientosPorId').append(

							'<tr>'+              

							'<td class="requerimiento2">'+item3.requerimiento+'</td>'+
							'<td class="precio2 text-center"> S/ '+(Number(item3.precio).toFixed(2))+'</td>'+

							'</tr>',);

					}


					$("#TotalRequerimientoEquipo").val(Number(respuesta['total_presupuesto']).toFixed(2))

				}else{


					$('#listaRequerimientosPorId').append(

						'<tr>'+

						'<td class="requerimiento2">No hay detalles</td>'+              
						'<td class="precio2"></td>'+              



						'</tr>',);


				}
			}


		})



	})





/*=============================================
=            ELIMNAR MANTENIMIETNO            =
=============================================*/





$("#tablaMantenimientoEquipo").on( 'click', 'button.btnEliminarMantenimiento', function (){

	var idMantenimiento = $(this).attr('idMantenimiento');
	console.log("idMantenimiento", idMantenimiento);


	swal({

		title: "¿Está seguro de borrar el mantenimiento?",
		text: "¡No se podrá deshacer la operación!",
		type: "warning",		
		showCancelButton: true,
		confirmButtonColor: "#3085d5",
		cancelButtonColor: "#d33",
		cancelButtonText: "Cancelar",		
		confirmButtonText: "Si, borrar mantenimiento"		

	}).then((result) => {
		if (result.value) {

			window.location = "index.php?ruta=mantenimiento&idMantenimiento="+idMantenimiento;

		}
	})


})





	 /*============================================
	 =            EDITAR MANTENIMIENTO            =
	 ============================================*/
	 
	 
	 
	 
	 $("#tablaMantenimientoEquipo").on( 'click', 'button.btnEditarMantenimiento', function (e){ 

	 	$('#editarlistObservacionesMantenimiento tr').remove();
	 	$('#editarlistaRequerimientosMantenimiento tr').remove();

	 	localStorage.removeItem("listaObservacionesM"); 
	 	/*   $('#listaRequerimientosMantenimiento tr').remove();*/
	 	localStorage.removeItem("listaRequerimientosM"); 



	 	var idMantenimiento = $(this).attr("idMantenimiento"); 

	 	var datos = new FormData();
	 	datos.append('idMantenimiento', idMantenimiento); 


	 	$.ajax({

	 		url:"ajax/mantenimiento.ajax.php",
	 		method: "POST",
	 		data: datos,
	 		cache: false,
	 		contentType: false,
	 		processData: false,
	 		dataType: "json",
	 		success: function(respuesta){   
	 			



	 			$("#editarTotalNuevoRequerimiento").val(respuesta['total_presupuesto']);
	 			$("#editarTotalRequerimiento").val(respuesta['total_presupuesto']);

	 			$("#editarFechaMantenimiento").val(respuesta['fecha_mantenimiento']);
	 			$("#editarResponsableMantenimiento").val(respuesta['responsable']);



	 			$("#editarEquipoMantenimiento").val(respuesta['id_equipo']);


	 			$("#editarListaObservacionesMantenimiento").val(respuesta['observaciones']);
	 			$("#editarListaRequerimientosMantenimiento").val(respuesta['requerimientos']);

	 			$("#idMantenimientoEditar").val(respuesta['id']);


	 			if (respuesta['observaciones'] != "") {

	 				var observaciones = JSON.parse(respuesta['observaciones']);



	 				observaciones.forEach(funcionObservaciones);

	 				function funcionObservaciones(item3, index){  


	 					$('#editarlistObservacionesMantenimiento').append(

	 						'<tr>'+

	 						'<td class="observacionesE">'+item3.observaciones+'</td>'+




	 						'<td><button class="btn btn-danger btnEliminarObservacionesMantenimientoE" observaciones="'+item3.observaciones+'" ><i class="fa fa-times"></i></button></td>'+

	 						'</tr>',  

	 						)

	 				}

	 			}





	 			if (respuesta['requerimientos'] != "") {


	 				var requerimientos = JSON.parse(respuesta['requerimientos']);



	 				requerimientos.forEach(funcionRequerimentos);

	 				function funcionRequerimentos(item4, index){  


	 					$('#editarlistaRequerimientosMantenimiento').append(

	 						'<tr>'+

	 						'<td class="requerimientosE">'+item4.requerimiento+'</td>'+
	 						'<td class="precioRE" precioRM="'+item4.precio+'">'+item4.precio+'</td>'+




	 						'<td><button class="btn btn-danger btnEliminarRequerimientoMantenimientoE" requerimientos="'+item4.requerimiento+'" ><i class="fa fa-times"></i></button></td>'+

	 						'</tr>',  

	 						)

	 				}

	 			}




	 			var idEquipo =  respuesta['id_equipo'];

	 			var datosEquipo = new FormData();
	 			datosEquipo.append('idEquipo', idEquipo); 

	 			
	 			$.ajax({

	 				url:"ajax/equipos.ajax.php",
	 				method: "POST",
	 				data: datosEquipo,
	 				cache: false,
	 				contentType: false,
	 				processData: false,
	 				dataType: "json",
	 				success: function(respuesta2){  


	 					var idArea =  respuesta2['id_area'];

	 					var datosArea = new FormData();
	 					datosArea.append('idAreas', idArea); 


	 					$.ajax({

	 						url:"ajax/areas.ajax.php",
	 						method: "POST",
	 						data: datosArea,
	 						cache: false,
	 						contentType: false,
	 						processData: false,
	 						dataType: "json",
	 						success: function(respuesta3){  

	 							$("#editarAreaEquipoMantenimiento").val(respuesta3['id'])


	 						}


	 					})











	 				}

	 			})







	 		}

	 	})





	 })






/*==============================================================================
=            EDITAR LAS OBSERVACION DEL MODAL EDITRAR MANTENIMIENTO            =
==============================================================================*/


$("#modalEditarMantenimiento").on('click', 'button.btnAgregarObservacionesMantenimiento', function (e){

	e.preventDefault();


	var observaciones = $("#editarObservacionesMantenimiento").val();



	if(observaciones != ""){


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



	$('#editarlistObservacionesMantenimiento').append(

		'<tr>'+

		'<td class="observacionesE">'+observaciones+'</td>'+           

		'<td><button class="btn btn-danger btnEliminarObservacionesMantenimientoE" observaciones="'+observaciones+'" ><i class="fa fa-times"></i></button></td>'+

		'</tr>',  

		)


	if(localStorage.getItem("listaObservacionesM") == null){

		listaObservaciones = [];

	}else{

		var listaObservacionesM = JSON.parse(localStorage.getItem("listaObservacionesM"));

        /*for(var i = 0; i < listaObservacionesM.length; i++){


        }*/

        listaObservaciones.concat(localStorage.getItem("listaObservacionesM"));

    }

    listaObservaciones.push({"observaciones":observaciones });

    localStorage.setItem("listaObservacionesM", JSON.stringify(listaObservaciones));


    listarObservacionesEquipoEditar();
 /* listarProductosDocumento();
 sumarTotalPrecio()*/


 $("#editarObservacionesMantenimiento").val(''); 

});







/*================================================================================
=            EDITAR LOS REQUERIMIENTOS DEL MODAL EDITAR MANTENIMIENTO            =
================================================================================*/



$("#modalEditarMantenimiento").on('click', 'button.btnAgregarRequerimientosMantenimiento', function (e){

	e.preventDefault();


	var requerimiento = $("#editarRequerimientosMantenimiento").val();	 
	var precio =  $("#editarPrecioMantenimiento").val();



	if(requerimiento != "" && precio != ""){


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





	$('#editarlistaRequerimientosMantenimiento').append(

		'<tr>'+

		'<td class="requerimientosE">'+requerimiento+'</td>'+

		'<td class="precioRE" precioRM ="'+precio+'"> S/ '+(Number(precio).toFixed(2))+'</td>'+


		'<td><button class="btn btn-danger btnEliminarRequerimientoMantenimientoE" requerimiento="'+requerimiento+'" ><i class="fa fa-times"></i></button></td>'+

		'</tr>',  

		)


	if(localStorage.getItem("listaRequerimientosM") == null){

		listaRequerimientos = [];

	}else{

		var listaRequerimientosM = JSON.parse(localStorage.getItem("listaRequerimientosM"));

  		/*for(var i = 0; i < listaRequerimientosM.length; i++){


  		}*/

  		listaRequerimientos.concat(localStorage.getItem("listaRequerimientosM"));

  	}

  	listaRequerimientos.push({"requerimiento":requerimiento,  		
  		"precio":precio});

  	localStorage.setItem("listaRequerimientosM", JSON.stringify(listaRequerimientos));

  //	listarProductosDocumento();
  listarRequerimientosMantenimientoEditar();
  sumarTotalPrecioRequerimientoEditar()


  $("#editarRequerimientosMantenimiento").val(''); 
  $("#editarPrecioMantenimiento").val('');





});






/*=====================================
=            LISTAR OBSERVACIONES            =
=====================================*/

function listarObservacionesEquipoEditar(){


	var listaObservacionesM = []; 


	var observaciones = $('.observacionesE');



	for (var i = 0; i < observaciones.length; i++) {


		listaObservacionesM.push({'observaciones': $(observaciones[i]).html()})



	}

	console.log("listaObservacionesM", JSON.stringify(listaObservacionesM));

	$('#editarListaObservacionesMantenimiento').val(JSON.stringify(listaObservacionesM));



}


/*=====================================
=          LISTAR  REQUERIMINETOS            =
=====================================*/


function listarRequerimientosMantenimientoEditar(){


	var listaRequerimientosM = []; 

	var requerimiento = $('.requerimientosE'); 

	var precio = $('.precioRE');


	for (var i = 0; i < requerimiento.length; i++) {


		listaRequerimientosM.push({'requerimiento': $(requerimiento[i]).html(),						 
			'precio': $(precio[i]).attr("precioRM")})



	}

	console.log("listaRequerimientosM", JSON.stringify(listaRequerimientosM));

	$('#editarListaRequerimientosMantenimiento').val(JSON.stringify(listaRequerimientosM));



}





function sumarTotalPrecioRequerimientoEditar(){

	var subtotales = $(".precioRE");
	var arraySumaSubtotales = [];

	
	for(var i = 0; i < subtotales.length; i++){

		var subtotalesArray = $(subtotales[i]).attr("precioRM");
		arraySumaSubtotales.push(Number(subtotalesArray));
		
	}

	
	function sumaArraySubtotales2(total, numero){

		return total + numero;

	}

	var sumaTotal = arraySumaSubtotales.reduce(sumaArraySubtotales2);
	/*
	$(".sumaSubTotal").html('<strong>PEN S/ <span>'+(sumaTotal).toFixed(2)+'</span></strong>');

	$(".sumaCesta").html((sumaTotal).toFixed(2));

	localStorage.setItem("sumaCesta", (sumaTotal).toFixed(2));*/

	$('#editarTotalNuevoRequerimiento').val(Number(sumaTotal).toFixed(2));
	$('#editarTotalRequerimiento').val(sumaTotal);
	$('#editarTotalNuevoRequerimiento').attr('total', sumaTotal);


}








$('#modalEditarMantenimiento').on('click', 'button.btnEliminarRequerimientoMantenimientoE', function(e){  

	e.preventDefault(); 




	$(this).parent().parent().remove();


	var requerimiento = $('.requerimientosE');

	var precio = $('.precioRE'); 

	listaRequerimientos = [];

	if(requerimiento.length != 0){

		for(var i = 0; i < requerimiento.length; i++){


			var requerimientoArray = $(requerimiento[i]).html();			 
			var precioArray = $(precio[i]).attr("precioRM"); 

			listaRequerimientos.push({"requerimiento":requerimientoArray,	 
				"precio":precioArray});

		}

		localStorage.setItem("listaRequerimientosM",JSON.stringify(listaRequerimientos));


		sumarTotalPrecioRequerimientoEditar()
		listarRequerimientosMantenimientoEditar();



	}else{

		localStorage.removeItem("listaRequerimientosM");
		$('#editarTotalNuevoRequerimiento').val(0);
		$('#editarTotalRequerimiento').val(0);	 
		$('#editarTotalNuevoRequerimiento').attr('total', 0);
		listarRequerimientosMantenimientoEditar();




	}




})






/*=====================================
=          ELIMINAR  OBSERVACIONES            =
=====================================*/


$('#modalEditarMantenimiento').on('click', 'button.btnEliminarObservacionesMantenimientoE', function(){        


	$(this).parent().parent().remove();


	var observaciones = $('.observacionesE');



	listaObservaciones = [];

	if(observaciones.length != 0){

		for(var i = 0; i < observaciones.length; i++){


			var observacionesArray = $(observaciones[i]).html();





			listaObservaciones.push({"observaciones":observacionesArray});

		}

		localStorage.setItem("listaObservacionesM",JSON.stringify(listaObservaciones));


		listarObservacionesEquipoEditar()


	}else{

		localStorage.removeItem("listaObservacionesM");     
		listarObservacionesEquipoEditar()



	}




})





$('#tablaMantenimientoEquipo').on('click', 'button.verConclusion', function(){        


	var idMantenimiento = $(this).attr("idMantenimiento");


	var datos = new FormData();
	datos.append('idMantenimiento', idMantenimiento); 


	$.ajax({

		url:"ajax/mantenimiento.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta3){  

			$("#nuevaConclusion").val(respuesta3['conclusion']);
			$("#idMante").val(respuesta3['id']);


		}


	})






})




/*=============================================
PROCESO DE ENVÍO
=============================================*/


$(".tablaMantenimientoEquipo").on("click", ".btnEstadoMantenimiento", function(){


	var idMantenimiento = $(this).attr("idMantenimiento");
	console.log("idMantenimiento", idMantenimiento);
	var estadoMantenimiento = $(this).attr("estadoMantenimiento");
	var idEquipo = $(this).attr("idEquipo");
	console.log("idEquipo", idEquipo);
	console.log("estadoMantenimiento", estadoMantenimiento);

	var datos = new FormData();
 	datos.append("idMantenimiento", idMantenimiento);
  	datos.append("estadoMantenimiento", estadoMantenimiento);
  	datos.append("idEquipo", idEquipo);

  		$.ajax({

  		 url:"ajax/mantenimiento.ajax.php",
  		 method: "POST",
	  	data: datos,
	  	cache: false,
      	contentType: false,
      	processData: false,
      	success: function(respuesta){ 
      	    
      	  

      	} 	 

  	});

  	if(estadoMantenimiento == 1){
	
  		$(this).addClass('btn-success');
  		$(this).removeClass('btn-danger');
  		$(this).html('Excelente');
  		$(this).attr('estadoMantenimiento', 2);

  	}

	if(estadoMantenimiento == 2){
	
  		$(this).addClass('btn-info');
  		$(this).removeClass('btn-success');
  		$(this).html('En mantenimiento');
  		$(this).attr('estadoMantenimiento', 3);
	
  	}

  	if(estadoMantenimiento == 3){
	
  		$(this).addClass('btn-warning');
  		$(this).removeClass('btn-info');
  		$(this).html('Necesita cambios');
  		$(this).attr('estadoMantenimiento', 4);
	
  	}

  		if(estadoMantenimiento == 4){
	
  		$(this).addClass('btn-danger');
  		$(this).removeClass('btn-warning');
  		$(this).html('Dar de baja');
  		$(this).attr('estadoMantenimiento', 1);
	
  	}
  	
  	

})
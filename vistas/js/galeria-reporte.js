/*=============================================
=           SUBIENDO FOTO           =
=============================================*/

$('.nuevaFotoGaleria').change(function(){

	var imagen = this.files[0];


/*=============================================
=           VALIDANDO EL FORTMATO DE LA FOTO           =
=============================================*/

if (imagen['type'] != "image/jpeg" && imagen['type'] != "image/png" ) {

	$('.nuevaFotoGaleria').val('');

	swal({

		text: 'Error al subir la imagen',		
		title: "¡La imagen debe estar en formato JPEG o PNG!",
		type: "error",
		confirmButtonText: "¡Cerrar!"				

	});

}else if (imagen['size'] > 2000000 ) {

	$('.nuevaFotoGaleria').val('');

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






	/*=============================================
	=            AREA DE ARRASTRE DE IMAGENES            =
	=============================================*/

	if($('#columnasGaleria').html() == 0){

		$('#columnasGaleria').css({"height":"100px"});

	}else{

		$('#columnasGaleria').css({"height":"auto"});

	}

	/*=====  End AREA DE ARRASTRE DE IMAGENES   ======*/


	/*==========================================
	=            SUBIR IMAGENES           =
	==========================================*/
	
	$('#columnasGaleria').on("dragover", function(e){

		e.preventDefault();
		e.stopPropagation(); 

		$('#columnasGaleria').css({"background":"url(vistas/img/pattern.jpg)"})

	})
	
	/*=====  End of SUBIR IMAGENES    ===*/
	

	/*==========================================
	=            SOLTAR IMAGENES         =
	==========================================*/

	$('#columnasGaleria').on("", function(e){

		e.preventDefault();
		e.stopPropagation();


		$('#columnasGaleria').css({"background":"white"}) 

		var archivo = e.originalEvent.dataTransfer.files;
		console.log("archivo", archivo);

		var imagen = archivo[0];
		console.log("imagen", imagen);

		/*VALIDANDO LA IMAGEN*/

		var imagenSize = imagen.size;
		console.log("imagenSize", imagenSize);

		if (Number(imagenSize) > 2000000) {

			$('#columnasGaleria').before('<div class="alert alert-warning alerta text-center">El archivo excede el peso permitido</div>');

		}else{

			$(".alerta").remove();
		}

		var imagenType = imagen.type;
		
		if (imagenType == "image/jpeg" || imagenType == "image/png"){

			$(".alerta").remove();

		}else{

			$('#columnasGaleria').before('<div class="alert alert-warning alerta text-center">El archivo debe ser formato JPG o PNG</div>');
		}

		
		/*SUBIR IMAGENES AL SERVIDOR*/


		if (Number(imagenSize) < 2000000 && imagenType == "image/jpeg" || imagenType == "image/png" ){

			var datos = new FormData();

			datos.append("imagen",imagen); 

			$.ajax({

				url:"ajax/galeria.ajax.php", 
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType:"json",
				beforeSend: function(){

					$('#columnasGaleria').before('<img src="vistas/img/status.gif" id="status"></img>');
				},

				success:function(respuesta){
					console.log("respuesta", respuesta);

					$('#status').remove();

					/*if (respuesta == 0) {			 			

						$('#columnasGaleria').before('<div class="alert alert-warning alerta text-center">La imagen es inferior a 1600px * 600px</div>');*/
						/*}else{*/

							console.log("respuesta", respuesta);
							$('#columnasGaleria').css({"height":"auto"});

							$('#columnasGaleria').append('<li class="bloqueGaleria"><span class="fa fa-times eliminarGaleria"></span><img src="'+respuesta["ruta"]+'"class="handleImg"></li>');

						//$('#ordenarTextGaleria').append('<li><span class="fa fa-pencil" style="background:blue"></span><img src="'+respuesta["comedor"].slice(3)+'"style="float:left; margin-bottom:10px" width="80%"><h1>'+respuesta["titulo"]+'</h1><p>'+respuesta["descripcion"]+'</p></li>');


						swal({

							title: "¡OK!",
							text: "¡La imagen se subió correctamente!",
							type: "success",	
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false

						}).then((result)=>{

							if(result.value){

								window.location = "galeria";

							}

						});


						/*}*/

					}


				})

		}

	})

	/*=====  End of SOLTAR IMGANES    ===*/


		/*====================================
		=            EDITAR Galeria            =
		
		====================================*/



		$('.btnEditarFotoGaleria').on('click', function(){

			var idGaleriaFoto = $(this).attr('idGaleriaFoto');
			console.log("idGaleriaFoto", idGaleriaFoto);



			var datos = new FormData();
			datos.append("idGaleriaFoto", idGaleriaFoto);

			$.ajax({

				url:"ajax/categorias.ajax.php",
				method:"POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(respuesta){

			//console.log("respuesta", respuesta);
			$('#editarTituloFoto').val(respuesta['titulo']);
			$('#editarDescripcionFoto').val(respuesta['descripcion']);
			$('#idGaleriaFoto2').val(respuesta['id']);
			$("#fotoActual2").val(respuesta["ruta"]);

			if(respuesta["fotoActual2"] != ""){

				$(".previsualizar").attr("src", respuesta["ruta"]);

			}



		}


	})


		})



		

		/*=============================================
	=            ELIMINAR Galeria            =
	=============================================*/
	/*function eliminarGaleria(){*/
$('.eliminarGaleria').click(function(){

			if ($('.eliminarGaleria').length == 1) {

				$('#columnasGaleria').css({"height":"100px"});


			}

		/*e.preventDefault();
		e.stopPropagation();*/

		/*var idGaleria = $(this).parent().attr('idGaleria');
		console.log("idGaleria", idGaleria);
		var rutaGaleria = $(this).attr('ruta');
		console.log("rutaGaleria", rutaGaleria);*/
		
		var idGaleria = $(this).parent().attr('idGaleria');
		console.log("idGaleria", idGaleria);
		var rutaGaleria = $(this).attr('ruta');
		console.log("rutaGaleria", rutaGaleria);
		var idven = $('#idven').val();
 

	swal({

		title: "¿Está seguro de borrar la imagen?",
		text: "¡Si no lo esta puede cancelar la acción!",
		type: "warning",		
		showCancelButton: true,
		confirmButtonColor: "#3085d5",
		cancelButtonColor: "#d33",
		cancelButtonText: "Cancelar",		
		confirmButtonText: "Si, borrar imagen"		
		
	}).then((result) => {
		if (result.value) {

			window.location = "index.php?ruta=galeria-reporte&idGaleria="+idGaleria+"&rutaGaleria="+rutaGaleria+"&idven="+idven;

		}
	})

	})



		
		
$('.eliminarGaleriaC').click(function(){

		if ($('.eliminarGaleriaC').length == 1) {

			$('#columnasGaleria').css({"height":"100px"});


		}
		
		
		var idGaleriaC = $(this).parent().attr('idGaleriaC');		
		console.log("idGaleriaC", idGaleriaC);
		var rutaGaleriaC = $(this).attr('rutaC');		
		console.log("rutaGaleriaC", rutaGaleriaC);
		var idvenC = $('#idven').val();
		console.log("idvenC", idvenC);


		swal({

			title: "¿Está seguro de borrar la imagen?",
			text: "¡Si no lo esta puede cancelar la acción!",
			type: "warning",		
			showCancelButton: true,
			confirmButtonColor: "#3085d5",
			cancelButtonColor: "#d33",
			cancelButtonText: "Cancelar",		
			confirmButtonText: "Si, borrar imagen"		

		}).then((result) => {
			if (result.value) {

				window.location = "index.php?ruta=galeria-reporte&idGaleriaC="+idGaleriaC+"&rutaGaleriaC="+rutaGaleriaC+"&idvenC="+idvenC;

			}
		})

	})


		/*=============================================
	=            ELIMINAR Galeria            =
	=============================================*/
$('.btnEliminaFotoGaleria').click(function(){


	var idCategoria = $(this).attr('idGaleriaFoto');
	var fotoGaleria = $(this).attr('fotoGaleria');
	console.log("fotoGaleria", fotoGaleria);
	console.log("idCategoria", idCategoria);
	
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

			window.location = "index.php?ruta=galerias&idGaleriaFoto="+idCategoria+"&fotoGaleria="+fotoGaleria;;

		}
	})



})
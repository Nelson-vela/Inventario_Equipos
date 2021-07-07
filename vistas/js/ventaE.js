
/*=============================================
=         AGREGAR PRODUCTO DESDE LOS DISPOSITIVOS         =
=============================================*/


$('.btnAgregarProductoExtra').click(function(){


	$('.nuevoProducto').append(

		'<div class="row" style="padding: 5px 15px">'+

		'<!-- Descripción del producto -->'+

		'<div class="col-xs-6" style="padding-right:0px">'+

		'<div class="input-group">'+

		'<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProductoE" idProducto><i class="fa fa-times"></i></button></span>'+

			/*	'<select class="form-control nuevaDescripcionProducto agregarProducto" idProducto name="nuevaDescripcionProducto" required>'+

				'<option>Seleccione el productos </option>'+

				'</select>'+*/

				'<input type="text" class="form-control nuevaDescripcionProductoE agregarProducto" idProducto name="nuevaDescripcionProductoE" required>'+

				

				'</select>'+

				'</div>'+

				'</div>'+

				'<!-- Cantidad del producto -->'+

				'<div class="col-xs-3 ingresoCantidad">'+

				'<input type="number" class="form-control nuevaCantidadProductoE" id="nuevaCantidadProducto" name="nuevaCantidadProductoE" min="1" value="1" stock nuevoStock required>'+

				'</div>'+ 

				'<!-- Precio del producto -->'+

				'<div class="col-xs-3 ingresoPrecioE" style="padding-left:0px">'+

				'<div class="input-group">'+

				'<span class="input-group-addon"><i class="fa fa-euro"></i></span>'+

				'<input type="text"  class="form-control nuevoPrecioProductoE" id="nuevoPrecioProductoE" precioReal name="nuevoPrecioProductoE" required>'+

				'</div>'+

				'</div>'+

				'</div>'  

				)




			/*=============================================
				=         AGREGAR PRODUCTO AL SELECT       =
				=============================================*/
/*
				respuesta.forEach(funcionForEach);

				function funcionForEach(item, index){

					$('.nuevaDescripcionProducto').append(


						'<option idProducto="'+item.id+'" value="'+item.descripcion+'">'+item.descripcion+'</option>'

						)

					}	*/

					sumarTotalPrecioE()

				//agregarPrecioIng()

				agregarImpuesto()

				

				

					// FORMATO DE PRECIO A MONEDA
					$('.nuevoPrecioProductoE').number(true, 2);

				})



$('.formularioVentas').on('click', 'button.quitarProductoE', function(){	 

	$(this).parent().parent().parent().parent().remove();

	var idProducto = $(this).attr('idProducto');	

	if ($('.nuevoProducto').children().length == 0) {

		$('#nuevoTotalVenta').val(0);
		$('#totalVenta').val(0);
		$('#nuevoImpuestoVenta').val(0);
		$('#nuevoTotalVenta').attr('total', 0);

	}else{

		sumarTotalPrecioE()

		//agregarPrecioIng()

		agregarImpuesto()

		listarProductosExtra()

		


	}

	
})






		/*=============================================
		=         SELLECCIONAR PRODUCTO       =
		=============================================*/


		$('.formularioVentas').on('change', 'input.nuevoPrecioProductoE', function(){	 


			var nuevoPrecioProductoE = $(this).val();
			//console.log("nombreProducto", nombreProducto);
			

			var nuevoPrecioProducto = $(this).parent().parent().parent().children('.ingresoPrecioE').children().children('.nuevoPrecioProductoE');
			var nuevaCantidadProducto = $(this).parent().parent().parent().children('.ingresoCantidadE').children('#nuevaCantidadProductoE');
			

					//console.log("respuesta", respuesta);
					

					$(nuevoPrecioProducto).val(nuevoPrecioProductoE);
					$(nuevoPrecioProducto).attr('precioReal', $(this).val());
					$(nuevaCantidadProducto).attr('stock', 1000000000000000000);
					$(nuevaCantidadProducto).attr('nuevoStock', Number(1000000000000000000)-1);

					listarProductosExtra()



				})



		/*=============================================
		=         MODIFICA LA CANTIDAD       =
		=============================================*/

		$('.formularioVentas').on('change', 'input.nuevaCantidadProductoE', function(){	//mo



			var precio = $(this).parent().parent().children('.ingresoPrecioE').children().children('.nuevoPrecioProductoE');
			//console.log("precio", precio);	 

			precioFinal = $(this).val() * precio.attr('precioReal');	

			precio.val(precioFinal);

			var nuevoStock = Number(1000000000000000000) - $(this).val();

			$(this).attr('nuevoStock', nuevoStock);		

			sumarTotalPrecioE() 

			//agregarPrecioIng();  

			agregarImpuesto()

			listarProductosExtra()

			

		})


		/*=============================================
		=         	SUMAR TOTAL PRECIO    =
		=============================================*/


		function sumarTotalPrecioE(){


			var precioItemE = $('.nuevoPrecioProductoE');



			var arraySumarPrecioE = [];

			var precioItem = $('.nuevoPrecioProducto');

			var arraySumarPrecio = [];

			for (var i = 0; i < precioItem.length; i++){

				arraySumarPrecio.push(Number($(precioItem[i]).val()));
				

			}

			function sumarArrayPrecio(total, numero){

				return total+numero;


			}

			for (var i = 0; i < precioItemE.length; i++){

				arraySumarPrecioE.push(Number($(precioItemE[i]).val()));
				

			}

			function sumarArrayPrecioE(total, numero){

				return total+numero;


			}

			
		/*	if(arraySumarPrecio != ''){

				var sumaTotalPrecio = arraySumarPrecio.reduce(sumarArrayPrecio)
			}

			if(arraySumarPrecioE != ''){

				var sumaTotalPrecio = arraySumarPrecioE.reduce(sumarArrayPrecioE)
			}
*/
		
			var sumaTotalPrecio = arraySumarPrecioE.reduce(sumarArrayPrecioE)+arraySumarPrecio.reduce(sumarArrayPrecio)

			
			
			$('#nuevoTotalVenta').val(sumaTotalPrecio);
			$('#totalVenta').val(sumaTotalPrecio);
			$('#nuevoTotalVenta').attr('total', sumaTotalPrecio);
			
		}



		/*=============================================
		=         	AGREGAR IMPUESTOS     =
		=============================================*/ 
/*
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

		}*/

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
		=        LISTAR TODOS LOS PRODUCTOS      =
		=============================================*/

		function listarProductosExtra(){


			var listarProductosExtra = [];	

			var descripcion = $('.nuevaDescripcionProductoE');

			var cantidad = $('.nuevaCantidadProductoE');

			var precio = $('.nuevoPrecioProductoE');

			for (var i = 0; i < descripcion.length; i++) {
				

				listarProductosExtra.push({'id': $(descripcion[i]).attr('idProducto'),				
					'descripcion': $(descripcion[i]).val(),
					'cantidad': $(cantidad[i]).val(),
					'stock': $(cantidad[i]).attr('nuevoStock'),
					'precio': $(precio[i]).attr('precioReal'),
					'total': $(precio[i]).val()
				})



			}

			//console.log("listarProductosExtra", listarProductosExtra);

			console.log("listarProductosExtra", JSON.stringify(listarProductosExtra));

			$('#listaProductosE').val(JSON.stringify(listarProductosExtra));
			
		}


		

	function sumarTotalPrecioTotalS(){


			var precioItemE = $('.nuevoPrecioProductoE');
			var precioItem = $('.nuevoPrecioProducto');

			var arraySumarPrecioE = [];

			for (var i = 0; i < precioItem.length; i++){

				arraySumarPrecioE.push(Number($(precioItem[i]).val()));
				

			}

			function sumarArrayPrecioE(total, numero){

				return total+numero;


			}

			var sumaTotalPrecio = arraySumarPrecioE.reduce(sumarArrayPrecioE)
			
			$('#nuevoTotalVenta').val(sumaTotalPrecio);
			$('#totalVenta').val(sumaTotalPrecio);
			$('#nuevoTotalVenta').attr('total', sumaTotalPrecio);
			$('.prueba').html(sumaTotalPrecio);
		}


        
		 $('html').click(function () {

        	sumarTotalPrecioE()
        	agregarImpuesto()
            
        });
        		
		 
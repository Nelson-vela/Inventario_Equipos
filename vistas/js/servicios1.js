$(document).ready(function() {

 listarTablaServicio()

});



var listarTablaServicio = function(){

    var table = $('#tableServicios').DataTable({
     "bDeferRender": true,   
     "sPaginationType": "full_numbers",
     responsive: true,
     "ajax": {
      "type":"POST",
      "url":"ajax/tableServicios.ajax.php"
  },
  "columns":[
  { "data": "id"},
  { "data": "codigo"}, 
  { "data": "cliente"},              
  { "data": "direccion"},                
  { "data": "neto"},                
  { "data": "total"},
  { "data": "fecha"},                
  { "data": "enviado"},                
  { "data": "estadoFactura"},                
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
    CanceladoPendiente("#tableServicios", table);
    EntregaNoEntregado("#tableServicios", table);
    eliminarVenta("#tableServicios", table);
    editar_Cliente("#tableServicios", table);
    EnviadoNoEnviado("#tableServicios", table);

}


var obtener_data_edita  = function(tbody, table){

 $(tbody).on( 'click', 'button.editarCategoria1', function (){


    var idCategoria = $(this).attr('idCategoria');
    console.log("idProducto", idCategoria);
    var datos = new FormData();

    datos.append('idProducto', idCategoria);

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




});

}

var editar_Cliente  = function(tbody, table){

 $(tbody).on( 'click', 'button.editarClienteSer', function (){

    var idVenta = $(this).attr('idVenta');
    console.log("idVenta", idVenta);

     var datos = new FormData();

    datos.append('idVenta', idVenta);

    $.ajax({

            url:"ajax/ventas.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){
                console.log("respuesta", respuesta);

                $('#editarNombreCliente').val(respuesta['cliente']);
                $('#idClienteVenta').val(respuesta['id']);
                $('#editarNumeroPedido').val(respuesta['numPedido']);
                $('#editarNumeroObra').val(respuesta['numObra']);
                $('#editarDireccionCliente').val(respuesta['direccion']);
                $('#editarTelefonoCliente').val(respuesta['telefono']);
                $('#editarEmail').val(respuesta['email']);
                $('#editarFechaCliente').val(respuesta['fechaModi']);
                
                

            }



        })





    });
}


var eliminarVenta  = function(tbody, table){

 $(tbody).on( 'click', 'button.eliminarVenta1', function (){


    var idVenta = $(this).attr('idVenta');
    console.log("idVenta", idVenta);
    var datos = new FormData();

    datos.append('idVenta', idVenta);

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

            window.location = "index.php?ruta=administrar-servicios&idVenta="+idVenta;

        }
    })


});

}

var EnviadoNoEnviado  = function(tbody, table){

 $(tbody).on( 'click', 'button.btnActivarEnviado', function (){

    var idVenta = $(this).attr("idVenta");
    console.log("idVenta", idVenta);

    var estadoEnviado = $(this).attr("estadoEnviado");
    console.log("estadoEnviado", estadoEnviado);

    var datos = new FormData();

    datos.append("estadoEnviado", estadoEnviado);
    datos.append("activarId", idVenta);


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


    if (estadoEnviado == 0) {

        $(this).removeClass('btn-success');
        $(this).addClass('btn-danger');
        $(this).html('No Enviado');
        $(this).attr('estadoEnviado',1);

    }else{

        $(this).addClass('btn-success');
        $(this).removeClass('btn-danger');
        $(this).html('Enviado');
        $(this).attr('estadoEnviado',0);

    }

    

})

}



var EntregaNoEntregado  = function(tbody, table){

 $(tbody).on( 'click', 'button.btnActivarFactura', function (){

    var idVenta = $(this).attr("idVenta");
    console.log("idVenta", idVenta);

    var estadoFactura = $(this).attr("estadoFactura");
    console.log("estadoFactura", estadoFactura);
  

    var datos = new FormData();

    datos.append("estadoFactura", estadoFactura);
    datos.append("activarIdFactura", idVenta);


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


    if (estadoFactura == 0) {

        $(this).removeClass('btn-success');
        $(this).addClass('btn-danger');
        $(this).html('No Entregado');
        $(this).attr('estadoFactura',1);

    }else{

        $(this).addClass('btn-success');
        $(this).removeClass('btn-danger');
        $(this).html('Entregado');
        $(this).attr('estadoFactura',0);

    }

    

})

}


var CanceladoPendiente  = function(tbody, table){

 $(tbody).on( 'click', 'button.btnEstadoVenta', function (){

    var idVenta = $(this).attr("idVenta");
    console.log("idVenta", idVenta);

    var estadoVenta = $(this).attr("estadoVenta");
    console.log("estadoVenta", estadoVenta);

    var datos = new FormData();

    datos.append("estadoVenta", estadoVenta);
    datos.append("activarId", idVenta);


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

}
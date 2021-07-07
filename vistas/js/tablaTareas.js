$(document).ready(function() {

 listarTablaTareas()

});



var listarTablaTareas = function(){

  var table =   $('#tablaTareas').DataTable({
   "bDeferRender": true,       
   "sPaginationType": "full_numbers",
   responsive: true,
   "ajax": {
    "type":"POST",
    "url":"ajax/tablaTareas.ajax.php"
  },
  "columns":[
  { "data": "id"},
  { "data": "categoria"},
  { "data": "area"},
  { "data": "alias"},
  { "data": "usuario"}, 
  /*{ "data": "serie"},   */               
  { "data": "marca"},                
  { "data": "modelo"},                
  { "data": "codbarra"},                
  { "data": "detalles"},
  { "data": "estado"},                
  { "data": "imagen"},                
  { "data": "fecha_ingreso"},
  { "data": "ultimo_mantenimiento"},                
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

  obtener_data_edita("#tablaTareas", table);
  obtener_data_elimina("#tablaTareas", table);
  verDetalles("#tablaTareas", table);


}


var obtener_data_edita  = function(tbody, table){

 $(tbody).on( 'click', 'button.editarEquipo', function (){

  $('#listaEditarDetallesEquipo tr').remove();


  var idEquipo = $(this).attr('idEquipo');
  console.log("idEquipo", idEquipo);
  var datos = new FormData();

  datos.append('idEquipo', idEquipo);

  $.ajax({

    url:"ajax/equipos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta){





      $('#editarCategoriaEquipo').val(respuesta['id_categoria']);
      $('#editarAreaEquipo').val(respuesta['id_area']);
      $('#editarUsuarioEquipo').val(respuesta['id_cliente']);
      $('#editarAliasoEquipo').val(respuesta['alias']);
      $('#editarSerieEquipo').val(respuesta['serie']);
      $('#editarMarcaEquipo').val(respuesta['marca']);
      $('#editarModeloEquipo').val(respuesta['modelo']);
      $('#editarCodBarraEquipo').val(respuesta['codbarra']);
      $('#editarEstadoEquipo').val(respuesta['estado']);
      $('#editarlistaCaracteristicasDetallesEquipos').val(respuesta['detalles']);
      $('#imagenActual').val(respuesta['imagen']);
      $('#idEditar').val(respuesta['id']);
      $('#editarFechaEquipo').val(respuesta['fecha_ingreso']);


      if (respuesta['imagen'] !="") {

        $('#imagenActual').val(respuesta['imagen']);

        $(".previsualizar").attr("src", respuesta['imagen']);


      }




      var detalles = JSON.parse(respuesta['detalles']);

      console.log("detalles", detalles);

      detalles.forEach(funcionDdetallea);

      function funcionDdetallea(item3, index){  


        $('#listaEditarDetallesEquipo').append(

          '<tr>'+

          '<td class="caracteristicasEditar">'+item3.caracteristicas+'</td>'+

          '<td class="detallesEditar">'+item3.detalles+'</td>'+



          '<td><button class="btn btn-danger btnEliminarDetalleEquipo" caracteristica="'+item3.caracteristica+'" ><i class="fa fa-times"></i></button></td>'+

          '</tr>',  

          )

          }




      }

    }) 




});

}









 

 $("#modalEditarEquipo").on( 'click', 'button.salirEditarDetalleModal', function (){


    console.log("salir");

 })





var obtener_data_elimina  = function(tbody, table){

 $(tbody).on( 'click', 'button.eliminarEquipo', function (){


  var idEquipo = $(this).attr('idEquipo');
  var imagen = $(this).attr('imagen');
  console.log("imagen", imagen);

  var datos = new FormData();

  datos.append('idEquipo', idEquipo);

  swal({

    title: "¿Está seguro de borrar el dispositivo?",
    text: "¡Si no lo esta puede cancelar la acción!",
    type: "warning",        
    showCancelButton: true,
    confirmButtonColor: "#3085d5",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",       
    confirmButtonText: "Si, borrar"     

  }).then((result) => {
    if (result.value) {

      window.location = "index.php?ruta=tareas&idEquipo="+idEquipo+"&imagen="+imagen;

    }
  })


});

}








if(localStorage.getItem("listaProductos4") != null){

  var listaCarrito4 = JSON.parse(localStorage.getItem("listaProductos4"));
  console.log("listaCarrito4", listaCarrito4);

  listaCarrito4.forEach(funcionForEach3);

  function funcionForEach3(item3, index){  


    $('#listaDetallesEquipo').append(

      '<tr>'+

      '<td class="caracteristicas">'+item3.caracteristicas+'</td>'+

      '<td class="detalles">'+item3.detalles+'</td>'+



      '<td><button class="btn btn-danger btnEliminarDetalleEquipo" caracteristica="'+item3.caracteristica+'" ><i class="fa fa-times"></i></button></td>'+

      '</tr>',  

      )




  }



     /* //agregarPrecioIng()

      agregarImpuesto() 

      listarProductos()*/

      listarCaracteristicasDetallesEquipo();
      
    }













    $("#modalAgregarProducto").on('click', 'button.btnAgregarDetallesEquipo', function (e){

      e.preventDefault();


      var caracteristica = $("#nuevoCaracteristicaEquipo").val();
      var detalles =  $("#nuevoDetallesEquipo").val();



      if(caracteristica != "" && detalles != ""){


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



      $('#listaDetallesEquipo').append(

        '<tr>'+

        '<td class="caracteristicas">'+caracteristica+'</td>'+

        '<td class="detalles">'+detalles+'</td>'+

        

        '<td><button class="btn btn-danger btnEliminarDetalleEquipo" caracteristica="'+caracteristica+'" ><i class="fa fa-times"></i></button></td>'+

        '</tr>',  

        )


      if(localStorage.getItem("listaProductos4") == null){

        listaCarrito4 = [];

      }else{

        var listaProductos4 = JSON.parse(localStorage.getItem("listaProductos4"));

        /*for(var i = 0; i < listaProductos4.length; i++){


        }*/

        listaCarrito4.concat(localStorage.getItem("listaProductos4"));

      }

      listaCarrito4.push({"caracteristicas":caracteristica,
        "detalles":detalles});

      localStorage.setItem("listaProductos4", JSON.stringify(listaCarrito4));


      listarCaracteristicasDetallesEquipo();
 /* listarProductosDocumento();
 sumarTotalPrecio()*/


 $("#nuevoCaracteristicaEquipo").val('');
 $("#nuevoDetallesEquipo").val('');
 




});












    $('#modalAgregarProducto').on('click', 'button.btnEliminarDetalleEquipo', function(){  

      console.log("eliminar");


      $(this).parent().parent().remove();


      var caracteristicas = $('.caracteristicas');

      var detalles = $('.detalles');

      listaCarrito4 = [];

      if(caracteristicas.length != 0){

        for(var i = 0; i < caracteristicas.length; i++){


          var caracteristicasArray = $(caracteristicas[i]).html();
          var detallesArray = $(detalles[i]).html();




          listaCarrito4.push({"caracteristicas":caracteristicasArray, 
            "detalles":detallesArray});

        }

        localStorage.setItem("listaProductos4",JSON.stringify(listaCarrito4));


        listarCaracteristicasDetallesEquipo()


      }else{

        localStorage.removeItem("listaProductos4");     



      }




    })





 $('#modalEditarEquipo').on('click', 'button.btnEliminarDetalleEquipo', function(){  

      console.log("eliminar");


      $(this).parent().parent().remove();


      var caracteristicas = $('.caracteristicasEditar');

      var detalles = $('.detallesEditar');

      listaCarrito5 = [];

      if(caracteristicas.length != 0){

        for(var i = 0; i < caracteristicas.length; i++){


          var caracteristicasArray = $(caracteristicas[i]).html();
          var detallesArray = $(detalles[i]).html();




          listaCarrito5.push({"caracteristicas":caracteristicasArray, 
            "detalles":detallesArray});

        }

        localStorage.setItem("listaProductos5",JSON.stringify(listaCarrito5));


        listarCaracteristicasDetallesEquipoEditar()


      }else{

        localStorage.removeItem("listaProductos5");     



      }




    })

















    function listarCaracteristicasDetallesEquipo(){


      var listarProductos4 = []; 


      var caracteristicas = $('.caracteristicas');

      var detalles = $('.detalles');


      for (var i = 0; i < caracteristicas.length; i++) {


        listarProductos4.push({'caracteristicas': $(caracteristicas[i]).html(),
          'detalles': $(detalles[i]).html()})



      }

      console.log("listarProductos4", JSON.stringify(listarProductos4));

      $('#listaCaracteristicasDetallesEquipos').val(JSON.stringify(listarProductos4));



    }






function listarCaracteristicasDetallesEquipoEditar(){


      var listarProductos5 = []; 


      var caracteristicas = $('.caracteristicasEditar');


      var detalles = $('.detallesEditar');


      for (var i = 0; i < caracteristicas.length; i++) {


        listarProductos5.push({'caracteristicas': $(caracteristicas[i]).html(),
          'detalles': $(detalles[i]).html()})



      }

      console.log("listarProductos5", JSON.stringify(listarProductos5));

      $('#editarlistaCaracteristicasDetallesEquipos').val(JSON.stringify(listarProductos5));



    }





    var verDetalles  = function(tbody, table){ 

     $(tbody).on( 'click', 'button.verDetallesEquipos', function (){ 

      $('#listaDetallesEquipoPorId tr').remove();

      var idEquipo =  $(this).attr('idEquipoDetalle');


      var datos = new FormData();
      datos.append('idEquipo', idEquipo); 


      $.ajax({

        url:"ajax/equipos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){                


          if (respuesta['detalles'] != "") {

            var detalles = JSON.parse(respuesta['detalles']);
            

            detalles.forEach(funcionForEach3);

            function funcionForEach3(item3, index){  


              $('#listaDetallesEquipoPorId').append(

                '<tr>'+

                '<td class="caracteristicas2">'+item3.caracteristicas+'</td>'+

                '<td class="detalles2">'+item3.detalles+'</td>'+

                '</tr>',);

            }

          }else{


            $('#listaDetallesEquipoPorId').append(

              '<tr>'+

              '<td class="detalles2">No hay detalles</td>'+
              '<td class="detalles2"></td>'+



              '</tr>',);


          }
        }


      })



    })


   }











 $("#modalEditarEquipo").on('click', 'button.btnEditarDetallesEquipo', function (e){

      e.preventDefault();


      var caracteristica = $("#editarCaracteristicaEquipo").val();
      var detalles =  $("#editarDetallesEquipo").val();



      if(caracteristica != "" && detalles != ""){


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



      $('#listaEditarDetallesEquipo').append(

        '<tr>'+

        '<td class="caracteristicasEditar">'+caracteristica+'</td>'+


        '<td class="detallesEditar">'+detalles+'</td>'+

        

        '<td><button class="btn btn-danger btnEliminarDetalleEquipo" caracteristica="'+caracteristica+'" ><i class="fa fa-times"></i></button></td>'+

        '</tr>',  

        )


      // if(localStorage.getItem("listaProductos5") == null){

        listaCarrito5 = [];

      // }else{

      //   var listaProductos5 = JSON.parse(localStorage.getItem("listaProductos5"));

        /*for(var i = 0; i < listaProductos5.length; i++){


        }*/

        // listaCarrito5.concat(localStorage.getItem("listaProductos5"));

    /*  }*/

      listaCarrito5.push({"caracteristicas":caracteristica,
        "detalles":detalles});

      localStorage.setItem("listaProductos5", JSON.stringify(listaCarrito5));


      listarCaracteristicasDetallesEquipoEditar();
 /* listarProductosDocumento();
 sumarTotalPrecio()*/


 $("#editarCaracteristicaEquipo").val('');
 $("#editarDetallesEquipo").val('');
 





});
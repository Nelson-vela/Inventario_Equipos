<?php 

$rol = $_SESSION["perfil"];

$validar = ControladorUsuarios::ctrRolVendedor($rol);


?>


<div class="content-wrapper">



	<section class="content-header">



		<h1>



			Administrar compras



		</h1>



		<ol class="breadcrumb">



			<li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>



			<li class="active">Administrar compras</li>



		</ol>



	</section>



	<section class="content">



		<div class="box">



			<div class="box-header with-border">



				<button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarDocumento">



					Agregar documento



				</button>



			</div> <br>



      <div class="box-body"> 


        <table class="table table-bordered table-striped table-responsive" id="tableDocumentosCompras" style="width:100%">


          <thead>



            <tr>



              <th style="width:10px">#</th>

              <th>Proveedor</th>

              <th>Tipo</th>

              <th>N°</th>

              <th>Fecha Emisión</th>

              <th>Fecha Almacenamiento</th>

              <th>Total</th>

              <th>Ingresado</th>                      

              <th>Acciones</th>

            </tr> 


          </thead>      


        </table>

      </div>



    </div>





  </section>



</div>







<!--=====================================
=            AGREGAR FACTURA            =
======================================-->


<div id="modalAgregarDocumento" class="modal fade" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">



  <div class="modal-dialog modal-lg">



    <div class="modal-content">



      <form role="form" method="post" enctype="multipart/form-data">



        <!--=====================================

        CABEZA DEL MODAL

        ======================================-->



        <div class="modal-header" style="background:#3c8dbc; color:white">



          <button type="button" class="close" data-dismiss="modal">&times;</button>



          <h4 class="modal-title">Agregar documento</h4>



        </div>



        <!--=====================================

        CUERPO DEL MODAL

        ======================================-->



        <div class="modal-body">



          <div class="box-body">


            <div class="form-group">



              <div class="input-group">



                <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span> 



                <select class="form-control input-lg" name="nuevoProveedorDocumento" id="nuevoProveedorDocumento" required>



                  <option value="">Selecionar proveedor</option>

                  <?php 

                  $item = null;
                  $valor = null;

                  $tipodocumento = ControladorProveedor::ctrMostrarProveedores($item, $valor);

                  foreach ($tipodocumento as $key => $value) {

                    echo '<option value="'.$value['id'].'">'.$value['proveedor'].'</option>';



                  }


                  ?>              



                </select>

                <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs bu" data-toggle="modal" data-target="#modalAgregarProveedor" data-dismiss="modal">Agregar proveedor</button></span>

                <!-- <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs bu" data-toggle="modal" data-target="#modalBuscarProveedor" data-dismiss="modal">Buscar proveedor</button></span> -->



              </div>



            </div>







          <!--  <div class="row">
          
           <div class="col-md-12">  
          
            <label for="Ingresar la serie">Ingresar proveedor </label>
          
            <div class="form-group">
          
             <div class="input-group">
          
               <span class="input-group-addon"><i class="fa fa-th"></i></span> 
          
               <input type="text" class="form-control input-lg" id="nuevoProveedorDocumento" name="nuevoProveedorDocumento" placeholder="Proveedor" required readonly>
          
               <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs bu" data-toggle="modal" data-target="#modalAgregarProveedor" data-dismiss="modal">Agregar proveedor</button></span>
          
               <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs bu" data-toggle="modal" data-target="#modalBuscarProveedor" data-dismiss="modal">Buscar proveedor</button></span>
          
               <button  class="btn btn-success pull-right"><i class="fa fa-check"></i></button>
          
          
             </div>
          
          
           </div>
          
          
                    </div>
          
          
          
                  </div> -->



                  <!-- ENTRADA PARA EL DOCUMENTO -->



                  <div class="form-group">



                    <div class="input-group">



                      <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span> 



                      <select class="form-control input-lg" name="nuevoTipoDocumento" id="nuevoTipoDocumento" required>



                        <option value="">Selecionar documento</option>

                        <?php 

                        $item = null;
                        $valor = null;

                        $tipodocumento = ControladorTipoDocumento::ctrMostrarTipoDocumento($item, $valor);

                        foreach ($tipodocumento as $key => $value) {

                          echo '<option value="'.$value['id'].'">'.$value['tipo'].'</option>';



                        }


                        ?>              



                      </select>



                    </div>



                  </div>




                  <div class="row">

                    <div class="col-md-4">  

                     <label for="Ingresar la serie">Serie del documento </label>

                     <div class="form-group">

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                        <input type="text" class="form-control input-lg" id="nuevoSerieDocumento" name="nuevoSerieDocumento" placeholder="Serie" required>

                        <input type="hidden" id="idUsuarioC" name="idUsuarioC" value="<?=$_SESSION['id']?>">

                      </div>


                    </div>


                  </div>



                  <div class="col-md-8">

                    <div class="form-group">

                      <label for="Ingresar la serie"> N° del documento</label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                        <input type="text" class="form-control input-lg" id="nuevoNumeroDocumento" name="nuevoNumeroDocumento" placeholder="Ingresar número documento" required>


                      </div>


                    </div> 


                  </div> 


                </div> 



                <div class="row">

                  <div class="col-md-6">  


                    <div class="form-group">

                      <label for="Ingresar la serie">Fecha emisión</label>

                      <div class="input-group">



                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 



                        <input type="date" class="form-control input-lg" id="nuevoFechaEmision" name="nuevoFechaEmision" required>



                      </div>



                    </div>

                  </div>


                  <!-- ENTRADA PARA LA FECHA VENCIDA -->



                  <div class="col-md-6">  


                    <div class="form-group">

                     <label for="Ingresar la serie">Fecha almacenamiento</label>

                     <div class="input-group">



                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 



                      <input type="date" class="form-control input-lg" id="nuevoFechaAlmacenamiento" name="nuevoFechaAlmacenamiento" required>



                    </div>



                  </div>

                </div>

              </div>



            </div>



          </div>



        <!--=====================================

        PIE DEL MODAL

        ======================================-->



        <div class="modal-footer">



          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>



          <button type="submit" class="btn btn-primary">Guardar documento</button>



        </div>



        <?php

        $crearDocumento = ControladorTipoDocumento::ctrAgregarTipoDocumento();


        ?>



      </form>



    </div>



  </div>



</div>













<!--=====================================

MODAL AGREGAR USUARIO

======================================-->



<div id="modalAgregarGastos" class="modal fade" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">



  <div class="modal-dialog modal-lg">



    <div class="modal-content">



      <form role="form" method="post" enctype="multipart/form-data">



        <!--=====================================

        CABEZA DEL MODAL

        ======================================-->



        <div class="modal-header" style="background:#3c8dbc; color:white">



          <button type="button" class="close salirDocumentoCompra" data-dismiss="modal">&times;</button>



          <h4 class="modal-title">Agregar ingreso</h4>



        </div>



        <!--=====================================

        CUERPO DEL MODAL

        ======================================-->



        <div class="modal-body">



          <div class="box-body">


            <div class="row">

              <div class="col-md-6">  


               <div class="form-group">

                <label for="Responsable">Responsable</label>

                <div class="input-group">



                  <span class="input-group-addon"><i class="fa fa-user"></i></span> 



                  <input type="text" class="form-control input-lg" id="nuevoResponsableGastos" name="nuevoResponsableGastos" placeholder="Ingresar responsable de la compra" required>



                </div>



              </div>
            </div>
          </div>



          <!-- ENTRADA PARA EL MONTO -->

          <div class="row">

            <div class="col-md-4">  


              <div class="form-group">

                <label for="Producto">Producto</label>

                <div class="input-group">



                  <span class="input-group-addon"><i class="fa fa-th"></i></span> 



                  <input type="text" class="form-control input-lg" id="nuevoDescripcionGastos" name="nuevoDescripcionGastos" placeholder="descripcion">



                </div>



              </div>


            </div>




            <div class="col-md-2">  



              <div class="form-group">

                <label for="Cantidad">Cantidad</label>

                <div class="input-group">



                  <span class="input-group-addon"><i class="fa fa-th"></i></span> 



                  <input type="text" class="form-control input-lg" id="nuevoCantidadGastos" name="nuevoCantidadGastos">



                </div>



              </div>

            </div>

            <!-- </div> -->







            <div class="col-md-3">  




              <div class="form-group">

                <label for="Monto">Monto</label>

                <div class="input-group">



                  <span class="input-group-addon"><i class="fa fa-dollar"></i></span> 



                  <input type="text" class="form-control input-lg" id="nuevoMontoGastos" name="nuevoMontoGastos" placeholder="monto">



                </div>

              </div> 

            </div> 

            <!--  </div>  -->



            <div class="col-md-3">  

              <div class="form-group">


                <label for="Monto total">Monto total</label>
                <div class="input-group">



                  <span class="input-group-addon"><i class="fa fa-dollar"></i></span> 



                  <input type="text" class="form-control input-lg" id="nuevoMontoGastosTotal" name="nuevoMontoGastosTotal" placeholder="monto total" readonly>



                </div>



              </div> 
            </div> 
          </div> 


          <!-- ENTRADA PARA LA FECHA VENCIDA -->

            <!-- <div class="form-group">
            
            
            
              <div class="input-group">
            
            
            
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
            
            
            
                <input type="date" class="form-control input-lg" id="nuevoFechaGastos" name="nuevoFechaGastos" placeholder="Ingresar fecha" required>
            
            
            
              </div>
            
            
            
            </div> -->



            <button  class="btn btn-success pull-right btnAgregarProductoDocumento"><i class="fa fa-check"></i></button>


          </div>


          <table class="table table-bordered table-striped table-responsive" id="tablaProductoDocumento" style="width:100%">


            <thead>



              <tr>



                <!--   <th style="width:10px">#</th> -->

                <th>Producto</th>

                <th>Cantidad</th>

                <th>Precio uni</th> 

                <th>Total</th> 

                <th>Acciones</th>

              </tr> 


            </thead>    

            <tbody id="listaProductoComprado">

           <!--  <tr>
             
             <td>Lapto Core I5</td>
             <td>3</td>
             <td>1200</td>
             <td>3600</td>
             <td><a class="btn btn-danger btnEliminarProductoDocumento"><i class="fa fa-times"></i></a></td>
           
           
           </tr> -->





         </tbody>






       </table>


       <div class="row">

                  <!--=====================================
                  ENTRADA IMPUESTOS Y TOTAL
                  ======================================-->
                  
                  <div class="col-xs-8 pull-right">

                    <table class="table">

                      <thead>

                        <tr>
                          <th>Impuesto</th>
                          <th>Total</th>      
                        </tr>

                      </thead>

                      <tbody>

                        <tr>

                          <td style="width: 50%">

                            <div class="input-group">

                              <input type="number" class="form-control input-lg" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" placeholder="0" required readonly>

                              <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" required>

                              <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" required>

                              <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                            </div>

                          </td>

                          <td style="width: 50%">

                            <div class="input-group">

                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                              <input type="text" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" total="" placeholder="00000" readonly required>

                              <input type="hidden" name="totalVenta" id="totalVenta">


                              

                            </div>

                          </td>

                        </tr>

                      </tbody>

                    </table>

                  </div>

                </div>

                <input type="hidden" name="id_tipodocumento_detalle" id="id_tipodocumento_detalle">
                <input type="hidden" id="listaProductosDocumento" name="listaProductosDocumento">

              </div>



        <!--=====================================

        PIE DEL MODAL

        ======================================-->



        <div class="modal-footer">



          <button type="button" class="btn btn-default pull-left salirDocumentoCompra" data-dismiss="modal">Salir</button>



          <button type="submit" class="btn btn-primary guardarCompraProveedores">Guardar compra</button>



        </div>



        <?php



        $agregarCompras = ControladorCompras::ctrActualizarCompras();



        ?>



      </form>



    </div>



  </div>



</div>

































<!--=====================================

MODAL AGREGAR USUARIO

======================================-->


<!-- 
<div id="modalAgregarGastos2" class="modal fade" role="dialog">



  <div class="modal-dialog">



    <div class="modal-content">



      <form role="form" method="post" enctype="multipart/form-data">



        =====================================

        CABEZA DEL MODAL

        ======================================



        <div class="modal-header" style="background:#3c8dbc; color:white">



          <button type="button" class="close" data-dismiss="modal">&times;</button>



          <h4 class="modal-title">Agregar ingreso</h4>



        </div>



        =====================================

        CUERPO DEL MODAL

        ======================================



        <div class="modal-body">



          <div class="box-body">



            ENTRADA PARA EL MONTO



            <div class="form-group">



              <div class="input-group">



                <span class="input-group-addon"><i class="fa fa-th"></i></span> 



                <input type="text" class="form-control input-lg" id="nuevoDescripcionGastos" name="nuevoDescripcionGastos" placeholder="Ingresar descripcion" required>



              </div>



            </div>


            <div class="form-group">



              <div class="input-group">



                <span class="input-group-addon"><i class="fa fa-th"></i></span> 



                <input type="text" class="form-control input-lg" id="nuevoCantidadGastos" name="nuevoCantidadGastos" placeholder="Ingresar cantidad" required>



              </div>



            </div>


            <div class="form-group">



              <div class="input-group">



                <span class="input-group-addon"><i class="fa fa-dollar"></i></span> 



                <input type="text" class="form-control input-lg" id="nuevoMontoGastos" name="nuevoMontoGastos" placeholder="Ingresar monto" required>



              </div>



            </div> 


            <div class="form-group">



              <div class="input-group">



                <span class="input-group-addon"><i class="fa fa-dollar"></i></span> 



                <input type="text" class="form-control input-lg" id="nuevoMontoGastosTotal" name="nuevoMontoGastosTotal" placeholder="Gasto total" required readonly>



              </div>



            </div> 
            

            ENTRADA PARA LA FECHA VENCIDA

            <div class="form-group">



              <div class="input-group">



                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 



                <input type="date" class="form-control input-lg" id="nuevoFechaGastos" name="nuevoFechaGastos" placeholder="Ingresar fecha" required>



              </div>



            </div>

            <div class="form-group">



              <div class="input-group">



                <span class="input-group-addon"><i class="fa fa-user"></i></span> 



                <input type="text" class="form-control input-lg" id="nuevoResponsableGastos" name="nuevoResponsableGastos" placeholder="Ingresar responsable de la compra" required>



              </div>



            </div>


          </div>



        </div>



        =====================================

        PIE DEL MODAL

        ======================================



        <div class="modal-footer">



          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>



          <button type="submit" class="btn btn-primary">Guardar compra</button>



        </div>



        <?php



     /*   $crearGasto = new ControladorPresupuesto();

        $crearGasto -> ctrIngresarGastos();*/



        ?>



      </form>



    </div>



  </div>



</div> -->













<!--=====================================

MODAL EDITAR USUARIO

======================================-->



<!-- <div id="modalEditarGastos" class="modal fade" role="dialog">



  <div class="modal-dialog">



    <div class="modal-content">



      <form role="form" method="post" enctype="multipart/form-data">



        =====================================

        CABEZA DEL MODAL

        ======================================



        <div class="modal-header" style="background:#3c8dbc; color:white">



          <button type="button" class="close" data-dismiss="modal">&times;</button>



          <h4 class="modal-title">Editar compra</h4>



        </div>



        =====================================

        CUERPO DEL MODAL

        ======================================



        <div class="modal-body">



          <div class="box-body">



            ENTRADA PARA LA DESCRIPCION

            

            <div class="form-group">



              <div class="input-group">



                <span class="input-group-addon"><i class="fa fa-th"></i></span> 



                <input type="text" class="form-control input-lg" id="editarDescripcionGastos" name="editarDescripcionGastos" placeholder="Editar descripcion" required>

                <input type="hidden" id="idPresupuesto" name="id">



              </div>



            </div>



            <div class="form-group">



              <div class="input-group">



                <span class="input-group-addon"><i class="fa fa-th"></i></span> 



                <input type="text" class="form-control input-lg" id="editarCantidadGastos" name="editarCantidadGastos" placeholder="Editar cantidad" required>


              </div>



            </div>



            ENTRADA PARA EL GASTO



            <div class="form-group">



              <div class="input-group">



                <span class="input-group-addon"><i class="fa fa-dollar"></i></span> 



                <input type="text" class="form-control input-lg" id="editarMontoGastos" name="editarMontoGastos" placeholder="Editar monto" required>



              </div>



            </div>





            <div class="form-group">



              <div class="input-group">



                <span class="input-group-addon"><i class="fa fa-dollar"></i></span> 



                <input type="text" class="form-control input-lg" id="editarMontoGastosTotal" name="editarMontoGastosTotal" placeholder="Editar monto total" required readonly>



              </div>



            </div>




            <div class="form-group">



              <div class="input-group">



                <span class="input-group-addon"><i class="fa fa-user"></i></span> 



                <input type="text" class="form-control input-lg" id="editarResponsableGastos" name="editarResponsableGastos" placeholder="Editar responsable" required>



              </div>



            </div>



            ENTRADA PARA LA FECHA



            <div class="form-group">



              <div class="input-group">



                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 



                <input type="date" class="form-control input-lg" id="editaroFechaGastos" name="editaroFechaGastos" placeholder="Editar fecha" required>



              </div>



            </div>


          </div>



        </div>



        =====================================

        PIE DEL MODAL

        ======================================



        <div class="modal-footer">



          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>



          <button type="submit" class="btn btn-primary">Modificar compra</button>



        </div>



        <?php


/*
        $editarGastos = new ControladorPresupuesto();

        $editarGastos -> ctrEditarGastos();*/



        ?> 



      </form>



    </div>



  </div>



</div> -->





<?php



$eliminarDocumentoDeCompra = ControladorTipoDocumento::ctrEliminarTipoDocumento();



?> 








<div id="modalBuscarProveedor" class="modal fade" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">



  <div class="modal-dialog">



    <div class="modal-content">



      <form role="form" method="post">



        <!--=====================================

        CABEZA DEL MODAL

        ======================================-->



        <div class="modal-header" style="background:#3c8dbc; color:white">



          <button type="button" class="close" data-dismiss="modal">&times;</button>



          <h4 class="modal-title">Buscar cliente</h4>



        </div>



        <!--=====================================

        CUERPO DEL MODAL

        ======================================-->



        <div class="modal-body">



          <div class="box-body">



           <div class="form-group">



            <div class="input-group">



              <span class="input-group-addon"><i class="fa fa-users"></i></span>
              
              
              
              <input type="text"class="form-control buscarClienteVendedora" id="buscarClienteVendedora" name="buscarClienteVendedora" required>


              

            </div>



          </div>


           <!--  <div id="listaClienteVendedoras">
             
           
           
           
           
             
           </div> -->
           <table class="table table-bordered table-responsive table-striped dt-responsive tablaListaCliente" id="tablaListaCliente" width="100%">

            <thead id="cabezeraVentasCliente" class="text">

              <!-- <tr>
                <th style="">Código</th>
                <th>Categoría</th>
                <th>Subcategoría</th>
                <th>Marcas</th>
                <th>Productos</th>              
                <th>Ventas</th>               
                <th>Acciones</th>
              
              </tr> -->

            </thead>

            <tbody id="listaVentasCliente">



            </tbody>

          </table> 




        </div>


      </div>

      <div id="mensajeSeleccionado"></div>


        <!--=====================================

        PIE DEL MODAL

        ======================================-->



        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary buscarClien">Buscar</button>



        </div>


      </form>



    </div>



  </div>



</div>










<div id="modalAgregarProveedor" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar proveedor</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">



            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" maxlength="11" class="form-control input-lg" id="nuevoRucProveedor" name="nuevoRucProveedor" placeholder="Ingresar ruc" required>

              </div>

            </div>


            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" id="nuevoNombreProveedor" name="nuevoNombreProveedor" placeholder="Ingresar proveedor" required>

              </div>

            </div>


            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" id="nuevoDireccionProveedor" name="nuevoDireccionProveedor" placeholder="Ingresar direccción" required>

              </div>

            </div>



            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                <input type="text" class="form-control input-lg" id="nuevoTelefonoProveedor" name="nuevoTelefonoProveedor" placeholder="Ingresar el teléfono" data-inputmask='"mask": "(999) 999999"' data-mask>

              </div>

            </div>

            <!-- ENTRADA PARA EL EMAIL -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                <input type="email" class="form-control input-lg" name="nuevoEmailProveedor" id="nuevoEmailProveedor" placeholder="Ingresar email" id="nuevoEmail" required>

              </div>

            </div>


          </div>

        </div>

        <div id="mensajeP"></div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->



        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary guardarProveedor">Guardar proveedor</button>

        </div>


      </form>

    </div>

  </div>

</div>









<!--=====================================
=            AGREGAR FACTURA            =
======================================-->


<div id="modalEditarDocumento" class="modal fade" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">



  <div class="modal-dialog modal-lg">



    <div class="modal-content">



      <form role="form" method="post" enctype="multipart/form-data">



        <!--=====================================

        CABEZA DEL MODAL

        ======================================-->



        <div class="modal-header" style="background:#3c8dbc; color:white">



          <button type="button" class="close" data-dismiss="modal">&times;</button>



          <h4 class="modal-title">Editar documento</h4>



        </div>



        <!--=====================================

        CUERPO DEL MODAL

        ======================================-->



        <div class="modal-body">



          <div class="box-body">


            <div class="form-group">



              <div class="input-group">



                <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span> 



                <select class="form-control input-lg" name="editarProveedorDocumento" id="editarProveedorDocumento" required>



                  <option value="">Selecionar proveedor</option>

                  <?php 

                  $item = null;
                  $valor = null;

                  $tipodocumento = ControladorProveedor::ctrMostrarProveedores($item, $valor);

                  foreach ($tipodocumento as $key => $value) {

                    echo '<option value="'.$value['id'].'">'.$value['proveedor'].'</option>';



                  }


                  ?>              



                </select>

                <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs bu" data-toggle="modal" data-target="#modalAgregarProveedor" data-dismiss="modal">Agregar proveedor</button></span>

                <!-- <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs bu" data-toggle="modal" data-target="#modalBuscarProveedor" data-dismiss="modal">Buscar proveedor</button></span> -->



              </div>



            </div>







          <!--  <div class="row">
          
           <div class="col-md-12">  
          
            <label for="Ingresar la serie">Ingresar proveedor </label>
          
            <div class="form-group">
          
             <div class="input-group">
          
               <span class="input-group-addon"><i class="fa fa-th"></i></span> 
          
               <input type="text" class="form-control input-lg" id="nuevoProveedorDocumento" name="nuevoProveedorDocumento" placeholder="Proveedor" required readonly>
          
               <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs bu" data-toggle="modal" data-target="#modalAgregarProveedor" data-dismiss="modal">Agregar proveedor</button></span>
          
               <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs bu" data-toggle="modal" data-target="#modalBuscarProveedor" data-dismiss="modal">Buscar proveedor</button></span>
          
               <button  class="btn btn-success pull-right"><i class="fa fa-check"></i></button>
          
          
             </div>
          
          
           </div>
          
          
                    </div>
          
          
          
                  </div> -->



                  <!-- ENTRADA PARA EL DOCUMENTO -->



                  <div class="form-group">



                    <div class="input-group">



                      <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span> 



                      <select class="form-control input-lg" name="editarTipoDocumento" id="editarTipoDocumento" required>



                        <option value="">Selecionar documento</option>

                        <?php 

                        $item = null;
                        $valor = null;

                        $tipodocumento = ControladorTipoDocumento::ctrMostrarTipoDocumento($item, $valor);

                        foreach ($tipodocumento as $key => $value) {

                          echo '<option value="'.$value['id'].'">'.$value['tipo'].'</option>';



                        }


                        ?>              



                      </select>



                    </div>



                  </div>




                  <div class="row">

                    <div class="col-md-4">  

                     <label for="Ingresar la serie">Serie del documento </label>

                     <div class="form-group">

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                        <input type="text" class="form-control input-lg" id="editarSerieDocumento" name="editarSerieDocumento" placeholder="Serie" required>

                        <input type="hidden" id="idDocumentoCompra" name="idDocumentoCompra" value="">

                      </div>


                    </div>


                  </div>



                  <div class="col-md-8">

                    <div class="form-group">

                      <label for="Ingresar la serie"> N° del documento</label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                        <input type="text" class="form-control input-lg" id="editarNumeroDocumento" name="editarNumeroDocumento" placeholder="Ingresar número documento" required>


                      </div>


                    </div> 


                  </div> 


                </div> 



                <div class="row">

                  <div class="col-md-6">  

                    <div class="form-group">

                      <label for="Ingresar la serie">Fecha emisión</label>

                      <div class="input-group daterange">

                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 



                        <input type="date" class="form-control input-lg" id="editarFechaEmision" name="editarFechaEmision" required>



                      </div>



                    </div>

                  </div>


                  <!-- ENTRADA PARA LA FECHA VENCIDA -->



                  <div class="col-md-6">  


                    <div class="form-group">

                     <label for="Ingresar la serie">Fecha almacenamiento</label>

                     <div class="input-group">



                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 



                      <input type="date" class="form-control input-lg" id="editarFechaAlmacenamiento" name="editarFechaAlmacenamiento" required>



                    </div>



                  </div>

                </div>

              </div>



            </div>



          </div>



        <!--=====================================

        PIE DEL MODAL

        ======================================-->



        <div class="modal-footer">



          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>



          <button type="submit" class="btn btn-primary">Guardar documento</button>



        </div>



        <?php

        $editarDocumento = ControladorTipoDocumento::ctrActualizarTipoDocumento();


        ?>



      </form>



    </div>



  </div>



</div>















<!--=====================================
MODAL AGREGAR USUARIO
======================================-->

<div id="modalEscogerFormato" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">


        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Seleccione su formato</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA LA CAEGORIA -->


            <figure class="col-xs-4">

              <center>
                <label for=""> Horizontal</label>


              </center> 

              <a href ="#" class="irHorizontal">

                <img src="vistas/img/plantilla/horizontal.png"  class="img-thumbnail reporteHorizontal"  width='130px'>

              </a>


            </figure>


            <figure class="col-xs-4">

              <center>
                <label for=""> Vertical</label>


              </center>

              <a href ="#" class="irVertical">

                <img src="vistas/img/plantilla/vertical.png" class="img-thumbnail reporteVertical" width='130px'> 

              </figure>

            </a>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

        </div>


      </form>

    </div>

  </div>

</div>


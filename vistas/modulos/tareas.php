<?php 

$rol = $_SESSION["perfil"];

$validar = ControladorUsuarios::ctrRolVendedor($rol);


?>



<div class="content-wrapper">

	<section class="content-header">

		<h1>

			Administrar equipos

		</h1>

		<ol class="breadcrumb">

			<li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

			<li class="active">Administrar equipos</li>

		</ol>

	</section>

	<section class="content">

		<div class="box">

			<div class="box-header with-border">

				<button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto">

					Agregar equipo

				</button>

			</div>

			<div class="box-body">

				<table class="table table-bordered table-striped table-responsive" style="width:100%" id="tablaTareas">

					<thead>

						<tr>

							<th style="width:10px">#</th>
							<th>Categoria</th>
							<th>Area</th>
              <th>Alias</th>
              <th>Usuario</th>
              <!--   <th>Serie</th> -->
              <th>Marca</th>
              <th>Modelo</th>
              <th>Código Barra</th>
              <th>Detalles</th>
              <th>Estado</th>
              <th>Imagen</th>
              <th>Fecha registro</th>
              <th>Último mantenimiento</th>
              <th>Acciones</th>
            </tr> 

          </thead>

        </table>

      </div>

    </div>

  </section>

</div>






<!--=====================================
MODAL AGREGAR PRODUCTO
======================================-->

<div id="modalAgregarProducto" class="modal fade" role="dialog">

	<div class="modal-dialog modal-lg">

		<div class="modal-content">

			<form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

        	<button type="button" class="close" data-dismiss="modal">&times;</button>

        	<h4 class="modal-title">Agregar Equipo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

        	<div class="box-body">


            <div class="row">

              <div class="col-md-12">  

                <div class="form-group">

                 <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-gears"></i></span> 

                  <input type="text" class="form-control input-lg" id="nuevaAliasoEquipo"  name="nuevaAliasoEquipo" placeholder="Ingresar alias">

                </div>

              </div>


            </div>


          </div>









          <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->

          <?php 

          $item = null;
          $valor = null;

          $categorias = ControladorCategoria::ctrMostrarCategoria($item, $valor);

          ?>

          <div class="row">

            <div class="col-md-4">  

              <div class="form-group">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                  <select class="form-control input-lg" id="nuevaCategoriaEquipo"  name="nuevaCategoriaEquipo" required>

                    <option value="">Selecionar categoría</option>

                    <?php foreach ($categorias as $key => $value) { ?>                 

                      <option value="<?=$value['id']?>"><?=$value['categoria']?></option>

                    <?php } ?>

                  </select>

                </div>

              </div>

            </div>


            <div class="col-md-4">  

              <div class="form-group">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                  <select class="form-control input-lg" id="nuevaAreaEquipo"  name="nuevaAreaEquipo" required>

                    <option value="">Seleccionar área</option>

                    <?php 

                    $areas = ControladorArea::ctrMostrarAreas($item, $valor);


                    foreach ($areas as $key => $value) { ?>                 

                      <option value="<?=$value['id']?>"><?=$value['area']?></option>

                    <?php } ?>

                  </select>

                </div>

              </div>

            </div>


            <div class="col-md-4">  

              <div class="form-group">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                  <select class="form-control input-lg" id="nuevaUsuarioEquipo"  name="nuevaUsuarioEquipo" required>

                    <option value="">Selecionar usuario</option>

                    <?php 

                    $clientes = ControladorCliente::ctrMostrarCliente($item, $valor);


                    foreach ($clientes as $key => $value) { ?>                 

                      <option value="<?=$value['id']?>"><?=$value['nombre']?></option>

                    <?php } ?>

                  </select>

                </div>

              </div>

            </div>

          </div>

          <!-- ENTRADA PARA EL CÓDIGO -->

          <div class="row">

            <div class="col-md-6">  

              <div class="form-group">

               <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-code"></i></span> 

                <input type="text" class="form-control input-lg" id="nuevaSerieEquipo" name="nuevaSerieEquipo" placeholder="Ingresar serie" required>

              </div>

            </div>

          </div>


          <div class="col-md-6">  

            <div class="form-group">

             <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-code"></i></span> 

              <input type="text" class="form-control input-lg" id="nuevaMarcaEquipo" name="nuevaMarcaEquipo" placeholder="Ingresar marca" required>

            </div>

          </div>

        </div>

      </div>

      <!-- ENTRADA PARA LA DESCRIPCIÓN -->

      <div class="row">

        <div class="col-md-6">  

          <div class="form-group">

           <div class="input-group">

            <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

            <input type="text" class="form-control input-lg" id="nuevaModeloEquipo"  name="nuevaModeloEquipo" placeholder="Ingresar modelo" required>

            <input type="hidden" id="listaCaracteristicasDetallesEquipos" name="listaCaracteristicasDetallesEquipos" value="">

          </div>

        </div>


      </div>

     <!-- INGRESAR CODIGO DE BARRA -->

      <div class="col-md-6">  

          <div class="form-group">

           <div class="input-group">

            <span class="input-group-addon"><i class="fa fa-barcode"></i></span> 

            <input type="text" class="form-control input-lg" id="nuevaCodBarraEquipo"  name="nuevaCodBarraEquipo" placeholder="Ingresar código barra">
 

          </div>

        </div>


      </div>


    </div>



    <div class="row">

      <div class="col-md-4"> 

        <label for="detalles">Características</label>

        <div class="form-group">

          <div class="input-group">

            <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span> 

            <input type="text" class="form-control input-lg" id="nuevoCaracteristicaEquipo" name="nuevoCaracteristicaEquipo" min="0" placeholder="Ingrese características">

          </div>

        </div>

      </div>

      <div class="col-md-6"> 

        <label for="detalles">Detalles</label>

        <div class="form-group">

          <div class="input-group">

            <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span> 

            <input type="text" class="form-control input-lg" id="nuevoDetallesEquipo" name="nuevoDetallesEquipo" min="0" placeholder="Ingrese detalles">

          </div>

        </div>

      </div>


      <div class="col-md-2"> 

        <label for="detalles"></label>

        <div class="form-group">

          <div class="input-group">

            <button  class="btn btn-success pull-right btnAgregarDetallesEquipo"><i class="fa fa-check"></i></button>

          </div>

        </div>

      </div>
    </div>



    <table class="table table-bordered table-striped table-responsive" id="tablaDetallesEquipo" style="width:100%">


      <thead>



        <tr>



          <!--   <th style="width:10px">#</th> -->

          <th>Caracteríticas</th>

          <th>Detalles</th>             
        </tr> 


      </thead>    

      <tbody id="listaDetallesEquipo">

           <!--  <tr>
             
             <td>Lapto Core I5</td>
             <td>3</td>
             <td>1200</td>
             <td>3600</td>
             <td><a class="btn btn-danger btnEliminarProductoDocumento"><i class="fa fa-times"></i></a></td>
           
           
           </tr> -->





         </tbody>






       </table> <br>







       <!-- ENTRADA PARA SUBIR FOTO -->

       <div class="row">


        <div class="col-md-6"> 

          <label for="detalles">Fecha registro</label>

          <div class="form-group">

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span> 

              <input type="date" class="form-control input-lg" id="nuevaFechaEquipo" name="nuevaFechaEquipo" required>

            </div>

          </div>

        </div>



        
        <div class="col-md-6">  

          <div class="form-group">

            <label for="estado">Estado del dispositvo</label>
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-th"></i></span> 

              <select class="form-control input-lg" id="nuevaEstadoEquipo"  name="nuevaEstadoEquipo" required>

                <option value="">Selecionar estado</option>               

                
                <option value="1">Excelente</option>
                <option value="2">Falta mantenimiento</option>
                <option value="3">Falta piezas</option>
                <option value="4">Dar de baja</option>

                

              </select>

            </div>

          </div>

        </div>


      </div>


      <div class="row">


        <div class="col-md-6">

         <div class="form-group">

          <div class="panel">SUBIR IMAGEN</div>

          <input type="file" class="nuevaImagen" name="nuevaImagen">

          <p class="help-block">Peso máximo de la imagen 2MB</p>

          <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

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

        	<button type="submit" class="btn btn-primary">Guardar equipo</button>

        </div>

        <?php

        $ingresarEquipo = ControladorEquipo::ctrCrearEquipos();

        ?>

      </form>

    </div>

  </div>

</div>
















<!--=====================================
MODAL EDITAR PRODUCTO
======================================-->

<div id="modalEditarEquipo" class="modal fade" role="dialog">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Equipo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


           <div class="row">

            <div class="col-md-12">  

              <div class="form-group">

               <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-gears"></i></span> 

                <input type="text" class="form-control input-lg" id="editarAliasoEquipo"  name="editarAliasoEquipo">

              </div>

            </div>


          </div>


        </div>



        <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->

        <div class="row">

          <div class="col-md-4">  

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" id="editarCategoriaEquipo"  name="editarCategoriaEquipo" required>

                  <option value="">Selecionar categoría</option>

                  <?php foreach ($categorias as $key => $value) { ?>                 

                    <option value="<?=$value['id']?>"><?=$value['categoria']?></option>

                  <?php } ?>

                </select>

              </div>

            </div>

          </div>


          <div class="col-md-4">  

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" id="editarAreaEquipo"  name="editarAreaEquipo" required>

                  <option value="">Seleccionar área</option>

                  <?php 

                  $areas = ControladorArea::ctrMostrarAreas($item, $valor);


                  foreach ($areas as $key => $value) { ?>                 

                    <option value="<?=$value['id']?>"><?=$value['area']?></option>

                  <?php } ?>

                </select>

              </div>

            </div>

          </div>


          <div class="col-md-4">  

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" id="editarUsuarioEquipo"  name="editarUsuarioEquipo" required>

                  <option value="">Selecionar usuario</option>

                  <?php 

                  $clientes = ControladorCliente::ctrMostrarCliente($item, $valor);


                  foreach ($clientes as $key => $value) { ?>                 

                    <option value="<?=$value['id']?>"><?=$value['nombre']?></option>

                  <?php } ?>

                </select>

              </div>

            </div>

          </div>

        </div>



        <!-- ENTRADA PARA EL CÓDIGO -->

        <div class="row">

          <div class="col-md-6">  

            <div class="form-group">

             <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-code"></i></span> 

              <input type="text" class="form-control input-lg" id="editarSerieEquipo" name="editarSerieEquipo" placeholder="Ingresar serie" required>

              <input type="hidden" id="idEditar" name="idEditar">

            </div>

          </div>

        </div>


        <div class="col-md-6">  

          <div class="form-group">

           <div class="input-group">

            <span class="input-group-addon"><i class="fa fa-code"></i></span> 

            <input type="text" class="form-control input-lg" id="editarMarcaEquipo" name="editarMarcaEquipo" placeholder="Ingresar marca" required>

          </div>

        </div>

      </div>

    </div>



    <!-- ENTRADA PARA LA DESCRIPCIÓN -->

    <div class="row">

      <div class="col-md-6">  

        <div class="form-group">

         <div class="input-group">

          <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

          <input type="text" class="form-control input-lg" id="editarModeloEquipo"  name="editarModeloEquipo" placeholder="Ingresar modelo" required>

          <input type="hidden" id="editarlistaCaracteristicasDetallesEquipos" name="editarlistaCaracteristicasDetallesEquipos" value="">

        </div>

      </div>


    </div>



    <!-- INGRESAR CODIGO DE BARRA -->

      <div class="col-md-6">  

          <div class="form-group">

           <div class="input-group">

            <span class="input-group-addon"><i class="fa fa-barcode"></i></span> 

            <input type="text" class="form-control input-lg" id="editarCodBarraEquipo"  name="editarCodBarraEquipo" placeholder="Editar código barra">
 

          </div>

        </div>


      </div>



  </div>



  <div class="row">

    <div class="col-md-4"> 

      <label for="detalles">Características</label>

      <div class="form-group">

        <div class="input-group">

          <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span> 

          <input type="text" class="form-control input-lg" id="editarCaracteristicaEquipo" name="editarCaracteristicaEquipo" min="0" placeholder="Ingrese características">

        </div>

      </div>

    </div>

    <div class="col-md-6"> 

      <label for="detalles">Detalles</label>

      <div class="form-group">

        <div class="input-group">

          <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span> 

          <input type="text" class="form-control input-lg" id="editarDetallesEquipo" name="editarDetallesEquipo" min="0" placeholder="Ingrese detalles">

        </div>

      </div>

    </div>

    <div class="col-md-2"> 

      <label for="detalles"></label>

      <div class="form-group">

        <div class="input-group">

          <button  class="btn btn-success pull-right btnEditarDetallesEquipo"><i class="fa fa-check"></i></button>

        </div>

      </div>

    </div>


    <table class="table table-bordered table-striped table-responsive" id="tablaDetallesEquipoEditar" style="width:100%">


      <thead>



        <tr>



          <!--   <th style="width:10px">#</th> -->

          <th>Caracteríticas</th>

          <th>Detalles</th>             
        </tr> 


      </thead>    

      <tbody id="listaEditarDetallesEquipo">

           <!--  <tr>
             
             <td>Lapto Core I5</td>
             <td>3</td>
             <td>1200</td>
             <td>3600</td>
             <td><a class="btn btn-danger btnEliminarProductoDocumento"><i class="fa fa-times"></i></a></td>
           
           
           </tr> -->





         </tbody>






       </table> <br>








     </div>





     <!-- ENTRADA PARA SUBIR FOTO -->

     <div class="row">

      <div class="col-md-6"> 

        <label for="detalles">Fecha registro</label>

        <div class="form-group">

          <div class="input-group">

            <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span> 

            <input type="date" class="form-control input-lg" id="editarFechaEquipo" name="editarFechaEquipo" required>

          </div>

        </div>

      </div>




      <div class="col-md-6">  

        <div class="form-group">

          <label for="estado">Estado del dispositvo</label>

          <div class="input-group">

            <span class="input-group-addon"><i class="fa fa-th"></i></span> 

            <select class="form-control input-lg" id="editarEstadoEquipo"  name="editarEstadoEquipo" required>

              <option value="">Selecionar estado</option>               


              <option value="1">Excelente</option>
              <option value="2">Falta mantenimiento</option>
              <option value="3">Falta piezas</option>
              <option value="4">Dar de baja</option>



            </select>

          </div>

        </div>

      </div>

    </div>

    <div class="row">

      <div class="col-md-6">

        <div class="form-group">

          <div class="panel">SUBIR IMAGEN</div>

          <input type="file" class="editarImagen" name="editarImagen">

          <p class="help-block">Peso máximo de la imagen 2MB</p>

          <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

          <input type="hidden" name="imagenActual" id="imagenActual">

        </div>


      </div>


      



    </div>





  </div>

</div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left salirEditarDetalleModal" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Cambios</button>

        </div>

        <?php

        $editarEquipo = ControladorEquipo::ctrEditarEquipos();

        ?>

      </form>

    </div>

  </div>

</div>










<!--=====================================
MODAL EDITAR PRODUCTO
======================================-->

<div id="modalVerDetalles" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Ver Detalles</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">



            <table class="table table-bordered table-striped table-responsive" id="tablaDetallesEquipoPorId" style="width:100%">


              <thead>



                <tr>



                  <!--   <th style="width:10px">#</th> -->

                  <th>Características</th>

                  <th>Detalles</th>             
                </tr> 


              </thead>    

              <tbody id="listaDetallesEquipoPorId">

           <!--  <tr>
             
             <td>Lapto Core I5</td>
             <td>3</td>
             <td>1200</td>
             <td>3600</td>
             <td><a class="btn btn-danger btnEliminarProductoDocumento"><i class="fa fa-times"></i></a></td>
           
           
           </tr> -->





         </tbody>






       </table> 






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

<?php

$borrarEquipo = ControladorEquipo::ctrEliminarEquipos();

?>
<div class="content-wrapper">

	<section class="content-header">

		<h1>

			Administrar Usuarios

		</h1>

		<ol class="breadcrumb">

			<li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

			<li class="active">Administrar usuarios</li>

		</ol>

	</section>

	<section class="content">

		<div class="box">

			<div class="box-header with-border">

				<button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCliente">

					Agregar usuario

				</button>

                <!-- <button class="btn btn-danger" data-toggle="modal" data-target="#modalAgregarPisos">
                
                    Agregar pisos
                
                </button>
            -->
        </div>

        <div class="box-body">

            <table class="table table-bordered table-striped dt-responsive tablaClientes">

               <thead>

                  <tr>

                     <th style="width:10px">#</th>
                     <th>Nombre</th>
                     <th>Área</th>							 
                     <th>Dni</th>												
                     <th>Email</th>                                               
                     <th>Teléfono</th>
                     <th>Dirección</th>							               
                     <th>Acciones</th>

                 </tr> 

             </thead>					

         </table>

     </div>

 </div>

</section>

</div>


<!--=====================================
MODAL AGREGAR USUARIO
======================================-->

<div id="modalAgregarCliente" class="modal fade" role="dialog">

	<div class="modal-dialog">

		<div class="modal-content">

			<form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

        	<button type="button" class="close" data-dismiss="modal">&times;</button>

        	<h4 class="modal-title">Agregar usuario</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

        	<div class="box-body">


               <div class="row">

                <div class="col-md-12">

                    <div class="form-group">

                        <label for="Área">Área</label>

                        <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-users"></i></span>

                            <select class="form-control input-lg" id="nuevoAreaCliente" name="nuevoAreaCliente" required>

                              <option value="">Seleccionar area</option>

                              <?php 

                              $item = null;
                              $valor = null;

                              $areas = ControladorArea::ctrMostrarAreas($item, $valor); 

                              foreach ($areas as $key => $value) { ?>

                                <option value="<?=$value['id']?>"><?=$value['area']?></option>  

                                <?php

                            }

                            ?>



                        </select> 

                    </div>
                </div>


            </div>

        </div>





        <div class="form-group">

         <div class="input-group">

            <span class="input-group-addon"><i class="fa fa-user"></i></span> 

            <input type="text" class="form-control input-lg" id="nuevoCliente" name="nuevoCliente" placeholder="Ingresar nombre" required>

        </div>

    </div>




    <div class="row">

        <div class="col-md-6"> 

          <div class="form-group">

             <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="number" min="0" class="form-control input-lg" id="nuevoDocumentoID" name="nuevoDocumentoID" placeholder="Ingresar Documento de ID" >

            </div>

        </div>
    </div>



    <div class="col-md-6"> 
        <div class="form-group">

         <div class="input-group">

            <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

            <input type="email" class="form-control input-lg" id="nuevoEmail" name="nuevoEmail" placeholder="Ingresar el email">

        </div>

    </div>
</div>
</div>




<div class="row">

    <div class="col-md-6"> 

        <div class="form-group">

         <div class="input-group">

            <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

            <input type="text" class="form-control input-lg" id="nuevoTelefono" name="nuevoTelefono" placeholder="Ingresar el teléfono" data-inputmask='"mask": "(999) 999-999999"' data-mask>

        </div>

    </div>
</div>





<div class="col-md-6"> 

   <div class="form-group">

    <div class="input-group">

        <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

        <input type="text" class="form-control input-lg" id="nuevaDireccion" name="nuevaDireccion" placeholder="Ingresar la dirección">

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

        	<button type="submit" class="btn btn-primary">Guardar usuario</button>

        </div>

        <?php
        
        $crearCliente = new ControladorCliente();
        $crearCliente -> ctrRegistrarCliente();
        
        ?>

    </form>

</div>

</div>

</div>









<!--=====================================
MODAL EDITAR USUARIO
======================================-->

<div id="modalEditarCliente" class="modal fade" role="dialog">

	<div class="modal-dialog">

		<div class="modal-content">

			<form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

        	<button type="button" class="close" data-dismiss="modal">&times;</button>

        	<h4 class="modal-title">Editar Usuario</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->


        <div class="modal-body">

        	<div class="box-body">

        		<!-- ENTRADA PARA EL CLIENTE -->

                <div class="row">

                    <div class="col-md-12">

                        <div class="form-group">

                            <label for="Área">Área</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-users"></i></span>

                                <select class="form-control input-lg" id="editarAreaCliente" name="editarAreaCliente" required>

                                  <option value="">Seleccionar area</option>

                                  <?php 

                                  $item = null;
                                  $valor = null;

                                  $areas = ControladorArea::ctrMostrarAreas($item, $valor); 

                                  foreach ($areas as $key => $value) { ?>

                                    <option value="<?=$value['id']?>"><?=$value['area']?></option>  

                                    <?php

                                }

                                ?>



                            </select> 

                        </div>
                    </div>


                </div>

            </div>






            <div class="form-group">

              <!--  <label for="Nombre">Nombre</label> -->

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" id="editarCliente" name="editarCliente" required>

                <input type="hidden" id="idCliente" name="id">	

            </div>

        </div>




        <div class="row">
            <div class="col-md-6">

                <div class="form-group">

                   <!--  <label for="Dni">Dni</label>
                   -->
                   <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span> 

                    <input type="number" min="0" class="form-control input-lg" id="editarDocumentoID" name="editarDocumentoID">

                </div>

            </div>
        </div>





        <!-- ENTRADA PARA EL EMAIL -->



        <div class="col-md-6">

            <div class="form-group">

                <!--  <label for="Email">Email</label> -->

                <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                    <input type="email" class="form-control input-lg" id="editarEmail" name="editarEmail">

                </div>

            </div>
        </div>
    </div>


    <!-- ENTRADA PARA EL TELÉFONO -->

    <div class="row">

        <div class="col-md-6">

            <div class="form-group">

                <!--  <label for="Teléfono">Teléfono</label> -->

                <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                    <input type="text" class="form-control input-lg" id="editarTelefono" name="editarTelefono" data-inputmask='"mask": "(99) 999-999999"' data-mask >

                </div>

            </div>
        </div>




        <div class="col-md-6">

            <div class="form-group">

                <!--  <label for="Dirección">Dirección</label> -->

                <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-map-pin"></i></span> 

                    <input type="text" class="form-control input-lg" id="editarDirecciónCliente" name="editarDirecciónCliente">

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

        	<button type="submit" class="btn btn-primary">Modificar usuario</button>

        </div>

        <?php

        $editarCliente = new ControladorCliente();
        $editarCliente -> ctrEditarCliente();

        ?>

    </form>

</div>

</div>

</div>


<?php

$eliminarCliente= new ControladorCliente();
$eliminarCliente -> ctrEliminarCliente();

?>








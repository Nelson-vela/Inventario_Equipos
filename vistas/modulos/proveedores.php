<div class="content-wrapper">

	<section class="content-header">

		<h1>

			Administrar Proveedores

		</h1>

		<ol class="breadcrumb">

			<li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

			<li class="active">Administrar proveedores</li>

		</ol>

	</section>

	<section class="content">

		<div class="box">

			<div class="box-header with-border">

				<button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProveedor2">

					Agregar proveedor

				</button>

                <!-- <button class="btn btn-danger" data-toggle="modal" data-target="#modalAgregarPisos">
                
                    Agregar pisos
                
                </button>
            -->
        </div>

        <div class="box-body">

            <table class="table table-bordered table-striped dt-responsive tablaProveedor" id="tablaProveedor">

               <thead>

                  <tr>

                     <th style="width:10px">#</th>
                     <th>Nombre</th>
                     <th>RUC / DNI</th>							 
                     <th>Dirección</th>												
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





<div id="modalEditarProveedor2" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">editar proveedor</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">



            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" maxlength="11" class="form-control input-lg" id="editarRucProveedor" name="editarRucProveedor" placeholder="Ingresar ruc" required>

                <input type="hidden" id="idProveedorEditar" name="id" value="">

              </div>

            </div>


            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" id="editarNombreProveedor" name="editarNombreProveedor" placeholder="Ingresar proveedor" required>

              </div>

            </div>


            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" id="editarDireccionProveedor" name="editarDireccionProveedor" placeholder="Ingresar direccción" required>

              </div>

            </div>



            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                <input type="text" class="form-control input-lg" id="editarTelefonoProveedor" name="editarTelefonoProveedor" placeholder="Ingresar el teléfono" data-inputmask='"mask": "(999) 999999"' data-mask>

              </div>

            </div>

            <!-- ENTRADA PARA EL EMAIL -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                <input type="email" class="form-control input-lg" name="editarEmailProveedor" id="editarEmailProveedor" placeholder="Ingresar email" id="nuevoEmail">

              </div>

            </div>


          </div>

        </div>      

        <!--=====================================
        PIE DEL MODAL
        ======================================-->



        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Editar proveedor</button>

        </div>


        <?php

            $editarProveedor = ControladorProveedor::ctrEditarProveedor();
            
            ?>



      </form>

    </div>

  </div>

</div>





<div id="modalAgregarProveedor2" class="modal fade" role="dialog">

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

        <!--=====================================
        PIE DEL MODAL
        ======================================-->



        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar proveedor</button>

        </div>


        <?php

            $crearProveedor = ControladorProveedor::ctrIngresarProveedor();
            
            ?>



      </form>

    </div>

  </div>

</div>



   <?php

            $crearProveedor = ControladorProveedor::ctrEliminarProveedor();
            
            ?>



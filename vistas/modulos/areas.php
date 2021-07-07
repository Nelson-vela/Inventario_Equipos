<div class="content-wrapper">

	<section class="content-header">

		<h1>

			Administrar Areas

		</h1>

		<ol class="breadcrumb">

			<li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

			<li class="active">Administrar areas</li>

		</ol>

	</section>

	<section class="content">

		<div class="box">

			<div class="box-header with-border">

				<button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarAreas">

					Agregar areas

				</button>

                <!-- <button class="btn btn-danger" data-toggle="modal" data-target="#modalAgregarPisos">
                
                    Agregar pisos
                
                </button>
            -->
        </div>

        <div class="box-body">

            <table class="table table-bordered table-striped dt-responsive tablaAreas" id="tablaAreas">

               <thead>

                  <tr>

                     <th style="width:10px">#</th>
                     <th>Areas</th>                   
                     <th>Fecha</th>							               
                     <th>Acciones</th>

                 </tr> 

             </thead>					

         </table>

     </div>

 </div>

</section>

</div>





<div id="modalEditarAreas" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar areas</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">



            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-briefcase"></i></span> 

                <input type="text" class="form-control input-lg" id="editarArea" name="editarArea" placeholder="editar area" required>

                <input type="hidden" id="idAreasEditar" name="id" value="">

              </div>

            </div>

 
 


          </div>

        </div>      

        <!--=====================================
        PIE DEL MODAL
        ======================================-->



        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Editar area</button>

        </div>


        <?php

            $editarAreas = ControladorArea::ctrEditarAreas();
            
            ?>



      </form>

    </div>

  </div>

</div>





<div id="modalAgregarAreas" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar area</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">



            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-briefcase"></i></span> 

                <input type="text" class="form-control input-lg" id="nuevoArea" name="nuevoArea" placeholder="Ingresar area" required>

              </div>

            </div>


        

          </div>

        </div>      

        <!--=====================================
        PIE DEL MODAL
        ======================================-->



        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar area</button>

        </div>


        <?php

            $crearAreas = ControladorArea::ctrCrearAreas();
            
            ?>



      </form>

    </div>

  </div>

</div>



   <?php

            $eliminarAreas = ControladorArea::ctrEliminarAreas();
            
            ?>



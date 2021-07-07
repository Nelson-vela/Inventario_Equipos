<?php 

$rol = $_SESSION["perfil"];

$validar = ControladorUsuarios::ctrRolVendedor($rol);


 ?>


<div class="content-wrapper">



	<section class="content-header">



		<h1>



			Administrar gastos



		</h1>



		<ol class="breadcrumb">



			<li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>



			<li class="active">Administrar gastos</li>



		</ol>



	</section>



	<section class="content">



		<div class="box">



			<div class="box-header with-border">



				<button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarGastosFijos">



					Agregar gastos fijos



				</button>



			</div>



			<div class="box-body">

       


        <table class="table table-bordered table-striped table-responsive" id="tableGastosFijos" style="width:100%">


          <thead>


            <tr>


              <th style="width:10px">#</th>

              <th>DESCRIPCIÓN</th>

              <th>GASTOS</th>

              <th>FECHA</th>          

              <th>ACCIONES</th>

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



<div id="modalAgregarGastosFijos" class="modal fade" role="dialog">



	<div class="modal-dialog">



		<div class="modal-content">



			<form role="form" method="post" enctype="multipart/form-data">



        <!--=====================================

        CABEZA DEL MODAL

        ======================================-->



        <div class="modal-header" style="background:#3c8dbc; color:white">



        	<button type="button" class="close" data-dismiss="modal">&times;</button>



        	<h4 class="modal-title">Agregar gastos fijos</h4>



        </div>



        <!--=====================================

        CUERPO DEL MODAL

        ======================================-->



        <div class="modal-body">



        	<div class="box-body">



        		<!-- ENTRADA PARA EL MONTO -->



        		<div class="form-group">



        			<div class="input-group">



        				<span class="input-group-addon"><i class="fa fa-th"></i></span> 



        				<input type="text" class="form-control input-lg" id="nuevoDescripcionGastos" name="nuevoDescripcionGastos" placeholder="Ingresar descripcion" required>



        			</div>



        		</div>


            <div class="form-group">



              <div class="input-group">



                <span class="input-group-addon"><i class="fa fa-dollar"></i></span> 



                <input type="text" class="form-control input-lg" id="nuevoMontoGastos" name="nuevoMontoGastos" placeholder="Ingresar monto" required>



              </div>



            </div> 
            

            <!-- ENTRADA PARA LA FECHA VENCIDA -->

            <div class="form-group">



              <div class="input-group">



                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 



                <input type="date" class="form-control input-lg" id="nuevoFechaGastos" name="nuevoFechaGastos" placeholder="Ingresar fecha" required>



              </div>



            </div>


          </div>



        </div>



        <!--=====================================

        PIE DEL MODAL

        ======================================-->



        <div class="modal-footer">



        	<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>



        	<button type="submit" class="btn btn-primary">Guardar monto</button>



        </div>



        <?php



        $crearGasto = new ControladorPlantilla();

        $crearGasto -> ctrIngresarGastosFijos();



        ?>



      </form>



    </div>



  </div>



</div>













<!--=====================================

MODAL EDITAR USUARIO

======================================-->



<div id="modalEditarGastosFijos" class="modal fade" role="dialog">



  <div class="modal-dialog">



    <div class="modal-content">



      <form role="form" method="post" enctype="multipart/form-data">



        <!--=====================================

        CABEZA DEL MODAL

        ======================================-->



        <div class="modal-header" style="background:#3c8dbc; color:white">



          <button type="button" class="close" data-dismiss="modal">&times;</button>



          <h4 class="modal-title">Editar gastos fijos</h4>



        </div>



        <!--=====================================

        CUERPO DEL MODAL

        ======================================-->



        <div class="modal-body">



          <div class="box-body">



            <!-- ENTRADA PARA LA DESCRIPCION -->

            

            <div class="form-group">



              <div class="input-group">



                <span class="input-group-addon"><i class="fa fa-th"></i></span> 



                <input type="text" class="form-control input-lg" id="editarDescripcionGastosFijos" name="editarDescripcionGastos" placeholder="Editar descripcion" required>

                <input type="hidden" id="idPresupuestoFijos" name="id">



              </div>



            </div>



            <!-- ENTRADA PARA EL GASTO -->



            <div class="form-group">



              <div class="input-group">



                <span class="input-group-addon"><i class="fa fa-dollar"></i></span> 



                <input type="text" class="form-control input-lg" id="editarMontoGastosFijos" name="editarMontoGastos" placeholder="Editar monto" required>



              </div>



            </div>



            <!-- ENTRADA PARA LA FECHA -->



            <div class="form-group">



              <div class="input-group">



                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 



                <input type="text" class="form-control input-lg" id="editarFechaGastosFijos" name="editaroFechaGastos" placeholder="Editar fecha" required>



              </div>



            </div>


          </div>



        </div>



        <!--=====================================

        PIE DEL MODAL

        ======================================-->



        <div class="modal-footer">



          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>



          <button type="submit" class="btn btn-primary">Modificar gastos fijos</button>



        </div>



        <?php



        $editarGastosFijo = new ControladorPlantilla();

        $editarGastosFijo -> ctrEditarGastosFijo();



        ?> 



      </form>



    </div>



  </div>



</div>





<?php



$borrarGastosFijos = new ControladorPlantilla();

$borrarGastosFijos -> ctrEliminarGastosFijos();



?> 






<div class="content-wrapper">

	<section class="content-header">

		<h1>

			Administrar Servicios

		</h1>

		<ol class="breadcrumb">

			<li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

			<li class="active">Administrar servicios</li>

		</ol>

	</section>

	<section class="content">

		<div class="box">

			<div class="box-header with-border">

				<a href="crear-servicio">

					<button class="btn btn-primary">

						Crear servicios

					</button>

				</a>

			</div>

			<div class="box-body table-responsive">

				
				<table class="table table-bordered table-striped dt-responsive table-hover" id="tableServicios">

					<thead>
						<tr>
							<th style="width:10px">#</th>
							<th>CÓDIGO FACTURA</th>
							<th>CLIENTE</th>						
							<th>DIRECCIÓN</th>
							<th>NETO</th>
							<th>TOTAL</th>
							<th>FECHA</th>
							<th>ENVIADO</th>
							<th>FACTURA</th>
							<th>ESTADO</th>					                
							<th>ACCIONES</th>

						</tr> 

					</thead>
				</table>

				<?php 

				$eliminarVenta = ControladorVenta::ctrEliminarVenta();

				?>
			</div>

		</div>

	</section>

</div>


<div id="modalEditarCliente" class="modal fade" role="dialog">

	<div class="modal-dialog">

		<div class="modal-content">

			<form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

        	<button type="button" class="close" data-dismiss="modal">&times;</button>

        	<h4 class="modal-title">Editar Cliente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
 

        <div class="modal-body">

        	<div class="box-body">

        		<!-- ENTRADA PARA EL NUMERO PEDIDO -->

        		<div class="form-group">

        			<div class="input-group">

        				<span class="input-group-addon"><i class="fa fa-key"></i></span> 

        				<input type="text" class="form-control input-lg" id="editarNumeroPedido" name="editarNumPedido" placeholder="Número de pedido">

        			</div>

        		</div>


        		<!-- ENTRADA PARA EL NUMERO OBRA -->

        		<div class="form-group">

        			<div class="input-group">

        				<span class="input-group-addon"><i class="fa fa-key"></i></span> 

        				<input type="text" class="form-control input-lg" id="editarNumeroObra" name="editarNumObra" placeholder="Número de obra">

        			</div>

        		</div>

        		<!-- ENTRADA PARA EL CLIENTE -->

        		<div class="form-group">

        			<div class="input-group">

        				<span class="input-group-addon"><i class="fa fa-user"></i></span> 

        				<input type="text" class="form-control input-lg" id="editarNombreCliente" name="editarCliente" placeholder="Nombre del cliente">

        				<input type="hidden" id="idClienteVenta" name="id">	

        			</div>

        		</div>

				<!-- ENTRADA PARA LA DIRECCIÓN -->

        		<div class="form-group">

        			<div class="input-group">

        				<span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

        				<input type="text" class="form-control input-lg" id="editarDireccionCliente" name="editarDireccion" placeholder="Dirección del cliente">

        			</div>

        		</div>

        		<!-- ENTRADA PARA EL TELÉFONO -->

        		<div class="form-group">

        			<div class="input-group">

        				<span class="input-group-addon"><i class="fa fa-phone"></i></span> 

        				<input type="tel" class="form-control input-lg" id="editarTelefonoCliente" name="editarTelefono" data-inputmask='"mask": "(999) 999-999999"' data-mask  placeholder="Teléfono del cliente">

        			</div>

        		</div>
        		


        		<!-- ENTRADA PARA EL EMAIL -->

        		<div class="form-group">

        			<div class="input-group">

        				<span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

        				<input type="email" class="form-control input-lg" id="editarEmail" name="editarEmail" placeholder="Email del cliente">

        			</div>

        		</div>

                   <div class="form-group">

                    <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                        <input type="text" class="form-control input-lg" id="editarFechaCliente" name="editarFechaCliente" placeholder="Fecha">

                    </div>

                </div>
        		
        	</div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

        	<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

        	<button type="submit" class="btn btn-primary">Guardar cliente</button>

        </div>

      <?php
      
      $editarClienteSer = new ControladorVenta();
      $editarClienteSer -> ctrEditarCliente();
      
      ?>

    </form>

</div>

</div>

</div>
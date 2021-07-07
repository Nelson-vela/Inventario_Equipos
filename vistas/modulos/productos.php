<div class="content-wrapper">

	<section class="content-header">

		<h1>

			Administrar tareas

		</h1>

		<ol class="breadcrumb">

			<li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

			<li class="active">Administrar tareas</li>

		</ol>

	</section>

	<section class="content">

		<div class="box">

			<div class="box-header with-border">

				<button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto">

					Agregar tareas

				</button>

			</div>

			<div class="box-body">

				<table class="table table-bordered table-striped dt-responsive tablaProductos">

					<thead>

						<tr>

							<th style="width:10px">#</th>
							<th>Imagen</th>
							<th>Código</th>
							<th>Descripción</th>
							<th>Categoría</th>
							<th>Stock</th>
							<th>Precio de compra</th>
							<th>Precio de venta</th>
							<th>Agregado</th>
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

	<div class="modal-dialog">

		<div class="modal-content">

			<form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

        	<button type="button" class="close" data-dismiss="modal">&times;</button>

        	<h4 class="modal-title">Agregar Producto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

        	<div class="box-body">


            <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->

            <?php 

            $item = null;
            $valor = null;

            $categorias = ControladorCategoria::ctrMostrarCategoria($item, $valor);

             ?>

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" id="nuevaCategoria"  name="nuevaCategoria">

                  <option value="">Selecionar categoría</option>

                  <?php foreach ($categorias as $key => $value) { ?>                 

                  <option value="<?=$value['id']?>"><?=$value['categoria']?></option>

                  <?php } ?>

                </select>

              </div>

            </div>

        		<!-- ENTRADA PARA EL CÓDIGO -->
        		
        		<div class="form-group">

        			<div class="input-group">

        				<span class="input-group-addon"><i class="fa fa-code"></i></span> 

        				<input type="text" class="form-control input-lg" id="nuevoCodigo" name="nuevoCodigo" placeholder="Ingresar código" readonly="">

        			</div>

        		</div>

        		<!-- ENTRADA PARA LA DESCRIPCIÓN -->

        		<div class="form-group">

        			<div class="input-group">

        				<span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

        				<input type="text" class="form-control input-lg"  name="nuevaDescripcion" placeholder="Ingresar descripción" required>

        			</div>

        		</div>

        		

        		<!-- ENTRADA PARA STOCK -->

           <div class="form-group">

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-check"></i></span> 

              <input type="number" class="form-control input-lg" name="nuevoStock" min="0" placeholder="Stock" required>

            </div>

          </div>

          <!-- ENTRADA PARA PRECIO COMPRA -->

          <div class="form-group row">

            <div class="col-xs-6">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

                <input type="number" class="form-control input-lg" id="nuevoPrecioCompra" name="nuevoPrecioCompra" min="0" placeholder="Precio de compra" required>

              </div>

            </div>

            <!-- ENTRADA PARA PRECIO VENTA -->

            <div class="col-xs-6">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 

                <input type="number" class="form-control input-lg" id="nuevoPrecioVenta" name="nuevoPrecioVenta" min="0" placeholder="Precio de venta" required>

              </div>

              <br>

              <!-- CHECKBOX PARA PORCENTAJE -->

              <div class="col-xs-6">

                <div class="form-group">

                  <label>

                    <input type="checkbox" class="minimal porcentaje"  checked>
                    Utilizar procentaje
                  </label>

                </div>

              </div>

              <!-- ENTRADA PARA PORCENTAJE -->

              <div class="col-xs-6" style="padding:0">

                <div class="input-group">

                  <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="12" required>

                  <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                </div>

              </div>

            </div>

          </div>


          <!-- ENTRADA PARA SUBIR FOTO -->

          <div class="form-group">

            <div class="panel">SUBIR IMAGEN</div>

            <input type="file" class="nuevaImagen" name="nuevaImagen">

            <p class="help-block">Peso máximo de la imagen 2MB</p>

            <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

          </div>


        </div>

      </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

        	<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

        	<button type="submit" class="btn btn-primary">Guardar tarea</button>

        </div>

        <?php

       $ingresarProducto = new ControladorProducto();
       $ingresarProducto -> ctrCrearProducto();

       ?>

     </form>

   </div>

 </div>

</div>























<!--=====================================
MODAL EDITAR PRODUCTO
======================================-->

<div id="modalEditarProducto" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar tareas</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


            <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->

            <?php 

            $item = null;
            $valor = null;

            $categorias = ControladorCategoria::ctrMostrarCategoria($item, $valor);

             ?>

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" name="editarCategoria"  readonly>

                  <option id="editarCategoria"></option>                  

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL CÓDIGO -->
            
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-code"></i></span> 

                <input type="text" class="form-control input-lg" id="editarCodigo" name="editarCodigo" readonly="">

                <input type="hidden" id="idEditar" name="id">

              </div>

            </div>

            <!-- ENTRADA PARA LA DESCRIPCIÓN -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

                <input type="text" class="form-control input-lg" id="editarDescripcion" name="editarDescripcion" required>

              </div>

            </div>
            

            <!-- ENTRADA PARA STOCK -->

           <div class="form-group">

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-check"></i></span> 

              <input type="number" class="form-control input-lg" name="editarStock" min="0" id="editarStock" required>

            </div>

          </div>

          <!-- ENTRADA PARA PRECIO COMPRA -->

          <div class="form-group row">

            <div class="col-xs-6">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

                <input type="number" class="form-control input-lg" id="editarPrecioCompra" name="editarPrecioCompra" min="0"  required>

              </div>

            </div>

            <!-- ENTRADA PARA PRECIO VENTA -->

            <div class="col-xs-6">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 

                <input type="number" class="form-control input-lg" id="editarPrecioVenta" name="editarPrecioVenta" min="0" readonly required>

              </div>

              <br>

              <!-- CHECKBOX PARA PORCENTAJE -->

              <div class="col-xs-6">

                <div class="form-group">

                  <label>

                    <input type="checkbox" class="minimal porcentaje"  checked>
                    Utilizar procentaje
                  </label>

                </div>

              </div>

              <!-- ENTRADA PARA PORCENTAJE -->

              <div class="col-xs-6" style="padding:0">

                <div class="input-group">

                  <input type="number" class="form-control input-lg editarPorcentaje" min="0" value="12" required>

                  <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                </div>

              </div>

            </div>

          </div>


          <!-- ENTRADA PARA SUBIR FOTO -->

          <div class="form-group">

            <div class="panel">SUBIR IMAGEN</div>

            <input type="file" class="editarImagen" name="editarImagen">

            <p class="help-block">Peso máximo de la imagen 2MB</p>

            <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
            
            <input type="hidden" name="imagenActual" id="imagenActual">

          </div>


        </div>

      </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Cambios</button>

        </div>

      <?php
      
             $editarProducto = new ControladorProducto();
             $editarProducto -> ctrEditarProducto();
      
             ?>

     </form>

   </div>

 </div>

</div>

 <?php
      
             $borrarProducto = new ControladorProducto();
             $borrarProducto -> ctrEliminarProducto();
      
             ?>
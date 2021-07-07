<div class="content-wrapper">



	<section class="content-header">



		<h1>



			Editar servicio



		</h1>



		<ol class="breadcrumb">



			<li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>



			<li class="active">Editar servicio</li>



		</ol>



	</section>



	<section class="content">



		<div class="row">



      <!--=====================================

      EL FORMULARIO

      ======================================-->

      

      <div class="col-lg-5 col-xs-12">



      	<div class="box box-success">



      		<div class="box-header with-border"></div>



      		<form role="form" method="post" class="formularioVentas">



      			<div class="box-body">



      				<div class="box">



                <?php 



                $item = 'id';

                $valor = $_GET['idVenta'];



                $ventas = ControladorVenta::ctrMostrarVenta($item, $valor);





                $itemVendedor = 'id';

                $valor = $ventas['id_vendedor'];



                $vendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valor);





               /* $itemCliente = 'id';

                $valor = $ventas['id_cliente'];



                $cliente = ControladorCliente::ctrMostrarCliente($itemCliente, $valor);*/





                $porcentajeImpuesto = $ventas['impuesto']*100/$ventas['neto'];





                ?> 



                <!--=====================================

                ENTRADA DEL VENDEDOR

                ======================================-->

                

                <div class="form-group">



                	<div class="input-group">



                		<span class="input-group-addon"><i class="fa fa-user"></i></span> 



                		<input type="text" class="form-control" id="nuevoVendedor" value="<?=$vendedor['nombre']?>" readonly>



                		<input type="hidden" id="idVendedor" name="idVendedor" value="<?=$vendedor['id']?>">



                	</div>



                </div> 



                <!--=====================================

                ENTRADA DEL VENDEDOR

                ======================================--> 



                <div class="form-group">



                	<div class="input-group">



                		<span class="input-group-addon"><i class="fa fa-key"></i></span>







                   <input type="text" class="form-control" id="editarVenta" name="editarVenta" value="<?=$ventas['codigo']?>" readonly>





                 </div>



               </div>



                <!--=====================================

                ENTRADA DEL NÚMERO PEDIDO

                ======================================--> 



            <!--     <div class="form-group">
            
            
            
              <div class="input-group">
            
            
            
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
            
                
            
                <input type="text" class="form-control" id="" name="" placeholder="Número de pedido" value="<?=$ventas['numPedido']?>" readonly>
            
            
            
              </div>
            
            
            
            </div> -->



                <!--=====================================

                ENTRADA DEL NÚMERO DE OBRA

                ======================================--> 



               <!--  <div class="form-group">
               
               
               
                 <div class="input-group">
               
               
               
                   <span class="input-group-addon"><i class="fa fa-key"></i></span>
               
                   
               
                   <input type="text" class="form-control" id="" name="" placeholder="Número de obra" value="<?=$ventas['numObra']?>" readonly>
               
               
               
                 </div>
               
               
               
               </div> -->

               <?php 

                $item = 'id';
                $valor = $ventas['id_cliente'];

                $nombre = ControladorCliente::ctrMostrarCliente($item, $valor);                

                ?>



                 <!--=====================================
                ENTRADA DEL CLIENTE
                ======================================--> 

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-users"></i></span>


                    <input type="text" class="form-control" id="" name="" placeholder="Nombre del cliente" value="<?=$nombre['nombre']?>" readonly>


                  </div>

                </div>

                <!--=====================================
                ENTRADA DEL DIRECCION
                ======================================--> 

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>


                    <input type="text" class="form-control" id="" name="" placeholder="Dirección de cliente" value="<?=$ventas['direccion']?>" readonly>


                  </div>

                </div>


                <!-- ENTRADA PARA EL TELÉFONO -->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                    <input type="text" class="form-control" id="" name="" placeholder="Ingresar el teléfono" value="<?=$ventas['telefono']?>" data-inputmask='"mask": "(999) 999-999999"' data-mask  required readonly>

                  </div>

                </div>

                <!-- ENTRADA PARA EL TELÉFONO -->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                    <input type="text" class="form-control" id="" name="" placeholder="Ingresar el email" value="<?=$ventas['email']?>" required readonly>

                  </div>

                </div>


                <!-- ENTRADA PARA EL TELÉFONO -->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                    <input type="text" class="form-control" id="" name="" placeholder="Fecha ingresada" value="<?=$ventas['fechaModi']?>" required readonly>

                  </div>

                </div>


                <!--=====================================

                ENTRADA PARA AGREGAR PRODUCTO

                ======================================--> 



                <div class="form-group row nuevoProducto">



                  <?php 



                  $listaProductos = json_decode($ventas['productos'], true);

                  $listaProductosExtras = json_decode($ventas['productosExtras'], true);



                 /* if (!empty($listaProductos)) {

                    # code...

                  }   

*/

                  foreach ($listaProductos as $key => $value) { 



                    $item = 'id';

                    $valor = $value['id'];



                    $productos = ControladorProducto::ctrMostrarProducto($item, $valor);







                    ?>



                    <div class="row" style="padding: 5px 15px">



                      <!-- Descripción del producto -->



                      <div class="col-xs-6" style="padding-right:0px">



                        <div class="input-group">



                          <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="<?=$value['descripcion']?>"><i class="fa fa-times"></i></button></span>



                          <input type="text" class="form-control nuevaDescripcionProducto" id="agregarProducto" name="agregarProducto" idProducto="<?=$value['id']?>" placeholder="Descripción del producto" value="<?=$value['descripcion']?>" readonly required>



                        </div>



                      </div>



                      <!-- Cantidad del producto -->



                      <div class="col-xs-3">



                        <input type="number" class="form-control nuevaCantidadProducto" id="nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="<?=$value['cantidad']?>" stock="<?=$value['stock']+$value['cantidad']?>" nuevoStock = "<?=$value['stock']?>" required>



                      </div> 



                      <!-- Precio del producto -->



                      <div class="col-xs-3 ingresoPrecio" style="padding-left:0px">



                        <div class="input-group">



                          <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>



                          <input type="text" class="form-control nuevoPrecioProducto" id="nuevoPrecioProducto" name="nuevoPrecioProducto" precioReal="<?=$value['precio']?>" value="<?=$value['total']?>" readonly required>



                        </div>



                      </div>



                    </div>                   



                    <?php

                  }

                  if (isset($listaProductosExtras)) {



                    foreach ($listaProductosExtras as $key => $value) { 

                      $item = 'id';
                      $valor = $value['id'];

                      $productos = ControladorProducto::ctrMostrarProducto($item, $valor);



                      ?>

                      <div class="row" style="padding: 5px 15px">

                        <!-- Descripción del producto -->

                        <div class="col-xs-6" style="padding-right:0px">

                          <div class="input-group">

                            <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProductoE" idProducto="<?=$value['descripcion']?>"><i class="fa fa-times"></i></button></span>

                            <input type="text" class="form-control nuevaDescripcionProductoE" id="agregarProducto" name="agregarProductoE" idProducto="<?=$value['id']?>" placeholder="Descripción del producto" value="<?=$value['descripcion']?>"  required>

                          </div>

                        </div>

                        <!-- Cantidad del producto -->

                        <div class="col-xs-3">

                          <input type="number" class="form-control nuevaCantidadProductoE" id="nuevaCantidadProducto" name="nuevaCantidadProductoE" min="1" value="<?=$value['cantidad']?>" stock="<?=$value['cantidad']+9000000000000000?>" nuevoStock = "<?=$value['stock']?>" required>

                        </div> 

                        <!-- Precio del producto -->

                        <div class="col-xs-3 ingresoPrecioE" style="padding-left:0px">

                          <div class="input-group">

                            <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                            <input type="text" class="form-control nuevoPrecioProductoE" id="nuevoPrecioProductoE" name="nuevoPrecioProductoE" precioReal="<?=$value['precio']?>" value="<?=$value['total']?>" required>

                          </div>

                        </div>

                      </div>                   

                      <?php
                    }


                  }


                  ?>







                </div>



                <input type="hidden" id="listaProductos" name="listaProductos">

                <input type="hidden" id="listaProductosE" name="listaProductosExtra">



                <!--=====================================

                BOTÓN PARA AGREGAR PRODUCTO

                ======================================-->



                <button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar servicio</button>

                <button type="button" class="btn btn-default lg btnAgregarProductoExtra">Agregar servicio extra</button>




                <hr>



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



                  						<span class="input-group-addon"><i class="fa fa-percent"></i></span>



                  						<input type="number" class="form-control input-lg" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta"  value="<?=$porcentajeImpuesto?>">



                  						<input type="hidden" id="nuevoPrecioImpuesto" name="nuevoPrecioImpuesto" value="<?=$ventas['impuesto']?>">



                  						<input type="hidden" id="nuevoPrecioNeto" name="nuevoPrecioNeto" value="<?=$ventas['neto']?>">



                  						

                  					</div>



                  				</td>



                  				<td style="width: 50%">



                  					<div class="input-group">



                  						<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>



                  						<input type="text"  class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" value="<?=$ventas['total']?>" total readonly required>



                              <input type="hidden" id="totalVenta" name="totalVenta" value="<?=$ventas['total']?>">





                            </div>



                          </td>



                        </tr>



                      </tbody>



                    </table>



                  </div>



                </div>



                <hr>



                <!--=====================================

                ENTRADA MÉTODO DE PAGO

                ======================================-->



                <!-- <div class="form-group row">
                
                
                
                  <div class="col-xs-6" style="padding-right:0px">
                
                
                
                    <div class="input-group">
                
                
                
                      <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago" required>
                
                        <option value="">Seleccione método de pago</option>
                
                        <option value="Efectivo">Efectivo</option>
                
                        <option value="TC">Tarjeta Crédito</option>
                
                        <option value="TD">Tarjeta Débito</option>                  
                
                      </select>    
                
                
                
                    </div>
                
                
                
                  </div>
                
                
                
                 <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">
                
                
                
                 <div class="cajasMetodoPago">
                
                
                
                  <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">
                
                
                
                
                
                
                
                </div>
                
                
                
              </div> -->



              <br>



            </div>



          </div>



          <div class="box-footer">



           <button type="submit" class="btn btn-primary pull-right">Guardar cambios</button>



         </div>



       </form> <!-- FINAL DEL FORM -->



       <?php 



       $editarVenta = ControladorVenta::ctrEditarVenta();



       ?>



     </div>



   </div>



      <!--=====================================

      LA TABLA DE PRODUCTOS

      ======================================-->



      <div class="col-lg-7 hidden-md hidden-sm hidden-xs">



      	<div class="box box-warning">



      		<div class="box-header with-border"></div>



      		<div class="box-body">



      			<table class="table table-bordered table-striped dt-responsive tablaVentas">



      				<thead>



      					<tr>

      						<th style="width: 10px">#</th>

      						<th>Imagen</th>

      						<th>Código</th>

      						<th>Descripcion</th>

      						<th>Stock</th>

      						<th>Acciones</th>

      					</tr>



      				</thead>



      				<!-- <tbody>



      					<tr>

      						<td>1.</td>                 

      						<td><img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="40px"></td>

      						<td>00123</td>

      						<td>Lorem ipsum dolor sit amet</td>       

      						<td>20</td>                 

      						<td>                 

      							<div class="btn-group">

      								<button type="button" class="btn btn-primary">Agregar</button> 

      							</div>

      						</td>

      					</tr>



      				</tbody> -->



      			</table>



      		</div>



      	</div>





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



        	<h4 class="modal-title">Agregar Cliente</h4>



        </div>



        <!--=====================================

        CUERPO DEL MODAL

        ======================================-->



        <div class="modal-body">



        	<div class="box-body">



        		<!-- ENTRADA PARA EL CLIENTE -->



        		<div class="form-group">



        			<div class="input-group">



        				<span class="input-group-addon"><i class="fa fa-user"></i></span> 



        				<input type="text" class="form-control input-lg" id="nuevoCliente" name="nuevoCliente" placeholder="Ingresar nombre" required>



        			</div>



        		</div>





        		<!-- ENTRADA PARA EL DOCUMENTO DE ID -->



        		<div class="form-group">



        			<div class="input-group">



        				<span class="input-group-addon"><i class="fa fa-key"></i></span> 



        				<input type="number" min="0" class="form-control input-lg" id="nuevoDocumentoID" name="nuevoDocumentoID" placeholder="Ingresar Documento de ID" required>



        			</div>



        		</div>





        		<!-- ENTRADA PARA EL EMAIL -->



        		<div class="form-group">



        			<div class="input-group">



        				<span class="input-group-addon"><i class="fa fa-envelope"></i></span> 



        				<input type="email" class="form-control input-lg" id="nuevoEmail" name="nuevoEmail" placeholder="Ingresar el email" required>



        			</div>



        		</div>





        		<!-- ENTRADA PARA EL TELÉFONO -->



        		<div class="form-group">



        			<div class="input-group">



        				<span class="input-group-addon"><i class="fa fa-phone"></i></span> 



        				<input type="text" class="form-control input-lg" id="nuevoTelefono" name="nuevoTelefono" placeholder="Ingresar el teléfono" data-inputmask='"mask": "(999) 999-999999"' data-mask  required>



        			</div>



        		</div>







        		<!-- ENTRADA PARA LA DIRECCIÓN -->



        		<div class="form-group">



        			<div class="input-group">



        				<span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 



        				<input type="text" class="form-control input-lg" id="nuevaDireccion" name="nuevaDireccion" placeholder="Ingresar la dirección" required>



        			</div>



        		</div>





        		<!-- ENTRADA PARA LA FECHA -->



        		<div class="form-group">



        			<div class="input-group">



        				<span class="input-group-addon"><i class="fa fa-calendar"></i></span> 



        				<input type="text" class="form-control input-lg" id="nuevaFecha" name="nuevaFecha" placeholder="Ingresar fecha de nacimiento" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask  required>



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

        

        $crearCliente = new ControladorCliente();

        $crearCliente -> ctrRegistrarCliente();

        

        ?>



      </form>



    </div>



  </div>



</div>


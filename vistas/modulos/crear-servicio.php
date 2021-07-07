<div class="content-wrapper">



	<section class="content-header">



		<h1>



			Crear servicio



		</h1>



		<ol class="breadcrumb">



			<li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>



			<li class="active">Crear servicio</li>



		</ol>



	</section>



	<section class="content">



		<div class="row">



      <!--=====================================

      EL FORMULARIO

      ======================================-->

      

      <!-- <div class="col-lg-5 col-xs-12">
       -->
 <div class="col-lg-5 col-md-6 col-xs-12">

      	<div class="box box-success">



      		<div class="box-header with-border"></div>



      		<form role="form" method="post" class="formularioVentas">



      			<div class="box-body">



      				<div class="box">



                <!--=====================================

                ENTRADA DEL VENDEDOR

                ======================================-->

                

                <div class="form-group">



                	<div class="input-group">



                		<span class="input-group-addon"><i class="fa fa-user"></i></span> 



                		<input type="text" class="form-control" id="nuevoVendedor" value="<?=$_SESSION['nombre']?>" readonly>



                		<input type="hidden" id="idVendedor" name="idVendedor" value="<?=$_SESSION['id']?>">



                	</div>



                </div> 



                <!--=====================================

                ENTRADA DEL VENDEDOR

                ======================================--> 



                <div class="form-group">



                	<div class="input-group">



                		<span class="input-group-addon"><i class="fa fa-key"></i></span>



                		<?php 



                		$item = null;

                		$valor = null;



                		$ventas = ControladorVenta::ctrMostrarVenta($item, $valor);



                		if (!$ventas) { ?>



                			<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="10001" readonly>



                			<?php



                		}else{



                			foreach ($ventas as $key => $value) {

                				

                			}



                			$codigo = $value['codigo']+1; ?>



                			<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="<?=$codigo?>" readonly>



                			<?php



                		}



                		?>









                	</div>



                </div>





                 <!--=====================================

                ENTRADA DEL NÚMERO PEDIDO

                ======================================--> 



                <!-- <div class="form-group">
                
                
                
                  <div class="input-group">
                
                
                
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                
                    
                
                      <input type="text" class="form-control" id="nuevaNumPedido" name="nuevaNumPedido" placeholder="Número de pedido">
                
                
                
                  </div>
                
                
                
                </div> -->



                <!--=====================================

                ENTRADA DEL NÚMERO DE OBRA

                ======================================--> 



               <!-- 4 <div class="form-group">
               
               
               
                 <div class="input-group">
               
               
               
                   <span class="input-group-addon"><i class="fa fa-key"></i></span>
               
                   
               
                     <input type="text" class="form-control" id="nuevaNumObra" name="nuevaNumObra" placeholder="Número de obra">
               
               
               
                 </div>
               
               
               
               </div>
             -->


                <!--=====================================

                ENTRADA DEL CLIENTE

                ======================================--> 


                <div class="form-group">              
                  
                  
                  <div class="input-group">                
                   
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    
                    <select class="form-control" id="seleccionarCliente" name="seleccionarCliente" required>                
                      <option value="">Seleccionar cliente</option>   
                      
                      <?php    
                      
                      $item = null;
                      
                      $valor = null;    
                      
                      $clientes = ControladorCliente::ctrMostrarCliente($item, $valor); 
                      
                      foreach ($clientes as $key => $value) { ?>   
                        
                        <option value="<?=$value['id']?>"><?=$value['nombre']?></option>                 
                        
                        <?php                
                      }    
                      
                      ?>
                      
                      
                      
                    </select>
                    
                    
                    
                    <!-- <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar cliente</button></span> -->


                    <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs piso" data-toggle="modal" data-target="#modalAgregarPiso" data-dismiss="modal" idClientePiso ="" >Seleccionar piso</button></span>
                    
                    
                    
                  </div>
                  
                  
                  
                </div>

                  <!--=====================================
                ENTRADA DEL NCLIENTE
                ======================================--> 

                <!-- <div class="form-group">
                
                  <div class="input-group">
                
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    
                      <input type="text" class="form-control" id="nuevaNombreCliente" name="nuevaNombreCliente" placeholder="Nombre del cliente">
                
                  </div>
                
                </div> -->

                   <!--=====================================
                ENTRADA DEL NCLIENTE
                ======================================--> 

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                    
                    <input type="text" class="form-control" id="nuevaDireccion" name="nuevaDireccion" placeholder="Direccion">

                  </div>

                </div>



                <!-- ENTRADA PARA EL TELÉFONO -->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                    <input type="text" class="form-control" id="nuevaTelefono" name="nuevaTelefono" placeholder="Ingresar el teléfono" data-inputmask='"mask": "(999) 999-999999"' data-mask>

                  </div>

                </div>

                <!-- ENTRADA PARA EL EMAIL -->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                    <input type="email" class="form-control" id="nuevaEmail" name="nuevoEmail" placeholder="Ingresar el email">

                  </div>

                </div>





                <!--=====================================

                ENTRADA PARA AGREGAR PRODUCTO

                ======================================--> 



                <div class="form-group row nuevoProducto">



                	



                </div>





                <!--=====================================

                ENTRADA PARA AGREGAR PRODUCTO

                ======================================--> 



                



                <input type="hidden" id="listaProductos" name="listaProductos">

                <input type="hidden" id="listaProductosE" name="listaProductosExtra">



                <!--=====================================

                BOTÓN PARA AGREGAR PRODUCTO

                ======================================-->



                <button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar producto</button>

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



                          <input type="number" class="form-control input-lg" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" value="21" placeholder="0">



                          <input type="hidden" id="nuevoPrecioImpuesto" name="nuevoPrecioImpuesto">



                          <input type="hidden" id="nuevoPrecioNeto" name="nuevoPrecioNeto">





                        </div>



                      </td>

                      <td>



                        <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-euro"></i></span>



                          <input type="text"  class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" placeholder="00000" total readonly required>



                          <input type="hidden" id="totalVenta" name="totalVenta">





                        </div>



                      </td>



                     <!--  <td style="width: 50%">

                     

                                         <div class="input-group">

                                         

                     <span class="input-group-addon"><i class="fa fa-euro"></i></span>

                                         

                     <input type="number" min="0" class="form-control input-lg" id="precioIng" name="precioIng" placeholder="00000" precioIng>

                                         

                     <input type="hidden" id="precioIng" name="precioIng">

                                         

                                         

                                         </div>

                     

                                       </td> -->



                                     </tr>



                                     <tr>

                                      

                                      <td style="width: 50%">



                                        <!-- <label for="Precio">Total:</label> -->



                    <!--   <div class="input-group">

                    

                      <span class="input-group-addon"><i class="fa fa-euro"></i></span>

                    

                      <input type="text"  class="form-control input-lg" id="precioIng" name="precioIng" placeholder="00000" precioIng required>

                    

                      <input type="hidden" id="precioIng" name="precioIng">

                    

                    

                    </div> -->



                      <!-- <div class="input-group">

                      

                        <span class="input-group-addon"><i class="fa fa-euro"></i></span>

                      

                        <input type="text"  class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" placeholder="00000" total readonly required>

                      

                        <input type="hidden" id="totalVenta" name="totalVenta">

                      

                      

                      </div> -->



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



               <!--  <div class="form-group row">
               
               
               
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



           <button type="submit" class="btn btn-primary pull-right">Guardar servicio</button>



         </div>



       </form> <!-- FINAL DEL FORM -->



       <?php 



       $crearVenta = ControladorVenta::ctrCrearVenta();



       ?>



     </div>



   </div>



      <!--=====================================

      LA TABLA DE PRODUCTOS

      ======================================-->



     <!--  <div class="col-lg-7 hidden-md hidden-sm hidden-xs"> -->

      <div class="col-lg-7 col-md-6  col-xs-12">




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



<div id="modalAgregarPiso" class="modal fade" role="dialog">



	<div class="modal-dialog">



		<div class="modal-content">



			<form role="form" method="post">



        <!--=====================================

        CABEZA DEL MODAL

        ======================================-->



        <div class="modal-header" style="background:#3c8dbc; color:white">



        	<button type="button" class="close" data-dismiss="modal">&times;</button>



        	<h4 class="modal-title">Seleccionar Piso</h4>



        </div>



        <!--=====================================

        CUERPO DEL MODAL

        ======================================-->



        <div class="modal-body">



        	<div class="box-body">



           <div class="form-group">
            
            
            
            <div class="input-group">
              
              
              
              <span class="input-group-addon"><i class="fa fa-home"></i></span>
              
              
              
              <select class="form-control" id="seleccPiso" name="seleccionarPisoo" required>
                
                
                
                <option value="">Seleccionar piso</option>  
                
              </select>
              
              
              
              <!-- <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar cliente</button></span> -->


                    <!-- <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs piso" data-toggle="modal" data-target="#modalAgregarPiso" data-dismiss="modal" idClientePiso ="" >Seleccionar piso</button></span>
                    -->
                    
                    
                  </div>
                  
                  
                  
                </div>





                <!-- ENTRADA PARA EL DOCUMENTO DE ID -->



        		<!-- <div class="form-group">
            
            
            
              <div class="input-group">
            
            
            
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 
            
            
            
                <input type="number" min="0" class="form-control input-lg" id="nuevoDocumentoID" name="nuevoDocumentoID" placeholder="Ingresar Documento de ID" required>
            
            
            
              </div>
            
            
            
            </div> -->





            <!-- ENTRADA PARA EL EMAIL -->



        		<!-- <div class="form-group">
            
            
            
              <div class="input-group">
            
            
            
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 
            
            
            
                <input type="email" class="form-control input-lg" id="nuevoEmail" name="nuevoEmail" placeholder="Ingresar el email" required>
            
            
            
              </div>
            
            
            
            </div> -->





            <!-- ENTRADA PARA EL TELÉFONO -->



        		<!-- <div class="form-group">
            
            
            
              <div class="input-group">
            
            
            
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 
            
            
            
                <input type="tel" class="form-control input-lg" id="nuevoTelefono" name="nuevoTelefono" placeholder="Ingresar el teléfono" data-inputmask='"mask": "(999) 999-999999"' data-mask  required>
            
            
            
              </div>
            
            
            
            </div> -->







            <!-- ENTRADA PARA LA DIRECCIÓN -->



        		<!-- <div class="form-group">
            
            
            
              <div class="input-group">
            
            
            
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 
            
            
            
                <input type="text" class="form-control input-lg" id="nuevaDireccion" name="nuevaDireccion" placeholder="Ingresar la dirección" required>
            
            
            
              </div>
            
            
            
            </div> -->





          </div>



        </div>



        <!--=====================================

        PIE DEL MODAL

        ======================================-->



        <div class="modal-footer">



        	<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>



        	<button type="submit" class="btn btn-primary selectPiso">Seleccionar</button>



        </div>


      </form>



    </div>



  </div>



</div>


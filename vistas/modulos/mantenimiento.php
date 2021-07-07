<?php 

$rol = $_SESSION["perfil"];

$validar = ControladorUsuarios::ctrRolVendedor($rol);


?>


<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar mantenimiento

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar mantenimiento</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary addMantenimiento" data-toggle="modal" data-target="#modalAgregarMantenimiento">

          Agregar mantenimiento

        </button>

      </div>

      <div class="box-body">

       <table class="table table-bordered table-striped dt-responsive tablaMantenimientoEquipo" id="tablaMantenimientoEquipo">

        <thead>

         <tr>

           <th style="width:10px">#</th>
           <th>Categorias</th>        
           <th>Area</th>        
           <th>Equipo</th>        
           <th>Responsable</th>        
           <th>Observaciones</th>        
           <th>Requerimientos</th> 
           <th>Total</th> 
           <th>Conclusión</th> 
           <th>Fecha Mantenimiento</th> 
           <th>Estado</th> 
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

<div id="modalAgregarMantenimiento" class="modal fade" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">

	<div class="modal-dialog modal-lg">

		<div class="modal-content">

			<form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

        	<button type="button" class="close btnSalirAgregarMantenimiento" data-dismiss="modal">&times;</button>

        	<h4 class="modal-title">Agregar Equipo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

        	<div class="box-body">


           <div class="row">

            <div class="col-md-6">  

              <div class="form-group">

               <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" id="nuevaResponsbleMantenimiento" name="nuevaResponsbleMantenimiento" placeholder="Ingresar responsable" required>

              </div>

            </div>

          </div>


          <?php 

          $item = null;
          $valor = null;

          $areas = ControladorArea::ctrMostrarAreas($item, $valor);

          ?>


          <!-- <div class="col-md-6">  
          
            <div class="form-group">
          
              <div class="input-group">
          
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 
          
                <select class="form-control input-lg" id="nuevaCategoriaEquipoMantenimiento"  name="nuevaCategoriaEquipoMantenimiento" required>
          
                  <option value="">Seleccionar categoria</option>
          
                  <?php 
          
                  /*$categorias = ControladorCategoria::ctrMostrarCategoria($item, $valor);
          
          
                  foreach ($categorias as $key => $value) { ?>                 
          
                    <option value="<?=$value['id']?>"><?=$value['categoria']?></option>
          
                  <?php }*/ ?>
          
                </select>
          
              </div>
          
            </div>
          
          </div> -->


        </div>









        <!-- ENTRADA PARA LA CAEGORIA -->



        <div class="row">



          <div class="col-md-6">  

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg nuevaAreaEquipoMantenimiento" id="nuevaAreaEquipoMantenimiento"  name="nuevaAreaEquipoMantenimiento" required>

                  <option value="">Selecionar area</option>

                  <?php foreach ($areas as $key => $value) { ?>                 

                    <option value="<?=$value['id']?>"><?=$value['area']?></option>

                  <?php } ?>

                </select>

              </div>

            </div>

          </div>



          <div class="col-md-6">  

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg nuevaEquipoMantenimiento" id="nuevaEquipoMantenimiento"  name="nuevaEquipoMantenimiento" required>

                  <option value="">Selecionar equipo</option>

             <!--      
               <option> </option> -->

             </select>

           </div>

         </div>

       </div>

     </div>

     <div class="box box-sucees"></div>


     <div class="row">

      <div class="col-md-8"> 

        <label for="detalles">Observaciones</label>

        <div class="form-group">

          <div class="input-group">

            <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span> 

            <input type="text" class="form-control input-lg" id="nuevaObservacionesMantenimiento" name="nuevaObservacionesMantenimiento" placeholder="Ingrese observaciones">

            <input type="hidden"  id="nuevaListaObservacionesMantenimiento" name="nuevaListaObservacionesMantenimiento">


          </div>

        </div>

      </div>

      <div class="col-md-2"> 

        <label for="detalles"></label>

        <div class="form-group">

          <div class="input-group">

            <button  class="btn btn-success pull-right btnAgregarObservacionesMantenimiento"><i class="fa fa-check"></i></button>

          </div>

        </div>

      </div>

    </div>




    <table class="table table-bordered table-striped table-responsive" id="tablaObservacionesMantenimiento" style="width:100%">


      <thead> 

        <tr> 

          <th>Lista</th>
          <th>Acciones</th>


        </tr> 


      </thead>    

      <tbody id="listObservacionesMantenimiento">


      </tbody>






    </table> <br>

    <div class="box box-sucees"></div>

    <div class="row">

      <div class="col-md-6"> 

        <label for="detalles">Requerimientos</label>

        <div class="form-group">

          <div class="input-group">

            <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span> 

            <input type="text" class="form-control input-lg" id="nuevaRequerimientosMantenimiento" name="nuevaRequerimientosMantenimiento"placeholder="Ingrese requerimientos">

            <input type="hidden"  id="nuevaListaRequerimientosMantenimiento" name="nuevaListaRequerimientosMantenimiento">

          </div>

        </div>

      </div>

      <div class="col-md-4"> 

        <label for="detalles">Precio</label>

        <div class="form-group">

          <div class="input-group">

            <span class="input-group-addon"><i class="fa fa-dollar"></i></span> 

            <input type="number" class="form-control input-lg" id="nuevaPrecioMantenimiento" name="nuevaPrecioMantenimiento" min="0" placeholder="Ingrese precio">

          </div>

        </div>

      </div>

      <div class="col-md-2"> 

        <label for="detalles"></label>

        <div class="form-group">

          <div class="input-group">

            <button  class="btn btn-success pull-right btnAgregarRequerimientosMantenimiento"><i class="fa fa-check"></i></button>

          </div>

        </div>

      </div>

    </div>



    <table class="table table-bordered table-striped table-responsive" id="tablaRequerimientosMantenimiento" style="width:100%">


      <thead> 

        <tr> 

          <th>Lista</th>
          <th>Precio</th>
          <th>Acciones</th>


        </tr> 


      </thead>    

      <tbody id="listaRequerimientosMantenimiento">


      </tbody>






    </table> <br>

    <div class="row">

                  <!--=====================================
                  ENTRADA IMPUESTOS Y TOTAL
                  ======================================-->
                  
                  <div class="col-xs-8 pull-right">

                    <table class="table">

                      <thead>

                        <tr>
                          <th></th>
                          <th>Total</th>      
                        </tr>

                      </thead>

                      <tbody>

                        <tr>

                          <td style="width: 50%">

                           <!--  <div class="input-group">
                           
                             <input type="number" class="form-control input-lg" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" placeholder="0" required readonly>
                           
                             <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" required>
                           
                             <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" required>
                           
                             <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                           
                           </div>
                         -->
                       </td>

                       <td style="width: 50%">

                        <div class="input-group">

                          <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                          <input type="text" class="form-control input-lg" id="nuevoTotalRequerimiento" name="nuevoTotalRequerimiento" total="" placeholder="00000" readonly required>

                          <input type="hidden" name="totalRequerimiento" id="totalRequerimiento">




                        </div>

                      </td>

                    </tr>

                  </tbody>

                </table>

              </div>

            </div>


            <div class="row">

              <div class="col-md-6"> 

                <label for="detalles">Fecha Mantenimiento</label>

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span> 

                    <input type="date" class="form-control input-lg" id="nuevaFechaMantenimiento" name="nuevaFechaMantenimiento" required>

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

        	<button type="button" class="btn btn-default pull-left btnSalirAgregarMantenimiento" data-dismiss="modal">Salir</button>

        	<button type="submit" class="btn btn-primary">Guardar mantenimiento</button>

        </div>

        <?php

        $crearMantinimiento = ControladorMantenimiento::ctrAgregarMantenimientos();

        ?>

      </form>

    </div>

  </div>

</div>




<!--=====================================
MODAL EDITAR USUARIO
======================================-->

<div id="modalEditarMantenimiento" class="modal fade" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">

	<div class="modal-dialog modal-lg">

		<div class="modal-content">

			<form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

        	<button type="button" class="close btnSalirAgregarMantenimiento" data-dismiss="modal">&times;</button>

        	<h4 class="modal-title">Editar mantenimiento</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

        	<div class="box-body">




           <div class="row">

            <div class="col-md-6">  

              <div class="form-group">

               <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" id="editarResponsableMantenimiento" name="editarResponsableMantenimiento" placeholder="Ingresar responsable" required>


                <input type="hidden" class="form-control input-lg" id="idMantenimientoEditar" name="id">

              </div>

            </div>

          </div>


          <?php 

          $item = null;
          $valor = null;

          $areas = ControladorArea::ctrMostrarAreas($item, $valor);
          $equipo = ControladorEquipo::ctrMostrarEquipos($item, $valor);

          ?>




        </div>





        <div class="row">



          <div class="col-md-6">  

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg editarAreaEquipoMantenimiento" id="editarAreaEquipoMantenimiento"  name="editarAreaEquipoMantenimiento" required>

                  <option value="">Selecionar area</option>

                  <?php foreach ($areas as $key => $value) { ?>                 

                    <option value="<?=$value['id']?>"><?=$value['area']?></option>

                  <?php } ?>

                </select>

              </div>

            </div>

          </div>



          <div class="col-md-6">  

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg editarEquipoMantenimiento" id="editarEquipoMantenimiento"  name="editarEquipoMantenimiento" required>

                  <option value="">Selecionar equipo</option>

                  <?php foreach ($equipo as $key => $value) { ?>                 

                    <option value="<?=$value['id']?>"><?=$value['alias']?></option>

                  <?php } ?>


                </select>

              </div>

            </div>

          </div>

        </div>

        <div class="box box-sucees"></div>


        <div class="row">

          <div class="col-md-8"> 

            <label for="detalles">Observaciones</label>

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span> 

                <input type="text" class="form-control input-lg" id="editarObservacionesMantenimiento" name="editarObservacionesMantenimiento" placeholder="Ingrese observaciones">

                <input type="hidden" id="editarListaObservacionesMantenimiento" name="editarListaObservacionesMantenimiento">


              </div>

            </div>

          </div>

          <div class="col-md-2"> 

            <label for="detalles"></label>

            <div class="form-group">

              <div class="input-group">

                <button  class="btn btn-success pull-right btnAgregarObservacionesMantenimiento"><i class="fa fa-check"></i></button>

              </div>

            </div>

          </div>

        </div>



        <table class="table table-bordered table-striped table-responsive" id="tablaObservacionesMantenimiento" style="width:100%">


          <thead> 

            <tr> 

              <th>Lista</th>
              <th>Acciones</th>


            </tr> 


          </thead>    

          <tbody id="editarlistObservacionesMantenimiento">


          </tbody>






        </table> <br>

        <div class="box box-sucees"></div>

        <div class="row">

          <div class="col-md-6"> 

            <label for="detalles">Requerimientos</label>

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span> 

                <input type="text" class="form-control input-lg" id="editarRequerimientosMantenimiento" name="editarRequerimientosMantenimiento"placeholder="Ingrese requerimientos">

                <input type="hidden"  id="editarListaRequerimientosMantenimiento" name="editarListaRequerimientosMantenimiento">

              </div>

            </div>

          </div>

          <div class="col-md-4"> 

            <label for="detalles">Precio</label>

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-dollar"></i></span> 

                <input type="number" class="form-control input-lg" id="editarPrecioMantenimiento" name="editarPrecioMantenimiento" min="0" placeholder="Ingrese precio">

              </div>

            </div>

          </div>

          <div class="col-md-2"> 

            <label for="detalles"></label>

            <div class="form-group">

              <div class="input-group">

                <button  class="btn btn-success pull-right btnAgregarRequerimientosMantenimiento"><i class="fa fa-check"></i></button>

              </div>

            </div>

          </div>

        </div>



        <table class="table table-bordered table-striped table-responsive" id="tablaRequerimientosMantenimiento" style="width:100%">


          <thead> 

            <tr> 

              <th>Lista</th>
              <th>Precio</th>
              <th>Acciones</th>


            </tr> 


          </thead>    

          <tbody id="editarlistaRequerimientosMantenimiento">


          </tbody>






        </table> <br>

        <div class="row">

                  <!--=====================================
                  ENTRADA IMPUESTOS Y TOTAL
                  ======================================-->
                  
                  <div class="col-xs-8 pull-right">

                    <table class="table">

                      <thead>

                        <tr>
                          <th></th>
                          <th>Total</th>      
                        </tr>

                      </thead>

                      <tbody>

                        <tr>

                          <td style="width: 50%">

                           <!--  <div class="input-group">
                           
                             <input type="number" class="form-control input-lg" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" placeholder="0" required readonly>
                           
                             <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" required>
                           
                             <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" required>
                           
                             <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                           
                           </div>
                         -->
                       </td>

                       <td style="width: 50%">

                        <div class="input-group">

                          <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                          <input type="text" class="form-control input-lg" id="editarTotalNuevoRequerimiento" name="editarTotalNuevoRequerimiento" total="" placeholder="00000" readonly required>

                          <input type="hidden" name="editarTotalRequerimiento" id="editarTotalRequerimiento">




                        </div>

                      </td>

                    </tr>

                  </tbody>

                </table>

              </div>

            </div>


            <div class="row">

              <div class="col-md-6"> 

                <label for="detalles">Fecha Mantenimiento</label>

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span> 

                    <input type="date" class="form-control input-lg" id="editarFechaMantenimiento" name="editarFechaMantenimiento" required>

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

        	<button type="button" class="btn btn-default pull-left btnSalirAgregarMantenimiento" data-dismiss="modal">Salir</button>

        	<button type="submit" class="btn btn-primary">Actualizar mantenimiento</button>

        </div>

        <?php

        $editarMantenimiento = ControladorMantenimiento::ctrActualizarMantenimiento();

        ?>

      </form>

    </div>

  </div>

</div>



















<div id="modalVerObservaciones" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Ver Observaciones</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">



            <table class="table table-bordered table-striped table-responsive" id="tablaObservacionesPorId" style="width:100%">


              <thead>



                <tr>



                  <!--   <th style="width:10px">#</th> -->

                  <th class="text-center">Observaciones</th>


                </tr> 


              </thead>    

              <tbody id="listaObservacionesPorId">

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









<div id="modalVerRequerimientos" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Ver Requerimientos</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">



            <table class="table table-bordered table-striped table-responsive" id="tablaRequerimientosPorId" style="width:100%">


              <thead>



                <tr>



                  <!--   <th style="width:10px">#</th> -->

                  <th class="text-center">Requerimientos</th>
                  <th class="text-center">Precio</th>


                </tr> 


              </thead>    

              <tbody id="listaRequerimientosPorId">

           <!--  <tr>
             
             <td>Lapto Core I5</td>
             <td>3</td>
             <td>1200</td>
             <td>3600</td>
             <td><a class="btn btn-danger btnEliminarProductoDocumento"><i class="fa fa-times"></i></a></td>
           
           
           </tr> -->





         </tbody>






       </table> <br>

       <div class="row">

                  <!--=====================================
                  ENTRADA IMPUESTOS Y TOTAL
                  ======================================-->
                  
                  <div class="col-xs-8 pull-right">

                    <table class="table">

                      <thead>

                        <tr>
                          <th></th>
                          <th>Total</th>      
                        </tr>

                      </thead>

                      <tbody>

                        <tr>

                          <td style="width: 50%">

                           <!--  <div class="input-group">
                           
                             <input type="number" class="form-control input-lg" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" placeholder="0" required readonly>
                           
                             <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" required>
                           
                             <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" required>
                           
                             <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                           
                           </div>
                         -->
                       </td>

                       <td style="width: 50%">

                        <div class="input-group">

                          <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                          <input type="text" class="form-control input-lg" id="TotalRequerimientoEquipo" name="TotalRequerimientoEquipo" total="" placeholder="00000" readonly required>

                          




                        </div>

                      </td>

                    </tr>

                  </tbody>

                </table>

              </div>

            </div>




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





<!--=====================================
MODAL AGREGAR USUARIO
======================================-->

<div id="modalVerConclusion" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Ingresar conclusión</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA LA CAEGORIA -->
<!-- 
            <div class="form-group">

              <div class="input-group"> -->

               <!--  <span class="input-group-addon"><i class="fa fa-th"></i></span>  -->
               <div class="form-group">

                <label for="comment" class="text-muted">Escriba los resultados finales del equipo en mantenimiento</label>

                <br>

              </div>

              <textarea class="form-control"  name="nuevaConclusion" id="nuevaConclusion" cols="65" rows="10" required></textarea>
              <!-- <textarea class="form-control" rows="5" id="comentario" name="comentario" maxlength="300" required></textarea> -->

              <input type="hidden" id="idMante" name="idMante">

             <!--  </div>
             
             </div> -->

           </div>

         </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar</button>

        </div>

        <?php

        $actualizarConclu = ControladorMantenimiento::ctrActualizarConclusion();

       ?>

     </form>

   </div>

 </div>

</div>



<?php

$eliminarMantenimiento = ControladorMantenimiento::ctrEliminarMantenimiento();

?>








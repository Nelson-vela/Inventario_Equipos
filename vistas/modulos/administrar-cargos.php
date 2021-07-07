<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar cargos

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar cargos</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCargos">

          Agregar cargo

        </button>

        <button type="button" class="btn btn-default pull-right" id="daterange-btn">

          <span>
            <i class="fa fa-calendar"></i> 

            <?php

            if(isset($_GET["fechaInicial"])){

              echo $_GET["fechaInicial"]." - ".$_GET["fechaFinal"];

            }else{

              echo 'Rango de fecha';

            }

            ?>
          </span>

          <i class="fa fa-caret-down"></i>

        </button>

                <!-- <button class="btn btn-danger" data-toggle="modal" data-target="#modalAgregarPisos">
                
                    Agregar pisos
                
                </button>
              -->
            </div>

            <div class="box-body">

              <table class="table table-bordered table-striped dt-responsive tablaCargosE" id="tablaCargosE" style="width:100%">

               <thead>

                <tr>

                 <th style="width:10px">#</th>
                 <th>N° cargo</th>
                 <th>Usuario que entrega</th>
                 <th>Usuario que recibe</th>
                 <th>Área destino</th>               
                 <th>Equipo</th>                                     
                 <th>Fecha</th>                                     
                 <th>Acciones</th>

               </tr> 

             </thead> 

             <tbody>

              <?php

              if(isset($_GET["fechaInicial"])){

                $fechaInicial = $_GET["fechaInicial"];
                $fechaFinal =   $_GET["fechaFinal"];

              }else{

                $fechaInicial = null;
                $fechaFinal = null;

              }

              $respuesta = ControladorCargo::ctrRangoFechasCargos($fechaInicial, $fechaFinal);

              foreach ($respuesta as $key => $value) {

               $item2 = 'id';

               $valor2 = $value['id_equipo'];
               $valor3 = $value['id_cliente'];
               $valor5 = $value['id_clienteEntrega'];

               $equipos = ControladorEquipo::ctrMostrarEquipos($item2, $valor2);

               $usuarios = ControladorCliente::ctrMostrarCliente($item2, $valor3); 

               $usuarioEntrega = ControladorCliente::ctrMostrarCliente($item2, $valor5);

               $valor4 = $usuarios['id_area'];

               $areas = ControladorArea::ctrMostrarAreas($item2, $valor4);  


               $fechaE = new DateTime($value['fechaEntrega']);



               //$fecha_entrega =  $fechaE->format('d-m-Y');
               $fecha_entrega =  $fechaE->format('d-m-Y');



               /*if ($fecha_entrega == "30-11--0001") {

                $fecha_Entreg = 'Aún no tiene fecha entrega';

              }else{

                $fecha_Entreg = $fecha_entrega;

              }
*/

              echo '<tr>

              <td>'.($key+1).'</td>

              <td>'.$value['serie']."-".$value['codigo'].'</td>';


              echo '<td>'.$usuarioEntrega['nombre'].'</td>';


              echo '<td>'.$usuarios['nombre'].'</td>

              <td>'.$areas['area'].'</td>

              <td>'.$equipos['alias'].'</td>

              <td>'.$fecha_entrega.'</td>



              
              

              ';

              



              echo '<td>

              <button class="btn btn-warning btn-xs editarCargo" idCargo="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarCargo"><i class="fa fa-pencil"></i></button>

              <button class="btn btn-danger  btn-xs eliminarCargo" idCargo="'.$value["id"].'"><i class="fa fa-times"></i></button>

              <a class="btn btn-info btn-xs" href="index.php?ruta=reporteCargo&idCargo='.$value['id'].'"><i class="fa fa-download"></i></a> 

              </td>';   

              


              echo ' 

              

              </tr>';
            }

            ?>

          </tbody>        

        </table>

      </div>

    </div>

  </section>

</div>


<!--=====================================
MODAL AGREGAR USUARIO
======================================-->

<div id="modalAgregarCargos" class="modal fade" role="dialog">

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

                <label for="Área">Equipo</label>

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-users"></i></span>

                  <select class="form-control input-lg" id="nuevoCargoEquipo" name="nuevoCargoEquipo" required>

                    <option value="">Seleccionar equipo</option>

                    <?php 

                    $item = null;
                    $valor = null;

                    $equipo = ControladorEquipo::ctrMostrarEquipos($item, $valor); 

                    foreach ($equipo as $key => $value) { ?>

                      <option value="<?=$value['id']?>"><?=$value['alias']?></option>  

                      <?php

                    }

                    ?>


                  </select> 

                </div>
              </div>


            </div>

          </div>


          <?php 



          $item = null;
          $valor = null;

          $cargos = ControladorCargo::ctrMostrarCargos($item, $valor);

          if (!$cargos) { ?>

            <input type="hidden" class="form-control" id="nuevoCodigoCargo" name="nuevoCodigoCargo" value="001" readonly>

            <?php

          }else{

            foreach ($cargos as $key => $value) {                        

            }

            $codigo = $value['codigo']+1; ?>

            <input type="hidden" class="form-control" id="nuevoCodigoCargo" name="nuevoCodigoCargo" value="<?=$codigo?>" readonly>

            <?php

          }  ?>


          <div class="row">

            <div class="col-md-12">

              <div class="form-group">

                <label for="Área">Usuario que entrega</label>

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-users"></i></span>

                  <select class="form-control input-lg" id="nuevoCargoUsuarioEntrega" name="nuevoCargoUsuarioEntrega" required>

                    <option value="">Seleccionar usuario</option>

                    <?php 

                    $item = null;
                    $valor = null;

                    $usuario = ControladorCliente::ctrMostrarCliente($item, $valor); 

                    foreach ($usuario as $key => $value) { ?>

                      <option value="<?=$value['id']?>"><?=$value['nombre']?></option>  

                      <?php

                    }

                    ?>


                  </select> 

                </div>
              </div>


            </div>

          </div>


          <div class="row">

            <div class="col-md-12">

              <div class="form-group">

                <label for="Área">Usuario que recibe</label>

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-users"></i></span>

                  <select class="form-control input-lg" id="nuevoCargoUsuario" name="nuevoCargoUsuario" required>

                    <option value="">Seleccionar usuario</option>

                    <?php 

                    $item = null;
                    $valor = null;

                    $usuario = ControladorCliente::ctrMostrarCliente($item, $valor); 

                    foreach ($usuario as $key => $value) { ?>

                      <option value="<?=$value['id']?>"><?=$value['nombre']?></option>  

                      <?php

                    }

                    ?>


                  </select> 

                </div>
              </div>


            </div>

          </div>





          <div class="row">

            <div class="col-md-6"> 

              <label for="detalles">Fecha de entrega</label>

              <div class="form-group">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span> 

                  <input type="date" class="form-control input-lg" id="nuevoFechaEquipo" name="nuevoFechaEquipo" required>

                </div>

              </div>

            </div>

            <div class="col-md-6"> 

              <label for="detalles">Hora de entrega</label>

              <div class="form-group">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span> 

                  <input type="time" class="form-control input-lg" id="nuevoHoraEntrega" name="nuevoHoraEntrega" required>

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

          <button type="submit" class="btn btn-primary">Guardar cargo</button>

        </div>

        <?php
        
        $crearCargo = ControladorCargo::ctrRegistrarCargo();
        
        ?>

      </form>

    </div>

  </div>

</div>
















<div id="modalEditarCargo" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar cargo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


           <div class="row">

            <div class="col-md-12">

              <div class="form-group">

                <label for="Área">Equipo</label>

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-users"></i></span>

                  <select class="form-control input-lg" id="editarCargoEquipo" name="editarCargoEquipo" required>

                    <option value="">Seleccionar equipo</option>

                    <?php 

                    $item = null;
                    $valor = null;

                    $equipo = ControladorEquipo::ctrMostrarEquipos($item, $valor); 

                    foreach ($equipo as $key => $value) { ?>

                      <option value="<?=$value['id']?>"><?=$value['alias']?></option>  

                      <?php

                    }

                    ?>


                  </select> 

                </div>
              </div>


            </div>

          </div>


          <?php 


/*
          $item = null;
          $valor = null;

          $cargos = ControladorCargo::ctrMostrarCargos($item, $valor);

          if (!$cargos) { ?>

            <input type="hidden" class="form-control" id="editarCodigoCargo" name="editarCodigoCargo" value="001" readonly>

            <?php

          }else{

            foreach ($cargos as $key => $value) {                        

            }

            $codigo = $value['codigo']+1; ?>

            <input type="hidden" class="form-control" id="editarCodigoCargo" name="editarCodigoCargo" value="<?=$codigo?>" readonly>

            <?php

          } */ ?>


          <div class="row">

            <div class="col-md-12">

              <div class="form-group">

                <label for="Área">Usuario que entrega</label>

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-users"></i></span>

                  <select class="form-control input-lg" id="editarCargoUsuarioEntrega" name="editarCargoUsuarioEntrega" required>

                    <option value="">Seleccionar usuario</option>

                    <?php 

                    $item = null;
                    $valor = null;

                    $usuario = ControladorCliente::ctrMostrarCliente($item, $valor); 

                    foreach ($usuario as $key => $value) { ?>

                      <option value="<?=$value['id']?>"><?=$value['nombre']?></option>  

                      <?php

                    }

                    ?>


                  </select> 

                </div>
              </div>


            </div>

          </div>

          <div class="row">

            <div class="col-md-12">

              <div class="form-group">

                <label for="Área">Usuario que recibe</label>

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-users"></i></span>

                  <select class="form-control input-lg" id="editarCargoUsuario" name="editarCargoUsuario" required>

                    <option value="">Seleccionar usuario</option>

                    <?php 

                    $item = null;
                    $valor = null;

                    $usuario = ControladorCliente::ctrMostrarCliente($item, $valor); 

                    foreach ($usuario as $key => $value) { ?>

                      <option value="<?=$value['id']?>"><?=$value['nombre']?></option>  

                      <?php

                    }

                    ?>


                  </select> 

                </div>
              </div>


            </div>

          </div>




          <div class="row">

            <div class="col-md-6"> 

              <label for="detalles">Fecha de entrega</label>

              <div class="form-group">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span> 

                  <input type="date" class="form-control input-lg" id="editarFechaEquipoCargo" name="editarFechaEquipoCargo" required>
                  <input type="hidden" id="idCargoE" name="idCargoE" value="">

                </div>

              </div>

            </div>

            <div class="col-md-6"> 

              <label for="detalles">Hora de entrega</label>

              <div class="form-group">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span> 

                  <input type="time" class="form-control input-lg" id="editarhoraEntregaCargo" name="editarhoraEntregaCargo" required>

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

          <button type="submit" class="btn btn-primary">Guardar cargo</button>

        </div>

        <?php
        
        $editarCargo = ControladorCargo::ctrEditarCargo();
        
        ?>

      </form>

    </div>

  </div>

</div>












<?php

$eliminarCargo= ControladorCargo::ctrEliminarCargo();

?>








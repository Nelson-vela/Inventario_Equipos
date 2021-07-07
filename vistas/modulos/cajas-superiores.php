<?php 



$equipos = ControladorEquipo::ctrMostrarTotalEquipos();



$pendientes = ControladorVenta::ctrMostrarTotalVentaPendiente();


$areas = ControladorArea::ctrMostrarTotalAreas();


$cargos = ControladorCargo::ctrMostrarTotalCargo();



$usuarios = ControladorCliente::ctrMostrarTotalCliente();



$proveedores = ControladorProveedor::ctrMostrarTotalProveedor();



$administradores = ControladorUsuarios::ctrMostrarTotalUsuario();


$totalMantenimiento = ControladorMantenimiento::ctrMostrarTotalMantenimiento();

$gastosMantenimiento = ControladorMantenimiento::ctrMostrarTotalGastoMantenimiento();


$valorP = 1;

$MantenimientoPendiente = ControladorMantenimiento::ctrMostrarTotalPendienteReparado($valorP);

$totalCompras = ControladorCompras::ctrMostrarTotalCompras();


 


 



/*==================================================
=            OBTENER LA GANANCIA DEL MES            =
==================================================*/
date_default_timezone_set('America/Bogota');


$fechaInicio = date('Y-m-01');
$fechaFin = date('Y-m-t'); //t te devuelve el último día del mes

//$fechaFin =  date('y-m-d', strtotime($fechaInicio. ' + 30 days'));


$datos = array("fechaInicio" =>$fechaInicio,
 "fechaFin" =>$fechaFin);


$gananciaMensual = ControladorPresupuesto::ctrMostrarTotalPorMes($datos);

$gastos = ControladorPresupuesto::ctrMostrarTotalPresupuestoPorMes($datos); 



?>




<!--=====================================

CAJAS SUPERIORES

======================================-->

<!-- <div class="row">
  

<div class="col-lg-12 col-xs-12">



  small box

  <div class="small-box bg-green">



    inner

    <div class="inner text-center">

     
  

      <h3>€ <b id="gastosTotal"><?=round($gananciaMensual['total']) - round($gastosFijos['total'] + $gastos['total'])?></b></h3>



      <p>Ganancia Real</p>



    </div>

    inner



    icon

    <div class="icon">



      <i class="fa fa-money"></i>



    </div>

    icon



    <a href="administrar-servicios" class="small-box-footer">Más Info <i class="fa fa-arrow-circle-right"></i></a>



  </div>

  small-box



</div>




</div> -->


<div class="col-lg-3 col-xs-12">



  <!-- small box -->

  <div class="small-box bg-purple">



    <!-- inner -->

    <div class="inner text-center">



      <h3 id="tareas"> <?=number_format(count($equipos))?></h3>



      <p>Equipos</p>



    </div>

    <!-- inner -->



    <!-- icon -->

    <div class="icon">



      <i class="fa fa-money"></i>



    </div>

    <!-- icon -->



    <a href="tareas" class="small-box-footer">Más Info <i class="fa fa-arrow-circle-right"></i></a>



  </div>

  <!-- small-box -->



</div>










<div class="col-lg-3 col-xs-12">



  <!-- small box -->

  <div class="small-box bg-red">



    <!-- inner -->

    <div class="inner text-center">

    

      <h3><?=number_format(count($usuarios))?></h3>



      <p>Usuarios</p>



    </div>

    <!-- inner -->



    <!-- icon -->

    <div class="icon">



      <i class="fa fa-money"></i>



    </div>

    <!-- icon -->



    <a href="clientes" class="small-box-footer">Más Info <i class="fa fa-arrow-circle-right"></i></a>



  </div>

  <!-- small-box -->



</div>






<div class="col-lg-3 col-xs-12">



  <!-- small box -->

  <div class="small-box bg-navy">



    <!-- inner -->

    <div class="inner text-center">

    

      <h3><?=number_format(count($areas))?></h3>



      <p>Areas</p>



    </div>

    <!-- inner -->



    <!-- icon -->

    <div class="icon">



      <i class="fa fa-money"></i>



    </div>

    <!-- icon -->



    <a href="clientes" class="small-box-footer">Más Info <i class="fa fa-arrow-circle-right"></i></a>



  </div>

  <!-- small-box -->



</div>







<div class="col-lg-3 col-xs-12">



  <!-- small box -->

  <div class="small-box bg-blue">



    <!-- inner -->
    <div class="inner text-center">

    

      <h3><?=number_format(count($cargos))?></h3>



      <p>Cargos</p>



    </div>

    <!-- inner -->



    <!-- icon -->

    <div class="icon">



      <i class="fa fa-euro"></i>



    </div>

    <!-- icon -->

    

    <a href="administrar-cargos" class="small-box-footer">Más Info <i class="fa fa-arrow-circle-right"></i></a>



  </div>

  <!-- small-box -->



</div>



<div class="col-lg-3 col-xs-12">



  <!-- small box -->

  <div class="small-box bg-maroon">



    <!-- inner -->
    <div class="inner text-center">

    

      <h3><?=number_format(count($proveedores))?></h3>



      <p>Proveedores</p>



    </div>

    <!-- inner -->



    <!-- icon -->

    <div class="icon">



      <i class="fa fa-euro"></i>



    </div>

    <!-- icon -->

    

    <a href="proveedores" class="small-box-footer">Más Info <i class="fa fa-arrow-circle-right"></i></a>



  </div>

  <!-- small-box -->



</div>




<!-- col -->

<div class="col-lg-3 col-xs-12">



  <!-- small box -->

  <div class="small-box bg-aqua">



    <!-- inner -->

    <div class="inner text-center">

    

      <h3><?=number_format(count($totalMantenimiento))?></h3>



      <p>Matenimiento</p>



    </div>

    <!-- inner -->



    <!-- icon -->

    <div class="icon">



      <i class="fa fa-users"></i>



    </div>

    <!-- icon -->

    

    <a href="mantenimiento" class="small-box-footer">Más Info <i class="fa fa-arrow-circle-right"></i></a>



  </div>

  <!-- small-box -->



</div>

<!-- col -->



<!-- col -->

<div class="col-lg-3 col-xs-12">



  <!-- small box -->

  <div class="small-box bg-info">



    <!-- inner -->

    <div class="inner text-center">

    

      <h3><?=number_format(count($MantenimientoPendiente))?></h3>



      <p>Mantenimiento pendientes</p>



    </div>

    <!-- inner -->



    <!-- icon -->

    <div class="icon">



      <i class="ion ion-bag"></i>



    </div>

    <!-- icon -->

    

    <a href="mantenimiento" class="small-box-footer">Más Info <i class="fa fa-arrow-circle-right"></i></a>



  </div>

  <!-- small-box -->



</div>



<!--===========================================================================-->



<!-- col -->

<div class="col-lg-3 col-xs-12">



  <!-- small box -->

  <div class="small-box bg-green">



    <!-- inner -->

    <div class="inner text-center">

    

      <h3>S/ <?=number_format(round($gastosMantenimiento['total']),2)?></h3>



      <p>Gastos en Mantenimiento</p>



    </div>

    <!-- inner -->

    

    <!-- icon -->

    <div class="icon">



      <i class="fa fa-institution"></i>



    </div>

    <!-- icon -->



    <a href="categorias" class="small-box-footer">Más Info <i class="fa fa-arrow-circle-right"></i></a>



  </div>

  <!-- small box -->



</div>

<!-- col -->



<!--===========================================================================-->



<!-- col -->

<div class="col-lg-3 col-xs-12">



  <!-- small box -->

  <div class="small-box bg-yellow">



    <!-- inner -->

   <div class="inner text-center">

    

      <h3>S/ <?= number_format(round($totalCompras['total']),2)?></h3>



      <p>Compras</p>



    </div>

    <!-- inner -->



    <!-- icon -->

    <div class="icon">



      <i class="ion ion-person-add"></i>



    </div>

    <!-- icon -->



    <a href="gastos" class="small-box-footer">Más Info <i class="fa fa-arrow-circle-right"></i></a>



  </div>

  <!-- small box -->



</div>













<!-- col -->









<!--===========================================================================-->



<!-- col ~~>

<div class="col-lg-3 col-xs-6">



  <!~~ small box ~~>

  <div class="small-box bg-red">



    <!~~ inner ~~>

    <div class="inner">



      <h3><!~~ <?= number_format(count($productos))?> ~~></h3>



      <p>Mensajes</p>



    </div>

    <!~~ inner ~~>

    

    <!~~ icon ~~>

    <div class="icon">



      <i class="ion ion-pie-graph"></i>



    </div>

    <!~~ icon ~~>

    

    <a href="mensaje" class="small-box-footer">Más Info <i class="fa fa-arrow-circle-right"></i></a>



  </div>

  <!~~ small box ~~>



</d-->





<!-- col --><!--===========================================================================-->



<!-- col -->

<!-- <div class="col-lg-3 col-xs-6">



  small box

  <div class="small-box bg-purple">



    inner

    <div class="inner">



      <h3>0<?= number_format(count($productos))?></h3>



      <p>Reportes</p>



    </div>

    inner

    

    icon

    <div class="icon">



      <i class="fa fa-line-chart"></i>



    </div>

    icon

    

    <a href="#" class="small-box-footer">Más Info <i class="fa fa-arrow-circle-right"></i></a>



  </div>

  small box



</div> -->






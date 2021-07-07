<?php session_start()?>
<?php 

      if(isset($_GET["ruta"])){

        if($_GET["ruta"] == "reporte" ||

            $_GET["ruta"] == "reporteUsuario"||

            $_GET["ruta"] == "reporteCargo"||

            $_GET["ruta"] == "reporteEquipo"||

            $_GET["ruta"] == "reporteMantenimiento"||

            $_GET["ruta"] == "reporteComprash"||

            $_GET["ruta"] == "reporteComprasv"||


            $_GET["ruta"] == "invoice"||

            $_GET["ruta"] == "reportegeneral"){

         include "modulos/fpdf/".$_GET["ruta"].".php";

        }

      }

?>


<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Inventory Control - Copy Center S.R.L</title>

  <meta name="description" content="Sistema de Inventario de equipos de Copy Center">

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="icon" href="vistas/img/plantilla/icono .png">  

   <!--=====================================
  PLUGINS DE CSS
  ======================================-->

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/bower_components/font-awesome/css/font-awesome.min.css">

  <!-- Ionicons -->
  <link rel="stylesheet" href="vistas/bower_components/Ionicons/css/ionicons.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/AdminLTE.css">
  
  <!-- AdminLTE Skins -->
  <link rel="stylesheet" href="vistas/dist/css/skins/_all-skins.min.css">

  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">

    <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="vistas/plugins/iCheck/all.css">

    <!-- Daterange picker -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap-daterangepicker/daterangepicker.css">

  <link rel="stylesheet" href="vistas/plugins/datepicker/datepicker3.css">

  <link rel="stylesheet" href="vistas/css/style.css">
  <link rel="stylesheet" href="vistas/css/styles.css">


  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


   <!--=====================================
  PLUGINS DE JAVASCRIPT
  ======================================-->

  <!-- jQuery 3 -->
  <script src="vistas/bower_components/jquery/dist/jquery.min.js"></script>

  <script src="vistas/plugins/jQueryUI/jquery-ui.js"></script>
  
  <!-- Bootstrap 3.3.7 -->
  <script src="vistas/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- FastClick -->
  <script src="vistas/bower_components/fastclick/lib/fastclick.js"></script>
  
  <!-- AdminLTE App -->
  <script src="vistas/dist/js/adminlte.min.js"></script>

  
  <script src="vistas/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>

  <!-- Sweetalert2 -->

  <script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script>

    <!-- iCheck 1.0.1 -->
  <script src="vistas/plugins/iCheck/icheck.min.js"></script>

    <!-- InputMask -->
  <script src="vistas/plugins/input-mask/jquery.inputmask.js"></script>
  <script src="vistas/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="vistas/plugins/input-mask/jquery.inputmask.extensions.js"></script>

<!-- JQuery Number -->

  <script src="vistas/plugins/jqueryNumber/jquerynumber.min.js"></script>

  <script src="vistas/plugins/datepicker/bootstrap-datepicker.js"></script>

    <!-- daterangepicker http://www.daterangepicker.com/-->
  <script src="vistas/bower_components/moment/min/moment.min.js"></script>
  <script src="vistas/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
  
</head>


<body class="hold-transition skin-blue  sidebar-mini login-page"> <!-- sidebar-collapse -->


<!--  CONDICION PARA VALIDAR SI EXISTE UNA SESION INICIADA-->

<?php if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){ ?>

 <!-- Site wrapper -->
  <div class="wrapper"> 

    <?php 

                    /*=============================================
                    HEADER
                    =============================================*/
                    include 'modulos/header.php';


                    /*=============================================
                    MENU
                    =============================================*/
                    include 'modulos/menu.php';


                    /*=============================================
                    CONTENIDO (CREO MI LISTA BLANCA)
                    =============================================*/
                    if(isset($_GET["ruta"])){

                      if($_GET["ruta"] == "inicio" ||
                       $_GET["ruta"] == "usuarios" ||
                       $_GET["ruta"] == "categorias" ||
                       $_GET["ruta"] == "productos" ||
                       $_GET["ruta"] == "clientes" ||
                      /* $_GET["ruta"] == "ventas" ||*/
                     /*  $_GET["ruta"] == "crear-servicio" ||*/
                      /* $_GET["ruta"] == "editar-venta" || */                     
                       $_GET["ruta"] == "correo" ||                      
                       $_GET["ruta"] == "tareas" ||                      
                       /*$_GET["ruta"] == "administrar-servicios" ||*/
                       $_GET["ruta"] == "administrar-cargos" ||
                       /*$_GET["ruta"] == "ingreso" ||*/
                       $_GET["ruta"] == "gastos" ||
                       $_GET["ruta"] == "proveedores" ||
                       $_GET["ruta"] == "estadisticas" ||
                       $_GET["ruta"] == "mantenimiento" ||
                       $_GET["ruta"] == "areas" ||
                       $_GET["ruta"] == "salir"){

                        include "modulos/".$_GET["ruta"].".php";

                    }else{

                      include "modulos/404.php";

                    }

                  }else{

                    include "modulos/inicio.php";

                  }


                    /*=============================================
                    CONTENIDO
                    =============================================*/
                    include 'modulos/footer.php';
                    ?>

                  </div>
                  <!-- ./wrapper -->

                  <?php

                  }else{

                  include "modulos/login.php";

                  }

                  ?>


                  <script src="vistas/js/plantilla.js"></script>
                  <script src="vistas/js/usuarios.js"></script>       
                  <script src="vistas/js/categorias.js"></script>
                  <script src="vistas/js/dataTable.js"></script>
                  <script src="vistas/js/productos.js"></script>
                  <script src="vistas/js/clientes.js"></script>
                <!--   <script src="vistas/js/ventas.js"></script>
                <script src="vistas/js/ventaE.js"></script> -->
                  <script src="vistas/js/servicios.js"></script>
                  <script src="vistas/js/servicios1.js"></script>              
                  <script src="vistas/js/tablaTareas.js"></script>              
                  <script src="vistas/js/galeria-reporte.js"></script>              
                  <script src="vistas/js/presupuesto.js"></script>              
                  <script src="vistas/js/gastosfijos.js"></script>              
                  <script src="vistas/js/documentoscompras.js"></script>              
                  <script src="vistas/js/mantenimiento.js"></script>              
                  <script src="vistas/js/proveedor.js"></script>              
                  <script src="vistas/js/cargos.js"></script>              
                  <script src="vistas/js/areas.js"></script>              
                </body>
                </html>

<div class="content-wrapper">



	<section class="content-header">



		<h1>



			Administrar galeria de reportes



		</h1>



		<ol class="breadcrumb">



			<li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>



			<li class="active">Subir foto a reporte</li>



		</ol>



	</section>



	<section class="content">



		<div class="box">



			<div class="box-body">



				<div class="box-header with-border">



					<button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarFoto">



						Agregar foto



					</button>



					<button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarFotoConformidad">



						Agregar foto conformidad



					</button>

                    <a class="btn btn-danger pull-right" href="administrar-servicios">volver</a>



				</div>

 



				<div id="imgSlide" class="col-lg-10 col-md-10 col-sm-9 col-xs-12">



					<hr>

					<!-- <h3><strong>Comedor</strong></h3> -->

					<p><span class="fa fa-arrow-down"></span> Visualización de toda la galeria</p>



					<ul id="columnasGaleria">



						<?php


						
						$item = 'idventa';
                        $valor =  $_GET['idVenta'];
                        $tabla = 'galeria';


						
						$tabla2 = 'galeria_conformidad';


						$galeria = ControladorCategoriaGaleria::ctrMostrarCategoriaGaleria($tabla, $item, $valor);						
						$galeriaC = ControladorCategoriaGaleria::ctrMostrarCategoriaGaleria($tabla2, $item, $valor);								



						foreach ($galeria as $key => $value) { ?>



							<li idGaleria="<?=$value['id']?>" class="bloqueGaleria">

								<span class="fa fa-times eliminarGaleria" ruta="<?=$value['ruta']?>"></span>

								<img src="<?=$value['ruta']?>" class="handleImg"></li>



							<?php } 

							foreach ($galeriaC as $key => $valueC) { ?>



							<li idGaleriaC="<?=$valueC['id']?>" class="bloqueGaleria">

								<span class="fa fa-times eliminarGaleriaC" rutaC="<?=$valueC['ruta']?>"></span>

								<img src="<?=$valueC['ruta']?>" class="handleImg"></li>



							<?php } ?>



						</ul>



					</div>	

				

					<hr>				



			</div>



		</section>



	</div>









	<!--====  Fin de COLUMNA CONTENIDO  ====-->











<!--=====================================

MODAL AGREGAR USUARIO

======================================-->



<div id="modalAgregarFoto" class="modal fade" role="dialog">



	<div class="modal-dialog">



		<div class="modal-content">



			<form role="form" method="post" enctype="multipart/form-data">



        <!--=====================================

        CABEZA DEL MODAL

        ======================================-->



        <div class="modal-header" style="background:#3c8dbc; color:white">



        	<button type="button" class="close" data-dismiss="modal">&times;</button>



        	<h4 class="modal-title">Agregar foto</h4>



        </div>



        <!--=====================================

        CUERPO DEL MODAL

        ======================================-->


        <div class="modal-body">



        	<div class="box-body">


        		<!-- ENTRADA PARA SUBIR FOTO -->
    
                <?php 

                 $id = $_GET['idVenta'];
                 ?>
                 
                  <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-text-height"></i></span> 

                <input type="text" class="form-control input-lg" id="nombreFoto" name="nombreFoto">

                 
              </div>

            </div>
            
            <!-- ENTRADA PARA LA FOTO -->

        		<div class="form-group">

                    <input type="hidden" name="idventa" id="idven" value="<?=$id?>">

        			<div class="panel">SUBIR FOTO</div>



        			<input type="file" id="nuevaFotoGaleria" class="nuevaFotoGaleria" name="nuevaFotoGaleria" required>



        			<p class="help-block">Peso máximo de la foto 2 MB</p>



        			<img src="vistas/img/galeria/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">



        		</div>



        	</div>



        </div>



        <!--=====================================

        PIE DEL MODAL

        ======================================-->



        <div class="modal-footer">



        	<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>



        	<button type="submit" class="btn btn-primary">Guardar foto</button>



        </div>





          <?php



          $subirGaleriaFoto = new ControladorCategoriaGaleria();

          $subirGaleriaFoto -> ctrSubirFotoGaleria();



        ?>





    </form>



</div>



</div>



</div>



<div id="modalAgregarFotoConformidad" class="modal fade" role="dialog">



	<div class="modal-dialog">



		<div class="modal-content">



			<form role="form" method="post" enctype="multipart/form-data">



        <!--=====================================

        CABEZA DEL MODAL

        ======================================-->



        <div class="modal-header" style="background:#3c8dbc; color:white">



        	<button type="button" class="close" data-dismiss="modal">&times;</button>



        	<h4 class="modal-title">Agregar foto de conformidad</h4>



        </div>



        <!--=====================================

        CUERPO DEL MODAL

        ======================================-->


        <div class="modal-body">



        	<div class="box-body">


        		<!-- ENTRADA PARA SUBIR FOTO -->

        		<?php 

        		  $id = $_GET['idVenta'];
        		?>

        		<div class="form-group">

        			<input type="hidden" name="idventaC" id="idven" value="<?=$id?>">

        			<div class="panel">SUBIR FOTO</div>



        			<input type="file" id="nuevaFotoGaleria" class="nuevaFotoGaleria" name="nuevaFotoGaleriaConformidad" required>



        			<p class="help-block">Peso máximo de la foto 2 MB</p>



        			<img src="vistas/img/galeria/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">



        		</div>



        	</div>



        </div>



        <!--=====================================

        PIE DEL MODAL

        ======================================-->



        <div class="modal-footer">



        	<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>



        	<button type="submit" class="btn btn-primary">Guardar foto</button>



        </div>





        <?php



        $subirGaleriaFotoConformidad = new ControladorCategoriaGaleria();

        $subirGaleriaFotoConformidad -> ctrSubirFotoGaleriaConformidad();



        ?>





    </form>



</div>



</div>



</div>



<?php



$eliminarGaleria = new ControladorCategoriaGaleria();

$eliminarGaleria -> ctrEliminarGaleria();


if (isset($_GET['rutaGaleriaC'])) {


$eliminarGaleria = new ControladorCategoriaGaleria();

$eliminarGaleria -> ctrEliminarGaleriaConformidad();

  
}



?>
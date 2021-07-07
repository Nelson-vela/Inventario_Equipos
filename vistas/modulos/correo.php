

<?php 



	/*$id = $_POST['idClie'];*/



 ?>



<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">

	<!-- Content Header (Page header) -->

	<section class="content-header">

		

		<h1>

			Correo

			<small>Panel de Correo</small>

		</h1>



		<ol class="breadcrumb">

			<li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

			<li class="active">Correo</a></li>         

		</ol>

	</section>



	<!-- Main content -->

	<section class="content">



		<!-- Default box -->

		<div class="box">





			<div class="box-header with-border">



				<!--=====================================

				MENSAJES        

				======================================-->



				<div id="bandejaMensajes" class="col-lg-4 col-md-4 col-sm-6 col-xs-12">



					<div>



						<h1>Bandeja de Entrada</h1>



						<hr>



					</div>



					<?php 			 



					$item = 'id';



					$valor = $_GET['idClie'];



					$cliente = ControladorVenta::ctrMostrarVenta($item, $valor);



					?>





					<div class="well well-sm" id="">



						<!--<a href="#"><span class="fa fa-times pull-right"></span></a>-->



						<p><?=$cliente['fecha']?></p>



						<h3>Para: <?=$cliente['cliente']?></h3>



						<h5>Email: <?=$cliente['email']?></h5>



						



						<br>



						<!--<button class="btn btn-info btn-sm leerMensaje">Enviar</button>-->



					</div>









				</div>





				<div id="lecturaMensajes" class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><br><br><br>





					<div id="visorMensajes">



						<form method="post" enctype="multipart/form-data"><br>



							<p>Para: 



								<input type="email" value="<?=$cliente['email']?>" name="enviarEmail" readonly style="border:0"><br>



								<input type="hidden" value="<?=$cliente['nombre']?>" name="enviarNombre"></p>



								<input type="text" name="enviarTitulo" placeholder="Título del Mensaje" class="form-control"><br>



								<textarea name="enviarMensaje" cols="30" rows="5" placeholder="Escribe tu mensaje..." class="form-control"></textarea><br>



                                <label>Seleccione un archivo:</label><br>

                                

                                <input type="file" name="archivo" /><br>



								<input type="submit" class="form-control btn btn-primary" value="Enviar">



								<?php 



								$enviar = ControladorCorreo::ctrEnviarCorreo();



								 ?>



						</form>





					</div>





				</div>



			</div>  









			<!-- /.box-body -->

			<!-- <div class="box-footer">

			

				Footer

			

			</div> -->

			<!-- /.box-footer-->

		</div>

		<!-- /.box -->



	</section>

	<!-- /.content -->

</div>
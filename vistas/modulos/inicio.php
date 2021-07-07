
<?php 

$rol = $_SESSION["perfil"];

$validar = ControladorUsuarios::ctrRolVendedor($rol);


 ?>





<div class="content-wrapper">

	<!-- Content Header (Page header) -->

	<section class="content-header">

		

		<h1>

			Tablero

			<small>Panel de Control</small>

		</h1>



		<ol class="breadcrumb">

			<li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

			<li class="active">Tablero</a></li>         

		</ol>

	</section>



	<!-- Main content -->

	<section class="content">



		<!-- Default box -->

		<div class="box">

		<!-- 	<div class="box-header with-border">
		
			<a href="crear-servicio">
		
				<button class="btn btn-primary">
		
					Crear servicios
		
				</button>
		
			</a>
		
		</div> -->

<!-- 			

			<div class="box-header with-border">



			 



			</div> -->



			<div class="box-body">



				<div class="row">



					<?php include 'vistas/modulos/cajas-superiores.php' ?>



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
 <header class="main-header">
 	
	<!--=====================================
	LOGOTIPO
	======================================-->
	<a href="inicio" class="logo">
		
		<!-- logo mini -->
		<span class="logo-mini">
			
			<img src="vistas/img/plantilla/icono .png" class="img-responsive" style="padding:10px">

		</span>

		<!-- logo normal -->

		<span class="logo-lg">
			
		<!-- <img src="vistas/img/plantilla/logo-blanco-lineal.png" class="img-responsive" style="padding:10px 0px"> -->

			<h4 lass="img-responsive" style="padding:3px">Copy Center S.R.L </h4>

		</span>

	</a>

	<!--=====================================
	BARRA DE NAVEGACIÓN
	======================================-->
	<nav class="navbar navbar-static-top" role="navigation">
		
		<!-- Botón de navegación -->

		<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">

			<span class="sr-only">Toggle navigation</span>

		</a>

		<!-- perfil de usuario -->

		<div class="navbar-custom-menu">

			<ul class="nav navbar-nav">
				
				<li class="dropdown user user-menu">
					
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						
						<?php 
						
						if ($_SESSION["foto"] != "") {  ?>

							<img src="<?=$_SESSION["foto"]?>" class="user-image">

						<?php 

						}else{ ?>

							<img src="vistas/img/usuarios/default/anonymous.png" class="user-image">


						<?php }	?>

						
						<span class="hidden-xs"><?=$_SESSION["nombre"]?></span>

					</a>

					<!-- Dropdown-toggle -->

					<ul class="dropdown-menu">
						
						<li class="user-body">
							
							<div class="pull-right">
								
								<a href="salir" class="btn btn-default btn-flat">Salir</a>

							</div>

						</li>

					</ul>

				</li>

			</ul>

		</div>

	</nav>

</header>
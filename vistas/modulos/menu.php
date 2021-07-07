<aside class="main-sidebar">



	<section class="sidebar">



		<ul class="sidebar-menu">


			<?php 

			if ($_SESSION["perfil"] == "Administrador") { ?>

				<li class="active">



				<a href="inicio">



					<i class="fa fa-home"></i>

					<span>Inicio</span>



				</a>



			</li>



			<li>



				<a href="usuarios">



					<i class="fa fa-user"></i>

					<span>Administradores</span>



				</a>



			</li>



			<li>



				<a href="categorias">



					<i class="fa fa-th"></i>

					<span>Categorías</span>



				</a>



			</li>

			<li>



				<a href="clientes">



					<i class="fa fa-users"></i>

					<span>Usuarios</span>



				</a>



			</li>

			<li>



				<a href="areas">



					<i class="fa fa-briefcase"></i>

					<span>Areas</span>



				</a>



			</li>


			<li>



				<a href="proveedores">



					<i class="fa fa-opencart"></i>

					<span>Proveedores</span>



				</a>



			</li>



			<li>



				<a href="tareas">



					<i class="fa fa-tv"></i>

					<span>Equipos</span>



				</a>



			</li>

			<li>



				<a href="administrar-cargos">



					<i class="fa fa-list-ul"></i>

					<span>Administrar cargos</span>



				</a>



			</li>



			<li>



				<a href="mantenimiento">



					<i class="fa fa-wrench"></i>

					<span>Mantenimiento</span>



				</a>



			</li>


			


			<!-- <li class="treeview">
			
			
			
				<a href="#">
			
			
			
					<i class="fa fa-list-ul"></i>
			
					
			
					<span>Servicios</span>
			
					
			
					<span class="pull-right-container">
			
			
			
						<i class="fa fa-angle-left pull-right"></i>
			
			
			
					</span>
			
			
			
				</a>
			
			
			
				<ul class="treeview-menu">
			
					
			
					<li>
			
			
			
						<a href="administrar-servicios">
			
							
			
							<i class="fa fa-circle-o"></i>
			
							<span>Administrar servicios</span>
			
			
			
						</a>
			
			
			
					</li>
			
			
			
					<li>
			
			
			
						<a href="crear-servicio">
			
							
			
							<i class="fa fa-circle-o"></i>
			
							<span>Crear servicio</span>
			
			
			
						</a>
			
			
			
					</li>
			
			
				</ul>
			
			
			
			</li> -->


				<li>



				<a href="gastos">

							

							<i class="fa fa-euro"></i>

							<span>Compras</span>



						</a>



			</li>




			


			


			<li>



				<a href="estadisticas">



					<i class="fa fa-line-chart"></i>

					<span>Estadisticas</span>



				</a>



			</li>


			<?php }else{ ?>


					<li>



				<a href="clientes">



					<i class="fa fa-users"></i>

					<span>Clientes</span>



				</a>



			</li>

				<li class="treeview">



				<a href="#">



					<i class="fa fa-list-ul"></i>

					

					<span>Servicios</span>

					

					<span class="pull-right-container">



						<i class="fa fa-angle-left pull-right"></i>



					</span>



				</a>



				<!-- <ul class="treeview-menu">
				
					
				
					<li>
				
				
				
						<a href="administrar-servicios">
				
							
				
							<i class="fa fa-circle-o"></i>
				
							<span>Administrar servicios</span>
				
				
				
						</a>
				
				
				
					</li>
				
				
				
					<li>
				
				
				
						<a href="crear-servicio">
				
							
				
							<i class="fa fa-circle-o"></i>
				
							<span>Crear servicio</span>
				
				
				
						</a>
				
				
				
					</li>
				
				
				</ul> -->



			</li>

			<?php }



			?>


			



			



		</ul>



	</section>



</aside>
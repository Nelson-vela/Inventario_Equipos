<div class="content-wrapper">

	<section class="content-header">

		<h1>

			Administrar Servicios

		</h1>

		<ol class="breadcrumb">

			<li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

			<li class="active">Administrar servicios</li>

		</ol>

	</section>

	<section class="content">

		<div class="box">

			<div class="box-header with-border">

				<a href="crear-servicio">

					<button class="btn btn-primary">

						Crear servicios

					</button>

				</a>

			</div>

			<div class="box-body table-responsive">

				
				<table class="table table-bordered table-striped dt-responsive table-hover ventas">

					<thead>

						<tr>

							<th style="width:10px">#</th>
							<th>Código factura</th>
							<th>Cliente</th>
							<th>Num Pedido</th>
							<th>Num Obra</th>
							<th>Forma de pago</th>
							<th>Neto</th>
							<th>Total</th>
							<th>Fecha</th>
							<th>Estado</th>											                
							 											                
							<!-- <th>Último servicio</th> -->											                
							<th>Acciones</th>

						</tr> 

					</thead>

					<tbody>
	
	<?php 
	
	$item = null;
	$valor = null;
	
	$clientes = ControladorVenta::ctrMostrarVenta($item, $valor);
	
	
	foreach ($clientes as $key => $cli) { ?>
		
		
		
		<tr>
			<td><?=$key+1?></td>
			<td><?=$cli['codigo']?></td>  
			
			<?php 
			
			$itemCliente = 'id';
			$valor = $cli['id_cliente'];
			
			$respuesta = ControladorCliente::ctrMostrarCliente($itemCliente, $valor);
			?>
			
			<td><?=$respuesta['nombre']?></td> 
			
			<td><?=$cli['numPedido']?></td>               
			<td><?=$cli['numObra']?></td>               
			<td><?=$cli['metodo_pago']?></td>               
			<td>€. <?=number_format($cli['neto'],2)?></td>               
			<td>€. <?=number_format($cli['total'],2)?></td>    
			<td><?=$cli['fecha']?></td>
			
			<?php 
			
			$itemCliente = 'id';
			$valor = $cli['id_cliente'];
			
			$respuesta = ControladorCliente::ctrMostrarCliente($itemCliente, $valor);
			?>
			
			<?php if($cli["estado"] != 0){ ?>
				
				<td><button class="btn btn-success btn-xs btnActivarServicio" idVenta="<?=$cli['id']?>" estadoVenta="0">Cancelado</button></td>
				
			<?php }else{ ?>
				
				<td><button class="btn btn-danger btn-xs btnActivarServicio" idVenta="<?=$cli['id']?>"  estadoVenta="1">Pendiente</button></td>
				
			<?php } ?>
			
			
			<!-- <td><?=$respuesta['ultima_compra']?></td>  -->         
			
			
			<td>
				<div class="btn-group">
					
					<button class="btn btn-warning btnEditarVenta" idVenta= "<?=$cli['id']?>" > <i class="fa fa-pencil"></i></button>
					
					<a href="index.php?ruta=correo&idClie=<?=$cli['id_cliente']?>" class="btn btn-success"> <i class="fa fa-mail-forward"></i></a>

					<a href="index.php?ruta=reporte&idClie=<?=$cli['id']?>" class="btn btn-info"> <i class="fa fa-download"></i></a>				
					
					<button class="btn btn-danger btnEliminarVenta" idVenta= "<?=$cli['id']?>" ><i class="fa fa-times"></i></button> 
					
				</div>  
				
			</td>



			 
			
		</tr> 
		
	<?php }  ?>           
	
</tbody>

				</table>

				<?php 

				$eliminarVenta = ControladorVenta::ctrEliminarVenta();

				?>
			</div>

		</div>

	</section>

</div>



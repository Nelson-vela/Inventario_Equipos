<?php 

$rol = $_SESSION["perfil"];

$validar = ControladorUsuarios::ctrRolVendedor($rol);


 ?>


<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar categorias

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar categorias</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoria">

          Agregar categoria

        </button>

      </div>

      <div class="box-body">

       <table class="table table-bordered table-striped dt-responsive tablaCategorias">

        <thead>

         <tr>

           <th style="width:10px">#</th>
           <th>Categorias</th>        

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

<div id="modalAgregarCategoria" class="modal fade" role="dialog">

	<div class="modal-dialog">

		<div class="modal-content">

			<form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

        	<button type="button" class="close" data-dismiss="modal">&times;</button>

        	<h4 class="modal-title">Agregar Categoria</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

        	<div class="box-body">

        		<!-- ENTRADA PARA LA CAEGORIA -->

        		<div class="form-group">

        			<div class="input-group">

        				<span class="input-group-addon"><i class="fa fa-th"></i></span> 

        				<input type="text" class="form-control input-lg" id="nuevaCategoria" name="nuevaCategoria" placeholder="Ingresar categoria" required>

        			</div>

        		</div>

        	</div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

        	<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

        	<button type="submit" class="btn btn-primary">Guardar categoria</button>

        </div>

        <?php

        $crearCategoria = new ControladorCategoria();
        $crearCategoria -> ctrCrearCategoria();

        ?>

      </form>

    </div>

  </div>

</div>




<!--=====================================
MODAL EDITAR USUARIO
======================================-->

<div id="modalEditarCategoria" class="modal fade" role="dialog">

	<div class="modal-dialog">

		<div class="modal-content">

			<form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

        	<button type="button" class="close" data-dismiss="modal">&times;</button>

        	<h4 class="modal-title">Editar Categoria</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

        	<div class="box-body">

        		<!-- ENTRADA PARA LA CAEGORIA -->

        		<div class="form-group">

        			<div class="input-group">

        				<span class="input-group-addon"><i class="fa fa-th"></i></span> 

        				<input type="text" class="form-control input-lg" id="editarCategoria" name="editarCategoria" placeholder="Ingresar categoria" required>

        				<input type="hidden" name="idCategoria" id="idCategoria" value="">	

        			</div>

        		</div>

        	</div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

        	<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

        	<button type="submit" class="btn btn-primary">Guardar categoria</button>

        </div>

        <?php

        $editarCategoria = new ControladorCategoria();
        $editarCategoria -> ctrEditarCategoria();

        ?>

      </form>

    </div>

  </div>

</div>


<?php

$eliminarCategoria = new ControladorCategoria();
$eliminarCategoria -> ctrEliminarCategoria();

?>








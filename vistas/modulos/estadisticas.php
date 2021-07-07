<div class="content-wrapper">



	<section class="content-header">



		<h1>



			Administrar gastos



		</h1>



		<ol class="breadcrumb">



			<li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>



			<li class="active">Administrar gastos</li>



		</ol>



	</section>



	<section class="content">



		<div class="box">



			<div class="box-header with-border">


			</div>



			<div class="box-body">

        <strong> Buscar por fechas:  </strong><br><br>

        <div class="input-daterange">

          <div class="col-md-4">

           <input type="text" name="start_date" id="start_date" class="form-control" placeholder="Fecha inicial" />

         </div>

         <div class="col-md-4">

           <input type="text" name="end_date" id="end_date" class="form-control" placeholder="Fecha final" />

         </div>  

       </div>

       <div class="col-md-4">

        <input type="button" name="search" id="search" value="Buscar" class="btn btn-info active" />

      </div><br><br><br>

        <?php


        $ventas = ControladorVenta::ctrMostrarTotalVenta(); 

        $gastosFijos = ControladorPlantilla::ctrMostrarTotalGastosFijos();

        $gastos = ControladorPresupuesto::ctrMostrarTotalGastos(); 
     



        ?>

        <div class="row">

          <div class="col-lg-12 col-xs-12">



            <!-- small box -->

            <div class="small-box bg-blue">



              <!-- inner -->

              <div class="inner text-center"><br>



                <h3 id="serviciosCobrados">€ <?=number_format($ventas['total'])?></h3>



                <p>Servicios cobrados</p>



              </div>

              <!-- inner -->



              <!-- icon -->

              <div class="icon">



                <i class="fa fa-money"></i>



              </div>

              <!-- icon -->



              <a href="administrar-servicios" class="small-box-footer">Más Info <i class="fa fa-arrow-circle-right"></i></a>



            </div>

            <!-- small-box -->



          </div>

        </div>



        <div class="row">

          <div class="col-lg-6 col-xs-12 text-center">



            <!-- small box -->

            <div class="small-box bg-green">



              <!-- inner -->

              <div class="inner">

                <br>

                <?php 

                $cobrados = $ventas['total'];
                $gastosT = $gastosFijos['total'] + $gastos['total'];

                ?>

                <h3 id="gananciasReal">€ <?=number_format($cobrados - $gastosT)?></h3>



                <p>Ganancia real</p>



              </div>

              <!-- inner -->



              <!-- icon -->

              <div class="icon">



                <i class="fa fa-money"></i>



              </div>

              <!-- icon -->



              <a href="#" class="small-box-footer">Más Info <i class="fa fa-arrow-circle-right"></i></a>



            </div>

            <!-- small-box -->



          </div>


          <div class="col-lg-6 col-xs-12 text-center">



            <!-- small box -->

            <div class="small-box bg-red">

              <b> Monto prestado inicial : € 500 </b>
              <!-- inner -->

              <div class="inner">



                <h3>€ <b id="gastosTotal"><?=$gastosFijos['total'] + $gastos['total']?></b></h3>



                <p>Total de gastos</p>



              </div>

              <!-- inner -->



              <!-- icon -->

              <div class="icon">



                <i class="fa fa-money"></i>



              </div>

              <!-- icon -->



              <a href="#" class="small-box-footer">Más Info <i class="fa fa-arrow-circle-right"></i></a>



            </div>

            <!-- small-box -->



          </div>


        </div>

        

    </div>



  </div>



</div>





</section>



</div>

























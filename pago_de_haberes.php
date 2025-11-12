<?php include 'head.php'; ?>
<?php include 'header.php'; ?>
<div class="container" id="tramites">
  <div class="where">
    <i class="fa fa-home"></i>
    <p>Inicio <i class="fa fa-angle-right"></i> Trámites <i class="fa fa-angle-right"></i> Pago de Haberes</p>
  </div>
  <div class="titulo-pag">
    <p>Pago de haberes</p>
  </div>
  <div class="row">		
    <div class="col-md-9 descripcion">
      <p style="text-align: justify;">
        Cuando fallece un afiliado pasivo, siempre que no hay derecho a pensión, los herederos directos, o aquella persona que haya realizado gastos en el último mes de vida del afiliado y pueda comprobarlo mediante factura, podrán solicitar que se les abone los haberes pendientes que no hayan sido depositados.
      </p>
            <div class="row">
      	<div class="col-12">
      		<div class="accordion" id="accordionExample">
              <div class="card">
                <div class="card-header" id="headingOne">
                  <h2 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                       Herederos
                    </button>
                  </h2>
                </div>
            
                <div id="collapseOne" class="collapse in show" aria-labelledby="headingOne" data-parent="#accordionExample" style="" aria-expanded="true">
                  <div class="card-body">
                    <div class="list-group">
                      
                      <a href="documentacion_1.php" class="list-group-item list-group-item-action">Documentación</a>
                      
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header" id="headingTwo">
                  <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      Solicitante con comprobante de gastos
                    </button>
                  </h2>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample" aria-expanded="false" style="">
                  <div class="card-body">
                    <div class="list-group">
                    	<a href="documentacion_2.php" class="list-group-item list-group-item-action">Documentación</a>
					</div>
                  </div>
                </div>
              </div>
             <!-- <div class="card">
                <div class="card-header" id="headingThree">
                  <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                      Asignacion Escolar
                    </button>
                  </h2>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                  <div class="card-body">
                    <div class="list-group">
				      <a href="asignacion_mensual_5.php" class="list-group-item list-group-item-action">Asignación por pre-escolaridad y escolaridad primaria (Pre-escolar - Nivel Inicial)</a>
					  <!--<a href="asignacion_mensual_4.php" class="list-group-item list-group-item-action">Asignación por escolaridad media y superior (Secundaria - Empa - Terciaria - Universitaria)</a>
                      <a href="asignacion_anual_1.php" class="list-group-item list-group-item-action">Ayuda Escolar</a>

                    </div>
                  </div>
                </div>
              </div>-->
            </div>
      	</div>
      </div>
    </div>
    <div class="col-md-3 side-tramites">
      <?php include_once 'side-tramites_jubilacion.html'; ?>
    </div>
  </div>
</div>
<?php include 'footer.php'; ?>

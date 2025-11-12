<?php include 'head.php'; ?>
<?php include 'header.php'; ?>
<div class="container" id="tramites">
  <div class="where">
    <i class="fa fa-home"></i>
    <p>Inicio <i class="fa fa-angle-right"></i> Trámites <i class="fa fa-angle-right"></i><a href="salario_familiar.html"> Asignacion Familiar</a><i class="fa fa-angle-right"></i> Asignacion de pago unico</p>
  </div>
  <div class="titulo-pag">
    <p style="font-size: 2.5rem;">Asignación única por nacimiento o adopción de hijo</p>
  </div>
  <div class="row">		
    <div class="col-md-9 descripcion">
      	<p style="text-align: justify;">Esta asignación consiste en el pago único de una suma equivalente a un mes de sueldo mínimo o inicial de la categoría en que revista el agente municipal.</p>
        <p style="text-align: justify;">Esta asignación será abonada a un solo conyuge en el caso en que los dos dependan de la administración comunal.</p>
        <!--<p style="text-align: justify;">La asignación se reconoce aún en la circunstancia de que el hijo naciera muerto, siempre que se produjera luego de transcurrido -como mínimo- 180 días de la concepción.</p>
        <p style="text-align: justify;">Por último, cuando el beneficiario ya posea dos hijos el nacimiento del tercero le otorgará la condición de familia numerosa. En tal cuyo caso el importe de la asignación se duplica.</p>-->
    </div>
    <div class="col-md-3 side-tramites">
      <?php include_once 'side-tramites_jubilacion.html'; ?>
    </div>
  </div>
</div>
<?php include 'footer.php'; ?>

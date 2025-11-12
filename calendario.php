<?php include 'head.php'; ?>
<?php include 'header.php';
include 'functions/connect.php';
global $con;
$res=mysqli_query($con, "SELECT *,MONTH(mes) mes FROM fechas ORDER BY mes DESC");
$row=mysqli_fetch_assoc($res);
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$emes=$row['mes'];

$fecha=explode('-', $row['fecha_pago']);
?>


    <!-- Page Content -->

<div class="container" id="tramites">
        <div class="where">
        <i class="fa fa-home"style= "letter-spacing: 2pt;"></i><p> Inicio <i class="fa fa-angle-right"></i> Servicios <i class="fa fa-angle-right"></i> Calendario de Pagos</p>
      </div>
      <div class="titulo-pag">
        <p>Calendario de Pagos</p>
      </div>
      <div class="row">
         	          <div class="col-md-9 descripcion">
                      <div class="calendario">
              <div class="header">Pago de<br />
              <?php echo $meses[$emes-1];?></div>
              &nbsp;
              <div class="dia"></div>
              <div class="dia_nro"><?php echo $fecha[2];?></div>
              <div class="mes text-uppercase"><?php echo $meses[$fecha[1]-1];?></div>
              <div class="anio"><?php echo $fecha[0]; ?></div>
              </div>
              <div class="aclaracion margin20">
              <p><?php echo $row['mensaje'];?></p>
              <p>&nbsp;</p>
              </div>
        </div>
        <div class="col-md-3 side-tramites">
          <h2>Otros servicios</h2>
          <hr>
          <p><a  href="http://servicioswww.anses.gov.ar/ConstanciadeCuil2/Inicio.aspx" target="_blank">Constancia de cuil</a></p>
          <!-- <p>Consulta de expedientes</p> -->
          <!-- <p>Carnet beneficiarioas</p> -->
          <!-- <p>Recibo de haberes</p> -->
          <img src="img/bn_atencion.png">
          <h2>Consultas</h2>
          <hr>
          <i class="fa fa-phone-square"></i><p> Comunicate al (0341) 4256085</p>
          <img src="img/hotel.jpg">
          <img src="img/sala.jpg">
        </div>
  </div>
</div>
<?php include 'footer.php'; ?>

<?php include 'functions/with-login.php'; ?>
<?php include 'head.php'; ?>
<?php include 'header.php'; ?>
<?php include 'functions/connect.php';?>
<body>	
	<div class="container" id="recibo-haberes">
		<div class="titulo-pag">
		    <p>Mis Datos</p>
	    </div>
	    <p></p>
		<?php
          		    $idpersona=$_SESSION['id'];
          		    if (($idpersona =='25959') || ($idpersona=='25960')) {
          		        switch ($idpersona){
          		            case '25959':
          		                $dir='recibo-sueldo/CENTRO';
          		                
          		            break;
          		            case '25960':
          		                $dir='recibo-sueldo/SINDICATO';
          		                
          		            break;
          		        }
          		        $recibos= preg_grep('/^([^.])/', scandir($dir));
          		        ?>
        				<ul class="list-group">
        				<?php
          		        foreach ($recibo AS $clave=>$valor){
          		            
        				 ?>
        					<li class="list-group-item">
                  <?php
              $filename = htmlentities(mb_convert_encoding($valor, 'UTF-8', 'Windows-1252'), ENT_QUOTES, 'UTF-8');
              $fileURL = str_replace("%d1", "%ntilde;", $valor);
            ?>
                      <a href="<?php echo $dir.'/'.rawurlencode($fileURL) ; ?>" target="_blank">
                        <?php echo $filename ; ?> <span class="carousel-control-next-icon"></span>
                      </a>
                    </li>                        
                            <?php 
          		        }
          		        ?>
          		        </ul>
        			<?php 		
                    }else{
          		        if ( $_SESSION['NOMBREUSUARIO']) {
          		            global $con;
          		            if ($_SESSION['empleado']=='1') {
          		                $usuario=$_SESSION['id'];
          		                $query="SELECT * FROM recibos WHERE codigo='$usuario' ORDER BY ano,mes DESC";
          		            }else{
          		                $usuario=$_SESSION['NOMBREUSUARIO'];
          		                $query="SELECT * FROM recibos WHERE codigo='$usuario' ORDER BY ano,mes DESC";
          		            }
          		            $recibos=mysqli_query($con, $query);
          		            ?>
        				<ul class="list-group">
        				<?php
        				if (mysqli_num_rows($recibos)>0) {
                            while ($row=mysqli_fetch_assoc($recibos)) { ?>
        					<li class="list-group-item">
        					<?php 
        					$filename2 = htmlentities(mb_convert_encoding($row['archivo'], 'UTF-8', 'ISO-8859-1'), ENT_QUOTES, 'UTF-8');
        					?>
        							<a href="<?php echo $filename2; ?>" target="_blank">
        								<?php 
        								echo $row['titulo'];
        								
        								 ?> <span class="carousel-control-next-icon"></span>
        							</a>
        						</li>                         
                            <?php }
                      	} else {
        					?>
        					<li class="list-group-item">No hay recibos</li>
        					<?php
        				}
        				?>
        				</ul>
        				<?php
        			     }
          		   }
        			
        		?>
	</div>
	<?php include 'footer.php'; ?>
</body>
</html>
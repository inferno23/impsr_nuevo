<?php include 'head.php'; ?>
<?php include 'header.php'; ?>
<div class="container" id="tramites">
  <div class="where">
    <i class="fa fa-home"style= "letter-spacing: 2pt;"></i>
    <p>Inicio <i class="fa fa-angle-right"></i> Trámites <i class="fa fa-angle-right"></i> Créditos Personales</p>
  </div>
  <div class="titulo-pag">
    <p>Créditos Personales</p>
  </div>
  <div class="row">		
    <div class="col-md-9 descripcion">
      <p style="text-align: justify;">
        El trámite se realiza para solicitar un prestamo personal.
      </p>
      			<ul class="nav nav-tabs" role="tablist">
							<li role="requisitos" class="nav-item active">
			    	<a href="#requisitos" class="nav-link active" aria-controls="requisitos" role="tab" data-toggle="tab">
			      		<span><img src="img/ico_requisitos.png" width="41" height="41" alt="Requisitos"></span>
			      		<span>Requisitos</span>
			      	</a>
			 	</li>
  			  									  			</ul>
  		<div class="tab-content">
  <!-- Requisitos -->
  <div role="tabpanel" class="tab-pane active" id="requisitos">
        <div class="grey tab-content__item">
      <div class="numero"><span>1</span></div>
      <p>Fotocopia &nbsp;<strong>certificada</strong> del recibo de sueldo del mes en curso.</p>
    </div>
        <div class="grey tab-content__item">
      <div class="numero"><span>2</span></div>
      <p>D.N.I original.</p>
    </div>
        <div class="grey tab-content__item">
      <div class="numero"><span>3</span></div>
      <p>Sucursal y número de caja de ahorro(Ej. Comprobante de caja de ahorro)</p>
    </div>
      </div>
  <!-- Documentacion -->
  <div role="tabpanel" class="tab-pane fade" id="documentacion">
    <div class="items">
          </div>
  </div>
  <!-- Formularios -->
  <div role="tabpanel" class="tab-pane fade" id="formularios">
    <ul class="lista-form">
          </ul>
  </div>
</div>
    </div>
    <div class="col-md-3 side-tramites">
      <img src="img/bn_atencion.png">
      <h2>Consultas</h2>
      <hr>
      <i class="fa fa-phone-square"></i><p>Comunicate al (0341) 5587023</p>
       
	   <!-- Muestra MODAL CALCULADORA -->
        <img src="img/btn_prestamos.png" data-toggle="modal" data-target="#calculadoraModal" style="cursor: pointer">




      <img src="img/hotel.jpg"> 
    </div>
  </div>
</div>

<!-- MODAL CALCULADORA PRESTAMOS ESTE SE USA PARA EL SIMULADOR-->

    <div class="modal fade" id="calculadoraModal" tabindex="-1" role="dialog" aria-labelledby="calculadoraModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#B6CFE6;">
                    <h5 class="modal-title" id="calculadoraModalLabel">Cálculo Cuota Créditos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="credi">

                        <script>
                            function calc_cuota(){
                                v_monto=document.credi.monto.value;
                                v_cuotas=document.credi.cant.value;
                                    //if v_cuotas == 24 {valor_cuota=((5.00*v_cuotas/100+1)*(v_monto))/(v_cuotas) + (v_monto / 100000 * 3.61);
                                    //}else{valor_cuota=((5.00*v_cuotas/100+1)*(v_monto))/(v_cuotas);
                                    //}
                                    dif_cuota = 0;
                                    valor_cuota=((3.50*v_cuotas/100+1)*(v_monto))/(v_cuotas)
                                    redon=valor_cuota-parseInt(valor_cuota);
                                    if (redon==0){decimal="0000";
                                    }else{decimal=String(redon);
                                    }
                                    val_cuota=parseInt(valor_cuota)+"."+decimal.substring(2,4);
                                    document.credi.importe.value=val_cuota;

                            }




                        </script>
                        <table border="2"><!--MODIFICAR EL WHILE-->
                            <tbody>
                            <tr>
                                <td colspan="2" style="background-color:#B6CFE6; text-align:center" ;font-weight:bold;"=""><strong>Cálculo Cuota Créditos</strong></td>
                            </tr>
                            <tr>
                                <td style="background-color:#7CAFD3" align="left"><strong>Monto</strong></td>
                                <td style="background-color:#7CAFD3" align="right">
                                    <script>
                                        document.write('<select name="monto" style="text-align:right;;font-weight:bold;">');
                                        m=100000;
                                        while(m<2010000){
                                            opt="<option value="+m+">"+m;
                                            document.write(opt);
                                            m=m+20000;
                                        }
                                        document.write('</select>');
                                    </script>

                                </td>
                            </tr>
                            <tr>
                                <td style="background-color:#7CAFD3;"><strong>Cuotas</strong></td>
                                <td style="background-color:#7CAFD3" align="right"><select name="cant" style="text-align:center;color:#663300;font-weight:bold;">
                                        <option value="4">04
                                        </option><option value="10">10
                                        </option><option value="12">12
                                        </option><option value="18">18
                                       <!-- </option><option value="24">24-->
                                        

                                        </option></select></td>
                            </tr>
                            <tr>
                                <td style="background-color:#7CAFD3;" align="left"><strong>Importe</strong></td>
                                <td style="background-color:#7CAFD3" align="right"><input type="text" name="importe" value="0" style="text-align:right;color:#005F1C;font-weight:bold;" size="10"></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="background-color:#B6CFE6;" align="center"><input type="button" value="Calcular" onclick="calc_cuota()"></td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
<!-- FIN MODAL CALCULADORA PRESTAMOS -->

<?php include 'footer.php'; ?>
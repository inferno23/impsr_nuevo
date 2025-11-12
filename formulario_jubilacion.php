<?php include 'head.php'; ?>
<?php include 'header.php'; ?>
<?php include 'functions/connect.php'; 
global $con;
  $query="SELECT * FROM `nacionalidad`";
  $res=$con->query($query);
   $query="SELECT * FROM `parentesco`";
  $result=$con->query($query);
  ?>

<style>
table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      border: 1px solid #ccc;
      padding: 8px;
      text-align: center;
    }

    th {
      background-color: #143c5e;
	  color: white;
    }
	th:first-child, td:first-child {
      width: 30%;
    }

	.bk-primary{
		background-color: #143c5e;
	}

    td:not(:first-child) {
      cursor: pointer;
    }

	#textarea-container {
      margin-top: 20px;
    }
	.border{
		border: 1px solid black;
		padding: 30px;
	}
  </style>

<body>	
	<div class="container" id="recibo-haberes">
		<div class="titulo-pag mb-3">
		    <p>Solicitud de Jubilación</p>
	    </div>
	    
        <form id="formDatos" role="form" class="form" method="post">
        	<div class="row mt-2">
          		<div class="col-12 col-sm-6 mb-2">
				  <label>TIPO</label>
              		<select class="form-check" name="tipo">
                      <option class="form-check-input" value="JUB. ORDINARIA" name="tipo">JUB. ORDINARIA
                      </option>

                      <option class="form-check-input" value="JUB. INVALIDEZ" name="tipo">
					            JUB. INVALIDEZ
					            </option>
                      <option class="form-check-input"  value="JUB. EDAD AVANZADA" name="tipo" >
					            JUB. EDAD AVANZADA
					            </option>
                      <option class="form-check-input" value="JUB. OPT RED PARA PERSONAS C/DISCAP" name="tipo" >
					            JUB. OPT RED PARA PERSONAS C/DISCAP
					            </option>

                      <option class="form-check-input"  value="JUB. OPT RED EXPRESOS POL." name="tipo">
					            JUB. OPT RED EXPRESOS POL.
					            </option>
                      <option class="form-check-input"  value="JUB.OPT RED EX COMBATIENTES" name="tipo" >
					            JUB.OPT RED EX COMBATIENTES
					            </option>
                      <option class="form-check-input"  value=" JUB. RESOL.363/81" name="tipo" >
					            JUB. RESOL.363/81
					            </option>

                      <option class="form-check-input"  value="JUB. ORD. CONV. INTER." name="tipo" >
					            JUB. ORD. CONV. INTER.
					            </option>
                    </select>
                </div>
                
                
          	</div>
          	<h2>Datos del beneficiario y/o solicitante.</h2>
          	<div class="row mt-2">
          		<div class="col-12 col-sm-6 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Nombre completo</span>
                  </div>
                  <input type="text" style="text-transform: uppercase;" class="form-control" name="nombre" required>
                </div>
                <div class="col-12 col-sm-6 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >DNI</span>
                  </div>
                  <input type="text" class="form-control" name="cuit" required>
                </div>
          	</div>
          	
          	<div class="row">
          		<div class="col-12 col-sm-4 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Fecha Nac.</span>
                  </div>
                  <input type="date" class="form-control" name="fnac" required>
                </div>
                <div class="col-12 col-sm-4 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Nacionalidad</span>
                  </div>
                  <select type="text" class="form-control" name="nacionalidad" id="nacionalidad" required><option >Seleccione..</option>';
                    <?php 
                    foreach ($res as $value) {
                      echo '
                    <option value="'.$value["DESCRIPCION"].'">'.$value["DESCRIPCION"].'</option>';
                  }?>
                  </select>
                </div>
                <div class="col-12 col-sm-4 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Estado Civil</span>
                  </div>
                  <select class="custom-select"  name="estadocivil" >
                  	<option value="CASADO/A">CASADO/A</option>
                  	<option value="SOLTERO/A">SOLTERO/A</option>
                  	<option value="DIVORCIADO/A">DIVORCIADO/A</option>
                  	<option value="VIUDO/A">VIUDO/A</option>
                  	<option value="SEPARADO/A DE HECHO">SEPARADO/A DE HECHO</option>
                  </select>
                </div>
          	</div>
          	<div class="row">
          		<div class="col-12 col-sm-5 mb-2">    
                    <div class="input-group">
                    	<div class="input-group-prepend">
                    		<div class="input-group-text">
                      			<input type="checkbox" name="reside" checked value="SI">
                    		</div>
                  		</div>
                      	<div class="input-group-append">
                        	<span class="input-group-text" >Reside en el país</span>
                      	</div>
                    </div>
                </div>
            </div>
               <div class="row mt-2">
             <div class="col-12 col-sm-5 input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" >Provincia</span>
                  </div>
                  <select type="text" class="form-control" name="provincia" id="provincia" required></select>
                </div>
                <div class="col-8 col-sm-5 input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" >Localidad</span>
                  </div>
                  <select type="text" class="form-control"  name="localidad" id="localidad" required></select>
                </div>
             
                    <div class="col-4 col-sm-2 input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" >C.P.</span>
                  </div>
                  <select type="text" class="form-control"  name="cp" id="cp" required></select>
                </div>
            </div>
            <div class="row">
                <div class="col-7 col-sm-5 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Calle</span>
                  </div>
                  <input type="text" style="text-transform: uppercase;" class="form-control"  name="calle">
                </div>
                <div class="col-5 col-sm-3 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Altura</span>
                  </div>
                  <input type="text" style="text-transform: uppercase;" class="form-control"  name="altura" >
                </div>
                <div class="col-6 col-sm-2 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Piso</span>
                  </div>
                  <input type="text" style="text-transform: uppercase;" class="form-control" name="piso" >
                </div>
                <div class="col-6 col-sm-2 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Dpto</span>
                  </div>
                  <input type="text" style="text-transform: uppercase;" class="form-control" name="dpto" >
                </div>
          	</div>

            <div class="row mt-2">

                <div class="col-6 col-sm-6 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Celular</span>
                  </div>
                  <input type="text" class="form-control"  name="celular" required>
                </div>
                <div class="col-12 col-sm-6 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >E-mail</span>
                  </div>
                  <input type="email" class="form-control"  name="email" required>
                </div>
                
          	</div>
          	
            
            <h2>Datos del cónyuge o conviviente</h2>
            <div class="row mt-2">
          		<div class="col-12 col-sm-7 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Nombre completo</span>
                  </div>
                  <input type="text" class="form-control" style="text-transform: uppercase;" name="conyugenombre" >
                </div>
                <div class="col-12 col-sm-5 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >DNI</span>
                  </div>
                  <input type="text" class="form-control" name="conyugedni">
                </div>
            </div>
          	<div class="row">
          		<div class="col-12 col-sm-4 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Nacionalidad</span>
                  </div>
                  <select type="text" class="form-control" name="conyugenacionalidad"><option >Seleccione..</option>';
                    <?php 
                    foreach ($res as $value) {
                      echo '
                    <option value="'.$value["DESCRIPCION"].'">'.$value["DESCRIPCION"].'</option>';
                  }?>
                  </select>
                </div>
                <div class="col-12 col-sm-3 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Fecha Nac.</span>
                  </div>
                  <input type="date" class="form-control" name="conyugefnac">
                </div>
                
				<div class="col-12 col-sm-4 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Estado Civil</span>
                  </div>
                  <select  name="conyugeestadocivil">
                  <option value="" selected>Seleccione</option>
                  	<option value="CASADO/A">CASADO/A</option>
                  	<option value="SOLTERO/A">SOLTERO/A</option>
                  	<option value="DIVORCIADO/A">DIVORCIADO/A</option>
                  	<option value="VIUDO/A">VIUDO/A</option>
                  	<option value="SEPARADO/A DE HECHO">SEPARADO/A DE HECHO</option>
                  </select>
                </div>
          	</div>

			<div class="row">
				<div class="col-12 col-sm-3 input-group mb-2">				
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Fecha Mat.</span>
                  </div>
                  <input type="date" class="form-control" name="conyugemat" value="">
                </div>

				<div class="col-12 col-sm-3 mb-2">    
          			<label>¿Conviven?</label>
          			<div class="btn-group btn-group-toggle" data-toggle="buttons">
                    	<label class="btn btn-primary">
                        	<input type="radio" name="conyugeconvive" value="1" > SI
                        </label>
                        <label class="btn btn-primary  active">
                        	<input type="radio" name="conyugeconvive" value="0" checked> NO
                        </label>
                  	</div>
                </div>

				<div class="col-12 col-sm-4 input-group mb-2">				
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Fecha de convivencia</span>
                  </div>
                  <input type="date" class="form-control" name="conyugeconvivencia" value="">
                </div>
			</div>

			<div class="row">
				<div class="col-12 col-sm-5 mb-2">    
          			<label>En caso de convivencia,eliga cob. seg. mutual</label>
          			<div class="btn-group btn-group-toggle" data-toggle="buttons">
                    	<label class="btn btn-primary">
                        	<input type="radio" name="conyugecobertura" value="SI" > SI
                        </label>
                        <label class="btn btn-primary  active">
                        	<input type="radio" name="conyugecobertura" value="NO" checked> NO
                        </label>
                  	</div>
                	
                </div>
             </div>

			<div class="row">   
				<div class="col-4 col-sm-4 mb-2">    
          			<label>¿Tiene algún beneficio previsional?</label>
          			<div class="btn-group btn-group-toggle" data-toggle="buttons">
                    	<label class="btn btn-primary">
                        	<input type="radio" name="conyugeprevisional" value="SI" > SI
                        </label>
                        <label class="btn btn-primary  active">
                        	<input type="radio" name="conyugeprevisional" value="NO" checked> NO
                        </label>
                  	</div>
                	
                </div>
			
          		<div class="col-4 col-sm-2 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Tipo</span>
                  </div>
                  <select class="custom-select"  name="conyugetipo">
                  	<option value="" selected >Seleccione</option>
                  	<option value="JUBILACION">JUBILACIÓN</option>
                  	<option value="PENSION">PENSIÓN</option>
                  </select>	
                </div>
                <div class="col-8 col-sm-5 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Caja o Instituto</span>
                  </div>
                  <input type="text" class="form-control" style="text-transform: uppercase;" name="conyugecaja">
                </div>
            </div>

			<div class="row">    
                <div class="col-12 col-sm-5 mb-2">    
          			<label>¿Trabaja?</label>
          			<div class="btn-group btn-group-toggle" data-toggle="buttons">
                    	<label class="btn btn-primary">
                        	<input type="radio" name="conyugetrabaja" value="SI" > SI
                        </label>
                        <label class="btn btn-primary  active">
                        	<input type="radio" name="conyugetrabaja" value="NO" checked> NO
                        </label>
                  	</div>
                	
                </div>
            
				<div class="col-8 col-sm-5 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Nombre de empresa</span>
                  </div>
                  <input type="text" class="form-control" style="text-transform: uppercase;" name="conyugeempleador">
                </div>
			</div>

			<div class="row">
				<div class="col-4 mb-2">    
          			<label>¿Percibe asignación familiar?</label>
          			<div class="btn-group btn-group-toggle" data-toggle="buttons">
                    	<label class="btn btn-primary">
                        	<input type="radio" name="conyugeasignacion" value="SI" > SI
                        </label>
                        <label class="btn btn-primary  active">
                        	<input type="radio" name="conyugeasignacion" value="NO" checked> NO
                        </label>
                  	</div>
                	
                </div>
			</div>

			<div class="col-12 col-sm-5 mb-2">    
          		<h6>¿Por quién?</h6>
            </div>

			<div class="row">
				<div class="col-12 col-sm-5 mb-2">    
          			<label>Hijos</label>
          			<div class="btn-group btn-group-toggle" data-toggle="buttons">
                    	<label class="btn btn-primary">
                        	<input type="radio" name="conyugehijos" value="SI" > SI
                        </label>
                        <label class="btn btn-primary  active">
                        	<input type="radio" name="conyugehijos" value="NO" checked> NO
                        </label>
                  	</div>
                	
                </div>
				<div class="col-12 col-sm-5 mb-2">    
          			<label>Cónyuge</label>
          			<div class="btn-group btn-group-toggle" data-toggle="buttons">
                    	<label class="btn btn-primary">
                        	<input type="radio" name="conyugeahijos" value="SI" > SI
                        </label>
                        <label class="btn btn-primary  active">
                        	<input type="radio" name="conyugeahijos" value="NO" checked> NO
                        </label>
                  	</div>
                	
                </div>
			</div>
          	
          	
			<hr>
			<h2>Datos de otros familiares con derecho a pensión</h2>
			<div class="col-12 mt-2">
				<p>Los hijos menores de 18 años, los hijos menores de 25 años si estudian, hijos incapacitados sin límites de edad.</p>
			</div>

			  <div class="container mt-2">
    			  <table id="tablaDatos">
    			  	<thead>
        				<tr>
            				<th>Apellido y nombre</th>
            				<th>Parentesco</th>
            				<th>Fecha de nacimiento</th>
            				<th>Estado civil</th>
            				<th>Incapacitado SI-NO</th>
            				<th>DNI</th>
            				<th colspan="2" class="subheader">Escolaridad</th>
            				<th colspan="3" class="subheader">Tiene beneficio previsional</th>
                    <th>Solicita Asignacion Familiar SI-NO</th>
        				</tr>
    			
    				<tr>
    				<td class="bk-primary" style="text-transform: uppercase;"></td>
    				<td class="bk-primary" style="text-transform: uppercase;"></td>
    				<td class="bk-primary" style="text-transform: uppercase;"></td>
    				<td class="bk-primary" style="text-transform: uppercase;"></td>
    				<td class="bk-primary" style="text-transform: uppercase;"></td>
    				<td class="bk-primary" style="text-transform: uppercase;"></td>
    				<th class="subcolumn-header" style="text-transform: uppercase;">Tipo</th>
    				<th class="subcolumn-header" style="text-transform: uppercase;">Const</th>
    				<th class="subcolumn-header" style="text-transform: uppercase;">SI-NO</th>
    				<th class="subcolumn-header" style="text-transform: uppercase;">Tipo</th>
    				<th class="subcolumn-header" style="text-transform: uppercase;">Caja o Inst</th>
            <td class="bk-primary"></td>
    				</tr>
              </thead>
            <tbody>
    				<tr>
    				<td contenteditable="true" style="text-transform: uppercase;"></td>
    				<td contenteditable="true" style="text-transform: uppercase;"><select><option value=""></option>
                    <?php 
                    foreach ($result as $value) {
                      echo '
                    <option value="">'.$value["relacion"].'</option>';
                  }?></select></td>
    				<td contenteditable="true"></td>
    				<td contenteditable="true"><select>
                    <option value=""></option>
                    <option value="">CASADO/A</option>
                    <option value="">SOLTERO/A</option>
                    <option value="">DIVORCIADO/A</option>
                    <option value="">VIUDO/A</option>
                    <option value="">SEPARADO/A DE HECHO</option>
                  </select></td>
    				<td contenteditable="true"></td>
    				<td contenteditable="true"></td>
    				<td class="subcolumn" contenteditable="true"></td>
    				<td class="subcolumn" contenteditable="true"></td>
    				<td class="subcolumn" contenteditable="true"></td>
    				<td class="subcolumn" contenteditable="true"></td>
    				<td class="subcolumn" contenteditable="true"></td>
            <td contenteditable="true"></td>
    				</tr>
    			

    				</tbody>
    			</table>

				<div id="textarea-container" class="d-flex" style="flex-direction: column;">
					<label for="additional-content">Observaciones:</label>
					<textarea id="additional-content" class="form-control" name="observacionesdatos"></textarea>
				</div>
			</div>
			<hr>
            <h4>Manifestación para asignación familiar</h4>
			<div class="row">
				<div class="col-12 col-sm-5 mb-2">    
					<label>Manifiesto en carácter de declaración jurada que mi hijo menor de 21 años que estudia o incapacitado no percibe beneficio previsional, ni realiza tareas remuneradas, es soltero y el otro progenitor no percibe asignación por el mismo.-</label>
					<div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <input type="checkbox" name="manifiesto" value="1" >
                        </div>
                        <div class="input-group-append">
                        	<span class="input-group-text">Acepto</span>
                        </div>
                      </div>
                    </div>
          		</div>
			</div>
			<!-- 
			<div class="row">
				<div class="col-6 col-sm-5 mb-2">    
					<div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <input type="checkbox" name="descuentosindicato" value="1" >
                        </div>
                        <div class="input-group-append">
                        	<span class="input-group-text">Descuento Sindicato</span>
                        </div>
                      </div>
                    </div>
          		</div>
          		<div class="col-6 col-sm-5 mb-2">    
					<div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <input type="checkbox" name="descuentocentro" value="1" >
                        </div>
                        <div class="input-group-append">
                        	<span class="input-group-text">Descuento Centro de jubilados</span>
                        </div>
                      </div>
                    </div>
          		</div>
			</div>
			 -->
			<hr>
            <h2>Servicios</h2>

			<div class="col-12 mt-3">
					<h6>DETALLE CRONOLÓGICO DE LOS SERVICIOS PRESENTADOS POR EL AFILIADO DESDE LOS 18 AÑOS</h6>
				</div>

				<div class="container mt-3">
				<table id="tablaDetalle">
					<thead><tr>
					<th>Nombre de la empresa, institución, <br> empleador y/o act. por cuenta propia</th>
					<th>Tarea o Cargo</th>
					<th>Desde</th>
					<th>Hasta</th>
					</tr>
					</tbody>
					<tbody>
					<tr>
					<td contenteditable="true"></td>
					<td contenteditable="true"></td>
					<td contenteditable="true"></td>
					<td contenteditable="true"></td>
					</tr>
					
					</tbody>
				</table>
				</div>	

				<div class="row">
					<div class="col-12 mb-2 mt-3">    
    					<p class="mb-0 mr-2 mt-1">¿Tiene otro beneficio?</p>
              			<div class="btn-group btn-group-toggle" data-toggle="buttons">
                        	<label class="btn btn-primary">
                            	<input type="radio" name="otrobeneficio" value="SI" > SI
                            </label>
                            <label class="btn btn-primary  active">
                            	<input type="radio" name="otrobeneficio" value="NO" checked> NO
                            </label>
                      	</div>
                    </div>
                </div>
                <div class="row">    
					<div class="col-4 input-group mb-2">
    					<div class="input-group-prepend">
    						<span class="input-group-text" >Tipo</span>
    					</div>
    					<input type="text" style="text-transform: uppercase;" class="form-control"  name="otrotipo">
    				</div>
    				<div class="col-4 input-group mb-2">
    					<div class="input-group-prepend">
    						<span class="input-group-text" >Caja o instituto</span>
    					</div>
    					<input type="text" style="text-transform: uppercase;" class="form-control"  name="otroinstituto" >
    				</div>
    				<div class="col-4 input-group mb-2">
    					<div class="input-group-prepend">
    						<span class="input-group-text">Nro Beneficio</span>
    					</div>
    					<input type="text" class="form-control"  name="otronro" >
    				</div>
				</div>

				<div class="row">
					<div class="col-12 mb-2 mt-2">    
					<p class="mb-0 mr-2 mt-1">¿Trabaja actualmente en otra actividad?</p>
          			<div class="btn-group btn-group-toggle" data-toggle="buttons">
                    	<label class="btn btn-primary">
                        	<input type="radio" name="trabajaactual" value="SI" > SI
                        </label>
                        <label class="btn btn-primary  active">
                        	<input type="radio" name="trabajaactual" value="NO" checked> NO
                        </label>
                  	</div>
                    </div>
    			</div>
				<div class="row">
					<div class="col-12 col-sm-5 mb-2 mt-2">    
    					<p class="mb-0 mr-2 mt-1">Pública</p> 
              			<div class="btn-group btn-group-toggle" data-toggle="buttons">
                        	<label class="btn btn-primary">
                            	<input type="radio" name="publica" value="SI" > SI
                            </label>
                            <label class="btn btn-primary  active">
                            	<input type="radio" name="publica" value="NO" checked> NO
                            </label>
                      	</div>
                    </div>
				
				<div class="d-flex col-12 mb-2" style="padding: 0;">   
					<div class="row col-12 col-sm-5 mb-2 mt-2">
					<p class="mb-0 mr-2 mt-1">Privada</p>
          			<div class="btn-group btn-group-toggle" data-toggle="buttons">
                    	<label class="btn btn-primary">
                        	<input type="radio" name="privado" value="SI" > SI
                        </label>
                        <label class="btn btn-primary  active">
                        	<input type="radio" name="privado" value="NO" checked> NO
                        </label>
                  	</div>
					</div> 
					
					<div class="row col-12 col-sm-5 mb-2 mt-2">
					<p class="mb-0 mr-2 mt-1">Continuará</p>
          			<div class="btn-group btn-group-toggle" data-toggle="buttons">
                    	<label class="btn btn-primary">
                        	<input type="radio" name="continuara" value="SI" > SI
                        </label>
                        <label class="btn btn-primary  active">
                        	<input type="radio" name="continuara" value="NO" checked> NO
                        </label>
                  	</div>
					</div>
					
                </div>

				<div class="d-flex col-12 mb-2" style="padding: 0;">   
					<div class="row col-12 col-sm-5 mb-2 mt-2">
					<p class="mb-0 mr-2 mt-1">Autónomo</p>
          			<div class="btn-group btn-group-toggle" data-toggle="buttons">
                    	<label class="btn btn-primary">
                        	<input type="radio" name="autonomo" value="SI" > SI
                        </label>
                        <label class="btn btn-primary  active">
                        	<input type="radio" name="autonomo" value="NO" checked> NO
                        </label>
                  	</div>
					</div> 
					
					<div class="row col-12 col-sm-5 mb-2 mt-2">
					<p class="mb-0 mr-2 mt-1">Continuará</p>
          			<div class="btn-group btn-group-toggle" data-toggle="buttons">
                    	<label class="btn btn-primary">
                        	<input type="radio" name="continuaraautonomo" value="SI" > SI
                        </label>
                        <label class="btn btn-primary  active">
                        	<input type="radio" name="continuaraautonomo" value="NO" checked> NO
                        </label>
                  	</div>
					</div>
					
                </div>

				<hr>
            	<h2>Reconocimiento de servicios</h2>

				<div class="container mt-5">
					<table id="tablaServicios">
						<thead>
						<tr>
						<th>Caja o instituto</th>
						<th>N° de expediente</th>
						</tr>
						</thead>
						<tbody>
						<tr>
						<td contenteditable="true"></td>
						<td contenteditable="true"></td>
						</tr>
						</tbody>
					</table>
            <div id="textarea-container" class="d-flex" style="flex-direction: column;">
          <label for="additional-content">Observaciones:</label>
          <textarea id="additional-content" class="form-control" name="otroobs"></textarea>
        </div>
					</div>

					<div class="row col-12 col-sm-5 mb-2 mt-2">    
								<div class="btn-group btn-group-toggle" data-toggle="buttons">
						
								<input type="hidden" name="simultaneo" value="SI" > 
							
							
								<input type="hidden" name="simultaneo" value="NO" checked> 
							
						</div>
					</div>

					
      	<div class="row mb-2">
          		<div class="col-12 col-sm-12" style="margin-top: 30px;margin-left: -400px;">
          			<button type="submit" class="btn btn-primary">Guardar</button>
          		</div>
          		<div class="col-12">
          			<div id="mensaje"></div>
          		</div>
        </div>
          	</form>
		</div>
	</div>
	<?php include 'footer.php'; ?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.1/jspdf.plugin.autotable.js" integrity="sha512-oTV4NrGNoEpaF91/0i6IMXJYFfXhd6vXY9YQxEj/kPA2ra6p6ZykYfnfbvHGnGN4maXZCvhDJ3PerIFvMptckw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script>
      // Function to add a new row
       $(document).ready(function() {
    // Cuando cambie el primer select
    $('#nacionalidad').on('change', function() {
        var selectedValue = $(this).val();
        
        // Llamada AJAX para obtener datos del segundo select
        $.ajax({
            url: 'functions/save-nacionalidad.php',
            type: 'POST',
            data: {selectedValue: selectedValue},
            success: function(data) {
                $('#provincia').html(data);
            }
        });
    });

    $('#provincia').on('change', function() {
        var selectedValue = $(this).val();
        
        // Llamada AJAX para obtener datos del tercer select
        $.ajax({
            url: 'functions/save-provincia.php',
            type: 'POST',
            data: {selectedValue: selectedValue},
            success: function(data) {
                $('#localidad').html(data);
            }
        });
    });

    // Cuando cambie el tercer select
    $('#localidad').on('change', function() {
        var selectedValue = $(this).val();
        
        // Llamada AJAX para obtener el dato correspondiente
        $.ajax({
            url: 'functions/save-localidad.php',
            type: 'POST',
            data: {selectedValue: selectedValue},
            success: function(data) {
                $('#cp').html(data);
            }
        });
    });
  });
    // Function to add a new row
      function addRow() {
        let newRow = `<tr>
          <td contenteditable="true"></td>
          <td contenteditable="true"></td>
          <td contenteditable="true"></td>
          <td contenteditable="true"></td>
        </tr>`;
        $('#tablaDetalle tbody').append(newRow);
      }

      // Add initial rows
      for (let i = 0; i < 5; i++) {
        addRow();
      }

    // Event listener to detect typing in the last row
$('#tablaDetalle tbody').on('input', 'tr:last-child td', function() {
  // Check if all cells in the last row are filled
  let allFilled = true;
  $(this).closest('tr').find('td').each(function() {
    if ($(this).text().trim() === '') {
      allFilled = false;
      return false; // Exit each loop
    }
  });

  if (allFilled) {
    addRow();
  }
});
    // Function to add a new row
  function addRow1() {
        let newRow = `<tr>
            <td contenteditable="true"></td>
            <td contenteditable="true"><select><option ></option>';
                    <?php 
                    foreach ($result as $value) {
                      echo '
                    <option value="'.$value["relacion"].'">'.$value["relacion"].'</option>';
                  }?></select></td>
            <td contenteditable="true"></td>
            <td contenteditable="true">
            <select>
                  <option value=""></option>
                    <option value="Casado/a">Casado/a</option>
                    <option value="Soltero/a">Soltero/a</option>
                    <option value="Divorciado/a">Divorciado/a</option>
                    <option value="Viudo/a">Viudo/a</option>
                    <option value="Separado/a">Separado/a de hecho</option>
            </select></td>
            <td contenteditable="true"></td>
            <td contenteditable="true"></td>
            <td class="subcolumn" contenteditable="true"></td>
            <td class="subcolumn" contenteditable="true"></td>
            <td class="subcolumn" contenteditable="true"></td>
            <td class="subcolumn" contenteditable="true"></td>
            <td class="subcolumn" contenteditable="true"></td>
            <td contenteditable="true"></td>
        </tr>`;
        $('#tablaDatos tbody').append(newRow);
      }

      // Add initial rows
      for (let i = 0; i < 5; i++) {
        addRow1();
      }

    // Event listener to detect typing in the last row
$('#tablaDatos tbody').on('input', 'tr:last-child td', function() {
  // Check if all cells in the last row are filled
  let allFilled = true;
  $(this).closest('tr').find('td').each(function() {
    if ($(this).text().trim() === '') {
      allFilled = false;
      return false; // Exit each loop
    }
  });

  if (allFilled) {
    addRow1();
  }
});
    // Function to add a new row
  function addRow2() {
        let newRow = `<tr>
            <td contenteditable="true"></td>
            <td contenteditable="true"></td>
          </tr>
          `;
        $('#tablaServicios tbody').append(newRow);
      }

      // Add initial rows
      for (let i = 0; i < 5; i++) {
        addRow2();
      }

    // Event listener to detect typing in the last row
$('#tablaServicios tbody').on('input', 'tr:last-child td', function() {
  // Check if all cells in the last row are filled
  let allFilled = true;
  $(this).closest('tr').find('td').each(function() {
    if ($(this).text().trim() === '') {
      allFilled = false;
      return false; // Exit each loop
    }
  });

  if (allFilled) {
    addRow2();
  }
});


	window.jsPDF = window.jspdf.jsPDF
	const form=document.getElementById('formDatos');
	form.addEventListener('submit',guardarForm);
	const mensaje=document.getElementById('mensaje');
	//descargaPDF2();
	function verBeneficio(e){
		var valor=e.value;
		if(valor==1){
			document.getElementById('tipoBene').classList.remove('d-none');
		}else{
			document.getElementById('tipoBene').classList.add('d-none');
		}
	}
	function verTramite(e){
		var valor=e.value;
		if(valor==1){
			document.getElementById('tipoTrami').classList.remove('d-none');
		}else{
			document.getElementById('tipoTrami').classList.add('d-none');
		}
	}
	
	function guardarForm(e){
		if (confirm("¿Desea guardar el formulario?") == true) {
		e.preventDefault();
		data = new FormData(form);
		var xhr = new XMLHttpRequest();
		xhr.responseType = 'json';
		xhr.open("POST", "functions/save-form3.php", true);
		xhr.onload = function(e) {
		    if (this.status == 200) {
				
				var json=this.response;
				//mensaje.innerHTML=json.msg;
		        if(json.success){
					
		        	descargaPDF2(json.datos);
		        }else{
		        	console.log(json.query);
		        	console.log(json.error);
			   	}
		    }
		};
		xhr.send(data);
		}else{
			return false;
		}
	}
	

	function descargaPDF2(datos){
		let date = new Date()
		let day = ("0" + date.getDate()).slice(-2);
		let month = ("0" + (date.getMonth() + 1)).slice(-2);
		let year = date.getFullYear();
		var fecha=day+'/'+month+'/'+year;
		var doc = new jsPDF('p', 'pt', 'letter');  
		var htmlstring = '';  
		var tempVarToCheckPageHeight = 0;  
		console.log(doc.getFont());
		console.log(doc.getFontList());
		var pageHeight = 0;  
			pageHeight = doc.internal.pageSize.height;  
			specialElementHandlers = {  
				'#bypassme': function(element, renderer) {  
			    	return false 
			    }  
			};  
			margins = {  
				top: 150,  
			    bottom: 60,  
			    left: 40,  
			    right: 40,  
			    width: 600  
			};  
			var y = 125;  
			var img = new Image();
			var x=40;
			var y=40;
			var l=30;
			var c=10;
			var m=20; 
			img.src = 'logo_impsr.png';
      doc.setDrawColor(157, 158, 160);
			doc.addImage(img, 'png', 60 , y+4, 160,90 );
			doc.setLineWidth(1);
		  //doc.roundedRect(x,y,533,700,5,5); //cuadro principal
      doc.line(240,y,573,y);
			doc.line(240,y,240,200); //primer linea v
      doc.line(573,y,573,200); //segunda linea v
      doc.line(x,y+93,x,200); //segunda linea v
			doc.setFontSize(14);
			//doc.line(380,y,380,200); // segunda linea v
			doc.setFont('Helvetica','bold');
			doc.text(320,y+60,'Solicitud de Jubilacion');
			//doc.text(360,y+60,'de');
			//doc.text(375,y+60,'Jubilación');
			doc.setFont('Helvetica','normal');

			doc.line(40,y+93.75,533+40,y+93.75);

			doc.setFontSize(11);
			
       doc.setFontSize(10);
        doc.setFont('Helvetica','bold');
       doc.text(330,y+125,datos.tipo);
			doc.setFontSize(14);
		
			doc.text(290,y+125,'Tipo :');
			doc.setFont('Helvetica','normal');
			doc.setFontSize(10);
			doc.setFontSize(12);
			doc.setFontSize(10);
			doc.line(40,y+160,573,y+160);
			doc.text(45,y+120,'Todos los datos consignados en este');
			doc.text(45,y+135,'formulario revisten carácter de');
			doc.text(45,y+150,'declaración jurada');
			doc.setFontSize(12);	

			var yy=200;
			doc.line(40,yy,573,yy);

			var nombre=datos.nombre;
			doc.setFont('Helvetica', 'normal');
      doc.text(165,yy+15,'Apellido y Nombre Completo del/la solicitante : ');
      doc.setFont('Helvetica', 'bold');
      doc.text(270,yy+35,''+nombre);
      doc.setFont('Helvetica', 'normal'); 
            doc.line(40,yy,40,yy+22); //linea 3
            doc.line(573,yy,573,yy+22); //linea 3
      doc.line(40,yy+22,573,yy+22);
      yy = 212;
			doc.line(40,yy+30,573,yy+30); //linea 3
            doc.line(40,yy+30,40,yy+50); //linea 3
            doc.line(573,yy+30,573,yy+50); //linea 3
			yy=yy+45;//155
			doc.text(45,yy,'Fecha Nac ');
			doc.text(178,yy,'Nacionalidad ');
			doc.text(311,yy,'DNI / CUIL ');
			doc.text(445,yy,'Estado civil ');
      doc.setFont('Helvetica','bold');
			doc.text(45,yy+20,datos.fnac);
			doc.text(178,yy+20,datos.nac);
			doc.text(311,yy+20,datos.doc);
			doc.text(445,yy+20,datos.estado);
      doc.setFont('Helvetica','normal');


			doc.line(173,yy-15,173,yy+5); //primer linea v
			doc.line(306,yy-15,306,yy+5); //primer linea v
			doc.line(440,yy-15,440,yy+5); //primer linea v
			doc.line(40,yy+5,573,yy+5); //linea 4
			doc.line(40,yy+25,573,yy+25); //linea 5
			
			
			doc.text(165,yy+40,'Domicilio Particular ');
			
			doc.text(411,yy+40,'Reside en el país :'+datos.reside);
			doc.line(406,yy+25,406,yy+45); //primer linea v

	
      doc.setFont('Helvetica','bold');
			doc.text(45,yy+60,datos.calle);
			doc.text(178,yy+60,datos.altura);
			doc.text(311,yy+60,datos.piso);
			doc.text(445,yy+60,datos.dpto);
      doc.setFont('Helvetica','normal');
             doc.line(40,yy+45,40,yy+25); //primer l
             doc.line(573,yy+45,573,yy+25); //primer l6
			doc.line(40,yy+45,573,yy+45); //linea 7
      yy=230;
			doc.line(40,yy+95,573,yy+95); //linea 8
             doc.line(40,yy+115,40,yy+95); //primer l
             doc.line(573,yy+115,573,yy+95); //primer li
			doc.line(40,yy+115,573,yy+115); //linea 7
			doc.line(40,yy+140,573,yy+140); //linea 8
			doc.line(235,yy+95,235,yy+115); //primer linea v
			doc.line(440,yy+95,440,yy+115); //primer linea v
			doc.text(45,yy+110,'Localidad');
			doc.text(240,yy+110,'Provincia');
			doc.text(445,yy+110,'CP');
      doc.setFont('Helvetica','bold');
			doc.text(45,yy+135,datos.localidad);
			doc.text(240,yy+135,datos.provincia);
			doc.text(445,yy+135,datos.cp);
      doc.setFont('Helvetica','normal');
			doc.line(40,yy+160,573,yy+160); //linea 9
      doc.setLineWidth(5);
			doc.line(40,yy+190,573,yy+190); //linea 10
		
    doc.setLineWidth(1);
			      doc.line(300,yy+140,300,yy+160); //primer linea v
      
             doc.line(40,yy+140,40,yy+160); //primer l
             doc.line(573,yy+140,573,yy+160); //primer li
			//doc.text(45,yy+155,'Teléfono');
			doc.text(45,yy+155,'Celular');
			doc.text(400,yy+155,'Correo electronico');
      doc.setFont('Helvetica','bold');
			//doc.text(45,yy+180,datos.telefono);
			doc.text(50,yy+180,datos.celular);
			doc.text(305,yy+180,datos.email);
      doc.setFont('Helvetica','normal');

		
			doc.setLineWidth(1);
			var yy=415;
      var m=20;
		

        var conyuge=datos.conyuge;
        doc.setDrawColor(157, 158, 160);
      doc.setFont('Helvetica', 'bold');
      doc.text(50,yy+m+3,'Datos del cónyuge o conviviente  ');
      doc.setFont('Helvetica', 'bold');
      doc.text(244,yy+m,''+conyuge);
      doc.setFont('Helvetica', 'normal');
		
			doc.line(40,yy+30,573,yy+30); //linea 3
			yy=yy+45;//155
			doc.text(45,yy,'Fecha Nac ');
			doc.text(178,yy,'Nacionalidad ');
			doc.text(311,yy,'DNI / CUIL ');
			doc.text(445,yy,'Estado civil ');
      doc.setFont('Helvetica','bold');
			doc.text(45,yy+25,datos.conyugefnac);
			doc.text(178,yy+25,datos.conyugenacionalidad);
			doc.text(311,yy+25,datos.conyugedni);
			doc.text(445,yy+25,datos.conyugeestado);
      doc.setFont('Helvetica','normal');
             doc.line(40,yy-15,40,yy+5); //primer linea v
             doc.line(573,yy-15,573,yy+5); //primer linea v
			doc.line(173,yy-15,173,yy+5); //primer linea v
			doc.line(306,yy-15,306,yy+5); //primer linea v
      doc.line(440,yy-15,440,yy+5); //primer linea v
                              doc.line(173,yy+30,173,yy+80); //primer 3linea v
                              doc.line(306,yy+30,306,yy+80); //primer 3linea v
                              doc.line(440,yy+30,440,yy+80); //primer linea v
			       doc.line(40,yy+30,40,yy+80); //primer linea v
             doc.line(573,yy+30,573,yy+80); //primer linea v
			doc.line(40,yy+5,573,yy+5); //linea 4
			doc.line(40,yy+30,573,yy+30); //linea 5
			doc.text(45,yy+40,'Fecha de matrimonio');
			doc.text(45,yy+50,'o convivencia ');
      doc.setFont('Helvetica','bold');
			if(datos.conyugefmat!=''){
				doc.text(178,yy+45,datos.conyugefmat);
				}else{
				doc.text(178,yy+45,datos.conyugeconvivencia);
				}
        doc.setFont('Helvetica','normal');
			doc.text(311,yy+40,'En caso de convivencia');
			doc.text(311,yy+50,'Eliga cob. seg. mutual');
      doc.setFont('Helvetica','bold');
			doc.text(445,yy+45,datos.conyugecobertura);
      doc.setFont('Helvetica','normal');
			doc.line(40,yy+55,573,yy+55); //linea 5
			doc.text(45,yy+65,'Tiene algún beneficio');
			doc.text(45,yy+75,'previsional');
      doc.setFont('Helvetica','bold');
			doc.text(45,yy+95,datos.conyugeprevisional);
      doc.setFont('Helvetica','normal');
			doc.text(178,yy+70,'Tipo');
      doc.setFont('Helvetica','bold');
			doc.text(178,yy+95,datos.conyugetipo);
        if(datos.conyugeprevisional == 'NO'){
    
 
     }
      doc.setFont('Helvetica','normal');
			doc.text(311,yy+70,'Caja o Instituto');
      doc.setFont('Helvetica','bold');
			doc.text(311,yy+95,datos.conyugecaja);
      doc.setFont('Helvetica','normal');
			doc.line(40,yy+80,573,yy+80); //linea 5
			doc.line(40,yy+105,573,yy+105); //linea 5
			
			doc.line(40,yy+130,573,yy+130); //linea 9
			doc.line(395,yy+145,573,yy+145); //linea 10
			doc.line(40,yy+160,573,yy+160); //linea 10
			            doc.line(40,yy+105,40,yy+130); //primer linea v
                  doc.line(573,yy+105,573,yy+160); //primer linea v
			doc.line(217,yy+105,217,yy+130); //primer linea v
			doc.line(395,yy+105,395,yy+160); //primer linea v
			doc.text(45,yy+120,'Trabaja');
      doc.setFont('Helvetica','bold');
			doc.text(45,yy+150,datos.conyugetrabaja);
      doc.setFont('Helvetica','normal');
             if(datos.conyugetrabaja == 'NO'){
 
      }
			doc.text(222,yy+115,'Nombre de empresa');
			doc.text(222,yy+125,'o act. autonoma');
      doc.setFont('Helvetica','bold');
			doc.text(222,yy+150,datos.conyugeempleados);
      doc.setFont('Helvetica','normal');
			doc.text(400,yy+120,'Percibe asignación familiar');  
			doc.text(400,yy+141,'Hijos    : ');
      doc.setFont('Helvetica','bold');
			doc.text(475,yy+141,datos.conyugehijos); 
      doc.setFont('Helvetica','normal'); 
			doc.text(400,yy+156,'Conyugue : ');
      doc.setFont('Helvetica','bold');
			doc.text(475,yy+156,datos.conyugeahijos); 
      doc.setFont('Helvetica','normal'); 
			doc.line(470,yy+130,470,yy+160);	
      if (datos.conyugeprevisional == 'NO') {
      doc.setFillColor(157, 158, 160); // Relleno rojo

      }		
			x=40;
			yi=40;	
     
			doc.addPage('letter','l');		
			
			doc.setLineWidth(1);
			//doc.roundedRect(x,yi,722,533,5,5);
			y=40;
			yf=752+15;
      yy =60;
      var nombredni=datos.nombre + " " + datos.doc;
      doc.setFont('Helvetica', 'bold');
      doc.text(x+5,y-15,nombredni);
      doc.setFont('Helvetica','bold');
			doc.text(x+200,yy,'Datos de otros familiares con derecho a pensión');
			y=yy+15;
      doc.setFont('Helvetica','normal');
			doc.text(x+35,y,'Los hijos menores de 18 años, los hijos menores de 25 años si estudian, hijos incapacitados sin límites de edad.');
    
			y=y+35;
		
		// Preprocesar el contenido de la tabla para que solo la opción seleccionada se muestre
document.querySelectorAll('select').forEach(function(selectElement) {
    var selectedText = selectElement.options[selectElement.selectedIndex].text;
    var td = selectElement.parentElement;
    td.innerHTML = selectedText; // Reemplazar el select por el texto seleccionado
});

// Luego generar el PDF
doc.autoTable({
    html: '#tablaDatos',
    theme: 'grid',
    bodyStyles: { fontSize: 10 },
    headStyles: { fillColor: '#143c5e', textColor: '#fff' },
    styles: {
        overflow: 'linebreak',
        fontSize: 10,
        fontWeight: 'bold',
        textColor: '#000',
        lineColor: '#000',
        lineWidth: 1
    },
    didDrawPage: function(data) {
        var finalY = data.cursor.y;
        doc.setFont('Helvetica', 'bold');
        doc.text(45, finalY + 20, 'Observaciones :');  
        doc.setFont('Helvetica', 'normal');  
        var splitTitle = doc.splitTextToSize(datos.obs, 500);
        doc.text(45, finalY + 50, splitTitle);  
    }
});


		    
			y=y+220;
			y=y+120;
			doc.line(x,y,763,y);
			//doc.line(376+20,y,376+20,572+20); //linea v
			
			y=y+40;
      if(datos.manifiesto == 1){
			doc.setFontSize(12);
			doc.setFont(undefined, 'bold');
			doc.text(x+5,y+20,'Manifestación para asignación familiar :');
			y=y+20;
			doc.setFontSize(10);
      
       doc.setFont(undefined,'normal');
      doc.text(x+5,y+20,'Manifiesto en carácter de declaración jurada que mi hijo menor de 21 años que estudia o incapacitado no percibe beneficio previsional, ni realiza');
      doc.text(x+5,y+35,' beneficio previsional, ni realiza tareas remuneradas, es soltero y el otro progenitor no percibe asignación por el mismo.- ');
      }
			
       
			//doc.text(x+5,y+20,splitTitle2,{maxWidth: 700, align: "justify"});
			
			y=y+m;

			y=y+20;

			y=y+50;
			doc.setFont('Helvetica', 'normal');
			
			x=40;
			yi=40;	
			doc.addPage('letter','p');		
			doc.setLineWidth(1);
      doc.setDrawColor(157, 158, 160);
			//doc.roundedRect(x,yi,533,700,5,5);
			y=60;
			yf=573;
			c=143;
      doc.setFont('Helvetica', 'bold');
      doc.text(x+5,y-15,nombredni);
      doc.setFont('Helvetica', 'bold');
			doc.text(x+75,y,'Detalle cronológico de los servicios presentados por el afiliado desde los 18 años.');
      doc.setFont('Helvetica', 'normal');
			y=y+15;
	
			doc.autoTable({
		        html: '#tablaDetalle',
		        startY: y,
            margin:60,
		        theme: 'grid',
		        bodyStyles: {fontSize: 10},
		        headStyles:{fillColor:'#143c5e',textColor:'#fff'},
		        styles: {overflow: 'linebreak',
	                fontSize: 12,fontWeight:'bold',textColor: '#000',lineColor: '#000',lineWidth:1},
		        columnStyles: {
		            0: {
		                halign: 'center',
		                tableWidth: 100,
		                },
		            1: {
		            	halign: 'center',
		                tableWidth: 100,
		               }   
		        },
            didDrawPage: function (data) {
        var finalY = data.cursor.y; // Obtener la posición final en Y
      y=finalY-30;
    
      y=y+15;
    
      y=y+45;
         if(datos.otrobeneficio == 'NO'){
      }
            doc.line(40,y,40,y+20);//line v 1
            doc.line(573,y,573,y+20);//line v 1
      doc.line(x,y,yf,y);
      doc.line(c+x,y,c+x,y+20);
      doc.line(c+c+x,y,c+c+x,y+20);
      doc.line(c+c+c+x,y,c+c+c+x,y+20);
      y=y+20;
   
      doc.text(x+5,y-5,'Tiene otro beneficio');
      doc.text(c+x+5,y-5,'Tipo');
      doc.text(c+c+x+5,y-5,'Caja o Instituto');
      doc.text(c+c+c+x+5,y-5,'Nro de Beneficio');
      doc.line(x,y,yf,y);
      y=y+25;
      doc.setFont('Helvetica','bold');
      doc.text(x+5,y-8,datos.otrobeneficio);//tiene otro b

      doc.text(c+x+5,y-8,datos.otrotipo);//tipo
      doc.text(c+c+x+5,y-8,datos.otrocaja);//caja o ins
      doc.text(c+c+c+x+5,y-8,datos.otronro);//nro de ben

      doc.setFont('Helvetica','normal');
      
      doc.line(c+c+c+x,y,c+c+c+x,y+25);
      doc.line(x,y,yf,y);
      y=y+25;
      doc.text(x+5,y-8,'Trabaja actualmente en otra actividad');
      doc.setFont('Helvetica','bold');
      doc.text(c+c+c+x+5,y-8,datos.trabaja); //si o no
      doc.setFont('Helvetica','normal');
      doc.line(x,y,yf,y);
      doc.line(c+x,y,c+x,y+75);
      doc.line(c+c+x,y,c+c+x,y+75);
      doc.line(c+c+c+x,y,c+c+c+x,y+100);
      y=y+25;
      doc.text(x+5,y+75-8,'Presenta reconocimiento de servicios');
      //doc.text(c+c+c+x+5,y+75-8,); //si o no
            doc.line(40,y-50,40,y+75);//line v 1
            doc.line(573,y-50,573,y+75);//line v 1
      doc.line(x,y,yf,y);
      doc.text(x+5,y-8,'Publica');
      doc.setFont('Helvetica','bold');
      doc.text(c+x+5,y-8,datos.publica);
      doc.setFont('Helvetica','normal');
      y=y+25;
      doc.line(x,y,yf,y);
      doc.text(x+5,y-8,'Privada');
      doc.setFont('Helvetica','bold');
      doc.text(c+x+5,y-8,datos.privada);
      doc.setFont('Helvetica','normal');
      doc.text(c+c+x+5,y-8,'Continuara?');
      doc.setFont('Helvetica','bold');
      doc.text(c+c+c+x+5,y-8,datos.privadoc);
      doc.setFont('Helvetica','normal');
      y=y+25;
      doc.line(x,y,yf,y);
      doc.text(x+5,y-8,'Autonomo');  
      doc.setFont('Helvetica','bold');
      doc.text(c+x+5,y-8,datos.autonomo);
      doc.setFont('Helvetica','normal');
      doc.text(c+c+x+5,y-8,'Continuara?');
      doc.setFont('Helvetica','bold');
      doc.text(c+c+c+x+5,y-8,datos.autonomoc);
      doc.setFont('Helvetica','normal');
      y=y+25;
      doc.line(x,y,yf,y);
       }
		    })
		 
			doc.autoTable({
		        html: '#tablaServicios',
		        startY: y+10,
            margin:60,
		        theme: 'grid',
		        bodyStyles: {fontSize: 10},
		        headStyles:{fillColor:'#143c5e',textColor:'#fff'},
		        styles: {overflow: 'linebreak',
	                fontSize: 12,fontWeight:600,textColor: '#000',lineColor: '#000',lineWidth:1},
		        columnStyles: {
		            0: {
		                halign: 'center',
		                tableWidth: 100,
		                },
		            1: {
		            	halign: 'center',
		                tableWidth: 100,
		               }   
		        },
                didDrawPage: function (data) {
        var finalY = data.cursor.y; // Obtener la posición final en Y
            y= finalY;
      doc.setFont('Helvetica','bold').text(x+5,y+20,'Observaciones :').setFont('Helvetica','normal');
      y=y+45;
      var obs3 = doc.splitTextToSize(datos.otroobs, 572);
      doc.text(x+35,y,obs3);

      }

		    })

			
			x=40;
			yi=40;	
			doc.addPage('letter','p');		
			
			doc.setLineWidth(1);
			//doc.roundedRect(x,yi,533,700,5,5);
			y=60;
			yf=572;
      doc.setFont('Helvetica', 'bold');
      doc.text(x+5,y-15,nombredni);
			var texto='INFORMACIÓN NECESARIA AL OBTENER EL BENEFICIO DE JUBILACIÓN';
			const textWidth = doc.getTextWidth(texto);
			var x2=(572-textWidth-40)/2;
			doc.setFont('Helvetica','bold').text(x+5+x2,y,texto).setFont('Helvetica','normal');
			y=y+20;
      doc.setFontSize(10);
			doc.text(x+5,y,'SEGURO DE VIDA (LA CAJA SA)');
			y=y+15;
      doc.setFontSize(8);
			var info1 = doc.splitTextToSize('Al acceder al beneficio, previamente deberá confirmar con la empresa si continúa o no con el pago de Seguro de Vida COLECTIVO o ADICIONAL (cod 2046). De no realizar dicho trámite, el instituto continuará con los descuentos tal cual los tenía como Activo, pero con la adecuación de los importes al 2.5 por mil de los capitales asegurados.(Estos importes no son los mismos para aquellos afiliados de organismos adheridos que obtienen beneficio jubilatorio en este Instituto).-', 520);
			doc.text(x+5,y,info1,{maxWidth: 520, align: "justify"});
			y=y+50;
			doc.setFontSize(8);
			var info1 = doc.splitTextToSize('Para dar de baja al Seg. Adicional deberá presentar una nota solicitando dicha baja en box 1 de nuestro Instituto o en la empresa "La Caja", adjuntando DNI y recibo de sueldo-.', 520);
			doc.text(x+5,y,info1,{maxWidth: 520, align: "justify"});
			y=y+30;

      doc.setFontSize(10);
			doc.text(x+5,y,'IAPOS');
			y=y+14;
      doc.setFontSize(8);
			var info2 = doc.splitTextToSize('Una vez obtenido el beneficio de jubilación, deberá presentarse a la brevedad con su DNI en el sector IAPOS (Box nº 4), para su afiliación y la de sus familiares a cargoen caso de corresponder, caso contrario, quedarán sin cobertura.-', 520);
			doc.text(x+5,y,info2,{maxWidth: 520, align: "justify"});

			y=y+35;
      doc.setFontSize(10);
			doc.text(x+5,y,'IMPUESTO A LAS GANANCIAS');
			y=y+12;
      doc.setFontSize(8);
			var info3 = doc.splitTextToSize('En caso de tener que declarar deducciones del impuesto a las ganacias, deberá ingresarlas en la página de AFIP (www.afip.gob.ar) con clave fiscal, en el servicio SIRADIG y declarando al I.M.P.S.R. como empleador (CUIT Nº: 30628014562).-', 520);
			doc.text(x+5,y,info3,{maxWidth: 520, align: "justify"});

			y=y+45;
      doc.setFontSize(10);
			doc.text(x+5,y,'OTROS DESCUENTOS');
			y=y+12;
      doc.setFontSize(8);
			var info4 = doc.splitTextToSize('Si la persona activa estaba afiliada al Sindicato Municipal de Rosario, ese descuento se traslada automáticamente al beneficio de Jubilación. La persona beneficiaria deberá comunicar a las demás Instituciones a las cuales quiera estar afiliada, el número de Jubilación asignado una vez que haya percibido el primer haber.-', 520);
			doc.text(x+5,y,info4,{maxWidth: 520, align: "justify"});

			y=y+56;
      doc.setFontSize(10);
			doc.text(x+5,y,'DEPÓSITO DEL HABER PREVISIONAL');
			y=y+14;
      doc.setFontSize(8);
			var info5 = doc.splitTextToSize('El depósito del Haber Jubilatorio se realiza en la misma Caja de Ahorro del Banco Municipal que la persona tenía en actividad.-', 520);
			doc.text(x+5,y,info5,{maxWidth: 520, align: "justify"});

			y=y+38;
      doc.setFontSize(10);
			doc.text(x+5,y,'SALARIO FAMILIAR CONYUGE');
			y=y+14;

      doc.setFontSize(8);
			var info5 = doc.splitTextToSize('Se debe presentar partida de matrimonio actualizada(fecha emisión menor a seis meses)como archivo adjunto, por correo electrónico a: prestaciones@impsr.gob.ar', 520);
			doc.text(x+5,y,info5,{maxWidth: 520, align: "justify"});
doc.setFontSize(10);
			y=y+38;
			y=y+14;

      doc.setFontSize(10);
			doc.text(x+5,y,'SALARIO FAMILIAR HIJOS/AS - ESCOLARIDAD - AYUDA ESCOLAR');
			y=y+14;
			
      doc.setFontSize(8);
			var info5 = doc.splitTextToSize('Los certificados escolares deberán ser presentados exclusivamente por correo electrónico, como archivo adjunto, al siguiente correo: prestaciones@impsr.gob.ar. Los certificados se deben presentar al inicio y finalización del ciclo lectivo. La no presentación en tiempo y forma, tendrá por consecuencia la baja o suspensión del salario familiar.', 520);
			doc.text(x+5,y,info5,{maxWidth: 520, align: "justify"});
doc.setFontSize(10);
			y=y+14;
			y=y+40;
			

			
      doc.line(x,y+230,573,y+230);
      doc.line(x,y,yf,y);
			doc.line(c+x,y,c+x,y+210);
			
			y=y+30;
			doc.text(x+5,y-10,'Firma del solicitante');
			doc.line(x,y,yf,y);

			y=y+30;
			doc.text(x+5,y-10,'Aclaración  ');
			doc.line(x,y,yf,y);
			y=y+30;
			doc.line(c+c+x,y,c+c+x,y+120);
			doc.line(c+c+c+x,y,c+c+c+x,y+120);
			doc.text(x+5,y-10,'Lugar y Fecha ');
			doc.line(x,y,yf,y);
			y=y+60;
			doc.line(x,y,yf,y);
			doc.text(x+5,y-30,'Firma de');
			doc.text(x+5,y-10,'quien certifica');
			doc.text(c+c+x+5,y-30,'Aclaracion y cargo');
			doc.text(c+c+x+5,y-10,'de quien certifica');
			y=y+60; 
			doc.line(x,y,yf,y);
			doc.text(x+5,y-30,'Firma de quien');
			doc.text(x+5,y-10,'recibe en el instituto');
			doc.text(c+c+x+5,y-30,'Firma de');
			doc.text(c+c+x+5,y-10,'Control');
			
			
			doc.setFontSize(8);
			y=y+13;
			doc.text(x+5,y,'Únicamente puede certificar funcionarios de este instituto,poder judicial, juez de paz, escribano, autoridades con enlaces.');		
					
			doc.save('Solicitud_jubilacion.pdf'); 
			
	}
	</script>
</body>
</html>
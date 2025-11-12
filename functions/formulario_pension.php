<?php include 'head.php'; ?>
<?php include 'header.php'; ?>
<?php include 'functions/connect.php';

global $con;
  $query="SELECT * FROM `nacionalidad`";
  $res=$con->query($query);
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
		    <p>Solicitud de Pensión</p>
	    </div>
	    
        <form id="formDatos" role="form" class="form" method="post">
        	<div class="row mt-2">
          		<div class="col-12 col-sm-6 mb-2">
				  <label>FALLECIMIENTO DE</label>
              		<div class="form-check">
                      <input class="form-check-input" type="radio" value="activo" name="fallece" checked>
                      <label class="form-check-label" for="tipotramite">
					  ACTIVO
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" value="jubilado" name="fallece">
                      <label class="form-check-label" for="tiporepre">
					  JUBILADO
					  </label>
                    </div>
                </div>
            </div>
        	<div class="row mt-2">
          		<div class="col-12 col-sm-6 mb-2">
				  <label>TIPO</label>
              		<select type="text"class="form-check" name="tipo">
                      <option  value="Pensión ESPOSA" name="tipo" checked>
                      Pensión ESPOSA
                     </option>
                      <option  value="Pensión CONVIVIENTE" name="tipo" >
					            Pensión CONVIVIENTE
				              </option>
                      <option  value="Pensión HIJO MENOR" name="tipo" >
					             Pensión HIJO MENOR
                      </option> 
                      <option value="Pensión HIJO MENOR 25(ESTUDIA)" name="tipo" > 
					            Pensión HIJO MENOR 25(ESTUDIA)
                      </option>                
                      <option value="Pensión HIJO INCAPAC.o" name="tipo">
					             Pensión HIJO INCAPAC.
                      </option>
                      <option value="Otro Tipo" name="tipo" >
                      OTRO TIPO
                     </option>
                   </select>
                    </div>
                </div>
           
          	<h2>Datos del beneficiario y/o solicitante.</h2>
          	<div class="row mt-2">
          		<div class="col-12 col-sm-6 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Apellido y Nombre completo</span>
                  </div>
                  <input type="text" class="form-control" name="nombre" required>
                </div>
                <div class="col-12 col-sm-6 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >CUIL</span>
                  </div>
                  <input type="text" class="form-control" name="cuit" required>
                </div>
          	</div>
          	<div class="row mt-2">
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
                  	<option value="Casado/a">Casado/a</option>
                  	<option value="Soltero/a">Soltero/a</option>
                  	<option value="Divorciado/a">Divorciado/a</option>
                  	<option value="Viudo/a">Viudo/a</option>
                  	<option value="Separado/a">Separado/a de hecho</option>
                  </select>
                </div>
          	</div>
          	<div class="row mt-2">
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
                  <select type="text" class="form-control" id="provincia" name="provincia" required></select>
                </div>
                <div class="col-8 col-sm-5 input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" >Localidad</span>
                  </div>
                  <select type="text" class="form-control" id="localidad" name="localidad" required></select>
                </div>
         
                     <div class="col-4 col-sm-2 input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" >C.P.</span>
                  </div>
                  <select type="text" class="form-control"  name="cp" id="cp" required></select>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-7 col-sm-5 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Calle</span>
                  </div>
                  <input type="text" class="form-control"  name="calle">
                </div>
                <div class="col-5 col-sm-3 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Altura</span>
                  </div>
                  <input type="text" class="form-control"  name="altura" >
                </div>
                <div class="col-6 col-sm-2 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Piso</span>
                  </div>
                  <input type="text" class="form-control" name="piso" >
                </div>
                <div class="col-6 col-sm-2 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Dpto</span>
                  </div>
                  <input type="text" class="form-control" name="dpto" >
                </div>
          	</div>

            <div class="row mt-2">
          
          	
                  <input type="hidden" class="form-control" name="telefono" value="0">
            
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
          	<hr>
          	<div class="row mt-2">
				<div class="col-12 col-sm-3 mb-2">    
          			<label>Tiene algún beneficio</label>
          			<div class="btn-group btn-group-toggle" data-toggle="buttons">
                    	<label class="btn btn-primary">
                        	<input type="radio" name="beneficio1" value="SI" > SI
                        </label>
                        <label class="btn btn-primary  active">
                        	<input type="radio" name="beneficio1" value="NO" checked> NO
                        </label>
                  	</div>
                </div>
				<div class="col-12 col-sm-3 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Tipo</span>
                  </div>
                  <input type="text" class="form-control"  name="beneficio1tipo">
                </div>
                <div class="col-12 col-sm-3 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Caja o Inst.</span>
                  </div>
                  <input type="text" class="form-control"  name="beneficio1caja">
                </div>
                <div class="col-12 col-sm-3 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Nro.</span>
                  </div>
                  <input type="text" class="form-control"  name="beneficio1nro">
                </div>
			</div>
			<!-- 
			<div class="row mt-2">
				<div class="col-12 col-sm-3 mb-2">    
          			<label>Tiene algun beneficio</label>
          			<div class="btn-group btn-group-toggle" data-toggle="buttons">
                    	<label class="btn btn-primary">
                        	<input type="radio" name="beneficio2" value="SI" > SI
                        </label>
                        <label class="btn btn-primary  active">
                        	<input type="radio" name="beneficio2" value="NO" checked> NO
                        </label>
                  	</div>
                </div>
				<div class="col-12 col-sm-3 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Tipo</span>
                  </div>
                  <input type="text" class="form-control"  name="beneficio2tipo">
                </div>
                <div class="col-12 col-sm-3 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Caja o Ins.</span>
                  </div>
                  <input type="text" class="form-control"  name="beneficio2caja">
                </div>
                <div class="col-12 col-sm-3 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Nro.</span>
                  </div>
                  <input type="text" class="form-control"  name="beneficio2nro">
                </div>
			</div>
			 -->
			<div class="row mt-2">
				<div class="col-12 col-sm-2 mb-2">    
          			<label>Trabaja</label>
          			<div class="btn-group btn-group-toggle" data-toggle="buttons">
                    	<label class="btn btn-primary">
                        	<input type="radio" name="trabaja" value="SI" > SI
                        </label>
                        <label class="btn btn-primary  active">
                        	<input type="radio" name="trabaja" value="NO" checked> NO
                        </label>
                  	</div>
                	
                </div>
				<div class="col-12 col-sm-6 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Nombre de la empresa, inst. o act. autónoma</span>
                  </div>
                  <input type="text" class="form-control"  name="trabajanombre">
                </div>
                <div class="col-12 col-sm-4 mb-2">    
          			<label>Estaba afiliado a IAPOS<br><small>a través del causante</small></label>
          			<div class="btn-group btn-group-toggle" data-toggle="buttons">
                    	<label class="btn btn-primary">
                        	<input type="radio" name="trabajaiapos" value="SI" > SI
                        </label>
                        <label class="btn btn-primary  active">
                        	<input type="radio" name="trabajaiapos" value="NO" checked> NO
                        </label>
                  	</div>
                	
                </div>
			</div>
            <hr>
            <h2>Datos del causante</h2>
            <div class="row mt-2">
          		<div class="col-12 col-sm-8 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Apellido y Nombre completo</span>
                  </div>
                  <input type="text" class="form-control" name="causantenombre" >
                </div>
                <div class="col-12 col-sm-4 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >DNI</span>
                  </div>
                  <input type="text" class="form-control" name="causantedni">
                </div>
            </div>
          	<div class="row mt-2">
          		<div class="col-12 col-sm-4 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Estado Civil</span>
                  </div>
                  <select class="custom-select"  name="causanteestado">
                  	<option value="" selected>Seleccione</option>
                  	<option value="Casado/a">Casado/a</option>
                  	<option value="Soltero/a">Soltero/a</option>
                  	<option value="Divorciado/a">Divorciado/a</option>
                  	<option value="Viudo/a">Viudo/a</option>
                  	<option value="Separado/a">Separado/a de hecho</option>
                  </select>
                </div>
                <div class="col-12 col-sm-4 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Fecha Fall.</span>
                  </div>
                  <input type="date" class="form-control" name="causantefecha">
                </div>
                <div class="col-12 col-sm-4 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Lugar Fall.</span>
                  </div>
                  <input type="text" class="form-control" name="causantelugar">
                </div>
          	</div>
          	<div class="row mt-2">
          		<div class="col-12 col-sm-6 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >En caso de ser jubilado <br>consignar nro de bene.</span>
                  </div>
                  <input type="text" class="form-control" name="causantenrojub" >
                </div>
                <div class="col-12 col-sm-6 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >En caso de ser activo <br>consignar nro de leg. y dep.</span>
                  </div>
                  <input type="text" class="form-control" name="causanteactivo">
                </div>
            </div>
          	<hr>
          	<!-- hoja 2 -
          	<h2>Datos de otros familiares con derecho a pensión</h2>
          	<div class="row mt-2">
          		<div class="col-12 mt-2">
					<p>Los hijos menores de 18 años, los hijos menores de 25 años si estudian, hijos incapacitados sin límites de edad.</p>
				</div>
          	</div>
			<div class="row mt-2">
    			<table class="col-12" id="tablaDatos">
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
        				</tr>
    				</thead>
    				<tbody>
    				<tr>
    				<td class="bk-primary"></td>
    				<td class="bk-primary"></td>
    				<td class="bk-primary"></td>
    				<td class="bk-primary"></td>
    				<td class="bk-primary"></td>
    				<td class="bk-primary"></td>
    				<th class="subcolumn-header">Tipo</th>
    				<th class="subcolumn-header">Const</th>
    				<th class="subcolumn-header">SI-NO</th>
    				<th class="subcolumn-header">Tipo</th>
    				<th class="subcolumn-header">Caja o Inst</th>
    				</tr>
    				<tr>
    				<td contenteditable="true"></td>
    				<td contenteditable="true"></td>
    				<td contenteditable="true"></td>
    				<td contenteditable="true"></td>
    				<td contenteditable="true"></td>
    				<td contenteditable="true"></td>
    				<td class="subcolumn" contenteditable="true"></td>
    				<td class="subcolumn" contenteditable="true"></td>
    				<td class="subcolumn" contenteditable="true"></td>
    				<td class="subcolumn" contenteditable="true"></td>
    				<td class="subcolumn" contenteditable="true"></td>
    				</tr>
    				<tr>
    				<td contenteditable="true"></td>
    				<td contenteditable="true"></td>
    				<td contenteditable="true"></td>
    				<td contenteditable="true"></td>
    				<td contenteditable="true"></td>
    				<td contenteditable="true"></td>
    				<td class="subcolumn" contenteditable="true"></td>
    				<td class="subcolumn" contenteditable="true"></td>
    				<td class="subcolumn" contenteditable="true"></td>
    				<td class="subcolumn" contenteditable="true"></td>
    				<td class="subcolumn" contenteditable="true"></td>
    				</tr>
    				<tr>
    				<td contenteditable="true"></td>
    				<td contenteditable="true"></td>
    				<td contenteditable="true"></td>
    				<td contenteditable="true"></td>
    				<td contenteditable="true"></td>
    				<td contenteditable="true"></td>
    				<td class="subcolumn" contenteditable="true"></td>
    				<td class="subcolumn" contenteditable="true"></td>
    				<td class="subcolumn" contenteditable="true"></td>
    				<td class="subcolumn" contenteditable="true"></td>
    				<td class="subcolumn" contenteditable="true"></td>
    				</tr>
    				<tr>
    				<td contenteditable="true"></td>
    				<td contenteditable="true"></td>
    				<td contenteditable="true"></td>
    				<td contenteditable="true"></td>
    				<td contenteditable="true"></td>
    				<td contenteditable="true"></td>
    				<td class="subcolumn" contenteditable="true"></td>
    				<td class="subcolumn" contenteditable="true"></td>
    				<td class="subcolumn" contenteditable="true"></td>
    				<td class="subcolumn" contenteditable="true"></td>
    				<td class="subcolumn" contenteditable="true"></td>
    				</tr>
    				<tr>
    				<td contenteditable="true"></td>
    				<td contenteditable="true"></td>
    				<td contenteditable="true"></td>
    				<td contenteditable="true"></td>
    				<td contenteditable="true"></td>
    				<td contenteditable="true"></td>
    				<td class="subcolumn" contenteditable="true"></td>
    				<td class="subcolumn" contenteditable="true"></td>
    				<td class="subcolumn" contenteditable="true"></td>
    				<td class="subcolumn" contenteditable="true"></td>
    				<td class="subcolumn" contenteditable="true"></td>
    				</tr>
    				<tr>
    				<td contenteditable="true"></td>
    				<td contenteditable="true"></td>
    				<td contenteditable="true"></td>
    				<td contenteditable="true"></td>
    				<td contenteditable="true"></td>
    				<td contenteditable="true"></td>
    				<td class="subcolumn" contenteditable="true"></td>
    				<td class="subcolumn" contenteditable="true"></td>
    				<td class="subcolumn" contenteditable="true"></td>
    				<td class="subcolumn" contenteditable="true"></td>
    				<td class="subcolumn" contenteditable="true"></td>
    				</tr>
    				</tbody>
    			</table>

				
			</div>
			-->
      <p style="margin-top: 50px;margin-bottom: -4px;">(En el caso de que el/la solicitante sea hijo menor o incapacitado y este representado por un tutor o curador,se debera consignar los datos de este).</p>
			<h2>Datos curador o tutor</h2>
          	<div class="row mt-2">
          		<div class="col-12 col-sm-6 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Apellido y Nombre completo</span>
                  </div>
                  <input type="text" class="form-control" name="tutornombre" >
                </div>
                <div class="col-12 col-sm-6 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >DNI</span>
                  </div>
                  <input type="text" class="form-control" name="tutordni" >
                </div>
          	</div>
          	<div class="row mt-2">
          		<div class="col-12 col-sm-3 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Fecha Nac.</span>
                  </div>
                  <input type="date" class="form-control" name="tutorfnac">
                </div>
                <div class="col-12 col-sm-4 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Nacionalidad</span>
                  </div>
                  <select type="text" class="form-control" name="tutornacionalidad"id="aponacionalidad" ><option ></option>
                    <?php 
                    foreach ($res as $value) {
                      echo '
                    <option value="'.$value["DESCRIPCION"].'">'.$value["DESCRIPCION"].'</option>';
                  }?>
                  </select>
                </div>
                <div class="col-12 col-sm-5 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Parentesco o Prof. hab.</span>
                  </div>
                  <input type="text" class="form-control" name="tutorparentesco">
                </div>
          	</div>
          	           <div class="row mt-2">
            <div class="col-12 col-sm-5 input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" >Provincia</span>
                  </div>
                  <select type="text" class="form-control" id="apoprovincia" name="tutorprovincia" ><option ></option></select>
                </div>
                <div class="col-8 col-sm-5 input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" >Localidad</span>
                  </div>
                  <select type="text" class="form-control" id="apolocalidad"  name="tutorlocalidad" ><option ></option></select>
                </div>
              
                   <div class="col-4 col-sm-2 input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" >C.P.</span>
                  </div>
                  <select type="text" class="form-control" id="apocp" name="tutorcp"><option >Seleccione..</option></select>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-7 col-sm-5 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Calle</span>
                  </div>
                  <input type="text" class="form-control"  name="tutorcalle">
                </div>
                <div class="col-5 col-sm-3 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Altura</span>
                  </div>
                  <input type="text" class="form-control"  name="tutoraltura">
                </div>
                <div class="col-6 col-sm-2 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Piso</span>
                  </div>
                  <input type="text" class="form-control" name="tutorpiso" >
                </div>
                <div class="col-6 col-sm-2 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Dpto</span>
                  </div>
                  <input type="text" class="form-control" name="tutordpto" >
                </div>
          	</div>

            <div class="row mt-2">
        
             
                <div class="col-6 col-sm-6 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Celular</span>
                  </div>
                  <input type="text" class="form-control"  name="tutorcelular">
                </div>
                <div class="col-12 col-sm-6 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >E-mail</span>
                  </div>
                  <input type="email" class="form-control"  name="tutoremail">
                </div>
            </div>
            <div class="row mt-2">
            	<div class="col-12 my-2 d-flex" style="flex-direction: column;">
					<label for="additional-content">Observaciones:</label>
					<textarea id="additional-content" class="form-control" name="observacionesdatos"></textarea>
				</div>
            </div>
            <!-- hoja 3 -->
			<hr>
			<div class="row mt-2">
				<div class="col-12 mt-3">
					<p>Completar solo si el causante era activo</p>
					<h6 class="text-capitalize">DETALLE CRONOLÓGICO DE LOS SERVICIOS PRESENTADOS POR EL AFILIADO DESDE LOS 18 AÑOS</h6>
				</div>
			</div>
			<div class="row mt-2">
				<table class="col-12" id="tablaDetalle">
					<thead>
    					<tr>
        					<th>Nombre de la empresa, institución, <br> empleador y/o act. por cuenta propia</th>
        					<th>Tarea o Cargo</th>
        					<th>Desde</th>
        					<th>Hasta</th>
    					</tr>
					</thead>
					<tbody>
					<tr>
					<td contenteditable="true"></td>
					<td contenteditable="true"></td>
					<td contenteditable="true"></td>
					<td contenteditable="true"></td>
					</tr>
					
					</tbody>
				</table>
				<div id="textarea-container" class="col-12 d-flex" style="flex-direction: column;">
					<label for="additional-content">Observaciones:</label>
					<textarea id="additional-content" class="form-control" name="observacionesdetalle"></textarea>
				</div>
			</div>	

			<div class="row mt-2">
				<div class="col-12 mb-2 mt-3">    
    				<p class="mb-0 mr-2 mt-1">¿El causante trabajaba actualmente en otra actividad?</p>
           			<div class="btn-group btn-group-toggle" data-toggle="buttons">
                      	<label class="btn btn-primary"><input type="radio" name="causantetrabaja" value="SI" > SI</label>
                        <label class="btn btn-primary active"><input type="radio" name="causantetrabaja" value="NO" checked> NO</label>
                    </div>
                </div>
                <div class="col-12 mb-2 mt-3">    
    				<p class="mb-0 mr-2 mt-1">¿Presenta reconocimiento de servicios?</p>
           			<div class="btn-group btn-group-toggle" data-toggle="buttons">
                      	<label class="btn btn-primary"><input type="radio" name="reconocimiento" value="SI" > SI</label>
                        <label class="btn btn-primary active"><input type="radio" name="reconocimiento" value="NO" checked> NO</label>
                    </div>
                </div>
            </div>
            <div class="row mt-2">    
                <table class="col-12" id="tablaServicios">
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
			</div>
		<div class="row col-12 col-sm-5 mb-2 mt-2">    
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
            
                <input type="hidden" name="simultaneo" value="SI" > 
              
              
                <input type="hidden" name="simultaneo" value="NO" checked> 
              
            </div>
          </div>
        <div class="row">
          <div id="textarea-container" class="col-12 d-flex mb-5" style="flex-direction: column;">
            
            <input type="hidden" id="additional-content" rows="5" class="form-control" name="otroobs">
          </div>
</div>
          
            <div class="row mb-3">
              <div class="col-12 col-sm-6" style="margin-top: 30px">
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
              <div class="col-12">
                <div id="mensaje"></div>
              </div>
            </div>
    	</form>
		
	</div>
	<?php include 'footer.php'; ?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.1/jspdf.plugin.autotable.js" integrity="sha512-oTV4NrGNoEpaF91/0i6IMXJYFfXhd6vXY9YQxEj/kPA2ra6p6ZykYfnfbvHGnGN4maXZCvhDJ3PerIFvMptckw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script>
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
    $('#aponacionalidad').on('change', function() {
        var selectedValue = $(this).val();
        
        // Llamada AJAX para obtener datos del segundo select
        $.ajax({
            url: 'functions/save-nacionalidad.php',
            type: 'POST',
            data: {selectedValue: selectedValue},
            success: function(data) {
                $('#apoprovincia').html(data);
            }
        });
    });

    $('#apoprovincia').on('change', function() {
        var selectedValue = $(this).val();
        
        // Llamada AJAX para obtener datos del tercer select
        $.ajax({
            url: 'functions/save-provincia.php',
            type: 'POST',
            data: {selectedValue: selectedValue},
            success: function(data) {
                $('#apolocalidad').html(data);
            }
        });
    });

    // Cuando cambie el tercer select
    $('#apolocalidad').on('change', function() {
        var selectedValue = $(this).val();
        
        // Llamada AJAX para obtener el dato correspondiente
        $.ajax({
            url: 'functions/save-localidad.php',
            type: 'POST',
            data: {selectedValue: selectedValue},
            success: function(data) {
                $('#apocp').html(data);
            }
        });
    });
});
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

	window.jsPDF = window.jspdf.jsPDF
	const form=document.getElementById('formDatos');
	form.addEventListener('submit',guardarForm);
	const mensaje=document.getElementById('mensaje');
	
	 

	function guardarForm(e){
		if (confirm("¿Desea guardar el formulario?") == true) {
		e.preventDefault();
		data = new FormData(form);
		var xhr = new XMLHttpRequest();
		xhr.responseType = 'json';
		xhr.open("POST", "functions/save-form4.php", true);
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
		var doc = new jsPDF('p', 'pt', 'A4');  
		var pageHeight = 0;  
			pageHeight = doc.internal.pageSize.height;  
			specialElementHandlers = {  
				'#bypassme': function(element, renderer) {  
			    	return false 
			    }  
			};  
			margins = {  
				top: 210,  
			    bottom: 10,  
			    left: 40,  
			    right: 40,  
			    width: 600  
			};  
			var y = 125;  
			var img = new Image();
			var x=40;
			var y=50;
			var l=30;
			var c=10;
			var m=20; 
			var xf=533+40;
			img.src = 'logo_impsr.png'
			doc.addImage(img, 'png', 60 , y+4, 160,90 );
      doc.setDrawColor(157, 158, 160);
			doc.setLineWidth(1);
      //doc.roundedRect(x,y,533,755,5,5); //cuadro principal
      doc.line(240,y,573,y); //primer linea hori
			doc.line(240,y,240,210); //primer linea v
      doc.line(573,y,573,230); // segunda linea v
      doc.line(x,144,x,230); //primer linea v
			doc.setFontSize(14);
			doc.line(380,y,380,144); // segunda linea v
			doc.setFont('Helvetica','bold');
			doc.text(280,y+30,'Solicitud ');
			doc.text(300,y+50,'de');
			doc.text(285,y+70,'Pensión');
			doc.setFont('Helvetica','normal');

	
			doc.line(40,y+93.75,533+40,y+93.75);
		  yl= y+30;
			doc.setFontSize(11);
			doc.setFont("zapfdingbats", "normal");
			var check='o';
			doc.text(420,yl+33.5,check);
			doc.text(550,yl+33.5,check);
			
			if(datos.fallece=='activo'){
			doc.text(421,yl+33.5-2,'3');
			}
			
			
			if(datos.fallece=='jubilado'){
			doc.text(551,yl+33.5-2,'3');
			}
			
			doc.setFont("Helvetica", "normal");
      doc.text(365,yl+95,datos.tipo);
			
			doc.text(385,yl+14.75,'Fallecimiento de :');
			doc.text(385,yl+33.5,'Activo');
			doc.text(500,yl+33.5,'Jubilado');

			doc.setFontSize(14);
			doc.setFont('Helvetica','bold');
			doc.text(290,y+125,'Tipo :');
			doc.setFont('Helvetica','normal');
			doc.setFontSize(10);
			doc.setFontSize(12);
			doc.setFontSize(10);
			doc.line(40,y+160,573,y+160);
			doc.text(45,y+120,'Todos los datos consignados en este');
			doc.text(45,y+135,'formulario revisten caracter de');
			doc.text(45,y+150,'declaracion jurada');
			doc.setFontSize(12);	

			var yy=y+160;
			doc.line(40,yy,573,yy);
     
			var nombre=datos.nombre;
      doc.setFont('Helvetica', 'normal');
			doc.text(185,yy+15,'Apellido y Nombre Completo del/la solicitante  ');
      doc.line(40,yy+20,573,yy+20);
      doc.setFont('Helvetica', 'bold');
      doc.text(254,yy+33,''+nombre);
      doc.setFont('Helvetica', 'normal');
       doc.setFontSize(12);
        yy=yy+55;//155
            doc.line(40,yy-15,40,yy+5); //linea 3
            doc.line(573,yy-15,573,yy+5); //linea 3
			doc.line(40,yy-15,573,yy-15    ); //linea 3
		
			doc.text(45,yy,'Fecha Nac ');
			doc.text(178,yy,'Nacionalidad ');
			doc.text(311,yy,'DNI / CUIL ');
			doc.text(445,yy,'Estado civil ');
      doc.setFont('Helvetica', 'bold');
			doc.text(45,yy+25,datos.fnac);
			doc.text(178,yy+25,datos.nac);
			doc.text(311,yy+25,datos.doc);
			doc.text(445,yy+25,datos.estado);
      doc.setFont('Helvetica', 'normal');
			doc.line(173,yy-15,173,yy+5); //primer linea v
			doc.line(306,yy-15,306,yy+5); //primer linea v
			doc.line(440,yy-15,440,yy+5); //primer linea v
			doc.line(40,yy+5,573,yy+5); //linea 4
			doc.line(40,yy+30,573,yy+30); //linea 5
               doc.line(40,yy+30,40,yy+50); //linea 3
               doc.line(573,yy+30,573,yy+50); //linea 3
			
			doc.line(40,yy+50,573,yy+50); //linea 6
			doc.text(145,yy+45,'Domicilio Particular ');
			
			doc.text(431,yy+45,'Reside en el país :'+datos.reside);
			doc.line(429,yy+30,429,yy+50); //primer linea v
      doc.setFont('Helvetica', 'bold');
      yy=yy-20;
			doc.text(45,yy+90,datos.calle);
			doc.text(178,yy+90,datos.altura);
			doc.text(311,yy+90,datos.piso);
			doc.text(445,yy+90,datos.dpto);
      doc.setFont('Helvetica', 'normal');
			doc.line(40,yy+95,573,yy+95); //linea 8
               doc.line(40,yy+95,40,yy+115); //linea 8
               doc.line(573,yy+95,573,yy+115); //linea 8
			doc.line(40,yy+115,573,yy+115); //linea 7
			doc.line(40,yy+140,573,yy+140); //linea 8
			doc.line(235,yy+95,235,yy+115); //primer linea v
			doc.line(440,yy+95,440,yy+115); //primer linea v
			doc.text(45,yy+110,'Provincia');
			doc.text(240,yy+110,'Localidad');
			doc.text(445,yy+110,'CP');
      doc.setFont('Helvetica', 'bold');
			doc.text(45,yy+135,datos.provincia);
			doc.text(240,yy+135,datos.localidad);
			doc.text(445,yy+135,datos.cp);
      doc.setFont('Helvetica', 'normal');
               doc.line(40,yy+140,40,yy+160); //linea 8
               doc.line(573,yy+140,573,yy+160); //linea 8
			doc.line(40,yy+160,573,yy+160); //linea 9
			doc.line(40,yy+188,573,yy+188); //linea 10
			//doc.line(217,yy+140,217,yy+160); //primer linea v
			doc.line(395,yy+140,395,yy+160); //primer linea v
		
			doc.text(45,yy+155,'Celular');
			doc.text(400,yy+155,'Correo electronico');
      doc.setFont('Helvetica', 'bold');
		
			doc.text(45,yy+180,datos.celular);
			doc.text(400,yy+180,datos.email);
      doc.setFont('Helvetica', 'normal');
			doc.setLineWidth(1);
			doc.setDrawColor(169, 169, 169);
			
			
			doc.setLineWidth(1);
			yy=yy+210;
			doc.text(45,yy-8,'Tiene algún beneficio');
			doc.text(45,yy+3,'previsional');
			doc.text(178,yy-2,'Tipo');
			doc.text(311,yy-2,'Caja o instituto');
			doc.text(445,yy-2,'Nro de Beneficio');
      doc.setFont('Helvetica', 'bold');
     
			doc.text(45,yy+25,datos.beneficio1);
       if(datos.beneficio1 == 'NO'){
      // Establecer el color de relleno
   
      }
			doc.text(178,yy+25,datos.beneficio1tipo);
			doc.text(311,yy+25,datos.beneficio1caja);
			doc.text(445,yy+25,datos.beneficio1nro);
      doc.setFont('Helvetica', 'normal');
               doc.line(40,yy-22,40,yy+5); //primer linea v
               doc.line(573,yy-22,573,yy+5); //primer linea v
			doc.line(173,yy-22,173,yy+5); //primer linea v
			doc.line(306,yy-22,306,yy+5); //primer linea v
			doc.line(440,yy-22,440,yy+5); //primer linea v
			doc.line(40,yy+5,573,yy+5); //linea 4
			doc.line(40,yy+30,573,yy+30); //linea 5
			//doc.text(45,yy+50,datos.beneficio2);
			//doc.text(178,yy+50,datos.beneficio2tipo);
			//doc.text(311,yy+50,datos.beneficio2caja);
			//doc.text(445,yy+50,datos.beneficio2nro);
			//doc.text(445,yy+45,datos.conyugecobertura);
			doc.line(40,yy+55,573,yy+55); //linea 5
                        doc.line(40,yy+55,40,yy+80); //primer linea v
                        doc.line(573,yy+55,573,yy+80); //primer linea v
			doc.line(40,yy+80,573,yy+80); //linea 5
			doc.line(40,yy+105,573,yy+105); //linea 5
			doc.line(150,yy+55,150,yy+80); //primer linea v
			doc.line(395,yy+55,395,yy+80); //primer linea v
			doc.text(45,yy+75,'Trabaja');
      doc.setFont('Helvetica', 'bold');
			doc.text(45,yy+100,datos.trabaja);
      doc.setFont('Helvetica', 'normal');
			doc.text(152,yy+68,'Nombre de empresa');
			doc.text(152,yy+78,'o act. autónoma');
      doc.setFont('Helvetica', 'bold');

			doc.text(222,yy+100,datos.trabajanombre);
      if(datos.trabaja == 'NO'){

      }
      doc.setFont('Helvetica', 'normal');
			doc.text(400,yy+68,'Estaba afiliado a IAPOS');
			doc.text(400,yy+78,'a travÉs del causante');  
      doc.setFont('Helvetica', 'bold');
			doc.text(475,yy+100,datos.trabajaiapos);  
      doc.setFont('Helvetica', 'normal');
			yy=yy+125;
			doc.line(x,yy,xf,yy);
      doc.setFont('Helvetica', 'bold');
			doc.text(x+200,yy-5,'Datos del causante');
			yy=yy+25;
      doc.setFont('Helvetica', 'normal');
			doc.line(x,yy,xf,yy); 
            doc.line(40,yy-25,40,yy+20);
            doc.line(573,yy-25,573,yy+20);
			doc.line(173,yy,173,yy+20);
			doc.line(306,yy,306,yy+20);
			doc.line(440,yy,440,yy+20);	
      doc.line(306,yy+45,306,yy+65);
            doc.line(40,yy+45,40,yy+65);
            doc.line(573,yy+45,573,yy+65);
      doc.setFont('Helvetica', 'bold');
			doc.text(x+5,yy-5,'Apellido y nombre : '+datos.causante);
      doc.setFont('Helvetica', 'normal');
			yy=yy+20;
			doc.line(x,yy,xf,yy);
			doc.text(x+5,yy-5,'DNI/CUIL');
			doc.text(x+138,yy-5,'Estado Civil');
			doc.text(x+271,yy-5,'Fecha Fall.');
			doc.text(x+405,yy-5,'Lugar Fall.');
			yy=yy+25;
			doc.line(x,yy,xf,yy);
      doc.setFont('Helvetica', 'bold');
			doc.text(x+5,yy-5,datos.causantedni);
			doc.text(x+138,yy-5,datos.causanteestado);
			doc.text(x+271,yy-5,datos.causantefecha);
			doc.text(x+405,yy-5,datos.causantelugar);
      doc.setFont('Helvetica', 'normal');
			yy=yy+20;
			doc.line(x,yy,xf,yy);
			doc.setFontSize(11);
			doc.text(x+5,yy-5,'En caso de ser jubilado consignar nro de beneficio');
			doc.text(x+271,yy-10,'En caso de ser activo');
			doc.text(x+271,yy-2,'consignar nro de legajo y dependencia');
			doc.setFontSize(12);
			yy=yy+25;
			doc.line(x,yy,xf,yy);
      doc.setFont('Helvetica', 'bold');
			doc.text(x+5,yy-5,datos.causantenro);
			doc.text(x+271,yy-5,datos.causanteactivo);
       doc.setFont('Helvetica', 'bold');
   
			x=50;
			yi=50;	

			doc.addPage('letter','p');		
			doc.setLineWidth(1);
			//doc.roundedRect(x,yi,533,700,5,5);
      doc.setDrawColor(157, 158, 160);
			y=40;
			yf=583;

		
			var xm=50;
			var xm1=20+188;
			var xm2=400;
			xf=yf;
			
			
			
			y=y+35;
      doc.line(50,y,50,y+20);
      doc.line(583,y,583,y+20);
      doc.line(xm2,y,xm2,y+20);
			doc.line(xm1,y+45,xm1,y+65);
			
			doc.line(xm,y,xf,y);
			doc.setFont('Helvetica', 'bold');
			doc.text(xm+175,y-5,'Datos del curador o tutor');
			doc.setFont('Helvetica', 'normal');
			y=y+20;
			doc.line(xm,y,xf,y);
			doc.text(xm+5,y-5,'Apellido y nombre');
			doc.text(xm2+5,y-5,'DNI');
			y=y+25;
			doc.line(xm,y,xf,y);
      doc.setFont('Helvetica', 'bold');
			doc.text(xm+5,y-5,datos.tnombre);
			doc.text(xm2+5,y-5,datos.tdni);
      doc.setFont('Helvetica', 'normal');
           doc.line(xm2,y,xm2,y+20);
           doc.line(50,y,50,y+20);
           doc.line(583,y,583,y+20);
			y=y+20;
			doc.line(xm,y,xf,y);

			doc.text(xm+5,y-5,'Fecha Nac.');
			doc.text(xm1+5,y-5,'Nacionalidad');
			doc.text(xm2+5,y-5,'Parentesco');
			y=y+25;
			doc.line(xm,y,xf,y);
      doc.setFont('Helvetica', 'bold');
			doc.text(xm+5,y-5,datos.tfnac);
			doc.text(xm1+5,y-5,datos.tnac);
			doc.text(xm2+5,y-5,datos.tparentesco);
      doc.setFont('Helvetica', 'normal');
           doc.line(50,y,50,y+20);
           doc.line(583,y,583,y+20);
           doc.line(xm2,y,xm2,y+20);
           doc.line(xm1,y,xm1,y+20);
			y=y+20;
			doc.line(xm,y,xf,y);

			doc.text(xm+5,y-5,'Calle');
			doc.text(xm1+5,y-5,'Altura');
			doc.text(xm2+5,y-5,'Piso/dpto');
			y=y+25;
			doc.line(xm,y,xf,y);
      doc.setFont('Helvetica', 'bold');
			doc.text(xm+5,y-5,datos.tcalle);
			doc.text(xm1+5,y-5,datos.taltura);
			if(datos.tpiso!=''){
				if(datos.tdpto!=''){
					doc.text(xm2+5,y-5,datos.tpiso+'/'+datos.tdpto);
				}else{
					doc.text(xm2+5,y-5,datos.tpiso);
				}	
			}	
      doc.setFont('Helvetica', 'normal');
       doc.line(50,y,50,y+20);
           doc.line(583,y,583,y+20);
           doc.line(xm2,y,xm2,y+20);
           doc.line(xm1,y,xm1,y+20);
			y=y+20;
			doc.line(xm,y,xf,y);
			doc.text(xm+5,y-5,'Provincia');
			doc.text(xm1+5,y-5,'Localidad');
			doc.text(xm2+5,y-5,'CP');

			y=y+25;
			doc.line(xm,y,xf,y);
      doc.setFont('Helvetica', 'bold');
			doc.text(xm+5,y-5,datos.tprovincia);
			doc.text(xm1+5,y-5,datos.tlocalidad);
			doc.text(xm2+5,y-5,datos.tcp);
      doc.setFont('Helvetica', 'normal');
       doc.line(50,y,50,y+20);
           doc.line(583,y,583,y+20);
           doc.line(xm2,y,xm2,y+20);
           doc.line(xm1,y,xm1,y+20);
			y=y+20;
			doc.line(xm,y,xf,y);
			doc.text(xm+5,y-5,'Celular');
			
			doc.text(xm2+5,y-5,'Email');
			y=y+25;
			doc.line(xm,y,xf,y);

      doc.setFont('Helvetica', 'bold');
			doc.text(xm+5,y-5,datos.tcelular);
			
			doc.text(xm2+5,y-5,datos.temail);
      doc.setFont('Helvetica', 'normal');
			doc.setFontSize(12);
      doc.setFont(undefined, 'normal');
      y=y+25;
      var splitTitle2 = doc.splitTextToSize('En el caso de que el/la solicitante sea hijo menor o incapacitado y este representado por un tutor o curador, se deberán consignar los datos de este).-', 500);
      doc.text(x+5,y,splitTitle2,{maxWidth: 500, align: "justify"});
      y=y+40;
      
      doc.setFontSize(12);
      doc.setFont(undefined,'normal');
      var splitTitle22 = doc.splitTextToSize('Manifiesto en carácter de declaración jurada que el hijo menor de 25 años que estudia o es incapacitado, no percibe beneficio previcional ni realiza tareas remuneradas, es soltero y estaba a cargo del causante.-', 500);
      doc.text(x+5,y,splitTitle22,{maxWidth: 500, align: "justify"});
      y=y+40;
      doc.line(x,y,yf,y);
      y=y+20;
      var splitTitle222 = doc.splitTextToSize('En el caso de que hubiera un apoderado para trámite, adjunto del tutor o curador, se deberá anexar poder aparte donde titular, tutor o curador autoriza a tramitar.-', 500);
      doc.text(x+5,y,splitTitle222,{maxWidth: 500, align: "justify"});
      y=y+40;
			doc.line(x,y,yf,y);
			y=y+15;
			doc.setFont('Helvetica', 'bold');
			doc.text(x+5,y,'Observaciones :');
			doc.setFont('Helvetica', 'normal');
			y=y+15;
			var splitTitle = doc.splitTextToSize(datos.obsdatos, 550);
			doc.text(x+5,y,splitTitle);
			y=y+75;
				
			doc.addPage('letter','p');		
			doc.setLineWidth(1);
			//doc.roundedRect(x,yi,533,700,5,5);
      doc.setDrawColor(157, 158, 160);
			doc.setFont('Helvetica', 'normal');
			x=50;
			yi=20;
			y=80;
			yf=580;
			c=143;
			
			doc.text(x+5,y-5,'Completar solo si el causante era activo.-');
			doc.line(x,y,yf,y);
			y=y+20;
			var splitTitle3 = doc.splitTextToSize('Detalle cronológico de los servicios presentados por el causante desde los 18 años ', 565);
			doc.text(x+5,y-5,splitTitle3,{maxWidth: 565, align: "justify"});
			y=y+15;
			
			doc.autoTable({
		        html: '#tablaDetalle',
		        startY: y,
            margin: { left: 60 }, // Márgenes,
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

             y=finalY;
      
      y=y+15;
      doc.line(x,y,yf,y);
                doc.line(50,y,50,y+50);
                doc.line(580,y,580,y+50);
      doc.line(c+c+c+x,y,c+c+c+x,y+50);
      y=y+25;
      doc.text(x+5,y-5,'El causante trabajaba actualmente en otra actividad');
      doc.setFont('Helvetica', 'bold');
      doc.text(c+c+c+x+5,y-5,datos.causantetrabaja);
      doc.setFont('Helvetica', 'normal');
      doc.line(x,y,yf,y);
      y=y+25;
      doc.text(x+5,y-5,'Presenta reconocimiento de servicios');
      doc.setFont('Helvetica', 'bold');
      doc.text(c+c+c+x+5,y-5,datos.reconocimiento);
      doc.setFont('Helvetica', 'normal');
      doc.line(x,y,yf,y);
      y=y+25;
          }
		    })
		   
			
			doc.autoTable({
		        html: '#tablaServicios',
		        startY: y,
            margin: { left: 60 }, // Márgenes,
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
        y=finalY;
      
      
      y=y+25;

      doc.setFont('Helvetica','bold').text(x+5,y,'Observaciones :').setFont('Helvetica','normal');
      }
		    });
			
	
			
			x=50;
			yi=40;	
			doc.addPage('letter','p');		
			
			doc.setLineWidth(1);
			//doc.roundedRect(x,yi,533,700,5,5);
			y=80;
			yf=572+10;

			var texto='INFORMACION NECESARIA PARA EL/LA NUEVO/A PENSIONO/A';
			const textWidth = doc.getTextWidth(texto);
			var x2=(572-textWidth-40)/2;
			doc.setFont('Helvetica','bold').text(x+5+x2,y,texto).setFont('Helvetica','normal');
			
			y=y+20;
      doc.setFontSize(12);
			doc.text(x+5,y,'IAPOS');
			y=y+15;
       doc.setFontSize(10);
			var info2 = doc.splitTextToSize('Una vez obtenido el beneficio, deberá concurrir al sector IAPOS del Instituto Municipal, para realizar la REAFILIACIÓN a la Obra Social de lo contrario quedara sin cobertura de la misma.-', 520);
			doc.text(x+5,y,info2,{maxWidth: 520, align: "justify"});

			y=y+40;
      doc.setFontSize(12);
			doc.text(x+5,y,'IMPUESTO A LAS GANANCIAS');
			y=y+15;
       doc.setFontSize(10);
			var info3 = doc.splitTextToSize('Para el caso de que el haber previsional sufra retenciones de "impuesto a las ganancias", deberá presentar un F.572 WEB a través de la pagina de la AFIP (www.afip.gob.ar) ingresando con clave fiscal, dirigida al IMPSR como nuevo empleador (CUIT 30628014562).-', 5200)
			doc.text(x+5,y,info3,{maxWidth: 520, align: "justify"});

			y=y+50;
       doc.setFontSize(12);
			doc.text(x+5,y,'OTROS DESCUENTOS');
			y=y+15;
       doc.setFontSize(10);
			var info4 = doc.splitTextToSize('Si el causante estaba afiliado al Sindicato Municipal, ese descuento pasa automáticamente a la pensión. Deberá comunicar a las demas instituciones a las cuales estaba afiliado el causante, el cambio de carácter del beneficio, una vez que haya percibido el primer haber con el Número de Pensión correspondiente.-', 520);
			doc.text(x+5,y,info4,{maxWidth: 520, align: "justify"});

			y=y+50;
       doc.setFontSize(12);
			doc.text(x+5,y,'DEPÓSITO DEL HABER PREVISIONAL');
			y=y+15;
       doc.setFontSize(10);
			var info5 = doc.splitTextToSize('El depósito del Haber de pensión se realiza en una nueva caja de ahorro del Banco Municipal, que deberá aceptar el titular o apoderador una vez depositado el primer haber.-', 520);
			doc.text(x+5,y,info5,{maxWidth: 520, align: "justify"});

			y=y+40;
       doc.setFontSize(12);
			doc.text(x+5,y,'CO-TITULAR DE LA CAJA DE AHORRO BANCARIA');
			y=y+15;
       doc.setFontSize(10);
			var info5 = doc.splitTextToSize('Para que su apoderado sea tambien co-titular de su caja de ahorros bancaria debera solicitar en el Intituto la constancia de poder que luego deberá presentar en el Banco Municipal.-', 520);
			doc.text(x+5,y,info5,{maxWidth: 520, align: "justify"});
			y=y+40;
			doc.setFont('Helvetica', 'bold');
			doc.text(x+5,y,'En este mismo acto solicito se me abone el subsidio por fallecimiento correspondiente.-');
			doc.setFont('Helvetica', 'normal');
			y=y+35;
       doc.setFontSize(12);
			doc.text(x+5,y,'PRESENTACIÓN DE CERTIFICADOS ESCOLARES.');
			y=y+35;
       doc.setFontSize(10);
			var info5 = doc.splitTextToSize('La no presentación de certificados escolares, tanto sea de inicio como de finalización del ciclo lectivo, tendrá por consecuencia la baja o suspensión del beneficio. Los certificados deben ser enviados en tiempo y forma, en archivo adjunto, al mail prestaciones@impsr.gob.ar, consignando nombre y apellido del titular y número de beneficio.-', 520);
			doc.text(x+5,y,info5,{maxWidth: 520, align: "justify"});
			y=y+45;
			doc.line(x,y,yf,y);
			     // doc.line(50,y,50,y+210);
           // doc.line(578,y,578,y+210);
			doc.line(c+c+x,y,c+c+x,y+30);
			y=y+30;
			doc.text(x+5,y-15,'Firma del solicitante');
			doc.text(x+5,y-5,'(o representante, apoderado o tutor legal.)');
			doc.line(x,y,yf,y);
			doc.line(c+x,y,c+x,y+180);
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
			doc.text(c+c+x+5,y-30,'Aclaración y cargo');
			doc.text(c+c+x+5,y-10,'de quien certifica');
			y=y+60; 
			doc.line(x,y,yf,y);
			doc.text(x+5,y-30,'Firma de quien');
			doc.text(x+5,y-10,'recibe en el instituto');
			doc.text(c+c+x+5,y-30,'Firma de');
			doc.text(c+c+x+5,y-10,'Control');
			
			
			doc.setFontSize(9);
			y=y+10;
			doc.text(x+5,y,'Únicamente puede certificar funcionarios de este instituto, poder judicial, juez de paz, escribano, autoridades con enlaces.');		
					
			doc.save('declaracion2.pdf'); 
			
	}
	</script>
</body>
</html>
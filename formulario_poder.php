<?php include 'head.php'; ?>
<?php include 'header.php'; ?>
<?php include 'functions/connect.php';
global $con;
  $query="SELECT * FROM `nacionalidad`";
  $res=$con->query($query);
  $query="SELECT * FROM `parentesco`";
  $result=$con->query($query);
?>

<body>	
	<div class="container" id="recibo-haberes">
		<div class="titulo-pag mb-3">
		    <p>Formulario Poder</p>
	    </div>

        <form id="formDatos" role="form" class="form" method="post">
        	<div class="row mt-2">
          		<div class="col-12 col-sm-11 mb-2">
              		<div class="form-check">
                      <input class="form-check-input" type="radio" value="tramite1" name="tipo" id="tipotramite">
                      <label class="form-check-label" for="tipotramite">   

                       TRÁMITES EXCLUSIVAMENTE 
<p>Para que en su nombre y representación realice trámites en este Instituto relacionados con el beneficio previsional, y  sus derivaciones, hasta que el titular lo revoque por medio de telegrama o carta documento.El presente no permite percibir haberes , ni reajustes.</p>
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" value="representacion" name="tipo" id="tiporepre" checked>
                      <label class="form-check-label" for="tiporepre">
					   REPRESENTACIÓN PERMANENTE DEL BENEFICIARIO
<p>Para que en su nombre y representación realice trámites pertinentes a su beneficio previsional y perciba, hasta nueva orden, sus haberes, reajustes, asignaciones familiares y aguinaldos, devengados o/a devengarse por el sistema de pago que disponga el Instituto y firme los recibos y demás documentos que fuera menester, relevando al precitado Instituto, de las consecuencias de los actos de su apoderado.</p>
                      </label>
                    </div>
                </div>
                
                
          	</div>
          	<h2>Datos del beneficiario y/o solicitante.</h2>
          	<div class="row mt-2">
          		<div class="col-12 col-sm-6 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Apellido y Nombre completo</span>
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
                  <select type="text" class="form-control" name="nacionalidad" id="nacionalidad" required>
                    <option >Seleccione..</option>';
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
                  <select class="custom-select"  name="estadocivil" required>
                  	<option value="CASADO/A">CASADO/A</option>
                  	<option value="SOLTERO/A">SOLTERO/A</option>
                  	<option value="DIVORCIADO/A">DIVORCIADO/A</option>
                  	<option value="VIUDO/A">VIUDO/A</option>
                  </select>
                </div>
          	</div>
          	<div class="row">
          		<div class="col-12 col-sm-5 mb-2">    
                    <div class="input-group">
                    	<div class="input-group-prepend">
                    		<div class="input-group-text">
                      			<input type="checkbox" name="reside" checked value="1">
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
                <div class="input-group-prepend" >
                    <span class="input-group-text" >C.P.</span>
                  </div>
                  <select type="text" class="form-control" id="cp"  name="cp" required></select>
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
                  <input type="text" class="form-control" style="text-transform: uppercase;"  name="altura" required>
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
          	<div class="row">
          		<div class="col-12 col-sm-5 mb-2">    
          			<label>¿Tiene beneficio otorgado por este instituto?</label>
          			<div class="btn-group btn-group-toggle" data-toggle="buttons">
                    	<label class="btn btn-primary">
                        	<input type="radio" name="beneficio" onchange="verBeneficio(this)" value="1" > SI
                        </label>
                        <label class="btn btn-primary  active">
                        	<input type="radio" name="beneficio" onchange="verBeneficio(this)" value="0" checked> NO
                        </label>
                  	</div>
                	
                </div>
                
                <div class="col-12 col-sm-5 input-group mb-2 d-none" id="tipoBene">
          		  <div class="input-group-prepend">
                    <label class="input-group-text" for="beneficiotipo" >Tipo</label>
                  </div>
                  <select class="custom-select" id="beneficiotipo"  name="beneficiotipo">
                  	<option value="JUBILACION">JUBILACIÓN</option>
                  	<option value="PENSION">PENSIÓN</option>
                  </select>
                  <div class="col-12 col-sm-5 input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" >Nro</span>
                  </div>
                  <input type="text" class="form-control" name="beneficionro">
                </div>
                </div>
                
                <!-- <div class="col-12 col-sm-3 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Nro</span>
                  </div>
                  <input type="text" class="form-control" name="beneficionro">
                </div> -->
            </div>
          
          	<div class="row">
          		<div class="col-12 col-sm-6 mb-2">   
          			<label>¿Realiza o va a realizar trámite en este instituto?</label>
          			<div class="btn-group btn-group-toggle" data-toggle="buttons">
                    	<label class="btn btn-primary ">
                        	<input type="radio" name="tramite" onchange="verTramite(this)" value="1" > SI
                        </label>
                        <label class="btn btn-primary active">
                        	<input type="radio" name="tramite" onchange="verTramite(this)" value="0" checked> NO
                        </label>
                  	</div> 
                </div>
                
                <div class="col-12 col-sm-3 input-group mb-2 d-none" id="tipoTrami">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Tipo</span>
                  </div>
                  <select name="tramitetipo" class="custom-select">
                  	<option value="Jubilacion">JUBILACIÓN</option>
                  	<option value="Pension">PENSIÓN</option>
                  	<option value="Reconocimiento de servicio">RECONOCIMIENTO DE SERVICIO</option>
                  	<option value="Otro">OTRO TIPO</option>
                  </select>
                </div>
                <input type="hidden" class="form-control" name="tramitenro">
                
            </div>
            <hr>
            <h2>Datos del apoderado</h2>
            <div class="row mt-2">
          		<div class="col-12 col-sm-7 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Apellido y Nombre completo</span>
                  </div>
                  <input type="text" style="text-transform: uppercase;" class="form-control" name="apoderado" >
                </div>
                <div class="col-12 col-sm-5 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >DNI</span>
                  </div>
                  <input type="text" class="form-control" name="apoderadocuit">
                </div>
            </div>
          	<div class="row">
          		<div class="col-12 col-sm-4 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Nacionalidad</span>
                  </div>
                  <select type="text" class="form-control" name="apoderadonacionalidad" id="aponacionalidad">
                                <option >Seleccione..</option>';
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
                  <input type="date" class="form-control" name="apoderadofnac">
                </div>
                
                <div class="col-12 col-sm-5 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Parentesco o prof. habilitante</span>
                  </div>

                  <select type="text" class="form-control" name="apoderadoprof">
                       <option >Seleccione..</option>';
                    <?php 
                    foreach ($result as $value) {
                      echo '
                    <option value="'.$value["relacion"].'">'.$value["relacion"].'</option>';
                  }?></select>
                </div>
          	</div>
                <div class="row mt-2">
               <div class="col-12 col-sm-5 input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" >Provincia</span>
                  </div>
                  <select type="text" class="form-control" name="apoderadorprovincia" id="apoprovincia" ></select>
                </div>
                <div class="col-8 col-sm-5 input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" >Localidad</span>
                  </div>
                  <select type="text" class="form-control" name="apoderadolocalidad"id="apolocalidad"></select>
                </div>
               
                  <div class="col-4 col-sm-2 input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" >C.P.</span>
                  </div>
                  <select type="text" class="form-control" name="apoderadocp" id="apocp"></select>
                </div>
            </div>
          	<div class="row">
                <div class="col-7 col-sm-5 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Calle</span>
                  </div>
                  <input type="text" style="text-transform: uppercase;" class="form-control"  name="apoderadocalle">
                </div>
                <div class="col-5 col-sm-3 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Altura</span>
                  </div>
                  <input type="text" style="text-transform: uppercase;" class="form-control" name="apoderadoaltura">
                </div>
                <div class="col-6 col-sm-2 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Piso</span>
                  </div>
                  <input type="text" style="text-transform: uppercase;" class="form-control" name="apoderadopiso">
                </div>
                <div class="col-6 col-sm-2 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Dpto</span>
                  </div>
                  <input type="text" style="text-transform: uppercase;" class="form-control" name="apoderadodpto">
                </div>
          	</div>

          	<div class="row mt-2">

                <div class="col-6 col-sm-6 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Celular</span>
                  </div>
                  <input type="text" class="form-control" name="apoderadocelular">
                </div>
                <div class="col-12 col-sm-6 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >E-mail</span>
                  </div>
                  <input type="text" class="form-control" name="apoderadoemail" >
                </div>
                
          	</div>
          	
          	<div class="row">
          		<div class="col-12">
          			<div class="alert alert-warning" role="alert">Todos los datos consignados en este formulario revisten carácter de declaración jurada. Este formulario sólo será válido entregándolo por Mesa de Entradas, con firma certificada por funcionarios del I.M.P.S.R, poder judicial, juez de paz, escribano y autoridades con enlaces.</div>
          		</div>
          		
          	</div>
          	<div class="row mb-3">
          		<div class="col-12 col-sm-6">
          			<button type="submit" class="btn btn-primary">Guardar</button>
          		</div>
          		<div class="col-12">
          			<div id="mensaje"></div>
          		</div>
          	</div>
          	</form>
		
	</div>
	<?php include 'footer.php'; ?>
	<script src="js/jspdf.min.js"></script>

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

	const form=document.getElementById('formDatos');
	form.addEventListener('submit',guardarForm);
	const mensaje=document.getElementById('mensaje');

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
		xhr.open("POST", "functions/save-form.php", true);
		xhr.onload = function(e) {
		    if (this.status == 200) {
				var json=this.response;
				//mensaje.innerHTML=json.msg;
		        if(json.success){
		        	descargaPDF(json.datos);
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
	function descargaPDF(datos){
		console.log(datos);
		console.log(datos.nombre)
	//function imprimePresu(tabla,cliente,direccion,cuit,total,iva,totaliva,sub){
			let date = new Date()
			let day = ("0" + date.getDate()).slice(-2);
			let month = ("0" + (date.getMonth() + 1)).slice(-2);
			let year = date.getFullYear();
			var fecha=day+'/'+month+'/'+year;
			var doc = new jsPDF('p', 'pt', 'letter');  
			var htmlstring = '';  
			var tempVarToCheckPageHeight = 0;  
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
			var y = 40; 
      var x = 40 
			var img = new Image()
			img.src = 'logo_impsr.png'
		  doc.addImage(img, 'png',70 , y+4, 140,70 );
      doc.setDrawColor(157, 158, 160);
			doc.setLineWidth(0);
		    //doc.rect(290, 10, 30, 30);
			//doc.roundedRect(x,y,533,720,5,5); //cuadro principal
      doc.setLineWidth(1);
        doc.line(240,y,573,y); //primer h
        doc.line(573,y,573,y+130); //primer vc
        doc.line(x,y+90,x,y+130);//primer vc
			doc.line(240,y,240,y+90); //primer linea v
			doc.setFontSize(14);
			doc.setFontType('bold');
			doc.text(280,y+50,'PODER');  
			doc.line(380,y,380,y+90); // segunda linea v
			doc.setLineWidth(2); 
			doc.line(40,y+90,573,y+90);

			doc.setLineWidth(1); 
			doc.line(40,y+110,573,y+110);
			
			doc.setFontSize(11);
			doc.text(210,y+105,'Datos del beneficiario y/o solicitante');
			doc.setFontSize(10);
      const tipo = document.querySelector('input[name="tipo"]:checked').value;
        let trami1 = '';
        let repre = '';
        let repre1= '';
			if(tipo === 'tramite1'){
				 trami1='Trámites Exclusivamente ';
				 repre=' ';
         repre1='';
			}else{
			 trami1='  ';
				repre='Representación permanente'
        repre1='del beneficiario';
				}
			doc.text(410,y+45,trami1);
			doc.text(410,y+45,repre);
      doc.text(415,y+55,repre1);
			doc.setFontSize(11);
			doc.setFontType('normal');
			doc.text(230,y+125,'Apellido y Nombre Completo ');
      doc.line(40,y+130,573,y+130); //linea 3
			doc.setFontSize(10);		
      doc.setFontType('bold');
       var nombredni=datos.nombre + " " + datos.doc;
			doc.text(170,y+140,datos.nombre);
      doc.setFontType('normal');
			doc.setFontSize(11);
      y= 55 ;

			doc.line(40,y+135,573,y+135); //linea 3
        doc.line(573,y+135,573,y+155); //primer vc
        doc.line(x,y+135,x,y+155);//primer vc
						doc.text(45,y+150,'Fecha Nac ');
			doc.text(178,y+150,'Nacionalidad ');
			doc.text(311,y+150,'DNI');
			doc.text(445,y+150,'Estado civil ');
			doc.setFontType('bold');
			doc.setFontSize(10);
			
			doc.text(45,y+175,datos.fnac);
			doc.text(178,y+175,datos.nac);
			doc.text(311,y+175,datos.doc);
			doc.text(445,y+175,datos.estado);
      doc.setFontType('normal');
			doc.line(173,y+135,173,y+155); //primer linea v
			doc.line(306,y+135,306,y+155); //primer linea v
			doc.line(440,y+135,440,y+155); //primer linea v
			doc.line(40,y+155,573,y+155); //linea 4
			doc.line(40,y+180,573,y+180); //linea 5
			  doc.line(573,y+180,573,y+200); //primer vc
        doc.line(x,y+180,x,y+200);//primer vc
			doc.line(40,y+200,573,y+200); //linea 6
			doc.setFontSize(11);
			doc.text(155,y+195,'Domicilio Particular ');
			if(datos.reside==1){
				var reside='SI';
			}else{
				var reside='NO';
			}
      doc.line(405,y+180,405,y+200); //primer vc
			doc.text(411,y+195,'Reside en el país :'+reside);
	   y= 35;
      
    doc.setFontType('bold');
          const calle =datos.calle;
          const altura= datos.altura;
          const piso = datos.piso;
          const dpto = datos.dpto;


      // Concatena las variables horizontalmente
      const concatenatedData = `${calle} ${altura} ${piso} ${dpto}`;

      // Añade el texto concatenado al PDF
      doc.text(concatenatedData, 50,y+240);

			
			doc.setFontSize(10);
   

      doc.setFontType('normal');
		
			doc.line(40,y+220,573,y+220); //linea 7
			doc.line(40,y+245,573,y+245); //linea 8
        doc.line(573,y+245,573,y+265); //primer vc
        doc.line(x,y+245,x,y+265);//primer vc
			doc.line(40,y+265,573,y+265); //linea 7
			doc.line(40,y+290,573,y+290); //linea 8
			doc.line(235,y+245,235,y+265); //primer linea v
			doc.line(440,y+245,440,y+265); //primer linea v
			doc.setFontSize(11);
      doc.line(573,y+290,573,y+310); //primer vc
        doc.line(x,y+290,x,y+310);//primer vc
			doc.text(45,y+260,'Provincia');
			doc.text(240,y+260,'Localidad');
			doc.text(445,y+260,'CP');
			doc.setFontType('bold');
			doc.setFontSize(10);
			doc.text(45,y+285,datos.provincia);
			doc.text(240,y+285,datos.localidad);
			doc.text(445,y+285,datos.cp);
      doc.setFontType('normal');
			doc.line(40,y+310,573,y+310); //linea 9
			doc.line(40,y+335,573,y+335); //linea 10
			
			doc.line(295,y+290,295,y+310); //primer linea v
			doc.setFontSize(11);
			//doc.text(45,y+305,'Telefono');
			doc.text(45,y+305,'Celular');
			doc.text(305,y+305,'Correo electrónico');
			doc.setFontType('normal');
			doc.setFontSize(10);
      doc.setFontType('bold');
			//doc.text(45,y+330,datos.telefono);
			doc.text(50,y+330,datos.celular);
			doc.text(305,y+330,datos.email);
      doc.setFontType('normal');
      doc.setFillColor(255,255,255);  // Relleno amarillo
      // Dibujar un rectángulo como fondo del texto
      var f = 240;
      var u =395;
      var width = 332;
      var height = 25;

// Dibujar el cuadro con el color de relleno especificado
      doc.rect(f, u, width, height,'F');

      var f = 240;
      var u =440;
      var width = 332;
      var height = 25;

// Dibujar el cuadro con el color de relleno especificado
      doc.rect(f, u, width, height,'F');
        doc.line(573,y+335,573,y+355); //primer vc
        doc.line(x,y+335,x,y+355);//primer vc
			doc.line(40,y+355,573,y+355); //linea 11
			doc.line(40,y+380,573,y+380); //linea 12
			doc.line(240,y+335,240,y+355); //primer linea v
			doc.line(395,y+335,395,y+355); //primer linea v
			doc.setFontSize(11);
			doc.text(45,y+350,'Tiene un beneficio en este instituto?');
			doc.text(245,y+350,'Tipo Beneficio');
			doc.text(400,y+350,'Nro Beneficio');
    

// Dibujar el cuadro con el color de relleno especificado
     
      doc.setFontType('bold');
			doc.setFontSize(10);
			if(datos.beneficio.length>0){
				var bene='SI';}else{var bene='NO';}
			doc.text(45,y+375,bene);
			doc.text(245,y+375,datos.beneficio);
			doc.text(400,y+375,datos.beneficionro);
      doc.setFontType('normal');
        doc.line(573,y+380,573,y+400); //primer vc
        doc.line(x,y+380,x,y+400);//primer vc
			doc.line(40,y+400,573,y+400); //linea 13
			doc.line(40,y+425,573,y+425); //linea 14
			doc.line(240,y+380,240,y+400); //primer linea v
			doc.line(395,y+380,395,y+400); //primer linea v
			doc.setFontSize(11);
			doc.text(45,y+395,'Realizo o va a realizar un trámite?');
			doc.text(245,y+395,'Tipo');
			doc.text(400,y+395,'Nro Expediente');
			doc.setFontType('bold');
			doc.setFontSize(10);
			if(datos.tramite.length>0){
				var trami='SI';}else{var trami='NO';}
			doc.text(45,y+420,trami);
			doc.text(245,y+420,datos.tramite);
			doc.text(400,y+420,datos.tramitenro);
			doc.setFontType('normal');
      doc.setFillColor(157, 158, 160); 
      var f = 40;
      var u =y+425;
      var width = 533;
      var height = 5;

// Dibujar el cuadro con el color de relleno especificado
      //doc.rect(f, u, width, height,'F');
       doc.setDrawColor(157, 158, 160);
       doc.setLineWidth(2);
			doc.line(40,y+425,573,y+425); //linea 15
       doc.setDrawColor(157, 158, 160);
       y = y;
			doc.setLineWidth(1);  
			doc.line(40,y+445,573,y+445); //linea 16
      
			doc.setFontSize(11);
      doc.setFontType('bold');
			doc.text(240,y+440,'Datos del apoderado');
      doc.setLineWidth(1);  
      doc.setFontType('normal');

			doc.line(40,y+460,573,y+460); //linea 17
        doc.line(573,y+425,573,y+460); //primer vc
        doc.line(x,y+425,x,y+460);//primer vc
			doc.line(40,y+480,573,y+480); //linea 18
			doc.line(395,y+445,395,y+460); //primer linea v
			doc.text(45,y+457,'Apellido y Nombre completo');
			doc.text(400,y+457,'DNI');
			doc.setFontType('bold');
			doc.setFontSize(10);
			doc.text(45,y+475,datos.aponombre);
			doc.text(400,y+475,datos.apodoc);		
      doc.setFontType('normal');
        doc.line(573,y+480,573,y+495); //primer vc
        doc.line(x,y+480,x,y+495);//primer vc
			doc.line(40,y+495,573,y+495); //linea 7
			doc.line(40,y+515,573,y+515); //linea 8
			doc.line(235,y+480,235,y+495); //primer linea v
			doc.line(420,y+480,420,y+495); //primer linea v
			doc.setFontSize(11);
			doc.text(45,y+493,'Fecha nacimiento');
			doc.text(240,y+493,'Nacionalidad');
			doc.text(425,y+493,'Parentesco/título habilitante');
			doc.setFontType('bold');
			doc.setFontSize(10);
			doc.text(45,y+510,datos.apofnac);
			doc.text(240,y+510,datos.aponac);
			doc.text(425,y+510,datos.apoprof);
			doc.line(40,y+532,573,y+532); //linea 6
			doc.setFontType('normal');
			doc.setFontSize(11);
			doc.text(240,y+527,'Domicilio Real ');
			   doc.line(573,y+515,573,y+532); //primer vc
         doc.line(x,y+515,x,y+532);//primer vc
		
	  y= 30;
    doc.setFontType('bold');
		  const apocalle =datos.apocalle;
          const apoaltura= datos.apoaltura;
          const apopiso = datos.apopiso;
          const apodpto = datos.apodpto;


      // Concatena las variables horizontalmente
      const concatenatedData1 = `${apocalle} ${apoaltura} ${apopiso} ${apodpto}`;

      // Añade el texto concatenado al PDF
      doc.text(concatenatedData1, 50,y+550);

			
			doc.setFontSize(10);
	     y=y-10;
      doc.setFontType('normal');
			doc.line(40,y+565,573,y+565); //linea 8
         doc.line(573,y+565,573,y+579); //primer vc
         doc.line(x,y+565,x,y+579);//primer vc
      doc.line(40,y+580 ,573,y+580); //linea 9
			doc.line(40,y+600,573,y+600); //linea 10
			doc.line(235,y+565,235,y+580); //primer linea v
			doc.line(440,y+565,440,y+580); //primer linea v

			doc.setFontSize(11);
			doc.text(45,y+577,'Provincia');
			doc.text(240,y+577,'Localidad');
			doc.text(445,y+577,'CP');
			doc.setFontType('bold');
			doc.setFontSize(10);
			doc.text(45,y+590,datos.apoprovincia);
			doc.text(240,y+590,datos.apolocalidad);
			doc.text(445,y+590,datos.apocp);
     doc.setFontType('normal');
       y= 35-10;
			doc.line(40,y+612,573,y+612); //linea 9
			doc.setLineWidth(2); 
      doc.setDrawColor(157, 158, 160);
			doc.line(40,y+630,573,y+630); //linea 10
      doc.setDrawColor(157, 158, 160);
    
         doc.line(573,y+595,573,y+612); //primer vc
         doc.line(x,y+595,x,y+612);//primer vc
			doc.setLineWidth(1); 
    
		
			doc.line(295,y+595,295,y+612); //primer linea v

			doc.setFontSize(11);
			//doc.text(45,y+608,'Telefono');
			doc.text(45,y+608,'Celular');
			doc.text(300,y+608,'Correo electrónico');
			doc.setFontType('bold');
			doc.setFontSize(10);
			//doc.text(45,y+623,datos.apotelefono);
			doc.text(50,y+623,datos.apocelular);
			doc.text(305,y+623,datos.apoemail);
			 doc.setFontType('normal');
       
			doc.line(40,y+665,573,y+665); //linea 9
      
			doc.line(145,y+628,145,y+695); //primer linea v
			doc.line(305,y+628,305,y+695); //primer linea v
		  doc.line(410,y+628,410,y+695); //primer linea v
	    doc.line(40,y+695,573,y+695); //ulytima linea
			doc.setFontSize(9)
			doc.text(45,y+645,'Firma y aclaración');
			doc.text(45,y+655,'del representado');
			doc.text(310,y+645,'Firma y aclaración');
			doc.text(310,y+655,'del apoderado');
			doc.text(45,y+675,'Firma de');
			doc.text(45,y+685,'quién certifica');
			doc.text(310,y+675,'Aclaración y cargo');
			doc.text(310,y+685,'de quién certifica');
			
		doc.setFontSize(7);
			   if(tipo === 'tramite1'){
          var info1 = doc.splitTextToSize('Únicamente pueden certificar funcionarios del I.M.P.S.R, poder judicial, juez de paz, escribano y autoridades con enlaces.', 520);
        var info2 = doc.splitTextToSize('Para que en su nombre y representación realice trámites en este Instituto relacionados con el beneficio previsional, y  sus derivaciones, hasta que el titular lo revoque por medio de telegrama o carta documento.El presente no permite percibir haberes , ni reajustes', 520);
         var  info3 = doc.splitTextToSize('No siendo para más, se dió por finalizado el acto, firmando los comparecientes ante mí que certifico.',520);
       doc.text(x+5,730,info1,{maxWidth: 520, align: "justify"});
       doc.text(x+5,745,info2,{maxWidth: 520, align: "justify"});
       doc.text(x+5,770,info3,{maxWidth: 520, align: "justify"});
    
      }else{
        var info1 = doc.splitTextToSize('Únicamente pueden certificar funcionarios del I.M.P.S.R, poder judicial, juez de paz, escribano y autoridades con enlaces.', 520);
    var info2 = doc.splitTextToSize('Para que en su nombre y representación realice trámites pertinentes a su beneficio previsional y perciba, hasta nueva orden, sus haberes, reajustes, asignaciones familiares y aguinaldos, devengados o/a devengarse por el sistema de pago que disponga el Instituto y firme los recibos y demás documentos que fuera menester, relevando al precitado Instituto, de las consecuencias de los actos de su apoderado.',520);
    var  info3 = doc.splitTextToSize('No siendo para más, se dió por finalizado el acto, firmando los comparecientes ante mí que certifico.',520);
      doc.text(x+5,730,info1,{maxWidth: 520, align: "justify"});
      doc.text(x+5,745,info2,{maxWidth: 520, align: "justify"});
       doc.text(x+5,775,info3,{maxWidth: 520, align: "justify"});
        }
			    
				    doc.save('Formulario_Poder.pdf'); 
			
	}
	</script>
</body>
</html>
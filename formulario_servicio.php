<?php include 'head.php'; ?>
<?php include 'header.php'; ?>
<?php include 'functions/connect.php';

global $con;
  $query="SELECT * FROM `nacionalidad`";
  $res=$con->query($query);
?>


<style>
  #show {
    display: none;
  }
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
		    <p>Solicitud de Reconocimiento de Servicios</p>
	    </div>
	    
        <form id="formDatos" role="form" class="form" method="post">
        	<div class="row mt-2">
          		<div class="col-12 col-sm-6 mb-2">    
          			<label>TIPO</label>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" id="tipo1" name="tipo" value="1" >
                      <label class="form-check-label" for="tipo1">
                        A FINES ADMINISTRATIVOS
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" id="tipo2"  name="tipo" value="2">
                      <label class="form-check-label" for="tipo2">
                        A FINES JUBILATORIOS
                      </label>
                    </div>
					<div id="show" style="display: none; margin-left: 1rem; margin-top: 0.5rem">
						<div class="form-check">
						<input class="form-check-input" type="checkbox" id="tipo3"  name="tipo" value="3">
						<label class="form-check-label" for="tipo3">
							DEC/LEY 9316/46
						</label>
						</div>
						<div class="form-check">
						<input class="form-check-input" type="checkbox" id="tipo4"  name="tipo" value="4">
						<label class="form-check-label" for="tipo4">
							RESOLUCIÓN 363/81
						</label>
						</div>
					</div>
					<div class="row">
						<div class="col-7 col-sm-5 input-group mb-2" id="presentado" style="display: none;">
							<div class="input-group-prepend">
								<span class="input-group-text" >Para ser presentado ante caja o instituto: </span>
							</div>
							<input type="text" class="form-control" name="presentado" >
						</div>
					</div>
                </div>
                 
            </div>    
            <h2>Datos del solicitante(o causante)</h2>
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
                  <select type="text" class="form-control" name="nacionalidad" required id="nacionalidad"> <option >Seleccione..</option>';
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
                  <select type="text" class="form-control" required name="provincia" id="provincia"></select>
                </div>
                <div class="col-8 col-sm-5 input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" >Localidad</span>
                  </div>
                  <select type="text" class="form-control" required name="localidad"id="localidad"></select>
                </div>
             
                 <div class="col-4 col-sm-2 input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" >C.P.</span>
                  </div>
                  <select type="text" class="form-control" required name="cp" id="cp"></select>
                </div>
            </div>
            <div class="row">
                <div class="col-7 col-sm-5 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Calle</span>
                  </div>
                  <input type="text" style="text-transform: uppercase;" class="form-control" required name="calle">
                </div>
                <div class="col-5 col-sm-3 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Altura</span>
                  </div>
                  <input type="text" style="text-transform: uppercase;" class="form-control" required name="altura">
            	    </div>
                <div class="col-6 col-sm-2 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Piso</span>
                  </div>
                  <input type="text" style="text-transform: uppercase;" class="form-control" name="piso">
                </div>
                <div class="col-6 col-sm-2 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Dpto</span>
                  </div>
                  <input type="text" style="text-transform: uppercase;" class="form-control" name="dpto">
                </div>
          	</div>
 
            <div class="row mt-2">

                <div class="col-6 col-sm-4 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Celular</span>
                  </div>
                  <input type="text" class="form-control" name="celular">
                </div>
                <div class="col-12 col-sm-4 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >E-mail</span>
                  </div>
                  <input type="text" class="form-control" required name="email" >
                </div>
                
          	</div>
          	<hr>
          	<h2>Completar sólo en caso de ser solicitado para pensión (en otra Caja o Instituto con los datos de quien solicitará este beneficio)</h2>
          	<div class="row mt-2">
          		<div class="col-12 col-sm-6 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Apellido y Nombre completo</span>
                  </div>
                  <input type="text" style="text-transform: uppercase;" class="form-control" name="nombrep" >
                </div>
                <div class="col-12 col-sm-6 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >DNI</span>
                  </div>
                  <input type="text" class="form-control" name="cuitp" >
                </div>
          	</div>
          	<div class="row">
          		<div class="col-12 col-sm-6 mb-2">    
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="tipopension" id="exampleRadios1" value="matrimonio" >
                      <label class="form-check-label" for="exampleRadios1">
                        Matrimonio
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="tipopension" id="exampleRadios2" value="convivencia">
                      <label class="form-check-label" for="exampleRadios2">
                        Convivencia
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="tipopension" id="exampleRadios3" value="hijos">
                      <label class="form-check-label" for="exampleRadios3">
                        Hijos
                      </label>
                    </div>
                </div>

				<div class="row mt-2 col-12 py-3 ml-1">
					<p>En caso de solicitarlo para pensión deberá presentar partida de defunción y acreditar el vínculo con la partida o declaración pertinente</p>
				</div>
			
				<div style="display: block; width: 100%;">
					<hr>
					<h2 class="ml-3">Servicios</h2>
				</div>

				<div class="col-12 mt-2">
					<h6>DETALLE DE LOS SERVICIOS CON APORTES A ESTE INSTITUTO PRESENTADOS POR EL SOLICITANTE(O CAUSANTE EN EL CASO DE QUE EL TRÁMITE SEA PARA SOLICITAR PENSIÓN EN OTRA CAJA O INSTITUTO)</h6>
				</div>

				<div class="container mt-2">
	
    <table class="table table-bordered" id="tablaDetalle">
      <thead>
        <tr>
          <th>Especificar si trabajó en Municipalidad de Rosario entes o comunas adheridas</th>
          <th>Tarea o Cargo</th>
          <th>Desde</th>
          <th>Hasta</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td contenteditable="true" style="text-transform: uppercase;"></td>
          <td contenteditable="true" style="text-transform: uppercase;"></td>
          <td contenteditable="true" style="text-transform: uppercase;"></td>
          <td contenteditable="true" style="text-transform: uppercase;"></td>
        </tr>
      </tbody>
    </table>
				<div id="textarea-container" class="d-flex" style="flex-direction: column;">
					<label for="additional-content">Observaciones:</label>
					<textarea id="additional-content" name="obs" id="obs" class="form-control"></textarea>
				</div>
				</div>	

				<div class="mt-2 col-12">
					<p>Si correspondiera retirar el presente expediente para llevar a otra Caja o Instituto, sólo podrá hacerlo el titular o el apoderado en la Mesa de entrada una vez finalizado el trámite.</p>
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
	var tipoInput1 = document.getElementById("tipo1");
	var paragraph = document.getElementById("presentado");
	var tipo2Input = document.getElementById("tipo2");
	var additionalContent = document.getElementById("show");

	tipoInput1.addEventListener("click", function() {
		paragraph.style.display = "none";
		additionalContent.style.display = "none";
    });

	tipo2Input.addEventListener("change", function() {
        additionalContent.style.display = "block";
		paragraph.style.display = "flex";
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
		xhr.open("POST", "functions/save-form2.php", true);
		xhr.onload = function(e) {
		    if (this.status == 200) {
				var json=this.response;
				//mensaje.innerHTML=json.msg;
		        if(json.success){
		        	descargaPDF(json.datos);
		        }else{
		        	
			   	}
		    }
		};
		xhr.send(data);
		}else{
			return false;
		}
	}
	function descargaPDF(datos){
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
				top: 210,  
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
			img.src = 'logo_impsr.png'
      doc.setDrawColor(157, 158, 160);
		  doc.addImage(img, 'png', 60 ,y+4, 160,90 );
			doc.setLineWidth(1);
		  //doc.rect(290, 10, 30, 30);
			//doc.roundedRect(x,y,533,700,5,5); //cuadro principal
      doc.line(240,y,x+533,y); //primer linea h
			doc.line(240,y,240,150); //primer linea v
			doc.setFontSize(14);
      yo=y+25;
      doc.setFont('Helvetica', 'bold');
			doc.line(380,y,380,150); // segunda linea v
      doc.line(573,y,573,170); //terccer linea v
			y=y+15; //25
			doc.text(285,yo+10,'Solicitud ');
			
			y=y+15; //40
			doc.text(300,yo+35,'de');
			y=y+15;	//65
			doc.text(260,yo+50,'Reconocimiento');
			y=y+15; //70
			doc.text(270,yo+65,'de Servicios');
			y=y+5;  //75;
			
			//console.log('y '+y);
			doc.text(390,y-15,'ANTE CAJA O INSTITUTO');
			doc.text(390,y+5,datos.presentado);
			
			
			
			doc.setFontSize(10);
		
			switch(datos.tipo){
				case '1':
				doc.text(390,y+20,'A FINES ADMINISTRATIVOS');
				break;
				case '2':
					doc.text(390,y+20,'A FINES');
					break;
				case '3':
					doc.text(390,y+20,'DEC/LEY 9316/46');
					break;
				case '4':
					doc.text(390,y+20,'Ordenanza 363/81');
					break;
			}
			
			doc.setFontSize(12);
			
			doc.setFontSize(12);
			var yy=105;
		
			var nombre=datos.nombre;
      doc.line(40,yy+45,573,yy+45); //linea 3
      doc.setFont('Helvetica', 'normal');
      doc.text(230,yy+60,' Apellido y Nombre Completo : ');
      doc.setFont('Helvetica', 'bold');
      doc.text(210,yy+80,''+nombre);
	    doc.setFont('Helvetica', 'normal');
            doc.line(40,yy+45,40,yy+65)   ; //1 linea tra
			   doc.line(40,yy+65,573,yy+65);

         yy=120;
              doc.line(40,yy+70,40,yy+90);
              doc.line(573,yy+70,573,yy+90);
         doc.line(40,yy+70,573,yy+70);
			doc.text(45,yy+85,'Fecha Nac ');
			doc.text(178,yy+85,'Nacionalidad ');
			doc.text(311,yy+85,'CUIL ');
			doc.text(445,yy+85,'Estado civil ');
      doc.setFont('Helvetica', 'bold');
			doc.text(45,yy+105,datos.fnac);
			doc.text(178,yy+105,datos.nac);
			doc.text(311,yy+105,datos.doc);
			doc.text(445,yy+105,datos.estado);
      doc.setFont('Helvetica', 'normal');
			doc.line(173,yy+70,173,yy+90); //primer linea v
			doc.line(306,yy+70,306,yy+90); //primer linea v
			doc.line(440,yy+70,440,yy+90); //primer linea v
			doc.line(40,yy+90,573,yy+90); //linea 4
			doc.line(40,yy+110,573,yy+110); //linea 5
         doc.line(40,yy+110,40,yy+130)   ; //linea trans
         doc.line(573,yy+110,573,yy+130)   ; //linea trans
			
			
			doc.text(185,yy+125,'Domicilio Particular ');
      doc.line(40,yy+130,573,yy+130); //linea 6
			if(datos.reside==1){
				var reside='SI';
			}else{
				var reside='NO';
			}
			doc.text(411,yy+125,'Reside en el país :'+reside);
			doc.line(408,yy+110,408,yy+130); //primer linea v
      doc.setFont('Helvetica', 'bold');
			doc.text(45,yy+145,datos.calle);
			doc.text(178,yy+145,datos.altura);
			doc.text(311,yy+145,datos.piso);
			doc.text(445,yy+145,datos.dpto);
      doc.setFont('Helvetica', 'normal');
  yy=100;
         doc.line(40,yy+170,40,yy+190) ; //linea trans
         doc.line(573,yy+170,573,yy+190) ; //linea trans
			doc.line(40,yy+170,573,yy+170); //linea 8

			doc.line(40,yy+190,573,yy+190); //linea 7
			doc.line(40,yy+210,573,yy+210); //linea 8
			doc.line(230,yy+170,230,yy+190); //primer linea v
			doc.line(440,yy+170,440,yy+190); //primer linea v
			doc.text(45,yy+185,'Provincia');
			doc.text(240,yy+185,'Localidad');
			doc.text(445,yy+185,'CP');
      doc.setFont('Helvetica', 'bold');
			doc.text(45,yy+205,datos.provincia);
			doc.text(240,yy+205,datos.localidad);
			doc.text(445,yy+205,datos.cp);
      doc.setFont('Helvetica', 'normal');
         doc.line(40,yy+210,40,yy+230) ; //linea trans
         doc.line(573,yy+210,573,yy+230) ; //linea trans
			doc.line(40,yy+230,573,yy+230); //linea 9
			//doc.line(40,yy+260,573,yy+260); //linea 10
		
			doc.line(295,yy+210,295,yy+230); //primer linea v
			//doc.text(45,yy+225,'Telefono');
			doc.text(45,yy+225,'Celular');
			doc.text(300,yy+225,'Correo electrónico');
      doc.setFont('Helvetica', 'bold');
			//doc.text(45,yy+245,datos.telefono);
			doc.text(50,yy+245,datos.celular);
			doc.text(305,yy+245,datos.email);
      doc.setFont('Helvetica', 'normal');
       doc.setLineWidth(2);
			doc.line(40,yy+250,573,yy+250); //linea 11
doc.setLineWidth(1);
			doc.line(40,yy+290,573,yy+290); //linea 12
      
      doc.setDrawColor(169, 169, 169);
      //doc.line(40,yy+255,573,yy+255); //linea 11
			 
			//doc.line(240,340,240,385); //primer linea v
			//doc.line(395,340,395,385); //primer linea v
       doc.setDrawColor(157, 158, 160);

			doc.text(45,yy+280,'Completar sólo en caso de ser solicitado para pensión en otro organismo');
			
			doc.line(40,yy+310,573,yy+310); //linea 13
			doc.line(40,yy+330,573,yy+330); //linea 14
			//doc.line(240,385,240,430); //primer linea v
         doc.line(40,yy+290,40,yy+310) ; //linea trans
         doc.line(573,yy+290,573,yy+310) ; //linea trans
			doc.line(395,yy+290,395,yy+310); //primer linea v
			doc.text(45,yy+305,'Apellido y Nombre completo');
			//doc.text(245,400,'Tipo');
			doc.text(400,yy+305,'CUIL');
			doc.setFont('Helvetica', 'bold');
			doc.text(45,yy+325,datos.pensionnombre);
			//doc.text(245,425,'');
			doc.text(400,yy+325,datos.pensioncuit);
      doc.setFont('Helvetica', 'normal');
			doc.setLineWidth(1);
			doc.line(40,yy+430,573,yy+430); //linea 15
			//doc.line(240,yy+330,240,yy+430); //primer linea v
			//doc.line(395,430,395,455); //primer linea v
			if(datos.pensiontipo=='matrimonio'){var convi=' '; var matri=' X ';var hijos='';	}
			else if(datos.pensiontipo=='convivencia'){var convi=' X '; var matri=' ';var hijos='';	}
			else if(datos.pensiontipo=='hijos'){var convi=' '; var matri=' ';var hijos=' X ';	}else{
				var convi=' '; var matri=' ';var hijos='';	}
        doc.setFont('Helvetica', 'bold');
        const side=8;
      doc.rect(130,yy+355,side,side);
      if(datos.pensiontipo == 'matrimonio'){
      doc.text(127,yy+362,matri)
      }
			doc.text(45,yy+365,'Matrimonio:');

      doc.rect(130,yy+370,side,side);
      if(datos.pensiontipo == 'convivencia'){
      doc.text(127,yy+377,convi)
      }
			doc.text(45,yy+380,'Convivencia:');

      doc.rect(130,yy+385,side,side);
       if(datos.pensiontipo == 'hijos'){
      doc.text(127,yy+392,hijos)
      }
			doc.text(45,yy+395,'Hijos: ');
      doc.setFont('Helvetica', 'normal');




			x=40;
			y=40;	
			doc.addPage();		
			doc.setLineWidth(1);
			//doc.roundedRect(x,y,533,700,5,5);
			y=35;
      var nombredni=datos.nombre + " " + datos.doc;
       doc.setFont('Helvetica', 'bold');
      doc.text(45,y+5,nombredni);
      doc.setFont('Helvetica', 'normal');
			doc.text(45,y+20,'DETALLE DE LOS SERVICIOS CON APORTES A ESTE INSTITUTO PRESENTADOS POR EL');
			doc.text(45,y+40,'SOLICITANTE(O CAUSANTE EN EL CASO DE QUE EL TRÁMITE SEA PARA SOLICITAR');
			doc.text(45,y+60,'PARA SOLICITAR PENSIÓN EN OTRA CAJA O INSTITUTO)');
			doc.line(40,y+70,573,y+70);
			
		    doc.autoTable({
		        html: '#tablaDetalle',
		        startY: y+70,
		        theme: 'grid',
		        bodyStyles: {fontSize: 10},
		        headStyles:{fillColor:'#143c5e',textColor:'#fff'},
		        styles: {overflow: 'linebreak',
	                fontSize: 12,fontWeight:'bold',textColor: '#000',lineColor: '#000',lineWidth:1},

        didDrawPage: function (data) {
        var finalY = data.cursor.y; // Obtener la posición final en Y
        doc.setFont('Helvetica', 'bold');
        doc.text(45,finalY+20,'Observaciones :');  
        doc.setFont('Helvetica', 'normal');   
        var splitTitle = doc.splitTextToSize(datos.obs, 500);
        doc.text(45,finalY+65,splitTitle);
    }
		    })

			y=y+450;
			doc.line(40,y,573,y);

			doc.text(45,y+20,'Si correspondiera retirar el presente expediente para llevar a otra Caja o Instituto, sólo podrá ');
			doc.text(45,y+35,'hacerlo el titular o el apoderado en la Mesa de entrada una vez finalizado el trámite.');
	

			doc.line(40,540,573,540);

        doc.setLineWidth(2);
     doc.line(40,595,573,595);

     doc.setLineWidth(1); 
         //doc.line(40,595,40,645);
          doc.line(270,595,270,645);
          doc.line(335,595,335,645);
          doc.line(145,595,145,645);
          doc.line(440,595,440,645);
          doc.line(440,625,573,625);
         //doc.line(573,595,573,645);
		  doc.line(40,645,573,645); 
          
			doc.line(40,683,573,683);

			//doc.line(200,575,200,575);
			
			doc.text(50,610,'Firma del');
      doc.text(50,620,'solicitante');
      doc.text(50,630,'representante o');
      doc.text(50,640,'apoderado');
			doc.text(275,625,'Aclaración');
			doc.text(465,640,'Lugar y fecha');
			

        // doc.line(40,645,40,720);//line1
        // doc.line(573,645,573,720);//line2
			doc.line(145,645,145,720);
			doc.line(305,645,305,720);
			doc.line(410,645,410,720);
			doc.text(45,665,'Firma de ');
			doc.text(45,675,'quién certifica');
			doc.text(310,665,'Aclaracion y cargo');
			doc.text(310,675,'de quién certifica');
			doc.text(45,695,'Firma de quién');
			doc.text(45,705,'recibe en el');
			doc.text(45,715,'instituto');
			doc.text(310,705,'Firma');
			doc.text(310,715,'de control');
      doc.line(40,720,573,720);
			doc.setFontSize(9);
			doc.text(55,735,'Únicamente puede certificar funcionarios de este instituto,poder judicial, juez de paz, escribano, autoridades con enlaces.');		
					
			doc.save('Formulario_reconocimiento_servicio.pdf');  
			
	}
	
	
	</script>
</body>
</html>
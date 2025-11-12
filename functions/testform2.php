<?php include 'head.php'; ?>
<?php include 'header.php'; ?>
<?php include 'functions/connect.php';


?>

<body>	
	<div class="container" id="recibo-haberes">
		<div class="titulo-pag mb-3">
		    <p>Solicitud de reconocimiento de servicios</p>
	    </div>
	    
        <form id="formDatos" role="form" class="form" method="post">
        	
          	<div class="row mt-2">
          		<div class="col-12 col-sm-6 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Nombre completo</span>
                  </div>
                  <input type="text" class="form-control" name="nombre" required>
                </div>
                <div class="col-12 col-sm-6 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >CUIT/DNI</span>
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
                  <input type="text" class="form-control" name="nacionalidad" required>
                </div>
                <div class="col-12 col-sm-4 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Estado Civil</span>
                  </div>
                  <select class="custom-select"  name="estadocivil" required>
                  	<option value="Casado/a">Casado/a</option>
                  	<option value="Soltero/a">Soltero/a</option>
                  	<option value="Divorciado/a">Divorciado/a</option>
                  	<option value="Viudo/a">Viudo/a</option>
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
                        	<span class="input-group-text" >Reside en el pais</span>
                      	</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-7 col-sm-5 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Calle</span>
                  </div>
                  <input type="text" class="form-control" required name="calle">
                </div>
                <div class="col-5 col-sm-3 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Altura</span>
                  </div>
                  <input type="text" class="form-control" required name="altura">
                </div>
                <div class="col-6 col-sm-2 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Piso</span>
                  </div>
                  <input type="text" class="form-control" name="piso">
                </div>
                <div class="col-6 col-sm-2 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Dpto</span>
                  </div>
                  <input type="text" class="form-control" name="dpto">
                </div>
          	</div>
          	<div class="row mt-2">
          		<div class="col-4 col-sm-2 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >C.P.</span>
                  </div>
                  <input type="text" class="form-control" required name="cp" >
                </div>
                <div class="col-8 col-sm-5 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Localidad</span>
                  </div>
                  <input type="text" class="form-control" required name="localidad">
                </div>
                <div class="col-12 col-sm-5 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Provincia</span>
                  </div>
                  <input type="text" class="form-control" required name="provincia" >
                </div>
            </div>
            <div class="row mt-2">
          		<div class="col-6 col-sm-4 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Telefono</span>
                  </div>
                  <input type="text" class="form-control" name="telefono" >
                </div>
                <div class="col-6 col-sm-4 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Celular</span>
                  </div>
                  <input type="text" class="form-control" required name="celular">
                </div>
                <div class="col-12 col-sm-4 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >E-mail</span>
                  </div>
                  <input type="text" class="form-control" required name="email" >
                </div>
                
          	</div>
          	<hr>
          	<h2>Completar solo en caso de ser solicitado para pension</h2>
          	<div class="row mt-2">
          		<div class="col-12 col-sm-6 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Nombre completo</span>
                  </div>
                  <input type="text" class="form-control" name="nombrep" >
                </div>
                <div class="col-12 col-sm-6 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >CUIT/DNI</span>
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
                
                <div class="col-12 col-sm-6 mb-2">
          		  <p>Debera presentar partida de .... y acreditar el vinculo con la persona....</p>
                </div>
                
            </div>
          	
            
          	
          	<div class="row">
          		<div class="col-12">
          			<div class="alert alert-warning" role="alert">Todos los datos consignados en este formulario revisten caracter de declaración jurada</div>
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
	const form=document.getElementById('formDatos');
	form.addEventListener('submit',guardarForm);
	const mensaje=document.getElementById('mensaje');

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
			var y = 125;  
			var img = new Image()
			img.src = 'logo_impsr.png'
			doc.addImage(img, 'png',95 , 15, 95,75 );
			doc.setLineWidth(2);
		    //doc.rect(290, 10, 30, 30);
			doc.roundedRect(40,10,533,755,5,5); //cuadro principal
			doc.line(240,10,240,110); //primer linea v
			doc.setFontSize(14);
			doc.text(285,25,'Solicitud ');
			doc.text(300,40,'de');
			doc.text(260,55,'Reconocimiento');
			doc.text(270,70,'de Servicios');  
			doc.line(240,75,380,75);
			doc.line(380,10,380,110); // segunda linea v
			doc.line(40,110,573,110);
			doc.text(285,100,'PODER');
			//if(datos.tipo=='tramite'){
			//	var trami=' X ';
			//	var repre=' ';
			//}else{
			//	var trami='  ';
			//	var repre=' X ';
			//	}
			//doc.text(385,35,'Solo tramite '+trami);
			//doc.text(385,55,'Representacion '+repre);
			doc.setFontSize(12);
			doc.text(50,130,'Nombre Completo : '+datos.nombre);

			doc.line(40,140,573,140); //linea 3
			doc.text(45,155,'Fecha Nac ');
			doc.text(178,155,'Nacionalidad ');
			doc.text(311,155,'DNI/CUIT ');
			doc.text(445,155,'Estado civil ');
			doc.text(45,180,datos.fnac);
			doc.text(178,180,datos.nac);
			doc.text(311,180,datos.doc);
			doc.text(445,180,datos.estado);
			doc.line(173,140,173,185); //primer linea v
			doc.line(306,140,306,185); //primer linea v
			doc.line(440,140,440,185); //primer linea v
			doc.line(40,160,573,160); //linea 4
			doc.line(40,185,573,185); //linea 5
			
			doc.line(40,205,573,205); //linea 6
			doc.text(45,200,'Domicilio Particular ');
			if(datos.reside==1){
				var reside='SI';
			}else{
				var reside='NO';
			}
			doc.text(311,200,'Reside en el pais :'+reside);
			doc.line(306,185,306,205); //primer linea v

			doc.text(45,220,'Calle');
			doc.text(178,220,'Altura ');
			doc.text(311,220,'Piso');
			doc.text(445,220,'Dpto');
			doc.text(45,245,datos.calle);
			doc.text(178,245,datos.altura);
			doc.text(311,245,datos.piso);
			doc.text(445,245,datos.dpto);
			doc.line(173,205,173,250); //primer linea v
			doc.line(306,205,306,250); //primer linea v
			doc.line(440,205,440,250); //primer linea v
			doc.line(40,225,573,225); //linea 7
			doc.line(40,250,573,250); //linea 8

			doc.line(40,270,573,270); //linea 7
			doc.line(40,295,573,295); //linea 8
			doc.line(235,250,235,295); //primer linea v
			doc.line(440,250,440,295); //primer linea v
			doc.text(45,265,'Localidad');
			doc.text(240,265,'Provincia');
			doc.text(445,265,'CP');
			doc.text(45,290,datos.localidad);
			doc.text(240,290,datos.provincia);
			doc.text(445,290,datos.cp);

			doc.line(40,315,573,315); //linea 9
			doc.line(40,340,573,340); //linea 10
			doc.line(217,295,217,340); //primer linea v
			doc.line(395,295,395,340); //primer linea v
			doc.text(45,310,'Telefono');
			doc.text(222,310,'Celular');
			doc.text(400,310,'Correo electronico');
			doc.text(45,335,datos.telefono);
			doc.text(222,335,datos.celular);
			doc.text(400,335,datos.email);

			doc.line(40,360,573,360); //linea 11
			doc.line(40,385,573,385); //linea 12
			
			//doc.line(240,340,240,385); //primer linea v
			//doc.line(395,340,395,385); //primer linea v
			doc.text(45,375,'Completar solo en caso de ser solicitado para pensionado');
			
			doc.line(40,405,573,405); //linea 13
			doc.line(40,430,573,430); //linea 14
			//doc.line(240,385,240,430); //primer linea v
			doc.line(395,385,395,430); //primer linea v
			doc.text(45,400,'Nombre completo');
			//doc.text(245,400,'Tipo');
			doc.text(400,400,'CUIT');
			
			doc.text(45,425,datos.pensionnombre);
			//doc.text(245,425,'');
			doc.text(400,425,datos.pensioncuit);

			doc.line(40,455,573,455); //linea 15
			doc.line(240,430,240,455); //primer linea v
			doc.line(395,430,395,455); //primer linea v
			if(datos.pensiontipo=='matrimonio'){var convi=' '; var matri=' X ';var hijos='';	}
			else if(datos.pensiontipo=='convivencia'){var convi=' X '; var matri=' ';var hijos='';	}
			else if(datos.pensiontipo=='hijos'){var convi=' '; var matri=' ';var hijos=' X ';	}else{
				var convi=' '; var matri=' ';var hijos='';	}
			doc.text(45,450,'Matrimonio '+matri);
			doc.text(245,450,'Convivencia '+convi);
			doc.text(400,450,'Hijos '+hijos);
			  
						
			
			
			doc.setFontSize(10);
			doc.text(45,780,'Unicamente puede certificar funcionarios de este instituto,poder judicial, juez de paz, escribano, autoridades con enlaces.');		
					
					
					
				    
				    
				    doc.save('declaracion2.pdf'); 
			
	}
	</script>
</body>
</html>
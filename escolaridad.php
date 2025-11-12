<?php include 'head.php'; ?>
<?php include 'header.php'; ?>
<?php include 'functions/connect.php';


?>

<style>
  #show{
    display: none;
  }
  #primaria{
    display: none;
  }
  #secundaria{
    display: none;
  }
   #fecha_abandono{
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
  .checkbox-container {
  display: flex;
  align-items: center;
  margin-bottom: 10px; /* Ajusta la distancia vertical entre cada checkbox */
}

.checkbox-container-esp input[type="checkbox"] {
  margin-left: 152px;
  /* Ajusta la distancia horizontal entre el checkbox y el label */
}
.checkbox-container-check input[type="checkbox"] {
  margin-left:20px;

  /* Ajusta la distancia horizontal entre el checkbox y el label */
}
.checkbox-container input[type="checkbox"] {
  margin-left: 136px;
  /* Ajusta la distancia horizontal entre el checkbox y el label */
}
.checkbox-container-1 input[type="checkbox"] {
  margin-left: 56px;
  margin-bottom:   15px;  /* Ajusta la distancia horizontal entre el checkbox y el label */
}
.checkbox-container2-1 input[type="checkbox"] {
  margin-left: 75px; /* Ajusta la distancia horizontal entre el checkbox y el label */
}
.checkbox-container3-1 input[type="checkbox"] {
  margin-left: 50px; /* Ajusta la distancia horizontal entre el checkbox y el label */
}
.checkbox-container2 input[type="checkbox"] {
  margin-left: 73px; /* Ajusta la distancia horizontal entre el checkbox y el label */
}
.checkbox-container2-2-1 input[type="checkbox"] {
  margin-left: 153px; /* Ajusta la distancia horizontal entre el checkbox y el label */
}
.checkbox-container2-2-2 input[type="checkbox"] {
  margin-left: 134px; /* Ajusta la distancia horizontal entre el checkbox y el label */
}
.checkbox-container2-1-1 input[type="checkbox"] {
  margin-left: 2px; /* Ajusta la distancia horizontal entre el checkbox y el label */
}
.checkbox-container3 input[type="checkbox"] {
  margin-left:125px; /* Ajusta la distancia horizontal entre el checkbox y el label */
}
.checkbox-container4 input[type="checkbox"] {
  margin-left: 105px; /* Ajusta la distancia horizontal entre el checkbox y el label */
}
.checkbox-container4-2-1 input[type="checkbox"] {
  margin-left: 101px; /* Ajusta la distancia horizontal entre el checkbox y el label */
}
.checkbox-container4-2-2 input[type="checkbox"] {
  margin-left: 80px; /* Ajusta la distancia horizontal entre el checkbox y el label */
}
.checkbox-container4-1 input[type="checkbox"] {
  margin-left: 148px; /* Ajusta la distancia horizontal entre el checkbox y el label */
}
.checkbox-container4-2 input[type="checkbox"] {
  margin-left: 119px; /* Ajusta la distancia horizontal entre el checkbox y el label */
}
.checkbox-container5 input[type="checkbox"] {
  margin-left: 37px; 
  margin-bottom:15px;/* Ajusta la distancia horizontal entre el checkbox y el label */
}
  </style>

<body>	
	<div class="container" id="recibo-haberes">
		<div class="titulo-pag mb-3">
		    <p>Certificado de Escolaridad</p>
	    </div>
	    
        <form id="formDatos" role="form" class="form" method="post">
                            <hr>
            <h2>Datos del Beneficiario</h2>
             <hr>
            <div class="row mt-2">
              <div class="col-12 col-sm-4 input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" >DNI</span>
                  </div>
                  <input type="text" class="form-control" name="dni" id="dni" >
                </div>
                <div class="col-12 col-sm-8 input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text"  style="text-transform: uppercase;" style="text-transform: uppercase;" >APELLIDO(S) Y NOMBRE(S)  </span>
                  </div>
                  <input type="text" style="text-transform: uppercase;" class="form-control" name="nombre_beneficiario" id="nombre_beneficiario">
                </div>
            </div>
            <div class="row mt-2">
              <div class="col-6 col-sm-6 input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" >N° BENEFICIARIO/A</span>
                  </div>
                    <input type="text" class="form-control" name="numero_beneficiario">
       </div>
                     <div class="col-6 col-sm-6 input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" >EMAIL</span>
                  </div>
                  <input type="email" class="form-control" name="email">
                </div>
            </div>
          	            <hr>
                        <p>Para ser completado por la institución</p>
            <h2>Datos del Alumno</h2>
             <hr>
            <div class="row mt-2">
          		<div class="col-12 col-sm-4 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >CUIL</span>
                  </div>
                  <input type="text" class="form-control" name="cuil" id="cuil" >
                </div>
                <div class="col-12 col-sm-8 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >APELLIDO(S) Y NOMBRE(S)</span>
                  </div>
                  <input type="text" style="text-transform: uppercase;" class="form-control" name="nombre" id="nombre">
                </div>
            </div>
          	<div class="row mt-2">
          		<div class="col-12 col-sm-4 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >TELÉFONO</span>
                  </div>
                    <input type="text" class="form-control" name="telefono">
                </div>
           
                <div class="col-12 col-sm-4 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >FECHA NAC</span>
                  </div>
                  <input type="date" class="form-control" name="fecha_nac">
                </div>
          	</div>
          	<div class="row mt-2">
       <div class="col-12 col-sm-12 input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" >DOMICILIO DE CONTACTO</span>
                  </div>
                  <input type="text" class="form-control" name="domicilio">
                </div>
            </div>

     
             <hr>
               <div class="row mt-2">
              <div class="col-4 col-sm-4 input-group mb-2">
               
              <h2>Datos de Escolaridad</h2>
          
             </div>
         

              <div class="col-4 col-sm-4 input-group mb-2">
               <div class="form-check checkbox-container-check ">
                       <label class="form-check-label " for="exampleRadios1">
                       <strong>Inicio ciclo lectivo</strong>
                      </label>
                     <input type="checkbox" name="ciclo" id="ciclo" value="inicio">
                    </div>

              </div>
              <div class="col-4 col-sm-4 input-group mb-2">
                <div class="form-check checkbox-container-check ">
                       <label class="form-check-label " for="exampleRadios1">
                       <strong>Finalización del ciclo lectivo</strong>
                      </label>
                     <input type="checkbox" name="ciclo" id="ciclo" value="fin">
                    </div>

              </div>
            </div>
          <hr>
       
          <div class="row mt-2">
              <div class="col-3 col-sm-3 input-group mb-2">
             <div class="input-group-prepend">
                    <span class="input-group-text" >CICLO LECTIVO</span>
           </div>
            <input type="text" class="form-control" name="ciclo_lectivo">
          </div>
              <div class="col-3 col-sm-3 input-group mb-2">
                <div class="form-check checkbox-container-check ">
                  <label class="text-center">Tildar lo que corresponda</label>
                </div>
              </div>
           
                <div class="col-3 col-sm-3 input-group mb-2">
                       <label style="margin-right: 10px;" class="form-check-label " for="exampleRadios1">
                       <strong>Abandono</strong>
                      </label>
                     <input style="margin-top: -10px;" type="checkbox" name="estado" id="estados" value="abandono">
                      <label   style="margin-left: 10px;margin-right: 10px;" class="form-check-label " for="exampleRadios1">
                       <strong>Libre</strong>
                      </label>
                     <input style="margin-top: -10px;" type="checkbox" name="estado" id="estado" value="libre">
              </div>

             
          <div id="fecha_abandono" class="col-3 col-sm-3 input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" >FECHA</span>
                  </div>
                  <input style="width: 100px;margin-top: -40px;margin-left: 70px;" type="date" class="form-control" name="fecha_estado">
          </div>
        </div>
          <hr>
            <h2><strong>Datos de la escuela/Instituto/Universidad/Escuela diferencial</strong></h2>
             <hr>
          <div class="row mt-2">
              <div class="col-8 col-sm-8 input-group mb-2">
             <div class="input-group-prepend">
                    <span class="input-group-text" >Nombre del establecimiento educativo</span>
           </div>
            <input type="text" style="text-transform: uppercase;" class="form-control" name="nombre_establecimiento">
          </div>
        </div>
        <div class="row mt-2">
            <div class="col-12 col-sm-5 input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" >Fecha emisión del certificado</span>
                  </div>
                  <input type="date" class="form-control" name="fecha_emision">
            </div>
          </div>
          <hr>
    <div class="row mt-2">
          <label class="form-check-label " for="exampleRadios1"><strong>Tipo de certificado</strong>(seleccionar el que corresponda):</label>             
     </div>
               <hr>
         
 <div class="row mt-2">
          <div class="col-4 col-sm-4 mb-2">    
                    <div class="form-check checkbox-container ">
                       <label class="form-check-label " for="exampleRadios1">
                       <strong>Escolar</strong>
                      </label>
                     <input type="checkbox" name="escolar" id="escolar" value="escolar">
                    </div>
                    <div class="form-check checkbox-container2 ">
                       <label class="form-check-label" for="exampleRadios">
                        Inicial/Sala de 4
                      </label>
                     <input type="checkbox" name="inicial" value="inicial">
                     
                    </div>
                    <div class="row mt-2">
                    <div class="form-check checkbox-container3 col-8 col-sm-8 mb-2">
                       <label class="form-check-label" style="margin-left:14px;" for="exampleRadios">
                        Primaria
                      </label>
                     <input  id="prima" type="checkbox" name="inicial" value="primaria">
                     
                    </div>
                      <div  id="primaria" class="form-check checkbox-container3 col-4 col-sm-4 mb-2">
                       <label class="form-check-label" for="exampleRadios">
                        Grado
                      </label>
                     <select type="text" name="grado" >
                     <option></option>
                     <option name="grado" value="1°">1°</option>
                     <option name="grado" value="2°">2°</option>
                     <option name="grado" value="3°">3°</option>
                     <option name="grado" value="4°">4°</option>
                     <option name="grado" value="5°">5°</option>
                     <option name="grado" value="6°">6°</option>
                     <option name="grado" value="7°">7°</option>
                     <option name="grado" value="8°">8°</option>
                     <option name="grado" value="9°">9°</option>
                     </select>
                    </div>
                  </div>
                   <div class="row mt-2">
                    <div class="form-check checkbox-container4 col-8 col-sm-8 mb-2">
                       <label class="form-check-label" style="margin-left:14px;" for="exampleRadios">
                        Secundaria
                      </label>
                     <input id="secu"type="checkbox" name="inicial" value="secundaria">
                    
                    </div>
                       <div class="form-check checkbox-container3 col-4 col-sm-4 mb-2" id="secundaria">
                       <label class="form-check-label" for="exampleRadios">
                        Año
                      </label>
                     <select type="text" name="año">
                     <option></option>
                     <option name="año" value="1°">1°</option>
                     <option name="año" value="2°">2°</option>
                     <option name="año" value="3°">3°</option>
                     <option name="año" value="4°">4°</option>
                     <option name="año" value="5°">5°</option>
                     <option name="año" value="6°">6°</option>
                     </select>
                    </div>
                </div>
              </div>
                    <div class="col-4 col-sm-4 mb-2">    
                    <div class="form-check checkbox-container-1 ">
                       <label class="form-check-label " for="exampleRadios1">
                       <strong>Formación/Superior</strong>
                      </label>
                     <input type="checkbox" name="escolar" id="escolar" value="superior" >
                    </div>

                      <div class="form-check checkbox-container4-1">
                       <label class="form-check-label" for="exampleRadios">
                        Terciario
                      </label>
                     <input type="checkbox" name="inicial" value="terciario">
                     
                    </div>
                      <div class="form-check checkbox-container4-2 ">
                       <label class="form-check-label" for="exampleRadios">
                        Universitario
                      </label>
                     <input type="checkbox" name="inicial" id="universitario" value ="universitario">
                    </div>

                    <div class="col-12 col-sm-12 input-group mb-2" id="show">
                    <div class="input-group-prepend" style="margin-left: 0px;margin-top: 20px;">
                    <span class="input-group-text" >Valido hasta</span>
                   </div>
                  <input type="date" style="width: 200px;" class="form-control" name="fecha_fin">
                   </div>
                   
                </div>
                  <div class="col-4 col-sm-4   mb-2">    
                    <div class="form-check checkbox-container-esp ">
                       <label class="form-check-label " for="exampleRadios1">
                       <strong>Especial</strong>
                      </label>
                     <input type="checkbox" name="escolar" value="especial">
                    </div>
                  <div class="form-check checkbox-container2-2-1"><label class="form-check-label" for="exampleRadios">Primaria
                      </label>
                     <input type="checkbox" name="inicial" value="primaria_especial">
              
                  </div>
                          <div class="form-check checkbox-container2-2-2 ">
                       <label class="form-check-label" for="exampleRadios">
                        Secundaria
                      </label>
                     <input type="checkbox" name="inicial" value="secundaria_especial">
                     
                    </div>
            
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
	window.jsPDF = window.jspdf.jsPDF
	const form=document.getElementById('formDatos');
	form.addEventListener('submit',guardarForm);
	const mensaje=document.getElementById('mensaje');
  document.addEventListener('DOMContentLoaded', function() {
   
    var checkbox = document.getElementById('universitario');
    var div = document.getElementById('show');


    checkbox.addEventListener('change', function() {
        if (checkbox.checked) {
            div.style.display = 'block';
        } else {
            div.style.display = 'none';
        }
    });
});
document.addEventListener('DOMContentLoaded', function() {

   var checkbox = document.getElementById('prima');
   var div = document.getElementById('primaria');
  checkbox.addEventListener('change', function() {
        if (checkbox.checked) {
            div.style.display = 'block';
        } else {
            div.style.display = 'none';
        }
    });
  });
document.addEventListener('DOMContentLoaded', function() {

   var checkbox = document.getElementById('secu');
   var div = document.getElementById('secundaria');
  checkbox.addEventListener('change', function() {
        if (checkbox.checked) {
            div.style.display = 'block';
        } else {
            div.style.display = 'none';
        }
    });
  });
document.addEventListener('DOMContentLoaded', function() {

   var checkbox = document.getElementById('estado');
   var div = document.getElementById('fecha_abandono');
  checkbox.addEventListener('change', function() {
        if (checkbox.checked) {
            div.style.display = 'block';
        } else {
            div.style.display = 'none';
        }
    });
  });
document.addEventListener('DOMContentLoaded', function() {

   var checkbox = document.getElementById('estados');
   var div = document.getElementById('fecha_abandono');
  checkbox.addEventListener('change', function() {
        if (checkbox.checked) {
            div.style.display = 'block';
        } else {
            div.style.display = 'none';
        }
    });
  });


 
	
	
	function guardarForm(e){
		if (confirm("¿Desea guardar el formulario?") == true) {
		e.preventDefault();
		data = new FormData(form);
		var xhr = new XMLHttpRequest();
		xhr.responseType = 'json';
		xhr.open("POST", "functions/save-escolaridad.php", true);
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

      //Header pdf

			var y = 125;  
			var img = new Image();
			var x=40;
			var y=40;
			var l=30;
			var c=10;
			var m=20; 
			var xf=533+40;
			img.src = 'logo_impsr.png'
			doc.addImage(img, 'png', 60 , 48, 150,70 );
			doc.setLineWidth(1);
		  doc.roundedRect(x,y,533,755,5,5); //cuadro principal
			doc.line(240,40,240,120); //primer linea v
			doc.setFontSize(14);
			doc.line(380,40,380,120); // segunda linea v
			doc.setFont('Helvetica','bold');
			doc.text(275,y+22,'Certificado ');
			doc.text(300,y+42,'de');
			doc.text(275,y+62,'Escolaridad');
			doc.setFont('Helvetica','normal');

	  

      doc.setFont('Helvetica','bold');
      doc.setFontSize(12);
			doc.text(400,y+30,'Acreditacion de escolaridad/ ');
      doc.text(413,y+50,'Escolaridad especial ');

      doc.setFontSize(12);  
   
      var yy=120;
      doc.line(40,yy,573,yy);
		  doc.setFont('Helvetica', 'bold');
      doc.setFontSize(12);
      doc.text(45,yy+15,'Datos del Beneficiario');
      doc.setFont('Helvetica', 'normal');      
      doc.line(40,yy+20,573,yy+20); //linea 3
      yy=yy+35;//155

      doc.setFont('Helvetica', 'normal');
      doc.setFontSize(10);
      doc.line(40,yy+20,573,yy+20); //linea 6
      doc.text(45,yy-2,'DNI');     
      doc.text(211,yy-2,'Apellido(s) y Nombre(s)');
      doc.line(200,yy-15,200,yy+20); //primer linea v
      doc.setFont('Helvetica', 'normal');
      doc.setFont('Helvetica', 'bold');
      doc.setFont('Helvetica', 'normal');
      doc.setFontSize(10);
      doc.line(40,yy+55,573,yy+55); //linea 6
      doc.text(45,yy+32,'N°de beneficiario');     
      doc.text(300,yy+35,'Email');
      doc.line(298,yy+55,298,yy+20); //primer linea v
      doc.setFont('Helvetica', 'bold');
      doc.text(50,yy+13,datos.dni);
      doc.text(255,yy+13,datos.nombre_beneficiario);
      doc.text(50,yy+50,datos.numero_beneficiario);
      doc.text(330,yy+50,datos.email);



     var yy=210;
    //cuerpo del pdf

		  doc.setFont('Helvetica', 'bold');
      doc.setFontSize(12);
      doc.text(45,yy+15,'Datos del Alumno  ');
      doc.setFont('Helvetica', 'normal');      
      doc.line(40,yy+20,573,yy+20); //linea 3
      yy=yy+35;//155
      

      doc.setFont('Helvetica', 'normal');
      doc.setFontSize(10);
      doc.line(40,yy+20,573,yy+20); //linea 6
      doc.text(45,yy-2,'CUIL');     
      doc.text(211,yy-2,'Apellido(s) y Nombre(s)');
      doc.line(200,yy-15,200,yy+20); //primer linea v
      doc.setFont('Helvetica', 'normal');
      doc.setFont('Helvetica', 'bold');
      doc.text(55,yy+13,datos.cuil);
      doc.text(210,yy+13,datos.nombre);


      doc.setFont('Helvetica', 'normal');
      doc.setFontSize(10);
      doc.line(40,yy+50,573,yy+50); //linea 6
      doc.text(45,yy+32,'Telefono');     
      doc.text(395,yy+32,'Fecha Nacimiento');
      doc.line(380,yy+50,380,yy+20); //primer linea v
      doc.setFont('Helvetica', 'bold');
      doc.text(55,yy+45,datos.telefono);
      doc.text(430,yy+45,datos.fecha_nac);
      doc.setFont('Helvetica', 'normal');
      doc.text(45,yy+62,'Domicilio de contacto ');
      doc.setFont('Helvetica', 'bold');
      doc.setFontSize(12);
      doc.line(40,yy+80,573,yy+80); //linea 3
      doc.text(55,yy+75,datos.domicilio);
      yy=yy+45;//155


      doc.setFont('Helvetica', 'bold');
      doc.setFontSize(12);
      doc.text(45,yy+52,'Datos de Escolaridad');
      doc.setFontSize(10);
      doc.setFont('Helvetica', 'normal');
      doc.text(200,yy+52,'Inicio ciclo lectivo');
      doc.setFont('Helvetica', 'bold');
      const side=8;
      doc.rect(290,yy+45,side,side);
      if(datos.ciclo=='inicio'){
      doc.text(291,yy+52,'x');
      }
      doc.setFont('Helvetica', 'normal');
      doc.text(350,yy+52,'Finalizacion ciclo lectivo');
      doc.setFont('Helvetica', 'bold');
      doc.rect(470,yy+45,side,side);
      if(datos.ciclo=='fin'){
      doc.setFont('Helvetica', 'bold');
      doc.text(471,yy+52,'x');
      }  
      doc.line(40,yy+55,573,yy+55); //linea 3




      yy=yy-10;//155

      doc.setFont('Helvetica', 'normal');
      doc.setFontSize(10);
      doc.text(45,yy+80,'Ciclo Lectivo:')
      doc.text(120,yy+80,datos.ciclo_lectivo);

      doc.text(210,yy+80,'Abandono');
      doc.rect(260,yy+72,side,side);
      if(datos.estado=='abandono'){
      doc.text(262,yy+79,'x');
      }
      doc.text(350,yy+80,'Libre');
      doc.rect(380,yy+72,side,side);
      if(datos.estado=='libre'){
      doc.text(381,yy+79,'x');
      } 

      if(datos.estado != null){
      doc.text(400,yy+80,'FECHA:'); 
      doc.setFont('Helvetica','bold');
      doc.text(445,yy+80,datos.fecha_es); 
      doc.line(40,yy+90,573,yy+90); //linea 3
      } 
     

      yy=yy-80;//155
      doc.setFontSize(12);
      doc.setFont('Helvetica','bold');
      doc.text(45,yy+187,'Datos de la escuela /Universidad/Escuela diferencial');
      doc.setFont('Helvetica','bold');
      doc.line(40,yy+195,573,yy+195);
     
      doc.setFontSize(10);
      doc.setFont('Helvetica','normal');
      doc.text(45,yy+210,'Nombre del establecimiento educativo:');
      doc.setFont('Helvetica','bold');
      doc.text(240,yy+210,datos.nombre_establecimiento);
      doc.line(40,yy+218,573,yy+218);
      yy=yy+160;
      doc.setFont('Helvetica','normal');
      doc.text(45,yy+280,'Fecha de emision:');
      doc.setFont('Helvetica','bold');
      doc.text(130,yy+280,datos.fecha_emision);

      doc.setFont('Helvetica','normal');
      doc.text(255,yy+290,'Sello del Establecimieto');
      doc.line(245,yy+280,365,yy+280);

      doc.setFont('Helvetica','normal');
      doc.text(385,yy+290,'Firma y sello del Director o responsable');
      doc.line(380,yy+280,560,yy+280);

      doc.line(40,yy+295,573,yy+295);



      //aca sigue el finl
      yy = yy-6;  
      doc.setFontSize(10);
      doc.setFont('Helvetica','bold');
      doc.text(45,yy+85,'Escolar');
      doc.setFont('Helvetica','normal');
       
      doc.setFontSize(8);
      doc.text(45,yy+105,'Inicial/Sala de 4');
      doc.text(45,yy+120,'Primaria');
      doc.text(45,yy+135,'Secundaria');

      
      doc.setFontSize(14);

      doc.rect(135,yy+77,side,side);
      if(datos.escolar=='escolar'){
      doc.text(135,yy+85,'x');
      }
      doc.rect(135,yy+97,side,side);
      if(datos.inicial=='inicial'){
       doc.setFont('Helvetica','bold');
      doc.text(135,yy+105,'x');
      }
      doc.rect(135,yy+112,side,side);
      if(datos.inicial=='primaria'){
      doc.setFont('Helvetica','bold');
      doc.text(135,yy+120,'x');
      doc.setFont('Helvetica','normal');
      doc.setFontSize(8);
      doc.text(155,yy+120,'Grado');
      doc.text(180,yy+120,datos.grado);
      }
      doc.rect(135,yy+127,side,side);
      if(datos.inicial=='secundaria'){
      doc.setFont('Helvetica','bold');
      doc.text(135,yy+135,'x');
      doc.setFont('Helvetica','normal');
      doc.setFontSize(8);
      doc.text(155,yy+135,'Año');
      doc.text(180,yy+135,datos.año);
      }


      doc.setFontSize(10);
      doc.setFont('Helvetica','bold');
      doc.text(250,yy+85,'Formacion/Superior');
      doc.setFont('Helvetica','normal');
       
      doc.setFontSize(8);
      doc.text(250,yy+100,'Terciario');
      doc.text(250,yy+115,'Universitario');
 
      
      doc.setFontSize(14);
      
      doc.rect(390,yy+78,side,side);
      if(datos.escolar=='superior'){
      doc.text(390,yy+85,'x');
      }
  
      doc.rect(390,yy+95,side,side);
      if(datos.inicial=='terciario'){
      doc.setFont('Helvetica','bold');
      doc.text(390,yy+104,'x');
      }
      doc.rect(390,yy+108,side,side);
      if(datos.inicial=='universitario'){
      doc.setFont('Helvetica','bold');
      doc.text(390,yy+117,'x');
      doc.setFontSize(10);
      doc.text(250,yy+137,'Valido hasta:'+datos.valido);
      }
     

      doc.setFontSize(10);
      doc.setFont('Helvetica','bold');
      doc.text(440,yy+85,'Especial');
      doc.setFont('Helvetica','normal');
       
      doc.setFontSize(8);
      doc.text(440,yy+105,'Primaria');
      doc.text(440,yy+120,'Secundaria');
 
 
      
      doc.setFontSize(14);
           // Dibujar un cuadrado
      doc.rect(540,yy+75,side,side);
      if(datos.escolar=='especial'){
      doc.text(540,yy+83,'x');
      }
      doc.rect(540,yy+100,side,side);
      if(datos.inicial=='primaria_especial'){
      doc.setFont('Helvetica','bold');
      doc.text(540,yy+107,'x');
      }
      doc.rect(540,yy+115,side,side);
      if(datos.inicial=='secundaria_especial'){
      doc.setFont('Helvetica','bold');
      doc.text(540,yy+122,'x');
      }
     
      doc.line(40,yy+160,573,yy+160); //linea 3
      doc.line(240,yy+160,240,yy+65); //linea 3
      doc.line(430,yy+160,430,yy+65);
     yy=yy+170;
      doc.setFontSize(10);
      doc.setFont('Helvetica','bold');
      doc.text(45,yy+180,' PERIODO DE PRESENTACIÓN:');
      doc.setFontSize(8);
      doc.setFont('Helvetica','normal');
      doc.text(45,yy+200,'INICIO CICLO LECTIVO 2024 01/03/2024 al 31/05/2024');
      doc.text(45,yy+210,'FINALIZACIÓN CICLO LECTIVO 2023 01/12/2023 a 31/03/2024'); 
      
      doc.text(45,yy+220,'POR FAVOR, REMITIRLOS EXCLUSIVAMENTE A ESTE CORREO, NO SE RECIBEN POR WHATSAPP,NI PERSONALMENTE.');  
      doc.text(45,yy+230,'Email:       PRESTACIONES@IMPSR.GOB.AR   (en el mail debe siempre poner quién es el titular) ');
     doc.text(45,yy+240,'EL PAGO DE LA AYUDA ESCOLAR 2024 QUEDARA SUPEDITADA A LA PRESENTACIÓN DE LOS CERTIFICADOS CORRESPONDIENTES')
     doc.text(45,yy+250,'Los certificados deben estar sellados y firmado por cada institución escolar.');
     



			doc.save('declaracion2.pdf'); 
			
	}
	</script>
</body>
</html>
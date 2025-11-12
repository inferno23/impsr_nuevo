<?php include 'head.php'; ?>
<?php include 'header.php'; ?>
<div class="container" id="tramites">
  <div class="where">
    <i class="fa fa-home"style= "letter-spacing: 2pt;"></i>
    <p>Inicio <i class="fa fa-angle-right"></i> Trámites <i class="fa fa-angle-right"></i> Cobro de haberes en el exterior</p>
  </div>
  <div class="titulo-pag">
    <p>Cobro de Haberes en el Exterior</p>
  </div>
<div class="container" id="recibo-haberes" style="margin-top:20px;">  
        <form id="formDatos" role="form" class="form" method="post">
            <h2>Datos Titular del beneficio</h2>
             <div class="row mt-2">
              <div class="col-12 col-sm-4 input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" >Apellido y Nombre</span>
                  </div>
                  <input type="text" style="text-transform: uppercase;" class="form-control" name="nombre" required>
                </div>
                <div class="col-12 col-sm-4 input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" >Nacionalidad</span>
                  </div>
                  <input type="text" class="form-control" name="nacionalidad" required>
                </div>
                       <div class="col-12 col-sm-4 input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" >N° DNI</span>
                  </div>
                  <input type="text" class="form-control" name="dni" required>
                </div>
            </div>
            
            <div class="row">
       
                <div class="col-12 col-sm-6 input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" >Pais de residencia</span>
                  </div>
                  <input type="text" class="form-control" name="pais" required>
                </div>
                <div class="col-12 col-sm-6 mb-2">    
                <label>Residencia permanente</label>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                      <label class="btn btn-primary">
                          <input type="radio" name="beneficio"  value="SI" > SI
                        </label>
                        <label class="btn btn-primary  active">
                          <input type="radio" name="beneficio"  value="NO" checked> NO
                        </label>
                    </div>
                  
                </div>
            </div>

        
      
            <hr>
            <h2>Domicilio en el exterior</h2>

            <div class="row">
                <div class="col-7 col-sm-4 input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" >Calle</span>
                  </div>
                  <input type="text" class="form-control" name="calle">
                </div>
                <div class="col-5 col-sm-2 input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" >N°</span>
                  </div>
                  <input type="text" class="form-control" name="num_calle">
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
                      <div class="col-4 col-sm-2 input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" >C.P.</span>
                  </div>
                  <input type="text" class="form-control" name="cp" >
                </div>
            </div>
            <div class="row mt-2">
        
                <div class="col-8 col-sm-5 input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" >Localidad</span>
                  </div>
                  <input type="text" class="form-control" name="localidad">
                </div>
                <div class="col-12 col-sm-4 input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" >Provincia</span>
                  </div>
                  <input type="text" class="form-control" name="provincia" >
                </div>
                    <div class="col-6 col-sm-3 input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" >Telefono</span>
                  </div>
                  <input type="text" class="form-control" name="telefono" >
                </div>
            </div>
            <hr>
            <h2>DATOS BANCARIOS PARA LA TRANSFERENCIA</h2>

     
            <div class="row">
                <div class="col-6 col-sm-6 input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" >Banco  en el exterior</span>
                  </div>
                  <input type="text" class="form-control" name="banco_exterior">
                </div>
                     <div class="col-12 col-sm-3 input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" >N° de cuenta</span>
                  </div>
                  <input type="text" class="form-control" name="num_cuenta_ext">
                </div>
                 <div class="col-12 col-sm-3 input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" >Moneda de la cuenta</span>
                  </div>
                  <input type="text" class="form-control" name="moneda_ext">
                </div>
               </div> 
              <div class="row">
              <div class="col-md-12"><p>
         
              </p>
            </div>
            </div>
               <div class="row">
                <div class="col-6 col-sm-6 input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" >Swift banco beneficiario</span>
                  </div>
                  <input type="text" class="form-control" name="swift_beneficiario">
                </div>
                    <div class="col-12 col-sm-6 input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" >I.B.A.N(en caso de ser bancos europeos)</span>
                  </div>
                  <input type="text" class="form-control" name="iban_euro">
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-sm-6 input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" >Swift banco intermediario(si hubiere)</span>
                  </div>
                  <input type="text" class="form-control" name="swift_intermediario">
                </div>
                <div class="col-12 col-sm-6 input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" >I.B.A.N intermediario</span>
                  </div>
                  <input type="text" class="form-control" name="iban_intermediario">
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
  </div>
</div>
    </div>

  </div>
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
    xhr.open("POST", "functions/save_cobro_ext.php", true);
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
      doc.setLineWidth(1);
      doc.setDrawColor(157, 158, 160);
        //doc.rect(290, 10, 30, 30);
      //doc.roundedRect(x,y,533,720,5,5); //cuadro principal
       doc.line(240,y,573,y); //primer linea v
      doc.line(240,y,240,y+90); //primer linea v
      doc.setFontSize(14);
      doc.setFontType('bold');
      doc.text(245,y+50,'AUTORIZACION DE');  
       doc.text(250,y+65,'TRANSFERENCIA');
      doc.line(380,y,380,y+90); // segunda linea v
      doc.line(573,y,573,y+90); // tercera linea v
      doc.setLineWidth(2); 
      doc.line(40,y+90,573,y+90);
      doc.setLineWidth(1); 
      doc.line(40,y+115,573,y+115);//4 linea v
        doc.line(40,y+115,40,y+135);//line1
        doc.line(573,y+115,573,y+135);//line2
      doc.setFontSize(11);
      doc.text(230,y+107,'DATOS TITULAR DEL BENEFICIO');
      doc.setFontSize(14);

    
      doc.setFontSize(11);
      doc.setFontType('normal');
      doc.text(155,y+130,'Nombre Completo ');
       doc.text(431,y+130,'Nacionalidad');
      
      doc.setFontSize(10);    
      doc.setFontType('bold');
      doc.line(40,y+135,573,y+135);//3 linea v=
      
      doc.text(120,y+150,datos.nombre);
      doc.setFontType('normal');
      doc.setFontSize(11);
      doc.line(356,y+115,356,y+135); //primer linea v

      doc.setFontType('bold');
      doc.setFontSize(10);
      
  
      doc.text(392,y+150,datos.nacionalidad);
      

      doc.setFontType('normal');

      doc.line(426,y+155,426,y+175); //primer linea v
      doc.line(306,y+155,306,y+175); //primer linea v
   
      doc.line(40,y+155,573,y+155); //linea 5
      doc.line(40,y+175,573,y+175); //linea 6
      
      doc.setFontSize(11);
         doc.line(40,y+155,40,y+175);//line1
         doc.line(573,y+155,573,y+175);//line2
      doc.text(351,y+170,'DNI:');
      doc.text(135,y+170,'Pais de residencia:');
      doc.setFontType('bold');
      doc.setFontSize(10);
      doc.text(347,y+190,datos.dni);
      doc.text(130,y+190,datos.pais);
     
      doc.setFontSize(11);     
      doc.setFontType('normal');
      doc.text(441,y+170,'Reside permanente:');
      doc.setFontType('bold');
      doc.text(470,y+190,datos.beneficio);
      doc.setFontSize(11);
      doc.line(40,y+195,573,y+195); //linea 7
      y=60;
      doc.text(230,y+195,'DOMICILIO EN EL EXTERIOR');     
      doc.line(40,y+200,573,y+200); //linea 7
        doc.line(40,y+200,40,y+220);//line1
        doc.line(573,y+200,573,y+220);//line2
       doc.setFontType('normal');
      doc.text(45,y+215,'Calle');
      doc.text(240,y+215,'N° ');
      doc.text(290,y+215,'Piso');
      doc.text(345,y+215,'Dpto');
      doc.text(395,y+215,'CP');
      doc.setFontSize(10);
      doc.setFontType('bold');
      doc.text(45,y+240,datos.calle);
      doc.text(260,y+240,datos.num_calle);
      doc.text(290,y+240,datos.piso);
      doc.text(345,y+240,datos.dpto);
      doc.text(400,y+240,datos.cp);
      doc.setFontType('normal');
      doc.line(235,y+200,235,y+220); //primer linea v
      doc.line(285,y+200,285,y+220); //primer linea v
      doc.line(340,y+200,340,y+220); //primer linea v
      doc.line(390,y+200,390,y+220); //primer linea v
      doc.line(40,y+220,573,y+220); //linea 7
      doc.line(40,y+245,573,y+245); //linea 8
           doc.line(40,y+245,40,y+265);//line1
           doc.line(573,y+245,573,y+265);//line2
      doc.line(40,y+265,573,y+265); //linea 7
      doc.line(40,y+290,573,y+290); //linea 8
      doc.line(235,y+245,235,y+265); //primer linea v
      doc.line(440,y+245,440,y+265); //primer linea v
      doc.setFontSize(11);
      doc.text(45,y+260,'Localidad');
      doc.text(240,y+260,'Provincia');
      doc.text(445,y+260,'Telefono');
    
      doc.setFontType('bold');
      doc.setFontSize(10);
      doc.text(45,y+285,datos.localidad);
      doc.text(240,y+285,datos.provincia);
      doc.text(445,y+285,datos.telefono);
      doc.setFontType('normal');
         doc.line(40,y+290,40,y+330);//line1
         doc.line(573,y+290,573,y+330);//line2
      doc.line(40,y+330,573,y+330); //linea 10

      doc.setFontSize(11);
      
      doc.text(45,y+305,'Solicito por este medio al Instituto Municipal de previsión Social de Rosario transfiera mi haber previsional');
      doc.text(45,y+322,'a la cuenta indicada en el apartado siguiente');
       doc.setFontType('bold');
      doc.text(180,y+345,'DATOS BANCARIOS PARA LA TRANSFERENCIA');
     
      
          doc.line(40,y+350,40,y+370); //linea1
          doc.line(573,y+350,573,y+370); //linea2
        doc.line(300,y+350,300,y+370); //lineaver
        doc.line(495,y+350,495,y+370); //lineaver
      doc.line(40,y+350,573,y+350); //linea 13
      doc.setFontType('normal');
      doc.text(45,y+365,'Banco en el exterior');
      doc.text(305,y+365,'N° de cuenta');
      doc.text(500,y+365,'Moneda');
     
      doc.line(40,y+370,573,y+370); //linea 14
       doc.setFontType('bold');
      doc.text(70,y+385,datos.banco_exterior);
      doc.text(310,y+385,datos.num_cuenta_ext);
      doc.text(510,y+385,datos.moneda_ext);


          doc.line(40,y+390,40,y+410); //linea1
          doc.line(573,y+390,573,y+410); //linea2
        doc.line(300,y+390,300,y+410); //lineaver
      doc.line(40,y+390,573,y+390); //plinea v
        doc.setFontType('normal');
        doc.text(125,y+405,'Swift Banco beneficiario:');
        doc.text(385,y+405,'I.B.A.N(banco beneficiario):');
      doc.line(40,y+410,573,y+410); //linea 15
        doc.setFontType('bold');
        doc.text(100,y+425,datos.swift_beneficiario);
        doc.text(380,y+425,datos.iban_euro); 
      doc.line(40,y+430,573,y+430); // linea v
        doc.setFontType('normal');
        doc.text(125,y+445,'Swift Banco intermediario:');
        doc.text(385,y+445,'I.B.A.N(banco intermediario):'); 

      doc.line(40,y+450,573,y+450); //linea 17 
             doc.line(40,y+430,40,y+450); //linea1
             doc.line(573,y+430,573,y+450); //linea2
         doc.line(300,y+430,300,y+450); //lineaver   
         doc.setFontType('bold');
         doc.text(100,y+465,datos.swift_intermediario);
         doc.text(380,y+465,datos.iban_intermediario);
      doc.line(40,y+470,573,y+470); //linea 17
     

      
       
      doc.setFontType('normal');
      doc.text(45,y+495,'I.B.A.N (en caso de ser bancos europeos)');
       doc.text(45,y+520,'IMPORTANTE: El beneficiario debe remitir al Instituto Municipal de Previsión Social de Rosario ');
     doc.text(45,y+530,'el certificado de supervivencia, apostillado por autoridad correspondiente en el país de residencia, cada ');
     doc.text(45,y+540,'seis (6) meses,caso contrario se suspenderá la liquidación del haber previsional.');

        doc.text(65,y+690,'FIRMA DEL BENFICIARIO');
           doc.text(270,y+690,'ACLARACION');
              doc.text(420,y+690,'DNI');

          
            
            
            doc.save('declaracion.pdf'); 
      
  }
  </script>
</body>
</html>
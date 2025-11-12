<?php 
include '../functions/connect.php';
global $con;
$temas=$con->query("SELECT * FROM normativa_tema");
$tipos=$con->query("SELECT * FROM normativa_tipo");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Normativa</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link rel="icon" href="img/logo_impsr.png">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <!-- Template Main CSS File -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="styles.css?v=1.7" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Medicio - v4.10.0
  * Template URL: https://bootstrapmade.com/medicio-free-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  	<style>
  	.busqueda{
  	 padding-bottom:0rem;
  	}
  	 .busqueda .container{
  	     display:flex;
  	     flex-direction:column;
  	     gap:0.5rem;
  	     background-color: #eaeaea;
         border-radius: 6px;
         padding: 1rem 0.5rem;
  	 }
  	 .resultados-lista{
  	     display: flex;
        flex-direction: column;
        gap: 1rem;
        margin: 1rem 0rem;
  	 }
  	 .lista-item{
  	     display: flex;
        flex-direction: row;
        border: 1px solid #999;
        flex-wrap: wrap;
        border-bottom:none;
        border-radius:5px;
  	 }
  	 .lista-item .item-titulo{
  	     width: 100%;
        height: 2rem;
        background-color: #143c5e;
        color: #fff !important;
        font-size: 1rem;
        line-height: 1rem;
        padding: 0.5rem;
        text-decoration:none;
  	 }
  	 .lista-item .item-label{
  	     width: 25%;
        height: 2rem;
        margin: 0px;
        font-size: 0.8rem;
        padding: 0.5rem;
        line-height: 1rem;
        background-color: #eaeaea;
        border-bottom:1px solid #999;
  	 }
  	 .item-texto25{
  	    width: 25%;
        font-size: 0.8rem;
        line-height: 1rem;
        height: 2rem;
        margin: 0px;
        padding: 0.5rem;
        border-bottom:1px solid #999;
  	 }
  	 .item-texto75{
  	    width: 75%;
        font-size: 0.9rem;
        line-height: 1rem;
        height: 2rem;
        margin: 0px;
        padding: 0.5rem;
        border-bottom:1px solid #999;
  	 }
  	 @media (max-width: 992px) {
  	     .lista-item .item-label{
  	         width: 35%;
  	         height:auto;
  	     }
  	     .item-texto25{
  	         width: 65%;
  	     }
  	     .item-texto75{
  	         width: 65%;
  	         height:auto;
  	     }
  	 }
  	</style>
</head>

<body>

    <!-- ======= Header ======= -->
    <?php 
    include 'inc/header.inc.php';
    ?>
    <main id="main" class="container licitaciones">
		<div class="where d-flex gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16"><path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5Z" /><path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z" /></svg>
            <p>Inicio <svg width="8" height="12" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1L7 6C7.18048 6.15268 7.18929 6.26386 7 6.5L1 11.5" stroke="black" /></svg> Normativa</p>
        </div>
        <div class="titulo-pag">
            <p>Normativa</p>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-9">
                	<section class="busqueda">
                		<h3>Buscador de Normativa</h3>
                        <p>Aquí podrá consultar la normativa municipal con el alcance descripto en la xxxxxx xxxxxx xxxxx</p>
                        <div class="container">
                        	<div class="row">
                        		<div class="col-12 col-md-6 col-lg-3">
                        			<label class="form-label">Tema</label>
                        			<select class="form-select" id="tema">
                        				<option value="0" selected>Todos</option>
                        				<?php while ($row=$temas->fetch_assoc()) { ?>
                        				<option value="<?php echo $row['id'];?>"><?php echo $row['tema'];?></option>    
                        				<?php }?>
                        			</select>
                        		</div>
                        		<div class="col-12 col-md-6 col-lg-3">
                        			<label class="form-label">Tipo de norma</label>
                        			<select class="form-select" id="tipo">
                        				<option value="0" selected>Todos</option>
                        				<?php while ($row=$tipos->fetch_assoc()) { ?>
                        				<option value="<?php echo $row['id'];?>"><?php echo $row['tipo'];?></option>    
                        				<?php }?>
                        			</select>
                        		</div>
                        		<div class="col-12 col-md-6 col-lg-3">
                        			<label class="form-label">Nº de norma </label>
                        			<input class="form-control" type="text" id="nro"  onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                        		</div>
                        		<div class="col-12 col-md-6 col-lg-3">
                        			<label class="form-label">Año de norma</label>
                        			<input class="form-control" type="text" id="ano" maxlength="4" placeholder="aaaa" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                        		</div>
                        	</div>
                        	<div class="row">
                        		<div class="col-12 col-lg-6">
                        			<label class="form-label">Palabra Asociada</label>
                        			<input class="form-control" type="text" id="asociada">
                        		</div>
                        	</div>
                        	<div class="row">
                        		<div class="col text-center">
                        			<button class="btn btn-primary" type="button" id="btn-buscar" onclick="buscar()"><i class="fas fa-search"></i> Buscar</button>
                        		</div>
                        	</div>
                        </div>
                	</section>
                    
                    <section id="resultados">
                    	
                    </section>
                </div>
                <aside class="col-12 col-md-3 side-tramites">
                    <img src="img/bn_atencion.png">
                    <h2>Consultas</h2>
                    <hr>
                    <i class="fa fa-phone-square"></i>
                    <p> Comunicate al (0341) 5587023</p>
                    <!--<img src="img/trabajadores.png">-->
                    <a href="sala.html"><img src="img/multiespacio.jpg" style="margin-top: 2rem;"></a>
                </aside>
            </div>

            
        </div>

        
    </main><!-- End #main -->



    <!-- ======= Footer ======= -->
    <?php 
    include 'inc/footer.inc.php';
    ?>

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
	
	<script>
		function buscar(){
			var button=document.getElementById('btn-buscar');
			button.innerHTML='<i class="fas fa-spinner fa-spin"></i>';
			var tema=document.getElementById('tema').value;
			var tipo=document.getElementById('tipo').value;
			var nro=document.getElementById('nro').value;
			var ano=document.getElementById('ano').value;
			var asociada=document.getElementById('asociada').value;
			var data = new FormData();
			data.append('tema',tema);
			data.append('tipo',tipo);
			data.append('nro',nro);
			data.append('ano',ano);
			data.append('asociada',asociada);
        	var xhr = new XMLHttpRequest();
        	xhr.responseType = 'json';
            xhr.open("POST", "inc/buscar-normativa.php", true);
            xhr.onload = function(e) {
                if (this.status == 200) {
                	button.innerHTML='<i class="fas fa-search"></i> Buscar';
        	   		var json=this.response;
        	   		if(json.success){
        	   			mostrarResultados(json.items);
        	   		}
                }else{
        			return false;
                }
            };
            xhr.send(data);
		}
		
		function mostrarResultados(items){
			var res=document.getElementById('resultados');
			res.innerHTML='';
			let h3=document.createElement('h3');
			h3.innerHTML='Resultado de búsqueda';
			var lista=document.createElement('div');
			lista.classList.add('resultados-lista');
			for(i=0;i<items.length;i++){
				console.log(items[i]);
				let item=document.createElement('div');
				item.classList.add('lista-item');
				let titulo=document.createElement('a');
				titulo.classList.add('item-titulo');
				titulo.href="vernormativa.php?id="+items[i].id;
				titulo.innerHTML=items[i].tipo+' N° '+items[i].nro+'/'+items[i].ano;
				let label1=document.createElement('label');
				label1.classList.add('item-label');
				label1.innerHTML='Sancion';
				let sancion=document.createElement('label');
				sancion.classList.add('item-texto25');
				sancion.innerHTML=items[i].sancion;
				let label2=document.createElement('label');
				label2.classList.add('item-label');
				label2.innerHTML='Promulgacion';
				let promulgacion=document.createElement('label');
				promulgacion.classList.add('item-texto25');
				promulgacion.innerHTML=items[i].promulgacion;
				let label3=document.createElement('label');
				label3.classList.add('item-label');
				label3.innerHTML='Asunto';
				let asunto=document.createElement('label');
				asunto.classList.add('item-texto75');
				asunto.innerHTML=items[i].asunto;
				item.appendChild(titulo);
				item.appendChild(label1);
				item.appendChild(sancion);
				item.appendChild(label2);
				item.appendChild(promulgacion);
				item.appendChild(label3);
				item.appendChild(asunto);
				lista.appendChild(item);
			}
			res.appendChild(h3);
			res.appendChild(lista);
		}
	</script>
</body>

</html>
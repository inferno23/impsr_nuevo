<?php include 'head.php'; ?>
<?php include 'header.php'; ?>


<style>
<!--
.list-group-item{
    margin-bottom: 1px;
    padding: .50rem 1.25rem;
    cursor: pointer;
}
.disabled{
    border: 1px solid #007bff;
    cursor: not-allowed;
}
.activo{
    border: 2px solid #007bff;
        background-color: #e9ecef;
}
.hidden{
    display: none;       
}
-->

.colort{
    color:#1E619A;
}
.btn-turno{
    background-color: #1E619A;
    border: 1px solid #1E619A;
    color : #fff;
}
#solicitar-turnos{
    background-color: #e4e5e6;
}
.breadcrumb {
    display: flex;
    flex-wrap: wrap;
    padding: 0.75rem 1rem;
    margin-bottom: 1rem;
    list-style: none;
    background-color: #e9ecef;
    border-radius: 0.25rem;
}
</style>

<body>

	<div class="container pb-4" id="solicitar-turnos" >
		<!-- <div class="where">
	        <i class="fa fa-home"style= "letter-spacing: 2pt;"></i><p> Inicio <i class="fa fa-angle-right"></i> Servicios <i class="fa fa-angle-right"></i> Solicitar Turno</p>
	    </div> -->
		<div class="row">
			<div class="col-12 my-4 ">
				<h2 class="h3 colort">Solicitar Turno</h2>
			</div>
		</div>		 
	   	<div class="row">
	   		<nav aria-label="breadcrumb" role="navigation">
            	<ol class="breadcrumb">
                	<li class="breadcrumb-item"><a href="solicitar-turno">Inicio</a></li>
                </ol>
            </nav>
	   	</div>
	   	<div class="row">
	   		<div class="col-12">
    			<div class="card">
              		<div class="card-header" id="card-titulo">Gestión de Turnos</div>
              		<div class="card-body">
              			<div class="form-row">
                            <div class="form-group col-md-12">
                                <div class="alert alert-warning" role="alert">
                                    <p><b>&nbsp;IMPORTANTE:</b></p>
                                    <p>
                                        <b>Su trámite aún no ha finalizado.</b>
                                        Recuerde: debe confirmar la aceptación del turno utilizando el enlace que hemos enviado a su cuenta de correo electrónico.
                                        En caso de no realizar dicha confirmación, dentro de las próximas 24hs, su solicitud se dará de baja.
                                    </p>
                                </div>
                
                
                
                                <div>
                                    <a class="btn btn-primary" href="solicitar_turnonew.php">Salir</a>
                                </div>
                            </div>
                        </div>
              		</div>
            	</div>
			</div>
		</div>
		
	</div>


<?php include 'footer.php'; ?>
<script>
</script>
</body>
</html>

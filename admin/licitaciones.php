<?php
session_start();
if (!isset($_SESSION['imps'])){
    header("location:index.php");
    exit;
}

//include 'sidebar.php';
include 'conexion/conectar.inc';
include 'inc/funciones.inc';
global $conectar;

// Consulta para obtener licitaciones con datos relacionados
$query_licitaciones = "SELECT l.*, 
                       le.estado as estado_nombre,
                       lt.tipo as tipo_nombre,
                       lr.reparticion as reparticion_nombre
                       FROM licitaciones l
                       LEFT JOIN licitaciones_estados le ON l.id_estado = le.id
                       LEFT JOIN licitaciones_tipos lt ON l.id_tipo = lt.id
                       LEFT JOIN licitaciones_reparticiones lr ON l.id_reparticion = lr.id
                       ORDER BY l.id DESC";
                     //  echo $query_licitaciones;

$licitaciones = $conectar->query($query_licitaciones);

if ($conectar->error) {
    error_log("Error en consulta licitaciones: " . $conectar->error);
}

// Consultas para obtener datos de las tablas relacionadas para los selectores
$query_estados = "SELECT id, estado FROM licitaciones_estados  ORDER BY estado";
//echo $query_estados;

$estados = $conectar->query($query_estados);

$query_tipos = "SELECT id, tipo FROM licitaciones_tipos ORDER BY tipo";
//echo $query_tipos;

$tipos = $conectar->query($query_tipos);

$query_reparticiones = "SELECT id, reparticion FROM licitaciones_reparticiones  ORDER BY reparticion";
//echo $query_reparticiones;

$reparticiones = $conectar->query($query_reparticiones);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>Gestión de Licitaciones - IMPSR</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- DataTables -->
    <link rel="stylesheet" href="css/datatables.min.css" type="text/css" media="all" />
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/estilo.css">
    
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
        }
        
        .header-section {
            background: linear-gradient(135deg, #003366 0%, #0056b3 100%);
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
        }
        
        .card23 {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }
        
        .card-header23 {
            background: linear-gradient(135deg, #003366 0%, #0056b3 100%);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 1.25rem;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #003366 0%, #0056b3 100%);
            border: none;
            border-radius: 8px;
            padding: 0.5rem 1.5rem;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,51,102,0.3);
        }
        
        .btn-info {
            background-color: #0056b3;
            border-color: #0056b3;
            transition: all 0.2s ease-in-out;
        }
        
        .btn-info:hover {
            background-color: #004494;
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }
        
        .btn-danger:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }
        
        .modal-content {
            border-radius: 15px;
            border: none;
        }
        
        .modal-header {
            background: linear-gradient(135deg, #003366 0%, #0056b3 100%);
            color: white;
            border-radius: 15px 15px 0 0;
        }
        
        .form-control:focus {
            border-color: #0056b3;
            box-shadow: 0 0 0 0.2rem rgba(0, 86, 179, 0.25);
        }
        
        .table thead {
            background: linear-gradient(135deg, #003366 0%, #0056b3 100%);
            color: white;
        }
        
        .table tbody tr:hover {
            background-color: #e8f1fc;
        }
        
        .badge-status {
            padding: 0.5rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .badge-active {
            background-color: #d4edda;
            color: #155724;
        }
        
        .badge-inactive {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .badge-abierta {
            background-color: #d1ecf1;
            color: #0c5460;
        }
        
        .badge-cerrada {
            background-color: #f5c6cb;
            color: #721c24;
        }
        
        .badge-adjudicada {
            background-color: #d4edda;
            color: #155724;
        }
        
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
        
        .sr-only {
            position: absolute !important;
            width: 1px !important;
            height: 1px !important;
            padding: 0 !important;
            margin: -1px !important;
            overflow: hidden !important;
            clip: rect(0, 0, 0, 0) !important;
            white-space: nowrap !important;
            border: 0 !important;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, #003366 0%, #0056b3 100%);">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-gavel me-2"></i>
                Gestión de Licitaciones
            </a>
          
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0" style="color: #1e3a8a;">
                        <i class="fas fa-list me-2"></i>
                        Lista de Licitaciones
                    </h5>
                    <button type="button" class="btn btn-success btn-sm nuevo" title="Nueva Licitación">
                        <i class="fas fa-plus me-1"></i>Nueva Licitación
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="tablalicitaciones">
                        <thead>
                            <tr>
                                <th>Fecha Apertura</th>
                                <th>Código</th>
                                <th>Título</th>
                                <th>Tipo</th>
                                <th>Repartición</th>
                                <th>Estado</th>
                                <th>Activo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $licitaciones->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo date('d/m/Y H:i', strtotime($row["apertura"])); ?></td>
                                <td><?php echo htmlspecialchars($row["codigo"]); ?></td>
                                <td><?php echo htmlspecialchars($row["titulo"]); ?></td>
                                <td><?php echo htmlspecialchars($row["tipo_nombre"] ?: '-'); ?></td>
                                <td><?php echo htmlspecialchars($row["reparticion_nombre"] ?: '-'); ?></td>
                                <td>
                                    <?php 
                                    $estadoNombre = $row["estado_nombre"] ?: $row["estado"];
                                    $estadoClass = '';
                                    switch(strtolower($estadoNombre)) {
                                        case 'abierta':
                                            $estadoClass = 'badge-abierta';
                                            break;
                                        case 'cerrada':
                                            $estadoClass = 'badge-cerrada';
                                            break;
                                        case 'adjudicada':
                                            $estadoClass = 'badge-adjudicada';
                                            break;
                                        default:
                                            $estadoClass = 'badge-inactive';
                                    }
                                    ?>
                                    <span class="badge badge-status <?php echo $estadoClass; ?>">
                                        <?php echo ucfirst($estadoNombre); ?>
                                    </span>
                                </td>
                              
                                <td>
                                    <?php if ($row["activo"] == 1) { ?>
                                        <span class="badge badge-status badge-active">Activo</span>
                                    <?php } else { ?>
                                        <span class="badge badge-status badge-inactive">Inactivo</span>
                                    <?php } ?>
                                </td>
                              
                                <td>
                                    <div class="btn-group" role="group" aria-label="Acciones de licitación">
                                        <button type="button" 
                                            class="btn btn-sm btn-info editar" 
                                            data-id="<?php echo $row["id"]; ?>" 
                                            data-bs-toggle="tooltip" 
                                            data-bs-placement="top" 
                                            title="Editar: <?php echo htmlspecialchars($row["titulo"], ENT_QUOTES, 'UTF-8'); ?>"
                                            aria-label="Editar licitación">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" 
                                            class="btn btn-sm btn-danger borrar" 
                                            data-id="<?php echo $row["id"]; ?>" 
                                            data-titulo="<?php echo htmlspecialchars($row["titulo"], ENT_QUOTES, 'UTF-8'); ?>"
                                            data-bs-toggle="tooltip" 
                                            data-bs-placement="top" 
                                            title="Eliminar: <?php echo htmlspecialchars($row["titulo"], ENT_QUOTES, 'UTF-8'); ?>"
                                            aria-label="Eliminar licitación">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Nueva/Editar Licitación -->
    <div class="modal fade" id="modalLicitacion" tabindex="-1" aria-labelledby="modal-titulo" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="inc/guardar_licitacion.php" class="form-horizontal" id="formLicitacion" method="post">
                    <div class="modal-header">
                        <h5 id="modal-titulo" class="modal-title">Nueva Licitación</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        <input type="hidden" name="id" id="id">
                    </div>
                    <div class="modal-body">
                        <!-- Primera fila: Número, Estado y Expediente -->
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <label for="codigo" class="form-label">Codigo *</label>
                                <input class="form-control" type="text" name="codigo" id="codigo" placeholder="XX/XXXX" required />
                            </div>
                            
                            <div class="col-md-4">
                                <label for="expediente" class="form-label">Expediente</label>
                                <input class="form-control" type="text" name="expediente" id="expediente" placeholder="XX/XXXX" required/>
                            </div>
                            <div class="col-md-4">
                                <label for="id_estado" class="form-label">Estado *</label>
                                <select name="id_estado" id="id_estado" class="form-control" required>
                                    <?php 
                                    $query_estados_form = "SELECT id, estado FROM licitaciones_estados ORDER BY estado";
                                    $estados_form = $conectar->query($query_estados_form);
                                    while ($estado = $estados_form->fetch_assoc()) { ?>
                                        <option value="<?php echo $estado['id']; ?>"><?php echo htmlspecialchars($estado['estado']); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <!-- Segunda fila: Año, Mes, Tipo y Repartición -->
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <label for="codigo_ano" class="form-label">Año</label>
                                <input class="form-control" type="number" name="codigo_ano" id="codigo_ano" min="2000" max="2100" value="<?php echo date('Y'); ?>" />
                            </div>
                            <div class="col-md-2">
                                <label for="codigo_mes" class="form-label">Mes</label>
                                <input class="form-control" type="number" name="codigo_mes" id="codigo_mes" min="1" max="12" value="<?php echo date('m'); ?>" />
                            </div>
                           
                            <div class="col-md-3">
                                <label for="presupuesto" class="form-label">Presupuesto</label>
                                <input class="form-control" type="number" step="0.01" name="presupuesto" id="presupuesto" placeholder="0.00" />
                            </div>
                        </div>

                        <!-- Tercera fila: Presupuesto y Costos -->
                        <div class="row mb-3">
                           
                            <div class="col-md-3">
                                <label for="costo_pliego" class="form-label">Costo Pliego</label>
                                <input class="form-control" type="number" step="0.01" name="costo_pliego" id="costo_pliego" placeholder="0.00" />
                            </div>
                            <div class="col-md-3">
                                <label for="costo_oferta" class="form-label">Costo Oferta</label>
                                <input class="form-control" type="number" step="0.01" name="costo_oferta" id="costo_oferta" placeholder="0.00" />
                            </div>
                            <div class="col-md-3">
                                <label for="costo_impugnacion" class="form-label">Costo Impugnación</label>
                                <input class="form-control" type="number" step="0.01" name="costo_impugnacion" id="costo_impugnacion" placeholder="0.00" />
                            </div>
                        </div>

                        <!-- Segunda fila: Tipo y Repartición -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="id_tipo" class="form-label">Tipo *</label>
                                <select name="id_tipo" id="id_tipo" class="form-control" required>
                                   
                                    <?php 
                                    // Regenerar datos de tipos
                                    $query_tipos_form = "SELECT id, tipo FROM licitaciones_tipos ORDER BY tipo";
                                    $tipos_form = $conectar->query($query_tipos_form);
                                    while ($tipo = $tipos_form->fetch_assoc()) { ?>
                                        <option value="<?php echo $tipo['id']; ?>"><?php echo htmlspecialchars($tipo['tipo']); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="id_reparticion" class="form-label">Repartición *</label>
                                <select name="id_reparticion" id="id_reparticion" class="form-control" required>
                                   
                                    <?php 
                                    // Regenerar datos de reparticiones
                                    $query_reparticiones_form = "SELECT id, reparticion FROM licitaciones_reparticiones ORDER BY reparticion";
                                    $reparticiones_form = $conectar->query($query_reparticiones_form);
                                    while ($reparticion = $reparticiones_form->fetch_assoc()) { ?>
                                        <option value="<?php echo $reparticion['id']; ?>"><?php echo htmlspecialchars($reparticion['reparticion']); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <!-- Título -->
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título *</label>
                            <input class="form-control" type="text" name="titulo" id="titulo" required />
                        </div>

                        <!-- Descripción -->
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción *</label>
                            <textarea class="form-control" rows="4" name="descripcion" id="descripcion" required></textarea>
                        </div>

                        <!-- Fechas -->
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="fecha" class="form-label">Fecha  *</label>
                                <input class="form-control" type="date" name="fecha" id="fecha" value="<?php echo date('Y-m-d'); ?>" required />
                            </div>
                            <div class="col-md-6">
                                <label for="apertura" class="form-label">Fecha de Apertura *</label>
                                <input class="form-control" type="datetime-local" name="apertura" id="apertura" value="<?php echo date('Y-m-d\TH:i'); ?>" required />
                            </div>
                        </div>

                                             

                        <!-- Activo -->
                        <div class="row mb-3">
                            
                            <div class="col-md-6">
                                <div class="form-check mt-4">
                                    <input class="form-check-input" type="checkbox" name="activo" id="activo" value="1" checked>
                                    <label class="form-check-label" for="activo">
                                        Activo
                                    </label>
                                </div>
                            </div>
                        </div>

                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button id="guardar-btn" name="guardar" type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/datatables.min.js"></script>

    <script>
$(function() {

 // ELIMINAR
        $(document).on('click', '.borrar', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var titulo = $(this).data('titulo');
            var $row = $(this).closest('tr');
                $.ajax({
                    url: 'inc/eliminar_licitacion.php',
                    type: 'POST',
                    data: { id: id },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            showToast('Licitación eliminada exitosamente', 'success');
                            $row.fadeOut(400, function(){ $(this).remove(); });
                        } else {
                            showToast('Error al eliminar: ' + response.error, 'error');
                        }
                    },
                    error: function() {
                        showToast('Error de conexión al eliminar', 'error');
                    }
                });
        });

        /********************* */

    $('#formLicitacion').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax({
			type: 'POST',
			url: $(this).attr('action'),
			data: data,
			contentType: false,
			dataType: "json",
			cache: false,
			processData: false,
			success: function(data){
				if (data.success){
					$('#modalLicitacion').modal('hide');
					$("#formLicitacion")[0].reset();
					$('#centro').load('licitaciones.php');
					$('body').removeClass('modal-open');
					$('.modal-backdrop').remove();	
					$('#id').val('');
				}else{
					alert('Error '+data.error);	
				}
			    	
			}          
		});			
    });
    // Evento para el botón "Nuevo"
    $(document).on('click', '.nuevo', function(e) {
        e.preventDefault();
        $('#formLicitacion')[0].reset();
        $('#id').val('');
        $('#modal-titulo').text('Nueva Licitación');

        const modal = new bootstrap.Modal(document.getElementById('modalLicitacion'));
        modal.show();
    });


    $('.editar').click(function(e){
			e.preventDefault();
			var id=$(this).data('id');
					
			$.getJSON( "inc/carga_licitacion.php", { id: id} )
			.done(function( json ) {
				console.log('Datos recibidos de carga_item:', json);
				    $('#titulo').val(json.data.titulo);
                    $('#codigo').val(json.data.codigo);

                    $('#descripcion').val(json.data.descripcion);
                    $('#apertura').val(json.data.apertura);
                    $('#fecha').val(json.data.fecha);
                    $('#id_estado').val(json.data.id_estado);
                    $('#id_tipo').val(json.data.id_tipo);
                    $('#id_reparticion').val(json.data.id_reparticion);
                    $('#codigo_ano').val(json.data.codigo_ano);
                    $('#codigo_mes').val(json.data.codigo_mes);
                    $('#expediente').val(json.data.expediente);
                    $('#presupuesto').val(json.data.presupuesto);
                    $('#costo_pliego').val(json.data.costo_pliego); 
                    $('#costo_oferta').val(json.data.costo_oferta); 
                    $('#costo_impugnacion').val(json.data.costo_impugnacion);
                    $('#activo').prop("checked", json.data.activo == 1);
                    $('#modal-titulo').text('Editar Licitación');
                    const modal = new bootstrap.Modal(document.getElementById('modalLicitacion'));
                    modal.show();
				
			})
			.fail(function(jqXHR, textStatus, errorThrown) {
				console.error('Error en carga_item.php:', textStatus, errorThrown);
				if (jqXHR.responseText) {
					console.error('Respuesta del servidor:', jqXHR.responseText);
				}
			});
		});    
// EDITAR
        $(document).on('click', '.editar2333', function(e) {
            e.preventDefault();
            var $btn = $(this);
            var id = $btn.data('id');
            var originalHtml = $btn.html();
            $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').remove();
            $.getJSON("inc/carga_licitacion.php", { id: id })
            .done(function(json) {
                if (json.success) {
                    $('#id').val(id);
                    $('#codigo').val(json.data.codigo);
                    $('#titulo').val(json.data.titulo);
                    $('#descripcion').val(json.data.descripcion);
                    $('#apertura').val(json.data.apertura);
                    $('#fecha').val(json.data.fecha);
                    $('#id_estado').val(json.data.id_estado);
                    $('#id_tipo').val(json.data.id_tipo);
                    $('#id_reparticion').val(json.data.id_reparticion);
                    $('#codigo_ano').val(json.data.codigo_ano);
                    $('#codigo_mes').val(json.data.codigo_mes);
                    $('#expediente').val(json.data.expediente);
                    $('#presupuesto').val(json.data.presupuesto);
                    $('#costo_pliego').val(json.data.costo_pliego); 
                    $('#costo_oferta').val(json.data.costo_oferta); 
                    $('#costo_impugnacion').val(json.data.costo_impugnacion);
                    $('#activo').prop("checked", json.data.activo == 1);
                    $('#modal-titulo').text('Editar Licitación');
                    const modal = new bootstrap.Modal(document.getElementById('modalLicitacion'));
                    modal.show();
                    showToast('Datos cargados correctamente', 'success');
                } else {
                    showToast('Error al cargar los datos: ' + (json.error || 'Error desconocido'), 'error');
                }
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                showToast('Error de conexión: ' + errorThrown, 'error');
                if (jqXHR.responseText) {
                    console.error('Respuesta del servidor:', jqXHR.responseText);
                }
            })
            .always(function() {
                $btn.prop('disabled', false).html(originalHtml);
            });
        });

    //
     //editar 
		$('.editar222').click(function(e){
			e.preventDefault();
			var id=$(this).data('id');
					 // Mostrar indicador de carga
            var originalHtml = $btn.html();
            $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');

			$.getJSON( "inc/carga_licitacion.php", { id: id} )
			.done(function( json ) {
				console.log('Datos recibidos de carga_item:', json);
				$('#id').val(id);
				$('#fechatexto').val(json.data.mensaje);
				$('#fechapago').val(json.data.fecha_pago);
				
				$('#fechames').val(json.data.nmes);
				if (json.data.activo==1){ $('#fechaactivo').prop( "checked", true ); }else{$('#fechaactivo').prop( "checked", false );};
				$('#modal-titulo').html('Editar Fecha');
				const modal = new bootstrap.Modal(document.getElementById('modalFechas'), {
					backdrop: 'static',
					keyboard: false
				});
				modal.show();
			})
			.fail(function(jqXHR, textStatus, errorThrown) {
				console.error('Error en carga_item.php:', textStatus, errorThrown);
				if (jqXHR.responseText) {
					console.error('Respuesta del servidor:', jqXHR.responseText);
				}
			});
		});  		
});


    $(document).ready(function() {
        // Inicializar DataTable
        $('#tablalicitaciones').DataTable({
            responsive: true,
            language: {
                url: "inc/esp.json"
            },
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
            order: [[0, 'desc']], // Ordenar por fecha de apertura descendente (columna 0)
            columnDefs: [
                { targets: [8], orderable: false } // Columna de acciones no ordenable (columna 8)
            ],
            drawCallback: function() {
                initializeTooltips();
            }
        });

        // Función para inicializar tooltips
        function initializeTooltips() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl, {
                    trigger: 'hover focus'
                });
            });
        }

        // Inicializar tooltips
        initializeTooltips();

        // NUEVO (evento global para compatibilidad con carga dinámica)
       $('.nuevo').click(function(e){
        //alert("hola");
		e.preventDefault();
		$('#formLicitacion')[0].reset();
		$('#id').val('');
		$('#modal-titulo').text('Nueva Licitación');
			
		const modal = new bootstrap.Modal(document.getElementById('modalLicitacion'));
		modal.show();
	});
	

        // EDITAR
        $(document).on('click', '.editar23333', function(e) {
            e.preventDefault();
            var $btn = $(this);
            var id = $btn.data('id');

            // Mostrar indicador de carga
            var originalHtml = $btn.html();
            $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');

            $.getJSON("inc/carga_licitacion.php", { id: id })
            .done(function(json) {
                if (json.success) {
                    $('#id').val(id);
                    $('#codigo').val(json.data.codigo);
                    $('#titulo').val(json.data.titulo);
                    $('#descripcion').val(json.data.descripcion);
                    $('#apertura').val(json.data.apertura);
                    $('#fecha').val(json.data.fecha);
                    $('#id_estado').val(json.data.id_estado);
                    $('#id_tipo').val(json.data.id_tipo);
                    $('#id_reparticion').val(json.data.id_reparticion);

                    $('#codigo_ano').val(json.data.codigo_ano);
                    $('#codigo_mes').val(json.data.codigo_mes);
                    $('#expediente').val(json.data.expediente);

                    
                    $('#presupuesto').val(json.data.presupuesto);
                    $('#costo_pliego').val(json.data.costo_pliego); 
                    $('#costo_oferta').val(json.data.costo_oferta); 
                    $('#costo_impugnacion').val(json.data.costo_impugnacion);

                    $('#activo').prop("checked", json.data.activo == 1);

                    $('#modal-titulo').text('Editar Licitación');
                    $('.form-control').removeClass('is-invalid');
                    $('.invalid-feedback').remove();

                    const modal = new bootstrap.Modal(document.getElementById('modalLicitacion'));
                    modal.show();
                    
                    showToast('Datos cargados correctamente', 'success');
                } else {
                    showToast('Error al cargar los datos: ' + (json.error || 'Error desconocido'), 'error');
                }
            })
            .fail(function(xhr, status, error) {
                showToast('Error de conexión: ' + error, 'error');
            })
            .always(function() {
                $btn.prop('disabled', false).html(originalHtml);
            });
        });

        // ELIMINAR
        $(document).on('click', '.borrar', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var titulo = $(this).data('titulo');
            
            if (confirm('¿Está seguro que desea eliminar la licitación "' + titulo + '"?')) {
                $.ajax({
                    url: 'inc/eliminar_licitacion.php',
                    type: 'POST',
                    data: { id: id },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            showToast('Licitación eliminada exitosamente', 'success');
                            setTimeout(function() {
                                location.reload();
                            }, 1500);
                        } else {
                            showToast('Error al eliminar: ' + response.error, 'error');
                        }
                    },
                    error: function() {
                        showToast('Error de conexión al eliminar', 'error');
                    }
                });
            }
        });

        // SUBMIT FORM
        $('#formLicitacion').submit(function(e){
            e.preventDefault();
            if (!validateForm()) {
                return false;
            }
            $('#guardar-btn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Guardando...');
            var data = new FormData(this);
            $.ajax({
                type: 'POST',
                url: 'inc/carga_licitacion.php',
                data: data,
                contentType: false,
                dataType: "json",
                cache: false,
                processData: false,
                success: function(data){
                    if (data.success){
                        showToast(data.message || 'Licitación guardada exitosamente', 'success');
                        const modal = bootstrap.Modal.getInstance(document.getElementById('modalLicitacion'));
                        modal.hide();
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    } else {
                        showToast(data.error || 'Error al guardar la licitación', 'error');
                    }
                },
                error: function(xhr, status, error) {
                    showToast('Error de conexión: ' + error, 'error');
                },
                complete: function() {
                    $('#guardar-btn').prop('disabled', false).html('<i class="fas fa-save me-1"></i>Guardar');
                }
            });
        });

        // VALIDACIÓN
        function validateForm() {
            var isValid = true;
            
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').remove();
            
            // Validar número
            if ($('#codigo').val().trim() === '') {
                markFieldInvalid('#codigo', 'El número de licitación es obligatorio');
                isValid = false;
            }
            
            // Validar título
            if ($('#titulo').val().trim() === '') {
                markFieldInvalid('#titulo', 'El título es obligatorio');
                isValid = false;
            }
            
            // Validar descripción
            if ($('#descripcion').val().trim() === '') {
                markFieldInvalid('#descripcion', 'La descripción es obligatoria');
                isValid = false;
            }
            
            // Validar estado
            if ($('#id_estado').val() === '') {
                markFieldInvalid('#id_estado', 'Debe seleccionar un estado');
                isValid = false;
            }
            
            // Validar tipo
            if ($('#id_tipo').val() === '') {
                markFieldInvalid('#id_tipo', 'Debe seleccionar un tipo');
                isValid = false;
            }
            
            // Validar repartición
            if ($('#id_reparticion').val() === '') {
                markFieldInvalid('#id_reparticion', 'Debe seleccionar una repartición');
                isValid = false;
            }
            
            // Validar fechas
            if ($('#apertura').val() === '') {
                markFieldInvalid('#apertura', 'La fecha de apertura  de la licitacion es obligatoria');
                isValid = false;
            }
            
            if ($('#fecha').val() === '') {
                markFieldInvalid('#fecha', 'La fecha en la licitacion es obligatoria');
                isValid = false;
            }
            
            // Validar que fecha de cierre sea posterior a apertura
            var fechaApertura = new Date($('#apertura').val());
            var fechaCierre = new Date($('#fecha').val());
            
            if (fechaApertura && fechaCierre && fechaCierre <= fechaApertura) {
                markFieldInvalid('#fecha', 'La fecha debe ser posterior a la fecha de apertura');
                isValid = false;
            }
            
            return isValid;
        }
        
        function markFieldInvalid(fieldSelector, message) {
            var field = $(fieldSelector);
            field.addClass('is-invalid');
            field.after('<div class="invalid-feedback">' + message + '</div>');
        }
        
        function showToast(message, type) {
            var toastClass = type === 'success' ? 'bg-success' : 'bg-danger';
            var toastHtml = `
                <div class="toast align-items-center text-white ${toastClass} border-0" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            ${message}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            `;
            
            if ($('#toast-container').length === 0) {
                $('body').append('<div id="toast-container" class="toast-container position-fixed top-0 end-0 p-3"></div>');
            }
            
            var $toast = $(toastHtml);
            $('#toast-container').append($toast);
            
            var toast = new bootstrap.Toast($toast[0]);
            toast.show();
            
            $toast.on('hidden.bs.toast', function() {
                $(this).remove();
            });
        }
        
        function resetForm() {
            $('#formLicitacion')[0].reset();
            $('#id').val('');
            $('#modal-titulo').text('Nueva Licitación');
            $('#activo').prop('checked', true);
            
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').remove();
        }
    });
    </script>
</body>
</html>
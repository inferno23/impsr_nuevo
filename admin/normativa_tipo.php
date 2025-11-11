<?php
// normativa_tipo.php - Gestión de Tipos de Normativa

include 'sidebar.php';
include 'conexion/conectar.inc';
include 'inc/funciones.inc';
global $conectar;

// Listar tipos
$tipos = $conectar->query('SELECT id, tipo FROM normativa_tipo ORDER BY tipo');
if ($conectar->error) {
    error_log("Error en consulta tipos: " . $conectar->error);
}
//print_r($tipos);    
?>
<!doctype html>
<html lang="es">
<head>
   <meta charset="utf-8" />
    <title>Gestión de Normativas - IMPSR</title>
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
        
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
            min-height: 500px; /* Alto mínimo igual para ambas secciones */
        }
        
        .card-header {
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
    <nav class="navbar navbar navbar-dark" style="background: linear-gradient(135deg, #003366 0%, #0056b3 100%);">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-gavel me-2"></i>
                Gestión de Normativas
            </a>
          
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-list me-2"></i>
                        Lista de Normativas
                    </h5>
                    <button type="button" class="btn btn-light btn-sm nuevo" title="Nueva Normativa">
                        <i class="fas fa-plus me-1"></i>Nueva Normativa
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="tablalicitaciones">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Tipo de Normativa</th>
                                
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $tipos->fetch_assoc()) { ?>
                            <tr>
                                 
                             <td><?php echo $row["id"]; ?></td>

                                <td><?php echo htmlspecialchars($row["tipo"] ?: '-'); ?></td>
                                  
                               <td>
                              
                                         <button type="button" 
                                            class="btn btn-sm btn-info editar" 
                                            data-id="<?php echo $row["id"]; ?>" 
                                            data-tipo="<?php echo htmlspecialchars($row["tipo"], ENT_QUOTES, 'UTF-8'); ?>"
                                            data-bs-toggle="tooltip" 
                                            data-bs-placement="top" 
                                            title="Editar: <?php echo htmlspecialchars($row["tipo"], ENT_QUOTES, 'UTF-8'); ?>"
                                            aria-label="Editar tipo">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                         <button type="button" 
                                            class="btn btn-sm btn-danger borrar" 
                                            data-id="<?php echo $row["id"]; ?>" 
                                            data-tipo="<?php echo htmlspecialchars($row["tipo"], ENT_QUOTES, 'UTF-8'); ?>"
                                            data-bs-toggle="tooltip" 
                                            data-bs-placement="top" 
                                            title="Eliminar: <?php echo htmlspecialchars($row["tipo"], ENT_QUOTES, 'UTF-8'); ?>"
                                            aria-label="Eliminar tipo">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                   
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Nueva/Editar Tipo de Normativa -->
    <div class="modal fade" id="modalTipo" tabindex="-1" aria-labelledby="modal-titulo" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formTipo" method="post" action="inc/guardar_normativa_tipo.php">
                <div class="modal-header">
                    <h5 id="modal-titulo" class="modal-title">Nuevo Tipo de Normativa</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    <input type="hidden" name="id" id="id">
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo *</label>
                        <input class="form-control" type="text" name="tipo" id="tipo" required />
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
    $(document).ready(function() {
        // Inicializar DataTable
        $('#tablalicitaciones').DataTable({
            responsive: true,
            language: {
                url: "inc/esp.json"
            },
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
            order: [[0, 'desc']],
            columnDefs: [
                { targets: [2], orderable: false } // Columna de acciones no ordenable (columna 2)
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

        initializeTooltips();

        // NUEVO
        $('.nuevo').on('click', function (e) {
            e.preventDefault();
            resetForm();
            const modal = new bootstrap.Modal(document.getElementById('modalTipo'));
            modal.show();
        });

        // EDITAR
        $(document).on('click', '.editar', function(e) {
            e.preventDefault();
            var $btn = $(this);
            var id = $btn.data('id');
            var tipo = $btn.data('tipo'); // Usar el atributo data-tipo para obtener el valor exacto
            $('#id').val(id);
            $('#tipo').val(tipo);
            $('#modal-titulo').text('Editar Tipo de Normativa');
            const modal = new bootstrap.Modal(document.getElementById('modalTipo'));
            modal.show();
        });

        // ELIMINAR
        $(document).on('click', '.borrar', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var tipo = $(this).closest('tr').find('td:eq(1)').text();
            if (confirm('¿Está seguro que desea eliminar el tipo "' + tipo + '"?')) {
                $.ajax({
                    url: 'inc/eliminar_tipo.php',
                    type: 'POST',
                    data: { id: id },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            showToast('Tipo eliminado exitosamente', 'success');
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
        $('#formTipo').submit(function(e){
            e.preventDefault();
            if (!validateForm()) {
                return false;
            }
            $('#guardar-btn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Guardando...');
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
                        showToast('Tipo guardado exitosamente', 'success');
                        const modal = bootstrap.Modal.getInstance(document.getElementById('modalTipo'));
                        modal.hide();
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    } else {
                        showToast('Error: ' + data.error, 'error');
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
            if ($('#tipo').val().trim() === '') {
                markFieldInvalid('#tipo', 'El tipo es obligatorio');
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
            $('#formTipo')[0].reset();
            $('#id').val('');
            $('#modal-titulo').text('Nuevo Tipo de Normativa');
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').remove();
        }
    });
    </script>
</body>
</html>
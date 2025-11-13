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

// Consulta para obtener novedades con secciones
$query_novedades = "SELECT a.*, b.nombre as nomseccion FROM novedades a LEFT JOIN novedades_secciones b ON a.seccion=b.id ORDER BY a.fecha DESC";
$novedades = $conectar->query($query_novedades);

// Consulta para obtener secciones para el select
$secciones = $conectar->query("SELECT * FROM novedades_secciones ORDER BY nombre");

if ($conectar->error) {
    error_log("Error en consulta: " . $conectar->error);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>Gestión de Novedades - IMPSR</title>
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
        
        .image-preview {
            max-width: 200px;
            max-height: 150px;
            border: 2px dashed #ddd;
            border-radius: 8px;
            object-fit: cover;
            cursor: pointer;
            transition: border-color 0.3s ease;
        }
        
        .image-preview:hover {
            border-color: #007bff;
        }
        
        .image-upload-container {
            position: relative;
            display: inline-block;
        }
        
        .image-upload-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.7);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            border-radius: 8px;
            cursor: pointer;
        }
        
        .image-upload-container:hover .image-upload-overlay {
            opacity: 1;
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
                Gestión de Novedades
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
                        Lista de Novedades
                    </h5>
                    <button type="button" class="btn btn-success btn-sm nuevo" title="Nueva Novedad">
                        <i class="fas fa-plus me-1"></i>Nueva Novedad
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="tablanovedades">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Sección</th>
                                <th>Fecha</th>
                                <th>Título</th>
                                <th>Subtítulo</th>
                                <th>Link</th>
                                <th>Principal</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $novedades->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row["id"]; ?></td>
                                <td><?php echo htmlspecialchars($row["nomseccion"]); ?></td>
                                <td><?php echo date('d/m/Y', strtotime($row["fecha"])); ?></td>
                                <td><?php echo htmlspecialchars($row["titulo"]); ?></td>
                                <td><?php echo htmlspecialchars(substr($row["subtitulo"], 0, 50)) . (strlen($row["subtitulo"]) > 50 ? '...' : ''); ?></td>
                                <td>
                                    <?php if (!empty($row["link"])) { ?>
                                        <a href="<?php echo htmlspecialchars($row["link"]); ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-external-link-alt"></i>
                                        </a>
                                    <?php } else { ?>
                                        <span class="text-muted">-</span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if ($row["principal"] == 1) { ?>
                                        <span class="badge badge-status badge-active">Sí</span>
                                    <?php } else { ?>
                                        <span class="badge badge-status badge-inactive">No</span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if ($row["activo"] == 1) { ?>
                                        <span class="badge badge-status badge-active">Activo</span>
                                    <?php } else { ?>
                                        <span class="badge badge-status badge-inactive">Inactivo</span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Acciones de novedad">
                                        <button type="button" 
                                            class="btn btn-sm btn-info editar" 
                                            data-id="<?php echo $row["id"]; ?>" 
                                            data-bs-toggle="tooltip" 
                                            data-bs-placement="top" 
                                            title="Editar: <?php echo htmlspecialchars($row["titulo"], ENT_QUOTES, 'UTF-8'); ?>"
                                            aria-label="Editar novedad">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" 
                                            class="btn btn-sm btn-danger borrar" 
                                            data-id="<?php echo $row["id"]; ?>" 
                                            data-titulo="<?php echo htmlspecialchars($row["titulo"], ENT_QUOTES, 'UTF-8'); ?>"
                                            data-bs-toggle="tooltip" 
                                            data-bs-placement="top" 
                                            title="Eliminar: <?php echo htmlspecialchars($row["titulo"], ENT_QUOTES, 'UTF-8'); ?>"
                                            aria-label="Eliminar novedad">
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

    <!-- Modal Nueva/Editar Novedad -->
    <div class="modal fade" id="modalNovedad" tabindex="-1" aria-labelledby="modal-titulo" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="inc/guardar_novedad.php" class="form-horizontal" enctype="multipart/form-data" id="formNovedad" method="post">
                    <div class="modal-header">
                        <h5 id="modal-titulo" class="modal-title">Nueva Novedad</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        <input type="hidden" name="id" id="id">
                    </div>
                    <div class="modal-body">
                       

                        <!-- Primera fila: Sección y Fecha -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="seccion" class="form-label">Sección *</label>
                                <select name="seccion" id="seccion" class="form-control" required>
                                    <option value="">Seleccione una sección</option>
                                    <?php 
                                    $secciones->data_seek(0); // Reset pointer
                                    while ($sec = $secciones->fetch_assoc()) { ?>
                                        <option value="<?php echo $sec['id']; ?>"><?php echo htmlspecialchars($sec['nombre']); ?></option>    
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="fecha" class="form-label">Fecha *</label>
                                <input class="form-control" type="date" name="fecha" id="fecha" required />
                            </div>
                        </div>

                        <!-- Segunda fila: Checkboxes -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="principal" id="principal" value="1">
                                    <label class="form-check-label" for="principal">
                                        Novedad Principal
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="activo" id="activo" value="1" checked>
                                    <label class="form-check-label" for="activo">
                                        Activo
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Título -->
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título *</label>
                            <input class="form-control" type="text" name="titulo" id="titulo" required />
                        </div>

                        <!-- Subtítulo -->
                        <div class="mb-3">
                            <label for="subtitulo" class="form-label">Subtítulo</label>
                            <textarea class="form-control" rows="2" name="subtitulo" id="subtitulo"></textarea>
                        </div>

                        <!-- Contenido -->
                        <div class="mb-3">
                            <label for="contenido" class="form-label">Contenido *</label>
                            <textarea class="form-control" rows="6" name="contenido" id="contenido" required></textarea>
                        </div>

                        <!-- Link -->
                        <div class="mb-3">
                            <label for="link" class="form-label">Link (opcional)</label>
                            <input class="form-control" type="url" name="link" id="link" placeholder="https://ejemplo.com" />
                        </div>
                    </div>
                     <!-- Imagen -->
                        <div class="row mb-3">
                            <div class="col-12 text-center">
                                <label class="form-label fw-bold">Imagen de la Novedad</label>
                                <div class="image-upload-container">
                                     <div>Haz clic para seleccionar imagen</div>
                                      <i class="fas fa-upload fa-2x mb-2"></i>
                                      <small>JPEG, PNG, GIF - Max 5MB</small>
                                      <div class="image-upload-overlay">
                                        
                                    </div>
                                </div>
                                <input type="file" id="carga-imagen" name="imagen" accept="image/*" style="display: none;">
                                <input type="hidden" id="imagenold" name="imagenold">
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
    <script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js"></script>
    <script src="js/datatables.min.js"></script>

    <script>
$(function() {
// Evento para el botón "Nuevo"
    $(document).on('click', '.nuevo', function(e) {
        e.preventDefault();
        $('#formNovedad')[0].reset();
        $('#id').val('');
        $('#modal-titulo').text('Nueva Novedad');

        const modal = new bootstrap.Modal(document.getElementById('modalNovedad'));
        modal.show();
    });




    
});




    $(document).ready(function() {
        // Inicializar DataTable
        $('#tablanovedades').DataTable({
            responsive: true,
            language: {
                url: "inc/esp.json"
            },
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
            order: [[2, 'desc']], // Ordenar por fecha descendente
            columnDefs: [
                { targets: [8], orderable: false } // Columna de acciones no ordenable
            ],
            drawCallback: function() {
                initializeTooltips();
            }
        });

        // Inicializar TinyMCE
        tinymce.init({
            selector: '#contenido',
            height: 300,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | removeformat | help',
            content_style: 'body { font-family: "Roboto", sans-serif; font-size:14px }',
            language: 'es',
            branding: false,
            setup: function (editor) {
                editor.on('change', function () {
                    editor.save();
                    if (editor.getContent().trim() !== '') {
                        clearFieldValidation('#contenido');
                    }
                });
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

        // NUEVO
        $('.nuevo').on('click', function (e) {
            e.preventDefault();
            resetForm();
            const modal = new bootstrap.Modal(document.getElementById('modalNovedad'));
            modal.show();
        });

        // EDITAR
        $(document).on('click', '.editar', function(e) {
            e.preventDefault();
            var $btn = $(this);
            var id = $btn.data('id');

            // Mostrar indicador de carga
            var originalHtml = $btn.html();
            $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');

            $.getJSON("inc/carga_novedad.php", { id: id })
            .done(function(json) {
                if (json.success) {
                    $('#id').val(id);
                    $('#titulo').val(json.data.titulo);
                    $('#subtitulo').val(json.data.subtitulo);
                    $('#fecha').val(json.data.fecha);
                    $('#link').val(json.data.link);
                    $('#imagenold').val(json.data.imagen);
                    
                    var imageSrc = json.data.imagen ? json.data.imagen : 'img/placeholder.png';
                    $('#imagen-cargada').attr('src', imageSrc);
                    
                    $('#seccion').val(json.data.seccion);
                    $('#activo').prop("checked", json.data.activo == 1);
                    $('#principal').prop("checked", json.data.principal == 1);

                    // Establecer contenido en TinyMCE
                    if (typeof tinymce !== 'undefined' && tinymce.get('contenido')) {
                        tinymce.get('contenido').setContent(json.data.contenido || '');
                    } else {
                        $('#contenido').val(json.data.contenido);
                    }

                    $('#modal-titulo').text('Editar Novedad');
                    $('.form-control').removeClass('is-invalid');
                    $('.invalid-feedback').remove();

                    const modal = new bootstrap.Modal(document.getElementById('modalNovedad'));
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
            
            if (confirm('¿Está seguro que desea eliminar la novedad "' + titulo + '"?')) {
                $.ajax({
                    url: 'inc/eliminar_novedad.php',
                    type: 'POST',
                    data: { id: id },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            showToast('Novedad eliminada exitosamente', 'success');
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
        $('#formNovedad').submit(function(e){
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
                        showToast('Novedad guardada exitosamente', 'success');
                        const modal = bootstrap.Modal.getInstance(document.getElementById('modalNovedad'));
                        modal.hide();
                        location.reload();
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

        // CAMBIO DE IMAGEN
        $("#carga-imagen").on('change', function (event) {
            var file = event.target.files[0];
            if (file) {
                var allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                if (!allowedTypes.includes(file.type)) {
                    showToast('Por favor seleccione un archivo de imagen válido (JPEG, PNG, GIF)', 'error');
                    this.value = '';
                    return;
                }
                
                if (file.size > 5 * 1024 * 1024) {
                    showToast('El archivo es demasiado grande. Máximo 5MB permitido', 'error');
                    this.value = '';
                    return;
                }
                
                var tmppath = URL.createObjectURL(file);
                $('#imagen-cargada').attr('src', tmppath);
            }
        });
        
        // CLICK EN IMAGEN
        $('.image-upload-container').on('click', function() {
            $('#carga-imagen').trigger('click');
        });

        // VALIDACIÓN
        function validateForm() {
            var isValid = true;
            
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').remove();
            
            if ($('#titulo').val().trim() === '') {
                markFieldInvalid('#titulo', 'El título es obligatorio');
                isValid = false;
            }
            
            if ($('#fecha').val() === '') {
                markFieldInvalid('#fecha', 'La fecha es obligatoria');
                isValid = false;
            }
            
            if ($('#seccion').val() === '') {
                markFieldInvalid('#seccion', 'Debe seleccionar una sección');
                isValid = false;
            }
            
            var contenidoValue = '';
            if (typeof tinymce !== 'undefined' && tinymce.get('contenido')) {
                contenidoValue = tinymce.get('contenido').getContent({format: 'text'}).trim();
            } else {
                contenidoValue = $('#contenido').val().trim();
            }
            
            if (contenidoValue === '') {
                markFieldInvalid('#contenido', 'El contenido es obligatorio');
                isValid = false;
            }
            
            var linkValue = $('#link').val().trim();
            if (linkValue !== '' && !isValidURL(linkValue)) {
                markFieldInvalid('#link', 'Por favor ingrese una URL válida');
                isValid = false;
            }
            
            return isValid;
        }
        
        function markFieldInvalid(fieldSelector, message) {
            var field = $(fieldSelector);
            field.addClass('is-invalid');
            field.after('<div class="invalid-feedback">' + message + '</div>');
        }
        
        function clearFieldValidation(fieldSelector) {
            var field = $(fieldSelector);
            field.removeClass('is-invalid');
            field.siblings('.invalid-feedback').remove();
        }
        
        function isValidURL(string) {
            try {
                new URL(string);
                return true;
            } catch (_) {
                return false;
            }
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
            $('#formNovedad')[0].reset();
            $('#id').val('');
            $('#imagen-cargada').attr('src', 'img/placeholder.png');
            $('#modal-titulo').text('Nueva Novedad');
            
            if (typeof tinymce !== 'undefined' && tinymce.get('contenido')) {
                tinymce.get('contenido').setContent('');
            }
            
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').remove();
        }
    });
    </script>
</body>
</html>
<?php
session_start();
// Archivo independiente que muestra un FullCalendar sin fines de semana
// y agrega un evento vía AJAX a bloqueo_dia.php

// Parametros opcionales por GET (sanitizados)
$calendarId = isset($_GET['calendarId']) ? preg_replace('/[^a-zA-Z0-9_-]/', '', $_GET['calendarId']) : 'calendar_sin_fines';
$id_seccion = isset($_GET['id_seccion']) ? intval($_GET['id_seccion']) : 1;
$sub_seccion = isset($_GET['sub_seccion']) ? preg_replace('/[^a-zA-Z0-9_\-]/', '', $_GET['sub_seccion']) : 'renovacion';
$condicion = isset($_GET['condicion']) ? preg_replace('/[^a-zA-Z0-9_\-]/', '', $_GET['condicion']) : 'activo';
//echo '$id_seccion: ' . $id_seccion . ' - $sub_seccion: ' . $sub_seccion . ' - $condicion: ' . $condicion;
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calendario sin fines de semana</title>
  <!-- FullCalendar CSS (CDN) -->
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
  <style>
    body { font-family: Arial, Helvetica, sans-serif; background: #f7fbff; }
    #<?php echo $calendarId; ?> { max-width: 920px; margin: 28px auto; background:#fff; padding:16px; border-radius:12px; box-shadow:0 6px 18px rgba(13,110,253,0.08); }
    .fc-event { cursor: pointer; }
    .info { text-align:center; margin-top:10px; color:#334155; }
    /* Tema azul personalizado */
    .fc .fc-toolbar-title { color: #0b5ed7; font-weight: 700; font-size: 1.2rem; }
    .fc .fc-button { background-color: #0d6efd; border-color: #0b5ed7; color: #fff; border-radius:8px; }
    .fc .fc-button:hover { background-color: #0b5ed7; }
    .fc .fc-button:active { transform: translateY(1px); }
    .fc .fc-daygrid-event .fc-event-title { color: #ffffff; font-weight: 600; }
    /* Mejora de contraste para días hoy */
    .fc .fc-daygrid-day.fc-day-today { background-color: #e7f1ff; }
    /* Estética de eventos: redondeo y sombra */
    .fc .fc-daygrid-event { border-radius: 10px; box-shadow: 0 4px 12px rgba(11,94,215,0.12); }
    /* Leyenda */
    .legend { display:flex; align-items:center; justify-content:center; gap:8px; margin-top:8px; }
    .legend-chip { width:18px; height:18px; background: linear-gradient(180deg,#0d6efd,#0b5ed7); border-radius:4px; box-shadow:0 1px 3px rgba(11,94,215,0.2); }
    .legend-text { color:#0b5ed7; font-weight:600; }
    .legend-feriado { width:18px; height:18px; background: linear-gradient(180deg,#f54b07ff,#f7cbc3ff); border-radius:4px; box-shadow:0 1px 3px rgba(11,94,215,0.2); }
    .legend-textFeriado { color:#f54b07ff; font-weight:600; }

.legend-renovacionPasivo { width:18px; height:18px; background: linear-gradient(180deg,#20c997,#198754); border-radius:4px; box-shadow:0 1px 3px rgba(11,94,215,0.2); }
    .legend-textrenovacionPasivo { color:#20c997; font-weight:600; }

.legend-solicitudPasivo { width:18px; height:18px; background: linear-gradient(180deg,#6f42c1,#5a32a3); border-radius:4px; box-shadow:0 1px 3px rgba(11,94,215,0.2); }
    .legend-textsolicitudPasivo { color:#6f42c1; font-weight:600; }


    
.legend-solicitudActivo { width:18px; height:18px; background: linear-gradient(180deg,#6c757d,#5c636a); border-radius:4px; box-shadow:0 1px 3px rgba(11,94,215,0.2); }
    .legend-textsolicitudActivo { color:#6c757d; font-weight:600; }

    
    .fc .fc-col-header-cell {
            /* Fondo azul claro para la cabecera del día */
            background-color: #e0f2ff; 
        }

        .fc .fc-col-header-cell-cushion {
            /* Color del texto */
            color: #004d99; 
            /* Negrita opcional */
            font-weight: bold; 
        }

        .boton-regreso {
  display: inline-block; /* Permite aplicar márgenes y rellenos */
  padding: 10px 20px; /* Espaciado interno del botón */
  background-color: #0b5ed7; /* Color de fondo */
  color: white; /* Color del texto */
  text-decoration: none; /* Elimina el subrayado del enlace */
  border: none; /* Elimina el borde */
  border-radius: 5px; /* Bordes redondeados */
  cursor: pointer; /* Cambia el cursor a una mano */
  font-size: 16px; /* Tamaño del texto */
  transition: background-color 0.3s ease; /* Transición suave al pasar el cursor */
}

.boton-regreso:hover {
  background-color: #45a049; /* Color de fondo al pasar el cursor */
}
  </style>
</head>
<body>
  <h2 style="text-align:center;">Bloqueo de días en Mesa de Entrada</h2>

  <a href="../index.php" class="boton-regreso"> ← Volver al Menú Principal</a>

   <div class="info">
    <p>Haz clic en un día para bloquearlo.</p>
        <p>Haz clic en un día bloqueado para regresarlo a un día normal.</p>

    <div class="legend">
      <span class="legend-feriado"></span>
      <span class="legend-textFeriado">Feriado </span>
      <span class="legend-chip"></span>
      <span class="legend-text">Mesa de Entrada </span>
      
    
    </div>
  </div>

  <div id="<?php echo $calendarId; ?>"></div>
  <div class="info">
    <p>Haz clic en un día para bloquearlo.</p>
        <p>Haz clic en un día bloqueado para regresarlo a un día normal.</p>

    <div class="legend">
      <span class="legend-feriado"></span>
      <span class="legend-textFeriado">Feriado </span>
      <span class="legend-chip"></span>
      <span class="legend-text">Mesa de entrada </span>
      
    </div>
  </div>

  <!-- Modal para seleccionar opción antes de bloquear -->
  <div id="blockModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.4); align-items:center; justify-content:center; z-index:9999;">
    <div style="background:#fff; padding:18px; border-radius:10px; width:320px; box-shadow:0 8px 24px rgba(2,6,23,0.2);">
      <h3 style="margin-top:0;color:#0b5ed7;">Seleccione el tipo de bloqueo</h3>
      <div id="blockOptions" style="margin:8px 0;">
        <!-- opciones se renderizan por JS -->
      </div>
      <div style="display:flex; justify-content:flex-end; gap:8px; margin-top:12px;">
        <button id="blockCancel" style="padding:8px 12px; border-radius:6px; background:#f3f4f6; border:none; cursor:pointer;">Cancelar</button>
        <button id="blockConfirm" style="padding:8px 12px; border-radius:6px; background:#0d6efd; color:#fff; border:none; cursor:pointer;">Bloquear</button>
      </div>
    </div>
  </div>

  <!-- FullCalendar JS (CDN) -->
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales-all.min.js"></script>
  <script>
    const CALENDAR_ID = '<?php echo $calendarId; ?>';
    const ID_SECCION = '<?php echo $id_seccion; ?>';
    const SUB_SECCION = '<?php echo $sub_seccion; ?>';
    const CONDICION = '<?php echo $condicion; ?>';
//console.log('ID_SECCION:', ID_SECCION, 'SUB_SECCION:', SUB_SECCION, 'CONDICION:', CONDICION);
    document.addEventListener('DOMContentLoaded', function() {
      const calendarEl = document.getElementById(CALENDAR_ID);
      if (!calendarEl) return console.error('No se encontró el elemento del calendario');

      const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        selectable: true,
        weekends: false, // Oculta fines de semana

        // Cargar eventos desde el endpoint
        events: function(fetchInfo, successCallback, failureCallback) {
          const params = new URLSearchParams();
          params.append('id_seccion', ID_SECCION);
          params.append('sub_seccion', SUB_SECCION);
          params.append('condicion', CONDICION);
          fetch('get_feriados.php?' + params.toString())
            .then(r => r.json())
            .then(data => successCallback(data))
            .catch(err => {
              console.error(err);
              failureCallback(err);
            });
        },

        dateClick: function(info) {
          const fecha = info.dateStr;

          // Definir las 4 opciones (sub_seccion, condicion)
          const opciones = [
            

            { label: 'Mesa de Entrada', sub: 'mesa de entrada', cond: 'bloquedo' },
            { label: 'Feriado', sub: 'feriado', cond: 'feriado' },
          ];

          // Mostrar modal con opciones
          const modal = document.getElementById('blockModal');
          const optionsContainer = document.getElementById('blockOptions');
          optionsContainer.innerHTML = '';
          opciones.forEach((op, idx) => {
            const id = 'opt_' + idx;
            const wrapper = document.createElement('div');
            wrapper.style.margin = '6px 0';
            wrapper.innerHTML = `<label style="display:flex;align-items:center;gap:8px;cursor:pointer;"><input type="radio" name="blockOpt" value="${idx}" ${idx===0? 'checked':''}> <span style="font-weight:600;color:#0b5ed7">${op.label}</span></label>`;
            optionsContainer.appendChild(wrapper);
          });
          modal.style.display = 'flex';

          // Handlers
          const cancelar = document.getElementById('blockCancel');
          const confirmar = document.getElementById('blockConfirm');

          const closeModal = () => { modal.style.display = 'none'; };
          cancelar.onclick = closeModal;

          confirmar.onclick = function() {
            const sel = document.querySelector('input[name="blockOpt"]:checked');
            if (!sel) { alert('Seleccioná una opción'); return; }
            const op = opciones[parseInt(sel.value, 10)];

            // Enviar via fetch a bloqueo_dia.php con la sub_seccion y condicion elegidas
            const form = new FormData();
            form.append('fechas[]', fecha);
            form.append('id_seccion', ID_SECCION);
            form.append('sub_seccion', op.sub);
            form.append('condicion', op.cond);

            fetch('bloqueo_dia.php', { method: 'POST', body: form })
              .then(r => r.text())
              .then(text => {
                if (text && (text.toLowerCase().includes('se guard') || text.toLowerCase().includes('guardaron'))) {
                  calendar.refetchEvents();
                  alert(text);
                } else {
                  alert('No se pudo bloquear la fecha: ' + text);
                }
                closeModal();
              }).catch(err => {
                console.error(err);
                alert('Error al comunicarse con el servidor');
                closeModal();
              });
          };
        },

        // Permitir desbloquear (eliminar) haciendo click en evento
        eventClick: function(info) {
          const ev = info.event;
          const eventId = ev.id || (ev.extendedProps && ev.extendedProps.id);
          if (!eventId) {
            alert('Evento sin id, no se puede eliminar');
            return;
          }
          if (!confirm('¿Desbloquear (volvera a ser un día normal) este día?')) return;

          const form = new URLSearchParams();
          form.append('action', 'delete');
          form.append('id', eventId);

          fetch('bloqueo_dia.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: form.toString()
          })
          .then(r => r.text())
          .then(text => {
            if (text && text.toLowerCase().indexOf('se elimin') !== -1) {
              // Refrescar eventos para sincronizar
              calendar.refetchEvents();
              alert(text);
            } else {
              alert('No se pudo eliminar: ' + text);
            }
          })
          .catch(err => {
            console.error(err);
            alert('Error al comunicarse con el servidor');
          });
        }
      });

      calendar.render();
    });
  </script>
</body>
</html>

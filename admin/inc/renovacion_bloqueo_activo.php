
  <style>
    #calendar {
      max-width: 800px;
      margin: 40px auto;
    }
    #guardarFechas {
      display: block;
      margin: 20px auto;
      padding: 10px 20px;
    }
  </style>
<h3 style="text-align:center;">Seleccioná y presiona el boton bloquear los dias</h3>
<h3 style="text-align:center;">en los que no se renovaran creditos para activos</h3>
<div id="calendar"></div>
<button id="guardarFechas">bloquear fechas</button>



<script>
  let fechasSeleccionadas = [];

  function inicializarCalendario() {
    const calendarEl = document.getElementById('calendar');

    if (!calendarEl) {
      console.error("No se encontró el div con id 'calendar'");
      return;
    }

    const calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      locale: 'es',
      selectable: true,
      dateClick: function (info) {
        const fecha = info.dateStr;
        const index = fechasSeleccionadas.indexOf(fecha);

        if (index === -1) {
          fechasSeleccionadas.push(fecha);
          calendar.addEvent({
            title: 'Dia Bloqueado',
            start: fecha,
            allDay: true,
            color: '#FF0000'
          });
        } else {
          fechasSeleccionadas.splice(index, 1);
          calendar.getEvents().forEach(event => {
            if (event.startStr === fecha) {
              event.remove();
            }
          });
        }
      }
    });

    calendar.render();

    $('#guardarFechas').off('click').on('click', function () {
      if (fechasSeleccionadas.length === 0) {
        alert('Seleccioná al menos una fecha');
        return;
      }

    $.post('inc/bloqueo_dia.php', {
  fechas: fechasSeleccionadas,
  id_seccion: 1,
  sub_seccion: 'renovacion',
  condicion: 'activo'
}, function (respuesta) {
  alert(respuesta);
  fechasSeleccionadas = [];
  calendar.getEvents().forEach(event => event.remove());
});
    });
  }

</script>




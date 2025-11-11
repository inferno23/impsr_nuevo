<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
include '../conexion/conectar.inc.php';
global $conectar;

if ($conectar->connect_error) {
    echo json_encode([]);
    exit;
}

$id_seccion = isset($_GET['id_seccion']) ? intval($_GET['id_seccion']) : 0;
$sub_seccion = isset($_GET['sub_seccion']) ? $conectar->real_escape_string($_GET['sub_seccion']) : '';
$condicion = isset($_GET['condicion']) ? $conectar->real_escape_string($_GET['condicion']) : '';
$hoy = date('Y-m-d');

// Construir cláusulas WHERE dinámicas (si no se pasan parámetros devolverá todas las fechas >= hoy)
$where = [];
$where[] = "fecha >= '$hoy'";
//$id_seccion=1;
if ($id_seccion > 0) {
    $where[] = "id_seccion >= $id_seccion";
}

if ($id_seccion == 2) {
    $where[] = "id_seccion = $id_seccion";
}

if ($id_seccion == 3) {
    $where[] = "id_seccion = $id_seccion";
}
/*
if ($sub_seccion !== '') {
    $where[] = "sub_seccion = '$sub_seccion'";
}
if ($condicion !== '') {
    $where[] = "condicion = '$condicion'";
}
*/

$sql = "SELECT id, fecha, sub_seccion, condicion FROM turnos_feriados WHERE " . implode(' AND ', $where). ' ORDER by fecha ASC';

//echo '<BR>'.$sql.'<BR>';
$res = $conectar->query($sql);
$events = [];
if ($res) {
    while ($row = $res->fetch_assoc()) {
        $sub = isset($row['sub_seccion']) ? $row['sub_seccion'] : '';
        $cond = isset($row['condicion']) ? $row['condicion'] : '';

        // Determinar colores según sub_seccion y condicion
        $bg = '#6c757d'; $border = '#5c636a'; $text = '#ffffff';
       if ($sub === 'feriado' || $cond === 'feriado') {
            $bg = '#f54b07ff'; $border = '#f7cbc3ff'; $text = '#ffffff';
        }elseif ($sub === 'renovacion' && $cond === 'activo') {
            $bg = '#0d6efd'; $border = '#0b5ed7'; $text = '#ffffff';
        } elseif ($sub === 'renovacion' && $cond === 'pasivo') {
            $bg = '#20c997'; $border = '#198754'; $text = '#ffffff';
        } elseif ($sub === 'solicitud' && $cond === 'activo') {
            $bg = '#6c757d'; $border = '#5c636a'; $text = '#ffffff';
        } elseif ($sub === 'solicitud' && $cond === 'pasivo') {
            $bg = '#6f42c1'; $border = '#5a32a3'; $text = '#ffffff';
        } else {
            // Otros combos: azul tenue
            $bg = '#0d6efd'; $border = '#0b5ed7'; $text = '#ffffff';
        }

        $title = ''; //$title = 'Dia Bloqueado';
        if ($sub !== '' || $cond !== '') {
            $title .= '' . ($sub !== '' ? $sub : 'no_sub') . ' - ' . ($cond !== '' ? $cond : 'no_cond');
        }

        $events[] = [
            'id' => (string)$row['id'],
            'title' => $title,
            'start' => $row['fecha'],
            'allDay' => true,
            'backgroundColor' => $bg,
            'borderColor' => $border,
            'textColor' => $text,
            'extendedProps' => [ 'sub_seccion' => $sub, 'condicion' => $cond ]
        ];
    }
    $res->free();
}

$conectar->close();
echo json_encode($events);
exit;

?>
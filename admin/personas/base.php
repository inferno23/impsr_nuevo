<?php
// Configuración de la base de datos
$host = 'localhost';
$db   = 'impsr_test';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
$pdo = new PDO($dsn, $user, $pass, $options);

// Ruta del archivo CSV

// Ruta del archivo CSV
$csvFile = 'personas.csv';

if (!file_exists($csvFile)) {
    die("Archivo CSV no encontrado.");
}

// Contadores
$insertados = 0;
$actualizados = 0;

if (($handle = fopen($csvFile, "r")) !== false) {
    $header = fgetcsv($handle, 0, ";");
    $campos = array_map(function($campo) {
        return strtolower(str_replace('"', '', trim($campo)));
    }, $header);

    while (($data = fgetcsv($handle, 0, ";")) !== false) {
        $registro = array_combine($campos, $data);
        $id = $registro['idpersona'];

        // Buscar si ya existe en la base
        $stmt = $pdo->prepare("SELECT * FROM personas WHERE idpersona = ?");
        $stmt->execute([$id]);
        $registro_bd = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($registro_bd) {
            // Convertir claves a min��sculas
            $registro_bd = array_change_key_case($registro_bd, CASE_LOWER);

            // Comparar y armar UPDATE
            $valores = [];
            $updates = [];

            foreach ($registro as $campo => $valor) {
                if ($campo === 'idpersona' || $campo === 'clave') continue;
                if (!array_key_exists($campo, $registro_bd)) {
                    echo "Campo $campo no existe en la tabla. Se omite.<br>";
                    continue;
                }

                $valor_bd = trim((string)$registro_bd[$campo]);
                $valor_csv = trim((string)$valor);

                if ($valor_bd !== $valor_csv) {
                    $updates[] = "$campo = ?";
                    $valores[] = $valor_csv;
                    echo "�� Diferencia en ID $id: $campo �� BD='$valor_bd' | CSV='$valor_csv'<br>";
                }
            }

            if (!empty($updates)) {
                $valores[] = $id;
                $sql = "UPDATE personas SET " . implode(', ', $updates) . " WHERE idpersona = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute($valores);
                echo "<strong>�7�8 Actualizado IDPERSONA $id</strong><br>";
                $actualizados++;
            } else {
                echo "�C Sin cambios para IDPERSONA $id<br>";
            }

        } else {
            // Hacer INSERT
            $campos_insert = array_keys($registro);
            $placeholders = array_fill(0, count($registro), '?');
            $valores = array_values($registro);

            $sql = "INSERT INTO personas (" . implode(',', $campos_insert) . ") VALUES (" . implode(',', $placeholders) . ")";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($valores);
            echo "<strong>�7�7 Insertado nuevo IDPERSONA $id</strong><br>";
            $insertados++;
        }
    }

    fclose($handle);

    // Resumen final
    echo "<hr>";
    echo "<h3>�7�3 PROCESO COMPLETADO</h3>";
    echo "Total insertados: <strong>$insertados</strong><br>";
    echo "Total actualizados: <strong>$actualizados</strong><br>";

} else {
    echo "No se pudo abrir el archivo.";
}
?>
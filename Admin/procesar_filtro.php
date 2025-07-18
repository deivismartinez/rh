<?php
require_once("../Tablero/clases/conectar.php");

$conexion = new conectar(); // Instancia la conexión a la base de datos
$db = $conexion->conectar(); // Obtener la conexión

$nombreCompletoTxt = $_POST['nombreCompletoTxt'];
$programaCmb = $_POST['programaCmb'];
$rolCmb = $_POST['rolCmb'];
$sedeCmb = $_POST['sedeCmb'];
$usuarioTxt = $_POST['usuarioTxt'];

if($facultadCmb !=''){$facultadCmb =' and f.id = '.$facultadCmb;}
if($programaCmb !=''){$programaCmb =' and p.id = '.$programaCmb;}
if($rolCmb ==''){$rolCmb ='%';}
if($sedeCmb ==''){$sedeCmb ='%';}

// Modificar la consulta para agregar el filtro del nombre
$sql = "SELECT ROW_NUMBER() OVER () AS row_number, u.nombre as nombre, u.correo as correo, p.nombre as nombre_programa, f.nombre as nombre_facultad, u.tipo as tipo, u.estado as estado, u.sede as sede, u.id 
        FROM usuario as u 
        INNER JOIN programa as p ON p.id = u.facultad_id 
        INNER JOIN facultad as f ON f.id = p.facultad_id 
        WHERE u.sede ILIKE '%$sedeCmb%' and u.tipo ILIKE '%$rolCmb%' and u.correo ILIKE '%$usuarioTxt%' and u.nombre ILIKE '%$nombreCompletoTxt%' $facultadCmb $programaCmb";
var_dump($sql);
$datos = pg_query($db, $sql);

// Generar la tabla con los resultados
echo "<table class='mi-tabla'>";
echo "<thead><tr><th>No.</th><th>Nombre</th><th>Correo</th><th>Programa</th><th>Tipo</th><th>Estado</th><th>Sede</th></tr></thead>";
echo "<tbody>";
while ($row = pg_fetch_assoc($datos)) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['row_number']) . "</td>";
    echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
    echo "<td>" . htmlspecialchars($row['correo']) . "</td>";
    echo "<td>" . htmlspecialchars($row['nombre_programa']) . "</td>";
    echo "<td>" . htmlspecialchars($row['tipo']) . "</td>";
    echo "<td>" . htmlspecialchars($row['estado']) . "</td>";
    echo "<td>" . htmlspecialchars($row['sede']) . "</td>";

    $urlVer = "EditEvaluador.php?id=" . $row['id'];
        // Agregar la celda con el enlace
        echo "<td>
        <a data-toggle='tooltip' title='Editar' href='" . htmlspecialchars($urlVer) . "'>
            <i class='pe-7s-pen'></i>
        </a>
      </td>";

    echo "</tr>";
}
echo "</tbody>";
echo "</table>";

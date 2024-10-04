<?php
require_once("../Tablero/clases/conectar.php");

$conexion = new conectar(); // Instancia la conexión a la base de datos
$db = $conexion->conectar(); // Obtener la conexión

$facultadTxt = $_POST['facultadTxt'];

// Modificar la consulta para agregar el filtro del nombre
$sql = "SELECT ROW_NUMBER() OVER () AS row_number, nombre, estado, CASE WHEN posgrado = 't' THEN 'Posgrado' WHEN posgrado = 'f' THEN 'Pregrado' END,id FROM facultad  order by id desc
        WHERE u.nombre ILIKE '%$facultadTxt%'";

$datos = pg_query($db, $sql);

// Generar la tabla con los resultados
echo "<table class='mi-tabla'>";
echo "<thead><tr><th>No.</th><th>Nombre</th><th>Estado</th><th>Alcance</th></tr></thead>";
echo "<tbody>";
while ($row = pg_fetch_assoc($datos)) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['row_number']) . "</td>";
    echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
    echo "<td>" . htmlspecialchars($row['estado']) . "</td>";
    echo "<td>" . htmlspecialchars($row['posgrado']) . "</td>";
   

    $urlVer = "EditProgram.php?id=" . $row['id'];
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


<?php
require_once("conectar.php");
require_once("clases/Programas.php");

$nombreCompletoTxt = $_POST['nombreCompletoTxt'];

// Modificar la consulta para agregar el filtro del nombre
$sql = "SELECT u.nombre, u.correo, p.nombre, u.tipo, u.estado, u.sede, u.id 
        FROM usuario as u 
        INNER JOIN programa as p ON p.id = u.facultad_id 
        WHERE u.nombre ILIKE '%$nombreCompletoTxt%'";

$datos = pg_query($this->db, $sql);

// Generar la tabla con los resultados
echo "<table class='mi-tabla'>";
echo "<thead><tr><th>Nombre</th><th>Correo</th><th>Programa</th><th>Tipo</th><th>Estado</th><th>Sede</th></tr></thead>";
echo "<tbody>";
while ($row = pg_fetch_assoc($datos)) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
    echo "<td>" . htmlspecialchars($row['correo']) . "</td>";
    echo "<td>" . htmlspecialchars($row['nombre_programa']) . "</td>";
    echo "<td>" . htmlspecialchars($row['tipo']) . "</td>";
    echo "<td>" . htmlspecialchars($row['estado']) . "</td>";
    echo "<td>" . htmlspecialchars($row['sede']) . "</td>";
    echo "</tr>";
}
echo "</tbody>";
echo "</table>";

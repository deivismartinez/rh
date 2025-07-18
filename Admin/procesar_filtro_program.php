<?php
require_once("../Tablero/clases/conectar.php");

$conexion = new conectar(); // Instancia la conexión a la base de datos
$db = $conexion->conectar(); // Obtener la conexión

$programTxt = $_POST['programTxt'];
$alcanceCmb = $_POST['alcanceCmb'];
$facultadCmb = $_POST['facultadCmb'];
$alcanceCmbI='';
if($facultadCmb !=''){$facultadCmb =' and f.id = '.$facultadCmb;}
if($alcanceCmb=='false'){$alcanceCmbI=' and postgrado is false';}else{if($alcanceCmb=='true'){$alcanceCmbI=' and postgrado is true';}else{$alcanceCmbI='';}}

// Modificar la consulta para agregar el filtro del nombre
$sql = "SELECT p.nombre as program,f.nombre as facultad, CASE when postgrado = 'true' then 'POSGRADO' else 'PREGRADO' end as alcance, p.id "
        . "FROM programa p inner join facultad f on (p.facultad_id=f.id) where p.nombre ILIKE '%$programTxt%' $facultadCmb $alcanceCmbI order by f.nombre, p.nombre desc";
$datos = pg_query($db, $sql);

// Generar la tabla con los resultados
echo "<table class='mi-tabla'>";
echo "<thead><tr><th>No.</th><th>Programa</th><th>Facultad</th><th>Alcance</th></tr></thead>";
echo "<tbody>";
$number = 0;
while ($row = pg_fetch_assoc($datos)) {
    $number++;
    echo "<tr>";
    echo "<td>" . $number . "</td>";
    echo "<td>" . htmlspecialchars($row['program']) . "</td>";
    echo "<td>" . htmlspecialchars($row['facultad']) . "</td>";
    echo "<td>" . htmlspecialchars($row['alcance']) . "</td>";
   

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


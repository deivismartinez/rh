<?php
require_once("../Tablero/vo/UsuarioVO.php");
require_once("../Tablero/clases/Programas.php");
require_once("../Tablero/clases/Gestion.php");

session_start();
$usuario = $_SESSION['usuario'];
$archivo = "hvd".$usuario->getId();
$_SESSION['id_usuario']=$usuario->getId();
$programa = new Programas();
header('Content-Type: application/json');

if (isset($_POST['enviarfacultadid'])) {
    $facultadId = $_POST['enviarfacultadid'];
    $area = $_POST['enviarselarea'];
    $recibido = $programa->getAsignatura($facultadId, $area);

    // Devuelve los datos en formato JSON
    echo json_encode($recibido);
}
?>


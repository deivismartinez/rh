<?php
require_once("../Tablero/vo/UsuarioVO.php");
require_once("../Tablero/clases/Programas.php");
require_once("../Tablero/clases/Gestion.php");

session_start();
$usuario = $_SESSION['usuario'];
$archivo = "hvd".$usuario->getId();
$_SESSION['id_usuario']=$usuario->getId();
$programa = new Programas();       
//$usuarioEvaluador= $programa->getEvaluador(); 

 //$nombre_usuario = $_POST['nombre_usuario'];
//$nombreCompletoTxt = strtoupper(filter_input(INPUT_POST, 'nombreCompletoTxt', FILTER_SANITIZE_SPECIAL_CHARS));


header('Content-Type: application/json');
// Verificar que el usuario no existe nuevamente para mayor seguridad



if (isset($_POST['facultad_id'])) {
    $facultadId = $_POST['facultad_id'];
    
$facultadId=2;
    $areas = $programa->getArea($facultadId);

    // Devuelve los datos en formato JSON
    echo json_encode($areas);
}


?>


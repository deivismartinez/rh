<?php
require_once("../Tablero/vo/UsuarioVO.php");
require_once("../Tablero/clases/Programas.php");
require_once("../Tablero/clases/Gestion.php");

session_start();
$usuario = $_SESSION['usuario'];
$archivo = "hvd".$usuario->getId();
$_SESSION['id_usuario']=$usuario->getId();
$programa = new Programas();       
$usuarioEvaluador= $programa->getEvaluador(); 

 //$nombre_usuario = $_POST['nombre_usuario'];
$nombreCompletoTxt = strtoupper(filter_input(INPUT_POST, 'nombreCompletoTxt', FILTER_SANITIZE_SPECIAL_CHARS));
$programaCmb = strtoupper(filter_input(INPUT_POST, 'programaCmb', FILTER_SANITIZE_SPECIAL_CHARS));
$rolCmb = strtoupper(filter_input(INPUT_POST, 'rolCmb', FILTER_SANITIZE_SPECIAL_CHARS));
$sedeCmb = strtoupper(filter_input(INPUT_POST, 'sedeCmb', FILTER_SANITIZE_SPECIAL_CHARS));
$usuarioTxt = strtoupper(filter_input(INPUT_POST, 'usuarioTxt', FILTER_SANITIZE_SPECIAL_CHARS));

header('Content-Type: application/json');
// Verificar que el usuario no existe nuevamente para mayor seguridad


if ($programa->existeUsuario($usuarioTxt)) {
    var_dump($programa);
    var_dump("entro no esta disponible el usuario");
 echo json_encode(['success' => false, 'message' => 'El nombre de usuario no está disponible.']);  
} else {
    // Lógica para insertar el nuevo usuario
   
  $programa->updateEvaluador($nombreCompletoTxt, $usuarioTxt, $programaCmb, $rolCmb, $sedeCmb);
  echo json_encode(['success' => true, 'message' => 'Guardado con exito.']);    

}



?>
 


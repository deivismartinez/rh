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
$nombreCompletoTxt = strtoupper(filter_input(INPUT_POST, 'nombreCompletoTxt', FILTER_SANITIZE_SPECIAL_CHARS));
$programaCmb = strtoupper(filter_input(INPUT_POST, 'programaCmb', FILTER_SANITIZE_SPECIAL_CHARS));
$rolCmb = strtoupper(filter_input(INPUT_POST, 'rolCmb', FILTER_SANITIZE_SPECIAL_CHARS));
$sedeCmb = strtoupper(filter_input(INPUT_POST, 'sedeCmb', FILTER_SANITIZE_SPECIAL_CHARS));
$usuarioTxt = strtoupper(filter_input(INPUT_POST, 'usuarioTxt', FILTER_SANITIZE_SPECIAL_CHARS));
$idEvaluador = strtoupper(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS));
$estado = strtoupper(filter_input(INPUT_POST, 'estadoCmb', FILTER_SANITIZE_SPECIAL_CHARS));
header('Content-Type: application/json');
if ($programa->existeUsuarioExcluirPropio($usuarioTxt,$idEvaluador)) {
 echo json_encode(['success' => false, 'message' => 'El nombre de usuario no está disponible.']);  
} else {
  $programa->updateEvaluador($nombreCompletoTxt, $programaCmb, $rolCmb, $sedeCmb, $usuarioTxt, $idEvaluador, $estado);
  $respuesta = json_encode(['success' => true, 'message' => 'Actualizado correctamente']);
  echo $respuesta;
}


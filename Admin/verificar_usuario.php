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

 $usuarioTxt= strtoupper($_POST["usuarioTxt"]);

   


// Obtener el nombre de usuario desde la petición AJAX
$nombre_usuario = isset($_POST['usuarioTxt']) ? $_POST['usuarioTxt'] : '';

//$existe= $programa->existeUsuario($usuarioTxt);
$resulta=$programa->existeUsuario($nombre_usuario)
if ($programa->existeUsuario($nombre_usuario)) {
    echo json_encode(['existe' => true, 'mensaje' => '$resulta ,El usuario ya existe.']);
} else {
    echo json_encode(['existe' => false, 'mensaje' => 'El usuario está disponible.']);
}
?>







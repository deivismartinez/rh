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

 $nombre_usuario = $_POST['usuarioTxt'];
header('Content-Type: application/json');
// Verificar que el usuario no existe nuevamente para mayor seguridad
if ($programa->existeUsuario($nombre_usuario)) {
    // Lógica para insertar el nuevo usuario
   echo json_encode(['success' => false, 'message' => 'Error: El usuario ya existe.']);
} else {
    echo json_encode(['success' => true, 'message' => 'Usuario registrado con éxito.']);
}

 /*$usuarioTxt= strtoupper($_POST["usuarioTxt"]);

     if (isset($usuarioTxt ) && !empty($usuarioTxt) ) {       
       $existe= $programa->existeUsuario($usuarioTxt);
    if (!$existe) { // Si no está marcado (false)
       // echo '<script type="text/javascript">alert("if existe")</script>';  
        $programa->insertarEvaluador();
         echo "Usuario registrado con éxito.";
    }else {
           echo "El nombre de la usuario no está disponible";
           }
    }*/
?>



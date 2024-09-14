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

     if (isset($usuarioTxt ) && !empty($usuarioTxt) ) {       
       $existe= $programa->existeUsuario($usuarioTxt);
    if (!$existe) { // Si no está marcado (false)
       // echo '<script type="text/javascript">alert("if existe")</script>';  
        $programa->insertarEvaluador();
         echo "Usuario registrado con éxito.";
    }else {
           echo "El nombre de la usuario no está disponible";
           }
    }



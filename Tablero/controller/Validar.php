<?php
session_start();
require_once "../clases/Usuario.php";
$login = filter_input(INPUT_POST, 'usuarioTxt', FILTER_SANITIZE_SPECIAL_CHARS);
$pass = filter_input(INPUT_POST, 'passwordPwd', FILTER_SANITIZE_SPECIAL_CHARS);
$u = new Usuario();
require_once "../clases/Periodo.php"; ////periodo
$p = new Perido();
$resultadoTraido = $u->validarUsuario($login, $pass);
if (isset($resultadoTraido)) {
    $_SESSION['usuario'] = $resultadoTraido;

    $sede = $resultadoTraido->getSede();
    if ($sede == "" or $sede == "-A") {
        $sede = "VALLEDUPAR";
    }
    //$sedeAbierta = $p->getSedeAbierta($sede);
    //var_dump($sedeAbierta);
    //var_dump($sede);
    //$sedeAbierta = $u->esValledupar($resultadoTraido->getId());
    // if (!$sedeAbierta) {
    //     header('Location: ../../SoloAguachica.html');
    // } else {
        if ($u->esActualizado($resultadoTraido->getId())) {
            //if($u->esCalificado($resultadoTraido->getId())){
            //header('Location: ../VaActualizar.php');
            //}else{
            header('Location: ../inicio.php');
            //}
            //header('Location: ../inicio.php');
        } else {
            header('Location: ../Tratamiento.php');
        }
 //   }
} else {
    header('Location: ErrorValidar.html');
}
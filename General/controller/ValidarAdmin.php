
<?php
require_once("../clases/Usuario.php");
$login = filter_input(INPUT_POST, 'usuarioTxt', FILTER_SANITIZE_SPECIAL_CHARS);
$pass = filter_input(INPUT_POST, 'passwordPwd', FILTER_SANITIZE_SPECIAL_CHARS);
$u = new Usuario();
$resultadoTraido= $u->validarUsuario($login, $pass);
    if (isset($resultadoTraido)) {
            session_start();
            $_SESSION['usuario'] = $resultadoTraido;
            header('Location: ../inicio.php');
        } else {
            header('Location: ErrorValidar.html');
        }
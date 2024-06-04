<?php
require_once("../clases/Usuario.php");
session_start();
$login = filter_input(INPUT_POST, 'usuarioTxt', FILTER_SANITIZE_SPECIAL_CHARS);
$pass = filter_input(INPUT_POST, 'passwordPwd', FILTER_SANITIZE_SPECIAL_CHARS);
$u = new Usuario();
$resultadoTraido= $u->validarUsuarioAdmin($login, $pass);
    if (isset($resultadoTraido)) {
            $_SESSION['usuario'] = $resultadoTraido;
            $_SESSION['administrador'] = 'si';
            $_SESSION['administrar'] = $resultadoTraido;
            if($resultadoTraido->getTipo()=='DECANO'){
                $_SESSION['decano'] = 'SI';
                header('Location: ../../Admin/inicioAdminDecano.php');
            }else{
            if($resultadoTraido->getTipo()=='JEFE'){
                $_SESSION['jefe'] = 'SI';
                header('Location: ../../Admin/inicioAdminJefe.php');
            }else{
            header('Location: ../../Admin/inicioAdmin.php');
            }
            }
        } else {
            header('Location: ErrorValidarAdmin.html');
        }
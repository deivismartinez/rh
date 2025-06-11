<?php
require_once("../clases/Usuario.php");
session_start();
$login = filter_input(INPUT_POST, 'usuarioTxt', FILTER_SANITIZE_SPECIAL_CHARS);
$pass = filter_input(INPUT_POST, 'passwordPwd', FILTER_SANITIZE_SPECIAL_CHARS);
$u = new Usuario();
$resultadoTraido= $u->validarUsuarioAdmin($login, $pass);
var_dump($resultadoTraido);
    if (isset($resultadoTraido)) {
            $_SESSION['usuario'] = $resultadoTraido;
            $_SESSION['administrador'] = 'si';
            $_SESSION['administrar'] = $resultadoTraido;
            if($resultadoTraido->getTipo()=='DECANO'AND $resultadoTraido->getSede()=='AGUACHICA'){
                $_SESSION['decano'] = 'SI';
                header('Location: ../../Admin/CalificadosDecano.php');
            }else{

            if($resultadoTraido->getTipo()=='DECANO'){
                $_SESSION['decano'] = 'SI';
                header('Location: ../../Admin/CalificadosDecano.php');
            }else{
            if($resultadoTraido->getTipo()=='JEFE'){
                $_SESSION['jefe'] = 'SI';
                header('Location: ../../Admin/inicioAdminJefe.php');
            }else{
                if($resultadoTraido->getTipo()=='SUPERVISOR'){
                    $_SESSION['supervisor'] = 'SI';
                    header('Location: ../../Admin/CalificadosSupervisor.php');
                }else{ 
                    if ($resultadoTraido->getTipo()=='ADMIN') {
                        $_SESSION['admin'] = 'SI';
                        header('Location: ../../Admin/Agregar.php');
                    }else {
                        if ($resultadoTraido->getTipo()=='EVALUADOR') {
                            header('Location: ../../Admin/inicioEvaluador.php'); 
                        }else{
                            header('Location: ../../Admin/inicioAdmin.php');
                        }
                    }
                    
            
            }
        }
        }
    }   
        } else {
            header('Location: ErrorValidarAdmin.html');
        }
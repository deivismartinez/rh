<?php
require_once 'vo/UsuarioVO.php';
require_once("clases/Usuario.php");
session_start();
if (isset($_SESSION['usuario']) && isset($_SESSION['administrador'])) {
    $usuario = $_SESSION['usuario'];
    $nombre = $usuario->getName();
    $programa = $usuario->getlastName();
    if (isset($_POST["claveTxt"])) {
    $u = new Usuario();
    $u->actualizarClaveAdmin();
}
} else {
    header('Location: AccesoNoautorizado.html');
}
?>
<!DOCTYPE html>
<html> 
    <head> 
        

        <link rel="icon" type="image/png" href="../Tablero/assets/img/favicon.ico">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>Administración Inscripción Docente Unicesar</title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        <link href="../Tablero/assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="../Tablero/assets/css/animate.min.css" rel="stylesheet"/>
        <link href="../Tablero/assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>
        <link href="../Tablero/assets/css/demo.css" rel="stylesheet" />
        <link href="../Tablero/assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
        <style>
        
            #centered {
                position: fixed;
                top: 50%;
                left: 50%;
                /* bring your own prefixes */
                transform: translate(-30%, -50%);
            }
            
        </style>
        <script type="text/javascript">
            function validacion(frm) {
                if (frm.claveTxt.value.trim() === '' || frm.correoTxt.value.trim() === '' 
                        || frm.identificacionTxt.value.trim() === '') {
                    alert('[ERROR] Los campos no pueden estar vacíos');
                } else {
                    if (frm.correoTxt.value.trim().length < 4) {
                        alert('[ERROR] El correo debe tener 2 o más letras');
                    } else {
                        if (frm.claveTxt.value.trim().length < 5) {
                            alert('[ERROR] La clave debe tener 5 o más simbolos');
                        } else {
                            if (frm.claveTxt.value === frm.confirmarTxt.value) {
                                    frm.submit();
                            } else {
                                alert('[ERROR] La Clave no está bien confirmada');
                            }
                        }
                    }
                }
            }
        </script>
    </head> 
    <body> 

    <div class="wrapper">
            <div class="sidebar" data-color="green" data-image="../images/sidebar-5.jpg">
                <div class="sidebar-wrapper">
                    <div class="logo">
                        <a href="#" class="simple-text">
                            Consulta de Inscritos a el Departamento
                        </a>
                    </div>
                    <?php include("../Admin/includes/menuAdmin.php");?>
                </div>
            </div>

            <div class="main-panel">
                <nav class="navbar navbar-default navbar-fixed">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                                <span class="sr-only"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <img class="img-responsive" alt="UPC" src="../images/titulo.png">
                        </div>
                        <div class="collapse navbar-collapse">
                        </div>
                    </div>
                </nav>

        <div class="panel">

            <div class="col-xs-12">
                <div class="row" id="centered">
                    <div class="col-xs-8">
                        <div class="panel panel-primary">
                            <div class = "panel-heading">
                                <h2 class = "panel-title"><h2><p align=center><b>RESTAURACIÓN DE LA CLAVE DE LOS DOCENTES</b></p></h2></h2>
                            </div>
                            <div class="panel-body">
                                <form autocomplete="off" method="POST" action="" name="entradaFrm" id="entradaFrm">
                                    <div class="form-group" >
                                        <div class="col-xs-12">
                                            <label for="identificacionTxt" class="control-label">Identificación (sin puntos) *</label>
                                            <input value="" type="text" required class="form-control" id="identificacionTxt" name="identificacionTxt" placeholder="No. CC, TI, CE, RC">
                                        </div>
                                        <div class="col-xs-12">
                                            <label for="correoTxt" class="control-label">Correo electronico *</label>
                                            <input value="" type="mail" autocomplete="new-mail" required class="form-control" id="correoTxt" name="correoTxt">
                                            <input value="" type="hidden" id="token" name="token">
                                        </div>
                                        
                                        <div class="col-xs-12">
                                            <label for="claveTxt" class="control-label">Clave *</label>
                                            <input type="password" autocomplete="new-password" required class="form-control" id="claveTxt" name="claveTxt">
                                        </div>
                                        <div class="col-xs-12">
                                            <label for="confirmarTxt" class="control-label">Confirmar la Clave *</label>
                                            <input type="password" required class="form-control" id="confirmarTxt" name="confirmarTxt">
                                        </div>
                                        <div class="col-xs-12">
                                            <p align = "right">
                                                <button type="submit" class="btn btn-primary" onclick="validacion(document.entradaFrm)">
                                                    <span class="glyphicon glyphicon-user"></span> Guardar
                                                </button>
                                            </p>
                                        </div>
                                        <div class="col-md-12">
                                            <a href="../Admin/Agregar.php">
                                            <span class="glyphicon glyphicon-user"></span> Inicio
                                        </a>
                                    </div>
                                    </div>
                                </form>
                            </div>
                            <div class="panel-footer">
                                <p align="center"><small>&copy; <b><script>document.write(new Date().getFullYear())</script> <a href="http://www.unicesar.edu.co">Unicesar</a></b> </small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
        <script src="http://code.jquery.com/jquery.js"></script> 
        <script src="../Boot/js/bootstrap.min.js"></script> 

    </body> 
</html>

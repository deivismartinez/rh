<?php
require_once '../Tablero/vo/UsuarioVO.php';
require_once "../Tablero/clases/Programas.php";
require_once "../Tablero/clases/Docente.php";
$p = new Programas();
session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
    $nombre = $usuario->getName();
    $programa = $usuario->getlastName();
    require_once("clases/Docente.php");
$d = new Docente();
$docente = $d->getDatos($usuario->getId());
    if (isset($_POST["claveTxt"])) {
        $u = new Docente();
        $u->actualizarMiClave($usuario->getId());
    }
} else {
    header('Location: AccesoNoautorizado.html');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="../Tablero/assets/img/favicon.ico">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>Inscripción Docente Unicesar</title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        <link href="../Tablero/assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="../Tablero/assets/css/animate.min.css" rel="stylesheet"/>
        <link href="../Tablero/assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>
        <link href="../Tablero/assets/css/demo.css" rel="stylesheet" />
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
        <link href="../Tablero/assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
        <style>
            body{
                padding-top:15px;
                font-family: 'Open Sans', sans-serif;
                font-size:13px;
            }

            .tabla {
                margin: 0 auto;
            }
            .tabla thead {
                cursor: pointer;
                background: rgba(0, 0, 255, 1);
                color: rgba(255, 255, 255, 1);
            }
            .tabla thead tr th {
                font-weight: bold;
                padding: 10px 20px;
            }
            .tabla thead tr th span {
                padding-right: 20px;
                background-repeat: no-repeat;
                background-position: 100% 55%;
            }
            .tabla tbody tr td {
                text-align: center;
                padding: 10px 20px;
            }
            .tabla tbody tr td.align-left {
                text-align: left;
            }
        </style>
        <script type="text/javascript">
            function validacion(frm) {
                if (frm.claveTxt.value.trim() === '' || frm.identificacionTxt.value.trim() === '') {
                    alert('[ERROR] Los campos no pueden estar vacíos');
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
        </script>
    </head>
    <body>
        <div class="wrapper">
        <div class="sidebar" data-color="green" data-image="assets/img/sidebar-5.jpg">

<div class="sidebar-wrapper">
    <div class="logo">
        <a href="#" class="simple-text">
            Inscripción Docentes Unicesar
        </a>
    </div>

    <ul class="nav">
        <li >
            <a href="inicio.php">
                <i class="pe-7s-home"></i>
                <p>Inicio</p>
            </a>
        </li>
        <li>
            <a href="Basica.php">
                <i class="pe-7s-user"></i>
                <p>Información Básica</p>
            </a>
        </li>
        <li>
            <a href="Academica.php">
                <i class="pe-7s-study"></i>
                <p>Información Académica</p>
            </a>
        </li>
        <?php ///abre condicion sede A DISTANCIA
                            if ($docente->getSede()!='A DISTANCIA') {
                            ?>
                        <li>
                            <a href="Programa.php">
                                <i class="pe-7s-note2"></i>
                                <p>Área a inscribirse</p>
                            </a>
                        </li>
                        <?php ///CIERRA condicion sede A DISTANCIA
                                }
                            ?>
        <li>
                            <a href="ProgramaPostgrado.php">
                                <i class="pe-7s-global"></i>
                                <p>Docente de Postgrados o a Distancia</p>
                            </a>
                        </li>
        <li>
            <a href="Experiencia.php">
                <i class="pe-7s-display1"></i>
                <p>Experiencia Calificada</p>
            </a>
        </li>
        <li>
            <a href="Produccion.php">
                <i class="pe-7s-science"></i>
                <p>Producción Académica</p>
            </a>
        </li>
        <!--<li class="active">
                            <a href="Resumen.php">
                                <i class="pe-7s-bookmarks"></i>
                                <p>Resumen del Puntaje</p>
                            </a>
                        </li>-->
        <li class="active">
            <a href="ModificarMiClave.php">
                <i class="pe-7s-key"></i>
                <p>Cambio de Contraseña</p>
            </a>
        </li>
<li>
            <a href="../index.php">
                <i class="pe-7s-power"></i>
                <p>Salir</p>
            </a>
        </li>
    </ul>
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

                <div class="content">
                    <div class="container-fluid">
                    </div>
                    <div class="col-xs-12">
                        <h5>
                            <?php echo $nombre; ?>
                        </h5>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-xs-7">
                        <div class="panel panel-primary">
                            <div class = "panel-heading">
                                <h2 class = "panel-title"><h2><p align=center><b>RESTAURACIÓN DE LA CLAVE ADMINISTRADOR</b></p></h2></h2>
                            </div>
                            <div class="panel-body">
                                <form method="POST" action="" name="entradaFrm" id="entradaFrm">
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <label for="identificacionTxt" class="control-label">Clave Anterior *</label>
                                            <input value="" type="password" required class="form-control" id="identificacionTxt" name="identificacionTxt" placeholder="Contraseña">
                                        </div>
                                        <div class="col-xs-12">
                                            <label for="claveTxt" class="control-label">Clave *</label>
                                            <input type="password" required class="form-control" id="claveTxt" name="claveTxt">
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
    </body>
    <script src="../Tablero/assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
    <script src='../Tablero/assets/js/jquery2.1.3sorter.js'></script>
    <script>
                                                function buscar() {
                                                    //obtenemos el texto introducido en el campo de búsqueda
                                                    consulta = $("#busqueda").val();
                                                    area = $("#areasCmb").val();
                                                    //hace la búsqueda
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "buscar.php",
                                                        data: {'b': $("#busqueda").val(),
                                                            'area': area},
                                                        dataType: "html",
                                                        beforeSend: function () {
                                                            //imagen de carga
                                                            $("#resultado").html("<p align='center'><img src='../images/load.gif' /></p>");
                                                        },
                                                        error: function () {
                                                            alert("error petición ajax");
                                                        },
                                                        success: function (data) {
                                                            $("#resultado").empty();
                                                            $("#resultado").append(data);
                                                        }
                                                    });
                                                }
                                                $(function () {
                                                    $('#mi-tabla').tablesorter();
                                                });


    </script>

    <script src="../Tablero/assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../Tablero/assets/js/chartist.min.js"></script>
    <script src="../Tablero/assets/js/bootstrap-notify.js"></script>
    <script src="../Tablero/assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>
    <script src="../Tablero/assets/js/demo.js"></script>

    <script type="text/javascript">
                                                $(document).ready(function () {
                                                    demo.initChartist();
                                                    $.notify({
                                                        icon: 'pe-7s-notebook',
                                                        message: "Bienvenido(a) <b>Ahora puede consultar el banco de hojas de vida</b>"
                                                    }, {
                                                        type: 'info',
                                                        timer: 4000
                                                    });
                                                });
    </script>
</html>

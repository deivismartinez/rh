<?php
require_once "../Tablero/vo/UsuarioVO.php";
session_start();
$usuario = $_SESSION['usuario'];
if (isset($usuario)) {
require_once("clases/Docente.php");
$d = new Docente();
$docente = $d->getDatos($usuario->getId());

} else {
    header("Location: ../Entrada.html");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="assets/img/favicon.ico">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title>Inscripción Docente Unicesar</title>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />


        <!-- Bootstrap core CSS     -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

        <!-- Animation library for notifications   -->
        <link href="assets/css/animate.min.css" rel="stylesheet"/>

        <!--  Light Bootstrap Table core CSS    -->
        <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>


        <!--  CSS for Demo Purpose, don't include it in your project     -->
        <link href="assets/css/demo.css" rel="stylesheet" />


        <!--     Fonts and icons     -->
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
        <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
        <style>
            .tr {
                color: #fff;
                background-color: #00ff00;
            }
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
                        <li>
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
                        <li>
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
                    <div class="row">
                        <div class="col-xs-12">
                            <a href="HojaVida.php" target="_blank"><h3>Imprimir Hoja de Vida</h3></a>
                          
                        </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="col-xs-12">
                                
                            </div>
                        </div>
                 
                    </div>
                </div>
            </div>
        </div>


    </body>

    <!--   Core JS Files   -->
    <script src="js/funciones.js"></script>

    <script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!--  Charts Plugin -->
    <script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
    <script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

    <!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
    <script src="assets/js/demo.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {

            demo.initChartist();

            $.notify({
                icon: 'pe-7s-notebook',
                message: "Por favor diligencie <b>Su información Académica</b>"

            }, {
                type: 'info',
                timer: 1000
            });

        });
    </script>

</html>
<?php

function cabeza()
{
    echo '<table cellspacing="0" cellpadding="0" id="mi-tabla" class="table-bordered tabla">
                                                <thead>
                                                    <tr>
                                                    <th><span>No.</span></th>
                                                        <th><span>Apellidos</span></th>
                                                        <th><span>Nombre</span></th>
                                                        <th><span>Puntaje</span></th>
                                                    </tr>
                                                </thead>
                                                <tbody>';
}
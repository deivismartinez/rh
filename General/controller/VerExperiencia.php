<?php
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
$tipo = filter_input(INPUT_GET, 'tipo', FILTER_SANITIZE_SPECIAL_CHARS);
require_once("../../Tablero/vo/UsuarioVO.php");
session_start();
$usuario = $_SESSION['usuario'];
if (isset($usuario)) {
    require_once("../clases/Experiencias.php");
    $e = new Experiencias();
    $datos = $e->getDatosExperiencia($id);
} else {
    header("Location: ../../Entrada.html");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title>Inscripción Docente Unicesar</title>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="../assets/css/animate.min.css" rel="stylesheet"/>
        <link href="../assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>
        <link href="../assets/css/demo.css" rel="stylesheet" />
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
        <link href="../assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
    </head>
    <body>

        <div class="wrapper">
            <div class="sidebar" data-color="green" data-image="../assets/img/sidebar-5.jpg">

                <!--
            
                    Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
                    Tip 2: you can also add an image using data-image tag
            
                -->

                <div class="sidebar-wrapper">
                    <div class="logo">
                        <a href="#" class="simple-text">
                            Inscripción Docentes Unicesar
                        </a>
                    </div>

                    <ul class="nav">
                        <li class="active">
                            <a href="../inicio.php">
                                <i class="pe-7s-home"></i>
                                <p>Inicio</p>
                            </a>
                        </li>
                        <li>
                            <a href="../Basica.php">
                                <i class="pe-7s-user"></i>
                                <p>Información Básica</p>
                            </a>
                        </li>
                        <li>
                            <a href="../Academica.php">
                                <i class="pe-7s-study"></i>
                                <p>Información Académica</p>
                            </a>
                        </li>
                        <li>
                            <a href="../Programa.php">
                                <i class="pe-7s-note2"></i>
                                <p>Programa a inscribirse</p>
                            </a>
                        </li>
                        <li>
                            <a href="../Experiencia.php">
                                <i class="pe-7s-display1"></i>
                                <p>Experiencia Calificada</p>
                            </a>
                        </li>
                        <li>
                            <a href="../Produccion.php">
                                <i class="pe-7s-science"></i>
                                <p>Producción Académica</p>
                            </a>
                        </li>
                        <li>
                            <a href="../Resumen.php">
                                <i class="pe-7s-bookmarks"></i>
                                <p>Resumen del Puntaje</p>
                            </a>
                        </li>
                        <li class="active-pro">
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
                            <img class="img-responsive" alt="UPC" src="../../images/titulo.png">
                        </div>
                        <div class="collapse navbar-collapse">
                        </div>
                    </div>
                </nav>


                <div class="content">
                    <div class="container-fluid">
                    </div>
                    <div class="row">
                        <div class="container">
                            <div class="col-xs-12">
                                <div class="col-xs-11">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Agregando una nueva experiencia</h3>
                                        </div>
                                        <div class="panel-body">
                                            <form name="form" action="" method="post" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-xs-6">
                                                        <label for="telefono">Tipo de Experiencia</label>
                                                        <input value="<?php echo $datos->getTipo() ?>" disabled="true" type="text" id="tipoExperienciaCmb" name="tipoExperienciaCmb"class="form-control"/>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <label for="telefono">Empresa/Institución</label>
                                                        <input value="<?php echo $datos->getInstitucion() ?>" disabled="true" type="text" id="empresaTxt" name="empresaTxt" class="form-control" required="true" required="true"/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-6">
                                                        <label for="nombre">Cargo</label>
                                                        <input value="<?php echo $datos->getCargo() ?>" disabled="true" type="text" name="cargoTxt" id="cargoTxt" autofocus="true" class="form-control" required="true"/>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <label for="correo">Dirección *</label>
                                                        <input value="<?php echo $datos->getDireccion() ?>" disabled="true" type="text" name="direccionTxt" id="direccionTxt" required="true" class="form-control" required="true"/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-6">
                                                        <label for="nombre">Telefono *</label>
                                                        <input value="<?php echo $datos->getTelefono() ?>" disabled="true" type="text" name="telefonoTxt" id="telefonoTxt" autofocus="true" class="form-control" required="true"/>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <label for="correo">Correo *</label>
                                                        <input value="<?php echo $datos->getCorreo() ?>" disabled="true" type="text" name="correoTxt" id="correoTxt" required="true" class="form-control" required="true"/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <label for="nombre">Fecha Inicial *</label>
                                                        <input value="<?php echo $datos->getFechainicio() ?>" disabled="true" type="text" max="<?php $hoy = date("Y-m-d");
echo $hoy; ?>" name="fechaInicialDtp" id="fechaInicialDtp" autofocus="true" class="form-control" required="true"/>
                                                    </div>
                                                    <div class="col-xs-3">
                                                        <label for="correo">Fecha Final *</label>
                                                        <input value="<?php echo $datos->getFechafin() ?>" disabled="true" type="text" max="<?php $hoy1 = date("Y-m-d");
echo $hoy; ?>" name="fechaFinalDtp" id="fechaFinalDtp" required="true" class="form-control" required="true"/>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <label for="nombre">Número de periodos *</label>
                                                        <input value="<?php echo $datos->getNumeroPeriodos() ?>" disabled="true"  type="number" name="numeroPeriodosTxt" id="numeroPeriodosTxt" placeholder="Semestres" class="form-control" required="true"/>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <a href="VerAdjuntoExp.php?id=<?php echo $id.'&tipo='.$tipo ?>"  target="_blank">
                                                            <h5><p align="center"><i class="pe-7s-video"></i> Ver Adjunto PDF</p></h5>
                                                        </a>
                                                    </div>
                                                </div>
                                                <hr />
                                                <div class="col-md-12">
                                                    <a href="../Experiencia.php">
                                                        <h4><i class="pe-7s-back"></i>Volver</h4>
                                                    </a>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="panel-footer">
                                            &copy; <script>document.write(new Date().getFullYear())</script> <a href="http://www.unicesar.edu.co">Unicesar</a>, creado para Vicerrectoria Académica 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <footer class="footer">
                <div class="container-fluid">

                    <p class="copyright pull-right">

                    </p>
                </div>
            </footer>
        </div>
    </body>
    <script src="../assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
    <script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../assets/js/chartist.min.js"></script>
    <script src="../assets/js/bootstrap-notify.js"></script>
    <script src="../assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>
    <script src="../assets/js/demo.js"></script>
    <script type="text/javascript">
                                                $(document).ready(function () {

                                                    demo.initChartist();

                                                    $.notify({
                                                        icon: 'pe-7s-notebook',
                                                        message: "Por favor diligencie <b>Su información Académica</b>"

                                                    }, {
                                                        type: 'info',
                                                        timer: 4000
                                                    });

                                                });
    </script>

</html>

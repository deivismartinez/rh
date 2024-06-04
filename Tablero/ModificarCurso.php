<?php
require_once("clases/Estudios.php");
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
$estudios = new Estudios();
$curso = $estudios->getDatosCursoIdModificar($id);
if (isset($_POST["nombreTxt"])) {
    $u = new Estudios();
    $u->actualizarCurso();
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
                        <li class="active">
                            <a href="Academica.php">
                                <i class="pe-7s-study"></i>
                                <p>Información Académica</p>
                            </a>
                        </li>
                        <programa></programa>
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
                        <li>
                            <a href="Resumen.php">
                                <i class="pe-7s-bookmarks"></i>
                                <p>Resumen del Puntaje</p>
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
                    <div class="row">
                            <div class="col-xs-12">
                                <div class="col-xs-11">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Modificar curso</h3>
                                        </div>
                                        <div class="panel-body">
                                            <form name="form" action="" method="post" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                    <label for="nombre">Nombre del curso *</label>
                                                    <input type="text" value="<?php echo $curso->getNombre() ?>" name="nombreTxt" id="nombreTxt" placeholder="" autofocus="true" class="form-control" required="true"/>
                                                    <input type="hidden" value="<?php echo $id?>"  name="idTraido" id="idTraido"/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                    <label for="correo">Institución donde realizó el curso *</label>
                                                    <input type="text" value="<?php echo $curso->getInstitucion() ?>" name="institucionTxt" id="institucionTxt" required="true" class="form-control" required="true"/>
                                                </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                    <label for="telefono">Tipo de curso</label>
                                                    <select class="form-control" id="tipoCursoCmb" name="tipoCursoCmb" required="true">
                                                            <option value="">SELECCIONE</option>
                                                            <option value="CURSO">CURSO</option>
                                                            <option value="DIPLOMADO">DIPLOMADO</option>
                                                            <option value="SEMINARIO">SEMINARIO</option>
                                                        </select>
                                                </div>
                                                <div class="col-xs-4">
                                                    <label for="telefono">Duración en Horas</label>
                                                    <input type="number" value="<?php echo $curso->getDuracion() ?>" min="0" id="duracionNbr" name="duracionNbr" placeholder="" class="form-control" required="true" required="true"/>
                                                </div>
                                                    <div class="col-xs-4">
                                                    <label for="fecha">Fecha de finalización *</label>
                                                    <input type="date" value="<?php echo $curso->getFechaFin() ?>" max="<?php $hoy=date("Y-m-d"); echo $hoy;?>" name="fechaFinalizacionDte" id="fechaFinalizacionDte" class="form-control" required="true"/>
                                                </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                    <label for="correo">Adjuntar soporte en formato pdf *</label>
                                                    <input type="file" name="soporteFle" accept="application/pdf" name="soporteFle" required="true" class="form-control"/>
                                                </div>
                                                </div>
                                                <hr />
                                                <input type="submit" value="Modificar" class="btn btn-primary"/>
                                                <div class="col-md-12">
                                <a href="Academica.php">
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


            <footer class="footer">
                <div class="container-fluid">

                    <p class="copyright pull-right">
                        
                    </p>
                </div>
            </footer>
        </div>


    </body>

    <!--   Core JS Files   -->
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
                                    timer: 4000
                                });

                            });
    </script>

</html>

<?php
require_once("clases/Producciones.php");
if (isset($_POST["tituloTxt"])) {
    $u = new Producciones();
    $u->insertarVideo();
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
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/css/animate.min.css" rel="stylesheet"/>
        <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>
        <link href="assets/css/demo.css" rel="stylesheet" />
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
                        <li>
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
                        <li class="active">
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
                                            <h3 class="panel-title">Agregando un nuevo video</h3>
                                        </div>
                                        <div class="panel-body">
                                            <form name="form" action="" method="post" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-xs-6">
                                                        <label for="telefono">Tipo *</label>
                                                        <select class="form-control" id="tipoRevistaCmb" name="tipoRevistaCmb" required="true">
                                                            <option value="">SELECCIONE</option>
                                                            <option value="0">NACIONAL</option>
                                                            <option value="1">INTERNACIONAL</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <label for="telefono">Título de la Producción *</label>
                                                        <input type="text" id="tituloTxt" name="tituloTxt" placeholder="" class="form-control" required="true" required="true"/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-6">
                                                        <label for="correo">Numero de Autores *</label>
                                                        <input type="number" name="numeroAutoresNbr" id="numeroAutoresNbr" required="true" class="form-control" required="true"/>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <label for="nombre">Fecha de Publicación *</label>
                                                        <input type="date" max="<?php $hoy = date("Y-m-d");
echo $hoy; ?>" name="fechaPublicacionDtp" id="fechaPublicacionDtp" placeholder="" autofocus="true" class="form-control" required="true"/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <label for="soporteFle">Adjuntar soporte en formato pdf *</label>
                                                        <input type="file" name="soporteFle" accept="application/pdf" name="soporteFle" required="true" class="form-control"/>
                                                    </div>
                                                </div>
                                                <hr />
                                                <input type="submit" value="Guardar" class="btn btn-primary"/>
                                                <div class="col-md-12">
                                                    <a href="Produccion.php">
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

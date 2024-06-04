<!DOCTYPE html>
<?php
require_once("../Tablero/vo/UsuarioVO.php");
session_start();
$usuario = $_SESSION['usuario'];
if (isset($usuario)) {
    require_once("clases/Puntajes.php");
    $puntajes = new Puntajes();
    $listaPuntajes = $puntajes->getPuntajeTotal($usuario);
    $totalPuntosAca = $listaPuntajes->getDoctorado() + $listaPuntajes->getMaestria() + $listaPuntajes->getEspecializacion();
    $totalPuntosExp = $listaPuntajes->getExpCatedratico() + $listaPuntajes->getExpMedioTiempo() + $listaPuntajes->getExpProfesional() + $listaPuntajes->getExpTiempoCompleto();
    $totalInvestigacion = $listaPuntajes->getGrupo() + $listaPuntajes->getCategoriaInvestigador();
    $totalPublicaciones = $listaPuntajes->getArticulo() + $listaPuntajes->getLibro() + $listaPuntajes->getPatente() + $listaPuntajes->getSoftware();
    $totalPuntos = $listaPuntajes->getCategoria() + $totalPuntosAca + $totalPuntosExp + $totalInvestigacion + $totalPublicaciones;
    require_once("clases/Programas.php");
    $programas = new Programas();
    $programa = $programas->getProgramaUsuarioPerfil($usuario);
} else {
    header("Location: ../Entrada.html");
}
?>
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
                        <li>
                            <a href="Programa.php">
                                <i class="pe-7s-note2"></i>
                                <p>Área a inscribirse</p>
                            </a>
                        </li>
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
                        <li class="active">
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
                    <div class="container-fluid">
                    </div>
                    <div class="row">
                            <div class="col-xs-12">
                            <a href="HojaVida.php" target="_blank"><h3>Imprimir Hoja de Vida</h3></a>
                            <table class="table table-bordered">	
                                                    <thead>	
                                                        <tr class="info">
                                                            <th>Facultad</th>
                                                            <th>Departamento</th>
                                                            <th>Área de Conocimiento</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($programa as $arreglo) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $arreglo[0] ?></td>
                                                                <td><?php echo $arreglo[1] ?></td>
                                                                <td><?php echo $arreglo[2] ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                        </div>
                        <div class="container">
                            <div class="col-xs-12">
                                <div class="col-xs-3">
                                    <div class="panel panel-warning">
                                        <div class="panel-heading">
                                            TOTAL PUNTOS = <?php echo $totalPuntos ?>
                                        </div>
                                        <div class="panel-body">
                                            <table class="table table-bordered">	
                                                <thead>	
                                                    <tr class="info">
                                                        <th style="text-align: center;">CRITERIO</th>
                                                        <th style="text-align: center;">PUNTAJE</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>TITULOS</td>
                                                        <td style="text-align: right;"><?php echo $totalPuntosAca; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>CATEGORIA</td>
                                                        <td style="text-align: right;"><?php echo $listaPuntajes->getCategoria(); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>EXPERIENCIA</td>
                                                        <td style="text-align: right;"><?php echo $totalPuntosExp; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>INVESTIGACIÓN</td>
                                                        <td style="text-align: right;"><?php echo $totalInvestigacion; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>PUBLICACIONES</td>
                                                        <td style="text-align: right;"><?php echo $totalPublicaciones; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            TITULOS (<?php echo $totalPuntosAca ?>)
                                        </div>
                                        <div class="panel-body">
                                            <table class="table table-bordered">	
                                                <thead>	
                                                    <tr class="info">
                                                        <th style="text-align: center;">TITULO</th>
                                                        <th style="text-align: center;">PUNTAJE</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>ESPECIALIZACIONES</td>
                                                        <td style="text-align: right;"><?php echo $listaPuntajes->getEspecializacion(); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>MAESTRIAS</td>
                                                        <td style="text-align: right;"><?php echo $listaPuntajes->getMaestria(); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>DOCTORADOS</td>
                                                        <td style="text-align: right;"><?php echo $listaPuntajes->getDoctorado(); ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            CATEGORIA (<?php echo $listaPuntajes->getCategoria() ?>)
                                        </div>
                                        <div class="panel-body">
                                            <table class="table table-bordered">	
                                                <thead>	
                                                    <tr class="info">
                                                        <th style="text-align: center;">CATEGORIA</th>
                                                        <th style="text-align: center;">PUNTAJE</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><?php echo $listaPuntajes->getNombreCategoria(); ?></td>
                                                        <td style="text-align: right;"><?php echo $listaPuntajes->getCategoria(); ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12">
                                    <div class="col-xs-4">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                EXPERIENCIA (<?php echo $totalPuntosExp ?>)
                                            </div>
                                            <div class="panel-body">
                                                <table class="table table-bordered">	
                                                    <thead>	
                                                        <tr class="info">
                                                            <th style="text-align: center;">TIPO</th>
                                                            <th style="text-align: center;">PUNTAJE</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>DOCENTE CATEDRÁTICO</td>
                                                            <td style="text-align: right;"><?php echo $listaPuntajes->getExpCatedratico(); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>DOCENTE MEDIO TIEMPO</td>
                                                            <td style="text-align: right;"><?php echo $listaPuntajes->getExpMedioTiempo(); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>DOCENTE TIEMPO COMPLETO</td>
                                                            <td style="text-align: right;"><?php echo $listaPuntajes->getExpTiempoCompleto(); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>PROFESIONAL</td>
                                                            <td style="text-align: right;"><?php echo $listaPuntajes->getExpProfesional(); ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                INVESTIGACIÓN (<?php echo $totalInvestigacion ?>)
                                            </div>
                                            <div class="panel-body">
                                                <table class="table table-bordered">	
                                                    <thead>	
                                                        <tr class="info">
                                                            <th style="text-align: center;">TIPO</th>
                                                            <th style="text-align: center;">PUNTAJE</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>GRUPO</td>
                                                            <td style="text-align: right;"><?php echo $listaPuntajes->getGrupo(); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>CATEGORIA</td>
                                                            <td style="text-align: right;"><?php echo $listaPuntajes->getCategoriaInvestigador(); ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                PUBLICACIONES, SOFTWARE Y PATENTES (<?php echo $totalPublicaciones ?>)
                                            </div>
                                            <div class="panel-body">
                                                <table class="table table-bordered">	
                                                    <thead>	
                                                        <tr class="info">
                                                            <th style="text-align: center;">TIPO</th>
                                                            <th style="text-align: center;">PUNTAJE</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>ARTICULO</td>
                                                            <td style="text-align: right;"><?php echo $listaPuntajes->getArticulo(); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>LIBRO</td>
                                                            <td style="text-align: right;"><?php echo $listaPuntajes->getLibro(); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>PATENTE</td>
                                                            <td style="text-align: right;"><?php echo $listaPuntajes->getPatente(); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>SOFTWARE</td>
                                                            <td style="text-align: right;"><?php echo $listaPuntajes->getSoftware(); ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
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

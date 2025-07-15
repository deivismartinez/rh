<?php
require_once "../Tablero/vo/UsuarioVO.php";
require_once("../Tablero/vo/DocenteVO.php");
session_start();
$usuario = $_SESSION['usuario'];
if (isset($usuario)) {
    require_once "clases/Experiencias.php";
    require_once("clases/Docente.php");
    $e = new Experiencias();
    $experiencia = $e->getExperiencia($usuario);
    require_once "clases/Periodo.php"; ////periodo
    $p = new Perido();
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
                        <li class="active">
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
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    Agregar Programa para mi inscripción
                                </div>
                                <div class="panel-body">
                                    <div class="col-xs-12">
                                    <?php ///abre condicion periodo
if ($p->PeridoSede("'".$docente->getSede()."'")) {
    ?>
                                       <div class="col-xs-12">
                                            <a href="NuevoExperiencia.php"><i class="pe-7s-plus"></i> <ins><b>Agregar Experiencia</b></ins></a>
                                        </div>
                                    <?php ///cierra condicion periodo
}
?>
                                    </div>
                                    <div class="col-xs-12">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr class="info">
                                                    <th>Tipo de Experiencia</th>
                                                    <th>Empresa/Institución</th>
                                                    <th>Cargo</th>
                                                    <th>Fecha de Inicio</th>
                                                    <th>Fecha de Retiro</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
foreach ($experiencia as $arreglo) {
    ?>
                                                    <tr>
                                                        <td><?php echo $arreglo[0] ?></td>
                                                        <td><?php echo $arreglo[1] ?></td>
                                                        <td><?php echo $arreglo[2] ?></td>
                                                        <td><?php echo $arreglo[3] ?></td>
                                                        <td><?php echo $arreglo[4] ?></td>
                                                        <?php
$url = "eliminar('controller/EliminarExperiencia.php?id=" . $arreglo[5] . "&idUsuario=" . $usuario->getId() . "');";
    $urlVer = "controller/VerExperiencia.php?id=" . $arreglo[5] . "&tipo=1";
    $urlMod = "ModificarExperiencia.php?id=" . $arreglo[5] . "&tipo=1";
    ?>
                                                        <td>
                                                            <?php
if (file_exists("Soportes/exp" . $arreglo[5] . ".pdf")) {} else {echo 'No tiene Adjunto';}
    ?>
                                                            <a data-toggle="tooltip" title="Ver información" href="<?php echo $urlVer; ?>"><i class="pe-7s-credit"></i></a>
                                                            <?php ///abre condicion periodo
    if ($p->PeridoSede("'".$docente->getSede()."'")) {
        ?>
                                                           <a data-toggle="tooltip" title="Modificar información" href="<?php echo $urlMod; ?>"><i class="pe-7s-refresh-cloud"></i></a>
                                                            <a data-toggle="tooltip" title="Eliminar información" href="javascript:void(0);" onclick="<?php echo $url; ?>"><i class="pe-7s-trash"></i></a>
                                                            <?php ///cierra condicion periodo
    }
    ?>
                                                        </td>
                                                    </tr>
                                                    <?php
}
?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="http://www.unicesar.edu.co">Unicesar</a>, creado para Vicerrectoria Académica
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <footer class="footer">
                <div class="container-fluid">

                    <p class="copyright pull-right">
                        &copy; <script>document.write(new Date().getFullYear())</script> <a href="http://www.unicesar.edu.co">Unicesar</a>, creado para Vicerrectoria Académica
                    </p>
                </div>
            </footer>
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
                                    message: "Por favor diligencie <b>Su experiencia</b>"

                                }, {
                                    type: 'info',
                                    timer: 4000
                                });

                            });
    </script>

</html>

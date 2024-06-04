<?php
require_once "clases/Programas.php";
require_once "../Tablero/vo/UsuarioVO.php";

session_start();
$usuario = $_SESSION['usuario'];
$p = new Programas();
$misesion=session_status();

if ($p->existeTresAreas($usuario->getId())) {
    header('Location: YaRegistrado.php');
} else {
    if (isset($_POST["areasCmb"])) {
        $u = new Programas();
        $u->insertar();
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
    <link href="assets/css/animate.min.css" rel="stylesheet" />

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet" />

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
                    <li class="active">
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
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target="#navigation-example-2">
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
                                    <h3 class="panel-title">Agregando una nueva área de conocimiento</h3>
                                </div>
                                <div class="panel-body">
                                    <form name="form" action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <label for="telefono">Facultad</label>
                                                <select class="form-control" id="facultadCmb" name="facultadCmb"
                                                    required="true" onchange=
                                                    <?php
                                                        if ($p->esPostgrados($usuario->getId()) ) {
                                                            echo '"cargarProgPost(this.value)"';
                                                        } else {     
                                                            echo '"cargarProgramas(this.value)"';
                                                        }
                                                    ?>
                                                    >
                                                    <option value="">SELECCIONE</option>
                                                    <?php
                                                    
                                                   
                                                       if ($p->esPostgrados($usuario->getId()) ) {
                                                                $facultades = $p->getFacultadesDocentePostgrado();
                                                          } else {
                                                            $facultades = $p->getFacultadesDocente();
                                                        }
                                                          
                                                            foreach ($facultades as $arregloFac) {
                                                                echo '<OPTION value="' . $arregloFac[0] . '">' . $arregloFac[1] . '</OPTION>';
                                                            }

                                                            ?>
                                                </select>
                                                <?php
                                                
                                                ?>
                                            </div>
                                            <div class="col-xs-6">
                                                <label for="telefono">Departamento</label>
                                                <div id="comboProg">
                                                    <select class="form-control" id="programaCmb" name="programaCmb"
                                                        required="true" onchange="cargarAreas(this.value)">
                                                        <option value="">SELECCIONE</option>
                                                        <?php
$program = $p->getProgramasDocente(0);
    foreach ($program as $arregloPro) {
        echo '<OPTION value="' . $arregloPro[0] . '">' . $arregloPro[1] . '</OPTION>';
    }
    ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <label for="telefono">Área de Conocimiento</label>
                                                <div id="comboAreas">
                                                    <select class="form-control" id="areasCmb" name="areasCmb"
                                                        required="true" onchange="cargarAsignaturas(this.value)">
                                                        <option value="">SELECCIONE</option>
                                                        <?php
$areas = $p->getAreas(0);
    foreach ($areas as $arregloAreas) {
        echo '<OPTION value="' . $arregloAreas[1] . '">' . $arregloAreas[0] . '</OPTION>';
    }
    ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <label for="telefono">Asignaturas (Solo para referencia, se registra el
                                                    área)</label>
                                                <div id="comboAsig">
                                                    <textarea rows="4" cols="50" disabled="false"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <hr />
                                        <input type="submit" value="Guardar" class="btn btn-primary" />
                                        <div class="col-md-12">
                                            <a href="Programa.php">
                                                <h4><i class="pe-7s-back"></i>Volver</h4>
                                            </a>
                                        </div>
                                    </form>
                                </div>
                                <div class="panel-footer">
                                    &copy; <script>
                                    document.write(new Date().getFullYear())
                                    </script> <a href="http://www.unicesar.edu.co">Unicesar</a>, creado para
                                    Vicerrectoria Académica
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
$(document).ready(function() {

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
<?php
}
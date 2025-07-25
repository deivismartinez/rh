<?php
require_once '../Tablero/vo/UsuarioVO.php';
require_once("../Tablero/clases/Programas.php");
$p = new Programas();
session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
    $nombre = $usuario->getName();
    $programa = $usuario->getlastName();
} else {
    header('Location: AccesoNoautorizado.html');
}
$page = 1;
$url = "includes/".$usuario->getTipo().".php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="../Tablero/assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Administración Inscripción Docente Unicesar</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <link href="../Tablero/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../Tablero/assets/css/animate.min.css" rel="stylesheet" />
    <link href="../Tablero/assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet" />
    <link href="../Tablero/assets/css/demo.css" rel="stylesheet" />
    <link href="../Tablero/assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
    <link href="../Tablero/assets/css/local.css" rel="stylesheet" />
</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-color="green" data-image="../images/sidebar-5.jpg">
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="#" class="simple-text">
                    Módulo de Administración.
                    </a>
                </div>
                <?php include($url); ?>
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
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Gestionar depertamentos, programas, perfiles y evaluadores
                            </div>
                            <div class="panel-body">
                                <div class="col-xs-12">
                                    <div class="col-xs-2">
                                        <div class="card">
                                            <a href="NewEvaluador.php" class="btn btn-primary">
                                            <img class="card-img-top" src="../images/evaluador.png" alt="">
                                            <div class="card-body">
                                                <div class="col-xs-12">
                                                    <h5 class="card-title">Evaluadores</h5>
                                                </div>
                                            </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-xs-2">
                                        <div class="card">
                                            <a href="NewSubject.php" class="btn btn-primary">
                                            <img class="card-img-top" src="../images/perfil.png" alt="">
                                            <div class="card-body">
                                                <div class="col-xs-12">
                                                    <h5 class="card-title">Asignatura</h5>
                                                </div>
                                            </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-xs-2">
                                        <div class="card">
                                            <a href="NewArea.php" class="btn btn-primary">
                                            <img class="card-img-top" src="../images/area.png" alt="">
                                            <div class="card-body">
                                                <div class="col-xs-12">
                                                    <h5 class="card-title">Área</h5>
                                                </div>
                                            </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-xs-2">
                                        <div class="card">
                                            <a href="NuevoPrograma.php" class="btn btn-primary">
                                            <img class="card-img-top" src="../images/programa.png">
                                            <div class="card-body">
                                                <div class="col-xs-12">
                                                    <h5 class="card-title">Programas</h5>
                                                </div>
                                            </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-xs-2">
                                        <div class="card">
                                            <a href="NewFacultad.php" class="btn btn-primary">
                                            <img class="card-img-top" src="../images/departamento.png">
                                            <div class="card-body">
                                                <div class="col-xs-12">
                                                    <h5 class="card-title">Facultad</h5>
                                                </div>
                                            </div>
                                            </a>
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
<script src="../Tablero/assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src='../Tablero/assets/js/jquery2.1.3sorter.js'></script>
<script>
    function imprimir() {
        consulta = $("#busqueda").val();
        area = $("#areasCmb").val();
        url = "Imprimir.php?area=" + area + "&b=" + consulta;
        window.open(url, "nombre de la ventana", "width=300, height=200")
    }
    $(function() {
        $('#mi-tabla').tablesorter();
    });
</script>
<script src="../Tablero/assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../Tablero/assets/js/chartist.min.js"></script>
<script src="../Tablero/assets/js/bootstrap-notify.js"></script>
<script src="../Tablero/assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>
<script src="../Tablero/assets/js/demo.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
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
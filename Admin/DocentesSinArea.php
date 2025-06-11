<?php
require_once '../Tablero/vo/UsuarioVO.php';
require_once "../Tablero/clases/Programas.php";
$p = new Programas();
session_start();
if (isset($_SESSION['usuario']) && isset($_SESSION['jefe'])) {
    $usuario = $_SESSION['usuario'];
    $nombre = $usuario->getName();
    $programa = $usuario->getlastName();
} else {
    header('Location: AccesoNoautorizado.html');
}
$page = 2;
$url = "includes/".$usuario->getTipo().".php";
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
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
        <link href="../Tablero/assets/css/local.css" rel="stylesheet" />
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
                                    Consulta General de Inscritos
                                </div>
                                <div class="panel-body" align="center" >
                                    <div class="row">
                                        <div class="col-xs-8"  >
                                            <label> Buscar Por Primer Nombre</label>
                                            <input id="busqueda" type="text"class="form-control"/>
                                        </div>
                                        <div class="col-xs-4">
                                        <br>
                                            <label> Hacer la busqueda</label>
                                            <button onclick="buscar()" class="btn btn-primary">Buscar</button>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div id="resultado">

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
    <script src="../Tablero/assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
    <script src='../Tablero/assets/js/jquery2.1.3sorter.js'></script>
    <script>
                                                function buscar() {
                                                    //obtenemos el texto introducido en el campo de búsqueda
                                                    consulta = $("#busqueda").val();
                                                    area = $("#areasCmb").val();
                                                    prog = $("#programaCmb").val();
                                                    //hace la búsqueda
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "buscarSinArea.php",
                                                        data: {'b': $("#busqueda").val(),
                                                            'area': area,'prog': prog},
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
    <script src="../Tablero/js/funciones.js"></script>
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

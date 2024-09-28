<?php
require_once '../Tablero/vo/UsuarioVO.php';
require_once("../Tablero/clases/Programas.php");
$p = new Programas();
session_start();
if (isset($_SESSION['usuario']) && isset($_SESSION['decano'])) {
    $usuario = $_SESSION['usuario'];
    $nombre = $usuario->getName();
    $programa = $usuario->getlastName();
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
        <title>Administración Inscripción Docente Unicesar</title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        <link href="../Tablero/assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="../Tablero/assets/css/animate.min.css" rel="stylesheet"/>
        <link href="../Tablero/assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>
        <link href="../Tablero/assets/css/demo.css" rel="stylesheet" />
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
                    <ul class="nav">
                        <li class="active">
                            <a href="inicioAdminVice.php">
                                <i class="pe-7s-photo-gallery"></i>
                                <p>Inscritos por Áreas</p>
                            </a>
                        </li>
                        <li>
                            <a href="CalificadosVice.php">
                                <i class="pe-7s-photo-gallery"></i>
                                <p>Inscritos Calificados</p>
                            </a>
                        </li>
                        <li>
  <!--                          <a href="ModificarClaveDecano.php">
                                <i class="pe-7s-photo-gallery"></i>
                                <p>cambiar mi Clave</p>
                            </a>
                        </li>
                        <li>
                            <a href="../Tablero/restaurarclaveAdmin.php">
                                <i class="pe-7s-display1"></i>
                                <p>Cambiar Clave</p>
                            </a>
                        </li>-->
                        <li class="active-pro">
                            <a href="index.php">
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
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    Consulta General de Inscritos
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <!-- <div class="col-xs-4">
                                                        <label for="telefono">Facultad</label>
                                                        <div id="comboProg">
                                                        <select class="form-control" id="facultadCmb" name="facultadCmb" required="true" onchange="cargarProgramas(this.value)">
                                                            <option value="">SELECCIONE</option>
                                                            <?php
                                                            $facultades = $p->getFacultadesDocente();
                                                            foreach ($facultades as $arregloFac) {
                                                                echo '<OPTION value="' . $arregloFac[0] . '">' . $arregloFac[1] . '</OPTION>';
                                                            }
                                                            ?>
                                                        </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <label for="telefono">Departamento</label>
                                                        <div id="comboProg">
                                                            <select class="form-control" id="programaCmb" name="programaCmb" required="true" onchange="cargarAreas(this.value)">
                                                                <option value="">SELECCIONE</option>
                                                                <?php
                                                                $program = $p->getProgramasDocente(0);
                                                                foreach ($program as $arregloPro) {
                                                                    echo '<OPTION value="' . $arregloPro[0] . '">' . $arregloPro[1] . '</OPTION>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div> -->
                                        <div class="col-xs-8">
                                            <label> Filtrar por Nombre</label>
                                            <input id="busqueda" type="text"class="form-control"/>
                                        </div>
                                        <div class="col-xs-2">
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
                                                        url: "buscarVice.php",
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

<?php
require_once "../Tablero/clases/Programas.php";
require_once "../Tablero/vo/UsuarioVO.php";

session_start();
$usuario = $_SESSION['usuario'];
$p = new Programas();
$nombre = $usuario->getName();

if (isset($_SESSION['usuario'])) {
    $area = filter_input(INPUT_POST, 'areaTxt', FILTER_SANITIZE_SPECIAL_CHARS);

    if (isset($area)) {
        $programaId = filter_input(INPUT_POST, 'programaCmb', FILTER_SANITIZE_SPECIAL_CHARS);
        if ($p->existArea($area, $programaId)) {
            echo '<script type="text/javascript">alert("Área ya existe registrado")</script>';
        } else {
            $p->insertNewArea();
        }
    }
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
    <link href="../Tablero/assets/css/animate.min.css" rel="stylesheet" />
    <link href="../Tablero/assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet" />
    <link href="../Tablero/assets/css/demo.css" rel="stylesheet" />
    <link href="../Tablero/assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

    <style>
        body {
            padding-top: 8px;
            font-family: 'Open Sans', sans-serif;
            font-size: 13px;
        }

        .tabla {
            margin: 6px auto;
        }

        .tabla thead {
            cursor: pointer;
            background: #337ab7;
            color: rgba(255, 255, 255, 1);


        }

        .tabla thead tr th {
            font-weight: bold;
            padding: 5px 5px;
        }

        .tabla thead tr th span {
            padding-right: 5px;
            background-repeat: no-repeat;
            background-position: 100% 55%;
        }

        .tabla tbody tr td {
            text-align: center;
            padding: 5px 5px;
        }

        .tabla tbody tr td.align-left {
            text-align: left;
        }
    </style>
</head>

<body>

    <div class="wrapper">
        <div class="sidebar" data-color="green" data-image="../Tablero/assets/img/sidebar-5.jpg">
            <!--
                        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
                        Tip 2: you can also add an image using data-image tag
                -->
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="#" class="simple-text">
                    Módulo de Administración.
                    </a>
                </div>
                <?php include("includes/menuAdmin.php"); ?>
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
                <div class="col-xs-4">
                    <a href="Agregar.php">
                        <h4><i class="pe-7s-back"></i>Volver</h4>
                    </a>
                    <h5><?php echo $nombre; ?></h5>
                </div>
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
                                                    required="true" onchange=<?php
                                                                                if ($p->esPostgrados($usuario->getId())) {
                                                                                    echo '"cargarProgPost(this.value)"';
                                                                                } else {
                                                                                    echo '"cargarProgramas(this.value)"';
                                                                                }
                                                                                ?>>
                                                    <option value="">SELECCIONE</option>
                                                    <?php
                                                    if ($p->esPostgrados($usuario->getId())) {
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
                                                        required="true">
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
                                            <div class="col-xs-12">
                                                <label for="telefono">Área de Conocimiento</label>
                                                <input type="text" class="form-control" id="areaTxt" name="areaTxt">
                                            </div>
                                        </div>
                                        <hr />
                                        <input type="submit" value="Guardar" class="btn btn-primary" />
                                    </form>


                                    <div class="row">
                                        <div class="col-xs-12">

                                            <table cellspacing="5" cellpadding="3" id="mi-tabla" class="table-bordered table-sm tabla">
                                                <thead>
                                                    
                                                </thead>
                                                <tbody>
                                                    <!-- Aquí se llenarán las filas dinámicamente -->
                                                </tbody>
                                            </table>

                                        </div>

                                    </div>

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

<script src="../General/js/jquery-1.10.2.js"></script>
<script src="../General/js/bootstrap.min.js"></script>
<!-- <script src="../General/js/funciones.js"></script> -->
<script src="../Tablero/js/funciones.js"></script>
<!--   Core JS Files   -->
<script src="../General/assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="../General/assets/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Charts Plugin -->
<script src="../General/assets/js/chartist.min.js"></script>

<!--  Notifications Plugin    -->
<script src="../General/assets/js/bootstrap-notify.js"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="../General/assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="../General/assets/js/demo.js"></script>
<script>
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


<script>
    document.getElementById("comboProg").addEventListener("change", function() {
        var seleccionado = document.getElementById("programaCmb");
        var facultadId = seleccionado.value; // Obtiene el valor seleccionado

        console.log(facultadId);

        if (facultadId !== "") {
            // Realiza una llamada AJAX para obtener los datos de la facultad seleccionada
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "getArea.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Convierte la respuesta JSON a un array
                    var areas = JSON.parse(xhr.responseText);
                    llenarTabla(areas);
                }
            };

            xhr.send("facultad_id=" + facultadId);
        } else {
            limpiarTabla(); // Si no se selecciona una facultad, limpia la tabla
        }
    });

    function llenarTabla(areas) {
        var table = document.getElementById("mi-tabla").getElementsByTagName('tbody')[0]; // Obtiene el tbody
        var thead = document.getElementById("mi-tabla").getElementsByTagName('thead')[0]; // Obtiene el tbody

        // Limpia las filas existentes
        limpiarTabla();
        var row = thead.insertRow();
        var cell1 = row.insertCell(0);
         var cell2 = row.insertCell(1);

            // Rellena las celdas con el nombre de la facultad y el área
            cell1.innerHTML = 'Nombre Departamento';
            cell2.innerHTML = 'Área';

        // Rellena la tabla con los datos recibidos
        areas.forEach(function(area) {
            var row = table.insertRow();
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);

            // Rellena las celdas con el nombre de la facultad y el área
            cell1.innerHTML = area["nombre"];
            cell2.innerHTML = area["area"];
        });


    }

    function limpiarTabla() {
        var table = document.getElementById("mi-tabla");
        var rowCount = table.rows.length;
        for (var i = rowCount - 1; i >= 0; i--) {
            table.deleteRow(i);
        }
    }
</script>


</html>
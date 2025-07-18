<?php
require_once '../Tablero/vo/UsuarioVO.php';
require_once("../Tablero/clases/Programas.php");
require_once("../Tablero/clases/Gestion.php");

$p = new Programas();
session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
    $nombre = $usuario->getName();
    $programa = $usuario->getlastName();
    $programasCreados = $p->getProgramasVer();

    if (isset($_POST["programTxt"])) {
        if ($p->existProgram($_POST["programTxt"])) {
            echo '<script type="text/javascript">alert("Programa ya existe registrado")</script>';
        } else {
            $p->insertProgram();
        }
    }
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
                <div class="col-xs-4">
                    <a href="Agregar.php">
                        <h4><i class="pe-7s-back"></i>Volver</h4>
                    </a>
                    <h5><?php echo $nombre; ?></h5>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Gestionar programa académico
                            </div>
                            <div class="panel-body">
                                <form name="form" action="" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <label for="telefono">Facultad</label>
                                            <select class="form-control" id="facultadCmb" name="facultadCmb" required="true" onchange="filtrarProgram()">
                                                <option value="">SELECCIONE</option>
                                                <?php
                                                $facultades = $p->getFacultadesDocentePostgrado();
                                                foreach ($facultades as $arregloFac) {
                                                    echo '<OPTION value="' . $arregloFac[0] . '">' . $arregloFac[1] . '</OPTION>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-xs-3">
                                            <label for="telefono">Nombre del nuevo Programa</label>
                                            <div id="comboProg">
                                                <input class="form-control" type="text" id="programTxt" name="programTxt" required="true" onkeyup="filtrarProgram()">
                                            </div>
                                        </div>
                                        <div class="col-xs-3">
                                            <label for="telefono">Alcance</label>
                                            <select class="form-control" id="posgradoCmb" name="posgradoCmb" required="true" onchange="filtrarProgram()">
                                                <OPTION value="">[SELECCIONE]</OPTION>
                                                <OPTION value="false">PREGRADO</OPTION>
                                                <OPTION value="true">POSGRADO</OPTION>
                                            </select>
                                        </div>
                                        <div class="col-xs-3">
                                            <br>
                                            <input type="submit" value="Guardar" class="btn btn-primary" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <table cellspacing="5" cellpadding="3" id="mi-tabla" class="table-bordered table-sm tabla">
                                        <thead>
                                            <tr>
                                                <th><span>No.</span></th>
                                                <th><span>Programa</span></th>
                                                <th><span>Facultad</span></th>
                                                <th><span>Alcance</span></th>
                                                <th><span></span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            foreach ($programasCreados as $arreglo) {
                                                $i = $i + 1;
                                            ?>
                                                <tr>
                                                    <td><?php echo $i ?></td>
                                                    <td><?php echo $arreglo[0] ?></td>
                                                    <td><?php echo $arreglo[1] ?></td>
                                                    <td><?php echo $arreglo[2] ?></td>
                                                    <?php
                                                    $urlVer = "EditProgram.php?id=" . $arreglo[3];
                                                    ?>
                                                    <td>
                                                        <a data-toggle="tooltip" title="Ver información" href="<?php echo $urlVer; ?>"><i class="pe-7s-pen"></i></a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
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
<script src="../Tablero/assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../Tablero/assets/js/chartist.min.js"></script>
<script src="../Tablero/assets/js/bootstrap-notify.js"></script>
<script src="../Tablero/assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>
<script src="../Tablero/assets/js/demo.js"></script>
<script>
function filtrarProgram() {
    const facultadTxt = document.getElementById('facultadTxt').value;
    const alcanceCmb = document.getElementById('posgradoCmb').value;
    
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "procesar_filtro_program.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Actualizar la tabla con los datos filtrados
            document.getElementById('mi-tabla').innerHTML = xhr.responseText;
        }
    };

    // Enviar el valor del filtro al servidor
    xhr.send("facultadTxt=" + encodeURIComponent(facultadTxt)+
            "&alcanceCmb=" + encodeURIComponent(alcanceCmb));
}
</script>

</html>
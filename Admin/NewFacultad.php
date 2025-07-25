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
    $facultadCreados = $p->getFacultadVer();

    if (isset($_POST["facultadTxt"]) ) {
        $facultadtxt = strtoupper($_POST["facultadTxt"]);
        $gestion = new Gestion();
        $existe = $p->existeFacultad($facultadtxt);
        if (!$existe) { // Si no está marcado (false)
            $gestion->insertarFacultad();
            echo "<script>
            alert('Registro guardado con éxito');
            window.location.href = 'NewFacultad.php';
            </script>";
        } else {
            $errorMessage = "El nombre de la Facultad no está disponible.";            
        }
    }
} else {

    header('Location: AccesoNoautorizado.html');
}
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
    <link href="../Tablero/assets/css/animate.min.css" rel="stylesheet" />
    <link href="../Tablero/assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet" />
    <link href="../Tablero/assets/css/demo.css" rel="stylesheet" />
    <link href="../Tablero/assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

    <style>
        body {
            padding-top: 15px;
            font-family: 'Open Sans', sans-serif;
            font-size: 13px;
        }

        .tabla {
            margin: 10px auto;
        }

        .tabla thead {
            cursor: pointer;
            background: #337ab7;
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
                    <h5>
                        <?php echo $nombre; ?>
                    </h5>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Gestionar facultad
                            </div>
                            <div class="panel-body">
                                <form name="form" action="" method="post" enctype="multipart/form-data">
                                    <div class="row">

                                        <div class="col-xs-6">
                                            <label for="telefono">Nueva facultad</label>

                                            <input class="form-control" type="text" id="facultadTxt" name="facultadTxt" required="true" onkeyup="filtrarFacultad();">

                                        </div>
                                        <div class="col-xs-3">
                                            <label for="telefono">Alcance</label>
                                            <select class="form-control" id="posgradoCmb" name="posgradoCmb" required="true" onchange="filtrarFacultad();">
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

                                    <div class="row">
                                    <div class="error-message">
                                    <?php
                                    // Si hay un mensaje de error, lo muestra aquí
                                    if (!empty($errorMessage)) {
                                        echo $errorMessage;
                                    }
                                    ?>                               

                                    </div>
                                </form>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <table cellspacing="5" cellpadding="3" id="mi-tabla" class="table-bordered table-sm tabla">
                                        <thead>
                                            <tr>
                                                <th><span>No.</span></th>
                                                <th><span>Facultad</span></th>
                                                <th><span>Estado</span></th>
                                                <th><span>Alcance</span></th>
                                                <th><span>Edit</span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            foreach ($facultadCreados as $arreglo) {
                                                $i = $i + 1;
                                            ?>
                                                <tr>
                                                    <td><?php echo $i ?></td>
                                                    <td><?php echo $arreglo[0] ?></td>
                                                    <td><?php echo $arreglo[1] ?></td>
                                                    <td><?php echo $arreglo[2] ?></td>

                                                    <?php
                                                    $urlVer = "EditFacultad.php?id=" . $arreglo[3];
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
                        <div class="panel-footer">
                                     <button onclick="imprimirTabla()">Imprimir tabla</button>
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
    </div>
</body>
<script src="../Tablero/assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="../Tablero/assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../Tablero/assets/js/chartist.min.js"></script>
<script src="../Tablero/assets/js/bootstrap-notify.js"></script>
<script src="../Tablero/assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>
<script src="../Tablero/assets/js/demo.js"></script>

<script>
function imprimirTabla() {
    var contenido = document.getElementById('mi-tabla').outerHTML;

    // Abre una ventana nueva
    var ventana = window.open('', '', 'height=600,width=800');

    // Escribe el contenido en la ventana nueva
    ventana.document.write('<html><head><title>Impresión de Tabla</title>');
    
    // Estilos para la tabla y el encabezado
    ventana.document.write(`
        <style>
            body { font-family: Arial, sans-serif; text-align: center; margin: 40px; }
            h1 { margin-bottom: 0; }
            h3 { margin-top: 5px; color: #555; }
            table { width: 100%; border-collapse: collapse; margin-top: 20px; }
            th, td { border: 1px solid black; padding: 8px; }
        </style>
    `);

    ventana.document.write('</head><body>');

    // Aquí va el encabezado que quieres mostrar
    ventana.document.write('<h1>Facultades registradas</h1>');
    ventana.document.write('<h3></h3>');
    ventana.document.write('<p>Fecha de impresión: ' + new Date().toLocaleDateString() + '</p>');

    // Inserta la tabla
    ventana.document.write(contenido);

    ventana.document.write('</body></html>');
    ventana.document.close();

    // Espera a que cargue y luego imprime
    ventana.onload = function () {
        ventana.print();
        ventana.close();
    };
}
</script>
<script>
function filtrarFacultad() {
    const facultadTxt = document.getElementById('facultadTxt').value;
    const alcanceCmb = document.getElementById('posgradoCmb').value;
    
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "procesar_filtro_facultad.php", true);
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
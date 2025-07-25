<?php
require_once("../Tablero/vo/UsuarioVO.php");
require_once("../Tablero/clases/Programas.php");
require_once("../Tablero/clases/Gestion.php");
require_once("../Tablero/clases/Evaluadores.php");
//require_once("../Tablero/vo/DocenteVO.php");
//require_once("../Tablero/clases/Docente.php");
//require_once("../Tablero/vo/PeridoVO.php");
session_start();
$usuario = $_SESSION['usuario'];
$archivo = "hvd" . $usuario->getId();
$nombre = $usuario->getName();
$_SESSION['id_usuario'] = $usuario->getId();
$programa = new Programas();
$eval = new Evaluadores();
$usuarioEvaluador = $programa->getEvaluador();

if (isset($usuario)) {


    $evaluadorId = $_GET['id'];

    //echo "<script>alert('$nombre');</script>";
    if (isset($evaluadorId)) {
        $eval->getUnEvaluador($evaluadorId);
        $facultadDepatamento = $eval->getNameFacultadDepartatamento($evaluadorId);
        //echo $usuario->getNombre();
        //echo "ID: " . $evaluador['nombre'] . "<br>";
        // echo ($eval->getHabilitado());
        //  var_dump($eval->getUsuario());
        // $gestion->updateEvaluador($evaluadorId);

        //  $u->insertar($usuario->getId());

    }
} else {
    header("Location: ../Entrada.html");
}

$opcionSede = [
    'SELECCIONE' => 'SELECCIONE',
    'A DISTANCIA' => 'A DISTANCIA',
    'AGUACHICA' => 'AGUACHICA',
    'VALLEDUPAR' => 'VALLEDUPAR'
];

$opcionTipo = [
    'SELECCIONE' => 'SELECCIONE',
    'DECANO' => 'DECANO',
    'EVALUADOR' => 'EVALUADOR',
    'JEFE' => 'JEFE',
    'RH' => 'RH'
];

$opcionHabilitado = [
    '1' => 'ACTIVO',
    '0' => 'INACTIVO'
];
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            <div class="col-xs-4">
                    <a href="NewEvaluador.php">
                        <h4><i class="pe-7s-back"></i>Volver</h4>
                    </a>
                    <h5>
                        <?php echo $nombre; ?>
                    </h5>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="col-xs-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    Información Básica del evaluador
                                </div>
                                <div class="panel-body">


                                    <form id="formulario" onsubmit="return validarUsuario()" method="post">

                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="col-xs-6">
                                                    <label for="">Nombre *</label>
                                                    <input value="<?php echo $eval->getNombre(); ?>" required="true" type="text" class="form-control" name="nombreCompletoTxt" id="nombreCompletoTxt" placeholder="">
                                                </div>
                                                <div class="col-xs-6">
                                                    <label for="">Usuario *</label>
                                                    <input value="<?php echo $eval->getUsuario(); ?>" required="true" type="text" class="form-control" name="usuarioTxt" id="usuarioTxt" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="col-xs-6">
                                                    <label for="telefono">Facultad</label>
                                                    <select class="form-control" id="facultadCmb" name="facultadCmb"
                                                        required="true" onchange=<?php
                                                                                    if ($programa->esPostgrados($usuario->getId())) {
                                                                                        echo '"cargarProgPost(this.value)"';
                                                                                    } else {
                                                                                        echo '"cargarProgramas(this.value)"';
                                                                                    }
                                                                                    ?>>
                                                        <option value="">SELECCIONE</option>
                                                        <?php
                                                        if ($programa->esPostgrados($usuario->getId())) {
                                                            $facultades = $programa->getFacultadesDocentePostgrado();
                                                        } else {
                                                            $facultades = $programa->getFacultadesDocente();
                                                        }

                                                        ?>
                                                        <?php foreach ($facultades as $valor): ?>
                                                            <option value="<?= htmlspecialchars($valor[0]) ?>"
                                                                <?= ($valor[1] === $eval->getNameFaculad()) ? 'selected' : '' ?>>
                                                                <?= htmlspecialchars($valor[1]) ?>
                                                            </option>

                                                        <?php endforeach; ?>
                                                    </select>


                                                    <?php

                                                    ?>
                                                </div>


                                                <div class="col-xs-6">
                                                    <label for="departamento">Departamento</label>
                                                    <div id="comboProg">
                                                        <select class="form-control" id="programaCmb" name="programaCmb"
                                                            required="true">
                                                            <option value="">SELECCIONE</option>
                                                            <?php
                                                            $program = $programa->getProgramasDocente($eval->getIdFacultad()); ?>
                                                            <?php foreach ($program as $valor): ?>
                                                                <option value="<?= htmlspecialchars($valor[0]) ?>"
                                                                    <?= ($valor[1] === $eval->getNamePrograma()) ? 'selected' : '' ?>>
                                                                    <?= htmlspecialchars($valor[1]) ?>
                                                                </option>

                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-xs-12">

                                                <div class="col-xs-3">
                                                    <label for="">Rol *</label>
                                                    <select class="form-control" id="rolCmb" name="rolCmb" required="true" onchange="">
                                                        <?php foreach ($opcionTipo as $valor => $etiqueta): ?>
                                                            <option value="<?php echo htmlspecialchars($valor); ?>"
                                                                <?php echo $valor === $eval->getTipo() ? 'selected' : ''; ?>>
                                                                <?php echo htmlspecialchars($etiqueta); ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                                <div class="col-xs-3">
                                                    <label for="">Sede *</label>

                                                    <select class="form-control" id="sedeCmb" name="sedeCmb" required="true" onchange="">
                                                        <?php foreach ($opcionSede as $valor => $etiqueta): ?>
                                                            <option value="<?php echo htmlspecialchars($valor); ?>"
                                                                <?php echo $valor === $eval->getSede() ? 'selected' : ''; ?>>
                                                                <?php echo htmlspecialchars($etiqueta); ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                                <div class="col-xs-3">
                                                    <label for="">Estado *</label>
                                                    <select class="form-control" id="estadoCmb" name="estadoCmb" required="true" onchange="">
                                                        <?php foreach ($opcionHabilitado as $valor => $etiqueta): ?>
                                                            <option value="<?php echo htmlspecialchars($valor); ?>"
                                                                <?php echo $etiqueta === $eval->getHabilitado() ? 'selected' : ''; ?>>
                                                                <?php echo htmlspecialchars($etiqueta); ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>



                                                <div class="col-xs-3">
                                                    <br>
                                                    <input type="submit" value="Actualizar" class="btn btn-primary" />


                                                </div>
                                                <div class="col-xs-3">
                                                    <br>
                                                    <input type="button" onclick="resetPassword()" value="Restaurar contraseña" class="btn btn-secondary" />


                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div id="mensaje-error" class="error"></div>
                                            <div id="mensaje-exito" class="success"></div>

                                        </div>


                                    </form>


                                    <div class="row">
                                        <div class="col-xs-12">

                                        </div>

                                    </div>


                                </div>
                                <div class="panel-footer">
                                    &copy; <script>
                                        document.write(new Date().getFullYear())
                                    </script> <a href="http://www.unicesar.edu.co">Unicesar</a>, creado para Vicerrectoria Académica
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="../General/js/jquery-1.10.2.js"></script>
<script src="../General/js/bootstrap.min.js"></script>

<script src="../Tablero/js/validaciones-evaluadores.js"></script>

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
    function validarUsuario() {

        const mensajeError = document.getElementById('mensaje-error');
        const mensajeExito = document.getElementById('mensaje-exito');

        const nombreCompleto = document.getElementById('nombreCompletoTxt').value;
        const nombreUsuario = document.getElementById('usuarioTxt').value;
        const programaCmb = document.getElementById('programaCmb').value;
        const rol = document.getElementById('rolCmb').value;
        const sede = document.getElementById('sedeCmb').value;
        const estado = document.getElementById('estadoCmb').value;

        const id = "<?php echo $evaluadorId; ?>";
        //console.log(nombreCompleto,nombreUsuario,programaCmb,rol,sede,id, estado);

        // Limpiar mensajes previos
        mensajeError.textContent = "";
        mensajeExito.textContent = "";
        // Realizar la validación con AJAX
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "procesarEditEvaluador.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.send(
            "nombreCompletoTxt=" + encodeURIComponent(nombreCompleto) +
            "&programaCmb=" + encodeURIComponent(programaCmb) +
            "&rolCmb=" + encodeURIComponent(rol) +
            "&sedeCmb=" + encodeURIComponent(sede) +
            "&usuarioTxt=" + encodeURIComponent(nombreUsuario) +
            "&id=" + encodeURIComponent(id) +
            "&estadoCmb=" + encodeURIComponent(estado)
        );


 xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const respuesta = JSON.parse(xhr.responseText);

                if (respuesta.success) {
                    mensajeExito.textContent = respuesta.message;
                    Swal.fire('¡Actualizando!', respuesta.message+' 😍', 'success');
                    demo.initChartist();
                    $.notify({
                        icon: 'pe-7s-notebook',
                        message: "<b>Actualizado correctamente</b>"
                    }, {
                        type: 'info',
                        timer: 2000
                    });

                    setTimeout(function() {
                        window.location.href = 'NewEvaluador.php';
                    }, 3000); // O un t
                } else {
                    Swal.fire('¡No actualizado!', respuesta.message+' 😍', 'error');
                    mensajeError.textContent = respuesta.message;
                }
            }
        };
        return false; // Prevenir el envío del formulario hasta que se complete la validación
    }
    
    function resetPassword() {

        const mensajeError = document.getElementById('mensaje-error');
        const mensajeExito = document.getElementById('mensaje-exito');

        const nombreCompleto = document.getElementById('nombreCompletoTxt').value;
        const nombreUsuario = document.getElementById('usuarioTxt').value;
        const programaCmb = document.getElementById('programaCmb').value;
        const rol = document.getElementById('rolCmb').value;
        const sede = document.getElementById('sedeCmb').value;
        const estado = document.getElementById('estadoCmb').value;

        const id = "<?php echo $evaluadorId; ?>";
        //console.log(nombreCompleto,nombreUsuario,programaCmb,rol,sede,id, estado);

        // Limpiar mensajes previos
        mensajeError.textContent = "";
        mensajeExito.textContent = "";

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "procesarEditPassword.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        
        xhr.send(
            "nombreCompletoTxt=" + encodeURIComponent(nombreCompleto) +
            "&programaCmb=" + encodeURIComponent(programaCmb) +
            "&rolCmb=" + encodeURIComponent(rol) +
            "&sedeCmb=" + encodeURIComponent(sede) +
            "&usuarioTxt=" + encodeURIComponent(nombreUsuario) +
            "&id=" + encodeURIComponent(id) +
            "&estadoCmb=" + encodeURIComponent(estado)
        );
xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(':::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::');
                console.log(xhr.responseText);
                const respuesta = JSON.parse(xhr.responseText);

                if (respuesta.success) {
                    mensajeExito.textContent = respuesta.message;
                    Swal.fire('¡Actualizando!', respuesta.message+' 😍', 'success');
                    demo.initChartist();
                    $.notify({
                        icon: 'pe-7s-notebook',
                        message: "<b>Actualizado correctamente</b>"
                    }, {
                        type: 'info',
                        timer: 2000
                    });

                    setTimeout(function() {
                        // window.location.reload(); // Recarga la página para mostrar los nuevos datos.
                        window.location.href = 'NewEvaluador.php';
                    }, 3000); // O un t
                    //  window.location.reload();                   
                } else {
                    Swal.fire('¡No actualizado!', respuesta.message+' 😍', 'error');
                    mensajeError.textContent = respuesta.message;
                }
            }
        };

        return false; // Prevenir el envío del formulario hasta que se complete la validación
    }
</script>

</html>
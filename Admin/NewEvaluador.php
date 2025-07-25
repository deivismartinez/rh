<?php
require_once("../Tablero/vo/UsuarioVO.php");
require_once("../Tablero/clases/Programas.php");
require_once("../Tablero/clases/Gestion.php");
session_start();
$usuario = $_SESSION['usuario'];
$archivo = "hvd" . $usuario->getId();
$nombre = $usuario->getName();
$_SESSION['id_usuario'] = $usuario->getId();
$programa = new Programas();
$usuarioEvaluador = $programa->getEvaluador();

if (isset($usuario)) {
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
                    <a href="Agregar.php">
                        <h4><i class="pe-7s-back"></i>Volver</h4>
                    </a>
                    <h5><?php echo $nombre; ?></h5>
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
                                                    <input value="" required="true" type="text" class="form-control" name="nombreCompletoTxt" id="nombreCompletoTxt"  onkeyup="filtrarUsuarios();">
                                                </div>
                                                <div class="col-xs-6">
                                                    <label for="">Usuario *</label>
                                                    <input value="" required="true" type="text" class="form-control" name="usuarioTxt" id="usuarioTxt" placeholder="" onkeyup="filtrarUsuarios();">
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
                                                                                        echo '"cargarProgPost(this.value);filtrarUsuarios();"';
                                                                                    } else {
                                                                                        echo '"cargarProgramas(this.value);filtrarUsuarios();"';
                                                                                    }
                                                                                    ?>>
                                                        <option value="">SELECCIONE</option>
                                                        <?php
                                                        if ($programa->esPostgrados($usuario->getId())) {
                                                            $facultades = $programa->getFacultadesDocentePostgrado();
                                                        } else {
                                                            $facultades = $programa->getFacultadesDocente();
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
                                                    <label for="departamento">Departamento</label>
                                                    <div id="comboProg">
                                                        <select class="form-control" id="programaCmb" name="programaCmb"
                                                                required="true" onchange="filtrarUsuarios();">
                                                            <option value="">SELECCIONE</option>
                                                            <?php
                                                            $program = $programa->getProgramasDocente(0);
                                                            foreach ($program as $arregloPro) {
                                                                echo '<OPTION value="' . $arregloPro[0] . '">' . $arregloPro[1] . '</OPTION>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="col-xs-3">
                                                    <label for="">Rol *</label>
                                                    <select class="form-control" id="rolCmb" name="rolCmb" required="true" onchange="filtrarUsuarios();">
                                                        <OPTION value="">[SELECCIONE]</OPTION>
                                                        <OPTION value="DECANO">DECANO</OPTION>
                                                        <OPTION value="EVALUADOR">EVALUADOR</OPTION>
                                                        <OPTION value="JEFE">JEFE</OPTION>
                                                        <OPTION value="RH">RH</OPTION>
                                                    </select>
                                                </div>
                                                <div class="col-xs-3">
                                                    <label for="">Sede *</label>
                                                    <select class="form-control" id="sedeCmb" name="sedeCmb" required="true" onchange="filtrarUsuarios();">
                                                        <OPTION value="">[SELECCIONE]</OPTION>
                                                        <OPTION value="A DISTANCIA">A DISTANCIA</OPTION>
                                                        <OPTION value="AGUACHICA">AGUACHICA</OPTION>
                                                        <OPTION value="VALLEDUPAR">VALLEDUPAR</OPTION>
                                                    </select>
                                                </div>
                                                <div class="col-xs-3">
                                                    <label for="">Contraseña</label>
                                                    <input value="" type="password" class="form-control" name="seguridadTxt" id="seguridadTxt" required="true" placeholder="">
                                                </div>
                                                <div class="col-xs-3">
                                                    <label for="">Confirmar contraseña</label>
                                                    <input value="" type="password" class="form-control" name="seguridadTxtRep" id="seguridadTxtRep" required="true" placeholder="">
                                                </div>
                                                <div class="col-xs-3">
                                                    <br>
                                                    <input type="submit" value="Guardar" class="btn btn-primary" />
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
                                            <table cellspacing="5" cellpadding="3" id="mi-tabla" class="table-bordered table-sm tabla">
                                                <thead>
                                                    <tr>
                                                        <th><span>No.</span></th>
                                                        <th><span>Nombre</span></th>
                                                        <th><span>Correo</span></th>
                                                        <th><span>Programa</span></th>
                                                        <th><span>Tipo</span></th>
                                                        <th><span>Estado</span></th>
                                                        <th><span>Sede</span></th>
                                                        <th><span></span></th>                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 0;
                                                    foreach ($usuarioEvaluador as $arreglo) {
                                                        $i = $i + 1;
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $i ?></td>
                                                            <td><?php echo $arreglo[0] ?></td>
                                                            <td><?php echo $arreglo[1] ?></td>
                                                            <td><?php echo $arreglo[2] ?></td>
                                                            <td><?php echo $arreglo[3] ?></td>
                                                            <td><?php echo $arreglo[4] ?></td>
                                                            <td><?php echo $arreglo[5] ?></td>

                                                            <?php
                                                            $urlVer = "EditEvaluador.php?id=" . $arreglo[6];
                                                            ?>
                                                            <td>
                                                                <a data-toggle="tooltip" title="Editar" href="<?php echo $urlVer; ?>"><i class="pe-7s-pen"></i></a>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <button onclick="imprimirTabla()">Imprimir tabla</button>
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
    ventana.document.write('<h1>Usuarios registrados</h1>');
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
    function validarUsuario() {

        const mensajeError = document.getElementById('mensaje-error');
        const mensajeExito = document.getElementById('mensaje-exito');
        const nombreCompleto = document.getElementById('nombreCompletoTxt').value;
        const nombreUsuario = document.getElementById('usuarioTxt').value;
        const programaCmb = document.getElementById('programaCmb').value;
        const rol = document.getElementById('rolCmb').value;
        const sede = document.getElementById('sedeCmb').value;
        const password = document.getElementById('seguridadTxt').value;
        const seguridadTxtRep = document.getElementById('seguridadTxtRep').value;

        // Limpiar mensajes previos
        mensajeError.textContent = "";
        mensajeExito.textContent = "";

        if (nombreUsuario === "") {
            mensajeError.textContent = "El nombre de usuario no puede estar vacío.";
            return false;
        }

        if (password.length < 7 || seguridadTxtRep.length < 7) {
            alert("La contraseña debe tener al menos 7 caracteres.");
            return false;
        }

        if (password !== seguridadTxtRep) {
            alert("La contaseñas son diferente.");
            return false;
        }

        // Realizar la validación con AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "procesar_registro.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {

                var respuesta = JSON.parse(xhr.responseText);
               
                if (respuesta.success) {                   
                    alert("Evaluador guardado con exito.");
                    demo.initChartist();
                    $.notify({
                        icon: 'pe-7s-notebook',
                        message: "<b>Agregado correctamente</b>"
                    }, {
                        type: 'info',
                        timer: 2000
                    });

                    setTimeout(function() {
                        window.location.reload(); // Recarga la página para mostrar los nuevos datos.
                    }, 500); // O un t
                    //  window.location.reload();
                } else {
                    mensajeError.textContent = respuesta.message;
                }
            }
        };


        xhr.send(
            "nombreCompletoTxt=" + encodeURIComponent(nombreCompleto) +
            "&programaCmb=" + encodeURIComponent(programaCmb) +
            "&rolCmb=" + encodeURIComponent(rol) +
            "&sedeCmb=" + encodeURIComponent(sede) +
            "&usuarioTxt=" + encodeURIComponent(nombreUsuario) +
            "&seguridadTxt=" + encodeURIComponent(password)
        );



        return false; // Prevenir el envío del formulario hasta que se complete la validación
    }

  function filtrarUsuarios() {
    const nombreCompleto = document.getElementById('nombreCompletoTxt').value;
        const nombreUsuario = document.getElementById('usuarioTxt').value;
        const programaCmb = document.getElementById('programaCmb').value;
        const facultadCmb = document.getElementById('facultadCmb').value;
        const rol = document.getElementById('rolCmb').value;
        const sede = document.getElementById('sedeCmb').value;
    
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "procesar_filtro.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Actualizar la tabla con los datos filtrados
            document.getElementById('mi-tabla').innerHTML = xhr.responseText;
        }
    };

    // Enviar el valor del filtro al servidor
    xhr.send(
            "nombreCompletoTxt=" + encodeURIComponent(nombreCompleto) +
            "&programaCmb=" + encodeURIComponent(programaCmb) +
            "&facultadCmb=" + encodeURIComponent(facultadCmb) +
            "&rolCmb=" + encodeURIComponent(rol) +
            "&sedeCmb=" + encodeURIComponent(sede) +
            "&usuarioTxt=" + encodeURIComponent(nombreUsuario)
        );
}

</script>

</html>
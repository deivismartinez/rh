<?php
require_once "../Tablero/clases/Periodo.php"; ////periodo
$p = new Perido();
require_once "clases/Usuario.php";
if (isset($_POST["identificacionTxt"])) {
    $u = new Usuario();
    $u->insertar();
    header("Location: index.php?m=1");
}
?>
<!DOCTYPE html>
<html>

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Inscripción Docente Unicesar</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../Tablero/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link rel="icon" type="image/jpg" href="../images/icono.png" />
    <style>
    #centered {
        position: fixed;
        top: 50%;
        left: 50%;
        /* bring your own prefixes */
        transform: translate(-50%, -50%);
    }

    body {
        background-image: url(../images/fondo.jpg);
    }
    </style>
    <script type="text/javascript">
    function validacion(frm) {
        if (frm.claveTxt.value.trim() === '' || frm.correoTxt.value.trim() === '' || frm.documentoCmb.value.trim() ===
            '' ||
            frm.identificacionTxt.value.trim() === '' ||
            frm.apellidosTxt.value.trim() === '' || frm.nombreTxt.value.trim() === ''||frm.sedeCmb.value=="") {
            alert('[ERROR] Tiene campos sin diligenciar');
        } else {
            if (frm.correoTxt.value.trim().length < 4) {
                alert('[ERROR] El correo debe tener 2 o más letras');
            } else {
                if (frm.claveTxt.value.trim().length < 5) {
                    alert('[ERROR] La clave debe tener 5 o más simbolos');
                } else {
                    if (frm.claveTxt.value === frm.confirmarTxt.value) {
                        if (frm.correoTxt.value === frm.confirmarCorreoTxt.value) {
                            frm.submit();
                        } else {
                            alert('[ERROR] El Correo no está bien confirmado');
                        }
                    } else {
                        alert('[ERROR] La Clave no está bien confirmada');
                    }
                }
            }
        }
    }
    </script>
</head>

<body>
    <div class="panel">

        <div class="col-xs-12">
            <div class="row" id="centered">
                <div class="col-xs-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h2 class="panel-title">
                                <h2>
                                    <p align=center><b>INSCRIPCIÓN DE USUARIOS</b></p>
                                </h2>
                            </h2>
                        </div>
                        <div class="panel-body">
                            <form method="POST" action="" name="entradaFrm" id="entradaFrm">
                                <div class="form-group">
                                    <div class="col-xs-6">
                                        <label for="nombreTxt" class="control-label">Nombres Completos *</label>
                                        <input type="text" required class="form-control" id="nombreTxt"
                                            name="nombreTxt">
                                    </div>
                                    <div class="col-xs-6">
                                        <label for="apellidosTxt" class="control-label">Apellidos Completos *</label>
                                        <input type="text" required class="form-control" id="apellidosTxt"
                                            name="apellidosTxt">
                                    </div>
                                    <div class="col-xs-6">
                                        <label for="documentoCmb" class="control-label">Tipo documento de identidad
                                            *</label>
                                        <select class="form-control" id="documentoCmb" name="documentoCmb">
                                            <option value="">SELECCIONE</option>
                                            <option value="CEDULA DE CIUDADANIA">CEDULA DE CIUDADANIA</option>
                                            <option value="TARJETA DE IDENTIDAD">TARJETA DE IDENTIDAD</option>
                                            <option value="CEDULA DE EXTRANJERIA">CEDULA DE EXTRANJERIA</option>
                                            <option value="PASAPORTE">PASAPORTE</option>
                                            <option value="REGISTRO CIVIL">REGISTRO CIVIL</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-6">
                                        <label for="identificacionTxt" class="control-label">Identificación (sin puntos)
                                            *</label>
                                        <input type="text" required class="form-control" id="identificacionTxt"
                                            name="identificacionTxt" placeholder="No. CC, TI, CE, RC" autocomplete="new-documento">
                                    </div>
                                    <!-- ////// -->
                                    <div class="col-xs-6">
                                        <label for="">Sede de inscripción *</label>
                                        <select required="true" class="form-control" name="sedeCmb" id="sedeCmb">
                                            <option value="">SELECCIONE</option>
                                            <?php
$sedePostgrados = $p->getSedeAbierta('A DISTANCIA');
$sedeValledupar = $p->getSedeAbierta('VALLEDUPAR');
$sedeAguachica = $p->getSedeAbierta('AGUACHICA');
if ($sedeValledupar) {?>
                                            <option value="VALLEDUPAR">VALLEDUPAR</option>
                                            <?php }if ($sedeAguachica) {?>
                                            <option value="AGUACHICA">AGUACHICA</option>

                                            <?php }if ($sedePostgrados) {?>
                                            <option value="A DISTANCIA">A DISTANCIA</option>
                                            <?php }?>

                                        </select>
                                    </div>
                                    <div class="col-xs-6">
                                        <br>
                                        <br>
                                        <br>
                                    </div>
                                    <!-- //// -->

                                    <div class="col-xs-6">
                                        <label for="claveTxt" class="control-label">Clave *</label>
                                        <input type="password" required class="form-control" id="claveTxt"
                                            name="claveTxt" autocomplete="new-password">
                                    </div>
                                    <div class="col-xs-6">
                                        <label for="confirmarTxt" class="control-label">Confirmar la Clave *</label>
                                        <input type="password" required class="form-control" id="confirmarTxt"
                                            name="confirmarTxt">
                                    </div>
                                    <div class="col-xs-6">
                                        <label for="correoTxt" class="control-label">Correo electronico *</label>
                                        <input type="mail" required class="form-control" id="correoTxt"
                                            name="correoTxt">
                                    </div>
                                    <div class="col-xs-6">
                                        <label for="confirmarCorreoTxt" class="control-label">Confirmar correo *</label>
                                        <input type="mail" required class="form-control" id="confirmarCorreoTxt"
                                            name="confirmarCorreoTxt">
                                    </div>
                                    <div class="col-xs-12">
                                        <p align="right">
                                            <button type="button" class="btn btn-primary"
                                                onclick="validacion(document.entradaFrm)">
                                                <span class="glyphicon glyphicon-user"></span> Guardar
                                            </button>
                                        </p>
                                    </div>
                                    <div class="col-md-12">
                                        <a href="../Entrada.html">
                                            <span class="glyphicon glyphicon-user"></span> Inicio
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="panel-footer">
                            <p align="center"><small>&copy; <b>
                                        <script>
                                        document.write(new Date().getFullYear())
                                        </script> <a href="http://www.unicesar.edu.co">Unicesar</a>
                                    </b> </small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="../Boot/js/bootstrap.min.js"></script>

</body>

</html>
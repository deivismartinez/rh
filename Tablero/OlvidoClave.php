<?php
require_once("clases/Usuario.php");
if (isset($_POST["identificacionTxt"])) {
    $u = new Usuario();
    $u->enviarCorreo();
}
?>
<!DOCTYPE html>
<html> 
    <head> 
        <title>Inscripción Docente Unicesar</title> 
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link href="../Tablero/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
        <link rel="icon" type="image/jpg" href="../images/icono.png" />
        <style>
            #centered {
                position: fixed;
                top: 50%;
                left: 50%;
                /* bring your own prefixes */
                transform: translate(-30%, -50%);
            }
            body {
                background-image: url(../images/fondo.jpg);
            }
        </style>
        <script type="text/javascript">
            function validacion(frm) {
                if (frm.correoTxt.value.trim() === '' || frm.identificacionTxt.value.trim() === '') {
                    frm.identificacionTxt.value = null;
                    alert('[ERROR] Los campos no pueden estar vacíos');
                } else {
                    if (frm.correoTxt.value.trim().length < 4) {
                        frm.identificacionTxt.value = null;
                        alert('[ERROR] El correo debe tener 2 o más letras');
                    } else {
                        frm.submit();
                    }
                }
            }
        </script>
    </head> 
    <body> 
        <div class="panel">

            <div class="col-xs-12">
                <div class="row" id="centered">
                    <div class="col-xs-7">
                        <div class="panel panel-primary">
                            <div class = "panel-heading">
                                <h2 class = "panel-title"><h2><p align=center><b>CAMBIAR DATOS DE ACCESO</b></p></h2></h2>
                            </div>
                            <div class="panel-body">
                                <form method="POST" action="" name="entradaFrm" id="entradaFrm">
                                    <div class="form-group">
                                        <p align="center">
                                            
                                            <b>Escriba el correo electrónico con el cual se inscribió y su documento de identidad.  Luego haga clic en enviar. </b>
                                        </p>
                                        
                                        <div class="col-xs-12">
                                            <label for="identificacionTxt" class="control-label">Identificación (sin puntos) *</label>
                                            <input type="text" required class="form-control" id="identificacionTxt" name="identificacionTxt" placeholder="No. CC, TI, CE, RC">
                                        </div>
                                        
                                        <div class="col-xs-12">
                                            <label for="correoTxt" class="control-label">Correo electronico *</label>
                                            <input type="mail" required class="form-control" id="correoTxt" name="correoTxt">
                                        </div>
                                       
                                        <div class="col-xs-12">
                                            <p align = "right">
                                                <button type="submit" class="btn btn-primary" onclick="validacion(document.entradaFrm)">
                                                    <span class="glyphicon glyphicon-send"></span> Enviar
                                                </button>
                                            </p>
                                        </div>
                                        <div class="col-xs-12">
                                            <p align = "left">
                                                Le llegará un correo con los datos de acceso
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
                                <p align="center"><small>&copy; <b><script>document.write(new Date().getFullYear())</script> <a href="http://www.unicesar.edu.co">Unicesar</a></b> </small></p>
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

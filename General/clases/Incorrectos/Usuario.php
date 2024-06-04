<?php
$mensaje = $_GET['mensaje'];
?>
<!DOCTYPE html>
<html> 
    <head> 
        <title>Inscripción Docente Unicesar</title> 
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link href="../../../Tablero/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
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

    </head> 
    <body> 
        <div class="panel">

            <div class="col-xs-12">
                <div class="row" id="centered">
                    <div class="col-xs-12">
                        <div class="panel panel-warning">
                            <div class = "panel-heading">
                                <div class = "panel-title"><b>Dificultad al Guardar</b></div>
                            </div>
                            <div class="panel-body">
                                <h3>
                                    <?php echo $mensaje; ?>
                                </h3>
                                <div class="col-md-12">
                                    <a href="../../RegistraUsuario.php">
                                        <span class="glyphicon glyphicon-user"></span> Volver
                                    </a>
                                </div>
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

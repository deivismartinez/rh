<!DOCTYPE html>
<html> 
    <head> 
        <title>Inscripción Docente Unicesar</title> 
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link href="Tablero/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
        <link rel="icon" type="image/jpg" href="images/icono.png" />
        <style>
            #centered {
                position: fixed;
                top: 40%;
                left: 22%;
                /* bring your own prefixes */
                transform: translate(-50%, -50%);
            }
            body {
                background-image: url(images/fondo.jpg);
            }
        </style>
    </head> 
    <body> 
        <div class="fondoHeadHome">

            <div class="row" id="centered">
                <div class="col-xs-12">
                    <div class="panel panel-primary">
                        <div class = "panel-heading">
                            <h3 class = "panel-title">Inscripción Docente</h3>
                        </div>
                        <div class="panel-body">
                            <form class="form-control-static" name="entradaFrm" id="entradaFrm" action="Tablero/controller/Validar.php" method="POST">
                                <div class="form-group">
                                    <label for="usuarioTxt" class="control-label">Correo electronico</label>
                                    <input type="text" required class="form-control" id="usuarioTxt" name="usuarioTxt" placeholder="Correo registrado">
                                </div>
                                <div class="form-group">
                                    <label for="passwordPwd" class="control-label">Contrase&ntilde;a</label>
                                    <input type="password" required class="form-control" name="passwordPwd" id="passwordPwd" placeholder="Clave elegida">
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 col-md-offset-6">
                                        <a href="Tablero/OlvidoClave.php">
                                            <span class="glyphicon glyphicon-pencil"></span> Olvidé mi clave
                                        </a>
                                        <button type="submit" class="btn btn-warning">
                                            <span class="glyphicon glyphicon-user"></span> Entrar
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <a href="Tablero/RegistraUsuario.php">
                                            <span class="glyphicon glyphicon-camera"></span> Registrarme
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="panel-footer"><small>&copy; <b><script>document.write(new Date().getFullYear())</script> <a href="http://www.unicesar.edu.co">Unicesar</a></b> </small></div>
                    </div>
                </div>
            </div>
        </div>
        <script src="http://code.jquery.com/jquery.js"></script> 
        <script src="../Boot/js/bootstrap.min.js"></script> 
    </body> 
</html>

<!DOCTYPE html>
<html>

<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
    
    <title>Inscripción Docente Unicesar</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="Tablero/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link rel="icon" type="image/jpg" href="images/icono.png" />
    <style>
    #centered {
        position: fixed;
        top: 40%;
        left: 32%;
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
                    <div class="panel-heading">
                        <h3 class="panel-title">Inscripción Docente Prueba</h3>
                    </div>
                    <div class="panel-body">
                        <div>


                        </div>
                        <form class="form-control-static" name="entradaFrm" id="entradaFrm"
                            action="Tablero/controller/Validar.php" method="POST">
                            <div class="form-group">
                                <label for="usuarioTxt" class="control-label">Correo electronico</label>
                                <input type="text" required class="form-control" id="usuarioTxt" name="usuarioTxt"
                                    placeholder="Correo registrado">
                            </div>
                            <div class="form-group">
                                <label for="passwordPwd" class="control-label">Contrase&ntilde;a</label>
                                <input type="password" required class="form-control" name="passwordPwd" id="passwordPwd"
                                    placeholder="Clave elegida">
                            </div>
                            <div class="form-group">
                                <a href="Tablero/OlvidoClave.php">
                                    <span class="glyphicon glyphicon-pencil"></span> Olvidé mi clave
                                </a>
                                <div class="col-md-12 col-md-offset-6">
                                    <button type="submit" class="btn btn-warning">
                                        <span class="glyphicon glyphicon-user"></span> Entrar
                                    </button>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <?php ///abre condicion periodo
require_once "Tablero/clases/Periodo.php"; ////periodo
$p = new Perido();
if ($p->EsPeridoAbierto()) {
    ?>
                                    <a href="Tablero/RegistraUsuario.php">
                                        <span class="glyphicon glyphicon-camera"> </span> Registrarme
                                    </a>
                                    <?php ///cierra condicion periodo
}
?>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="panel-footer"><small>&copy; <b>
                                <script>
                                document.write(new Date().getFullYear())
                                </script> ESTAMOS EN PRUEBAS
                                <a href="http://www.unicesar.edu.co/"> Unicesar </a>
                                <div align="center">
                                    <a
                                        href="http://hojasdevida.unicesar.edu.co/InscripcionDocente/Tablero/MANUAL_DOCENTES.pdf">
                                        Manual de usuario </a>
                                    <a href="http://hojasdevida.unicesar.edu.co/InscripcionDocente/Tablero/Acuerdo036.pdf"
                                        target="_blank">
                                        <h3>ACUERDO 006 del 23 de Abril de 2018</h3>
                                    </a>
                                 </div>
                                  
                            </b> </small></div>
                </div>
            </div>
        </div>
    </div>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="../Boot/js/bootstrap.min.js"></script>
    
</body>

</html>
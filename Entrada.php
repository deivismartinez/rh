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
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    body {
         width:30%;
            height:30%;
            margin:0 auto;
            background-size: 2000px 1000px;
            background-repeat: no-repeat;
            background-image: url(images/fondoupc.jpeg);
            background-position: absolute;
        
    }
    
    .floating-message {
           position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            z-index: 1000;
            max-width: 400px;
            width: 90%;
            display: none; /* Inicialmente oculto */
            font-size: 18px; /* Tama 0 9o de letra m  s grande */
            line-height: 1.5;
            text-align: center;
        }
        
        .close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            cursor: pointer;
            font-weight: bold;
            font-size: 22px;
            color: #6c757d;
        }
    </style>
</head>

<body>
    
    <div class="fondoHeadHome">
        <div class="row" id="centered">
            <div class="col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Inscripción Docente</h3>
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
                                </script>2018
                                <a href="http://www.unicesar.edu.co/"> Unicesar </a>
                                <div align="center">
                                    <a
                                        href="http://hojasdevida.unicesar.edu.co/InscripcionDocente/Tablero/MANUAL_DOCENTES.pdf">
                                        Manual de usuario </a>
                                    <a href="http://hojasdevida.unicesar.edu.co/InscripcionDocente/Tablero/AcuerdoNo.027del31deoctubrede2024.pdf"
                                        target="_blank">
                                        <h3>ACUERDO 027 DEL 31 DE OCTUBRE DE 2024</h3>
                                    </a>
                                    
                                 </div>
                                  
                            </b> </small></div>
                </div>
            </div>
        </div>
    </div>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="../Boot/js/bootstrap.min.js"></script>
    
    <div class="floating-message" id="floatingMessage">
        <span class="close-btn" onclick="closeMessage()">&times;</span>
        <p>Recuerde que desde la entrada en vigencia del Acuerdo 027 del 31 de octubre de 2024 se cambi&oacute la forma de evaluar las hojas de vida de los aspirantes, la cual paso de cuantitativa a cualitativa.</p>
    </div>

    <script>
        // Mostrar el mensaje despu  s de que la p  gina cargue
        window.onload = function() {
            setTimeout(function() {
                document.getElementById('floatingMessage').style.display = 'block';
                
                // Ocultar autom  ticamente despu  s de 10 segundos (10000 milisegundos)
                setTimeout(function() {
                    document.getElementById('floatingMessage').style.display = 'none';
                }, 20000); // Cambia este valor para ajustar el tiempo de visualizaci  n
            }, 1000); // Retraso inicial antes de mostrar el mensaje
        };
        
        function closeMessage() {
            document.getElementById('floatingMessage').style.display = 'none';
        }
    </script>
    
</body>

</html>
<?php
require_once("../Tablero/vo/UsuarioVO.php");
require_once("../Tablero/vo/DocenteVO.php");
//require_once("../Tablero/clases/Docente.php");
//require_once("../Tablero/vo/PeridoVO.php");
session_start();
$usuario = $_SESSION['usuario'];
$archivo = "hvd".$usuario->getId();
$_SESSION['id_usuario']=$usuario->getId();


if (isset($usuario)) {

 
   
    if (isset($_POST["nombreCompletoTxt"])) {
        
     
      //  $u->insertar($usuario->getId());
               
    }
} else {
    header("Location: ../Entrada.html");
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="assets/img/favicon.ico">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title>Inscripción Docente Unicesar</title>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />


        <!-- Bootstrap core CSS     -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

        <!-- Animation library for notifications   -->
        <link href="assets/css/animate.min.css" rel="stylesheet"/>

        <!--  Light Bootstrap Table core CSS    -->
        <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>


        <!--  CSS for Demo Purpose, don't include it in your project     -->
        <link href="assets/css/demo.css" rel="stylesheet" />


        <!--     Fonts and icons     -->
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
        <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

    </head>
    <body>

        <div class="wrapper">
            <div class="sidebar" data-color="green" data-image="assets/img/sidebar-5.jpg">
                <div class="sidebar-wrapper">
                    <div class="logo">
                        <a href="#" class="simple-text">
                            Inscripción Docentes Unicesar
                        </a>
                    </div>

                    <ul class="nav">
                        <li>
                            <a href="inicio.php">
                                <i class="pe-7s-home"></i>
                                <p>Inicio</p>
                            </a>
                        </li>
                        <li class="active">
                            <a href="Basica.php">
                                <i class="pe-7s-user"></i>
                                <p>Información Básica</p>
                            </a>
                        </li>
                        <li>
                            <a href="Academica.php">
                                <i class="pe-7s-study"></i>
                                <p>Información Académica</p>
                            </a>
                        </li>
                        <?php ///abre condicion sede A DISTANCIA
                            if ($docente->getSede()!='A DISTANCIA') {
                            ?>
                        <li>
                            <a href="Programa.php">
                                <i class="pe-7s-note2"></i>
                                <p>Área a inscribirse</p>
                            </a>
                        </li>
                        <?php ///CIERRA condicion sede A DISTANCIA
                                }
                            ?>
                        <li>
                            <a href="ProgramaPostgrado.php">
                                <i class="pe-7s-global"></i>
                                <p>Docente de Postgrados o a Distancia</p>
                            </a>
                        </li>
                        <li>
                            <a href="Experiencia.php">
                                <i class="pe-7s-display1"></i>
                                <p>Experiencia Calificada</p>
                            </a>
                        </li>
                        <li>
                            <a href="Produccion.php">
                                <i class="pe-7s-science"></i>
                                <p>Producción Académica</p>
                            </a>
                        </li>
                        <li>
                            <a href="Resumen.php">
                                <i class="pe-7s-bookmarks"></i>
                                <p>Resumen del Puntaje</p>
                            </a>
                        </li>
                        <li>
                    <a href="ModificarMiClave.php">
                        <i class="pe-7s-key"></i>
                        <p>Cambio de Contraseña</p>
                    </a>
                </li>
                        <li>
                            <a href="../index.php">
                                <i class="pe-7s-power"></i>
                                <p>Salir</p>
                            </a>
                        </li>
                    </ul>
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
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-xs-11">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        Información Básica del docente
                                    </div>
                                    <h4>En esta ventana encontrará la Categoria Docente Universitario, seleccione la correcta para usted, al usted iniciar como docente universitario será AUXILIAR.</h4>
                                    <div class="panel-body">
                                        <form name="form" action="" method="post" enctype="multipart/form-data">
                                            
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="col-xs-6">
                                                        <label for="">Nombre  *</label>
                                                        <input value="<?php echo $docente->getNombres() ?>" required="true" type="text" class="form-control" name="nombreCompletoTxt" id="nombreCompletoTxt" placeholder="">
                                                    </div>
                                                     <div class="col-xs-6">
                                                        <label for="">Email  *</label>
                                                        <input value="<?php echo $docente->getEmail() ?>" required="true" type="email" class="form-control" name="emailEml" id="emailEml" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="col-xs-6">
                                                        <label for="">Facultad  *</label>
                                                         <select class="form-control" id="facultadCmb" name="facultadCmb" required="true" onchange="">                                                      <option value="">SELECCIONE</option>
                                                    <?php
                                                    $facultades = $p->getFacultadesDocentePostgrado();
                                                    foreach ($facultades as $arregloFac) {
                                                        echo '<OPTION value="' . $arregloFac[0] . '">' . $arregloFac[1] . '</OPTION>';
                                                    }
                                                    ?>
                                                </select>
                                                    </div>

                                                    <div class="col-xs-3">
                                                        <label for="">Rol  *</label>
                                                         <select class="form-control" id="rolCmb" name="rolCmb" required="true" onchange="">                                                      <option value="">SELECCIONE</option>
                                                    <?php
                                                    $facultades = $p->getFacultadesDocentePostgrado();
                                                    foreach ($facultades as $arregloFac) {
                                                        echo '<OPTION value="' . $arregloFac[0] . '">' . $arregloFac[1] . '</OPTION>';
                                                    }
                                                    ?>
                                                </select>
                                                    </div>

                                                     <div class="col-xs-3">
                                                        <label for="">Sede  *</label>
                                                         <select class="form-control" id="sedeCmb" name="sede<Cmb" required="true" onchange="">                                                      <option value="">SELECCIONE</option>
                                                    <?php
                                                    $facultades = $p->getFacultadesDocentePostgrado();
                                                    foreach ($facultades as $arregloFac) {
                                                        echo '<OPTION value="' . $arregloFac[0] . '">' . $arregloFac[1] . '</OPTION>';
                                                    }
                                                    ?>
                                                </select>
                                                    </div>
                                            </div>
                                            </div>
                                            
                                            
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="col-xs-6">
                                                        <label for="">Usuario  *</label>
                                                        <input value="<?php echo $docente->getDireccion() ?>" required="true" type="text" class="form-control" name="direccionTxt" id="usuarioiTxt" placeholder="">
                                                    </div>
                                                    <div class="col-xs-3">
                                                        <label for="">Contraseña</label>
                                                        <input value="<?php echo $docente->getTelefono() ?>" type="text" class="form-control" name="telefonoTxt" id="telefonoTxt" placeholder="">
                                                    </div>
                                                    <div class="col-xs-3">
                                                        <label for="">Repetir Contraseña</label>
                                                        <input value="<?php echo $docente->getCelular() ?>" type="text" class="form-control" name="celularTxt" id="celularTxt" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <br>
                                          
                                           
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="col-xs-12">
                                                        <div class="col-xs-6">
                                                        </div>
                                                        <div class="col-xs-3">
                                                        </div>
                                                        <div class="col-xs-3">
                                                            <center>
                                                            <?php
                                                            ///////////////////////////////////////////////
                                                            //var_dump($p->PeridoSede("'".$docente->getSede()."'"));
                                                            if ($p->PeridoSede("'".$docente->getSede()."'")){
                                                            //if ($p->PeridoSede("'".$docente->getSede()."'")){
                                                            ?> 
                                                              <button type="submit" class="btn btn-primary">
                                                                    <i class="pe-7s-diskette"></i> Guardar
                                                                </button>
                                                            <?php
                                                            }
                                                            ///////////////////////////////////////
                                                            ?>   
                                                            </center>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="panel-footer">
                                        &copy; <script>document.write(new Date().getFullYear())</script> <a href="http://www.unicesar.edu.co">Unicesar</a>, creado para Vicerrectoria Académica 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/funciones.js"></script>
    <!--   Core JS Files   -->
    <script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!--  Charts Plugin -->
    <script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
    <script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

    <!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
    <script src="assets/js/demo.js"></script>

    <script type="text/javascript">
                                                $(document).ready(function () {

                                                    demo.initChartist();

                                                    $.notify({
                                                        icon: 'pe-7s-notebook',
                                                        message: "Por favor diligencie <b>Su información Básica</b>"

                                                    }, {
                                                        type: 'info',
                                                        timer: 4000
                                                    });

                                                });
                                                function cargar() {
                                                    cargarDepartamentos(document.form.paisCmb.value);
                                                    if (document.form.paisCmb.value === 'CO') {
                                                        cargarMunicipios('11');
                                                    } else {
                                                        cargarMunicipios('0');
                                                    }
                                                }
    </script>

</html>
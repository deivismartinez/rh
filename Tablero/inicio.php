<?php
require_once './vo/UsuarioVO.php';
session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
    $nombre = $usuario->getName() . " " . $usuario->getLastName();

    require_once "clases/Docente.php";
    $u = new Docente();
    if (!$u->esActualizado($usuario->getId())) {
        $u->update($usuario->getId());
    }

} else {
    header('Location: AccesoNoautorizado.html');
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
<?php //include('menuDocentes.php'); ?>
    <div class="sidebar" data-color="green" data-image="assets/img/sidebar-5.jpg">

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="#" class="simple-text">
                    Inscripción Docentes Unicesar
                </a>
            </div>

            <ul class="nav">
                <li class="active">
                    <a href="inicio.php">
                        <i class="pe-7s-home"></i>
                        <p>Inicio</p>
                    </a>
                </li>
                <li>
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
                            if ($usuario->getSede()!='A DISTANCIA') {
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
                <!--<li class="active">
                            <a href="Resumen.php">
                                <i class="pe-7s-bookmarks"></i>
                                <p>Resumen del Puntaje</p>
                            </a>
                        </li>-->
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
                    <h3>   Bienvenido(a) <?php echo $nombre; ?></h3>
                    <?php
if ($u->esCalificado($usuario->getId())) {
    echo '<h3 style="color:#FF0000" >   Señor docente, Su hoja de vida ya se encuentra evaluada, si realiza algún cambio,
                        deberá ser sometida nuevamente al proceso de evaluación. </h3>';
}
?>
                    <h5>    Si usted diligenció información en periodos anteriores no tendrá el soporte adjuntado por cada item se le recomienda modificar la información para adjuntar el documento </h5>
                    </div>
                </div>
            <div class="row">
                <div class="col-xs-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                        Manuales para saber el uso de la aplicación
                    </div>
                        <div class="panel-body">
                        En los siguientes enlaces encontrará los manuales y videos de como gestionar su información en esta aplicación
                        <a href="VerManual.php" target="_blank"><h4>Leer en Linea</h4></a>
                        <a href="MANUAL_DOCENTES.pdf" target="_blank"><h4>Descargar PDF</h4></a>
                    </div>
                    </div>
                    </div>
                <div class="col-xs-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                        Normas que soportan la convocatoria y la aplicación
                    </div>
                        <div class="panel-body">
                            <a href="VerAcuerdo.php" target="_blank"><h3>ACUERDO 006 del 23 de Abril de 2018</h3></a>
                    </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="container-fluid">

                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="http://www.unicesar.edu.co">Unicesar</a>, creado para Vicerrectoria Académica
                </p>
            </div>
        </footer>
</div>


</body>

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
    	$(document).ready(function(){

        	demo.initChartist();

        	$.notify({
            	icon: 'pe-7s-notebook',
            	message: "Es usted Bienvenido(a) <b>Ahora puede inscribirse en el banco de hojas de vida</b>"

            },{
                type: 'info',
                timer: 4000
            });

    	});
	</script>

</html>

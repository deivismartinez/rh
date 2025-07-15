<?php
require_once("../Tablero/vo/UsuarioVO.php");
require_once("../Tablero/vo/DocenteVO.php");
session_start();
$usuario = $_SESSION['usuario'];
if (isset($usuario)) {
    require_once("clases/Producciones.php");
    $e = new Producciones();
    $articulos = $e->getArticulos($usuario);
    $libros = $e->getLibros($usuario);
    $monografias = $e->getMonografias($usuario);
    $patentes = $e->getPatentes($usuario);
    $software = $e->getSoftware($usuario);
    $obra=$e->getObras($usuario);
    $grupo = $e->getGrupo($usuario);
    $ptecnica= $e->getProduccionesTecnicas($usuario);
    require_once("clases/Periodo.php");////periodo
    require_once("clases/Docente.php");
    $p= new Perido();
    $d = new Docente();
    $docente = $d->getDatos($usuario->getId());
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

<?php // include('menuDocentes.php'); ?>
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
                <li class="active">
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
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    Agregar Producción Académica
                                </div>
                                <div class="panel-body">
                                <?php ///abre condicion periodo
                                    if ($p->PeridoSede("'".$docente->getSede()."'")){
                                    ?>
                                   <div class="col-xs-12">
                                                <div class="col-xs-4">
                                                    <a href="NuevoArticulo.php"><i class="pe-7s-plus"></i> <ins><b> Articulo</b></ins></a>
                                                </div>
                                        <div class="col-xs-4">
                                            <a href="NuevaMonografia.php"><i class="pe-7s-plus"></i> <ins><b> Asesoría de Monografías</b></ins></a>
                                            <a href="NuevoVideo.php"><i class="pe-7s-plus"></i> <ins><b>Producción de Videos</b></ins></a>
                                                </div>
                                        <div class="col-xs-4">
                                                    <a href="NuevoLibro.php"><i class="pe-7s-plus"></i> <ins><b> Libro</b></ins></a>
                                                </div>
                                        <div class="col-xs-0">
                                                </div>
                                        <div class="col-xs-0">
                                            
                                                </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="col-xs-4">
                                            <a href="NuevaPatente.php"><i class="pe-7s-plus"></i> <ins><b> Patente</b></ins></a>
                                            <a href="NuevaObra.php"><i class="pe-7s-plus"></i> <ins><b> Obra Artistica</b></ins></a>
                                                </div>
                                        <div class="col-xs-4">
                                            <a href="NuevoSoftware.php"><i class="pe-7s-plus"></i> <ins><b> Producción de Software</b></ins></a>
                                                </div>
                                        <div class="col-xs-4">
                                            <a href="NuevaInvestigacion.php"><i class="pe-7s-plus"></i> <ins><b> Investigaciones</b></ins></a>
                                                </div>
                                        <div class="col-xs-0">
                                            <a href="NuevaProdTecnica.php"><i class="pe-7s-plus"></i> <ins><b> Producción Ténica</b></ins></a>
                                                </div>
                                                
                                            </div>
                                            <?php  ///cierra condicion periodo
                                    }
                                    ?>

                                    <div class="col-xs-12">
                                                <table class="table table-bordered">	
                                                    <thead>	
                                                        <tr class="info">
                                                            <th>Tipo de Producción</th>
                                                            <th>Titulo/Nombre de la producción</th>
                                                            <th>Fecha de Creación/Producción</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($articulos as $arreglo) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $arreglo[0] ?></td>
                                                                <td><?php echo $arreglo[1] ?></td>
                                                                <td><?php echo $arreglo[2] ?></td>
                                                                <?php  
                                                               $url = "eliminar('controller/EliminarProduccion.php?id=".$arreglo[3]."&tipo=1');";
                                                               $urlVer = "controller/VerProduccion.php?id=".$arreglo[3]."&tipo=1"; 
                                                               $urlMod= "controller/ModificarProduccion.php?id=".$arreglo[3]."&tipo=1"; 
                                                                       ?>
                                                                <td>
                                                                    <?php 
                                                                    if (file_exists("Soportes/art".$arreglo[3].".pdf")) {}else{echo 'No tiene Adjunto';}
                                                                    ?>
                                                                    <a data-toggle="tooltip" title="Ver información" href="<?php echo $urlVer; ?>"><i class="pe-7s-credit"></i></a>
                                                                    <?php ///abre condicion periodo
                                                                      if ($p->PeridoSede("'".$docente->getSede()."'")){
                                                                     ?>
                                                                    <a data-toggle="tooltip" title="Modificar información" href="<?php echo $urlMod; ?>"><i class="pe-7s-refresh-cloud"></i></a>
                                                                    <a data-toggle="tooltip" title="Eliminar información" href="javascript:void(0);" onclick="<?php echo $url; ?>"><i class="pe-7s-trash"></i></a>
                                                                    <?php  ///cierra condicion periodo -->
                                                                    }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                            
                                                            <?php
                                                        foreach ($libros as $arregloLibros) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $arregloLibros[0] ?></td>
                                                                <td><?php echo $arregloLibros[1] ?></td>
                                                                <td><?php echo $arregloLibros[2] ?></td>
                                                                <?php  
                                                               $url = "eliminar('controller/EliminarProduccion.php?id=".$arregloLibros[3]."&tipo=3');";
                                                               $urlVer = "controller/VerProduccion.php?id=".$arregloLibros[3]."&tipo=3";
                                                               $urlMod = "controller/ModificarProduccion.php?id=".$arregloLibros[3]."&tipo=3";
                                                                       ?>
                                                                <td>
                                                                    <?php 
                                                                    if (file_exists("Soportes/lib".$arregloLibros[3].".pdf")) {}else{echo 'No tiene Adjunto';}
                                                                    ?>
                                                                    <a data-toggle="tooltip" title="Ver información" href="<?php echo $urlVer; ?>"><i class="pe-7s-credit"></i></a>
                                                                    <?php ///abre condicion periodo
                                                                      if ($p->PeridoSede("'".$docente->getSede()."'")){
                                                                     ?>
                                                                   <a data-toggle="tooltip" title="Modificar información" href="<?php echo $urlMod; ?>"><i class="pe-7s-refresh-cloud"></i></a>
                                                                    <a data-toggle="tooltip" title="Eliminar información" href="javascript:void(0);" onclick="<?php echo $url; ?>"><i class="pe-7s-trash"></i></a>
                                                                    <?php  ///cierra condicion periodo -->
                                                                    }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                            <?php
                                                        foreach ($monografias as $arregloMonografias) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $arregloMonografias[0] ?></td>
                                                                <td><?php echo $arregloMonografias[1] ?></td>
                                                                <td><?php echo $arregloMonografias[2] ?></td>
                                                                <?php  
                                                               $url = "eliminar('controller/EliminarProduccion.php?id=".$arregloMonografias[3]."&tipo=10');";
                                                               $urlVer = "controller/VerProduccion.php?id=".$arregloMonografias[3]."&tipo=10";
                                                               $urlMod = "controller/ModificarProduccion.php?id=".$arregloMonografias[3]."&tipo=10";
                                                                       ?>
                                                                <td>
                                                                    <?php 
                                                                    if (file_exists("Soportes/mon".$arregloMonografias[3].".pdf")) {}else{echo 'No tiene Adjunto';}
                                                                    ?>
                                                                    <a data-toggle="tooltip" title="Ver información" href="<?php echo $urlVer; ?>"><i class="pe-7s-credit"></i></a>
                                                                    <?php ///abre condicion periodo
                                                                      if ($p->PeridoSede("'".$docente->getSede()."'")){
                                                                     ?>
                                                                   <a data-toggle="tooltip" title="Modificar información" href="<?php echo $urlMod; ?>"><i class="pe-7s-refresh-cloud"></i></a>
                                                                    <a data-toggle="tooltip" title="Eliminar información" href="javascript:void(0);" onclick="<?php echo $url; ?>"><i class="pe-7s-trash"></i></a>
                                                                    <?php  ///cierra condicion periodo -->
                                                                    }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                            
                                                            <?php
                                                        foreach ($patentes as $arregloPatentes) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $arregloPatentes[0] ?></td>
                                                                <td><?php echo $arregloPatentes[1] ?></td>
                                                                <td><?php echo $arregloPatentes[2] ?></td>
                                                                <?php  
                                                               $url = "eliminar('controller/EliminarProduccion.php?id=".$arregloPatentes[3]."&tipo=5');";
                                                               $urlVer = "controller/VerProduccion.php?id=".$arregloPatentes[3]."&tipo=5";
                                                               $urlMod = "controller/ModificarProduccion.php?id=".$arregloPatentes[3]."&tipo=5";
                                                                       ?>
                                                                <td>
                                                                    <?php 
                                                                    if (file_exists("Soportes/pat".$arregloPatentes[3].".pdf")) {}else{echo 'No tiene Adjunto';}
                                                                    ?>
                                                                    <a data-toggle="tooltip" title="Ver información" href="<?php echo $urlVer; ?>"><i class="pe-7s-credit"></i></a>
                                                                    <?php ///abre condicion periodo
                                                                      if ($p->PeridoSede("'".$docente->getSede()."'")){
                                                                     ?>
                                                                   <a data-toggle="tooltip" title="Modificar información" href="<?php echo $urlMod; ?>"><i class="pe-7s-refresh-cloud"></i></a>
                                                                    <a data-toggle="tooltip" title="Eliminar información" href="javascript:void(0);" onclick="<?php echo $url; ?>"><i class="pe-7s-trash"></i></a>
                                                                    <?php  ///cierra condicion periodo -->
                                                                    }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                        <?php
                                                        foreach ($ptecnica as $arregloPtecnicas) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $arregloPtecnicas[0] ?></td>
                                                                <td><?php echo $arregloPtecnicas[1] ?></td>
                                                                <td><?php echo $arregloPtecnicas[2] ?></td>
                                                                <?php  
                                                               $url = "eliminar('controller/EliminarProduccion.php?id=".$arregloPtecnicas[3]."&tipo=5');";
                                                               $urlVer = "controller/VerProduccion.php?id=".$arregloPtecnicas[3]."&tipo=5";
                                                               $urlMod = "controller/ModificarProduccion.php?id=".$arregloPtecnicas[3]."&tipo=5";
                                                                       ?>
                                                                <td>
                                                                    <?php                   ////ojo
                                                                    if (file_exists("Soportes/prt".$arregloPtecnicas[3].".pdf")) {}else{echo 'No tiene Adjunto';}
                                                                    ?>
                                                                    <a data-toggle="tooltip" title="Ver información" href="<?php echo $urlVer; ?>"><i class="pe-7s-credit"></i></a>
                                                                    <?php ///abre condicion periodo
                                                                      if ($p->PeridoSede("'".$docente->getSede()."'")){
                                                                     ?>
                                                                   <a data-toggle="tooltip" title="Modificar información" href="<?php echo $urlMod; ?>"><i class="pe-7s-refresh-cloud"></i></a>
                                                                    <a data-toggle="tooltip" title="Eliminar información" href="javascript:void(0);" onclick="<?php echo $url; ?>"><i class="pe-7s-trash"></i></a>
                                                                    <?php  ///cierra condicion periodo -->
                                                                    }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                            <?php
                                                        foreach ($obra as $arregloObras) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $arregloObras[0] ?></td>
                                                                <td><?php echo $arregloObras[1] ?></td>
                                                                <td><?php echo $arregloObras[2] ?></td>
                                                                <?php  
                                                               $url = "eliminar('controller/EliminarProduccion.php?id=".$arregloObras[3]."&tipo=6');";
                                                               $urlVer = "controller/VerProduccion.php?id=".$arregloObras[3]."&tipo=6";
                                                               $urlMod = "controller/ModificarProduccion.php?id=".$arregloObras[3]."&tipo=6";
                                                                       ?>
                                                                <td>
                                                                    <?php                   ////ojo
                                                                    if (file_exists("Soportes/obr".$arregloObras[3].".pdf")) {}else{echo 'No tiene Adjunto';}
                                                                    ?>
                                                                    <a data-toggle="tooltip" title="Ver información" href="<?php echo $urlVer; ?>"><i class="pe-7s-credit"></i></a>
                                                                    <?php ///abre condicion periodo
                                                                      if ($p->PeridoSede("'".$docente->getSede()."'")){
                                                                     ?>
                                                                   <a data-toggle="tooltip" title="Modificar información" href="<?php echo $urlMod; ?>"><i class="pe-7s-refresh-cloud"></i></a>
                                                                    <a data-toggle="tooltip" title="Eliminar información" href="javascript:void(0);" onclick="<?php echo $url; ?>"><i class="pe-7s-trash"></i></a>
                                                                    <?php  ///cierra condicion periodo -->
                                                                    }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                            <?php
                                                        foreach ($software as $arregloSoftware) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $arregloSoftware[0] ?></td>
                                                                <td><?php echo $arregloSoftware[1] ?></td>
                                                                <td><?php echo $arregloSoftware[2] ?></td>
                                                                <?php  
                                                               $url = "eliminar('controller/EliminarProduccion.php?id=".$arregloSoftware[3]."&tipo=7');";
                                                               $urlVer = "controller/VerProduccion.php?id=".$arregloSoftware[3]."&tipo=7";
                                                               $urlMod = "controller/ModificarProduccion.php?id=".$arregloSoftware[3]."&tipo=7";
                                                                       ?>
                                                                <td>
                                                                    <?php 
                                                                    if (file_exists("Soportes/sof".$arregloSoftware[3].".pdf")) {}else{echo 'No tiene Adjunto';}
                                                                    ?>
                                                                    <a data-toggle="tooltip" title="Ver información" href="<?php echo $urlVer; ?>"><i class="pe-7s-credit"></i></a>
                                                                    <?php ///abre condicion periodo
                                                                      if ($p->PeridoSede("'".$docente->getSede()."'")){
                                                                     ?>
                                                                   <a data-toggle="tooltip" title="Modificar información" href="<?php echo $urlMod; ?>"><i class="pe-7s-refresh-cloud"></i></a>
                                                                    <a data-toggle="tooltip" title="Eliminar información" href="javascript:void(0);" onclick="<?php echo $url; ?>"><i class="pe-7s-trash"></i></a>
                                                                    <?php  ///cierra condicion periodo -->
                                                                    }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                            
                                                            <?php
                                                        foreach ($grupo as $arregloGrupo) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $arregloGrupo[0] ?></td>
                                                                <td><?php echo $arregloGrupo[1] ?></td>
                                                                <td><?php echo $arregloGrupo[2] ?></td>
                                                                <?php  
                                                               $url = "eliminar('controller/EliminarProduccion.php?id=".$arregloGrupo[3]."&tipo=9');";
                                                               $urlVer = "controller/VerProduccion.php?id=".$arregloGrupo[3]."&tipo=9";
                                                               $urlMod = "controller/ModificarProduccion.php?id=".$arregloGrupo[3]."&tipo=9";
                                                                       ?>
                                                                <td>
                                                                    <?php 
                                                                    if (file_exists("Soportes/gru".$arregloGrupo[3].".pdf")) {}else{echo 'No tiene Adjunto';}
                                                                    ?>
                                                                    <a data-toggle="tooltip" title="Ver información" href="<?php echo $urlVer; ?>"><i class="pe-7s-credit"></i></a>
                                                                    <?php ///abre condicion periodo
                                                                      if ($p->PeridoSede("'".$docente->getSede()."'")){
                                                                     ?>
                                                                   <a data-toggle="tooltip" title="Modificar información" href="<?php echo $urlMod; ?>"><i class="pe-7s-refresh-cloud"></i></a>
                                                                    <a data-toggle="tooltip" title="Eliminar información" href="javascript:void(0);" onclick="<?php echo $url; ?>"><i class="pe-7s-trash"></i></a>
                                                                    <?php  ///cierra condicion periodo -->
                                                                    }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                </div>
                                <div class="panel-footer">
                                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="http://www.unicesar.edu.co">Unicesar</a>, creado para Vicerrectoria Académica
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
    <script src="js/funciones.js"></script>
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
            	message: "Por favor diligencie <b>Su Producción Académica e Investigativa</b>"

            },{
                type: 'info',
                timer: 4000
            });

    	});
	</script>

</html>

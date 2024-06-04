<?php
require_once("../Tablero/vo/UsuarioVO.php");
require_once("../Tablero/vo/DocenteVO.php");
session_start();
$usuario = $_SESSION['usuario'];
if (isset($usuario)) {
    require_once("clases/Periodo.php");////periodo
    require_once("clases/Docente.php");
    $p= new Perido();
    require_once("clases/Estudios.php");
    $estudios = new Estudios();
    $pregrado = $estudios->getPregrados($usuario);
    $especializacion = $estudios->getEspecializaciones($usuario);
    $maestrias = $estudios->getMaestrias($usuario);
    $doctorados = $estudios->getDoctorados($usuario);
    $cursos = $estudios->getCursos($usuario);
    $d = new Docente();
    $id_docente=$usuario->getId();
    $_SESSION['id_docente']=$id_docente;
    $docente = $d->getDatos($usuario->getId());
} else {
    header("Location: ../index.php");
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

                <!--
            
                    Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
                    Tip 2: you can also add an image using data-image tag
            
                -->

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
                        <li class="active">
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
                                    <h5>Recuerde que si su título es de otro país debe estar convalidado y adjuntar en el mismo archivo el soporte de convalidación</h5>
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            Formación académica del docente
                                        </div>
                                        <div class="panel-body">
                                        <?php ///abre condicion periodo
                                                            if ($p->PeridoSede("'".$docente->getSede()."'")){
                                                            ?> 
                                           <div class="col-xs-12">
                                                <div class="col-xs-2">
                                                    <a href="NuevoCurso.php"><i class="pe-7s-plus"></i> <ins><b>Curso</b></ins></a>
                                                </div>
                                                <div class="col-xs-2">
                                                    <a href="NuevoPregrado.php"><i class="pe-7s-plus"></i> <ins><b> Pregrado</b></ins></a>
                                                </div>
                                                <div class="col-xs-2">
                                                    <a href="NuevaEscializacion.php"><i class="pe-7s-plus"></i> <ins><b> Especialidad</b></ins></a>
                                                </div>
                                                <div class="col-xs-2">
                                                    <a href="NuevaMaestria.php"><i class="pe-7s-plus"></i> <ins><b> Maestría</b></ins></a>
                                                </div>
                                                <div class="col-xs-4">
                                                    <a href="NuevoDoctorado.php"><i class="pe-7s-plus"></i> <ins><b> Doctorado</b></ins></a>
                                                </div>
                                            </div>

                                             <?php  ///cierra condicion periodo
                                                            }
                                                            ?>
                                            <div class="col-xs-12">
                                                <table class="table table-bordered">	
                                                    <thead>	
                                                        <tr class="info">
                                                            <th>Tipo de estudio</th>
                                                            <th>Título del estudio</th>
                                                            <th>Entidad que lo expide</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($pregrado as $arregloPregrado) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $arregloPregrado[0] ?></td>
                                                                <td><?php echo $arregloPregrado[1] ?></td>
                                                                <td><?php echo $arregloPregrado[2] ?></td>
                                                               <?php  
                                                               $url = "eliminar('controller/Eliminar.php?id=".$arregloPregrado[3]."&tipo=1');";
                                                               $urlVer = "controller/VerEstudios.php?id=".$arregloPregrado[3]."&tipo=1"; 
                                                                $urlMod = "controller/ModificarEstudios.php?id=".$arregloPregrado[3]."&tipo=1"; ?>
                                                                <td>
                                                                    <?php 
                                                                    if (file_exists("Soportes/ep".$arregloPregrado[3].".pdf")) {}else{echo 'No tiene Adjunto';}
                                                                    ?>
                                                                    <a data-toggle="tooltip" title="Ver información" href="<?php echo $urlVer; ?>"><i class="pe-7s-credit"></i></a>
                                                            <?php ///abre condicion periodo
                                                            if ($p->PeridoSede("'".$docente->getSede()."'")){
                                                            ?> 
                                                             <a data-toggle="tooltip" title="Modificar información" href="<?php  echo $urlMod; ?>"><i class="pe-7s-refresh-cloud"></i></a>
                                                                    <a data-toggle="tooltip" title="Eliminar información" href="javascript:void(0);" onclick="<?php  echo $url; ?>"><i class="pe-7s-trash"></i></a>
                                                                    
                                                                    
                                                                                                                           
                                                            <?php  ///cierra condicion periodo
                                                            }
                                                            ?> 
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                        <?php
                                                        foreach ($especializacion as $arregloEspecializacion) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $arregloEspecializacion[0] ?></td>
                                                                <td><?php echo $arregloEspecializacion[1] ?></td>
                                                                <td><?php echo $arregloEspecializacion[2] ?></td>
                                                                <?php  
                                                               $url = "eliminar('controller/Eliminar.php?id=".$arregloEspecializacion[3]."&tipo=2');";
                                                               $urlVer = "controller/VerEstudios.php?id=".$arregloEspecializacion[3]."&tipo=2";
                                                                $urlMod = "controller/ModificarEstudios.php?id=".$arregloEspecializacion[3]."&tipo=2"; ?>
                                                                <td>
                                                                    <?php 
                                                                    if (file_exists("Soportes/ee".$arregloEspecializacion[3].".pdf")) {}else{echo 'No tiene Adjunto';}
                                                                    ?>
                                                                    <a data-toggle="tooltip" title="Ver información" href="<?php echo $urlVer; ?>"><i class="pe-7s-credit"></i></a>
                                                            <?php ///abre condicion periodo
                                                            if ($p->PeridoSede("'".$docente->getSede()."'")){
                                                            ?> 
                                                                    <a data-toggle="tooltip" title="Modificar información" href="<?php echo $urlMod; ?>"><i class="pe-7s-refresh-cloud"></i></a>
                                                                    <a data-toggle="tooltip" title="Eliminar información" href="javascript:void(0);" onclick="<?php echo $url; ?>"><i class="pe-7s-trash"></i></a>
                                                            <?php  ///cierra condicion periodo
                                                            }
                                                            ?> 
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                            <?php
                                                        foreach ($maestrias as $arregloMaestria) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $arregloMaestria[0] ?></td>
                                                                <td><?php echo $arregloMaestria[1] ?></td>
                                                                <td><?php echo $arregloMaestria[2] ?></td>
                                                                <?php  
                                                               $url = "eliminar('controller/Eliminar.php?id=".$arregloMaestria[3]."&tipo=3');";
                                                               $urlVer = "controller/VerEstudios.php?id=".$arregloMaestria[3]."&tipo=3";
                                                                $urlMod = "controller/ModificarEstudios.php?id=".$arregloMaestria[3]."&tipo=3"; ?>
                                                                <td>
                                                                    <?php 
                                                                    if (file_exists("Soportes/em".$arregloMaestria[3].".pdf")) {}else{echo 'No tiene Adjunto';}
                                                                    ?>
                                                                    <a data-toggle="tooltip" title="Ver información" href="<?php echo $urlVer; ?>"><i class="pe-7s-credit"></i></a>
                                                            <?php ///abre condicion periodo
                                                            if ($p->PeridoSede("'".$docente->getSede()."'")){
                                                            ?> 
                                                                    <a data-toggle="tooltip" title="Modificar información" href="<?php  echo $urlMod; ?>"><i class="pe-7s-refresh-cloud"></i></a>
                                                                    <a data-toggle="tooltip" title="Eliminar información" href="javascript:void(0);" onclick="<?php  echo $url; ?>"><i class="pe-7s-trash"></i></a>
                                                            <?php  ///cierra condicion periodo
                                                            }
                                                            ?>   
                                                               
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                            <?php
                                                        foreach ($doctorados as $arregloDoctorado) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $arregloDoctorado[0] ?></td>
                                                                <td><?php echo $arregloDoctorado[1] ?></td>
                                                                <td><?php echo $arregloDoctorado[2] ?></td>
                                                                <?php  
                                                               $url = "eliminar('controller/Eliminar.php?id=".$arregloDoctorado[3]."&tipo=4');";
                                                               $urlVer = "controller/VerEstudios.php?id=".$arregloDoctorado[3]."&tipo=4";
                                                                $urlMod = "controller/ModificarEstudios.php?id=".$arregloDoctorado[3]."&tipo=4"; ?>
                                                                <td>
                                                                    <?php 
                                                                    if (file_exists("Soportes/ed".$arregloDoctorado[3].".pdf")) {}else{echo 'No tiene Adjunto';}
                                                                    ?>
                                                                    <a data-toggle="tooltip" title="Ver información" href="<?php echo $urlVer; ?>"><i class="pe-7s-credit"></i></a>
                                                            <?php ///abre condicion periodo
                                                            if ($p->PeridoSede("'".$docente->getSede()."'")){
                                                            ?>         
                                                                    <a data-toggle="tooltip" title="Modificar información" href="<?php  echo $urlMod; ?>"><i class="pe-7s-refresh-cloud"></i></a>
                                                                    <a data-toggle="tooltip" title="Eliminar información" href="javascript:void(0);" onclick="<?php  echo $url; ?>"><i class="pe-7s-trash"></i></a>
                                                            <?php  ///cierra condicion periodo
                                                            }
                                                            ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                        <?php
                                                        foreach ($cursos as $arreglo) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $arreglo[0] ?></td>
                                                                <td><?php echo $arreglo[1] ?></td>
                                                                <td><?php echo $arreglo[2] ?></td>
                                                                <?php  
                                                               $url = "eliminar('controller/Eliminar.php?id=".$arreglo[3]."&tipo=5');";
                                                               $urlVer = "controller/VerEstudios.php?id=".$arreglo[3]."&tipo=5";
                                                               $urlMod = "controller/ModificarEstudios.php?id=".$arreglo[3]."&tipo=5";
                                                                       ?>
                                                                <td>
                                                                    <?php 
                                                                    if (file_exists("Soportes/ec".$arreglo[3].".pdf")) {}else{echo 'No tiene Adjunto';}
                                                                    ?>
                                                                    <a data-toggle="tooltip" title="Ver información" href="<?php echo $urlVer; ?>"><i class="pe-7s-credit"></i></a>
                                                                    <?php ///abre condicion periodo
                                                                    if ($p->PeridoSede("'".$docente->getSede()."'")){
                                                                    ?>
                                                                    <a data-toggle="tooltip" title="Modificar información" href="<?php  echo $urlMod; ?>"><i class="pe-7s-refresh-cloud"></i></a>
                                                                    <a data-toggle="tooltip" title="Eliminar información" href="javascript:void(0);" onclick="<?php  echo $url; ?>"><i class="pe-7s-trash"></i></a>
                                                                    <?php  ///cierra condicion periodo
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
            </div>
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
                                                $(document).ready(function () {

                                                    demo.initChartist();

                                                    $.notify({
                                                        icon: 'pe-7s-notebook',
                                                        message: "Por favor diligencie <b>Su información Académica, recuerde que si su título es de otro país debe estar convalidado y adjuntar en el mismo archivo el soporte de convalidación</b>"

                                                    }, {
                                                        type: 'info',
                                                        timer: 1000
                                                    });

                                                });
    </script>

</html>

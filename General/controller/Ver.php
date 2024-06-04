<?php
require_once '../vo/UsuarioVO.php';
session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
    $nombre = $usuario->getName();
    $programa = $usuario->getlastName();
    require_once("../clases/Estudios.php");
    $estudios = new Estudios();
    $docente = new UsuarioVO();
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
    $nombreDocente = filter_input(INPUT_GET, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS);
    $docente->setId($id);
    $pregrado = $estudios->getPregrados($docente);
    $especializacion = $estudios->getEspecializaciones($docente);
    $maestrias = $estudios->getMaestrias($docente);
    $doctorados = $estudios->getDoctorados($docente);
    $cursos = $estudios->getCursos($docente);
    require_once("../clases/Puntajes.php");
    $puntajes = new Puntajes();
    $cantidadEspecializaciones = $puntajes->getNumeroEspecializaciones($docente);
    require_once("../clases/Programas.php");
    $areas = new Programas();
    $area = $areas->getProgramaUsuarioPerfil($docente);
    require_once("../clases/Docente.php");
    $d = new Docente();
    $docenteDatos = $d->getDatos($docente->getId());
    $categoria = $puntajes->getCategoria($docente);
    require_once("../clases/Experiencias.php");
    $e = new Experiencias();
    $experiencia = $e->getExperiencia($docente);
    $categoriaInvestigador = $puntajes->getCategoriaInvestigador($docente);
    require_once("../clases/Producciones.php");
    $pro = new Producciones();
    $grupo = $pro->getGrupo($docente);
    $libros = $pro->getLibros($docente);
    $articulos = $pro->getArticulos($docente);
    $patentes = $pro->getPatentes($docente);
    $software = $pro->getSoftware($docente);
} else {
    header('Location: AccesoNoautorizado.html');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>Administración Inscripción Docente Unicesar</title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="../assets/css/animate.min.css" rel="stylesheet"/>
        <link href="../assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>
        <link href="../assets/css/demo.css" rel="stylesheet" />
        <link href="../assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
        <style>
            body{
                padding-top:15px;
                font-family: 'Open Sans', sans-serif;
                font-size:13px;
            }

            .tabla {
                margin: 0 auto;
            }
            .tabla thead {
                cursor: pointer;
                background: rgba(0, 0, 255, 1);
                color: rgba(255, 255, 255, 1);
            }
            .tabla thead tr th { 
                font-weight: bold;
                padding: 10px 20px;
            }
            .tabla thead tr th span { 
                padding-right: 20px;
                background-repeat: no-repeat;
                background-position: 100% 55%;
            }
            .tabla tbody tr td {
                text-align: center;
                padding: 10px 20px;
            }
            .tabla tbody tr td.align-left {
                text-align: left;
            }
        </style>
    </head>
    <body>
        <div class="wrapper">
            <div class="sidebar" data-color="green" data-image="../assets/img/sidebar-5.jpg">
                <div class="sidebar-wrapper">
                    <div class="logo">
                        <a href="#" class="simple-text">
                            Consulta de Docentes Inscritos
                        </a>
                    </div>
                    <ul class="nav">
                        <li class="active">
                            <a href="#">
                                <i class="pe-7s-photo-gallery"></i>
                                <p>Inscritos por Facultad</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="pe-7s-albums"></i>
                                <p>Inscritos por Departamentos</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="pe-7s-display1"></i>
                                <p>Estadisticas</p>
                            </a>
                        </li>
                        <li class="active-pro">
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
                            <img class="img-responsive" alt="UPC" src="../../images/titulo.png">
                        </div>
                        <div class="collapse navbar-collapse">
                        </div>
                    </div>
                </nav>

                <div class="content">
                    <div class="container-fluid">
                    </div>
                    <div class="col-xs-12">
                        <?php echo '<h5>' . $nombreDocente . '</h5>'; ?>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    Área de Desempeño y Categoria Docente
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <table class="table table-bordered">	
                                                <thead>	
                                                    <tr class="info">
                                                        <th>Facultad</th>
                                                        <th>Departamento</th>
                                                        <th>Área de Conocimiento</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($area as $arregloArea) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $arregloArea[0] ?></td>
                                                            <td><?php echo $arregloArea[1] ?></td>
                                                            <td><?php echo $arregloArea[2] ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                            <table class="table table-bordered">	
                                                <thead>	
                                                    <tr class="info">
                                                        <th>Categoria</th>
                                                        <th>Puntos Sugeridos</th>
                                                        <th>Puntos Asignados</th>
                                                        <th>Comentario</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><?php echo $docenteDatos->getCategoria(); ?></td>
                                                        <td><?php echo $categoria ?></td>
                                                        <?php echo '<td><input type="text" name="pes" id="pes" size="2"></td>' ?>
                                                        <?php echo '<td><textarea cols="30" rows="3"></textarea></td>' ?>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    Formación Académica
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <table class="table table-bordered">	
                                                <thead>	
                                                    <tr class="info">
                                                        <th>Tipo de estudio</th>
                                                        <th>Título del estudio</th>
<!--                                                            <th>Entidad que lo expide</th>-->

                                                        <th>P.S.</th>
                                                        <th>P.A.</th>
                                                        <th>Comentario</th>
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
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <?php $urlVer = "VerAdjuntoPAdmin.php?id=" . $arregloPregrado[3]; ?>
                                                            <td>
                                                                <a data-toggle="tooltip" target="_blank" title="Adjunto" href="<?php echo $urlVer; ?>"><i class="pe-7s-credit"></i> Ver Adjunto</a>
                                                            </td>
                                                        </tr>
    <?php
}
?>
                                                    <?php
                                                    $i = 0;
                                                    foreach ($especializacion as $arregloEspecializacion) {
                                                        $i = $i + 1;
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $arregloEspecializacion[0] ?></td>
                                                            <td><?php echo $arregloEspecializacion[1] ?></td>
                                                            <td><?php if ($i == 1) {
                                                        echo '20';
                                                    } else {
                                                        if ($i == 2) {
                                                            echo '10';
                                                        } else {
                                                            
                                                        }
                                                    } ?></td>
                                                            <td><input type="text" name="pes" id="pes" size="2"></td>
                                                            <td><textarea cols="30" rows="3"></textarea></td>
                                                        <?php $urlVer = "VerAdjuntoEAdmin.php?id=" . $arregloEspecializacion[3]; ?>
                                                            <td>
                                                                <a data-toggle="tooltip" title="Ver información" target="_blank" href="<?php echo $urlVer; ?>"><i class="pe-7s-credit"></i> Ver Adjunto</a>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    ?>
<?php
$i = 0;
foreach ($maestrias as $arregloMaestria) {
    $i = $i + 1;
    ?>
                                                        <tr>
                                                            <td><?php echo $arregloMaestria[0] ?></td>
                                                            <td><?php echo $arregloMaestria[1] ?></td>
                                                            <td><?php if ($i == 1) {
                                                            echo '40';
                                                        } else {
                                                            if ($i == 2) {
                                                                echo '20';
                                                            } else {
                                                                
                                                            }
                                                        } ?></td>

                                                            <td><input type="text" name="pes" id="pes" size="2"></td>
                                                            <td><textarea cols="30" rows="3"></textarea></td>
                                                        <?php $urlVer = "VerAdjuntoMAdmin.php?id=" . $arregloMaestria[3]; ?>
                                                            <td>
                                                                <a data-toggle="tooltip" target="_blank" title="Ver información" href="<?php echo $urlVer; ?>"><i class="pe-7s-credit"></i> Ver Adjunto</a>
                                                            </td>
                                                        </tr>
    <?php
}
?>
                                                        <?php
                                                        $i = 0;
                                                        foreach ($doctorados as $arregloDoctorado) {
                                                            $i = $i + 1;
                                                            ?>
                                                        <tr>
                                                            <td><?php echo $arregloDoctorado[0] ?></td>
                                                            <td><?php echo $arregloDoctorado[1] ?></td>
                                                            <td><?php if ($i == 1) {
                                                        echo '80';
                                                    } else {
                                                        if ($i == 2) {
                                                            echo '40';
                                                        } else {
                                                            
                                                        }
                                                    } ?></td>
                                                            <td><input type="text" name="pes" id="pes" size="2"></td>
                                                            <td><textarea cols="30" rows="3"></textarea></td>
                                                            <?php $urlVer = "VerAdjuntoDAdmin.php?id=" . $arregloDoctorado[3]; ?>
                                                            <td>
                                                                <a data-toggle="tooltip" target="_blank" title="Ver información" href="<?php echo $urlVer; ?>"><i class="pe-7s-credit"></i> Ver Adjunto</a>
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
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
    <?php
    $urlVer = "VerAdjuntoAdmin.php?id=" . $arreglo[3];
    ?>
                                                            <td>
                                                                <a data-toggle="tooltip" target="_blank" title="Ver información" href="<?php echo $urlVer; ?>"><i class="pe-7s-credit"></i> Ver Adjunto</a>
                                                            </td>
                                                        </tr>
    <?php
}
?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-12">
                                            <a href="../inicio.php">
                                                <h4><i class="pe-7s-back"></i>Volver</h4>
                                            </a>
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
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="pe-7s-diskette"></i> Guardar
                                                        </button>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    Experiencia Calificada
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <table class="table table-bordered">	
                                            <thead>	
                                                <tr class="info">
                                                    <th>Tipo de Experiencia</th>
                                                    <th>Puntos Sugeridos</th>
                                                        <th>Puntos Asignados</th>
                                                        <th>Comentario</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($experiencia as $arreglo) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $arreglo[0] ?></td>
                                                        <td></td>
                                                        <td><input type="text" name="pes" id="pes" size="2"></td>
                                                            <td><textarea cols="30" rows="3"></textarea></td>
                                                        <?php
                                                        $urlVer = "controller/VerExperiencia.php?id=" . $arreglo[5] . "&tipo=1";
                                                        ?>
                                                        <td>
                                                            <a data-toggle="tooltip" title="Ver Adjunto" href="<?php echo $urlVer; ?>"><i class="pe-7s-credit"></i>Ver Adjunto</a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    Producción Académica
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <b>INVESTIGACIÓN</b>
                                            <table class="table table-bordered">	
                                                <thead>	
                                                    <tr class="info">
                                                        <th>GRUPO</th>
                                                        <th>Puntos Sugeridos</th>
                                                        <th>Puntos Asignados</th>
                                                        <th>Comentario</th>
                                                    <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        foreach ($grupo as $arregloGrupo) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $arregloGrupo[0] ?></td>
                                                                <td></td>
                                                        <td><input type="text" name="pes" id="pes" size="2"></td>
                                                            <td><textarea cols="30" rows="3"></textarea></td>
                                                                <?php  
                                                               $url = "eliminar('controller/EliminarProduccion.php?id=".$arregloGrupo[3]."&tipo=9');";
                                                               $urlVer = "controller/VerProduccion.php?id=".$arregloGrupo[3]."&tipo=9";
                                                                       ?>
                                                                <td>
                                                                    <a data-toggle="tooltip" title="Ver información" href="<?php echo $urlVer; ?>"><i class="pe-7s-credit"></i></a>
                                                                    <a data-toggle="tooltip" title="Eliminar información" href="javascript:void(0);" onclick="<?php echo $url; ?>"><i class="pe-7s-trash"></i></a>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                </tbody>
                                            </table>
                                            <b>CATEGORÍA COMO INVESTIGADOR</b>
                                            <table class="table table-bordered">	
                                                <thead>	
                                                    <tr class="info">
                                                        <th>Categoría del Investidor</th>
                                                        <th>Puntos Sugeridos</th>
                                                        <th>Puntos Asignados</th>
                                                        <th>Comentario</th>
                                                    <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                            <tr>
                                                                <td><?php echo $categoriaInvestigador; ?></td>
                                                                <td></td>
                                                        <td><input type="text" name="pes" id="pes" size="2"></td>
                                                            <td><textarea cols="30" rows="3"></textarea></td>
                                                                <?php  
                                                               $url = "eliminar('controller/EliminarProduccion.php?id=".$arregloGrupo[3]."&tipo=9');";
                                                               $urlVer = "controller/VerProduccion.php?id=".$arregloGrupo[3]."&tipo=9";
                                                                       ?>
                                                                <td>
                                                                    <a data-toggle="tooltip" title="Ver información" href="<?php echo $urlVer; ?>"><i class="pe-7s-credit"></i></a>
                                                                    <a data-toggle="tooltip" title="Eliminar información" href="javascript:void(0);" onclick="<?php echo $url; ?>"><i class="pe-7s-trash"></i></a>
                                                                </td>
                                                            </tr>
                                                           
                                                </tbody>
                                            </table>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="../assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
    <script src='../assets/js/jquery2.1.3sorter.js'></script>
    <script>
        $(function () {
            $('#mi-tabla').tablesorter();
        });

        $(document).ready(function () {
            var consulta;
            //hacemos focus al campo de búsqueda
            $("#busqueda").focus();

            //comprobamos si se pulsa una tecla
            $("#busqueda").keyup(function (e) {

                //obtenemos el texto introducido en el campo de búsqueda
                consulta = $("#busqueda").val();
                //hace la búsqueda                                                                                  
                $.ajax({
                    type: "POST",
                    url: "buscar.php",
                    data: "b=" + consulta,
                    dataType: "html",
                    beforeSend: function () {
                        //imagen de carga
                        $("#resultado").html("<p align='center'><img src='../images/load.gif' /></p>");
                    },
                    error: function () {
                        alert("error petición ajax");
                    },
                    success: function (data) {
                        $("#resultado").empty();
                        $("#resultado").append(data);
                    }
                });
            });
        });
    </script>

    <script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../assets/js/chartist.min.js"></script>
    <script src="../assets/js/bootstrap-notify.js"></script>
    <script src="../assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>
    <script src="../assets/js/demo.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            demo.initChartist();
            $.notify({
                icon: 'pe-7s-notebook',
                message: "Bienvenido(a) <b>Ahora puede consultar el banco de hojas de vida</b>"
            }, {
                type: 'info',
                timer: 4000
            });
        });
    </script>
</html>

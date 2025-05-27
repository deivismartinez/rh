<?php
require_once '../vo/UsuarioVO.php';
require_once '../vo/CalificacionVO.php';
session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
    $uAdmin = $_SESSION['administrar'];
    $nombre = $usuario->getName();
    $nombreUsuario = $usuario->getName();
    $programa = $usuario->getlastName();
    $idAdmin = $usuario->getIdentidad();
    require_once("../clases/Estudios.php");
    require_once("../clases/Docente.php");
    $doc = new Docente();
    $estudios = new Estudios();
    $docente = new UsuarioVO();
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
    $usuario->setId($id);
    $nombreDocente = filter_input(INPUT_GET, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS);
    $docente->setId($id);
    $datos = $doc->getDatos($id);
    $pregrado = $estudios->getPregrados($docente);
    $especializacion = $estudios->getEspecializacionesNormales($docente);
    $especializacionEsp = $estudios->getEspecializacionesEspeciales($docente);
    $maestrias = $estudios->getMaestrias($docente);
    $doctorados = $estudios->getDoctorados($docente);
    $cursos = $estudios->getCursos($docente);
    $numeroEspecializacion = 0;
    $categoria = $datos->getCategoria();
    require_once("../clases/Programas.php");
    $programas = new Programas();
    $programaLista = $programas->getProgramaUsuarioPerfil($usuario);
    require_once("../clases/Experiencias.php");
    $e = new Experiencias();
    $experienciaAdm = $e->getExperienciaAdm($usuario);
    require_once("../clases/Producciones.php");
    $produccion = new Producciones();
    $grupo = $produccion->getGrupoAdm($usuario);
    $invest = $produccion->getGrupoAdmInv($usuario);
    $articulos = $produccion->getArticulosAdm($usuario);
    $libros = $produccion->getLibrosAdm($usuario);
    $monografias = $produccion->getMonografiasAdm($usuario);
    $patentes = $produccion->getPatentes($usuario);
    $software = $produccion->getSoftware($usuario);
    //$obra = $produccion->getObras($usuario);
    //var_dump($obra);
    $nombre = $datos->getApellidos() . ' ' . $datos->getNombres();
    if (isset($_POST["puntoscategoria"])) {
        $u = new Docente();
        $u->insertarCalificacion($usuario->getId(),$nombre,$programa,$nombreUsuario,$idAdmin);
    }
    $puntosAcademicos = 0;
    $puntosExperiencia = 0;
    $puntosInvestigacion = 0;
    $puntosPublicaciones = 0;
    $puntosDigitados = new CalificacionVO();
    $puntosDigitados = $e->getDatosCalificacion($id);
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
                            <a href="../../Admin/inicioAdmin.php">
                                <i class="pe-7s-photo-gallery"></i>
                                <p>Inscritos por Áreas</p>
                            </a>
                        </li>
                        <li class="active">
                            <a href="../../Admin/Calificados.php">
                                <i class="pe-7s-photo-gallery"></i>
                                <p>Inscritos Calificados</p>
                            </a>
                        </li>
<!--                        <li>
                            <a href="#">
                                <i class="pe-7s-display1"></i>
                                <p>Estadisticas</p>
                            </a>
                        </li>-->
                        <li class="active-pro">
                            <a href="../../Admin/index.php">
                                <i class="pe-7s-power"></i>
                                <p>Salir</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <form name="form" action="" method="post">
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
                        <h5>
                            <?php echo $datos->getApellidos() . ' ' . $datos->getNombres() . ', Cel. ' . $datos->getCelular() . ', email: ' . $datos->getEmail(); ?>
                        </h5>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    Áreas de Conocimiento en las que se inscribió
                                </div>
                                <div class="panel-body">
                                    <div class="content">
                                        <div class="container-fluid">
                                        </div>
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
                                                        foreach ($programaLista as $arreglo) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $arreglo[0] ?></td>
                                                                <td><?php echo $arreglo[1] ?></td>
                                                                <td><?php echo $arreglo[2] ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                                <table class="table table-bordered">	
                                                    <thead>	
                                                        <tr class="info">
                                                            <th>Categoria Docente</th>
                                                            <th>Cal. Actual</th>
                                                        <th>Cal. Nueva</th>
                                                        <th>Comentario</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                            <tr>
                                                                <td><?php echo $categoria ?></td>
                                                                <td><?php echo $datos->getCualitativa() ?></td>
    <?php
    echo '<td><select class="form-control" id="puntoscategoria" name="puntoscategoria" required="true">'
    . '<option value="" selected="true">SELECCIONE</option>';
    if($puntosDigitados->getcategoria()=='CUMPLE'){
        echo '<option value="CUMPLE" selected="true">CUMPLE</option>';
    }else{
        echo '<option value="CUMPLE">CUMPLE</option>';
    }
    if($puntosDigitados->getcategoria()=='NO CUMPLE'){
        echo '<option value="NO CUMPLE" selected="true">NO CUMPLE</option>';
    }else{
        echo '<option value="NO CUMPLE">NO CUMPLE</option>';
    }
    if($puntosDigitados->getcategoria()=='NO APLICA'){
        echo '<option value="NO APLICA" selected="true">NO APLICA</option>';
    }else{
        echo '<option value="NO APLICA">NO APLICA</option>';
    }
    echo '</select></td>';
    echo '<td><textarea class="form-control" id="comentarioCategoria" name="comentarioCategoria">'.$puntosDigitados->getcomentariocategoria().'</textarea></td>';
    ?>
                                                                <?php $urlVer = "VerAdjuntoAdm.php?id=" . $id . "&tipo=5"; ?>
                                                            <td>
                                                                 <?php 
                                                                    if (file_exists("../Soportes/hvd".$id.".pdf")) {
                                                                    ?>
                                                                <a data-toggle="tooltip" title="Adjunto" href="<?php echo $urlVer; ?>" target="_blank"><i class="pe-7s-credit"></i> Ver Adjunto</a>
                                                                <?php 
                                                                }else {
                                                                    ?>
                                                                No tiene Adjunto
                                                                <?php 
                                                                }
                                                                ?>
                                                            </td>
                                                            </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                                        <th>Entidad que lo expide</th>
                                                        <th>Puntaje Sugerido</th>
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
                                                            <td><?php echo '' ?></td>
                                                            <?php $urlVer = "VerAdjuntoAdm.php?id=" . $arregloPregrado[3] . "&tipo=1"; ?>
                                                            <td>
                                                                <?php 
                                                                    if (file_exists("../Soportes/ep".$arregloPregrado[3].".pdf")) {
                                                                    ?>
                                                                <a data-toggle="tooltip" title="Adjunto" href="<?php echo $urlVer; ?>" target="_blank"><i class="pe-7s-credit"></i> Ver Adjunto</a>
                                                            <?php 
                                                                }else {
                                                                    ?>
                                                                No tiene Adjunto
                                                                <?php 
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    foreach ($especializacionEsp as $arregloEspecializacionEsp) {
                                                        $numeroEspecializacion = $numeroEspecializacion + 1;
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $arregloEspecializacionEsp[0] ?></td>
                                                            <td><?php echo $arregloEspecializacionEsp[1] ?></td>
                                                            <td><?php echo $arregloEspecializacionEsp[2] ?></td>
    <?php
    if ($numeroEspecializacion == 1) {
        $puntosAcademicos = $puntosAcademicos + 40;
        echo '<td>40</td>';
    } else {
        if ($numeroEspecializacion == 2) {
            $puntosAcademicos = $puntosAcademicos + 20;
            echo '<td>20</td>';
        } else {
            echo '<td></td>';
        }
    }
    ?>
                                                            <?php $urlVer = "VerAdjuntoAdm.php?id=" . $arregloEspecializacionEsp[3] . "&tipo=2"; ?>
                                                            <td>
                                                                <?php 
                                                                    if (file_exists("../Soportes/ee".$arregloEspecializacionEsp[3].".pdf")) {
                                                                    ?>
                                                                <a data-toggle="tooltip" title="Ver información" href="<?php echo $urlVer; ?>" target="_blank"><i class="pe-7s-credit"></i> Ver Adjunto</a>
                                                                <?php 
                                                                }else {
                                                                    ?>
                                                                No tiene Adjunto
                                                                <?php 
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                            <?php
                                                        }
                                                        ?>
<?php
foreach ($especializacion as $arregloEspecializacion) {
    $numeroEspecializacion = $numeroEspecializacion + 1;
    ?>
                                                        <tr>
                                                            <td><?php echo $arregloEspecializacion[0] ?></td>
                                                            <td><?php echo $arregloEspecializacion[1] ?></td>
                                                            <td><?php echo $arregloEspecializacion[2] ?></td>
                                                        <?php
                                                        if ($numeroEspecializacion == 1) {
                                                            $puntosAcademicos = $puntosAcademicos + 20;
                                                            echo '<td>20</td>';
                                                        } else {
                                                            if ($numeroEspecializacion == 2) {
                                                                $puntosAcademicos = $puntosAcademicos + 10;
                                                                echo '<td>10</td>';
                                                            } else {
                                                                echo '<td></td>';
                                                            }
                                                        }
                                                        ?>
                                                            <?php $urlVer = "VerAdjuntoAdm.php?id=" . $arregloEspecializacion[3] . "&tipo=2"; ?>
                                                            <td>
                                                                <?php 
                                                                    if (file_exists("../Soportes/ee".$arregloEspecializacion[3].".pdf")) {
                                                                    ?>
                                                                <a data-toggle="tooltip" title="Ver información" href="<?php echo $urlVer; ?>" target="_blank"><i class="pe-7s-credit"></i> Ver Adjunto</a>
                                                                 <?php 
                                                                }else {
                                                                    ?>
                                                                No tiene Adjunto
                                                                <?php 
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                        <?php
                                                        $numeroMaestrias = 0;
                                                        foreach ($maestrias as $arregloMaestria) {
                                                            $numeroMaestrias = $numeroMaestrias + 1;
                                                            ?>
                                                        <tr>
                                                            <td><?php echo $arregloMaestria[0] ?></td>
                                                            <td><?php echo $arregloMaestria[1] ?></td>
                                                            <td><?php echo $arregloMaestria[2] ?></td>
                                                        <?php
                                                        if ($numeroMaestrias == 1) {
                                                            $puntosAcademicos = $puntosAcademicos + 40;
                                                            echo '<td>40</td>';
                                                        } else {
                                                            if ($numeroMaestrias == 2) {
                                                                $puntosAcademicos = $puntosAcademicos + 20;
                                                                echo '<td>20</td>';
                                                            } else {
                                                                echo '<td></td>';
                                                            }
                                                        }
                                                        ?>
                                                            <?php $urlVer = "VerAdjuntoAdm.php?id=" . $arregloMaestria[3] . "&tipo=3"; ?>
                                                            <td>
                                                                <?php 
                                                                    if (file_exists("../Soportes/em".$arregloMaestria[3].".pdf")) {
                                                                    ?>
                                                                <a data-toggle="tooltip" title="Ver información" href="<?php echo $urlVer; ?>" target="_blank"><i class="pe-7s-credit"></i> Ver Adjunto</a>
                                                                <?php 
                                                                }else {
                                                                    ?>
                                                                No tiene Adjunto
                                                                <?php 
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                        <?php
                                                        $numeroDoctorados = 0;
                                                        foreach ($doctorados as $arregloDoctorado) {
                                                            $numeroDoctorados = $numeroDoctorados + 1;
                                                            ?>
                                                        <tr>
                                                            <td><?php echo $arregloDoctorado[0] ?></td>
                                                            <td><?php echo $arregloDoctorado[1] ?></td>
                                                            <td><?php echo $arregloDoctorado[2] ?></td>
                                                        <?php
                                                        if ($numeroDoctorados == 1) {
                                                            $puntosAcademicos = $puntosAcademicos + 80;
                                                            echo '<td>80</td>';
                                                        } else {
                                                            if ($numeroDoctorados == 2) {
                                                                $puntosAcademicos = $puntosAcademicos + 40;
                                                                echo '<td>40</td>';
                                                            } else {
                                                                echo '<td></td>';
                                                            }
                                                        }
                                                        ?>
                                                            <?php $urlVer = "VerAdjuntoAdm.php?id=" . $arregloDoctorado[3] . "&tipo=4"; ?>
                                                            <td>
                                                                <?php 
                                                                    if (file_exists("../Soportes/ed".$arregloDoctorado[3].".pdf")) {
                                                                    ?>
                                                                <a data-toggle="tooltip" title="Ver información" href="<?php echo $urlVer; ?>" target="_blank"><i class="pe-7s-credit"></i> Ver Adjunto</a>
                                                                <?php 
                                                                }else {
                                                                    ?>
                                                                No tiene Adjunto
                                                                <?php 
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
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <label for="">Puntos Sugeridos por estudios</label>
                                            <input type="text" size="4" disabled="true" value="<?php echo $puntosAcademicos ?>"  id="estSugerido" name="estSugerido" class="form-control"/>
                                        </div>
                                        <div class="col-xs-4">
                                            <label for="">Total Puntos Confirmados por estudios</label>
                                            <select class="form-control" id="puntosestudios" name="puntosestudios" required="true">
                                                <option value="" selected="true">SELECCIONE</option>
                                                <?php if($puntosDigitados->getestudios()=='0') { ?>
                                                <option value="0" selected="true">0</option>
                                                <?php }else {?>
                                                <option value="0">0</option>
                                                <?php } ?>
                                                <?php if($puntosDigitados->getestudios()=='20') { ?>
                                                <option value="20" selected="true">20</option>
                                                <?php }else {?>
                                                <option value="20">20</option>
                                                <?php } ?>
                                                <?php if($puntosDigitados->getestudios()=='30') { ?>
                                                <option value="30" selected="true">30</option>
                                                <?php }else {?>
                                                <option value="30">30</option>
                                                <?php } ?>
                                                <?php if($puntosDigitados->getestudios()=='40') { ?>
                                                <option value="40" selected="true">40</option>
                                                <?php }else {?>
                                                <option value="40">40</option>
                                                <?php } ?>
                                                <?php if($puntosDigitados->getestudios()=='60') { ?>
                                                <option value="60" selected="true">60</option>
                                                <?php }else {?>
                                                <option value="60">60</option>
                                                <?php } ?>
                                                <?php if($puntosDigitados->getestudios()=='70') { ?>
                                                <option value="70" selected="true">70</option>
                                                <?php }else {?>
                                                <option value="70">70</option>
                                                <?php } ?>
                                                <?php if($puntosDigitados->getestudios()=='80') { ?>
                                                <option value="80" selected="true">80</option>
                                                <?php }else {?>
                                                <option value="80">80</option>
                                                <?php } ?>
                                                <?php if($puntosDigitados->getestudios()=='90') { ?>
                                                <option value="90" selected="true">90</option>
                                                <?php }else {?>
                                                <option value="90">90</option>
                                                <?php } ?>
                                                <?php if($puntosDigitados->getestudios()=='100') { ?>
                                                <option value="100" selected="true">100</option>
                                                <?php }else {?>
                                                <option value="100">100</option>
                                                <?php } ?>
                                                <?php if($puntosDigitados->getestudios()=='110') { ?>
                                                <option value="110" selected="true">110</option>
                                                <?php }else {?>
                                                <option value="110">110</option>
                                                <?php } ?>
                                                <?php if($puntosDigitados->getestudios()=='120') { ?>
                                                <option value="120" selected="true">120</option>
                                                <?php }else {?>
                                                <option value="120">120</option>
                                                <?php } ?>
                                                <?php if($puntosDigitados->getestudios()=='130') { ?>
                                                <option value="130" selected="true">130</option>
                                                <?php }else {?>
                                                <option value="130">130</option>
                                                <?php } ?>
                                                <?php if($puntosDigitados->getestudios()=='140') { ?>
                                                <option value="140" selected="true">140</option>
                                                <?php }else {?>
                                                <option value="140">140</option>
                                                <?php } ?>
                                                <?php if($puntosDigitados->getestudios()=='150') { ?>
                                                <option value="150" selected="true">150</option>
                                                <?php }else {?>
                                                <option value="150">150</option>
                                                <?php } ?>
                                                <?php if($puntosDigitados->getestudios()=='160') { ?>
                                                <option value="160" selected="true">160</option>
                                                <?php }else {?>
                                                <option value="160">160</option>
                                                <?php } ?>
                                                <?php if($puntosDigitados->getestudios()=='170') { ?>
                                                <option value="170" selected="true">170</option>
                                                <?php }else {?>
                                                <option value="170">170</option>
                                                <?php } ?>
                                                <?php if($puntosDigitados->getestudios()=='180') { ?>
                                                <option value="180" selected="true">180</option>
                                                <?php }else {?>
                                                <option value="180">180</option>
                                                <?php } ?>
                                                <?php if($puntosDigitados->getestudios()=='190') { ?>
                                                <option value="190" selected="true">190</option>
                                                <?php }else {?>
                                                <option value="190">190</option>
                                                <?php } ?>
                                                <?php if($puntosDigitados->getestudios()=='200') { ?>
                                                <option value="200" selected="true">200</option>
                                                <?php }else {?>
                                                <option value="200">200</option>
                                                <?php } ?>
                                                <?php if($puntosDigitados->getestudios()=='210') { ?>
                                                <option value="210" selected="true">210</option>
                                                <?php }else {?>
                                                <option value="210">210</option>
                                                <?php } ?>
                                                <?php if($puntosDigitados->getestudios()=='220') { ?>
                                                <option value="220" selected="true">220</option>
                                                <?php }else {?>
                                                <option value="220">220</option>
                                                <?php } ?>
                                                <?php if($puntosDigitados->getestudios()=='230') { ?>
                                                <option value="230" selected="true">230</option>
                                                <?php }else {?>
                                                <option value="230">230</option>
                                                <?php } ?>
                                                <?php if($puntosDigitados->getestudios()=='240') { ?>
                                                <option value="240" selected="true">240</option>
                                                <?php }else {?>
                                                <option value="240">240</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-xs-5">
                                            <label for="">Comentario</label>
                                            <textarea id="comentarioEstudios" name="comentarioEstudios" class="form-control"><?php echo $puntosDigitados->getcomentarioestudio() ?></textarea>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    Experiencia Calificada
                                </div>
                                <div class="panel-body">
                                    <div class="content">
                                        <div class="container-fluid">
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <table class="table table-bordered">	
                                                    <thead>	
                                                        <tr class="info">
                                                            <th>Tipo Experiencia</th>
                                                            <th>Entidad</th>
                                                            <th>Fecha Inicio</th>
                                                            <th>Fecha Fin</th>
                                                            <th>Sugerido</th>
                                                            <th>UPC</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($experienciaAdm as $arregloExp) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $arregloExp[0] ?></td>
                                                                <td><?php echo $arregloExp[1] ?></td>
                                                                <td><?php echo $arregloExp[3] ?></td>
                                                                <td><?php echo $arregloExp[4] ?></td>
                                                                <?php
                                                                $exp = $arregloExp[6];
                                                                $exp = $exp/365;
                                                               
    if ($arregloExp[0] == 'EXPERIENCIA PROFESIONAL') {
         $exp = round($exp * 2,1);
         $puntosExperiencia = $puntosExperiencia + $exp;
        echo '<td>'.$exp.'</td>';
    } else {
        if ($arregloExp[0] == 'DOCENTE CATEDRATICO') {
            $exp = round($exp * 1,1);
            $puntosExperiencia = $puntosExperiencia + $exp;
        echo '<td>'.$exp.'</td>';
        } else {
            if ($arregloExp[0] == 'DOCENTE TIEMPO COMPLETO') {
            $exp = round($exp * 4,1);
            $puntosExperiencia = $puntosExperiencia + $exp;
        echo '<td>'.$exp.'</td>';
        } else {
            if ($arregloExp[0] == 'DOCENTE MEDIO TIEMPO') {
            $exp = round($exp * 2,1);
            $puntosExperiencia = $puntosExperiencia + $exp;
        echo '<td>'.$exp.'</td>';
        } else {
        echo '<td>/td>';
        }
        }
        }
    }
    ?>
                                                                <?php $urlVer = "VerAdjuntoAdm.php?id=" . $arregloExp[5] . "&tipo=6"; ?>
                                                            <td><?php echo $arregloExp[7] ?></td>
                                                                <td>
                                                                    <?php 
                                                                    if (file_exists("../Soportes/exp".$arregloExp[5].".pdf")) {
                                                                    ?>
                                                                <a data-toggle="tooltip" title="Adjunto" href="<?php echo $urlVer; ?>" target="_blank"><i class="pe-7s-credit"></i> Ver Adjunto</a>
                                                                <?php 
                                                                }else {
                                                                    ?>
                                                                No tiene Adjunto
                                                                <?php 
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
                                        <div class="row">
                                        <div class="col-xs-3">
                                            <label for="">Puntos Sugeridos por experiencia</label>
                                            <input type="text" size="4" disabled="true" id="experiencia" value="<?php echo $puntosExperiencia ?>" name="experiencia" class="form-control"/>
                                        </div>
                                        <div class="col-xs-4">
                                            <label for="">Total Puntos Confirmados por experiencia</label>
                                            <input value="<?php echo $puntosDigitados->getexperiencia() ?>" type="text" size="4" id="puntosexperiencia" name="puntosexperiencia" class="form-control" required="true"/>
                                        </div>
                                        <div class="col-xs-5">
                                            <label for="">Comentario</label>
                                            <textarea id="comentarioExperiencia" name="comentarioExperiencia" class="form-control"><?php echo $puntosDigitados->getcomentarioexperiencia() ?></textarea>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    Investigación
                                </div>
                                <div class="panel-body">
                                    <div class="content">
                                        <div class="container-fluid">
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <table class="table table-bordered">	
                                                    <thead>	
                                                        <tr class="info">
                                                            <th>Grupo</th>
                                                            <th>Clasificación</th>
                                                            <th>Puntaje Sugerido</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($grupo as $arregloInv) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $arregloInv[1] ?></td>
                                                                <td><?php echo $arregloInv[0] ?></td>
                                                                <?php
                                                               
    if ($arregloInv[0] == 'A1') {
        $puntosInvestigacion = $puntosInvestigacion + 20;
        echo '<td>20</td>';
    } else {
        if ($arregloInv[0] == 'A') {
            $puntosInvestigacion = $puntosInvestigacion + 15;
        echo '<td>15</td>';
        } else {
            if ($arregloInv[0] == 'B') {
                $puntosInvestigacion = $puntosInvestigacion + 12;
                echo '<td>12</td>';
        } else {
            if ($arregloInv[0] == 'C') {
                $puntosInvestigacion = $puntosInvestigacion + 10;
                echo '<td>10</td>';
        } else {
            if ($arregloInv[0] == 'RC') {
                $puntosInvestigacion = $puntosInvestigacion + 6;
                echo '<td>6</td>';
        } else {
            echo '<td></td>';
        }
        }
        }
        }
    }
    ?>
                                                                <?php $urlVer = "VerAdjuntoAdm.php?id=" . $arregloInv[3] . "&tipo=7"; ?>
                                                            <td>
                                                                <?php 
                                                                    if (file_exists("../Soportes/gru".$arregloInv[3].".pdf")) {
                                                                    ?>
                                                                <a data-toggle="tooltip" title="Adjunto" href="<?php echo $urlVer; ?>" target="_blank"><i class="pe-7s-credit"></i> Ver Adjunto</a>
                                                                <?php 
                                                                }else {
                                                                    ?>
                                                                No tiene Adjunto
                                                                <?php 
                                                                }
                                                                ?>
                                                            </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                            <?php
                                                        foreach ($invest as $arregloI) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $arregloI[1] ?></td>
                                                                <td><?php echo $arregloI[0] ?></td>
                                                                <?php
                                                               
    if ($arregloI[0] == 'INVESTIGADOR ASOCIADO') {
        $puntosInvestigacion = $puntosInvestigacion + 5;
        echo '<td>5</td>';
    } else {
        if ($arregloI[0] == 'INVESTIGADOR SENIOR') {
            $puntosInvestigacion = $puntosInvestigacion + 10;
        echo '<td>10</td>';
        } else {
            if ($arregloI[0] == 'INVESTIGADOR JUNIOR') {
                $puntosInvestigacion = $puntosInvestigacion + 3;
                echo '<td>3</td>';
        } else {
            echo '<td></td>';
        }
        }
    }
    ?>
                                                                <?php $urlVer = "VerAdjuntoAdm.php?id=" . $arregloI[3] . "&tipo=7"; ?>
                                                            <td>
                                                                <?php 
                                                                    if (file_exists("../Soportes/gru".$arregloI[3].".pdf")) {
                                                                    ?>
                                                                <a data-toggle="tooltip" title="Adjunto" href="<?php echo $urlVer; ?>" target="_blank"><i class="pe-7s-credit"></i> Ver Adjunto</a>
                                                                <?php 
                                                                }else {
                                                                    ?>
                                                                No tiene Adjunto
                                                                <?php 
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
                                        <div class="row">
                                        <div class="col-xs-3">
                                            <label for="">Puntos Sugeridos por invest.</label>
                                            <input type="text" size="4" id="categoria" disabled="true" value="<?php echo $puntosInvestigacion ?>" name="categoria" class="form-control"/>
                                        </div>
                                        <div class="col-xs-4">
                                            <label for="">Total Puntos Confirmados por investigaciones</label>
                                            <input value="<?php echo $puntosDigitados->getinvestigacion() ?>" type="text" size="4" id="puntosinvestigaciones" name="puntosinvestigaciones" class="form-control" required="true"/>
                                        </div>
                                        <div class="col-xs-5">
                                            <label for="">Comentario</label>
                                            <textarea id="comentarioInvestigaciones" name="comentarioInvestigaciones" class="form-control"><?php echo $puntosDigitados->getcomentarioinvestigacion() ?></textarea>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    Publicaciones
                                </div>
                                <div class="panel-body">
                                    <div class="content">
                                        <div class="container-fluid">
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <table class="table table-bordered">	
                                                    <thead>	
                                                        <tr class="info">
                                                            <th>Tipo</th>
                                                            <th>Titulo</th>
                                                            <th>Puntaje Sugerido</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($articulos as $arregloArt) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $arregloArt[0] ?></td>
                                                                <td><?php echo $arregloArt[1] ?></td>
                                                                <?php
                                                               
    if ($arregloArt[4] == 'A1') {
        $puntosPublicaciones = $puntosPublicaciones + 10;
        echo '<td>10</td>';
    } else {
        if ($arregloArt[4] == 'A2') {
            $puntosPublicaciones = $puntosPublicaciones + 10;
        echo '<td>10</td>';
        } else {
            if ($arregloArt[4] == 'B1') {
                $puntosPublicaciones = $puntosPublicaciones + 10;
                echo '<td>10</td>';
        } else {
            if ($arregloArt[4] == 'C1') {
                $puntosPublicaciones = $puntosPublicaciones + 10;
                echo '<td>10</td>';
        } else {
            if ($arregloArt[4] == 'D1') {
                $puntosPublicaciones = $puntosPublicaciones + 5;
                echo '<td>5</td>';
        } else {
            echo '<td></td>';
        }
        }
        }
        }
    }
    
    ?>
                                                                <?php $urlVer = "VerAdjuntoAdm.php?id=" . $arregloArt[3] . "&tipo=8"; ?>
                                                            <td>
                                                                <?php 
                                                                    if (file_exists("../Soportes/art".$arregloArt[3].".pdf")) {
                                                                    ?>
                                                                <a data-toggle="tooltip" title="Adjunto" href="<?php echo $urlVer; ?>" target="_blank"><i class="pe-7s-credit"></i> Ver Adjunto</a>
                                                                <?php 
                                                                }else {
                                                                    ?>
                                                                No tiene Adjunto
                                                                <?php 
                                                                }
                                                                ?>
                                                            </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                            <?php
                                                        foreach ($libros as $arregloLib) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $arregloLib[0] ?></td>
                                                                <td><?php echo $arregloLib[1] ?></td>
                                                                <?php
                                                               
    if ($arregloLib[4] == '1') {
        $puntosPublicaciones = $puntosPublicaciones + 20;
        echo '<td>20</td>';
    } else {
        if ($arregloLib[4] == '2') {
            $puntosPublicaciones = $puntosPublicaciones + 5;
        echo '<td>5</td>';
        } else {
            if ($arregloLib[4] == '3') {
                $puntosPublicaciones = $puntosPublicaciones + 10;
                echo '<td>10</td>';
        } else {
            echo '<td></td>';
        }
        }
    }
    
    ?>
                                                                <?php $urlVer = "VerAdjuntoAdm.php?id=" . $arregloLib[3] . "&tipo=9"; ?>
                                                            <td>
                                                                <?php 
                                                                    if (file_exists("../Soportes/lib".$arregloLib[3].".pdf")) {
                                                                    ?>
                                                                <a data-toggle="tooltip" title="Adjunto" href="<?php echo $urlVer; ?>" target="_blank"><i class="pe-7s-credit"></i> Ver Adjunto</a>
                                                                <?php 
                                                                }else {
                                                                    ?>
                                                                No tiene Adjunto
                                                                <?php 
                                                                }
                                                                ?>
                                                            </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                            <?php
                                                        foreach ($software as $arregloSof) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $arregloSof[0] ?></td>
                                                                <td><?php echo $arregloSof[1] ?></td>
                                                                <?php
                                                                $puntosPublicaciones = $puntosPublicaciones + 20;
            echo '<td>20</td>';
   
    ?>
                                                                <?php $urlVer = "VerAdjuntoAdm.php?id=" . $arregloSof[3] . "&tipo=10"; ?>
                                                            <td>
                                                                <?php 
                                                                    if (file_exists("../Soportes/sof".$arregloSof[3].".pdf")) {
                                                                    ?>
                                                                <a data-toggle="tooltip" title="Adjunto" href="<?php echo $urlVer; ?>" target="_blank"><i class="pe-7s-credit"></i> Ver Adjunto</a>
                                                                <?php 
                                                                }else {
                                                                    ?>
                                                                No tiene Adjunto
                                                                <?php 
                                                                }
                                                                ?>
                                                            </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>

                                                           <?php
                                                        foreach ($patentes as $arregloPat) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $arregloPat[0] ?></td>
                                                                <td><?php echo $arregloPat[1] ?></td>
                                                                <?php
                                                                $puntosPublicaciones = $puntosPublicaciones + 10;
            echo '<td>60</td>';
    
    ?>
                                                                <?php $urlVer = "VerAdjuntoAdm.php?id=" . $arregloPat[3] . "&tipo=11"; ?>
                                                            <td>
                                                                <?php 
                                                                    if (file_exists("../Soportes/pat".$arregloPat[3].".pdf")) {
                                                                    ?>
                                                                <a data-toggle="tooltip" title="Adjunto" href="<?php echo $urlVer; ?>" target="_blank"><i class="pe-7s-credit"></i> Ver Adjunto</a>
                                                                <?php 
                                                                }else {
                                                                    ?>
                                                                No tiene Adjunto
                                                                <?php 
                                                                }
                                                                ?>
                                                            </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                            <?php
                                                        foreach ($monografias as $arregloMon) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $arregloMon[0] ?></td>
                                                                <td><?php echo $arregloMon[1] ?></td>
                                                                <?php
    if ($arregloMon[4] == '4') {
        $puntosPublicaciones = $puntosPublicaciones + 5;
        echo '<td>5</td>';
    } else {
        if ($arregloMon[4] == '5') {
            $puntosPublicaciones = $puntosPublicaciones + 2;
        echo '<td>2</td>';
        } else {
            echo '<td></td>';
        }
    }
   
    ?>
                                                                <?php $urlVer = "VerAdjuntoAdm.php?id=" . $arregloMon[3] . "&tipo=12"; ?>
                                                            <td>
                                                                <?php 
                                                                    if (file_exists("../Soportes/mon".$arregloMon[3].".pdf")) {
                                                                    ?>
                                                                <a data-toggle="tooltip" title="Adjunto" href="<?php echo $urlVer; ?>" target="_blank"><i class="pe-7s-credit"></i> Ver Adjunto</a>
                                                                <?php 
                                                                }else {
                                                                    ?>
                                                                No tiene Adjunto
                                                                <?php 
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
                                        <div class="row">
                                        <div class="col-xs-3">
                                            <label for="">Puntos Sugeridos por producción</label>
                                            <input type="text" size="4" id="produccion" disabled="true" value="<?php echo $puntosPublicaciones ?>" name="produccion" class="form-control"/>
                                        </div>
                                        <div class="col-xs-4">
                                            <label for="">Total Puntos Confirmados por producción</label>
                                            <input value="<?php echo $puntosDigitados->getpublicaciones() ?>" type="text" size="4" id="puntosproduccion" name="puntosproduccion" class="form-control" required="true"/>
                                        </div>
                                        <div class="col-xs-5">
                                            <label for="">Comentario</label>
                                            <textarea id="comentarioProduccion" name="comentarioProduccion" class="form-control"><?php echo $puntosDigitados->getcomentariopublicaciones() ?></textarea>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                                                    <i class="pe-7s-diskette"></i> Guardar Puntajes
                                                                </button>
                                                            </center>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                </div>
            </div>
            </form>
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

<?php
require_once '../Tablero/vo/UsuarioVO.php';
require_once '../Tablero/vo/CalificacionVO.php';

session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: AccesoNoautorizado.html');
}
require_once("../Tablero/clases/Estudios.php");
require_once("../Tablero/clases/Docente.php");
require_once("../Tablero/clases/Programas.php");
require_once("../Tablero/clases/Experiencias.php");
require_once("../Tablero/clases/Producciones.php");
$usuario = $_SESSION['usuario'];
$uAdmin = $_SESSION['administrar'];
$nombreUsuario = $usuario->getName();
$programa = $usuario->getlastName();
$idAdmin = $usuario->getIdentidad();

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
$categoria = $datos->getCategoria();
$cualitativa = $datos->getCualitativa();
$comentario = $datos->getComentario();

$programas = new Programas();
$programaLista = $programas->getProgramaUsuarioPerfil($usuario);

$e = new Experiencias();
$experienciaAdm = $e->getExperienciaAdm($usuario);

$produccion = new Producciones();
$grupo = $produccion->getGrupoAdm($usuario);
$invest = $produccion->getGrupoAdmInv($usuario);
$articulos = $produccion->getArticulosAdm($usuario);
$libros = $produccion->getLibrosAdm($usuario);
$monografias = $produccion->getMonografiasAdm($usuario);
$patentes = $produccion->getPatentes($usuario);
$software = $produccion->getSoftware($usuario);

$nombre = $datos->getApellidos() . ' ' . $datos->getNombres();
if (isset($_POST["puntoscategoria"])) {
    $docente = new Docente();
    $docente->insertarCalificacion($usuario->getId(), $nombre, $programa, $nombreUsuario, $idAdmin);
}
$page = 10;
$url = "includes/".$usuario->getTipo().".php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="../Tablero/assets/img/favicon.ico">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>Administración Inscripción Docente Unicesar</title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        <link href="../Tablero/assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="../Tablero/assets/css/animate.min.css" rel="stylesheet"/>
        <link href="../Tablero/assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>
        <link href="../Tablero/assets/css/demo.css" rel="stylesheet" />
        <link href="../Tablero/assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
        <link href="../Tablero/assets/css/local.css" rel="stylesheet" />
    </head>
    <body>
        <div class="wrapper">
            <div class="sidebar" data-color="green" data-image="../Tablero/assets/img/sidebar-5.jpg">
                <div class="sidebar-wrapper">
                    <div class="logo">
                        <a href="#" class="simple-text">
                            Consulta de Docentes Inscritos
                        </a>
                    </div>
                    <?php include($url); ?>
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
                                <img class="img-responsive" alt="UPC" src="../images/titulo.png">
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
                                <?php echo $nombreUsuario; ?>
                            </h5>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        Datos del Docente consultado
                                    </div>
                                    <div class="panel-body">
                                        <div class="content">
                                            <div class="container-fluid">
                                                <div class="col-xs-12">
                                                    <table class="table table-bordered">	
                                                        <thead>	
                                                            <tr class="info">
                                                                <th>Docente</th>
                                                                <th>Contacto</th>
                                                                <th>Correo Electrónico</th>
                                                            </tr>
                                                            <tr>
                                                                <td><?php echo $datos->getApellidos() . ' ' . $datos->getNombres() ?></td>
                                                                <td><?php echo $datos->getCelular() ?></td>
                                                                <td><?php echo $datos->getEmail() ?></td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
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
                                                                echo '<tr><td>'.$arreglo[0].'</td><td>'.$arreglo[1].'</td><td>'.$arreglo[2].'</td></tr>';
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                    <table class="table table-bordered">	
                                                        <thead>	
                                                            <tr class="info">
                                                                <th>Categoria Docente</th>
                                                                <th>Calificación</th>
                                                                <th>Comentario</th>
                                                                <th>Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><?php echo $categoria ?></td>
                                                                <td><?php echo $cualitativa ?></td>
                                                                <?php
                                                                echo '<td><textarea class="form-control" id="comentarioCategoria" name="comentarioCategoria">' . $comentario . '</textarea></td>';
                                                                ?>
                                                                <?php $urlVer = "VerAdjuntoAdm.php?id=" . $id . "&tipo=5"; ?>
                                                                <td>
                                                                    <?php
                                                                    if (file_exists("../Soportes/hvd" . $id . ".pdf")) {
                                                                        ?>
                                                                        <a data-toggle="tooltip" title="Adjunto" href="<?php echo $urlVer; ?>" target="_blank"><i class="pe-7s-credit"></i> Ver Adjunto</a>
                                                                        <?php
                                                                    } else {
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
                                                            <th>Califición</th>
                                                            <th>Comentario</th>
                                                            <th>Acciones</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $numeroPregrado = 0;
                                                        foreach ($pregrado as $arregloPregrado) {
                                                            $numeroPregrado = $numeroPregrado + 1;
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $arregloPregrado[0] ?></td>
                                                                <td><?php echo $arregloPregrado[1] ?></td>
                                                                <td><?php echo $arregloPregrado[2] ?></td>
                                                                <?php
                                                                echo '<td>'.$arregloPregrado[4].'</td>';
                                                                echo '<td><textarea class="form-control" id="comentarioPre' . $numeroPregrado . '" name="comentarioPre' . $numeroPregrado . '">' . $arregloPregrado[5] . '</textarea></td>';
                                                                echo '<input id="numeroPre' . $numeroPregrado . '" name="numeroPre' . $numeroPregrado . '" type="hidden" value="' . $arregloPregrado[3] . '">';
                                                                ?>
                                                                <?php $urlVer = "VerAdjuntoAdm.php?id=" . $arregloPregrado[3] . "&tipo=1"; ?>
                                                                <td>
                                                                    <?php
                                                                    if (file_exists("../Soportes/ep" . $arregloPregrado[3] . ".pdf")) {
                                                                        ?>
                                                                        <a data-toggle="tooltip" title="Adjunto" href="<?php echo $urlVer; ?>" target="_blank"><i class="pe-7s-credit"></i> Ver Adjunto</a>
                                                                        <?php
                                                                    } else {
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
                                                    <input id="cantidadPre" name="cantidadPre" type="hidden" value="<?php echo $numeroPregrado ?>">
                                                    <?php
                                                    $numeroEspecializacion = 0;
                                                    foreach ($especializacionEsp as $arregloEspecializacionEsp) {
                                                        $numeroEspecializacion = $numeroEspecializacion + 1;
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $arregloEspecializacionEsp[0] ?></td>
                                                            <td><?php echo $arregloEspecializacionEsp[1] ?></td>
                                                            <td><?php echo $arregloEspecializacionEsp[2] ?></td>
                                                            <?php
                                                            echo '<td>'.$arregloEspecializacionEsp[4].'</td>';
                                                            echo '<td><textarea class="form-control" id="comentarioEspM' . $numeroEspecializacion . '" name="comentarioEspM' . $numeroEspecializacion . '">' . $arregloEspecializacionEsp[5] . '</textarea></td>';
                                                            echo '<input id="numeroEspM' . $numeroEspecializacion . '" name="numeroEspM' . $numeroEspecializacion . '" type="hidden" value="' . $arregloEspecializacionEsp[3] . '">';
                                                            ?>
                                                            <?php $urlVer = "VerAdjuntoAdm.php?id=" . $arregloEspecializacionEsp[3] . "&tipo=2"; ?>
                                                            <td>
                                                                <?php
                                                                if (file_exists("../Soportes/ee" . $arregloEspecializacionEsp[3] . ".pdf")) {
                                                                    ?>
                                                                    <a data-toggle="tooltip" title="Ver información" href="<?php echo $urlVer; ?>" target="_blank"><i class="pe-7s-credit"></i> Ver Adjunto</a>
                                                                    <?php
                                                                } else {
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
                                                    <input id="cantidadEspM" name="cantidadEspM" type="hidden" value="<?php echo $numeroEspecializacion ?>">
                                                    <?php
                                                    $numeroEspecializacion = 0;
                                                    foreach ($especializacion as $arregloEspecializacion) {
                                                        $numeroEspecializacion = $numeroEspecializacion + 1;
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $arregloEspecializacion[0] ?></td>
                                                            <td><?php echo $arregloEspecializacion[1] ?></td>
                                                            <td><?php echo $arregloEspecializacion[2] ?></td>
                                                            <?php
                                                            echo '<td>'.$arregloEspecializacion[4].'</td>';
                                                            echo '<td><textarea class="form-control" id="comentarioEsp' . $numeroEspecializacion . '" name="comentarioEsp' . $numeroEspecializacion . '">' . $arregloEspecializacion[5] . '</textarea></td>';
                                                            echo '<input id="numeroEsp' . $numeroEspecializacion . '" name="numeroEsp' . $numeroEspecializacion . '" type="hidden" value="' . $arregloEspecializacion[3] . '">';
                                                            ?>
                                                            <?php $urlVer = "VerAdjuntoAdm.php?id=" . $arregloEspecializacion[3] . "&tipo=2"; ?>
                                                            <td>
                                                                <?php
                                                                if (file_exists("../Soportes/ee" . $arregloEspecializacion[3] . ".pdf")) {
                                                                    ?>
                                                                    <a data-toggle="tooltip" title="Ver información" href="<?php echo $urlVer; ?>" target="_blank"><i class="pe-7s-credit"></i> Ver Adjunto</a>
                                                                    <?php
                                                                } else {
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
                                                    <input id="cantidadEsp" name="cantidadEsp" type="hidden" value="<?php echo $numeroEspecializacion ?>">
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
                                                            echo '<td>'.$arregloMaestria[4].'</td>';
                                                            echo '<td><textarea class="form-control" id="comentarioMae' . $numeroMaestrias . '" name="comentarioMae' . $numeroMaestrias . '">' . $arregloMaestria[5] . '</textarea></td>';
                                                            echo '<input id="numeroMae' . $numeroMaestrias . '" name="numeroMae' . $numeroMaestrias . '" type="hidden" value="' . $arregloMaestria[3] . '">';
                                                            ?>
                                                            <?php $urlVer = "VerAdjuntoAdm.php?id=" . $arregloMaestria[3] . "&tipo=3"; ?>
                                                            <td>
                                                                <?php
                                                                if (file_exists("../Soportes/em" . $arregloMaestria[3] . ".pdf")) {
                                                                    ?>
                                                                    <a data-toggle="tooltip" title="Ver información" href="<?php echo $urlVer; ?>" target="_blank"><i class="pe-7s-credit"></i> Ver Adjunto</a>
                                                                    <?php
                                                                } else {
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
                                                    <input id="cantidadMae" name="cantidadMae" type="hidden" value="<?php echo $numeroMaestrias ?>">
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
                                                            echo '<td>'.$arregloDoctorado[4].'</td>';
                                                            echo '<td><textarea class="form-control" id="comentarioDoc' . $numeroDoctorados . '" name="comentarioDoc' . $numeroDoctorados . '">' . $arregloDoctorado[5] . '</textarea></td>';
                                                            echo '<input id="numeroDoc' . $numeroDoctorados . '" name="numeroDoc' . $numeroDoctorados . '" type="hidden" value="' . $arregloDoctorado[3] . '">';
                                                            ?>
                                                            <?php $urlVer = "VerAdjuntoAdm.php?id=" . $arregloDoctorado[3] . "&tipo=4"; ?>
                                                            <td>
                                                                <?php
                                                                if (file_exists("../Soportes/ed" . $arregloDoctorado[3] . ".pdf")) {
                                                                    ?>
                                                                    <a data-toggle="tooltip" title="Ver información" href="<?php echo $urlVer; ?>" target="_blank"><i class="pe-7s-credit"></i> Ver Adjunto</a>
                                                                    <?php
                                                                } else {
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
                                                    <input id="cantidadDoc" name="cantidadDoc" type="hidden" value="<?php echo $numeroDoctorados ?>">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
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
                                                                <th>Calificación</th>
                                                                <th>Comentario</th>
                                                                <th>UPC</th>
                                                                <th>Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $numeroExp = 0;
                                                            foreach ($experienciaAdm as $arregloExp) {
                                                                $numeroExp = $numeroExp + 1;
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $arregloExp[0] ?></td>
                                                                    <td><?php echo $arregloExp[1] ?></td>
                                                                    <td><?php echo $arregloExp[3] ?></td>
                                                                    <td><?php echo $arregloExp[4] ?></td>
                                                                    <?php
                                                                    echo '<td>'.$arregloExp[8].'</td>';
                                                                    echo '<td><textarea class="form-control" id="comentarioExp' . $numeroExp . '" name="comentarioExp' . $numeroExp . '">' . $arregloExp[9] . '</textarea></td>';
                                                                    echo '<input id="numeroExp' . $numeroExp . '" name="numeroExp' . $numeroExp . '" type="hidden" value="' . $arregloExp[5] . '">';
                                                                    ?>
                                                                    <?php $urlVer = "VerAdjuntoAdm.php?id=" . $arregloExp[5] . "&tipo=6"; ?>
                                                                    <td><?php echo $arregloExp[7] ?></td>
                                                                    <td>
                                                                        <?php
                                                                        if (file_exists("../Soportes/exp" . $arregloExp[5] . ".pdf")) {
                                                                            ?>
                                                                            <a data-toggle="tooltip" title="Adjunto" href="<?php echo $urlVer; ?>" target="_blank"><i class="pe-7s-credit"></i> Ver Adjunto</a>
                                                                            <?php
                                                                        } else {
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
                                                        <input id="cantidadExp" name="cantidadExp" type="hidden" value="<?php echo $numeroExp ?>">
                                                        </tbody>
                                                    </table>
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
                                                                <th>Calificación</th>
                                                                <th>Comentario</th>
                                                                <th>Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $numeroGru = 0;
                                                            foreach ($grupo as $arregloInv) {
                                                                $numeroGru = $numeroGru + 1;
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $arregloInv[1] ?></td>
                                                                    <td><?php echo $arregloInv[0] ?></td>
                                                                    <?php
                                                                    echo '<td>'.$arregloInv[4].'</td>';
                                                                    echo '<td><textarea class="form-control" id="comentarioGru' . $numeroGru . '" name="comentarioGru' . $numeroGru . '">' . $arregloInv[5] . '</textarea></td>';
                                                                    echo '<input id="numeroGru' . $numeroGru . '" name="numeroGru' . $numeroGru . '" type="hidden" value="' . $arregloInv[3] . '">';
                                                                    ?>
                                                                    <?php $urlVer = "VerAdjuntoAdm.php?id=" . $arregloInv[3] . "&tipo=7"; ?>
                                                                    <td>
                                                                        <?php
                                                                        if (file_exists("../Soportes/gru" . $arregloInv[3] . ".pdf")) {
                                                                            ?>
                                                                            <a data-toggle="tooltip" title="Adjunto" href="<?php echo $urlVer; ?>" target="_blank"><i class="pe-7s-credit"></i> Ver Adjunto</a>
                                                                            <?php
                                                                        } else {
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
                                                        <input id="cantidadGru" name="cantidadGru" type="hidden" value="<?php echo $numeroGru ?>">
                                                        <?php
                                                        $numeroInv = 0;
                                                        foreach ($invest as $arregloI) {
                                                            $numeroInv = $numeroInv + 1;
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $arregloI[1] ?></td>
                                                                <td><?php echo $arregloI[0] ?></td>
                                                                <?php
                                                                echo '<td>'.$arregloI[4].'</td>';
                                                                echo '<td><textarea class="form-control" id="comentarioInv' . $numeroInv . '" name="comentarioInv' . $numeroInv . '">' . $arregloI[5] . '</textarea></td>';
                                                                echo '<input id="numeroInv' . $numeroInv . '" name="numeroInv' . $numeroInv . '" type="hidden" value="' . $arregloI[3] . '">';
                                                                ?>
                                                                <?php $urlVer = "VerAdjuntoAdm.php?id=" . $arregloI[3] . "&tipo=7"; ?>
                                                                <td>
                                                                    <?php
                                                                    if (file_exists("../Soportes/gru" . $arregloI[3] . ".pdf")) {
                                                                        ?>
                                                                        <a data-toggle="tooltip" title="Adjunto" href="<?php echo $urlVer; ?>" target="_blank"><i class="pe-7s-credit"></i> Ver Adjunto</a>
                                                                        <?php
                                                                    } else {
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
                                                        <input id="cantidadInv" name="cantidadInv" type="hidden" value="<?php echo $numeroInv ?>">
                                                        </tbody>
                                                    </table>
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
                                                                <th>Calificación</th>
                                                                <th>Comentario</th>
                                                                <th>Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $numeroArt = 0;
                                                            foreach ($articulos as $arregloArt) {
                                                                $numeroArt = $numeroArt + 1;
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $arregloArt[0] ?></td>
                                                                    <td><?php echo $arregloArt[1] ?></td>
                                                                    <?php
                                                                    echo '<td>'.$arregloArt[5].'</td>';
                                                                    echo '<td><textarea class="form-control" id="comentarioArt' . $numeroArt . '" name="comentarioArt' . $numeroArt . '">' . $arregloArt[6] . '</textarea></td>';
                                                                    echo '<input id="numeroArt' . $numeroArt . '" name="numeroArt' . $numeroArt . '" type="hidden" value="' . $arregloArt[3] . '">';
                                                                    ?>
                                                                    <?php $urlVer = "VerAdjuntoAdm.php?id=" . $arregloArt[3] . "&tipo=8"; ?>
                                                                    <td>
                                                                        <?php
                                                                        if (file_exists("../Soportes/art" . $arregloArt[3] . ".pdf")) {
                                                                            ?>
                                                                            <a data-toggle="tooltip" title="Adjunto" href="<?php echo $urlVer; ?>" target="_blank"><i class="pe-7s-credit"></i> Ver Adjunto</a>
                                                                            <?php
                                                                        } else {
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
                                                        <input id="cantidadArt" name="cantidadArt" type="hidden" value="<?php echo $numeroArt ?>">
                                                        <?php
                                                        $numeroLib = 0;
                                                        foreach ($libros as $arregloLib) {
                                                            $numeroLib = $numeroLib + 1;
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $arregloLib[0] ?></td>
                                                                <td><?php echo $arregloLib[1] ?></td>
                                                                <?php
                                                                
                                                                echo '<td>'.$arregloLib[5].'</td>';
                                                                echo '<td><textarea class="form-control" id="comentarioLib' . $numeroLib . '" name="comentarioLib' . $numeroLib . '">' . $arregloLib[6] . '</textarea></td>';
                                                                echo '<input id="numeroLib' . $numeroLib . '" name="numeroLib' . $numeroLib . '" type="hidden" value="' . $arregloLib[3] . '">';
                                                                ?>
                                                                <?php $urlVer = "VerAdjuntoAdm.php?id=" . $arregloLib[3] . "&tipo=9"; ?>
                                                                <td>
                                                                    <?php
                                                                    if (file_exists("../Soportes/lib" . $arregloLib[3] . ".pdf")) {
                                                                        ?>
                                                                        <a data-toggle="tooltip" title="Adjunto" href="<?php echo $urlVer; ?>" target="_blank"><i class="pe-7s-credit"></i> Ver Adjunto</a>
                                                                        <?php
                                                                    } else {
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
                                                        <input id="cantidadLib" name="cantidadLib" type="hidden" value="<?php echo $numeroLib ?>">
                                                        <?php
                                                        $numeroSof = 0;
                                                        foreach ($software as $arregloSof) {
                                                            $numeroSof = $numeroSof + 1;
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $arregloSof[0] ?></td>
                                                                <td><?php echo $arregloSof[1] ?></td>
                                                                <?php
                                                                echo '<td>'.$arregloSof[4].'</td>';
                                                                
                                                                echo '<td><textarea class="form-control" id="comentarioSof' . $numeroSof . '" name="comentarioSof' . $numeroSof . '">' . $arregloSof[5] . '</textarea></td>';
                                                                echo '<input id="numeroSof' . $numeroSof . '" name="numeroSof' . $numeroSof . '" type="hidden" value="' . $arregloSof[3] . '">';
                                                                ?>
                                                                <?php $urlVer = "VerAdjuntoAdm.php?id=" . $arregloSof[3] . "&tipo=10"; ?>
                                                                <td>
                                                                    <?php
                                                                    if (file_exists("../Soportes/sof" . $arregloSof[3] . ".pdf")) {
                                                                        ?>
                                                                        <a data-toggle="tooltip" title="Adjunto" href="<?php echo $urlVer; ?>" target="_blank"><i class="pe-7s-credit"></i> Ver Adjunto</a>
                                                                        <?php
                                                                    } else {
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
                                                        <input id="cantidadSof" name="cantidadSof" type="hidden" value="<?php echo $numeroSof ?>">
                                                        <?php
                                                        $numeroPat = 0;
                                                        foreach ($patentes as $arregloPat) {
                                                            $numeroPat = $numeroPat + 1;
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $arregloPat[0] ?></td>
                                                                <td><?php echo $arregloPat[1] ?></td>
                                                                <?php
                                                                echo '<td>'.$arregloPat[4].'</td>';
                                                                echo '<td><textarea class="form-control" id="comentarioPat' . $numeroPat . '" name="comentarioPat' . $numeroPat . '">' . $arregloPat[5] . '</textarea></td>';
                                                                echo '<input id="numeroPat' . $numeroPat . '" name="numeroPat' . $numeroPat . '" type="hidden" value="' . $arregloPat[3] . '">';
                                                                ?>
                                                                <?php $urlVer = "VerAdjuntoAdm.php?id=" . $arregloPat[3] . "&tipo=11"; ?>
                                                                <td>
                                                                    <?php
                                                                    if (file_exists("../Soportes/pat" . $arregloPat[3] . ".pdf")) {
                                                                        ?>
                                                                        <a data-toggle="tooltip" title="Adjunto" href="<?php echo $urlVer; ?>" target="_blank"><i class="pe-7s-credit"></i> Ver Adjunto</a>
                                                                        <?php
                                                                    } else {
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
                                                        <input id="cantidadPat" name="cantidadPat" type="hidden" value="<?php echo $numeroPat ?>">
                                                        <?php
                                                        $numeroMon = 0;
                                                        foreach ($monografias as $arregloMon) {
                                                            $numeroMon = $numeroMon + 1;
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $arregloMon[0] ?></td>
                                                                <td><?php echo $arregloMon[1] ?></td>
                                                                <?php
                                                                echo '<td>'.$arregloMon[5].'</td>';
                                                                echo '<td><textarea class="form-control" id="comentarioMon' . $numeroMon . '" name="comentarioMon' . $numeroMon . '">' . $arregloMon[6] . '</textarea></td>';
                                                                echo '<input id="numeroMon' . $numeroMon . '" name="numeroMon' . $numeroMon . '" type="hidden" value="' . $arregloMon[3] . '">';
                                                                ?>
                                                                <?php $urlVer = "VerAdjuntoAdm.php?id=" . $arregloMon[3] . "&tipo=12"; ?>
                                                                <td>
                                                                    <?php
                                                                    if (file_exists("../Soportes/mon" . $arregloMon[3] . ".pdf")) {
                                                                        ?>
                                                                        <a data-toggle="tooltip" title="Adjunto" href="<?php echo $urlVer; ?>" target="_blank"><i class="pe-7s-credit"></i> Ver Adjunto</a>
                                                                        <?php
                                                                    } else {
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
                                                        <input id="cantidadMon" name="cantidadMon" type="hidden" value="<?php echo $numeroMon ?>">
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
            </form>
        </div>
    </body>
    <script src="../Tablero/assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
    <script src='../Tablero/assets/js/jquery2.1.3sorter.js'></script>
    
    <script src="../Tablero/assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../Tablero/assets/js/chartist.min.js"></script>
    <script src="../Tablero/assets/js/bootstrap-notify.js"></script>
    <script src="../Tablero/assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>
    <script src="../Tablero/assets/js/demo.js"></script>
    <script>
        $(function () {
            $('#mi-tabla').tablesorter();
        });

        $(document).ready(function () {
            var consulta;
            $("#busqueda").focus();
            $("#busqueda").keyup(function (e) {
                consulta = $("#busqueda").val();
                $.ajax({
                    type: "POST",
                    url: "buscar.php",
                    data: "b=" + consulta,
                    dataType: "html",
                    beforeSend: function () {
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

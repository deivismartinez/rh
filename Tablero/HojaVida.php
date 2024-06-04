<?php
require_once("../Tablero/vo/UsuarioVO.php");
require_once("../Tablero/vo/DocenteVO.php");
session_start();
$usuario = $_SESSION['usuario'];
if (isset($usuario)) {
    require_once("clases/Docente.php");
    $d = new Docente();
    $docente = $d->getDatos($usuario->getId());
    $paises = $d->getPaises();
    require_once("clases/Estudios.php");
    $estudios = new Estudios();
    $pregrado = $estudios->getPregrados($usuario);
    $especializacion = $estudios->getEspecializaciones($usuario);
    $maestrias = $estudios->getMaestrias($usuario);
    $doctorados = $estudios->getDoctorados($usuario);
    $cursos = $estudios->getCursos($usuario);
    require_once("clases/Experiencias.php");
    $e = new Experiencias();
    $experiencia = $e->getExperiencia($usuario);
    require_once("clases/Producciones.php");
    $e = new Producciones();
    $articulos = $e->getArticulos($usuario);
    $videos = $e->getVideos($usuario);
    $libros = $e->getLibros($usuario);
    $premios = $e->getPremios($usuario);
    $patentes = $e->getPatentes($usuario);
    $obras = $e->getObras($usuario);
    $software = $e->getSoftware($usuario);
    $prodTecnica = $e->getProduccionesTecnicas($usuario);
    if (isset($_POST["nombreCompletoTxt"])) {
        $u = new Docente();
        $u->insertar($usuario->getId());
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
        <style>
            #centered {
                position: fixed;
                top: 10%;
                left: 2%;
                transform: translate(20%, -10%);
            }
        </style>

    </head>
    <body>
        <div class="main-panel">
            <div class="content">
                <div class="container-fluid">
                </div>
                <div class="row">
                    <div class="container">
                        <div class="col-xs-12">
                            <div class="col-xs-11">
                                <div class="panel panel-primary">
                                    <center>
                                        <h4 style="align-content: center">Hoja de Vida</h4>
                                    </center>
                                    <div class="panel-body">
                                        <form name="form" action="" method="post">
                                            <fieldset> 
                                                <table>
                                                    <tr>
                                                        <td width="50%">Nombre</td>
                                                        <td><?php echo $docente->getNombres() . " " . $docente->getApellidos() ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Número de documento</td>
                                                        <td><?php echo $docente->getNumeroDocumento() ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Email</td>
                                                        <td><?php echo $docente->getEmail() ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Estado Civil</td>
                                                        <td><?php echo $docente->getEstadoCivil() ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Genero</td>
                                                        <td><?php echo $docente->getGenero() ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pais</td>
                                                        <td><?php echo $docente->getPais() ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Departamento</td>
                                                        <td><?php echo $docente->getDepartamento() ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Municipio</td>
                                                        <td><?php echo $docente->getMunicipio() ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Dirección</td>
                                                        <td><?php echo $docente->getDireccion() ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Teléfono</td>
                                                        <td><?php echo $docente->getTelefono() ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Celular</td>
                                                        <td><?php echo $docente->getCelular() ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Sede de inscripción</td>
                                                        <td><?php echo $docente->getSede() ?></td>
                                                    </tr>
                                                </table>
                                            </fieldset>
                                            <fieldset>
                                                <h5>Formación Académica</h5>
                                                <div class="col-xs-12">
                                                    <table class="table table-bordered">	
                                                        <thead>	
                                                            <tr class="info">
                                                                <th>Título del estudio</th>
                                                                <th>Entidad que lo expide</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            foreach ($pregrado as $arregloPregrado) {
                                                                ?>
                                                                <tr>
                                                                    <td width="50%"><?php echo $arregloPregrado[1] ?></td>
                                                                    <td><?php echo $arregloPregrado[2] ?></td>
                                                                </tr>
                                                                <?php
                                                            }
                                                            foreach ($especializacion as $arregloEspecializacion) {
                                                                ?>
                                                                <tr>
                                                                    <td width="50%"><?php echo $arregloEspecializacion[1] ?></td>
                                                                    <td><?php echo $arregloEspecializacion[2] ?></td>
                                                                </tr>
                                                                <?php
                                                            }
                                                            foreach ($maestrias as $arregloMaestria) {
                                                                ?>
                                                                <tr>
                                                                    <td width="50%"><?php echo $arregloMaestria[1] ?></td>
                                                                    <td><?php echo $arregloMaestria[2] ?></td>
                                                                </tr>
                                                                <?php
                                                            }
                                                            foreach ($doctorados as $arregloDoctorado) {
                                                                ?>
                                                                <tr>
                                                                    <td width="50%"><?php echo $arregloDoctorado[1] ?></td>
                                                                    <td><?php echo $arregloDoctorado[2] ?></td>

                                                                </tr>
                                                                <?php
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <h5>Formación Complementaria</h5>
                                                <div class="col-xs-12">
                                                    <table class="table table-bordered">	
                                                        <thead>	
                                                            <tr class="info">
                                                                <th>Tipo de estudio</th>
                                                                <th>Título del estudio</th>
                                                                <th>Entidad que lo expide</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            foreach ($cursos as $arreglo) {
                                                                ?>
                                                                <tr>
                                                                    <td width="30%"><?php echo $arreglo[0] ?></td>
                                                                    <td width="40%"><?php echo $arreglo[1] ?></td>
                                                                    <td width="40%"><?php echo $arreglo[2] ?></td>
                                                                </tr>
                                                                <?php
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <h5>Experiencia Profesional</h5>
                                                <div class="col-xs-12">
                                        <table class="table table-bordered">	
                                            <thead>	
                                                <tr class="info">
                                                    <th>Tipo de Experiencia</th>
                                                    <th>Empresa/Institución</th>
                                                    <th>Cargo</th>
                                                    <th>Fecha de Inicio</th>
                                                    <th>Fecha de Retiro</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($experiencia as $arreglo) {
                                                    ?>
                                                    <tr>
                                                        <td width="30%"><?php echo $arreglo[0] ?></td>
                                                        <td width="30%"><?php echo $arreglo[1] ?></td>
                                                        <td width="20%"><?php echo $arreglo[2] ?></td>
                                                        <td width="10%"><?php echo $arreglo[3] ?></td>
                                                        <td width="10%"><?php echo $arreglo[4] ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                            </fieldset>
                                            <fieldset>
                                                <h5>Producción</h5>
                                                <div class="col-xs-12">
                                                <table class="table table-bordered">	
                                                    <thead>	
                                                        <tr class="info">
                                                            <th>Tipo de Producción</th>
                                                            <th>Titulo/Nombre de la producción</th>
                                                            <th>Fecha de Creación/Producción</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($articulos as $arreglo) {
                                                            ?>
                                                            <tr>
                                                                <td width="30%"><?php echo $arreglo[0] ?></td>
                                                                <td width="30%"><?php echo $arreglo[1] ?></td>
                                                                <td width="30%"><?php echo $arreglo[2] ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        foreach ($videos as $arregloVideos) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $arregloVideos[0] ?></td>
                                                                <td><?php echo $arregloVideos[1] ?></td>
                                                                <td><?php echo $arregloVideos[2] ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        foreach ($libros as $arregloLibros) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $arregloLibros[0] ?></td>
                                                                <td><?php echo $arregloLibros[1] ?></td>
                                                                <td><?php echo $arregloLibros[2] ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        foreach ($premios as $arregloPremios) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $arregloPremios[0] ?></td>
                                                                <td><?php echo $arregloPremios[1] ?></td>
                                                                <td><?php echo $arregloPremios[2] ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        foreach ($patentes as $arregloPatentes) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $arregloPatentes[0] ?></td>
                                                                <td><?php echo $arregloPatentes[1] ?></td>
                                                                <td><?php echo $arregloPatentes[2] ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        foreach ($obras as $arregloObras) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $arregloObras[0] ?></td>
                                                                <td><?php echo $arregloObras[1] ?></td>
                                                                <td><?php echo $arregloObras[2] ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        foreach ($software as $arregloSoftware) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $arregloSoftware[0] ?></td>
                                                                <td><?php echo $arregloSoftware[1] ?></td>
                                                                <td><?php echo $arregloSoftware[2] ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        foreach ($prodTecnica as $arregloProdTecnica) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $arregloProdTecnica[0] ?></td>
                                                                <td><?php echo $arregloProdTecnica[1] ?></td>
                                                                <td><?php echo $arregloProdTecnica[2] ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            </fieldset>
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
</html>

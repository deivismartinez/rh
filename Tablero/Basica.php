<?php
require_once("../Tablero/vo/UsuarioVO.php");
require_once("../Tablero/vo/DocenteVO.php");
//require_once("../Tablero/clases/Docente.php");
//require_once("../Tablero/vo/PeridoVO.php");
session_start();
$usuario = $_SESSION['usuario'];
$archivo = "hvd".$usuario->getId();
$_SESSION['id_usuario']=$usuario->getId();
require_once "../Tablero/clases/Periodo.php"; ////periodo
$p = new Perido();
if (isset($usuario)) {
    require_once("clases/Docente.php");
    require_once("clases/Periodo.php");////periodo
    $p= new Perido();
    $d = new Docente();
    $docente = $d->getDatos($usuario->getId());
    $paises = $d->getPaises();
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
                                                        <label for="">Seleccione su Disponibilidad</label>
                                                        <select required="true" class="form-control" id="disponibilidadCmb" name="disponibilidadCmb">
                                                            <option value="">SELECCIONE</option>
                                                            <?php if ($docente->getDisponibilidad() == 'CATEDRATICO') { ?>
                                                                <option value="CATEDRATICO" selected="true">CATEDRATICO</option>
                                                            <?php } else { ?>
                                                                <option value="CATEDRATICO">CATEDRATICO</option>
                                                            <?php } ?>
                                                            <?php if ($docente->getDisponibilidad() == 'MEDIO TIEMPO') { ?>
                                                                <option value="MEDIO TIEMPO" selected="true">MEDIO TIEMPO</option>
                                                            <?php } else { ?>
                                                                <option value="MEDIO TIEMPO">MEDIO TIEMPO</option>
                                                            <?php } ?>
                                                            <?php if ($docente->getDisponibilidad() == 'TIEMPO COMPLETO') { ?>
                                                                <option value="TIEMPO COMPLETO" selected="true">TIEMPO COMPLETO</option>
                                                            <?php } else { ?>
                                                                <option value="TIEMPO COMPLETO">TIEMPO COMPLETO</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <label for="">Seleccione su Situación Laboral</label>
                                                        <select required="true" class="form-control" id="situacionCmb" name="situacionCmb">
                                                            <option value="" selected="true">SELECCIONE</option>
                                                            <?php if ($docente->getSituacion() == 'PENSIONADO') { ?>
                                                                <option value="PENSIONADO" selected="true">PENSIONADO</option>
                                                            <?php } else { ?>
                                                                <option value="PENSIONADO">PENSIONADO</option>
                                                            <?php } ?>
                                                            <?php if ($docente->getSituacion() == 'EMPLEADO PUBLICO') { ?>
                                                                <option value="EMPLEADO PUBLICO" selected="true">EMPLEADO PUBLICO</option>
                                                            <?php } else { ?>
                                                                <option value="EMPLEADO PUBLICO">EMPLEADO PUBLICO</option>
                                                            <?php } ?>
                                                            <?php if ($docente->getSituacion() == 'OTRA') { ?>
                                                                <option value="OTRA" selected="true">OTRA</option>
                                                            <?php } else { ?>
                                                                <option value="OTRA">OTRA</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="col-xs-12">
                                                        <label for="">Describa su Disponibilidad</label>
                                                        <textarea required="true" name="descripcionDisponibilidadTxa" id="descripcionDisponibilidadTxa" class="form-control" placeholder="Ej: Tiempo completo, lunes en la mañana, martes de 6-10pm, miercoles en las tardes"><?php echo $docente->getDescripcion() ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="col-xs-6">
                                                        <label for="">Nombres completos  *</label>
                                                        <input value="<?php echo $docente->getNombres() ?>" required="true" type="text" class="form-control" name="nombreCompletoTxt" id="nombreCompletoTxt" placeholder="">
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <label for="">Apellidos completos  *</label>
                                                        <input value="<?php echo $docente->getApellidos() ?>" required="true" type="text" class="form-control" name="apellidoCompletoTxt" id="apellidoCompletoTxt" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="col-xs-6">
                                                        <label for="">Tipo de documento  *</label>
                                                        <select required="true" class="form-control" id="tipoDocumentoCmb" name="tipoDocumentoCmb">
                                                            <option value="">SELECCIONE</option>
                                                            <?php if ($docente->getTipoDocumento() == 'CC') { ?>
                                                                <option value="CC" selected="true">CEDULA DE CIUDADANIA</option>
                                                            <?php } else { ?>
                                                                <option value="CC">CEDULA DE CIUDADANIA</option>
                                                            <?php }if ($docente->getTipoDocumento() == 'TI') { ?>
                                                                <option value="TI" selected="true">TARJETA DE IDENTIDAD</option>
                                                            <?php } else { ?>
                                                                <option value="TI">TARJETA DE IDENTIDAD</option>
                                                            <?php }if ($docente->getTipoDocumento() == 'CE') { ?>
                                                                <option value="CE" selected="true">CEDULA DE EXTRANJERIA</option>
                                                            <?php } else { ?>
                                                                <option value="CE">CEDULA DE EXTRANJERIA</option>
                                                            <?php }if ($docente->getTipoDocumento() == 'PASAPORTE') { ?>
                                                                <option value="PASAPORTE" selected="true">PASAPORTE</option>
                                                            <?php } else { ?>
                                                                <option value="PASAPORTE">PASAPORTE</option>
                                                            <?php }if ($docente->getTipoDocumento() == 'RC') { ?>
                                                                <option value="RC" selected="true">REGISTRO CIVIL</option>
                                                            <?php } else { ?>
                                                                <option value="RC">REGISTRO CIVIL</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <label for="">Número de documento  *</label>
                                                        <input value="<?php echo $docente->getNumeroDocumento() ?>" required="true" type="text" class="form-control" name="numeroDocumentoTxt" id="numeroDocumentoTxt" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="col-xs-6">
                                                        <label for="">Email  *</label>
                                                        <input value="<?php echo $docente->getEmail() ?>" required="true" type="email" class="form-control" name="emailEml" id="emailEml" placeholder="">
                                                    </div>
                                                    <div class="col-xs-3">
                                                        <label for="">Estado Civil  *</label>
                                                        <select required="true" class="form-control" name="estadoCivilCmb" id="estadoCivilCmb">
                                                            <option value="">SELECCIONE</option>
                                                            <?php if ($docente->getEstadoCivil() == 'CASADO(A)') { ?>
                                                                <option value="CASADO(A)" selected="true">CASADO(A)</option>
                                                            <?php } else { ?>
                                                                <option value="CASADO(A)">CASADO(A)</option>
                                                            <?php }if ($docente->getEstadoCivil() == 'SOLTERO(A)') { ?>
                                                                <option value="SOLTERO(A)" selected="true">SOLTERO(A)</option>
                                                            <?php } else { ?>
                                                                <option value="SOLTERO(A)">SOLTERO(A)</option>
                                                            <?php }if ($docente->getEstadoCivil() == 'SEPARADO(A)') { ?>
                                                                <option value="SEPARADO(A)" selected="true">SEPARADO(A)</option>
                                                            <?php } else { ?>
                                                                <option value="SEPARADO(A)">SEPARADO(A)</option>
                                                            <?php }if ($docente->getEstadoCivil() == 'VIUDO(A)') { ?>
                                                                <option value="VIUDO(A)" selected="true">VIUDO(A)</option>
                                                            <?php } else { ?>
                                                                <option value="VIUDO(A)">VIUDO(A)</option>
                                                            <?php }if ($docente->getEstadoCivil() == 'UNION LIBRE') { ?>
                                                                <option value="UNION LIBRE" selected="true">UNION LIBRE</option>
                                                            <?php } else { ?>
                                                                <option value="UNION LIBRE">UNION LIBRE</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-xs-3">
                                                        <label for="">Genero  *</label>
                                                        <select required="true" class="form-control" name="generoCmb" id="generoCmb">
                                                            <option value="">SELECCIONE</option>
                                                            <?php if ($docente->getGenero() == 'MASCULINO') { ?>
                                                                <option value="MASCULINO" selected="true">MASCULINO</option>
                                                            <?php } else { ?>
                                                                <option value="MASCULINO">MASCULINO</option>
                                                            <?php }if ($docente->getGenero() == 'FEMENINO') { ?>
                                                                <option value="FEMENINO" selected="true">FEMENINO</option>
                                                            <?php } else { ?>
                                                                <option value="FEMENINO">FEMENINO</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="col-xs-3">
                                                        <label for="">Pais  *</label>
                                                        <select required="true" name="paisCmb" id="paisCmb" class="form-control" onchange="cargar()">
                                                            <?php
                                                            foreach ($paises as $arregloPaises) {
                                                                if ($arregloPaises[0] == $docente->getPais()) {
                                                                    echo '<OPTION value="' . $arregloPaises[0] . '" selected="true">' . $arregloPaises[1] . '</OPTION>';
                                                                } else {
                                                                    echo '<OPTION value="' . $arregloPaises[0] . '">' . $arregloPaises[1] . '</OPTION>';
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-xs-3">
                                                        <label for="">Departamento</label>
                                                        <div id="comboDepartamento">
                                                            <select required="true" name="departamentoCmb" id="departamentoCmb" class="form-control" onchange="cargarMunicipios(this.value)">
                                                                <?php
                                                                $departamentos = $d->getDepartamentos($docente->getPais());
                                                                foreach ($departamentos as $arregloDto) {
                                                                    if ($arregloDto[0] == $docente->getDepartamento()) {
                                                                        echo '<OPTION value="' . $arregloDto[0] . '" selected="true">' . $arregloDto[1] . '</OPTION>';
                                                                    } else {
                                                                        echo '<OPTION value="' . $arregloDto[0] . '">' . $arregloDto[1] . '</OPTION>';
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <label for="">Municipio</label>
                                                        <div id="comboMunicipio">
                                                            <select required="true" name="municipioCmb" id="municipioCmb" class="form-control">
                                                                <?php
                                                                $municipios = $d->getMunicipios($docente->getDepartamento());
                                                                foreach ($municipios as $arregloMunicipios) {
                                                                    if ($arregloMunicipios[0] == $docente->getMunicipio()) {
                                                                        echo '<OPTION value="' . $arregloMunicipios[0] . '" selected="true">' . $arregloMunicipios[1] . '</OPTION>';
                                                                    } else {
                                                                        echo '<OPTION value="' . $arregloMunicipios[0] . '">' . $arregloMunicipios[1] . '</OPTION>';
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="col-xs-6">
                                                        <label for="">Dirección  *</label>
                                                        <input value="<?php echo $docente->getDireccion() ?>" required="true" type="text" class="form-control" name="direccionTxt" id="direccionTxt" placeholder="">
                                                    </div>
                                                    <div class="col-xs-3">
                                                        <label for="">Teléfono</label>
                                                        <input value="<?php echo $docente->getTelefono() ?>" type="text" class="form-control" name="telefonoTxt" id="telefonoTxt" placeholder="">
                                                    </div>
                                                    <div class="col-xs-3">
                                                        <label for="">Celular</label>
                                                        <input value="<?php echo $docente->getCelular() ?>" type="text" class="form-control" name="celularTxt" id="celularTxt" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="col-xs-6">
                                                        <label for="">Fecha de nacimiento</label>
                                                        <input value="<?php echo $docente->getFechaNacimiento() ?>" required="true" type="date" class="form-control" name="fechaNacimientoCmb" id="fechaNacimientoCmb" placeholder="">
                                                    </div>
                                                    <div class="col-xs-3">
                                                        <label for="">Categoria Docente Universitaria</label>
                                                        <select required="true" class="form-control" name="categoriaCmb" id="categoriaCmb">
                                                            <option value="">SELECCIONE</option>
                                                            <?php if ($docente->getCategoria() == 'AUXILIAR') { ?>
                                                                <option value="AUXILIAR" selected="true">AUXILIAR</option>
                                                            <?php } else { ?>
                                                                <option value="AUXILIAR">AUXILIAR</option>
                                                            <?php }if ($docente->getCategoria() == 'ASISTENTE') { ?>
                                                                <option value="ASISTENTE" selected="true">ASISTENTE</option>
                                                            <?php } else { ?>
                                                                <option value="ASISTENTE">ASISTENTE</option>
                                                            <?php }if ($docente->getCategoria() == 'ASOCIADO') { ?>
                                                                <option value="ASOCIADO" selected="true">ASOCIADO</option>
                                                            <?php } else { ?>
                                                                <option value="ASOCIADO">ASOCIADO</option>
                                                            <?php }if ($docente->getCategoria() == 'TITULAR') { ?>
                                                                <option value="TITULAR" selected="true">TITULAR</option>
                                                            <?php } else { ?>
                                                                <option value="TITULAR">TITULAR</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-xs-3">
                                                        <label for="">Sede de inscripción</label>
                                                        <select required="true" class="form-control" name="sedeCmb" id="sedeCmb">
                                                            <option value="">SELECCIONE</option>
                                                            <?php 
                                                            /////
                                                            $sedePostgrados = $p->getSedeAbierta('A DISTANCIA');
                                                            $sedeValledupar = $p->getSedeAbierta('VALLEDUPAR');
                                                            $sedeAguachica = $p->getSedeAbierta('AGUACHICA');
                                                            ////
                                                            if ($sedeValledupar || $docente->getSede() == 'VALLEDUPAR') {   
                                                            if ($docente->getSede() == 'VALLEDUPAR') 
                                                                 
                                                            { ?>
                                                                <option value="VALLEDUPAR" selected="true">VALLEDUPAR</option>
                                                            <?php } else { ?>
                                                                <option value="VALLEDUPAR">VALLEDUPAR</option>
                                                            <?php }
                                                            }
                                                            if ($sedeAguachica || $docente->getSede() == 'AGUACHICA') { 
                                                            if ($docente->getSede() == 'AGUACHICA')
                                                            
                                                            { ?>
                                                                <option value="AGUACHICA" selected="true">AGUACHICA</option>
                                                            <?php } else { ?>
                                                                <option value="AGUACHICA">AGUACHICA</option>
                                                            
                                                            <?php }}
                                                            if ($sedePostgrados || $docente->getSede() == 'A DISTANCIA') {
                                                            if ($docente->getSede() == 'A DISTANCIA')
                                                            { 
                                                                
                                                                ?>
                                                                <option value="A DISTANCIA" selected="true">A DISTANCIA</option>
                                                            <?php } else { ?>
                                                                <option value="A DISTANCIA">A DISTANCIA</option>
                                                            <?php }
                                                                } ?>
                                                        
                                                        </select>
                                                        <?php
                                                        //var_dump($docente->getSede());
                                                                ?>
                                                        </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <?php 
                                                    if (file_exists("Soportes/".$archivo.".pdf")) {
                                                    ?>
                                                    <a href="VerAdjuntoCategoria.php?id=<?php echo $archivo; ?>"  target="_blank">
                                                        <h5><p align="center"><i class="pe-7s-video"></i> Ver Adjunto PDF</p></h5>
                                                    </a>
                                                    <?php 
                                                    }else{
                                                       echo '<h5><a href="#"><p align="center">No tiene Adjunto</p></a></h5>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <label for="soporteFle">Adjuntar soporte de categoría en formato pdf* (si no tiene adjunte su documento de identidad)</label>
                                                    <input type="file" name="soporteFle" accept="application/pdf" id="soporteFle"
                                                    
                                                    <?php /// SI YA EXISTE UN ARCHIVO, NO ES OBLIGATORIO SUBIR OTRO PARA GUARDAR
                                                    if (file_exists("Soportes/".$archivo.".pdf")) { echo "";} else{ echo 'required="true"';}
                                                    ?> 
                                                    
                                                    class="form-control"/>
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

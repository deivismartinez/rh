<?php
require_once("../Tablero/vo/UsuarioVO.php");
require_once("../Tablero/clases/Programas.php");
require_once("../Tablero/clases/Gestion.php");
//require_once("../Tablero/vo/DocenteVO.php");
//require_once("../Tablero/clases/Docente.php");
//require_once("../Tablero/vo/PeridoVO.php");
session_start();
$usuario = $_SESSION['usuario'];
$archivo = "hvd".$usuario->getId();
$_SESSION['id_usuario']=$usuario->getId();


if (isset($usuario)) {
 $programa = new Programas();       
 $usuarioEvaluador= $programa->getEvaluador();  
     $usuarioTxt= strtoupper($_POST["usuarioTxt"]);

     if (isset($usuarioTxt ) && !empty($usuarioTxt) ) {       
       $existe= $p->existeUsuario($usuarioTxt);
    if (!$existe) { // Si no está marcado (false)
        echo '<script type="text/javascript">alert("if existe")</script>';  
        $programa->insertarEvaluador();
    }else {
           $mensaje = "El nombre de la usuario no está disponible";
           }
    }

} else {
    header('Location: AccesoNoautorizado.html');
}

?>
<!DOCTYPE html>
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
        <link href="../Tablero/assets/css/animate.min.css" rel="stylesheet" />
        <link href="../Tablero/assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet" />
        <link href="../Tablero/assets/css/demo.css" rel="stylesheet" />
        <link href="../Tablero/assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
        
         <style>
            body {
                padding-top: 8px;
                font-family: 'Open Sans', sans-serif;
                font-size: 13px;
            }

            .tabla {
                margin: 6px auto;
            }

            .tabla thead {
                cursor: pointer;
                background: #337ab7;
                color: rgba(255, 255, 255, 1);
                
                
            }

            .tabla thead tr th {
                font-weight: bold;
                padding: 5px 5px;
            }

            .tabla thead tr th span {
                padding-right: 5px;
                background-repeat: no-repeat;
                background-position: 100% 55%;
            }

            .tabla tbody tr td {
                text-align: center;
                padding: 5px 5px;
            }

            .tabla tbody tr td.align-left {
                text-align: left;
            }
        </style>
      
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
                     <?php include("includes/menu.html");?>
                    
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
                                        Información Básica del evaluador
                                    </div>
                                    <div class="panel-body">
                                        <form name="form" action="" method="post" enctype="multipart/form-data">
                                            
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="col-xs-6">
                                                        <label for="">Nombre  *</label>
                                                        <input value="" required="true" type="text" class="form-control" name="nombreCompletoTxt" id="nombreCompletoTxt" placeholder="">
                                                    </div>
                                                     <div class="col-xs-6">
                                                        <label for="">Email  *</label>
                                                        <input value="" required="true" type="email" class="form-control" name="emailEml" id="emailEml" placeholder="name@example.com">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="col-xs-6">
                                                        <label for="">Facultad  *</label>
                                                         <select class="form-control" id="facultadCmb" name="facultadCmb" required="true" onchange="">                                                      <option value="">SELECCIONE</option>
                                                    <?php
                                                    $facultades = $programa->getFacultades();
                                                    foreach ($facultades as $arregloFac) {
                                                        echo '<OPTION value="' . $arregloFac[0] . '">' . $arregloFac[1] . '</OPTION>';
                                                    }
                                                    ?>
                                                </select>
                                                    </div>

                                                    <div class="col-xs-3">
                                                        <label for="">Rol  *</label>
                                                        <select class="form-control" id="rolCmb" name="rolCmb" required="true" onchange="">    
                                                    <OPTION value="">[SELECCIONE]</OPTION>
                                                    <OPTION value="DECANO">DECANO</OPTION>
                                                    <OPTION value="EVALUADOR">EVALUADOR</OPTION>
                                                     <OPTION value="JEFE">JEFE</OPTION>
                                                      <OPTION value="RH">RH</OPTION>
                                                </select>
                                                    </div>

                                                     <div class="col-xs-3">
                                                        <label for="">Sede  *</label>
                                                        
                                                        <select class="form-control" id="sedeCmb" name="sedeCmb" required="true" onchange="">    
                                                    <OPTION value="">[SELECCIONE]</OPTION>
                                                    <OPTION value="A DISTANCIA">A DISTANCIA</OPTION>
                                                    <OPTION value="AGUACHICA">AGUACHICA</OPTION>
                                                    <OPTION value="VALLEDUPAR">VALLEDUPAR</OPTION>
                                                </select>                                                     
                                                    </div>
                                            </div>
                                            </div>
                                            
                                            
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="col-xs-6">
                                                        <label for="">Usuario  *</label>
                                                        <input value="" required="true" type="text" class="form-control" name="usuarioTxt" id="usuarioTxt" placeholder="">
                                                    </div>
                                                    <div class="col-xs-3">
                                                        <label for="">Contraseña</label>
                                                        <input value=""  type="password"  class="form-control" name="seguridadTxt" id="seguridadTxt" required="true" placeholder="">
                                                    </div>
                                                   
                                                    <div class="col-xs-3">
                                            <br>
                                            <input type="submit" value="Guardar" class="btn btn-primary" />
                                        </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                             <!-- Mostrar mensaje de error si existe -->
                                                <?php if ($mensaje): ?>
                                                <div aria-live="assertive" aria-atomic="true" style="color: #FF0000;">
                                                     <?php echo $mensaje; ?>
                                                </div>
                                               <?php endif; ?>
                                            </div>
                                        
                                        
                                        </form>
                                        

                                        <div class="row">
                                <div class="col-xs-12">
                                <table cellspacing="5" cellpadding="3" id="mi-tabla" class="table-bordered table-sm tabla">
                                    <thead>
                                        <tr>
                                            <th><span>No.</span></th>
                                            <th><span>Nombre</span></th>
                                            <th><span>Correo</span></th>
                                            <th><span>Facultad</span></th>
                                            <th><span>Tipo</span></th>
                                            <th><span>Estado</span></th>
                                            <th><span>Sede</span></th>
                                            <th><span></span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        foreach ($usuarioEvaluador as $arreglo) {
                                            $i = $i + 1;
                                            ?>
                                            <tr>
                                                <td><?php echo $i ?></td>
                                                <td><?php echo $arreglo[0] ?></td>
                                                <td><?php echo $arreglo[1] ?></td>
                                                <td><?php echo $arreglo[2] ?></td>
                                                <td><?php echo $arreglo[3] ?></td>
                                                <td><?php echo $arreglo[4] ?></td>
                                                <td><?php echo $arreglo[5] ?></td>

                                                <?php
                                                $urlVer = "EditEvaluadores.php?id=" . $arreglo[3];
                                                ?>
                                                <td>
                                                    <a data-toggle="tooltip" title="Ver información" href="<?php echo $urlVer; ?>"><i class="pe-7s-pen"></i></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                </div>
                               
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

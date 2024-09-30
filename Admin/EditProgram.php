<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("../Tablero/vo/UsuarioVO.php");
require_once("../Tablero/clases/Programas.php");
require_once("../Tablero/clases/Programa.php");
require_once("../Tablero/clases/Gestion.php");

$p = new Programas();
$programaNew = new Programa();

session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
    $nombre = $usuario->getName();
    $programa = $usuario->getlastName();
    $progamaId = $_GET['id'];
    //$verPrograma = $programa->getProgramasVer($progamaId);
    $verProgram = $programaNew->getProgramasVer($progamaId);

    
    $gestion = new Gestion();
    $programId = strtoupper(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS));

     echo '<script language="javascript">alert(hola)</script>';
   // $editable = $gestion->EditProgram($programId);
    if (isset($_POST["programTxt"])) {
      //  $gestion->insertarPrograma();

    }
} else {
    header('Location: AccesoNoautorizado.html');
}
$opcionAlcance = [
    'PREGRADO' => 'PREGRADO',
    'POSGRADO' => 'POSGRADO'
];
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
        <link href="../Tablero/assets/css/animate.min.css" rel="stylesheet" />
        <link href="../Tablero/assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet" />
        <link href="../Tablero/assets/css/demo.css" rel="stylesheet" />
        <link href="../Tablero/assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
        
        <style>
            body {
                padding-top: 15px;
                font-family: 'Open Sans', sans-serif;
                font-size: 13px;
            }

            .tabla {
                margin: 10px auto;
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
            <div class="sidebar" data-color="green" data-image="../images/sidebar-5.jpg">
                <div class="sidebar-wrapper">
                    <div class="logo">
                        <a href="#" class="simple-text">
                            Consulta de Inscritos a el Departamento.
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
                    <div class="container-fluid">
                    </div>
                    <div class="col-xs-4">
                    <a href="Agregar.php">
                    <h4><i class="pe-7s-back"></i>Volver</h4>
                    </a>                                       
                        <h5>
                            <?php echo $nombre; ?>
                        </h5>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    Editar programa académico
                                </div>
                                <div class="panel-body">
                                    <form name="form" action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label for="telefono">Facultad</label>
                                                <?php ?>
                                                <select class="form-control" id="facultadCmb" name="facultadCmb"
                                                        required="true" onchange=<?php
                                                                                    if ($p->esPostgrados($usuario->getId())) {
                                                                                        echo '"cargarProgPost(this.value)"';
                                                                                    } else {
                                                                                        echo '"cargarProgramas(this.value)"';
                                                                                    }
                                                                                    ?>>
                                                        <option value="">SELECCIONE</option>
                                                        <?php
                                                        if ($p->esPostgrados($usuario->getId())) {
                                                           // $facultades = $p->getFacultadesDocentePostgrado();
                                                        } else {
                                                           // $facultades = $p->getFacultadesDocente();
                                                        }

                                                        ?>
                                                        <?php /* foreach ($facultades as $valor): ?>
                                                            <option value="<?= htmlspecialchars($valor[0]) ?>"
                                                                <?= ($valor[1] === $verProgram->getFacultad()) ? 'selected' : '' ?>>
                                                                <?= htmlspecialchars($valor[1]) ?>
                                                            </option>

                                                        <?php endforeach; */ ?>
                                                    </select>
                                            </div>
                                            <div class="col-xs-3">
                                                <label for="telefono">Nombre del nuevo Programa</label>
                                                <div id="comboProg">
                                                    <input class="form-control" type="text" id="programTxt" value = "<?php echo $verProgram->getName();?>" name="programTxt" required="true">
                                                </div>
                                            </div>
                                            <div class="col-xs-3">
                                                <label for="telefono">Alcance</label>
                                                    <select class="form-control" id="posgradoCmb" name="posgradoCmb" required="true" onchange="">
                                                        <?php foreach ($opcionAlcance as $valor => $etiqueta): ?>
                                                            <option value="<?php echo htmlspecialchars($valor); ?>"
                                                                <?php echo $valor === $eval->getAlcance() ? 'selected' : ''; ?>>
                                                                <?php echo htmlspecialchars($etiqueta); ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                            </div>
                                        
                                        <div class="col-xs-3">
                                            <br>
                                            <input type="submit" value="Editar" class="btn btn-primary" />
                                        </div>
                                        </div>
                                    </form>
                                </div>

                         
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div id="resultado">

                                    </div>
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
<script src="../Tablero/assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src='../Tablero/assets/js/jquery2.1.3sorter.js'></script>
<script src="../Tablero/assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../Tablero/assets/js/chartist.min.js"></script>
<script src="../Tablero/assets/js/bootstrap-notify.js"></script>
<script src="../Tablero/assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>
<script src="../Tablero/assets/js/demo.js"></script>
</html>
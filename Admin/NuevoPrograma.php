<?php
require_once '../Tablero/vo/UsuarioVO.php';
require_once("../Tablero/clases/Programas.php");
require_once("../Tablero/clases/Gestion.php");

$p = new Programas();
session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
    $nombre = $usuario->getName();
    $programa = $usuario->getlastName();
    $programasCreados = $p->getProgramasVer();

    if (isset($_POST["programTxt"])) {
        $gestion = new Gestion();
        $gestion->insertarPrograma();
    }
} else {
    header('Location: AccesoNoautorizado.html');
}
?>


<!DOCTYPE html>
<html lang="en">


    <head>

        <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración Inscripción Docente Unicesar</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../mazer/dist/assets/css/bootstrap.css">

    <link rel="stylesheet" href="../mazer/dist/assets/vendors/iconly/bold.css">

    <link rel="stylesheet" href="../mazer/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="../mazer/dist/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../mazer/dist/assets/css/app.css">
    <link rel="shortcut icon" href="../mazer/dist/assets/images/favicon.svg" type="image/x-icon">



</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="index.html"><img src="../images/logo.png" alt="logo" srcset=""></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>

                        </div>
                    </div>
                           

                </div>

               <div class="sidebar-menu">

                    <ul class="menu">

                        <li class="sidebar-title">Menu</li>



                        <!--<li class="sidebar-item has-sub ">
                            <a href="index.html" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li> -->


                          <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>Inscritos</span>
                            </a>
                            <ul class="submenu ">   
                                <li class="submenu-item ">
                                    <a href="inicioAdmin.php">Por área</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="Calificados.php">Por Calificación</a>
                                </li>
                            </ul>
                        </li>
                           
                        

                        <li class="sidebar-item  active ">
                            <a href="Agregar.php" class='sidebar-link'>
                                <i class="bi bi-pen-fill"></i>
                                <span>Administrar</span>
                            </a>
                        </li>

                        <li class="sidebar-item ">
                            <a href="ModificarClave.php" class='sidebar-link'>
                                <i class="bi bi-grid-1x2-fill"></i>
                                <span>Usuario</span>
                            </a>
                           
                        </li>                       

                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
 
       <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">

                <h3>Programas Académicos</h3>
                <p class="text-subtitle text-muted">Gestión de programas académicos</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Administrar</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Programas Académicos</li>

                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                     
                        <div class="container">
                        <div class="col-xs-12">
                            <div class="panel panel-primary">
                                
                                <div class="panel-body">
                                    <form name="form" action="" method="post" enctype="multipart/form-data">
                                        <div class="row">

                                            <div class="col-xs-3">
                                                <label for="telefono">Nuevo Programa</label>
                                                <div id="comboProg">
                                                    <input class="form-control" type="text" id="programTxt" name="programTxt" required="true">
                                                </div>
                                            </div>

                                            <div class="col-xs-3">
                                                <label for="telefono">Facultad</label>
                                                <select class="form-control" id="facultadCmb" name="facultadCmb" required="true" onchange="">                                                      <option value="">SELECCIONE</option>
                                                     <?php
                                                    $facultades = $p->getFacultadesDocentePostgrado();
                                                    foreach ($facultades as $arregloFac) {
                                                        echo '<OPTION value="' . $arregloFac[0] . '">' . $arregloFac[1] . '</OPTION>';
                                                    }
                                                    ?>
                                                    
                                                </select>
                                            </div>
                                            
                                            <div class="col-xs-3">
                                                <label for="telefono">Alcance</label>
                                                <select class="form-control" id="posgradoCmb" name="posgradoCmb" required="true" onchange="">    
                                                    <OPTION value="">[SELECCIONE]</OPTION>
                                                    <OPTION value="false">PREGRADO</OPTION>
                                                    <OPTION value="true">POSGRADO</OPTION>
                                                </select>
                                            </div>
                                        
                                        <div class="col-xs-3">
                                            <br>
                                            <input type="submit" value="Guardar" class="btn btn-primary" />
                                        </div>
                                        </div>
                                    </form>
                                </div>


                                <div class="row">
                                            <div class="table-responsive">
                                <table cellspacing="5" cellpadding="3" id="mi-tabla" class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th><span>No.</span></th>
                                            <th><span>Programa</span></th>
                                            <th><span>Facultad</span></th>
                                            <th><span>Alcance</span></th>
                                            <th><span></span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        foreach ($programasCreados as $arreglo) {
                                            $i = $i + 1;
                                            ?>
                                            <tr>
                                                <td><?php echo $i ?></td>
                                                <td><?php echo $arreglo[0] ?></td>
                                                <td><?php echo $arreglo[1] ?></td>
                                                <td><?php echo $arreglo[2] ?></td>

                                                <?php
                                                $urlVer = "../Tablero/controller/Ver.php?id=" . $arreglo[6] . "&nombre=" . $arreglo[1] . "&tipo=1";
                                                ?>
                                                <td>
                                                    <a data-toggle="tooltip" title="Ver información" href="<?php echo $urlVer; ?>"><i class="pe-7s-credit"></i></a>
                                                </td>
                                            </tr>
                                        <?php } ?>

                                    </tbody>
                                </table>
                                </div>
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
                    <div class="card-body">
                        listado de programas en el sistema.
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>Dep. Sistemas 2024</p>
                    </div>
                    <div class="float-end">
                        <p>Recursos Humanos 
                            <a href="https://www.unicesar.edu.co/">UNICESAR</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="../mazer/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../mazer/dist/assets/js/bootstrap.bundle.min.js"></script>
    
    <script src="../mazer/dist/assets/js/main.js"></script>
</body>

</html>   
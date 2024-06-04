<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="../../assets/img/favicon.ico">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title>Inscripción Docente Unicesar</title>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />


        <!-- Bootstrap core CSS     -->
        <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" />

        <!-- Animation library for notifications   -->
        <link href="../../assets/css/animate.min.css" rel="stylesheet"/>

        <!--  Light Bootstrap Table core CSS    -->
        <link href="../../assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>


        <!--  CSS for Demo Purpose, don't include it in your project     -->
        <link href="../../assets/css/demo.css" rel="stylesheet" />


        <!--     Fonts and icons     -->
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
        <link href="../../assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

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
                            <a href="../../../Admin/inicioAdmin.php">
                                <i class="pe-7s-photo-gallery"></i>
                                <p>Inscritos por Áreas</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="pe-7s-display1"></i>
                                <p>Estadisticas</p>
                            </a>
                        </li>
                        <li class="active-pro">
                            <a href="../../../Admin/index.php">
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
                            <img class="img-responsive" alt="UPC" src="../../../images/titulo.png">
                        </div>
                        <div class="collapse navbar-collapse">
                        </div>
                    </div>
                </nav>
                <div class="content">
                    <div class="container-fluid">
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Datos guardados correctamente
                            </div>
                            <div class="panel-body">
                                
                                <h4>Datos actualizados</h4>
                                
                                <div class="col-md-12">
                                    <a href="../../../Admin/inicioAdmin.php">
                                        <h4><i class="pe-7s-back"></i>Volver</h4>
                                    </a>
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
    <script src="../../assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
    <script src="../../assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!--  Charts Plugin -->
    <script src="../../assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="../../assets/js/bootstrap-notify.js"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
    <script src="../../assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

    <!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
    <script src="../../assets/js/demo.js"></script>

    <script type="text/javascript">
                    $(document).ready(function () {

                        demo.initChartist();

                        $.notify({
                            icon: 'pe-7s-notebook',
                            message: "Por favor diligencie <b>Su Producción Académica e Investigativa</b>"

                        }, {
                            type: 'info',
                            timer: 4000
                        });

                    });
    </script>

</html>

<?php
require_once '../Tablero/vo/UsuarioVO.php';
session_start();
$programa = 0;
if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
    $programa = $usuario->getlastName();
} else {
    header('Location: AccesoNoautorizado.html');
}
$area='';
$buscar = filter_input(INPUT_GET, 'b', FILTER_SANITIZE_SPECIAL_CHARS);
$programa = filter_input(INPUT_GET, 'programa', FILTER_SANITIZE_SPECIAL_CHARS);


$dia=date('d_m_Y');
header('Conten-type: aplication/vnd.ms-excel; charset=utf-8');
header("Content-Disposition: attachment; filename=DOCENTES_$dia.xls");
header("Pragma: no-cache");
header("Expires: 0");

buscar($buscar,$programa, $usuario,$area);

function buscar($criterio,$programa, $docente,$area) {
    echo $area;
    cabeza($area);
    require_once("../Tablero/clases/Docente.php");
    $docentes = new Docente();
    $criterio = strtoupper($criterio);
    $lista = $docentes->getDocentesCalificacionSupervisor($criterio,$programa,$area,$docente->getSede());
    require_once("../Tablero/clases/Puntajes.php");
    $i=0;
    ?>
    <!-- <h3 align="center">ASPIRANTES CALIFICADOS EN EL BANCO DE HOJA DE VIDA</h3>
    <table align="center" cellspacing="0" border="1" cellpadding="0" id="mi-tabla" class="table-bordered tabla"> -->
    <?php
    foreach ($lista as $arreglo) {
        $i=$i +1;
        $docente->setId($arreglo[6]);
        ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $arreglo[0] ?></td>
            <td><?php echo utf8_decode($arreglo[1]) ?></td>
            <td><?php echo utf8_decode($arreglo[2]) ?></td>
            <td><?php echo utf8_decode($arreglo[3]) ?></td>
            
            <td><?php echo utf8_decode($arreglo[4]) ?></td>
            <td><?php echo utf8_decode($arreglo[5]) ?></td>
            <td><?php echo utf8_decode($arreglo[7]) ?></td>
            <td><?php echo utf8_decode($arreglo[8]) ?></td>
            <td><?php echo utf8_decode($arreglo[9]) ?></td>
            <td><?php echo utf8_decode($arreglo[10]) ?></td>
            <td><?php echo utf8_decode($arreglo[11]) ?></td>
            <td><?php echo utf8_decode($arreglo[12]) ?></td>
            <td><?php echo utf8_decode($arreglo[13]) ?></td>
            <td><?php echo utf8_decode($arreglo[14]) ?></td>
            <td><?php echo utf8_decode($arreglo[15]) ?></td>
            <td><?php echo utf8_decode($arreglo[16]) ?></td>
            <!-- <td><?php echo $arreglo[2].' '.$arreglo[1] ?></td>
            <td><?php echo $arreglo[7] ?></td> -->
        </tr>
        <?php
    }
    echo '</tbody>
        </table>
        </div>
        </div>
        </div>
        ';
    echo '</page>';
    
}

function cabeza($programa) {
   
    echo "
        
<style>
            body{
                padding-top:15px;
                font-family: 'Open Sans', sans-serif;
                font-size:8px;
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
                text-align: center;
            }
</style>
";
    echo ' <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">';
   echo '<table border="1">';
    echo '
        
        <thead>
        <tr>
        <td><strong>No.</strong></td>
        <td><strong>tipodocumento</strong></td>
        <td><strong>documentoidentidad</strong></td>
        <td><strong>nombre</strong></td>
        <td><strong>apellidos</strong></td>
        <td><strong>fechanacimiento</strong></td>
        <td><strong>paisorigen</strong></td>
        <td><strong>municipio</strong></td>
        <td><strong>email</strong></td>
        <td><strong>max_estudio</strong></td>
        <td><strong>titulo_obtenido</strong></td>
        <td><strong>fecha_grado</strong></td>
        <td><strong>id_pais_inst_estudio</strong></td>
        <td><strong>convalidado</strong></td>
        <td><strong>nombre_inst_est</strong></td>
        <td><strong>id_metodologia</strong></td>
        <td><strong>fecha_ingreso</strong></td>
        </tr>
        </thead>
        <tbody>';
}
?>
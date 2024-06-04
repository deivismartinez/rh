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
    foreach ($lista as $arreglo) {
        $i=$i +1;
        $docente->setId($arreglo[6]);
        ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $arreglo[0] ?></td>
            <td><?php echo $arreglo[2].' '.$arreglo[1] ?></td>
            <td><?php echo $arreglo[7] ?></td>
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
    echo '<page style="font-size: 14px">';
    echo '<h3>ASPIRANTES CALIFICADOS EN EL BANCO DE HOJA DE VIDA</h3>';
    echo "
        
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
";
    echo ' <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">';
   echo '<table cellspacing="0" border="1" cellpadding="0" id="mi-tabla" class="table-bordered tabla">';
    echo "
        
                                                <thead>
                                                    <tr>
                                                    <th><span>No.</span></th>
                                                        <th><span>Identidad</span></th>
                                                        <th><span>Nombre</span></th>
                                                        <th><span>Puntaje</span></th>
                                                    </tr>
                                                </thead>
                                                <tbody>";
}

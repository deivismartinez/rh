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
$buscar = filter_input(INPUT_GET, 'b', FILTER_SANITIZE_SPECIAL_CHARS);
$area = filter_input(INPUT_GET, 'area', FILTER_SANITIZE_SPECIAL_CHARS);
buscar($buscar, $programa, $usuario, $area);
function buscar($criterio, $programa, $docente, $area)
{
    //echo '<h3 style="margin: 0cm 0.15pt 0.0001pt 51.35pt;">' . $area . '</h3>';
    cabeza($area);
    require_once("../Tablero/clases/Docente.php");
    $docentes = new Docente();
    $criterio = strtoupper($criterio);
    $lista = $docentes->getDocentesCalificacion($criterio, $programa, $area, $docente->getSede());
    require_once("../Tablero/clases/Puntajes.php");
    $i = 0;
    foreach ($lista as $arreglo) {
        $i = $i + 1;
        $docente->setId($arreglo[6]);
        ?>
<tr>
    <td><?php echo $i ?></td>
    <td><?php echo $arreglo[0] ?></td>
    <td><?php echo $arreglo[2] . ' ' . $arreglo[1] ?></td>
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

function cabeza($area)
{
    echo '<page style="font-size: 14px">';
    echo '<h3 style="margin: 0cm 0.15pt 0.0001pt 51.35pt;" align="center">ASPIRANTES CALIFICADOS EN EL BANCO DE HOJA DE VIDA</h3>';
    echo "<h3 align=center >" . $area . "</h3>
        
<style>
table.MsoNormalTable {
    mso-style-name: 'Tabla normal';
    mso-tstyle-rowband-size: 0;
    mso-tstyle-colband-size: 0;
    mso-style-noshow: yes;
    mso-style-priority: 99;
    mso-style-parent: '';
    mso-padding-alt: 0cm 5.4pt 0cm 5.4pt;
    mso-para-margin-top: 0cm;
    mso-para-margin-right: 0cm;
    mso-para-margin-bottom: 8.0pt;
    mso-para-margin-left: 0cm;
    line-height: 99%;
    mso-pagination: widow-orphan;
    font-size: 8.0pt;
    font-family: 'Calibri', sans-serif;
    mso-ascii-font-family: Calibri;
    mso-ascii-theme-font: minor-latin;
    mso-hansi-font-family: Calibri;
    mso-hansi-theme-font: minor-latin;
    mso-bidi-font-family: 'Times New Roman';
    mso-bidi-theme-font: minor-bidi;
}
            body{
                padding-top:15px;
                font-family: 'Open Sans', sans-serif;
                font-size:8px;
            }

            .tabla {
                margin: 5 auto;
            }
            .tabla thead {
                cursor: pointer;
                background: rgba(0, 0, 255, 1);
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
";
    echo ' <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">';
    echo '<table cellspacing="0" border="1" cellpadding="0" id="mi-tabla" class="table-bordered tabla" align=center>';
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
?>
<style>
    /* Style Definitions */
</style>
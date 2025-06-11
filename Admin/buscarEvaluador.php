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
$buscar = filter_input(INPUT_POST, 'b', FILTER_SANITIZE_SPECIAL_CHARS);
$area = filter_input(INPUT_POST, 'area', FILTER_SANITIZE_SPECIAL_CHARS);
buscar($buscar,$programa, $usuario,$area);
function buscar($criterio,$programa, $docente,$area) {
    cabeza();
    require_once("../Tablero/clases/Docente.php");
    $docentes = new Docente();
    $criterioInterno = strtoupper($criterio);
    $lista = $docentes->getDocentes($criterioInterno,$programa,$area,$docente->getSede());
    require_once("../Tablero/clases/Puntajes.php");
    $i=0;
    foreach ($lista as $arreglo) {
        $i=$i +1;
        $docente->setId($arreglo[6]);
        $urlVer = "../Tablero/controller/VerEvaluador.php?id=".$arreglo[6]."&nombre=".$arreglo[1]."&tipo=1";
        echo '<tr><td>'.$i.'</td><td>'.$arreglo[0].'</td><td>'.$arreglo[2].'</td><td>'.$arreglo[1].'</td><td>'.$arreglo[3].'</td>'.
             '<td><a data-toggle="tooltip" title="Ver información" href="'.$urlVer.'"><i class="pe-7s-credit"></i></a></td></tr>';
    }
    echo '</tbody></table>';
}

function cabeza() {
    echo '<table cellspacing="0" cellpadding="0" id="mi-tabla" class="table-bordered tabla">
                                                <thead>
                                                    <tr>
                                                    <th><span>No.</span></th>
                                                        <th><span>Identidad</span></th>
                                                        <th><span>Apellidos</span></th>
                                                        <th><span>Nombre</span></th>
                                                        <th><span>Celular</span></th>
                                                        <th><span></span></th>
                                                    </tr>
                                                </thead>
                                                <tbody>';
}

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
$prog = filter_input(INPUT_POST, 'prog', FILTER_SANITIZE_SPECIAL_CHARS);
//if (!empty($buscar)) {
    buscar($buscar,$programa, $usuario,$area,$prog);
//}

function buscar($criterio,$programa, $docente,$area,$prog) {
    cabeza();
    require_once("../Tablero/clases/Docente.php");
    $docentes = new Docente();
    $criterio = strtoupper($criterio);
    $lista = $docentes->getDocentesCalificacion($criterio,$prog,$area,$docente->getSede());
    require_once("../Tablero/clases/Puntajes.php");
    $i=0;
    foreach ($lista as $arreglo) {
        $i=$i +1;
        $docente->setId($arreglo[6]);
    
//    $puntajes = new Puntajes();
//    $listaPuntajes = $puntajes->getPuntajeTotal($docente);
//    $totalPuntosAca = $listaPuntajes->getDoctorado() + $listaPuntajes->getMaestria() + $listaPuntajes->getEspecializacion();
//    $totalPuntosExp = $listaPuntajes->getExpCatedratico() + $listaPuntajes->getExpMedioTiempo() + $listaPuntajes->getExpProfesional() + $listaPuntajes->getExpTiempoCompleto();
//    $totalInvestigacion = $listaPuntajes->getGrupo() + $listaPuntajes->getCategoriaInvestigador();
//    $totalPublicaciones = $listaPuntajes->getArticulo() + $listaPuntajes->getLibro() + $listaPuntajes->getPatente() + $listaPuntajes->getSoftware();
//    $totalPuntos = $listaPuntajes->getCategoria() + $totalPuntosAca + $totalPuntosExp + $totalInvestigacion + $totalPublicaciones;
//        $totalPuntos = 100;
        ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $arreglo[0] ?></td>
            <td><?php echo $arreglo[2] ?></td>
            <td><?php echo $arreglo[1] ?></td>
            <td><?php echo $arreglo[3] ?></td>
            <td><?php echo $arreglo[7] ?></td>
            <td><?php echo $arreglo[8] ?></td>
            <!--<td><?php // echo $totalPuntos ?></td>-->
            <?php
            $urlVer = "../Tablero/controller/VerJefe.php?id=".$arreglo[6]."&nombre=".$arreglo[1]."&tipo=1";
            ?>
            <td>
                <a data-toggle="tooltip" title="Ver información" href="<?php echo $urlVer; ?>"><i class="pe-7s-credit"></i></a>
            </td>
        </tr>
        <?php
    }
    echo '</tbody>
        </table>';
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
                                                        <th><span>Puntaje</span></th>
                                                        <th><span>Evaluador</span></th>
                                                        <th><span></span></th>
                                                    </tr>
                                                </thead>
                                                <tbody>';
}

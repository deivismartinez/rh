<?php

require_once './vo/UsuarioVO.php';
session_start();
$programa = 0;
if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
    $programa = $usuario->getlastName();
} else {
    header('Location: AccesoNoautorizado.html');
}


$buscar = filter_input(INPUT_POST, 'b', FILTER_SANITIZE_SPECIAL_CHARS);

if (!empty($buscar)) {
    buscar($buscar,$programa, $usuario);
}

function buscar($criterio,$programa, $docente) {
    cabeza();
    require_once("../General/clases/Docente.php");
    $docentes = new Docente();
    $criterio = strtoupper($criterio);
    $lista = $docentes->getDocentes($criterio,$programa);
    require_once("clases/Puntajes.php");
    foreach ($lista as $arreglo) {
//        $docente->setId($arreglo[6]);
//    
//    $puntajes = new Puntajes();
//    $listaPuntajes = $puntajes->getPuntajeTotal($docente);
//    $totalPuntosAca = $listaPuntajes->getDoctorado() + $listaPuntajes->getMaestria() + $listaPuntajes->getEspecializacion();
//    $totalPuntosExp = $listaPuntajes->getExpCatedratico() + $listaPuntajes->getExpMedioTiempo() + $listaPuntajes->getExpProfesional() + $listaPuntajes->getExpTiempoCompleto();
//    $totalInvestigacion = $listaPuntajes->getGrupo() + $listaPuntajes->getCategoriaInvestigador();
//    $totalPublicaciones = $listaPuntajes->getArticulo() + $listaPuntajes->getLibro() + $listaPuntajes->getPatente() + $listaPuntajes->getSoftware();
//    $totalPuntos = $listaPuntajes->getCategoria() + $totalPuntosAca + $totalPuntosExp + $totalInvestigacion + $totalPublicaciones;
        $totalPuntos = 100;
        ?>
        <tr>
            <td><?php echo $arreglo[0] ?></td>
            <td><?php echo $arreglo[1] ?></td>
            <td><?php echo $arreglo[2] ?></td>
            <td><?php echo $arreglo[3] ?></td>
            <td><?php echo $totalPuntos ?></td>
            <?php
            $urlVer = "controller/Ver.php?id=".$arreglo[6]."&nombre=".$arreglo[1]."&tipo=1";
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
                                                        <th><span>Identidad</span></th>
                                                        <th><span>Nombre</span></th>
                                                        <th><span>Apellidos</span></th>
                                                        <th><span>Celular</span></th>
                                                        <th><span>Puntaje</span></th>
                                                        <th><span></span></th>
                                                    </tr>
                                                </thead>
                                                <tbody>';
}

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
buscar($buscar, $programa, $usuario, $area, $prog);
//}

function buscar($criterio, $programa, $docente, $area, $prog)
{
    cabeza();
    require_once "../Tablero/clases/Docente.php";
    $docentes = new Docente();
    $criterio = strtoupper($criterio);
    $lista = $docentes->getDocentesSinArea($criterio, $docente->getSede());
    $i = 0;
    foreach ($lista as $arreglo) {
        $i = $i + 1;
        $docente->setId($arreglo[6]);

        ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $arreglo[0] ?></td>
            <td><?php echo $arreglo[1] ?></td>
            <td><?php echo $arreglo[2] ?></td>
            <td><?php echo $arreglo[3] ?></td>
            <td><?php echo $arreglo[4] ?></td>
            <td><?php echo $arreglo[6] ?></td>
            <?php
$urlVer = "../Tablero/controller/VerJefe.php?id=" . $arreglo[5] . "&nombre=" . $arreglo[1] . "&tipo=1";
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

function cabeza()
{
    echo '<table cellspacing="0" cellpadding="0" id="mi-tabla" class="table scrollme table-bordered">
                                                <thead>
                                                    <tr>
                                                    <th><span>No.</span></th>
                                                        <th><span>Documento</span></th>
                                                        <th><span>Nombre</span></th>
                                                        <th><span>Apellidos</span></th>
                                                        <th><span>Celular</span></th>
                                                        <th><span>Correo</span></th>
                                                        <th><span>Programa</span></th>
                                                        <th><span>Ver</span></th>
                                                    </tr>
                                                </thead>
                                                <tbody>';
}

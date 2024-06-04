<?php
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
$tipo = filter_input(INPUT_GET, 'tipo', FILTER_SANITIZE_SPECIAL_CHARS);
switch ($tipo){
    case 1:
        $url ="Location: ../ModificarPregrado.php?id=".$id;
        break;
    case 2:
        $url ="Location: ../ModificarEspecializacion.php?id=".$id;
        break;
    case 3:
        $url ="Location: ../ModificarMaestria.php?id=".$id;
        break;
    case 4:
        $url ="Location: ../ModificarDoctorado.php?id=".$id;
        break;
    case 5:
        $url ="Location: ../ModificarCurso.php?id=".$id;
        break;
}
header($url);
exit;




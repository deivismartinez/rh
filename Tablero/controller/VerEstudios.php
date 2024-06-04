<?php
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
$tipo = filter_input(INPUT_GET, 'tipo', FILTER_SANITIZE_SPECIAL_CHARS);
switch ($tipo){
    case 1:
        $url ="Location: VerPregrado.php?id=".$id;
        break;
    case 2:
        $url ="Location: VerEspecializacion.php?id=".$id;
        break;
    case 3:
        $url ="Location: VerMaestria.php?id=".$id;
        break;
    case 4:
        $url ="Location: VerDoctorado.php?id=".$id;
        break;
    case 5:
        $url ="Location: VerCurso.php?id=".$id;
        break;
}
header($url);
exit;




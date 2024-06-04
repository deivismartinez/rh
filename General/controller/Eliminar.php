<?php
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
$tipo = filter_input(INPUT_GET, 'tipo', FILTER_SANITIZE_SPECIAL_CHARS);
require_once("../clases/Estudios.php");
    $estudios = new Estudios();
switch ($tipo){
    case 1:
        $estudios->eliminarPregrado($id);
        break;
    case 2:
        $estudios->eliminarEspecializacion($id);
        break;
    case 3:
        $estudios->eliminarMaestria($id);
        break;
    case 4:
        $estudios->eliminarDoctorado($id);
        break;
    case 5:
        $estudios->eliminarCurso($id);
        break;
}
header("Location: ../Academica.php");
exit;


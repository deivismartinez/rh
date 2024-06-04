<?php
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
$tipo = filter_input(INPUT_GET, 'tipo', FILTER_SANITIZE_SPECIAL_CHARS);
require_once("../clases/Producciones.php");
    $producciones = new Producciones();
switch ($tipo){
    case 1:
        $producciones->eliminarArticulo($id);
        break;
    case 2:
        $producciones->eliminarVideo($id);
        break;
    case 3:
        $producciones->eliminarLibro($id);
        break;
    case 4:
        $producciones->eliminarPremio($id);
        break;
    case 5:
        $producciones->eliminarPatente($id);
        break;
    case 6:
        $producciones->eliminarObra($id);
        break;
    case 7:
        $producciones->eliminarSoftware($id);
        break;
    case 8:
        $producciones->eliminarProduccionTecnica($id);
        break;
    case 9:
        $producciones->eliminarGrupo($id);
        break;
    case 10:
        $producciones->eliminarMonografia($id);
        break;
}
header("Location: ../Produccion.php");
exit;


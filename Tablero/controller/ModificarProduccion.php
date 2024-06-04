<?php
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
$tipo = filter_input(INPUT_GET, 'tipo', FILTER_SANITIZE_SPECIAL_CHARS);
switch ($tipo){
    case 1:
        $url ="Location: ../ModificarArticulo.php?id=".$id."&tipo=$tipo";
        break;
    case 2:
        $url ="Location: VerVideo.php?id=".$id."&tipo=$tipo";
        break;
    case 3:
        $url ="Location: ../ModificarLibro.php?id=".$id."&tipo=$tipo";
        break;
    case 4:
        $url ="Location: VerPremio.php?id=".$id."&tipo=$tipo";
        break;
    case 5:
        $url ="Location: ../ModificarPatente.php?id=".$id."&tipo=$tipo";
        break;
    case 6:
        $url ="Location: VerObra.php?id=".$id."&tipo=$tipo";
        //$url ="Location: ../ModificarObra.php?id=".$id."&tipo=$tipo";
        break;
    case 7:
        $url ="Location: ../ModificarSoftware.php?id=".$id."&tipo=$tipo";
        break;
    case 8:
        $url ="Location: VerProduccionTecnica.php?id=".$id."&tipo=$tipo";
        break;
    case 9:
        $url ="Location: ../ModificarGrupo.php?id=".$id."&tipo=$tipo";
        break;
    case 10:
        $url ="Location: ../ModificarMonografia.php?id=".$id."&tipo=$tipo";
        break;
}
header($url);
exit;




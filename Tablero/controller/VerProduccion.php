<?php
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
$tipo = filter_input(INPUT_GET, 'tipo', FILTER_SANITIZE_SPECIAL_CHARS);
switch ($tipo){
    case 1:
        $url ="Location: VerArticulo.php?id=".$id."&tipo=$tipo";
        break;
    case 2:
        $url ="Location: VerVideo.php?id=".$id."&tipo=$tipo";
        break;
    case 3:
        $url ="Location: VerLibro.php?id=".$id."&tipo=$tipo";
        break;
    case 4:
        $url ="Location: VerPremio.php?id=".$id."&tipo=$tipo";
        break;
    case 5:
        $url ="Location: VerPatente.php?id=".$id."&tipo=$tipo";
        break;
    case 6:
        $url ="Location: VerObra.php?id=".$id."&tipo=$tipo";
        break;
    case 7:
        $url ="Location: VerSoftware.php?id=".$id."&tipo=$tipo";
        break;
    case 8:
        $url ="Location: VerProduccionTecnica.php?id=".$id."&tipo=$tipo";
        break;
    case 9:
        $url ="Location: VerGrupo.php?id=".$id."&tipo=$tipo";
        break;
    case 10:
        $url ="Location: VerMonografia.php?id=".$id."&tipo=$tipo";
        break;
}
header($url);
exit;




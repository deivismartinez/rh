<?php
$id = filter_input(INPUT_GET,'id', FILTER_SANITIZE_SPECIAL_CHARS);
$tipo = filter_input(INPUT_GET, 'tipo', FILTER_SANITIZE_SPECIAL_CHARS);
switch ($tipo){
    case 1:
        $prefijo ="art";
        break;
    case 2:
        $prefijo ="vid";
        break;
    case 3:
        $prefijo ="lib";
        break;
    case 4:
        $prefijo ="pre";
        break;
    case 5:
        $prefijo ="pat";
        break;
    case 6:
        $prefijo ="obr";
        break;
    case 7:
        $prefijo ="sof";
        break;
    case 8:
        $prefijo ="prt";
        break;
    case 9:
        $prefijo ="gru";
        break;
    case 10:
        $prefijo ="mon";
        break;
}
$path = "../Soportes/".$prefijo.$id.".pdf";
header("Content-type: application/pdf");
header('Content-Disposition:inline;filename="' . basename($path) . '"');
readfile($path);
?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
    </head>
</html> 

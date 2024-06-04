<?php
if (isset($_SESSION['usuario'])) {
    ///session_start();
    }else{ session_start();}
    if (isset($_SESSION['usuario'])) {    
$id = filter_input(INPUT_GET,'id', FILTER_SANITIZE_SPECIAL_CHARS);

$id_interno="hvd".$_SESSION['id_usuario'];
//var_dump($id_interno);var_dump($id);exit();
if($id_interno==$id){
$path = "Soportes/".$id.".pdf";
header("Content-type: application/pdf");
header('Content-Disposition:inline;filename="' . basename($path) . '"');
readfile($path);
}else{echo "Ese archivo no le pertenece";}

    }
    else {
        header('Location: AccesoNoautorizado.html');
    }
?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
    </head>
</html>

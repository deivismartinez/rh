<?php
if (isset($_SESSION['usuario'])) {
    ///session_start();
    }else{ session_start();}
    
$id = filter_input(INPUT_GET,'id', FILTER_SANITIZE_SPECIAL_CHARS);
require_once("../clases/Estudios.php");
    
if (isset($_SESSION['usuario'])) {
    $estudios = new Estudios();
    $id_docente=$_SESSION['id_docente'];
    if($estudios->pertenecePregrado($id_docente,$id)){

    //var_dump($pertenece) ; exit();
    //if ($pertenece){}
    $path = "../Soportes/ep".$id.".pdf";
header("Content-type: application/pdf");
header('Content-Disposition:inline;filename="' . basename($path) . '"');
readfile($path);
    }else{echo "Ese documento no le pertenece";}   
}
else {
    header('Location: ../AccesoNoautorizado.html');
}



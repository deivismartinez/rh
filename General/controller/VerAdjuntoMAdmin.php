<?php
$id = filter_input(INPUT_GET,'id', FILTER_SANITIZE_SPECIAL_CHARS);
$path = "../../Tablero/Soportes/em".$id.".pdf";
header("Content-type: application/pdf");
header('filename="' . basename($path) . '"');
readfile($path);

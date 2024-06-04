<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
    </head>
</html> 
<?php
$id = filter_input(INPUT_GET,'id', FILTER_SANITIZE_SPECIAL_CHARS);
$path = "../../Tablero/Soportes/ec".$id.".pdf";
header("Content-type: application/pdf");
header('filename="' . basename($path) . '"');
readfile($path);

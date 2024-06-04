<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
    </head>

<?php
$id = filter_input(INPUT_GET,'id', FILTER_SANITIZE_SPECIAL_CHARS);
$path = "../Soportes/ed".$id.".pdf";
header("Content-type: application/pdf");
header('filename="' . basename($path) . '"');
readfile($path);

?>
</html>

<?php
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
$idUsuario = filter_input(INPUT_GET, 'idUsuario', FILTER_SANITIZE_SPECIAL_CHARS);
require_once("../clases/Programas.php");
    $p = new Programas();
$p->eliminarProgramaPostgrado($id, $idUsuario);
header("Location: ../ProgramaPostgrado.php");
exit;


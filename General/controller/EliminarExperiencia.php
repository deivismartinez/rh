<?php
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
$idUsuario = filter_input(INPUT_GET, 'idUsuario', FILTER_SANITIZE_SPECIAL_CHARS);
require_once("../clases/Experiencias.php");
    $p = new Experiencias();
$p->eliminarExperiencia($id, $idUsuario);
header("Location: ../Experiencia.php");
exit;


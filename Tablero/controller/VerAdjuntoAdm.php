<?php
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
$tipo = filter_input(INPUT_GET, 'tipo', FILTER_SANITIZE_SPECIAL_CHARS);
$prefijo = '';
switch ($tipo) {
    case 1:
        $prefijo = 'ep';
        break;
    case 2:
        $prefijo = 'ee';
        break;
    case 3:
        $prefijo = 'em';
        break;
    case 4:
        $prefijo = 'ed';
        break;
    case 5:
        $prefijo = 'hvd';
        break;
    case 6:
        $prefijo = 'exp';
        break;
    case 7:
        $prefijo = 'gru';
        break;
    case 8:
        $prefijo = 'art';
        break;
    case 9:
        $prefijo = 'lib';
        break;
    case 10:
        $prefijo = 'sof';
        break;
    case 11:
        $prefijo = 'pat';
        break;
    case 12:
        $prefijo = 'mon';
        break;
    case 13:
        $prefijo = 'obr';
        break;
}
$path = "../Soportes/" . $prefijo . $id . ".pdf";
header("Content-type: application/pdf");
header('Content-Disposition:inline;filename="' . basename($path) . '"');
readfile($path);

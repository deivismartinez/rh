<?php

require_once "conectar.php";
require_once "helpers.php";

class Perido extends conectar
{

    private $db;

    public function __construct()
    {
        $this->db = parent::conectar();
        parent::setNames();
    }

    public function EsPeridoAbierto()
    {
        try {
            $sql = "select * from periodo where fecha_apertura<=current_date and fecha_cierre>= current_date;";
            $datos = pg_query($this->db, $sql);
            while ($row = pg_fetch_array($datos)) {
                return true;
            }
        } catch (Exception $error) { }
        return false;
    }

    public function PeridoSede($sede)
    {
        try {
            $sql = "select * from periodo where sede=" . $sede . "and fecha_apertura<=current_date and fecha_cierre>= current_date;";
            $datos = pg_query($this->db, $sql);
            while ($row = pg_fetch_array($datos)) {
                return true;
            }
        } catch (Exception $error) { }
        ////ojooooo cambiar a False
        return false;
    }

    public function getsedeAbierta($sede)
    {
        try {
            $sql = "select * from periodo where sede='" . $sede . "' and fecha_apertura<=current_date and fecha_cierre >= current_date;";
            ////////////////////////////////////////////////////////////////////////////////////////////////////////quitar el fecha_cierre+90 para la fecha actual

            $datos = pg_query($this->db, $sql);
            while ($row = pg_fetch_array($datos)) {
                return true;
            }
        } catch (Exception $error) { }
        return false;
    }
}

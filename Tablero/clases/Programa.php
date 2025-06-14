<?php

require_once("conectar.php");
require_once("helpers.php");
//require_once("../vo/ProgramasVO.php");
require_once '../Tablero/vo/ProgramasVO.php';


class Programa extends conectar
{

    private $db;

    //crear nuestro constructor - metodo magico
    public function __construct()
    {
        $this->db = parent::conectar(); //parent p' hacer referencia a la clase padre
        parent::setNames();
    }

    public function getProgramasVer($id)
    {
        $sql = "SELECT p.nombre as programa,f.nombre as facultad, CASE when postgrado = 'true' then 'POSGRADO' else 'PREGRADO' end as posgrado, p.estado as estado FROM programa p inner join facultad f on (p.facultad_id=f.id) where p.id=" . $id . ";";
        $datoSql = pg_query($this->db, $sql);
        $datos = pg_fetch_assoc($datoSql);

        if ($datos) {
            $verprogramas= new ProgramasVO();
            $verprogramas->setName($datos['programa']);  // Heredado de UsuarioGetters
            $verprogramas->setFacultad($datos['facultad']);  // Heredado de UsuarioGetters
            $verprogramas->setPosgrado($datos['posgrado']);  // Heredado de UsuarioGetters
            $verprogramas->setEstado($datos['estado']);  // Heredado de UsuarioGetters
            return $verprogramas;
        }
        return null;
    }
}
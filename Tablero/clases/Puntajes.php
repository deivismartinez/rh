<?php

require_once("conectar.php");
require_once("helpers.php");
$ruta = $_SERVER['DOCUMENT_ROOT'];
require_once $ruta . '/rh/Tablero/vo/PuntajesVO.php';

class Puntajes extends conectar {

    private $db;

    public function __construct() {
        $this->db = parent::conectar();
        parent::setNames();
    }

    public function getNumeroEspecializaciones($usuario) {
        $sql = "SELECT count(id) as cantidad FROM especializacion WHERE docente_id=" . $usuario->getId() . ";";
        $datos = pg_query($this->db, $sql);
        $cantidad = 0;
        while ($row = pg_fetch_array($datos)) {
            $cantidad = $row['cantidad'];
        }
        return $cantidad;
    }

    public function getNumeroMaestrias($usuario) {
        $sql = "SELECT count(id) as cantidad FROM maestria WHERE docente_id=" . $usuario->getId() . ";";
        $datos = pg_query($this->db, $sql);
        $cantidad = 0;
        while ($row = pg_fetch_array($datos)) {
            $cantidad = $row['cantidad'];
        }
        return $cantidad;
    }

    public function getNumeroDoctorado($usuario) {
        $sql = "SELECT count(id) as cantidad FROM doctorado WHERE docente_id=" . $usuario->getId() . ";";
        $datos = pg_query($this->db, $sql);
        $cantidad = 0;
        while ($row = pg_fetch_array($datos)) {
            $cantidad = $row['cantidad'];
        }
        return $cantidad;
    }

    public function getCategoria($usuario) {
        $sql = "SELECT CASE WHEN escalafondocente='AUXILIAR' THEN 37 WHEN escalafondocente='ASISTENTE' THEN 58 WHEN escalafondocente='ASOCIADO' THEN 74 WHEN escalafondocente='TITULAR' THEN 96 ELSE 0 END as cantidad FROM docente WHERE id=" . $usuario->getId() . ";";
        $datos = pg_query($this->db, $sql);
        $cantidad = 0;
        while ($row = pg_fetch_array($datos)) {
            $cantidad = $row['cantidad'];
        }
        return $cantidad;
    }

    public function getExpDocCatedratico($usuario) {
        $sql = "SELECT sum(numeroperiodos) as numeroperiodos FROM expcalificada where tipoexperiencia =1 and docenteid=" . $usuario->getId() . ";";
        $datos = pg_query($this->db, $sql);
        $cantidad = 0;
        while ($row = pg_fetch_array($datos)) {
            $cantidad = $row['numeroperiodos'];
        }
        return $cantidad;
    }

    public function getExpDocMedioTiempo($usuario) {
        $sql = "SELECT sum(numeroperiodos) as numeroperiodos FROM expcalificada where tipoexperiencia =4 and docenteid=" . $usuario->getId() . ";";
        $datos = pg_query($this->db, $sql);
        $cantidad = 0;
        while ($row = pg_fetch_array($datos)) {
            $cantidad = $row['numeroperiodos'];
            if($cantidad == null){$cantidad = 0;}
        }
        return $cantidad;
    }

    public function getExpDocTiempoCompleto($usuario) {
        $sql = "SELECT sum(numeroperiodos) as numeroperiodos FROM expcalificada where tipoexperiencia = 2 and docenteid=" . $usuario->getId() . ";";
        $datos = pg_query($this->db, $sql);
        $cantidad = 0;
        while ($row = pg_fetch_array($datos)) {
            $cantidad = $row['numeroperiodos'];
        }
        return $cantidad;
    }

    public function getExpProfesional($usuario) {
        $sql = "SELECT sum(numeroperiodos) as numeroperiodos FROM expcalificada where tipoexperiencia = 3 and docenteid=" . $usuario->getId() . ";";
        $datos = pg_query($this->db, $sql);
        $cantidad = 0;
        while ($row = pg_fetch_array($datos)) {
            $cantidad = $row['numeroperiodos'];
        }
        return $cantidad;
    }

    public function getCategoriaGrupo($usuario) {
        $sql = "SELECT clasificacion FROM grupoinvestigacion where docenteid=" . $usuario->getId() . " order by clasificacion;";
        $datos = pg_query($this->db, $sql);
        $cantidad = '0';
        while ($row = pg_fetch_array($datos)) {
            $cantidad = $row['clasificacion'];
            return $cantidad;
        }
        return $cantidad;
    }
    
    public function getCategoriaInvestigador($usuario) {
        $sql = "SELECT categoria FROM grupoinvestigacion where docenteid=" . $usuario->getId() . " order by clasificacion;";
        $datos = pg_query($this->db, $sql);
        $cantidad = '';
        while ($row = pg_fetch_array($datos)) {
            $cantidad = $row['categoria'];
            return $cantidad;
        }
        return $cantidad;
    }
    
    public function getPuntosSoftware($usuario) {
        $sql = "SELECT (count(id) * 20) as puntos FROM software where docente_id=" . $usuario->getId() . ";";
        $datos = pg_query($this->db, $sql);
        $cantidad = 0;
        while ($row = pg_fetch_array($datos)) {
            $cantidad = $row['puntos'];
            return $cantidad;
        }
        return $cantidad;
    }
    
    public function getPuntosPatente($usuario) {
        $sql = "SELECT (count(id) * 60) as puntos FROM patente where docente_id=" . $usuario->getId() . ";";
        $datos = pg_query($this->db, $sql);
        $cantidad = 0;
        while ($row = pg_fetch_array($datos)) {
            $cantidad = $row['puntos'];
            return $cantidad;
        }
        return $cantidad;
    }
    
    public function getMiPuntaje($usuario) {
        $sql = "SELECT categoria,estudios,experiencia,investigacion,publicaciones,(categoria + estudios + experiencia + investigacion + publicaciones),comentariocategoria,comentarioexperiencia,comentarioinvestigacion,comentariopublicaciones,comentarioestudio FROM calificacion WHERE docente_id=". $usuario->getId() .";";
        $datos = pg_query($this->db, $sql);
       $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }
    
    public function getDocentesCalificacion($dto,$idPrograma,$area,$sede) {
            $idarea = " in (SELECT id FROM perfil where area1='".$area."' and programa_id=".$idPrograma.")";
        $sql = "SELECT DISTINCT documentoidentidad,docente.nombre,apellidos,celular,email, "
                . "docente_programa.programa_id, docente.id,(categoria + estudios + experiencia + investigacion + publicaciones) as puntaje FROM docente "
                . " JOIN docente_programa ON (docente_programa.docente_id = docente.id) "
                . " JOIN docenteperfil ON (docente.id = docenteperfil.docente_id) "
                . " JOIN calificacion ON (docente.id = calificacion.docente_id) "
                . " WHERE docente.nombre like '%". $dto ."%' and docente_programa.programa_id=" . $idPrograma 
                ." and docenteperfil.perfil_id ". $idarea. " and docente.sede like '".$sede."' order by puntaje desc, apellidos, docente.nombre;";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }
    
    public function getNombreArea($area) {
        try {
            $sql = "SELECT area1 FROM perfil where id = ".$area.";";
            $datos = pg_query($this->db, $sql);
            while ($row = pg_fetch_array($datos)) {
                return $row['area1'];
            }
        } catch (Exception $error) {
            
        }
        return false;
    }
    
    public function getPuntosLibro($usuario) {
        $sql = "SELECT tipo FROM libro where docente_id=" . $usuario->getId() . ";";
        $datos = pg_query($this->db, $sql);
        $tipo = -1;
        $puntos = 0;
        while ($row = pg_fetch_array($datos)) {
            $tipo = $row['tipo'];
            switch ($tipo) {
            case 1:
                $puntos = $puntos + 20;
                break;
            case 2:
                $puntos = $puntos + 5;
                break;
            case 3:
                $puntos = $puntos + 10;
                break;
            case 4:
                $puntos = $puntos + 5;
                break;
            case 5:
                $puntos = $puntos + 2;
                break;
        }
        }
        return $puntos;
    }
    
    public function getPuntosArticulo($usuario) {
        $sql = "SELECT tipo FROM libro where docente_id=" . $usuario->getId() . ";";
        $datos = pg_query($this->db, $sql);
        $tipo = -1;
        $puntos = 0;
        while ($row = pg_fetch_array($datos)) {
            $tipo = $row['tipo'];
            switch ($tipo) {
            case 'D1':
                $puntos = $puntos + 5;
                break;
            default:
                $puntos = $puntos + 10;
                break;
        }
        }
        return $puntos;
    }

    public function getPuntosGrupo($usuario) {
        $categoria = $this->getCategoriaGrupo($usuario);
        switch ($categoria) {
            case 'A1':
                return 20;
            case 'A2':
                return 15;
            case 'B':
                return 12;
            case 'C':
                return 10;
                case 'D':
                return 6;
            default:
                return 0;
        }
    }
    
    public function getPuntosCategoriaInvestigador($usuario) {
        $categoria = $this->getCategoriaInvestigador($usuario);
        switch ($categoria) {
            case 'INVESTIGADOR SENIOR':
                return 10;
            case 'INVESTIGADOR ASOCIADO':
                return 5;
            case 'INVESTIGADOR JUNIOR':
                return 3;
            default:
                return 0;
        }
    }

    public function getNombreCategoria($usuario) {
        $sql = "SELECT escalafondocente as categoria FROM docente WHERE id=" . $usuario->getId() . ";";
        $datos = pg_query($this->db, $sql);
        $categoria = 0;
        while ($row = pg_fetch_array($datos)) {
            $categoria = $row['categoria'];
        }
        return $categoria;
    }
    public function getPuntajeEspecializacion(){
        
    }

    public function getPuntajeTotal($usuario) {
        $puntajes = new PuntajesVO();
        $cantidadEspecializaciones = $this->getNumeroEspecializaciones($usuario);
        if ($cantidadEspecializaciones > 1) {
            $puntajes->setEspecializacion(30);
        } else {
            if ($cantidadEspecializaciones < 1) {
                $puntajes->setEspecializacion(0);
            } else {
                $puntajes->setEspecializacion(20);
            }
        }
        $cantidadMaestrias = $this->getNumeroMaestrias($usuario);
        if ($cantidadMaestrias > 1) {
            $puntajes->setMaestria(60);
        } else {
            if ($cantidadMaestrias < 1) {
                $puntajes->setMaestria(0);
            } else {
                $puntajes->setMaestria(40);
            }
        }
        $cantidadDoctorados = $this->getNumeroDoctorado($usuario);
        if ($cantidadDoctorados > 1) {
            $puntajes->setDoctorado(120);
        } else {
            if ($cantidadDoctorados < 1) {
                $puntajes->setDoctorado(0);
            } else {
                $puntajes->setDoctorado(80);
            }
        }
        $puntajes->setCategoria($this->getCategoria($usuario));
        $puntajes->setNombreCategoria($this->getNombreCategoria($usuario));
        $puntajes->setExpCatedratico(0.5 * $this->getExpDocCatedratico($usuario));
        $puntajes->setExpMedioTiempo($this->getExpDocMedioTiempo($usuario));
        $puntajes->setExpTiempoCompleto(2 * $this->getExpDocTiempoCompleto($usuario));
        $puntajes->setExpProfesional(1.5 * $this->getExpProfesional($usuario));
        $puntajes->setGrupo($this->getPuntosGrupo($usuario));
        $puntajes->setSoftware($this->getPuntosSoftware($usuario));
        $puntajes->setArticulo($this->getPuntosArticulo($usuario));
        $puntajes->setLibro($this->getPuntosLibro($usuario));
        $puntajes->setPatente($this->getPuntosPatente($usuario));
        $puntajes->setCategoriaInvestigador($this->getPuntosCategoriaInvestigador($usuario));
        return $puntajes;
    }

}

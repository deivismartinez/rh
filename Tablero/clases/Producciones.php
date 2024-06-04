<?php

require_once("conectar.php");
require_once("helpers.php");

class Producciones extends conectar {

    private $db;

    public function __construct() {
        $this->db = parent::conectar();
        parent::setNames();
    }
    
    public function getDatosArticuloId($id) {
        try {
            $sql = "SELECT tipo, titulo, revista, autores, fechapublicacion, issn FROM articulo where id=" . $id . ";";
            $datos = pg_query($this->db, $sql);
            require_once('../../Tablero/vo/ArticuloVO.php');
            $articulo = new ArticuloVO;
            while ($row = pg_fetch_array($datos)) {
                $articulo->setTipo($row['tipo']);
                $articulo->setTitulo($row['titulo']);
                $articulo->setRevista($row['revista']);
                $articulo->setAutores($row['autores']);
                $articulo->setFechaPublicacion($row['fechapublicacion']);
                $articulo->setIssn($row['issn']);
                return $articulo;
            }
        } catch (Exception $error) {
            
        }
        return null;
    }
    
    public function getDatosArticuloIdModificar($id) {
        try {
            $sql = "SELECT tipo, titulo, revista, autores, fechapublicacion, issn FROM articulo where id=" . $id . ";";
            $datos = pg_query($this->db, $sql);
            require_once('../Tablero/vo/ArticuloVO.php');
            $articulo = new ArticuloVO;
            while ($row = pg_fetch_array($datos)) {
                $articulo->setTipo($row['tipo']);
                $articulo->setTitulo($row['titulo']);
                $articulo->setRevista($row['revista']);
                $articulo->setAutores($row['autores']);
                $articulo->setFechaPublicacion($row['fechapublicacion']);
                $articulo->setIssn($row['issn']);
                return $articulo;
            }
        } catch (Exception $error) {
            
        }
        return null;
    }
    
    public function getDatosVideosId($id) {
        try {
            $sql = "SELECT CASE WHEN tipo = 0 THEN 'NACIONAL' WHEN tipo = 1 THEN 'INTERNACIONAL' ELSE '' END as tipo,titulotrabajo,autores,fechaproduccion FROM produccionvideo where id=" . $id . ";";
            $datos = pg_query($this->db, $sql);
            require_once('../../Tablero/vo/ArticuloVO.php');
            $articulo = new ArticuloVO;
            while ($row = pg_fetch_array($datos)) {
                $articulo->setTipo($row['tipo']);
                $articulo->setTitulo($row['titulotrabajo']);
                $articulo->setAutores($row['autores']);
                $articulo->setFechaPublicacion($row['fechaproduccion']);
                return $articulo;
            }
        } catch (Exception $error) {
            
        }
        return null;
    }
    
    public function getDatosLibrosId($id) {
        try {
            $sql = "SELECT CASE WHEN tipo = 0 THEN 'LIBROS QUE RESULTEN DE UNA LABOR DE INVESTIGACIÓN' WHEN tipo = 1 THEN 'LIBROS DE TEXTOS' WHEN tipo = 2 THEN 'LIBROS DE ENSAYO' WHEN tipo = 3 THEN 'TRADUCCIÓN' WHEN tipo = 4 THEN 'INTERNACIONAL' ELSE '' END as tipo, titulo, aurores,isbn,fechapublicacion FROM libro where id=" . $id . ";";
            $datos = pg_query($this->db, $sql);
            require_once('../../Tablero/vo/ArticuloVO.php');
            $articulo = new ArticuloVO;
            while ($row = pg_fetch_array($datos)) {
                $articulo->setTipo($row['tipo']);
                $articulo->setTitulo($row['titulo']);
                $articulo->setAutores($row['aurores']);
                $articulo->setIssn($row['isbn']);
                $articulo->setFechaPublicacion($row['fechapublicacion']);
                return $articulo;
            }
        } catch (Exception $error) {
            
        }
        return null;
    }
    
    public function getDatosLibrosIdModificar($id) {
        try {
            $sql = "SELECT CASE WHEN tipo = 0 THEN 'LIBROS QUE RESULTEN DE UNA LABOR DE INVESTIGACIÓN' WHEN tipo = 1 THEN 'LIBROS DE TEXTOS' WHEN tipo = 2 THEN 'LIBROS DE ENSAYO' WHEN tipo = 3 THEN 'TRADUCCIÓN' WHEN tipo = 4 THEN 'INTERNACIONAL' ELSE '' END as tipo, titulo, aurores,isbn,fechapublicacion FROM libro where id=" . $id . ";";
            $datos = pg_query($this->db, $sql);
            require_once('../Tablero/vo/ArticuloVO.php');
            $articulo = new ArticuloVO;
            while ($row = pg_fetch_array($datos)) {
                $articulo->setTipo($row['tipo']);
                $articulo->setTitulo($row['titulo']);
                $articulo->setAutores($row['aurores']);
                $articulo->setIssn($row['isbn']);
                $articulo->setFechaPublicacion($row['fechapublicacion']);
                return $articulo;
            }
        } catch (Exception $error) {
            
        }
        return null;
    }
    
    public function getDatosMonografiaId($id) {
        try {
            $sql = "SELECT CASE WHEN tipo = 4 THEN 'ASESOR DE MONOGRAFIA O PROYECTO DE GRADO' WHEN tipo = 5 THEN 'ASESOR DE PRACTICAS CON OPCION DE GRADO' ELSE '' END as tipo, titulo, fechapublicacion FROM monografia where id=" . $id . ";";
            $datos = pg_query($this->db, $sql);
            require_once('../../Tablero/vo/ArticuloVO.php');
            $articulo = new ArticuloVO;
            while ($row = pg_fetch_array($datos)) {
                $articulo->setTipo($row['tipo']);
                $articulo->setTitulo($row['titulo']);
                $articulo->setFechaPublicacion($row['fechapublicacion']);
                return $articulo;
            }
        } catch (Exception $error) {
            
        }
        return null;
    }
    
    public function getDatosMonografiaIdModificar($id) {
        try {
            $sql = "SELECT CASE WHEN tipo = 4 THEN 'ASESOR DE MONOGRAFIA O PROYECTO DE GRADO' WHEN tipo = 5 THEN 'ASESOR DE PRACTICAS CON OPCION DE GRADO' ELSE '' END as tipo, titulo, fechapublicacion FROM monografia where id=" . $id . ";";
            $datos = pg_query($this->db, $sql);
            require_once('../Tablero/vo/ArticuloVO.php');
            $articulo = new ArticuloVO;
            while ($row = pg_fetch_array($datos)) {
                $articulo->setTipo($row['tipo']);
                $articulo->setTitulo($row['titulo']);
                $articulo->setFechaPublicacion($row['fechapublicacion']);
                return $articulo;
            }
        } catch (Exception $error) {
            
        }
        return null;
    }
    
    public function getDatosPremioId($id) {
        try {
            $sql = "SELECT CASE WHEN tipo = 0 THEN 'NACIONAL' WHEN tipo = 1 THEN 'INTERNACIONAL' ELSE '' END as tipo, titulo,"
                    . "premiados ,fechaentrega,institucionevento FROM premio where id=" . $id . ";";
            $datos = pg_query($this->db, $sql);
            require_once('../../Tablero/vo/ArticuloVO.php');
            $articulo = new ArticuloVO;
            while ($row = pg_fetch_array($datos)) {
                $articulo->setTipo($row['tipo']);
                $articulo->setTitulo($row['titulo']);
                $articulo->setAutores($row['premiados']);
                $articulo->setRevista($row['institucionevento']);
                $articulo->setFechaPublicacion($row['fechaentrega']);
                return $articulo;
            }
        } catch (Exception $error) {
            
        }
        return null;
    }
    
    public function getDatosPatenteId($id) {
        try {
            $sql = "SELECT nombre,autores ,fecharegpatente,registro FROM patente where id=" . $id . ";";
            $datos = pg_query($this->db, $sql);
            require_once('../../Tablero/vo/ArticuloVO.php');
            $articulo = new ArticuloVO;
            while ($row = pg_fetch_array($datos)) {
                $articulo->setTitulo($row['nombre']);
                $articulo->setAutores($row['autores']);
                $articulo->setFechaPublicacion($row['fecharegpatente']);
                $articulo->setIssn($row['registro']);
                return $articulo;
            }
        } catch (Exception $error) {
            
        }
        return null;
    }
    
    public function getDatosPatenteIdModificar($id) {
        try {
            $sql = "SELECT nombre,autores ,fecharegpatente,registro FROM patente where id=" . $id . ";";
            $datos = pg_query($this->db, $sql);
            require_once('../Tablero/vo/ArticuloVO.php');
            $articulo = new ArticuloVO;
            while ($row = pg_fetch_array($datos)) {
                $articulo->setTitulo($row['nombre']);
                $articulo->setAutores($row['autores']);
                $articulo->setFechaPublicacion($row['fecharegpatente']);
                $articulo->setIssn($row['registro']);
                return $articulo;
            }
        } catch (Exception $error) {
            
        }
        return null;
    }
    
    
    public function getDatosObraId($id) {
        try {
            $sql = "SELECT CASE WHEN tipo=1 THEN 'CREACIÓN ORIGINAL INTERNACIONAL' WHEN tipo=2 THEN 'CREACIÓN ORIGINAL NACIONAL' "
                    . "WHEN tipo=3 THEN 'CREACIÓN COMPLEMENTARIA INTERNACIONAL' WHEN tipo=4 THEN 'CREACIÓN COMPLEMENTARIA NACIONAL' "
                    . "WHEN tipo=5 THEN 'INTERPRETACIÓN INTERNACIONAL' WHEN tipo=6 THEN 'INTERPRETACIÓN NACIONAL' ELSE '' END as tipo,"
                    . "tituloobra,autores,fechapublicacion FROM obraartistica where id=" . $id . ";";
            $datos = pg_query($this->db, $sql);
            require_once('../../Tablero/vo/ArticuloVO.php');
            $articulo = new ArticuloVO;
            while ($row = pg_fetch_array($datos)) {
                $articulo->setTipo($row['tipo']);
                $articulo->setTitulo($row['tituloobra']);
                $articulo->setAutores($row['autores']);
                $articulo->setFechaPublicacion($row['fechapublicacion']);
                return $articulo;
            }
        } catch (Exception $error) {
            
        }
        return null;
    }
    
    public function getDatosSoftwareId($id) {
        try {
            $sql = "SELECT nombre,autores,fechapublicacion FROM software where id=" . $id . ";";
            $datos = pg_query($this->db, $sql);
            require_once('../../Tablero/vo/ArticuloVO.php');
            $articulo = new ArticuloVO;
            while ($row = pg_fetch_array($datos)) {
                $articulo->setTitulo($row['nombre']);
                $articulo->setAutores($row['autores']);
                $articulo->setFechaPublicacion($row['fechapublicacion']);
                return $articulo;
            }
        } catch (Exception $error) {
            
        }
        return null;
    }
    
    public function getDatosSoftwareIdModificar($id) {
        try {
            $sql = "SELECT nombre,autores,fechapublicacion FROM software where id=" . $id . ";";
            $datos = pg_query($this->db, $sql);
            require_once('../Tablero/vo/ArticuloVO.php');
            $articulo = new ArticuloVO;
            while ($row = pg_fetch_array($datos)) {
                $articulo->setTitulo($row['nombre']);
                $articulo->setAutores($row['autores']);
                $articulo->setFechaPublicacion($row['fechapublicacion']);
                return $articulo;
            }
        } catch (Exception $error) {
            
        }
        return null;
    }
    
    public function getDatosProduccionTecnicaId($id) {
        try {
            $sql = "SELECT CASE WHEN tipo=1 THEN 'ADAPTACIÓN TECNOLÓGICA' WHEN tipo = 2 THEN 'INNOVACIÓN TECNOLÓGICA' ELSE '' END as tipo,"
                    . "titulo,autores,fechaproduccion FROM producciontecnica where id=" . $id . ";";
            $datos = pg_query($this->db, $sql);
            require_once('../../Tablero/vo/ArticuloVO.php');
            $articulo = new ArticuloVO;
            while ($row = pg_fetch_array($datos)) {
                $articulo->setTipo($row['tipo']);
                $articulo->setTitulo($row['titulo']);
                $articulo->setAutores($row['autores']);
                $articulo->setFechaPublicacion($row['fechaproduccion']);
                return $articulo;
            }
        } catch (Exception $error) {
            
        }
        return null;
    }
    
    public function getDatosGrupoId($id) {
        try {
            $sql = "SELECT CASE WHEN clasificacion = 'A2' THEN 'A' WHEN clasificacion = 'RC' THEN 'RECONOCIDO POR COLCIENCIAS' ELSE clasificacion END as clasificacion,nombregrupo,fechavinculacion,categoria FROM public.grupoinvestigacion where id=" . $id . ";";
            $datos = pg_query($this->db, $sql);
            require_once('../../Tablero/vo/ArticuloVO.php');
            $articulo = new ArticuloVO;
            while ($row = pg_fetch_array($datos)) {
                $articulo->setTipo($row['clasificacion']);
                $articulo->setTitulo($row['nombregrupo']);
                $articulo->setFechaPublicacion($row['fechavinculacion']);
                $articulo->setIssn($row['categoria']);
                return $articulo;
            }
        } catch (Exception $error) {
            
        }
        return null;
    }
    
    public function getDatosGrupoIdModificar($id) {
        try {
            $sql = "SELECT CASE WHEN clasificacion = 'A2' THEN 'A' WHEN clasificacion = 'RC' THEN 'RECONOCIDO POR COLCIENCIAS' ELSE clasificacion END as clasificacion,nombregrupo,fechavinculacion,categoria FROM public.grupoinvestigacion where id=" . $id . ";";
            $datos = pg_query($this->db, $sql);
            require_once('../Tablero/vo/ArticuloVO.php');
            $articulo = new ArticuloVO;
            while ($row = pg_fetch_array($datos)) {
                $articulo->setTipo($row['clasificacion']);
                $articulo->setTitulo($row['nombregrupo']);
                $articulo->setFechaPublicacion($row['fechavinculacion']);
                $articulo->setIssn($row['categoria']);
                return $articulo;
            }
        } catch (Exception $error) {
            
        }
        return null;
    }
    
    
    public function eliminarArticulo($id) {
        $sql = "DELETE FROM articulo where id=" . $id . ";";
        pg_query($this->db, $sql);
         ////////////////// cambia el estado de la calificacion si existe
         $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
         pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
         ///////////////////
    }
    public function eliminarVideo($id) {
        $sql = "DELETE FROM produccionvideo where id=" . $id . ";";
        pg_query($this->db, $sql);
         ////////////////// cambia el estado de la calificacion si existe
         $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
         pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
         ///////////////////
    }
    
    public function eliminarLibro($id) {
        $sql = "DELETE FROM libro where id=" . $id . ";";
        pg_query($this->db, $sql);
         ////////////////// cambia el estado de la calificacion si existe
         $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
         pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
         ///////////////////
    }
    
    public function eliminarPremio($id) {
        $sql = "DELETE FROM premio where id=" . $id . ";";
        pg_query($this->db, $sql);
         ////////////////// cambia el estado de la calificacion si existe
         $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
         pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
         ///////////////////
    }
    
    public function eliminarPatente($id) {
        $sql = "DELETE FROM patente where id=" . $id . ";";
        pg_query($this->db, $sql);
         ////////////////// cambia el estado de la calificacion si existe
         $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
         pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
         ///////////////////
    }
    
    public function eliminarObra($id) {
        $sql = "DELETE FROM obraartistica where id=" . $id . ";";
        pg_query($this->db, $sql);
         ////////////////// cambia el estado de la calificacion si existe
         $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
         pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
         ///////////////////
    }
    
    public function eliminarSoftware($id) {
        $sql = "DELETE FROM software where id=" . $id . ";";
        pg_query($this->db, $sql);
         ////////////////// cambia el estado de la calificacion si existe
         $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
         pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
         ///////////////////
    }
    
    public function eliminarProduccionTecnica($id) {
        $sql = "DELETE FROM producciontecnica where id=" . $id . ";";
        pg_query($this->db, $sql);
         ////////////////// cambia el estado de la calificacion si existe
         $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
         pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
         ///////////////////
    }
    
    public function eliminarGrupo($id) {
        $sql = "DELETE FROM grupoinvestigacion where id=" . $id . ";";
        pg_query($this->db, $sql);
         ////////////////// cambia el estado de la calificacion si existe
         $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
         pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
         ///////////////////
    }
    
    public function eliminarMonografia($id) {
        $sql = "DELETE FROM monografia where id=" . $id . ";";
        pg_query($this->db, $sql);
         ////////////////// cambia el estado de la calificacion si existe
         $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
         pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
         ///////////////////
    }
    
    public function getArticulos($usuario) {
        $sql = "SELECT 'ARTICULO',titulo,fechapublicacion,id FROM articulo where docente_id=" . $usuario->getId() . ";";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }
    
    public function getArticulosAdm($usuario) {
        $sql = "SELECT 'ARTICULO',titulo,fechapublicacion,id,tipo FROM articulo where docente_id=" . $usuario->getId() . ";";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }
    
    public function getVideos($usuario) {
        $sql = "SELECT 'VIDEO',titulotrabajo,fechaproduccion,id FROM produccionvideo where docente_id=" . $usuario->getId() . ";";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }
    
    public function getLibros($usuario) {
        $sql = "SELECT 'LIBRO',titulo,fechapublicacion,id FROM libro where docente_id=" . $usuario->getId() . ";";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }
    
    public function getLibrosAdm($usuario) {
        $sql = "SELECT 'LIBRO',titulo,fechapublicacion,id,tipo FROM libro where docente_id=" . $usuario->getId() . ";";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }
    
    public function getMonografias($usuario) {
        $sql = "SELECT 'MONOGRAFIA',titulo,fechapublicacion,id FROM monografia where docente_id=" . $usuario->getId() . ";";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }
    
    public function getMonografiasAdm($usuario) {
        $sql = "SELECT 'MONOGRAFIA',titulo,fechapublicacion,id,tipo FROM monografia where docente_id=" . $usuario->getId() . ";";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }
    
    public function getPremios($usuario) {
        $sql = "SELECT 'PREMIO',titulo,fechaentrega,id FROM premio where docente_id=" . $usuario->getId() . ";";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }

    public function getPatentes($usuario) {
        $sql = "SELECT 'PATENTE',nombre,fecharegpatente,id FROM patente where docente_id=" . $usuario->getId() . ";";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }
    
    public function getObras($usuario) {
        $sql = "SELECT 'OBRA ARTÍSTICA',tituloobra,fechapublicacion,id FROM obraartistica where docente_id=" . $usuario->getId() . ";";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }
    
    public function getSoftware($usuario) {
        $sql = "SELECT 'SOFTWARE',nombre,fechapublicacion,id FROM software where docente_id=" . $usuario->getId() . ";";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }
    
    public function getProduccionesTecnicas($usuario) {
        $sql = "SELECT 'PROD. TÉCNICA',titulo,fechaproduccion,id FROM producciontecnica where docente_id=" . $usuario->getId() . ";";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }
    
    public function getGrupo($usuario) {
        $sql = "SELECT CASE WHEN clasificacion = 'A2' THEN 'A' WHEN clasificacion = 'RC' THEN 'RECONOCIDO POR COLCIENCIAS' ELSE clasificacion END as clasificacion,nombregrupo,fechavinculacion,id FROM grupoinvestigacion where docenteid=" . $usuario->getId() . "  order by clasificacion;";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }
    
    public function getGrupoAdm($usuario) {
        $sql = "SELECT CASE WHEN clasificacion = 'A2' THEN 'A' WHEN clasificacion = 'RC' THEN 'RECONOCIDO POR COLCIENCIAS' ELSE clasificacion END as clasificacion,nombregrupo,fechavinculacion,id FROM grupoinvestigacion where docenteid=" . $usuario->getId() . "  order by clasificacion limit 1;";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }
    
    public function getGrupoAdmInv($usuario) {
        $sql = "SELECT categoria,nombregrupo,fechavinculacion,id FROM grupoinvestigacion where docenteid=" . $usuario->getId() . "  order by clasificacion limit 1;";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }
    
    public function insertarArticulo() {
        require_once './vo/UsuarioVO.php';
        session_start();
        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];
            $id = $usuario->getId();
        } else {
            header('Location: AccesoNoautorizado.html');
        }
        $status = "";
        $tamano = $_FILES["soporteFle"]['size'];
        $tipoArchivo = $_FILES["soporteFle"]['type'];
        $archivo = $_FILES["soporteFle"]['name'];
        if ($archivo != "") {
            if ($tipoArchivo == 'application/pdf') {
                $tipoRevista = strtoupper(filter_input(INPUT_POST, 'tipoRevistaCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $titulo = strtoupper(filter_input(INPUT_POST, 'tituloTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $revista = strtoupper(filter_input(INPUT_POST, 'revistaTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $numeroAutores = strtoupper(filter_input(INPUT_POST, 'numeroAutoresNbr', FILTER_SANITIZE_SPECIAL_CHARS));
                $issn = strtoupper(filter_input(INPUT_POST, 'issnTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $fechaPublicacion = strtoupper(filter_input(INPUT_POST, 'fechaPublicacionDtp', FILTER_SANITIZE_SPECIAL_CHARS));
                $usuarioId = $id;
                 ////////////////// cambia el estado de la calificacion si existe
                 $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
                 pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
                 ///////////////////
                $sql = "INSERT INTO articulo(tipo, titulo, revista, autores, fechapublicacion, issn, "
                        . "fecharegistro, usuario, docente_id) "
                        . "VALUES('".$tipoRevista."', '".$titulo."', '".$revista."', ".$numeroAutores
                        .", '".$fechaPublicacion."', '".$issn."', now(), ".$usuarioId.", "
                        .$usuarioId."); select last_value from articulo_id_seq;";
                $oid = pg_query($this->db, $sql);
                while ($row = pg_fetch_array($oid)) {
                    $idCurso = $row[0];
                    break;
                }
                $destino = "Soportes/art" . $idCurso . ".pdf";
                if (copy($_FILES['soporteFle']['tmp_name'], $destino)) {
                    
                } else {
                    $status = "Error al subir el archivo";
                }
               
                header("Location: Produccion.php");
                exit;
            }else{
                header("Location: SoloPdf.php");
            }
        }
    }
    
    public function actualizarArticulo() {
        require_once './vo/UsuarioVO.php';
        session_start();
        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];
            $id = $usuario->getId();
        } else {
            header('Location: AccesoNoautorizado.html');
        }
        $status = "";
        $tamano = $_FILES["soporteFle"]['size'];
        $tipoArchivo = $_FILES["soporteFle"]['type'];
        $archivo = $_FILES["soporteFle"]['name'];
        if ($archivo != "") {
            if ($tipoArchivo == 'application/pdf') {
                $idTraido = strtoupper(filter_input(INPUT_POST, 'idTraido', FILTER_SANITIZE_SPECIAL_CHARS));
                $tipoRevista = strtoupper(filter_input(INPUT_POST, 'tipoRevistaCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $titulo = strtoupper(filter_input(INPUT_POST, 'tituloTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $revista = strtoupper(filter_input(INPUT_POST, 'revistaTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $numeroAutores = strtoupper(filter_input(INPUT_POST, 'numeroAutoresNbr', FILTER_SANITIZE_SPECIAL_CHARS));
                $issn = strtoupper(filter_input(INPUT_POST, 'issnTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $fechaPublicacion = strtoupper(filter_input(INPUT_POST, 'fechaPublicacionDtp', FILTER_SANITIZE_SPECIAL_CHARS));
                 ////////////////// cambia el estado de la calificacion si existe
                 $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
                 pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
                 ///////////////////
                $sql = "UPDATE articulo SET tipo='".$tipoRevista."', titulo='".$titulo."', revista='".$revista."', autores=".$numeroAutores
                        .", fechapublicacion='".$fechaPublicacion."', issn='".$issn."' WHERE id=".$idTraido.";";
                $oid = pg_query($this->db, $sql);
                $destino = "Soportes/art" . $idTraido . ".pdf";
                if (copy($_FILES['soporteFle']['tmp_name'], $destino)) {
                } else {
                    $status = "Error al subir el archivo";
                }
                header("Location: Produccion.php");
                exit;
            }else{
                header("Location: SoloPdf.php");
            }
        }
    }
    
    public function insertarGrupo() {
        require_once './vo/UsuarioVO.php';
        session_start();
        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];
            $id = $usuario->getId();
        } else {
            header('Location: AccesoNoautorizado.html');
        }
        $status = "";
        $tamano = $_FILES["soporteFle"]['size'];
        $tipoArchivo = $_FILES["soporteFle"]['type'];
        $archivo = $_FILES["soporteFle"]['name'];
        if ($archivo != "") {
            if ($tipoArchivo == 'application/pdf') {
                $tipoRevista = strtoupper(filter_input(INPUT_POST, 'tipoRevistaCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $titulo = strtoupper(filter_input(INPUT_POST, 'tituloTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $categoriaInvestigadorCmb = strtoupper(filter_input(INPUT_POST, 'categoriaInvestigadorCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $fechaPublicacion = strtoupper(filter_input(INPUT_POST, 'fechaPublicacionDtp', FILTER_SANITIZE_SPECIAL_CHARS));
                $usuarioId = $id;
                 ////////////////// cambia el estado de la calificacion si existe
                 $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
                 pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
                 ///////////////////
                $sql = "INSERT INTO grupoinvestigacion(nombregrupo, clasificacion, docenteid, "
                        . "fechavinculacion, categoria) VALUES('".$titulo."', '".$tipoRevista."', "
                        .$usuarioId.", '".$fechaPublicacion."', '".$categoriaInvestigadorCmb."'); select last_value from grupoinvestigacion_id_seq;";
                $oid = pg_query($this->db, $sql);
                while ($row = pg_fetch_array($oid)) {
                    $idCurso = $row[0];
                    break;
                }
                $destino = "Soportes/gru" . $idCurso . ".pdf";
                if (copy($_FILES['soporteFle']['tmp_name'], $destino)) {
                    
                } else {
                    $status = "Error al subir el archivo";
                }
               
                header("Location: Produccion.php");
                exit;
            }else{
                header("Location: SoloPdf.php");
            }
        }
    }

    public function actualizarGrupo() {
        require_once './vo/UsuarioVO.php';
        session_start();
        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];
            $id = $usuario->getId();
        } else {
            header('Location: AccesoNoautorizado.html');
        }
        $status = "";
        $tamano = $_FILES["soporteFle"]['size'];
        $tipoArchivo = $_FILES["soporteFle"]['type'];
        $archivo = $_FILES["soporteFle"]['name'];
        if ($archivo != "") {
            if ($tipoArchivo == 'application/pdf') {
                $idTraido = strtoupper(filter_input(INPUT_POST, 'idTraido', FILTER_SANITIZE_SPECIAL_CHARS));
                $tipoRevista = strtoupper(filter_input(INPUT_POST, 'tipoRevistaCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $titulo = strtoupper(filter_input(INPUT_POST, 'tituloTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $categoriaInvestigadorCmb = strtoupper(filter_input(INPUT_POST, 'categoriaInvestigadorCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $fechaPublicacion = strtoupper(filter_input(INPUT_POST, 'fechaPublicacionDtp', FILTER_SANITIZE_SPECIAL_CHARS));
                 ////////////////// cambia el estado de la calificacion si existe
                 $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
                 pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
                 ///////////////////
                $sql = "UPDATE grupoinvestigacion SET nombregrupo='".$titulo."', clasificacion='".$tipoRevista."', "
                        . "fechavinculacion='".$fechaPublicacion."', categoria='".$categoriaInvestigadorCmb."' WHERE id=".$idTraido.";";
                $oid = pg_query($this->db, $sql);
                $destino = "Soportes/gru" . $idTraido . ".pdf";
                if (copy($_FILES['soporteFle']['tmp_name'], $destino)) {
                    
                } else {
                    $status = "Error al subir el archivo";
                }
                header("Location: Produccion.php");
                exit;
            }else{
                header("Location: SoloPdf.php");
            }
        }
    }
    
    public function insertarPremio() {
        require_once './vo/UsuarioVO.php';
        session_start();
        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];
            $id = $usuario->getId();
        } else {
            header('Location: AccesoNoautorizado.html');
        }
        $status = "";
        $tamano = $_FILES["soporteFle"]['size'];
        $tipoArchivo = $_FILES["soporteFle"]['type'];
        $archivo = $_FILES["soporteFle"]['name'];
        if ($archivo != "") {
            if ($tipoArchivo == 'application/pdf') {
                $tipoRevista = strtoupper(filter_input(INPUT_POST, 'tipoRevistaCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $titulo = strtoupper(filter_input(INPUT_POST, 'tituloTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $revista = strtoupper(filter_input(INPUT_POST, 'revistaTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $numeroAutores = strtoupper(filter_input(INPUT_POST, 'numeroAutoresNbr', FILTER_SANITIZE_SPECIAL_CHARS));
                $fechaPublicacion = strtoupper(filter_input(INPUT_POST, 'fechaPublicacionDtp', FILTER_SANITIZE_SPECIAL_CHARS));
                $usuarioId = $id;
                 ////////////////// cambia el estado de la calificacion si existe
                 $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
                 pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
                 ///////////////////
                $sql = "INSERT INTO public.premio(titulo, institucionevento, tipo, premiados, fechaentrega, "
                        . "fecharegistro, usuario, docente_id) VALUES('".$titulo."', '".$revista."', "
                        .$tipoRevista.", ".$numeroAutores.", '".$fechaPublicacion."', now(), ".$usuarioId.", "
                        .$usuarioId."); select last_value from premio_id_seq;";
                $oid = pg_query($this->db, $sql);
                while ($row = pg_fetch_array($oid)) {
                    $idCurso = $row[0];
                    break;
                }
                $destino = "Soportes/pre" . $idCurso . ".pdf";
                if (copy($_FILES['soporteFle']['tmp_name'], $destino)) {
                    
                } else {
                    $status = "Error al subir el archivo";
                }
               
                header("Location: Produccion.php");
                exit;
            }else{
                header("Location: SoloPdf.php");
            }
        }
    }
    
    public function insertarMonografia() {
        require_once './vo/UsuarioVO.php';
        session_start();
        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];
            $id = $usuario->getId();
        } else {
            header('Location: AccesoNoautorizado.html');
        }
        $status = "";
        $tamano = $_FILES["soporteFle"]['size'];
        $tipoArchivo = $_FILES["soporteFle"]['type'];
        $archivo = $_FILES["soporteFle"]['name'];
        if ($archivo != "") {
            if ($tipoArchivo == 'application/pdf') {
                $tipoLibro = strtoupper(filter_input(INPUT_POST, 'tipoRevistaCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $titulo = strtoupper(filter_input(INPUT_POST, 'tituloTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $fechaPublicacion = strtoupper(filter_input(INPUT_POST, 'fechaPublicacionDtp', FILTER_SANITIZE_SPECIAL_CHARS));
                $usuarioId = $id;
                ////////////////// cambia el estado de la calificacion si existe
                $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
                pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
                ///////////////////
                $sql = "INSERT INTO public.monografia(tipo, titulo, descripcion, fechapublicacion, fechacambio,"
                        . " docente_id) VALUES(".$tipoLibro.", '".$titulo."', '".$tipoLibro."','".$fechaPublicacion."', now(),".$usuarioId."); select last_value from monografia_id_seq;";
                $oid = pg_query($this->db, $sql);
                while ($row = pg_fetch_array($oid)) {
                    $idCurso = $row[0];
                    break;
                }
                $destino = "Soportes/mon" . $idCurso . ".pdf";
                if (copy($_FILES['soporteFle']['tmp_name'], $destino)) {
                    
                } else {
                    $status = "Error al subir el archivo";
                }
               
                header("Location: Produccion.php");
                exit;
            }else{
                header("Location: SoloPdf.php");
            }
        }
    }
    
    public function actualizarMonografia() {
        require_once './vo/UsuarioVO.php';
        session_start();
        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];
            $id = $usuario->getId();
        } else {
            header('Location: AccesoNoautorizado.html');
        }
        $status = "";
        $tamano = $_FILES["soporteFle"]['size'];
        $tipoArchivo = $_FILES["soporteFle"]['type'];
        $archivo = $_FILES["soporteFle"]['name'];
        if ($archivo != "") {
            if ($tipoArchivo == 'application/pdf') {
                $idTraido = strtoupper(filter_input(INPUT_POST, 'idTraido', FILTER_SANITIZE_SPECIAL_CHARS)); 
                $tipoLibro = strtoupper(filter_input(INPUT_POST, 'tipoRevistaCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $titulo = strtoupper(filter_input(INPUT_POST, 'tituloTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $fechaPublicacion = strtoupper(filter_input(INPUT_POST, 'fechaPublicacionDtp', FILTER_SANITIZE_SPECIAL_CHARS));
                 ////////////////// cambia el estado de la calificacion si existe
                 $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
                 pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
                 ///////////////////
                $sql = "UPDATE monografia SET tipo=".$tipoLibro.", titulo='".$titulo."', descripcion='".$tipoLibro
                        ."', fechapublicacion='".$fechaPublicacion."' WHERE id=".$idTraido.";";
                $oid = pg_query($this->db, $sql);
                $destino = "Soportes/mon" . $idTraido . ".pdf";
                if (copy($_FILES['soporteFle']['tmp_name'], $destino)) {
                    
                } else {
                    $status = "Error al subir el archivo";
                    
                exit;
                }
               
                header("Location: Produccion.php");
                exit;
            }else{
                header("Location: SoloPdf.php");
            }
        }
    }
    
    public function insertarLibro() {
        require_once './vo/UsuarioVO.php';
        session_start();
        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];
            $id = $usuario->getId();
        } else {
            header('Location: AccesoNoautorizado.html');
        }
        $status = "";
        $tamano = $_FILES["soporteFle"]['size'];
        $tipoArchivo = $_FILES["soporteFle"]['type'];
        $archivo = $_FILES["soporteFle"]['name'];
        if ($archivo != "") {
            if ($tipoArchivo == 'application/pdf') {
                $tipoLibro = strtoupper(filter_input(INPUT_POST, 'tipoRevistaCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $titulo = strtoupper(filter_input(INPUT_POST, 'tituloTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $numeroAutores = strtoupper(filter_input(INPUT_POST, 'numeroAutoresNbr', FILTER_SANITIZE_SPECIAL_CHARS));
                $issn = strtoupper(filter_input(INPUT_POST, 'issnTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $fechaPublicacion = strtoupper(filter_input(INPUT_POST, 'fechaPublicacionDtp', FILTER_SANITIZE_SPECIAL_CHARS));
                $usuarioId = $id;
                 ////////////////// cambia el estado de la calificacion si existe
                 $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
                 pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
                 ///////////////////
                $sql = "INSERT INTO public.libro(tipo, titulo, aurores, isbn, fechapublicacion, fecharegistro,"
                        . " usuario, docente_id) VALUES(".$tipoLibro.", '".$titulo."', ".$numeroAutores.", '"
                        .$issn."', '".$fechaPublicacion."', now(), ".$usuarioId.", ".$usuarioId."); select last_value from libro_id_seq;";
                $oid = pg_query($this->db, $sql);
                while ($row = pg_fetch_array($oid)) {
                    $idCurso = $row[0];
                    break;
                }
                $destino = "Soportes/lib" . $idCurso . ".pdf";
                if (copy($_FILES['soporteFle']['tmp_name'], $destino)) {
                    
                } else {
                    $status = "Error al subir el archivo";
                }
               
                header("Location: Produccion.php");
                exit;
            }else{
                header("Location: SoloPdf.php");
            }
        }
    }
    
    public function actualizarLibro() {
        require_once './vo/UsuarioVO.php';
        session_start();
        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];
            $id = $usuario->getId();
        } else {
            header('Location: AccesoNoautorizado.html');
        }
        $status = "";
        $tamano = $_FILES["soporteFle"]['size'];
        $tipoArchivo = $_FILES["soporteFle"]['type'];
        $archivo = $_FILES["soporteFle"]['name'];
        if ($archivo != "") {
            if ($tipoArchivo == 'application/pdf') {
                $idTraido = strtoupper(filter_input(INPUT_POST, 'idTraido', FILTER_SANITIZE_SPECIAL_CHARS));
                $tipoLibro = strtoupper(filter_input(INPUT_POST, 'tipoRevistaCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $titulo = strtoupper(filter_input(INPUT_POST, 'tituloTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $numeroAutores = strtoupper(filter_input(INPUT_POST, 'numeroAutoresNbr', FILTER_SANITIZE_SPECIAL_CHARS));
                $issn = strtoupper(filter_input(INPUT_POST, 'issnTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $fechaPublicacion = strtoupper(filter_input(INPUT_POST, 'fechaPublicacionDtp', FILTER_SANITIZE_SPECIAL_CHARS));
                 ////////////////// cambia el estado de la calificacion si existe
                 $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
                 pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
                 ///////////////////
                $sql = "UPDATE libro SET tipo='".$tipoLibro."', titulo='".$titulo."', aurores=".$numeroAutores.", isbn='".$issn
                        ."', fechapublicacion='".$fechaPublicacion."' WHERE id=".$idTraido.";"; 
                $oid = pg_query($this->db, $sql);
                $destino = "Soportes/lib" . $idTraido . ".pdf";
                if (copy($_FILES['soporteFle']['tmp_name'], $destino)) {
                    
                } else {
                    $status = "Error al subir el archivo";
                }
               
                header("Location: Produccion.php");
                exit;
            }else{
                header("Location: SoloPdf.php");
            }
        }
    }
    
    public function insertarProduccionTecnica() {
        require_once './vo/UsuarioVO.php';
        session_start();
        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];
            $id = $usuario->getId();
        } else {
            header('Location: AccesoNoautorizado.html');
        }
        $status = "";
        $tamano = $_FILES["soporteFle"]['size'];
        $tipoArchivo = $_FILES["soporteFle"]['type'];
        $archivo = $_FILES["soporteFle"]['name'];
        if ($archivo != "") {
            if ($tipoArchivo == 'application/pdf') {
                $tipoLibro = strtoupper(filter_input(INPUT_POST, 'tipoRevistaCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $titulo = strtoupper(filter_input(INPUT_POST, 'tituloTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $numeroAutores = strtoupper(filter_input(INPUT_POST, 'numeroAutoresNbr', FILTER_SANITIZE_SPECIAL_CHARS));
                $fechaPublicacion = strtoupper(filter_input(INPUT_POST, 'fechaPublicacionDtp', FILTER_SANITIZE_SPECIAL_CHARS));
                $usuarioId = $id;
                 ////////////////// cambia el estado de la calificacion si existe
                 $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
                 pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
                 ///////////////////
                $sql = "INSERT INTO producciontecnica(tipo, titulo, autores, fechaproduccion, fecharegistro, "
                        . "usuario, docente_id) VALUES(".$tipoLibro.", '".$titulo."', ".$numeroAutores.", '"
                        .$fechaPublicacion."', now(), ".$usuarioId.", ".$usuarioId."); select last_value from producciontecnica_id_seq;";
                $oid = pg_query($this->db, $sql);
                while ($row = pg_fetch_array($oid)) {
                    $idCurso = $row[0];
                    break;
                }
                $destino = "Soportes/prt" . $idCurso . ".pdf";
                if (copy($_FILES['soporteFle']['tmp_name'], $destino)) {
                    
                } else {
                    $status = "Error al subir el archivo";
                }
               
                header("Location: Produccion.php");
                exit;
            }else{
                header("Location: SoloPdf.php");
            }
        }
    }
    
    public function insertarSoftware() {
        require_once './vo/UsuarioVO.php';
        session_start();
        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];
            $id = $usuario->getId();
        } else {
            header('Location: AccesoNoautorizado.html');
        }
        $status = "";
        $tamano = $_FILES["soporteFle"]['size'];
        $tipoArchivo = $_FILES["soporteFle"]['type'];
        $archivo = $_FILES["soporteFle"]['name'];
        if ($archivo != "") {
            if ($tipoArchivo == 'application/pdf') {
                $titulo = strtoupper(filter_input(INPUT_POST, 'tituloTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $numeroAutores = strtoupper(filter_input(INPUT_POST, 'numeroAutoresNbr', FILTER_SANITIZE_SPECIAL_CHARS));
                $fechaPublicacion = strtoupper(filter_input(INPUT_POST, 'fechaPublicacionDtp', FILTER_SANITIZE_SPECIAL_CHARS));
                $usuarioId = $id;
                 ////////////////// cambia el estado de la calificacion si existe
                 $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
                 pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
                 ///////////////////
                $sql = "INSERT INTO software(nombre, autores, fecharegistro, usuario, docente_id, fechapublicacion) "
                        . "VALUES('".$titulo."', ".$numeroAutores.", now(), ".$usuarioId.", ".$usuarioId.", '".$fechaPublicacion."'); select last_value from software_id_seq;";
                $oid = pg_query($this->db, $sql);
                while ($row = pg_fetch_array($oid)) {
                    $idCurso = $row[0];
                    break;
                }
                $destino = "Soportes/sof" . $idCurso . ".pdf";
                if (copy($_FILES['soporteFle']['tmp_name'], $destino)) {
                    
                } else {
                    $status = "Error al subir el archivo";
                }
               
                header("Location: Produccion.php");
                exit;
            }else{
                header("Location: SoloPdf.php");
            }
        }
    }
    
    public function actualizarSoftware() {
        require_once './vo/UsuarioVO.php';
        session_start();
        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];
            $id = $usuario->getId();
        } else {
            header('Location: AccesoNoautorizado.html');
        }
        $status = "";
        $tamano = $_FILES["soporteFle"]['size'];
        $tipoArchivo = $_FILES["soporteFle"]['type'];
        $archivo = $_FILES["soporteFle"]['name'];
        if ($archivo != "") {
            if ($tipoArchivo == 'application/pdf') {
                $idTraido = strtoupper(filter_input(INPUT_POST, 'idTraido', FILTER_SANITIZE_SPECIAL_CHARS));
                $titulo = strtoupper(filter_input(INPUT_POST, 'tituloTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $numeroAutores = strtoupper(filter_input(INPUT_POST, 'numeroAutoresNbr', FILTER_SANITIZE_SPECIAL_CHARS));
                $fechaPublicacion = strtoupper(filter_input(INPUT_POST, 'fechaPublicacionDtp', FILTER_SANITIZE_SPECIAL_CHARS));
                 ////////////////// cambia el estado de la calificacion si existe
                 $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
                 pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
                 ///////////////////
                $sql = "UPDATE software SET nombre='".$titulo."', autores=".$numeroAutores.", fechapublicacion='".$fechaPublicacion."' WHERE id =".$idTraido.";";
                        
                $oid = pg_query($this->db, $sql);
                
                $destino = "Soportes/sof" . $idTraido . ".pdf";
                if (copy($_FILES['soporteFle']['tmp_name'], $destino)) {
                    
                } else {
                    $status = "Error al subir el archivo";
                }
               
                header("Location: Produccion.php");
                exit;
            }else{
                header("Location: SoloPdf.php");
            }
        }
    }
    
    public function insertarObra() {
        require_once './vo/UsuarioVO.php';
        session_start();
        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];
            $id = $usuario->getId();
        } else {
            header('Location: AccesoNoautorizado.html');
        }
        $status = "";
        $tamano = $_FILES["soporteFle"]['size'];
        $tipoArchivo = $_FILES["soporteFle"]['type'];
        $archivo = $_FILES["soporteFle"]['name'];
        if ($archivo != "") {
            if ($tipoArchivo == 'application/pdf') {
                $tipoLibro = strtoupper(filter_input(INPUT_POST, 'tipoRevistaCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $titulo = strtoupper(filter_input(INPUT_POST, 'tituloTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $numeroAutores = strtoupper(filter_input(INPUT_POST, 'numeroAutoresNbr', FILTER_SANITIZE_SPECIAL_CHARS));
                $fechaPublicacion = strtoupper(filter_input(INPUT_POST, 'fechaPublicacionDtp', FILTER_SANITIZE_SPECIAL_CHARS));
                $usuarioId = $id;
                 ////////////////// cambia el estado de la calificacion si existe
                 $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
                 pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
                 ///////////////////
                $sql = "INSERT INTO obraartistica(tituloobra, autores, tipo, fechapublicacion, "
                        . "fecharegistro, usuario, docente_id) "
                        . "VALUES('".$titulo."', ".$numeroAutores.", ".$tipoLibro.", '".$fechaPublicacion."', now(), ".$usuarioId.", ".$usuarioId."); select last_value from obraartistica_id_seq;";
                $oid = pg_query($this->db, $sql);
                while ($row = pg_fetch_array($oid)) {
                    $idCurso = $row[0];
                    break;
                }
                $destino = "Soportes/obr" . $idCurso . ".pdf";
                if (copy($_FILES['soporteFle']['tmp_name'], $destino)) {
                    
                } else {
                    $status = "Error al subir el archivo";
                }
               
                header("Location: Produccion.php");
                exit;
            }else{
                header("Location: SoloPdf.php");
            }
        }
    }
    
    public function insertarPatente() {
        require_once './vo/UsuarioVO.php';
        session_start();
        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];
            $id = $usuario->getId();
        } else {
            header('Location: AccesoNoautorizado.html');
        }
        $status = "";
        $tamano = $_FILES["soporteFle"]['size'];
        $tipoArchivo = $_FILES["soporteFle"]['type'];
        $archivo = $_FILES["soporteFle"]['name'];
        if ($archivo != "") {
            if ($tipoArchivo == 'application/pdf') {
                $titulo = strtoupper(filter_input(INPUT_POST, 'tituloTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $numeroAutores = strtoupper(filter_input(INPUT_POST, 'numeroAutoresNbr', FILTER_SANITIZE_SPECIAL_CHARS));
                $issn = strtoupper(filter_input(INPUT_POST, 'issnTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $fechaPublicacion = strtoupper(filter_input(INPUT_POST, 'fechaPublicacionDtp', FILTER_SANITIZE_SPECIAL_CHARS));
                $usuarioId = $id;
                 ////////////////// cambia el estado de la calificacion si existe
                 $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
                 pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
                 ///////////////////
                $sql = "INSERT INTO public.patente(nombre, registro, autores, fecharegistro, usuario, docente_id, "
                        . "fecharegpatente) VALUES('".$titulo."', '".$issn."', ".$numeroAutores.",now(), "
                        .$usuarioId.", ".$usuarioId.", '".$fechaPublicacion."'); select last_value from patente_id_seq;";
                $oid = pg_query($this->db, $sql);
                while ($row = pg_fetch_array($oid)) {
                    $idCurso = $row[0];
                    break;
                }
                $destino = "Soportes/pat" . $idCurso . ".pdf";
                if (copy($_FILES['soporteFle']['tmp_name'], $destino)) {
                    
                } else {
                    $status = "Error al subir el archivo";
                }
               
                header("Location: Produccion.php");
                exit;
            }else{
                header("Location: SoloPdf.php");
            }
        }
    }
    
     public function actualizarPatente() {
        require_once './vo/UsuarioVO.php';
        session_start();
        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];
            $id = $usuario->getId();
        } else {
            header('Location: AccesoNoautorizado.html');
        }
        $status = "";
        $tamano = $_FILES["soporteFle"]['size'];
        $tipoArchivo = $_FILES["soporteFle"]['type'];
        $archivo = $_FILES["soporteFle"]['name'];
        if ($archivo != "") {
            if ($tipoArchivo == 'application/pdf') {
                $idTraido = strtoupper(filter_input(INPUT_POST, 'idTraido', FILTER_SANITIZE_SPECIAL_CHARS));
                $titulo = strtoupper(filter_input(INPUT_POST, 'tituloTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $numeroAutores = strtoupper(filter_input(INPUT_POST, 'numeroAutoresNbr', FILTER_SANITIZE_SPECIAL_CHARS));
                $issn = strtoupper(filter_input(INPUT_POST, 'issnTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $fechaPublicacion = strtoupper(filter_input(INPUT_POST, 'fechaPublicacionDtp', FILTER_SANITIZE_SPECIAL_CHARS));
                 ////////////////// cambia el estado de la calificacion si existe
                 $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
                 pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
                 ///////////////////
                $sql = "UPDATE patente SET nombre ='".$titulo."', registro='".$issn."', autores=".$numeroAutores
                        .", fecharegpatente='".$fechaPublicacion."' WHERE id=".$idTraido.";";
                $oid = pg_query($this->db, $sql);
                $destino = "Soportes/pat" . $idTraido . ".pdf";
                if (copy($_FILES['soporteFle']['tmp_name'], $destino)) {
                } else {
                    $status = "Error al subir el archivo";
                }
               
                header("Location: Produccion.php");
                exit;
            }
        }
    }
    
    public function insertarVideo() {
        require_once './vo/UsuarioVO.php';
        session_start();
        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];
            $id = $usuario->getId();
        } else {
            header('Location: AccesoNoautorizado.html');
        }
        $status = "";
        $tamano = $_FILES["soporteFle"]['size'];
        $tipoArchivo = $_FILES["soporteFle"]['type'];
        $archivo = $_FILES["soporteFle"]['name'];
        if ($archivo != "") {
            if ($tipoArchivo == 'application/pdf') {
                $tipoRevista = strtoupper(filter_input(INPUT_POST, 'tipoRevistaCmb', FILTER_SANITIZE_SPECIAL_CHARS));
                $titulo = strtoupper(filter_input(INPUT_POST, 'tituloTxt', FILTER_SANITIZE_SPECIAL_CHARS));
                $numeroAutores = strtoupper(filter_input(INPUT_POST, 'numeroAutoresNbr', FILTER_SANITIZE_SPECIAL_CHARS));
                $fechaPublicacion = strtoupper(filter_input(INPUT_POST, 'fechaPublicacionDtp', FILTER_SANITIZE_SPECIAL_CHARS));
                $usuarioId = $id;
                 ////////////////// cambia el estado de la calificacion si existe
                 $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
                 pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
                 ///////////////////
                $sql = "INSERT INTO produccionvideo(tipo, caracter, autores, titulotrabajo, "
                        . "fechaproduccion, fecharegistro, usuario, docente_id) "
                        . "VALUES('".$tipoRevista."', 0, ".$numeroAutores.", '".$titulo."', '"
                        .$fechaPublicacion."', now(), ".$usuarioId.", ".$usuarioId."); select last_value from produccionvideo_id_seq;";
                $oid = pg_query($this->db, $sql);
                while ($row = pg_fetch_array($oid)) {
                    $idCurso = $row[0];
                    break;
                }
                $destino = "Soportes/vid" . $idCurso . ".pdf";
                if (copy($_FILES['soporteFle']['tmp_name'], $destino)) {
                    
                } else {
                    $status = "Error al subir el archivo";
                }
               
                header("Location: Produccion.php");
                exit;
            }else{
                header("Location: SoloPdf.php");
            }
        }
    }
}



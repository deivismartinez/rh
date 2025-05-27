<?php

require_once("conectar.php");
require_once("helpers.php");

class Docente extends conectar
{

    private $db;

    public function __construct()
    {
        $this->db = parent::conectar();
        parent::setNames();
    }

    public function getDocentes($dto, $idPrograma, $area, $sede)
    {
        if ($area == '') {
            $area = '> 0' . $area;
        } else {
            $area = '= ' . $area;
        }
        if ($sede == "A DISTANCIA") {
            $sql = "SELECT DISTINCT documentoidentidad,docente.nombre,apellidos,celular,email, docente_programaposgrado.programa_id, docente.id FROM docente "
                . "JOIN docente_programaposgrado ON (docente_programaposgrado.docente_id = docente.id) "
                . "JOIN docenteperfilposgrado ON (docente.id = docenteperfilposgrado.docente_id) "
                . "WHERE docente.nombre like '%" . $dto . "%' and docente_programaposgrado.programa_id=" . $idPrograma
                . " and docenteperfilposgrado.perfil_id " . $area //." and docente.sede  =any(ARRAY['" . $sede . "','VALLEDUPAR'])"
                //. " and docenteperfilposgrado.perfil_id " . $area //. " and docente.sede like '" . $sede . "' "
                . " and docente.id not in (SELECT docente_id FROM calificacion where estado ='CALIFICADO') order by apellidos, docente.nombre;";
        } else {
            $sql = "SELECT DISTINCT documentoidentidad,docente.nombre,apellidos,celular,email, programa_id, docente.id FROM docente "
                . "JOIN docente_programa ON (docente_programa.docente_id = docente.id) "
                . "JOIN docenteperfil ON (docente.id = docenteperfil.docente_id) "
                . "WHERE docente.nombre like '%" . $dto . "%' and programa_id=" . $idPrograma
                . " and docenteperfil.perfil_id " . $area . " and docente.sede like '" . $sede . "' "
                . " and docente.id not in (SELECT docente_id FROM calificacion where estado ='CALIFICADO') order by apellidos, docente.nombre;";
        }
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }


    public function getDocentesSinArea($dto, $sede)
    {


        $sql = "SELECT documentoidentidad,docente.nombre,apellidos,celular,email, docente.id,
        case WHEN programa.nombre is null then 'No ha especificado'ELSE programa.nombre END as programa
        FROM docente left join docente_programa on(docente.id=docente_programa.docente_id)
                        left join programa on(programa_id=programa.id)
                        WHERE docente.nombre like '%" . $dto . "%' 
                         and docente.sede like '" . $sede . "'
                        and docente.id not in (SELECT docente_id FROM docenteperfil)
                         order by  docente.nombre, apellidos;";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }
    public function getDocentesDecano($dto, $idPrograma, $area, $sede)
    {
        if ($area == '') {
            $area = '> 0' . $area;
        } else {
            $area = '= ' . $area;
        }
        if ($idPrograma == '') {
            $idPrograma = 0;
        }
        $sql = "SELECT DISTINCT documentoidentidad,docente.nombre,apellidos,celular,email, programa_id, docente.id FROM docente "
            . "JOIN docente_programa ON (docente_programa.docente_id = docente.id) "
            . "JOIN docenteperfil ON (docente.id = docenteperfil.docente_id) "
            . "WHERE docente.nombre like '%" . $dto . "%' and programa_id=" . $idPrograma
            . " and docenteperfil.perfil_id  " . $area . " and docente.sede like '" . $sede . "' "
            . " and docente.id not in (SELECT docente_id FROM calificacion where estado ='CALIFICADO') order by apellidos, docente.nombre;";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }
    public function getDocentesVice($dto, $idPrograma, $area, $sede)
    {
        if ($area == '') {
            $area = '> 0' . $area;
        } else {
            $area = '= ' . $area;
        }
        if ($idPrograma == '') {
            $idPrograma = 0;
        }
        $sql = "SELECT DISTINCT documentoidentidad,docente.nombre,apellidos,celular,email, programa_id, docente.id FROM docente "
            . "JOIN docente_programa ON (docente_programa.docente_id = docente.id) "
            . "JOIN docenteperfil ON (docente.id = docenteperfil.docente_id) "
            . "WHERE docente.nombre like '%" . $dto . "%' and docente.sede like '" . $sede . "' "
            . " and docente.id not in (SELECT docente_id FROM calificacion) order by apellidos, docente.nombre;";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }

    public function existeClave($clave, $idUsuario)
    {
        try {
            $clave = sha1($clave);
            $sql = "SELECT id FROM usuario where id=" . $idUsuario . " and clave = '" . $clave . "';";
            $datos = pg_query($this->db, $sql);
            while ($row = pg_fetch_array($datos)) {
                return true;
            }
        } catch (Exception $error) { }
        return false;
    }
    public function existeClaveDocente($clave, $idUsuario)
    {
        try {
            $clave = sha1($clave);
            $sql = "SELECT id FROM docente where id=" . $idUsuario . " and clave = '" . $clave . "';";
            $datos = pg_query($this->db, $sql);
            while ($row = pg_fetch_array($datos)) {
                return true;
            }
        } catch (Exception $error) { }
        return false;
    }

    public function actualizarClave($idUsuario)
    {
        try {
            $identidad = trim(filter_input(INPUT_POST, 'identificacionTxt', FILTER_SANITIZE_SPECIAL_CHARS));
            $clave = trim(filter_input(INPUT_POST, 'claveTxt', FILTER_SANITIZE_SPECIAL_CHARS));
            $confirmar = trim(filter_input(INPUT_POST, 'confirmarTxt', FILTER_SANITIZE_SPECIAL_CHARS));
            if (
                $identidad == '' || $clave == '' ||
                $confirmar == ''
            ) {
                $mensajeMostrar = "Hay campos vacios, recuerde que todos los campos son obligatorios";
                $mensaje = "Location: ../Tablero/clases/Incorrectos/UsuarioAdminM.php?mensaje=" . $mensajeMostrar;
                header($mensaje);
                exit;
            } else {
                if ($this->existeClave($identidad, $idUsuario)) {
                    if ($clave == $confirmar) {
                        $clave = sha1($confirmar);
                        $sql = "UPDATE usuario set clave = '" . $clave . "' where id = '" . $idUsuario . "';";
                        pg_query($this->db, $sql) or die('La actualización falló: ' . pg_last_error());
                        header("Location: ../Tablero/clases/Correctos/UsuarioAdminM.html");
                        exit;
                    } else {
                        $mensajeMostrar = "La confirmación de la clave es incorrecta";
                        $mensaje = "Location: ../Tablero/clases/Incorrectos/UsuarioAdminM.php?mensaje=" . $mensajeMostrar;
                        header($mensaje);
                        exit;
                    }
                } else {
                    $mensajeMostrar = "La clave actual no es correcta";
                    $mensaje = "Location: ../Tablero/clases/Incorrectos/UsuarioAdmin.php?mensaje=" . $mensajeMostrar;
                    header($mensaje);
                    exit;
                }
            }
        } catch (Exception $error) { }
    }
    public function actualizarMiClave($idUsuario)
    {
        try {
            $identidad = trim(filter_input(INPUT_POST, 'identificacionTxt', FILTER_SANITIZE_SPECIAL_CHARS));
            $clave = trim(filter_input(INPUT_POST, 'claveTxt', FILTER_SANITIZE_SPECIAL_CHARS));
            $confirmar = trim(filter_input(INPUT_POST, 'confirmarTxt', FILTER_SANITIZE_SPECIAL_CHARS));
            if (
                $identidad == '' || $clave == '' ||
                $confirmar == ''
            ) {
                $mensajeMostrar = "Hay campos vacios, recuerde que todos los campos son obligatorios";
                $mensaje = "Location: ../Tablero/clases/Incorrectos/Usuario.php?mensaje=" . $mensajeMostrar;
                header($mensaje);
                exit;
            } else {
                if ($this->existeClaveDocente($identidad, $idUsuario)) {
                    if ($clave == $confirmar) {
                        $clave = sha1($confirmar);
                        $sql = "UPDATE docente set clave = '" . $clave . "' where id = '" . $idUsuario . "';";
                        pg_query($this->db, $sql) or die('La actualización falló: ' . pg_last_error());
                        header("Location: ../Tablero/clases/Correctos/Usuario.html");
                        exit;
                    } else {
                        $mensajeMostrar = "La confirmación de la clave es incorrecta";
                        $mensaje = "Location: ../Tablero/clases/Incorrectos/Usuario.php?mensaje=" . $mensajeMostrar;
                        header($mensaje);
                        exit;
                    }
                } else {
                    $mensajeMostrar = "La clave actual no es correcta";
                    $mensaje = "Location: ../Tablero/clases/Incorrectos/Usuario.php?mensaje=" . $mensajeMostrar;
                    header($mensaje);
                    exit;
                }
            }
        } catch (Exception $error) { }
    }

    public function actualizarClaveDecano($idUsuario)
    {
        try {
            $identidad = trim(filter_input(INPUT_POST, 'identificacionTxt', FILTER_SANITIZE_SPECIAL_CHARS));
            $clave = trim(filter_input(INPUT_POST, 'claveTxt', FILTER_SANITIZE_SPECIAL_CHARS));
            $confirmar = trim(filter_input(INPUT_POST, 'confirmarTxt', FILTER_SANITIZE_SPECIAL_CHARS));
            if (
                $identidad == '' || $clave == '' ||
                $confirmar == ''
            ) {
                $mensajeMostrar = "Hay campos vacios, recuerde que todos los campos son obligatorios";
                $mensaje = "Location: ../Tablero/clases/Incorrectos/UsuarioAdminMDecano.php?mensaje=" . $mensajeMostrar;
                header($mensaje);
                exit;
            } else {
                if ($this->existeClave($identidad, $idUsuario)) {
                    if ($clave == $confirmar) {
                        $clave = sha1($confirmar);
                        $sql = "UPDATE usuario set clave = '" . $clave . "' where id = '" . $idUsuario . "';";
                        pg_query($this->db, $sql) or die('La actualización falló: ' . pg_last_error());
                        header("Location: ../Tablero/clases/Correctos/UsuarioAdminMDecano.html");
                        exit;
                    } else {
                        $mensajeMostrar = "La confirmación de la clave es incorrecta";
                        $mensaje = "Location: ../Tablero/clases/Incorrectos/UsuarioAdminMDecano.php?mensaje=" . $mensajeMostrar;
                        header($mensaje);
                        exit;
                    }
                } else {
                    $mensajeMostrar = "La clave actual no es correcta";
                    $mensaje = "Location: ../Tablero/clases/Incorrectos/UsuarioAdminDecano.php?mensaje=" . $mensajeMostrar;
                    header($mensaje);
                    exit;
                }
            }
        } catch (Exception $error) { }
    }

    public function actualizarClaveJefe($idUsuario)
    {
        try {
            $identidad = trim(filter_input(INPUT_POST, 'identificacionTxt', FILTER_SANITIZE_SPECIAL_CHARS));
            $clave = trim(filter_input(INPUT_POST, 'claveTxt', FILTER_SANITIZE_SPECIAL_CHARS));
            $confirmar = trim(filter_input(INPUT_POST, 'confirmarTxt', FILTER_SANITIZE_SPECIAL_CHARS));
            if (
                $identidad == '' || $clave == '' ||
                $confirmar == ''
            ) {
                $mensajeMostrar = "Hay campos vacios, recuerde que todos los campos son obligatorios";
                $mensaje = "Location: ../Tablero/clases/Incorrectos/UsuarioAdminMJefe.php?mensaje=" . $mensajeMostrar;
                header($mensaje);
                exit;
            } else {
                if ($this->existeClave($identidad, $idUsuario)) {
                    if ($clave == $confirmar) {
                        $clave = sha1($confirmar);
                        $sql = "UPDATE usuario set clave = '" . $clave . "' where id = '" . $idUsuario . "';";
                        pg_query($this->db, $sql) or die('La actualización falló: ' . pg_last_error());
                        header("Location: ../Tablero/clases/Correctos/UsuarioAdminMJefe.html");
                        exit;
                    } else {
                        $mensajeMostrar = "La confirmación de la clave es incorrecta";
                        $mensaje = "Location: ../Tablero/clases/Incorrectos/UsuarioAdminMJefe.php?mensaje=" . $mensajeMostrar;
                        header($mensaje);
                        exit;
                    }
                } else {
                    $mensajeMostrar = "La clave actual no es correcta";
                    $mensaje = "Location: ../Tablero/clases/Incorrectos/UsuarioAdminJefe.php?mensaje=" . $mensajeMostrar;
                    header($mensaje);
                    exit;
                }
            }
        } catch (Exception $error) { }
    }

    public function getNombreArea($area)
    {
        try {
            $sql = "SELECT area1 FROM perfil where id = " . $area . ";";
            $datos = pg_query($this->db, $sql);
            while ($row = pg_fetch_array($datos)) {
                return $row['area1'];
            }
        } catch (Exception $error) { }
        return false;
    }

    public function getDocentesCalificacion($dto, $idPrograma, $area, $sede)
    {
        if ($area == '') {
            $area = '> 0' . $area;
        } else {
            $nombreArea = $this->getNombreArea($area);
            $area = " in (SELECT id FROM perfil where area1='" . $nombreArea . "' and programa_id=" . $idPrograma . ")";
        }
        if ($sede == "A DISTANCIA") {
            $sql = "SELECT DISTINCT documentoidentidad,docente.nombre,apellidos,celular,email, "
                . "docente_programaposgrado.programa_id, docente.id,(categoria + estudios + experiencia + investigacion + publicaciones) as puntaje,calificacion.usuario FROM docente "
                . " JOIN docente_programaposgrado ON (docente_programaposgrado.docente_id = docente.id) "
                . " JOIN docenteperfilposgrado ON (docente.id = docenteperfilposgrado.docente_id and docente_programaposgrado.programa_id=" . $idPrograma . ") "
                . " JOIN calificacion ON (docente.id = calificacion.docente_id) "
               //. " WHERE docente.nombre like '%" . $dto . "%' and docenteperfilposgrado.perfil_id " . $area . " and docente.sede like '" . $sede . "' order by puntaje desc, apellidos, docente.nombre;";
               //. " WHERE docente.nombre like '%" . $dto . "%' and docenteperfilposgrado.perfil_id " . $area . " and docente.sede =any(ARRAY['" . $sede . "','VALLEDUPAR'])  order by puntaje desc, apellidos, docente.nombre;";
                 . " WHERE docente.nombre like '%" . $dto . "%' and docenteperfilposgrado.perfil_id " . $area . " order by puntaje desc, apellidos, docente.nombre;";
        } else {
           
            $sql = "SELECT DISTINCT documentoidentidad,docente.nombre,apellidos,celular,email, "
                . "docente_programa.programa_id, docente.id,(categoria + estudios + experiencia + investigacion + publicaciones) as puntaje,calificacion.usuario FROM docente "
                . " JOIN docente_programa ON (docente_programa.docente_id = docente.id) "
                . " JOIN docenteperfil ON (docente.id = docenteperfil.docente_id) "
                . " JOIN calificacion ON (docente.id = calificacion.docente_id) "
                . " WHERE docente.nombre like '%" . $dto . "%' and docente_programa.programa_id=" . $idPrograma
                . " and docenteperfil.perfil_id " . $area . " and docente.sede like '" . $sede . "' order by puntaje desc, apellidos, docente.nombre;";
        }
        
        //var_dump($sql); exit();

        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }

    public function getDocentesCalificacionDecano($dto, $idPrograma, $area, $sede)
    {
        if ($area == '') {
            $area = '> 0' . $area;
        } else {
            $nombreArea = $this->getNombreArea($area);
            $area = " in (SELECT id FROM perfil where area1='" . $nombreArea . "' and programa_id=" . $idPrograma . ")";
        }
        if ($idPrograma == '') {
            $idPrograma = 0;
        }
        $sql = "SELECT DISTINCT documentoidentidad,docente.nombre,apellidos,celular,email, "
            . "docente_programa.programa_id, docente.id,(categoria + estudios + experiencia + investigacion + publicaciones) as puntaje,calificacion.usuario FROM docente "
            . " JOIN docente_programa ON (docente_programa.docente_id = docente.id) "
            . " JOIN docenteperfil ON (docente.id = docenteperfil.docente_id) "
            . " JOIN calificacion ON (docente.id = calificacion.docente_id) "
            . " WHERE docente.nombre like '%" . $dto . "%' and docente_programa.programa_id=" . $idPrograma
            . " and docenteperfil.perfil_id " . $area . " and docente.sede like '" . $sede . "' order by puntaje desc, apellidos, docente.nombre;";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }
    public function getDocentesCalificacionVice($dto, $idPrograma, $area, $sede)
    {
        if ($area == '') {
            $area = '> 0' . $area;
        } else {
            $nombreArea = $this->getNombreArea($area);
            $area = " in (SELECT id FROM perfil where area1='" . $nombreArea . "' and programa_id=" . $idPrograma . ")";
        }
        if ($idPrograma == '') {
            $idPrograma = 0;
        }
        $sql = "SELECT DISTINCT documentoidentidad,docente.nombre,apellidos,celular,email, "
            . "docente_programa.programa_id, docente.id,(categoria + estudios + experiencia + investigacion + publicaciones) as puntaje,calificacion.usuario FROM docente "
            . " JOIN docente_programa ON (docente_programa.docente_id = docente.id) "
            . " JOIN docenteperfil ON (docente.id = docenteperfil.docente_id) "
            . " JOIN calificacion ON (docente.id = calificacion.docente_id) "
            . " WHERE docente.nombre like '%" . $dto . "%' and docente.sede like '" . $sede . "' order by puntaje desc, apellidos, docente.nombre;";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }

    public function getDocentesCalificacionSupervisor($dto, $idPrograma, $area, $sede)
    {
        if ($area == '') {
            $area = '> 0' . $area;
        } else {
            $nombreArea = $this->getNombreArea($area);
            $area = " in (SELECT id FROM perfil where area1='" . $nombreArea . "' and programa_id=" . $idPrograma . ")";
        }
        if ($idPrograma == '') {
            $idPrograma = 0;
        }
        $sql = "SELECT tipodocumento, documentoidentidad,docente.nombre,apellidos,fechanacimiento,paisorigen,docente.id,municipio,email,"
            . "case when doctorado.titulo<>'' then 'DOCTORADO'
                             else case when maestria.titulo<>'' then 'MAESTRIA'
                             else case when especializacion.titulo<>'' then 'ESPECIALIZACION'
                             else case when pregrado.nombre <>'' then 'Pregrado'
                             ELSE 'NO INFORMA'
                             end end end end as MAX_ESTUDIO 
        ,case when doctorado.titulo<>'' then doctorado.titulo
                              else case when maestria.titulo<>'' then maestria.titulo
                              else case when especializacion.titulo<>'' then especializacion.titulo
                              else case when pregrado.nombre <>'' then pregrado.nombre
                              ELSE 'NO INFORMA'
                              end end end end as TITULO_OBTENIDO
      ,case when doctorado.titulo<>'' then doctorado.fechagrado
        else case when maestria.titulo<>'' then maestria.fechagrado
        else case when especializacion.titulo<>'' then especializacion.fechagrado
        else case when pregrado.nombre <>'' then pregrado.fechagrado
        ELSE NULL
        end end end end as FECHA_GRADO
        ,case when doctorado.titulo<>'' then doctorado.id_pais_inst_estudio
                            else case when maestria.titulo<>'' then maestria.id_pais_inst_estudio
                            else case when especializacion.titulo<>'' then especializacion.id_pais_inst_estudio
                            else case when pregrado.nombre <>'' then pregrado.id_pais_inst_estudio
                            ELSE NULL
                            end end end end as ID_PAIS_INST_ESTUDIO   
         ,case when doctorado.titulo<>'' then doctorado.tconvalidado
                           else case when maestria.titulo<>'' then maestria.tconvalidado
                           else case when especializacion.titulo<>'' then especializacion.tconvalidado
                           else case when pregrado.nombre <>'' then pregrado.tconvalidado
                           ELSE NULL
                           end end end end as CONVALIDADO                     
         ,case when doctorado.titulo<>'' then doctorado.institucion
                else case when maestria.titulo<>'' then maestria.institucion
                else case when especializacion.titulo<>'' then especializacion.institucion
                else case when pregrado.nombre <>'' then pregrado.institucion
                ELSE NULL
                end end end end as NOMBRE_INST_EST
         ,case when doctorado.titulo<>'' then doctorado.id_metodologia_p
                else case when maestria.titulo<>'' then maestria.id_metodologia_p
                else case when especializacion.titulo<>'' then especializacion.id_metodologia_p
                else case when pregrado.nombre <>'' then pregrado.id_metodologia_p
                ELSE NULL
                end end end end as ID_METODOLOGIA                      
         ,case when doctorado.titulo<>'' then doctorado.fecha_ingreso_p
                                 else case when maestria.titulo<>'' then maestria.fecha_ingreso_p
                                 else case when especializacion.titulo<>'' then especializacion.fecha_ingreso_p
                                 else case when pregrado.nombre <>'' then pregrado.fecha_ingreso_p
                                 ELSE NULL
                                 end end end end as FECHA_INGRESO
        FROM docente 
                
         LEFT JOIN pregrado ON (docente.id = pregrado.docente_id)
         LEFT JOIN especializacion ON (docente.id = especializacion.docente_id)
         LEFT JOIN maestria ON (docente.id = maestria.docente_id)
         LEFT JOIN doctorado ON (docente.id = doctorado.docente_id)";
        if ($idPrograma <> 0) {

            $sql = $sql . "JOIN docente_programa ON (docente.id = docente_programa.docente_id)
                 WHERE docente.nombre like '%" . $dto . "%' and docente_programa.programa_id=" . $idPrograma;
        } else {
            $sql = $sql . " WHERE docente.nombre like '%" . $dto . "%'";
        }
        $sql = $sql . " order by apellidos, docente.nombre;";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }

    public function getDocentesCalificacionJefe($dto, $idPrograma, $area, $sede)
    {
        if ($area == '') {
            $area = '> 0' . $area;
        } else {
            $nombreArea = $this->getNombreArea($area);
            $area = " in (SELECT id FROM perfil where area1='" . $nombreArea . "' and programa_id=" . $idPrograma . ")";
        }
        if ($idPrograma == '') {
            $idPrograma = 0;
        }
        $sql = "SELECT DISTINCT documentoidentidad,docente.nombre,apellidos,celular,email, "
            . "docente_programa.programa_id, docente.id,(categoria + estudios + experiencia + investigacion + publicaciones) as puntaje,calificacion.usuario FROM docente "
            . " JOIN docente_programa ON (docente_programa.docente_id = docente.id) "
            . " JOIN docenteperfil ON (docente.id = docenteperfil.docente_id) "
            . " JOIN calificacion ON (docente.id = calificacion.docente_id) "
            . " WHERE docente.nombre like '%" . $dto . "%' and calificacion.programa_id=" . $idPrograma
            . " and docenteperfil.perfil_id " . $area . " and docente.sede like '" . $sede . "' order by puntaje desc, apellidos, docente.nombre;";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }

    public function getPaises()
    {
        $sql = "SELECT id,pais,codigo_n FROM paises;";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }

    public function getDepartamentos($pais)
    {
        $sql = "SELECT id,departamento FROM departamentos where paises_id ='" . $pais . "';";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }

    public function getMunicipios($dto)
    {
        $sql = "SELECT id,municipio FROM municipios where departamentos_id ='" . $dto . "';";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }

    public function getDatos($id)
    {
        try {
            $ruta = $_SERVER['DOCUMENT_ROOT'];
            require_once($ruta . "/rh/Tablero/vo/DocenteVO.php");
            $docente = new DocenteVO();
            $sql = "SELECT nombre, apellidos, tipodocumento, documentoidentidad,"
                . " email, estado_civil, genero, paisorigen, departamento, "
                . "municipio, direccion, telefono, celular, fechanacimiento, "
                . "escalafondocente, sede, disponibilidad, situacion, descripcion, cualitativa FROM docente WHERE id =" . $id;
            $datos = pg_query($this->db, $sql);
            while ($row = pg_fetch_array($datos)) {
                $docente->setNombres($row['nombre']);
                $docente->setApellidos($row['apellidos']);
                $docente->setTipodocumento($row['tipodocumento']);
                $docente->setNumeroDocumento($row['documentoidentidad']);
                $docente->setEmail($row['email']);
                $docente->setEstadoCivil($row['estado_civil']);
                $docente->setGenero($row['genero']);
                $docente->setPais($row['paisorigen']);
                $docente->setDepartamento($row['departamento']);
                $docente->setMunicipio($row['municipio']);
                $docente->setDireccion($row['direccion']);
                $docente->setTelefono($row['telefono']);
                $docente->setCelular($row['celular']);
                $docente->setFechanacimiento($row['fechanacimiento']);
                $docente->setCategoria($row['escalafondocente']);
                $docente->setSede($row['sede']);
                $docente->setDisponibilidad($row['disponibilidad']);
                $docente->setSituacion($row['situacion']);
                $docente->setDescripcion($row['descripcion']);
                $docente->setCualitativa($row['cualitativa']);
                var_dump($docente);
                return $docente;
                
            }
        } catch (Exception $error) { }
        return null;
    }

    public function existeCorreo($correo)
    {
        try {
            $sql = "SELECT id FROM docente where email='" . $correo . "';";
            $datos = pg_query($this->db, $sql);
            while ($row = pg_fetch_array($datos)) {
                return true;
            }
        } catch (Exception $error) { }
        return false;
    }

    public function esCalificado($id)
    {
        try {
            $sql = "SELECT id FROM calificacion where docente_id =" . $id . ";";
            $datos = pg_query($this->db, $sql);
            while ($row = pg_fetch_array($datos)) {
                return true;
            }
        } catch (Exception $error) { }
        return false;
    }

    public function esActualizado($id)
    {
        try {
            $sql = "SELECT fechacambio FROM docente WHERE id=" . $id . " and fechacambio >=(SELECT fechainicio FROM convocatoria where estado='ACTIVA');";
            $datos = pg_query($this->db, $sql);
            while ($row = pg_fetch_array($datos)) {
                return true;
            }
        } catch (Exception $error) { }
        return false;
    }

    public function validarUsuario($login, $pass)
    {
        try {
            $passe = sha1($pass);
            $sql = "SELECT id,nombre,apellidos,email,documentoidentidad FROM docente where email='" . $login . "' and clave = '" . $passe . "';";
            $datos = pg_query($this->db, $sql);
            require_once('../../Tablero/vo/UsuarioVO.php');
            $usuario = new UsuarioVO();
            while ($row = pg_fetch_array($datos)) {
                $id = $row['id'];
                $identidad = $row['documentoidentidad'];
                $name = $row['nombre'];
                $email = $row['email'];
                $lastName = $row['apellidos'];
                $usuario->setId($id);
                $usuario->setIdentidad($identidad);
                $usuario->setName($name);
                $usuario->setMail($email);
                $usuario->setlastName($lastName);
                return $usuario;
            }
        } catch (Exception $error) { }
        return null;
    }


    public function insertar($id)
    {
        try {
            $identidad = trim(filter_input(INPUT_POST, 'numeroDocumentoTxt', FILTER_SANITIZE_SPECIAL_CHARS));
            $nombres = strtoupper(trim(filter_input(INPUT_POST, 'nombreCompletoTxt', FILTER_SANITIZE_SPECIAL_CHARS)));
            $apellidos = strtoupper(trim(filter_input(INPUT_POST, 'apellidoCompletoTxt', FILTER_SANITIZE_SPECIAL_CHARS)));
            $documentoTipo = trim(filter_input(INPUT_POST, 'tipoDocumentoCmb', FILTER_SANITIZE_SPECIAL_CHARS));
            $email = strtolower(trim(filter_input(INPUT_POST, 'emailEml', FILTER_SANITIZE_SPECIAL_CHARS)));
            $estadoCivil = trim(filter_input(INPUT_POST, 'estadoCivilCmb', FILTER_SANITIZE_SPECIAL_CHARS));
            $genero = trim(filter_input(INPUT_POST, 'generoCmb', FILTER_SANITIZE_SPECIAL_CHARS));
            $pais = trim(filter_input(INPUT_POST, 'paisCmb', FILTER_SANITIZE_SPECIAL_CHARS));
            $departamento = trim(filter_input(INPUT_POST, 'departamentoCmb', FILTER_SANITIZE_SPECIAL_CHARS));
            $municipio = trim(filter_input(INPUT_POST, 'municipioCmb', FILTER_SANITIZE_SPECIAL_CHARS));
            $direccion = strtoupper(trim(filter_input(INPUT_POST, 'direccionTxt', FILTER_SANITIZE_SPECIAL_CHARS)));
            $telefono = trim(filter_input(INPUT_POST, 'telefonoTxt', FILTER_SANITIZE_SPECIAL_CHARS));
            $celular = trim(filter_input(INPUT_POST, 'celularTxt', FILTER_SANITIZE_SPECIAL_CHARS));
            $fechaNacimiento = trim(filter_input(INPUT_POST, 'fechaNacimientoCmb', FILTER_SANITIZE_SPECIAL_CHARS));
            $categoria = trim(filter_input(INPUT_POST, 'categoriaCmb', FILTER_SANITIZE_SPECIAL_CHARS));
            $sede = trim(filter_input(INPUT_POST, 'sedeCmb', FILTER_SANITIZE_SPECIAL_CHARS));
            $disponibilidad = trim(filter_input(INPUT_POST, 'disponibilidadCmb', FILTER_SANITIZE_SPECIAL_CHARS));
            $situacion = trim(filter_input(INPUT_POST, 'situacionCmb', FILTER_SANITIZE_SPECIAL_CHARS));
            $descripcion = trim(filter_input(INPUT_POST, 'descripcionDisponibilidadTxa', FILTER_SANITIZE_SPECIAL_CHARS));

            if (
                $identidad == '' || $nombres == '' || $apellidos == '' || $documentoTipo == '' || $email == '' ||
                $estadoCivil == '' || $genero == '' || $pais == '' || $direccion == '' || $fechaNacimiento == '' || $categoria == '' || $sede == ''
            ) {
                $mensajeMostrar = "Hay campos vacios, recuerde los campos son obligatorios";
                $mensaje = "Location: clases/Incorrectos/Usuario.php?mensaje=" . $mensajeMostrar;
                header($mensaje);
                exit;
            } else {
                ////////////////// cambia el estado de la calificacion SI EXISTE a MODIFICAR
                $sql = "UPDATE calificacion SET estado='MODIFICAR' WHERE docente_id =" . $id . ";";
                pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
                ///////////////////
                $sql = "UPDATE docente SET nombre='" . $nombres . "',"
                    . " apellidos='" . $apellidos . "', tipodocumento='" . $documentoTipo
                    . "', documentoidentidad='" . $identidad . "', email='" . $email
                    . "', estado_civil='" . $estadoCivil . "', genero='" . $genero
                    . "', paisorigen='" . $pais . "', departamento='" . $departamento
                    . "', municipio='" . $municipio . "', direccion='" . $direccion
                    . "', telefono='" . $telefono . "', celular='" . $celular
                    . "', fechanacimiento='" . $fechaNacimiento
                    . "', escalafondocente='" . $categoria . "', sede='" . $sede
                    . "', disponibilidad ='" . $disponibilidad . "', situacion = '" . $situacion . "', descripcion ='" . $descripcion . "' WHERE id =" . $id . ";";
                pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
                $destino = "Soportes/hvd" . $id . ".pdf";
                if (copy($_FILES['soporteFle']['tmp_name'], $destino)) { } else {
                    $status = "Error al subir el archivo";
                }
                header("Location: clases/Correctos/Docente.php");


                exit;
            }
        } catch (Exception $error) { }
    }



    public function insertarCalificacion($id, $nombre, $programa, $usuario, $idUsuario)
    {
        try {
            $puntosestudios = trim(filter_input(INPUT_POST, 'puntosestudios', FILTER_SANITIZE_SPECIAL_CHARS));
            $puntosexperiencia = strtoupper(trim(filter_input(INPUT_POST, 'puntosexperiencia', FILTER_SANITIZE_SPECIAL_CHARS)));
            $puntosinvestigaciones = strtoupper(trim(filter_input(INPUT_POST, 'puntosinvestigaciones', FILTER_SANITIZE_SPECIAL_CHARS)));
            $puntosproduccion = trim(filter_input(INPUT_POST, 'puntosproduccion', FILTER_SANITIZE_SPECIAL_CHARS));
            $puntoscategoria = strtolower(trim(filter_input(INPUT_POST, 'puntoscategoria', FILTER_SANITIZE_SPECIAL_CHARS)));
            $comentarioCategoria = trim(filter_input(INPUT_POST, 'comentarioCategoria', FILTER_SANITIZE_SPECIAL_CHARS));
            $comentarioEstudios = trim(filter_input(INPUT_POST, 'comentarioEstudios', FILTER_SANITIZE_SPECIAL_CHARS));
            $comentarioExperiencia = trim(filter_input(INPUT_POST, 'comentarioExperiencia', FILTER_SANITIZE_SPECIAL_CHARS));
            $comentarioInvestigaciones = trim(filter_input(INPUT_POST, 'comentarioInvestigaciones', FILTER_SANITIZE_SPECIAL_CHARS));
            $comentarioProduccion = trim(filter_input(INPUT_POST, 'comentarioProduccion', FILTER_SANITIZE_SPECIAL_CHARS));
            $puntosexperiencia = str_replace(",", ".", $puntosexperiencia);
            if ($puntosestudios == '' || $puntosexperiencia == '' || $puntosinvestigaciones == '' || $puntosproduccion == '' || $puntoscategoria == '') {
                $mensajeMostrar = "Hay campos vacios, recuerde los campos son obligatorios";
                $mensaje = "Location: ../clases/Incorrectos/Usuario.php?mensaje=" . $mensajeMostrar;
                header($mensaje);
                exit;
            } else {
                $sqlDocente = "UPDATE public.docente SET fechacambio=now(),cualitativa='".$puntoscategoria."' WHERE id =" . $id . ";";
                pg_query($this->db, $sqlDocente) or die('La consulta fallo: ' . pg_last_error());
                $puntoscategoria = 1;
                if ($this->esCalificado($id)) {
                    $sql = "UPDATE public.calificacion SET fecharegistro=now(), "
                        . "usuario_id=" . $idUsuario . ", programa_id=" . $programa . ", categoria=" . $puntoscategoria . ", "
                        . "estudios=" . $puntosestudios . ", experiencia=" . $puntosexperiencia . ", "
                        . "investigacion=" . $puntosinvestigaciones . ", publicaciones=" . $puntosproduccion . ", "
                        . "usuario='" . $usuario . "', comentarioestudio='" . $comentarioEstudios . "', "
                        . "comentariocategoria='" . $comentarioCategoria . "', comentarioexperiencia='" . $comentarioExperiencia . "', "
                        . "comentarioinvestigacion='" . $comentarioInvestigaciones . "', "
                        . "comentariopublicaciones='" . $comentarioProduccion . "',estado='CALIFICADO' WHERE docente_id =" . $id . ";";
                } else {
                    $sql = "INSERT INTO public.calificacion(nombre, titulo, fecharegistro, docente_id, usuario_id,"
                        . " programa_id, categoria, estudios, experiencia, investigacion, publicaciones, usuario,"
                        . "comentariopublicaciones,comentarioinvestigacion,comentarioexperiencia,comentariocategoria,comentarioestudio,estado) "
                        . "VALUES('" . $nombre . "', '', now(), " . $id . ", " . $idUsuario . ", " . $programa . ", " . $puntoscategoria . ", "
                        . $puntosestudios . ", " . $puntosexperiencia . ", " . $puntosinvestigaciones . ", " . $puntosproduccion . ", '"
                        . $usuario . "','" . $comentarioProduccion . "','" . $comentarioInvestigaciones . "','" . $comentarioExperiencia . "','"
                        . $comentarioCategoria . "','" . $comentarioEstudios . "','CALIFICADO');";
                }
                pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
                header("Location: ../clases/Correctos/Calificacion.php");
                exit;
            }
        } catch (Exception $error) { }
    }

    public function update($id)
    {
        try {
            $sql = "UPDATE docente SET fechacambio = now() WHERE id =" . $id . ";";
            pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
        } catch (Exception $error) { }
    }

    public function updateCalificacion($id)
    {
        try {
            $sql = "UPDATE calificacion SET estado = 'MODIFICAR' WHERE docente_id =" . $id . ";";
            pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
        } catch (Exception $error) { }
    }

    public function actualizarDatos()
    {
        //sentencia sql para actualizar y/0 editar datos
        $sql = "update usuarios
             set
            nombre='" . $_POST["nombre"] . "',
            correo='" . $_POST["correo"] . "',
            telefono='" . $_POST["telefono"] . "',
            fecha='" . $_POST["fecha"] . "'
            where
            id='" . $_POST["id"] . "'";
        $this->db->query($sql);
    }

    public function eliminarDatos()
    {
        $sql = "delete from usuarios
            where id='" . $_GET["id"] . "'";
        $this->db->query($sql);
    }
}

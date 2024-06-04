<?php

require_once("conectar.php");
require_once("helpers.php");


class Docente extends conectar {

    private $db;

    public function __construct() {
        $this->db = parent::conectar();
        parent::setNames();
    }
    
    public function getPaises() {
        $sql = "SELECT id,pais FROM paises;";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }
    
    public function getDepartamentos($pais) {
        $sql = "SELECT id,departamento FROM departamentos where paises_id ='".$pais."';";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }
    
    public function getDocentes($dto,$idPrograma) {
        $sql = "SELECT documentoidentidad,docente.nombre,apellidos,celular,email, programa_id, docente.id "
                . "FROM docente JOIN docente_programa ON (docente_id = docente.id) "
                . "WHERE docente.nombre like '%".$dto."%' and programa_id=".$idPrograma.";";
        $datos = pg_query($this->db, $sql);
        $arreglo = array();
        while ($row = pg_fetch_array($datos)) {
            $arreglo[] = $row;
        }
        return $arreglo;
    }

    public function getDatos($id) {
        try {
            $ruta = $_SERVER['DOCUMENT_ROOT'];
            require_once($ruta."/InscripcionDocente/Tablero/vo/DocenteVO.php");
            $docente = new DocenteVO();
            $sql = "SELECT nombre, apellidos, tipodocumento, documentoidentidad,"
                    . " email, estado_civil, genero, paisorigen, departamento, "
                    . "municipio, direccion, telefono, celular, fechanacimiento, "
                    . "escalafondocente, sede FROM docente WHERE id =".$id;
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
                return $docente;
            }
        } catch (Exception $error) {
            
        }
        return null;
    }

    public function existeCorreo($correo) {
        try {
            $sql = "SELECT id FROM docente where email='" . $correo . "';";
            $datos = pg_query($this->db, $sql);
            while ($row = pg_fetch_array($datos)) {
                return true;
            }
        } catch (Exception $error) {
            
        }
        return false;
    }

    public function validarUsuario($login, $pass) {
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
        } catch (Exception $error) {
            
        }
        return null;
    }

    public function insertar($id) {
        try {
            $identidad = trim(filter_input(INPUT_POST, 'numeroDocumentoTxt', FILTER_SANITIZE_SPECIAL_CHARS));
            $nombres = strtoupper(trim(filter_input(INPUT_POST, 'nombreCompletoTxt', FILTER_SANITIZE_SPECIAL_CHARS)));
            $apellidos = strtoupper(trim(filter_input(INPUT_POST, 'apellidoCompletoTxt', FILTER_SANITIZE_SPECIAL_CHARS)));
            $documentoTipo = trim(filter_input(INPUT_POST, 'tipoDocumentoCmb', FILTER_SANITIZE_SPECIAL_CHARS));
            $email= strtolower(trim(filter_input(INPUT_POST, 'emailEml', FILTER_SANITIZE_SPECIAL_CHARS)));
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
            if ($identidad == '' || $nombres == '' || $apellidos == '' || $documentoTipo == '' || $email == '' ||
                    $estadoCivil == '' || $genero == '' || $pais == '' || $direccion == '' 
                    || $fechaNacimiento == '' || $categoria == '' || $sede == '') {
                $mensajeMostrar = "Hay campos vacios, recuerde los campos son obligatorios";
                $mensaje = "Location: clases/Incorrectos/Usuario.php?mensaje=" . $mensajeMostrar;
                header($mensaje);
                exit;
            } else {
                            $sql = "UPDATE docente SET nombre='".$nombres."',"
                                    . " apellidos='".$apellidos."', tipodocumento='".$documentoTipo
                                    ."', documentoidentidad='".$identidad."', email='".$email
                                    ."', estado_civil='".$estadoCivil."', genero='".$genero
                                    ."', paisorigen='".$pais."', departamento='".$departamento
                                    ."', municipio='".$municipio."', direccion='".$direccion
                                    ."', telefono='".$telefono."', celular='".$celular
                                    ."', fechanacimiento='".$fechaNacimiento
                                    ."', escalafondocente='".$categoria."', sede='".$sede
                                    ."' WHERE id =".$id.";";
                            pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
                            header("Location: clases/Correctos/Docente.php");
                            exit;
            }
        } catch (Exception $error) {
            
        }
    }

    public function actualizarDatos() {
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

    public function eliminarDatos() {
        $sql = "delete from usuarios
            where id='" . $_GET["id"] . "'";
        $this->db->query($sql);
    }

}
